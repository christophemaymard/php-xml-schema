<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\SchemaElementBuilder;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SchemaElementBuilderTest extends TestCase
{
    use ElementAssertTrait;
    
    /**
     * Tests that getSchema() returns the same instance of SchemaElement when 
     * instantiated.
     */
    public function testGetSchemaReturnsSameInstanceOfEmptySchemaElementWhenInstantiated()
    {
        $sut = new SchemaElementBuilder();
        $sch1 = $sut->getSchema();
        self::assertSchemaElementEmpty($sch1);
        $sch2 = $sut->getSchema();
        self::assertSame($sch1, $sch2, 'Same instance of SchemaElement.');
    }
    
    /**
     * Tests that buildSchemaElement() creates an empty "schema" element and 
     * replaces the current one that is being built.
     */
    public function testBuildSchemaElementCreateNewInstanceOfEmptySchemaElement()
    {
        $sut = new SchemaElementBuilder();
        $sch1 = $sut->getSchema();
        $sut->buildSchemaElement();
        $sch2 = $sut->getSchema();
        self::assertSchemaElementEmpty($sch2);
        self::assertNotSame($sch2, $sch1, 'Not same instance of SchemaElement.');
    }
}
