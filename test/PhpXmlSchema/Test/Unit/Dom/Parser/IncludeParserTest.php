<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\Parser;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\Parser} class 
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_INCLUDE}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IncludeParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'include';
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
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $inc = $sch->getIncludeElements()[0];
        self::assertSame([], $inc->getNamespaceDeclarations());
        self::assertIncludeElementHasOnlyIdAttribute($inc);
        self::assertSame($id, $inc->getId()->getId());
        self::assertSame([], $inc->getElements());
    }
    
    /**
     * Tests that parse() processes "schemaLocation" attribute.
     * 
     * @group   attribute
     */
    public function testParseProcessSchemaLocationAttribute()
    {
        $sch = $this->sut->parse($this->getXs('include_schloc_0001.xsd'));
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $inc = $sch->getIncludeElements()[0];
        self::assertSame([], $inc->getNamespaceDeclarations());
        self::assertIncludeElementHasOnlySchemaLocationAttribute($inc);
        self::assertSame('http://example.org', $inc->getSchemaLocation()->getUri());
        self::assertSame([], $inc->getElements());
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
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $inc = $sch->getIncludeElements()[0];
        self::assertSame([], $inc->getNamespaceDeclarations());
        self::assertIncludeElementHasNoAttribute($inc);
        self::assertCount(1, $inc->getElements());
        
        $ann = $inc->getAnnotationElement();
        self::assertSame([], $ann->getNamespaceDeclarations());
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
                'include_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'include_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'include_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'include_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'include_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'include_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'include_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'include_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}
