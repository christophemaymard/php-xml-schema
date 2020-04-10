<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\XmlNamespace;
use PhpXmlSchema\Exception\InvalidOperationException;
use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Exception\Message;

/**
 * Represents a parser of XML Schema document.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class Parser
{
    /**
     * The instance of XmlTraverser used when parsing a document.
     * @var XmlTraverser|NULL
     */
    private $xt;
    
    /**
     * The factory of specifications used when parsing a document.
     * @var SpecificationFactory|NULL
     */
    private $specFactory;
    
    /**
     * The context used to parse an element.
     * @var ParserContext|NULL
     */
    private $ctx;
    
    /**
     * @var ParserContext[]
     */
    private $ctxStack = [];
    
    /**
     * The instance of SchemaElementBuilder used when parsing a document.
     * @var SchemaElementBuilder|NULL
     */
    private $builder;
    
    /**
     * Parses a XML Schema document from the specified source.
     * 
     * @param   string  $src    The source to parse.
     * @return  SchemaElement   A new instance that represents the XML Schema document.
     */
    public function parse(string $src):SchemaElement
    {
        $this->initParser($src);
        
        do {
            $this->parseNode();
        } while ($this->findNextNode());
        
        return $this->builder->getSchema();
    }
    
    /**
     * Initializes the parser with the specified source.
     * 
     * @param   string  $src    The source used to initialize the parser.
     * 
     * @throws  InvalidValueException   When the root element does not belong to the XML Schema 1.0 namespace.
     */
    private function initParser(string $src)
    {
        $this->xt = new XmlTraverser($src);
        
        // Moves to the root element node.
        while (!$this->xt->isElementNode()) {
            $this->xt->moveToNextNode();
        }
        
        if ($this->xt->getNamespace() != XmlNamespace::XML_SCHEMA_1_0) {
            throw new InvalidValueException('The root element must belong to the XML Schema 1.0 namespace.');
        }
        
        $this->builder = new SchemaElementBuilder();
        $this->specFactory = new SpecificationFactory();
        $this->ctxStack = [];
        $this->ctx = new ParserContext($this->specFactory->create(ContextId::ELT_ROOT));
    }
    
    /**
     * Parses the current node.
     * 
     * @throws  InvalidOperationException   When the node is not allowed.
     */
    private function parseNode()
    {
        if ($this->xt->isElementNode()) {
            $this->parseElementNode();
        } elseif ($this->xt->isWhiteSpaceNode() || $this->xt->isCommentNode()) {
            // Nothing to do.
        } else {
            throw new InvalidOperationException(\sprintf(
                'The node is not allowed ("%s").',
                $this->xt->getValue()
            ));
        }
    }
    
    /**
     * Finds the next node to parse.
     * 
     * @return  bool    TRUE if a node has been found, otherwise FALSE.
     */
    private function findNextNode():bool
    {
        if ($this->xt->isElementNode()) {
            if ($this->ctx->isComposite() && $this->xt->moveToFirstChildNode()) {
                return TRUE;
            }
            
            $this->finishParsingElement();
        }
        
        if ($this->xt->moveToNextNode()) {
            return TRUE;
        }
        
        // Moves to the first available next node of ancestors.
        while ($this->xt->moveToParentNode()) {
            if ($this->xt->isElementNode()) {
                $this->finishParsingElement();
            }
            
            if ($this->xt->moveToNextNode()) {
                return TRUE;
            }
        }
        
        return FALSE;
    }
    
    /**
     * Finish parsing the current element.
     * 
     * @throws  InvalidOperationException   When the content is invalid.
     */
    private function finishParsingElement()
    {
        $this->builder->endElement();
        
        if (!$this->ctx->isContentValid()) {
            throw new InvalidOperationException('The content is invalid.');
        }
        
        $this->ctx = \array_pop($this->ctxStack);
    }
    
    /**
     * Parses the current node as an element.
     * 
     * @throws  InvalidOperationException   When an element is unexpected.
     */
    private function parseElementNode()
    {
        if ($this->xt->getNamespace() != XmlNamespace::XML_SCHEMA_1_0 || 
            !$this->ctx->isElementAccepted($this->xt->getLocalName())) {
            throw new InvalidOperationException(Message::unexpectedElement(
                $this->xt->getLocalName(), 
                $this->xt->getNamespace(), 
                $this->ctx->getAcceptedElements()
            ));
        }
        
        $cid = $this->ctx->createElement($this->xt->getLocalName(), $this->builder);
        
        // Pushes the current context and creates a new one for the created element.
        $this->ctxStack[] = $this->ctx;
        $this->ctx = new ParserContext($this->specFactory->create($cid));
        
        // Parses the namespace declarations.
        foreach ($this->xt->getNamespaceDeclarations() as $prefix => $namespace) {
            $this->builder->bindNamespace($prefix, $namespace);
        }
        
        // Parses the attributes.
        if ($this->xt->moveToFirstAttribute()) {
            do {
                $this->parseAttributeNode();
            } while ($this->xt->moveToNextAttribute());
            
            // Moves to parent element node.
            $this->xt->moveToParentNode();
        }
        
        // Parses the content of a leaf element.
        if (!$this->ctx->isComposite()) {
            $this->builder->buildLeafElementContent($this->xt->getValue());
        }
    }
    
    /**
     * Parses the current node as an attribute.
     * 
     * @throws  InvalidOperationException   When the attribute is not supported.
     * @throws  InvalidValueException       When the attribute is supported and the value is invalid.
     * @throws  InvalidOperationException   When the attribute is supported and the value is invalid.
     */
    private function parseAttributeNode()
    {
        $localName = $this->xt->getLocalName();
        $namespace = $this->xt->getNamespace();
        
        if (!$this->ctx->isAttributeSupported($localName, $namespace)) {
            throw new InvalidOperationException(Message::unsupportedAttribute(
                $localName, 
                $namespace
            ));
        }
        
        try {
            $this->ctx->createAttribute(
                $localName, 
                $namespace, 
                $this->xt->getValue(),
                $this->builder
            );
        } catch (InvalidValueException $ex) {
            throw new InvalidValueException(\sprintf(
                'The "%s" attribute is invalid: %s',
                $localName, 
                $ex->getMessage()
            ));
        } catch (InvalidOperationException $ex) {
            throw new InvalidOperationException(\sprintf(
                'The "%s" attribute is invalid: %s',
                $localName, 
                $ex->getMessage()
            ));
        }
    }
}
