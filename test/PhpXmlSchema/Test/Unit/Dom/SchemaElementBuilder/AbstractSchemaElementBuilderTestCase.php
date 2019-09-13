<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\ElementInterface;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Test\Unit\Dom\ElementAssertTrait;

/**
 * Represents the base class to unit test the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class for a specific current element.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractSchemaElementBuilderTestCase extends TestCase
{
    use ElementAssertTrait;
    
    /**
     * The system under test.
     * @var SchemaElementBuilder
     */
    protected $sut;
    
    /**
     * Asserts that the specified "schema" element did not change since its 
     * building.
     * 
     * @param   SchemaElement   $sch    The element to assert.
     */
    abstract public static function assertSchemaElementNotChanged(SchemaElement $sch);
    
    /**
     * Asserts that the ancestors of the current element did not change since 
     * its building.
     * 
     * @param   SchemaElement   $sch    The "schema" element of the current element to assert.
     */
    abstract public static function assertAncestorsNotChanged(SchemaElement $sch);
    
    /**
     * Asserts that the current element has no attribute.
     * 
     * @param   SchemaElement   $sch    The "schema" element of the current element
     */
    abstract public static function assertCurrentElementHasNotAttribute(SchemaElement $sch);
    
    /**
     * Asserts that the current element has no attribute.
     * 
     * @param   SchemaElement   $sch    The "schema" element of the current element
     * @return  ElementInterface|NULL
     */
    abstract protected static function getCurrentElement(SchemaElement $sch);
}
