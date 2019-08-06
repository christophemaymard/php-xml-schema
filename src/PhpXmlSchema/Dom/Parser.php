<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
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
     * The instance of SchemaElementBuilder used when parsing a document.
     * @var SchemaElementBuilder|NULL
     */
    private $builder;
    
    /**
     * Parses a XML Schema document from the specified source.
     * 
     * @param   string  $src    The source to parse.
     * @return  SchemaElement   A new instance that represents the XML Schema document.
     * 
     * @throws  InvalidOperationException   When an element is unexpected.
     */
    public function parse(string $src):SchemaElement
    {
        $this->initParser($src);
        
        if (!$this->ctx->isElementAccepted($this->xt->getLocalName())) {
            throw new InvalidOperationException(Message::unexpectedElement(
                $this->xt->getLocalName(), 
                $this->xt->getNamespace(), 
                $this->ctx->getAcceptedElements()
            ));
        }
        
        $cid = $this->ctx->createElement($this->xt->getLocalName(), $this->builder);
        
        // Creates a context for the created element.
        $this->ctx = new ParserContext($this->specFactory->create($cid));
        
        // Parses the attributes.
        if ($this->xt->moveToFirstAttribute()) {
            do {
                $this->parseAttributeNode();
            } while ($this->xt->moveToNextAttribute());
            
            // Moves to parent element node.
            $this->xt->moveToParentNode();
        }
        
        while ($this->findNextNode()) {
            $this->parseNode();
        }
        
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
        $this->ctx = new ParserContext($this->specFactory->create(ContextId::ELT_ROOT));
    }
    
    /**
     * Parses the current node.
     * 
     * @throws  InvalidOperationException   When the node is not allowed.
     */
    private function parseNode()
    {
        if ($this->xt->isWhiteSpaceNode() || $this->xt->isCommentNode()) {
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
        return $this->xt->moveToFirstChildNode() || $this->xt->moveToNextNode();
    }
    
    /**
     * Parses the current node as an attribute.
     * 
     * @throws  InvalidOperationException   When the attribute is not supported.
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
        
        $this->ctx->createAttribute(
            $localName, 
            $namespace, 
            $this->xt->getValue(),
            $this->builder
        );
    }
}