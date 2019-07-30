<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents a builder of "schema" element.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SchemaElementBuilder implements SchemaBuilderInterface
{
    /**
     * The instance of the "schema" element that is being built.
     * @var SchemaElement
     */
    private $schemaElement;
    
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->buildSchemaElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildSchemaElement()
    {
        $this->schemaElement = new SchemaElement();
    }
    
    /**
     * Returns the instance of the "schema" element that has been built.
     * 
     * @return  SchemaElement
     */
    public function getSchema():SchemaElement
    {
        return $this->schemaElement;
    }
}
