<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\Parser;
use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Exception\InvalidOperationException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\Parser} class.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParserTest extends TestCase
{
    use ElementAssertTrait;
    
    /**
     * Tests that parse() throws an expcetion when the provided XML Schema is 
     * not an XML.
     * 
     * @group   xml
     */
    public function testParseThrowsExceptionWhenXsIsNotXml()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The source is an invalid XML.');
        
        $sut = new Parser();
        $sut->parse($this->getSchemaXs('error_0001.xsd'));
    }
    
    /**
     * Tests that parse() throws an expcetion when the root element is not 
     * part of the XML Schema 1.0 namespace.
     */
    public function testParseThrowsExceptionWhenRootNotPartOfXs10()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The root element must belong to '.
            'the XML Schema 1.0 namespace.');
        
        $sut = new Parser();
        $sut->parse($this->getSchemaXs('error_0002.xsd'));
    }
    
    /**
     * Tests that parse() throws an expcetion when the root element is not 
     * the "schema" element.
     */
    public function testParseThrowsExceptionWhenRootNotSchemaElement()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" element '.
            '(from http://www.w3.org/2001/XMLSchema namespace) is '.
            'unexpected, expected: "schema".');
        
        $sut = new Parser();
        $sut->parse($this->getSchemaXs('error_0003.xsd'));
    }
    
    /**
     * Tests that parse() returns an empty "schema" element.
     */
    public function testParseReturnsEmptySchema()
    {
        $sut = new Parser();
        $sch = $sut->parse($this->getSchemaXs('schema_0001.xsd'));
        self::assertSchemaElementEmpty($sch);
    }
    
    /**
     * Tests that parse() skip all nodes before the root element.
     */
    public function testParseSkipAllNodesBeforeRootElement()
    {
        $sut = new Parser();
        $sch = $sut->parse($this->getSchemaXs('schema_0002.xsd'));
        self::assertSchemaElementEmpty($sch);
    }
    
    /**
     * Tests that parse() processes "attributeFormDefault" attribute with 
     * "qualified" value.
     * 
     * @group   attribute
     */
    public function testParseProcessAttributeFormDefaultAttributeWithQualifiedInSchemaElement()
    {
        $sut = new Parser();
        $sch = $sut->parse($this->getSchemaXs('attr_attrfd_0001.xsd'));
        self::assertTrue($sch->getAttributeFormDefault()->isQualified());
    }
    
    /**
     * Tests that parse() processes "attributeFormDefault" attribute with 
     * "unqualified" value.
     * 
     * @group   attribute
     */
    public function testParseProcessAttributeFormDefaultAttributeWithUnqualifiedInSchemaElement()
    {
        $sut = new Parser();
        $sch = $sut->parse($this->getSchemaXs('attr_attrfd_0002.xsd'));
        self::assertTrue($sch->getAttributeFormDefault()->isUnqualified());
    }
    
    /**
     * Tests that parse() throws an exception when the value of the 
     * "attributeFormDefault" attribute is invalid.
     * 
     * @group   attribute
     */
    public function testParseThrowsExceptionWhenAttributeFormDefaultIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"foo" is an invalid value for the "attributeFormDefault" '.
            'attribute (from no namespace), expected: "qualified" or '.
            '"unqualified".'
        );
        
        $sut = new Parser();
        $sut->parse($this->getSchemaXs('attr_attrfd_0003.xsd'));
    }
    
    /**
     * Returns the content of the specified filename located at the "schema" 
     * directory.
     * 
     * @param   string  $fileName
     * @return  string
     */
    private function getSchemaXs(string $fileName):string
    {
        return \file_get_contents(
            __DIR__.'/../../../../../res/test/unit/parser/schema/'.$fileName
        );
    }
}
