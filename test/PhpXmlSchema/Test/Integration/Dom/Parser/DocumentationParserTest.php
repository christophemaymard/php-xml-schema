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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_DOCUMENTATION}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DocumentationParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName(): string
    {
        return 'documentation';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations(): void
    {
        $sch = $this->sut->parse($this->getXs('documentation_0005.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(1, $ann->getElements());
        
        $doc = $ann->getDocumentationElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $doc
        );
        self::assertDocumentationElementHasNoAttribute($doc);
        self::assertSame('', $doc->getContent());
    }
    
    /**
     * Tests that parse() processes "source" attribute.
     * 
     * @group   attribute
     */
    public function testParseProcessSourceAttribute(): void
    {
        $sch = $this->sut->parse($this->getXs('documentation_src_0001.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(1, $ann->getElements());
        
        $doc = $ann->getDocumentationElements()[0];
        self::assertElementNamespaceDeclarations([], $doc);
        self::assertDocumentationElementHasOnlySourceAttribute($doc);
        self::assertSame('http://example.org', $doc->getSource()->getAnyUri());
        self::assertSame('', $doc->getContent());
    }
    
    /**
     * Tests that parse() processes "xml:lang" attribute.
     * 
     * @param   string      $fileName   The name of the file used for the test.
     * @param   string      $prim       The expected value for the primary subtag.
     * @param   string[]    $subtags    The expected value for the subtags.
     * 
     * @group           attribute
     * @dataProvider    getValidLangAttributes
     */
    public function testParseProcessLangAttribute(
        string $fileName, 
        string $prim, 
        array $subtags
    ): void
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
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(1, $ann->getElements());
        
        $doc = $ann->getDocumentationElements()[0];
        self::assertElementNamespaceDeclarations([], $doc);
        self::assertDocumentationElementHasOnlyLangAttribute($doc);
        self::assertSame($prim, $doc->getLang()->getPrimarySubtag());
        self::assertSame($subtags, $doc->getLang()->getSubtags());
        self::assertSame('', $doc->getContent());
    }
    
    /**
     * Tests that parse() processes the content.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessContent(): void
    {
        $sch = $this->sut->parse($this->getXs('documentation_0004.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(2, $ann->getElements());
        
        $docs = $ann->getDocumentationElements();
        
        self::assertElementNamespaceDeclarations([], $docs[0]);
        self::assertDocumentationElementHasNoAttribute($docs[0]);
        self::assertSame('foo', $docs[0]->getContent());
        
        self::assertElementNamespaceDeclarations([], $docs[1]);
        self::assertDocumentationElementHasNoAttribute($docs[1]);
        self::assertSame('bar', $docs[1]->getContent());
    }
    
    /**
     * Returns a set of valid "xml:lang" attributes.
     * 
     * @return  array[]
     */
    public function getValidLangAttributes(): array
    {
        return [
            'Primary subtag of 1 character' => [
                'documentation_lang_0001.xsd', 
                'f', 
                [], 
            ], 
            'Primary subtag of 8 characters' => [
                'documentation_lang_0002.xsd', 
                'foobarba', 
                [], 
            ], 
            'Subtag of 1 character' => [
                'documentation_lang_0003.xsd', 
                'foo', 
                [ 'b' ], 
            ], 
            'Subtag with number' => [
                'documentation_lang_0004.xsd', 
                'foo', 
                [ 'bar1' ], 
            ], 
            'Language with white spaces' => [
                'documentation_lang_0005.xsd', 
                'foo', 
                [ 'bar1', 'baz2', 'qux3' ], 
            ], 
        ];
    }
}
