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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_ANNOTATION}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnnotationParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'annotation';
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
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertSame([], $ann->getNamespaceDeclarations());
        self::assertAnnotationElementHasOnlyIdAttribute($ann);
        self::assertSame($id, $ann->getId()->getId());
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that parse() processes "appinfo" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAppInfoElement()
    {
        $sch = $this->sut->parse($this->getXs('appinfo_0002.xsd'));
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertSame([], $ann->getNamespaceDeclarations());
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(2, $ann->getElements());
        
        $appinfos = $ann->getAppInfoElements();
        
        self::assertSame([], $appinfos[0]->getNamespaceDeclarations());
        self::assertAppInfoElementHasNoAttribute($appinfos[0]);
        self::assertSame('', $appinfos[0]->getContent());
        
        self::assertSame([], $appinfos[1]->getNamespaceDeclarations());
        self::assertAppInfoElementHasNoAttribute($appinfos[1]);
        self::assertSame('', $appinfos[1]->getContent());
    }
    
    /**
     * Tests that parse() processes "documentation" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessDocumentationElement()
    {
        $sch = $this->sut->parse($this->getXs('documentation_0002.xsd'));
        
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertSame([], $ann->getNamespaceDeclarations());
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(2, $ann->getElements());
        
        $docs = $ann->getDocumentationElements();
        
        self::assertSame([], $docs[0]->getNamespaceDeclarations());
        self::assertDocumentationElementHasNoAttribute($docs[0]);
        self::assertSame('', $docs[0]->getContent());
        
        self::assertSame([], $docs[1]->getNamespaceDeclarations());
        self::assertDocumentationElementHasNoAttribute($docs[1]);
        self::assertSame('', $docs[1]->getContent());
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
                'annotation_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'annotation_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'annotation_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'annotation_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'annotation_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'annotation_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'annotation_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'annotation_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}
