<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom\Parser;

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
    protected function getContextName(): string
    {
        return 'include';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations(): void
    {
        $sch = $this->sut->parse($this->getXs('include_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $inc = $sch->getIncludeElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $inc
        );
        self::assertIncludeElementHasNoAttribute($inc);
        self::assertSame([], $inc->getElements());
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
    public function testParseProcessIdAttribute(string $fileName, string $id): void
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
        
        $inc = $sch->getIncludeElements()[0];
        self::assertElementNamespaceDeclarations([], $inc);
        self::assertIncludeElementHasOnlyIdAttribute($inc);
        self::assertSame($id, $inc->getId()->getId());
        self::assertSame([], $inc->getElements());
    }
    
    /**
     * Tests that parse() processes "schemaLocation" attribute.
     * 
     * @group   attribute
     */
    public function testParseProcessSchemaLocationAttribute(): void
    {
        $sch = $this->sut->parse($this->getXs('include_schloc_0001.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $inc = $sch->getIncludeElements()[0];
        self::assertElementNamespaceDeclarations([], $inc);
        self::assertIncludeElementHasOnlySchemaLocationAttribute($inc);
        self::assertSame('http://example.org', $inc->getSchemaLocation()->getAnyUri());
        self::assertSame([], $inc->getElements());
    }
    
    /**
     * Tests that parse() processes "annotation" element.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAnnotationElement(): void
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
        
        $inc = $sch->getIncludeElements()[0];
        self::assertElementNamespaceDeclarations([], $inc);
        self::assertIncludeElementHasNoAttribute($inc);
        self::assertCount(1, $inc->getElements());
        
        $ann = $inc->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Returns a set of valid "id" attributes.
     * 
     * @return  array[]
     */
    public function getValidIdAttributes(): array
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
