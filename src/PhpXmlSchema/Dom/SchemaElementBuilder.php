<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Exception\Message;

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
    public function buildAttributeFormDefaultAttribute(string $value)
    {
        if ($value == 'qualified') {
            $attr = FormType::createQualified();
        } elseif ($value == 'unqualified') {
            $attr = FormType::createUnqualified();
        } else {
            throw new InvalidValueException(Message::invalidAttributeValue(
                $value, 
                'attributeFormDefault', 
                '', 
                [ 'qualified', 'unqualified', ]
            ));
        }
        
        $this->schemaElement->setAttributeFormDefault($attr);
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
