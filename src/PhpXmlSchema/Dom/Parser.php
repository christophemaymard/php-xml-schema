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
        
        $localName = $this->xt->getLocalName();
        
        if ($localName != 'schema') {
            throw new InvalidOperationException(Message::unexpectedElement(
                $localName, 
                $this->xt->getNamespace(), 
                [ 'schema', ]
            ));
        }
        
        $this->builder->buildSchemaElement();
        
        // Parses the attributes.
        if ($this->xt->moveToFirstAttribute()) {
            do {
                $this->parseAttributeNode();
            } while ($this->xt->moveToNextAttribute());
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
    }
    
    /**
     * Parses the current node as an attribute.
     * 
     * @throws  InvalidOperationException   When the attribute is not supported.
     * @throws  InvalidOperationException   When the attribute is not supported.
     * @throws  InvalidOperationException   When the attribute is not supported.
     */
    private function parseAttributeNode()
    {
        $localName = $this->xt->getLocalName();
        $namespace = $this->xt->getNamespace();
        
        if ($namespace == '') {
            if ($localName == 'attributeFormDefault') {
                $this->builder->buildAttributeFormDefaultAttribute($this->xt->getValue());
            } elseif ($localName == 'blockDefault') {
                $this->builder->buildBlockDefaultAttribute($this->xt->getValue());
            } elseif ($localName == 'elementFormDefault') {
                $this->builder->buildElementFormDefaultAttribute($this->xt->getValue());
            } elseif ($localName == 'finalDefault') {
                $this->builder->buildFinalDefaultAttribute($this->xt->getValue());
            } elseif ($localName == 'id') {
                $this->builder->buildIdAttribute($this->xt->getValue());
            } elseif ($localName == 'targetNamespace') {
                $this->builder->buildTargetNamespaceAttribute($this->xt->getValue());
            } elseif ($localName == 'version') {
                $this->builder->buildVersionAttribute($this->xt->getValue());
            } else {
                throw new InvalidOperationException(Message::unsupportedAttribute($localName, $namespace));
            }
        } elseif ($namespace == XmlNamespace::XML_1_0) {
            if ($localName == 'lang') {
                $this->builder->buildLangAttribute($this->xt->getValue());
            } else {
                throw new InvalidOperationException(Message::unsupportedAttribute($localName, $namespace));
            }
        } else {
            throw new InvalidOperationException(Message::unsupportedAttribute($localName, $namespace));
        }
    }
}
