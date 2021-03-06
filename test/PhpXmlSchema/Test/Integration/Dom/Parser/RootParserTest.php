<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom\Parser;

use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\Parser} class 
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_ROOT}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class RootParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName(): string
    {
        return 'root';
    }
    
    /**
     * Tests that parse() throws an exception when the provided XML Schema is 
     * not an XML.
     * 
     * @group   xml
     */
    public function testParseThrowsExceptionWhenXsIsNotXml(): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The source is an invalid XML.');
        
        $this->sut->parse($this->getXs('schema_0001.xsd'));
    }
    
    /**
     * Tests that parse() returns an empty "schema" element.
     */
    public function testParseReturnsEmptySchema(): void
    {
        $sch = $this->sut->parse($this->getXs('schema_0004.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() skip all nodes before the root element.
     */
    public function testParseSkipAllNodesBeforeRootElement(): void
    {
        $sch = $this->sut->parse($this->getXs('schema_0005.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
}
