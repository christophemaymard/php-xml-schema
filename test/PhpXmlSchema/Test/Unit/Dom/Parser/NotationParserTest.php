<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\Parser;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\Parser} class 
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_NOTATION}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NotationParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'notation';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('notation_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $not = $sch->getNotationElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $not
        );
        self::assertNotationElementHasNoAttribute($not);
        self::assertSame([], $not->getElements());
    }
    
    /**
     * Tests that parse() processes "id" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $id         The expected value for the ID.
     * 
     * @group           attribute
     * @dataProvider    getValidIdAttributes
     */
    public function testParseProcessIdAttribute(string $fileName, string $id)
    {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $not = $sch->getNotationElements()[0];
        self::assertElementNamespaceDeclarations([], $not);
        self::assertNotationElementHasOnlyIdAttribute($not);
        self::assertSame($id, $not->getId()->getId());
        self::assertSame([], $not->getElements());
    }
    
    /**
     * Tests that parse() processes "name" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $name       The expected value for the name.
     * 
     * @group           attribute
     * @dataProvider    getValidNameAttributes
     */
    public function testParseProcessNameAttribute(string $fileName, string $name)
    {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $not = $sch->getNotationElements()[0];
        self::assertElementNamespaceDeclarations([], $not);
        self::assertNotationElementHasOnlyNameAttribute($not);
        self::assertSame($name, $not->getName()->getNCName());
        self::assertSame([], $not->getElements());
    }
    
    /**
     * Tests that parse() processes "public" attribute.
     * 
     * @group   attribute
     */
    public function testParseProcessPublicAttribute()
    {
        $sch = $this->sut->parse($this->getXs('notation_public_0001.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $not = $sch->getNotationElements()[0];
        self::assertElementNamespaceDeclarations([], $not);
        self::assertNotationElementHasOnlyPublicAttribute($not);
        self::assertSame('foo bar baz qux', $not->getPublic()->getToken());
        self::assertSame([], $not->getElements());
    }
    
    /**
     * Tests that parse() processes "system" attribute.
     * 
     * @group   attribute
     */
    public function testParseProcessSystemAttribute()
    {
        $sch = $this->sut->parse($this->getXs('notation_system_0001.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $not = $sch->getNotationElements()[0];
        self::assertElementNamespaceDeclarations([], $not);
        self::assertNotationElementHasOnlySystemAttribute($not);
        self::assertSame('http://example.org', $not->getSystem()->getAnyUri());
        self::assertSame([], $not->getElements());
    }
    
    /**
     * Tests that parse() processes "annotation" element.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAnnotationElement()
    {
        $sch = $this->sut->parse($this->getXs('annotation_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $not = $sch->getNotationElements()[0];
        self::assertElementNamespaceDeclarations([], $not);
        self::assertNotationElementHasNoAttribute($not);
        self::assertCount(1, $not->getElements());
        
        $ann = $not->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Returns a set of valid "id" attributes.
     * 
     * @return  array[]
     */
    public function getValidIdAttributes():array
    {
        return [
            'Starts with _' => [
                'notation_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'notation_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'notation_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'notation_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'notation_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'notation_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'notation_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'notation_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "name" attributes.
     * 
     * @return  array[]
     */
    public function getValidNameAttributes():array
    {
        return [
            'Starts with _' => [
                'notation_name_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'notation_name_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'notation_name_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'notation_name_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'notation_name_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'notation_name_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'notation_name_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'notation_name_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}
