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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_IMPORT}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ImportParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'import';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('import_0006.xsd'));
        
        self::assertSame(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch->getNamespaceDeclarations()
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $import = $sch->getImportElements()[0];
        $decls = [
            '' => 'http://example.org', 
            'foo' => 'http://example.org/foo', 
        ];
        self::assertArraySubset($decls, $import->getNamespaceDeclarations(), TRUE);
        self::assertCount(0, \array_diff_assoc($import->getNamespaceDeclarations(), $decls));
        self::assertImportElementHasNoAttribute($import);
        self::assertSame([], $import->getElements());
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
        
        self::assertSame(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch->getNamespaceDeclarations()
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $import = $sch->getImportElements()[0];
        self::assertSame([], $import->getNamespaceDeclarations());
        self::assertImportElementHasOnlyIdAttribute($import);
        self::assertSame($id, $import->getId()->getId());
        self::assertSame([], $import->getElements());
    }
    
    /**
     * Tests that parse() processes "namespace" attribute.
     * 
     * @group   attribute
     */
    public function testParseProcessNamespaceAttribute()
    {
        $sch = $this->sut->parse($this->getXs('import_ns_0001.xsd'));
        
        self::assertSame(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch->getNamespaceDeclarations()
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $import = $sch->getImportElements()[0];
        self::assertSame([], $import->getNamespaceDeclarations());
        self::assertImportElementHasOnlyNamespaceAttribute($import);
        self::assertSame('http://example.org', $import->getNamespace()->getUri());
        self::assertSame([], $import->getElements());
    }
    
    /**
     * Tests that parse() processes "schemaLocation" attribute.
     * 
     * @group   attribute
     */
    public function testParseProcessSchemaLocationAttribute()
    {
        $sch = $this->sut->parse($this->getXs('import_schloc_0001.xsd'));
        
        self::assertSame(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch->getNamespaceDeclarations()
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $import = $sch->getImportElements()[0];
        self::assertSame([], $import->getNamespaceDeclarations());
        self::assertImportElementHasOnlySchemaLocationAttribute($import);
        self::assertSame('http://example.org', $import->getSchemaLocation()->getUri());
        self::assertSame([], $import->getElements());
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
        
        self::assertSame(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch->getNamespaceDeclarations()
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $import = $sch->getImportElements()[0];
        self::assertSame([], $import->getNamespaceDeclarations());
        self::assertImportElementHasNoAttribute($import);
        self::assertCount(1, $import->getElements());
        
        $ann = $import->getAnnotationElement();
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
                'import_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'import_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'import_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'import_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'import_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'import_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'import_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'import_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}
