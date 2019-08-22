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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_SCHEMA}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SchemaParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'schema';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('schema_0007.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
                'foo' => 'http://example.org/foo', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "attributeFormDefault" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   bool    $qual       The expected value for the "qualified" flag.
     * @param   bool    $unqual     The expected value for the "unqualified" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidAttributeFormDefaultAttributes
     */
    public function testParseProcessAttributeFormDefaultAttribute(
        string $fileName,
        bool $qual, 
        bool $unqual
    ) {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasOnlyAttributeFormDefaultAttribute($sch);
        self::assertSame($qual, $sch->getAttributeFormDefault()->isQualified());
        self::assertSame($unqual, $sch->getAttributeFormDefault()->isUnqualified());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "blockDefault" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   bool    $res        The expected value for the "restriction" flag.
     * @param   bool    $ext        The expected value for the "extension" flag.
     * @param   bool    $sub        The expected value for the "substitution" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidBlockDefaultAttributes
     */
    public function testParseProcessBlockDefaultAttribute(
        string $fileName,
        bool $res, 
        bool $ext, 
        bool $sub
    ) {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasOnlyBlockDefaultAttribute($sch);
        self::assertSchemaElementBlockDefaultAttribute($res, $ext, $sub, $sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "elementFormDefault" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   bool    $qual       The expected value for the "qualified" flag.
     * @param   bool    $unqual     The expected value for the "unqualified" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidElementFormDefaultAttributes
     */
    public function testParseProcessElementFormDefaultAttribute(
        string $fileName,
        bool $qual, 
        bool $unqual
    ) {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasOnlyElementFormDefaultAttribute($sch);
        self::assertSame($qual, $sch->getElementFormDefault()->isQualified());
        self::assertSame($unqual, $sch->getElementFormDefault()->isUnqualified());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "finalDefault" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   bool    $ext        The expected value for the "extension" flag.
     * @param   bool    $res        The expected value for the "restriction" flag.
     * @param   bool    $lst        The expected value for the "list" flag.
     * @param   bool    $unn        The expected value for the "union" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidFinalDefaultAttributes
     */
    public function testParseProcessFinalDefaultAttribute(
        string $fileName,
        bool $ext, 
        bool $res, 
        bool $lst, 
        bool $unn
    ) {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasOnlyFinalDefaultAttribute($sch);
        self::assertSchemaElementFinalDefaultAttribute($ext, $res, $lst, $unn, $sch);
        self::assertSame([], $sch->getElements());
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
        self::assertSchemaElementHasOnlyIdAttribute($sch);
        self::assertSame($id, $sch->getId()->getId());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "targetNamespace" attribute.
     * 
     * @group   attribute
     */
    public function testParseProcessTargetNamespaceAttribute()
    {
        $sch = $this->sut->parse($this->getXs('schema_target_0001.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasOnlyTargetNamespaceAttribute($sch);
        self::assertSame('http://example.org', $sch->getTargetNamespace()->getUri());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "version" attribute.
     * 
     * @group   attribute
     */
    public function testParseProcessVersionAttribute()
    {
        $sch = $this->sut->parse($this->getXs('schema_version_0001.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasOnlyVersionAttribute($sch);
        self::assertSame('foo bar baz qux', $sch->getVersion()->getToken());
        self::assertSame([], $sch->getElements());
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
    ) {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasOnlyLangAttribute($sch);
        self::assertSame($prim, $sch->getLang()->getPrimarySubtag());
        self::assertSame($subtags, $sch->getLang()->getSubtags());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes all the attributes.
     * 
     * @group   attribute
     */
    public function testParseProcessAllAttributes()
    {
        $sch = $this->sut->parse($this->getXs('schema_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertTrue($sch->getAttributeFormDefault()->isUnqualified());
        self::assertSchemaElementBlockDefaultAttribute(FALSE, TRUE, FALSE, $sch);
        self::assertTrue($sch->getElementFormDefault()->isQualified());
        self::assertSchemaElementFinalDefaultAttribute(FALSE, TRUE, FALSE, FALSE, $sch);
        self::assertSame('schema', $sch->getId()->getId());
        self::assertSame('http://example.org', $sch->getTargetNamespace()->getUri());
        self::assertSame('1.0', $sch->getVersion()->getToken());
        self::assertSame('en', $sch->getLang()->getPrimarySubtag());
        self::assertSame([ 'us', ], $sch->getLang()->getSubtags());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "annotation" elements (composition).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessCompositionAnnotationElement()
    {
        $sch = $this->sut->parse($this->getXs('annotation_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $anns = $sch->getCompositionAnnotationElements();
        self::assertCount(2, $anns);
        
        self::assertElementNamespaceDeclarations([], $anns[0]);
        self::assertAnnotationElementHasNoAttribute($anns[0]);
        self::assertSame([], $anns[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $anns[1]);
        self::assertAnnotationElementHasNoAttribute($anns[1]);
        self::assertSame([], $anns[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "import" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessImportElement()
    {
        $sch = $this->sut->parse($this->getXs('import_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $imports = $sch->getImportElements();
        self::assertCount(2, $imports);
        
        self::assertElementNamespaceDeclarations([], $imports[0]);
        self::assertImportElementHasNoAttribute($imports[0]);
        self::assertSame([], $imports[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $imports[1]);
        self::assertImportElementHasNoAttribute($imports[1]);
        self::assertSame([], $imports[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "include" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessIncludeElement()
    {
        $sch = $this->sut->parse($this->getXs('include_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $incs = $sch->getIncludeElements();
        self::assertCount(2, $incs);
        
        self::assertElementNamespaceDeclarations([], $incs[0]);
        self::assertIncludeElementHasNoAttribute($incs[0]);
        self::assertSame([], $incs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $incs[1]);
        self::assertIncludeElementHasNoAttribute($incs[1]);
        self::assertSame([], $incs[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "notation" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessNotationElement()
    {
        $sch = $this->sut->parse($this->getXs('notation_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $nots = $sch->getNotationElements();
        self::assertCount(2, $nots);
        
        self::assertElementNamespaceDeclarations([], $nots[0]);
        self::assertNotationElementHasNoAttribute($nots[0]);
        self::assertSame([], $nots[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $nots[1]);
        self::assertNotationElementHasNoAttribute($nots[1]);
        self::assertSame([], $nots[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "annotation" elements (definition).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessDefinitionAnnotationElement()
    {
        $sch = $this->sut->parse($this->getXs('annotation_0004.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        $children = $sch->getElements();
        self::assertCount(3, $children);
        self::assertCount(1, $sch->getNotationElements());
        self::assertCount(2, $sch->getDefinitionAnnotationElements());
        
        self::assertElementNamespaceDeclarations([], $children[0]);
        self::assertNotationElementHasNoAttribute($children[0]);
        self::assertSame([], $children[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $children[1]);
        self::assertAnnotationElementHasNoAttribute($children[1]);
        self::assertSame([], $children[1]->getElements());
        
        self::assertElementNamespaceDeclarations([], $children[2]);
        self::assertAnnotationElementHasNoAttribute($children[2]);
        self::assertSame([], $children[2]->getElements());
    }
    
    /**
     * Tests that parse() processes "attribute" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAttributeElement()
    {
        $sch = $this->sut->parse($this->getXs('attribute_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $attrs = $sch->getAttributeElements();
        self::assertCount(2, $attrs);
        
        self::assertElementNamespaceDeclarations([], $attrs[0]);
        self::assertAttributeElementHasNoAttribute($attrs[0]);
        self::assertSame([], $attrs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $attrs[1]);
        self::assertAttributeElementHasNoAttribute($attrs[1]);
        self::assertSame([], $attrs[1]->getElements());
    }
    
    /**
     * Returns a set of valid "attributeFormDefault" attributes.
     * 
     * @return  array[]
     */
    public function getValidAttributeFormDefaultAttributes():array
    {
        // [ $fileName, $qualified, $unqualified, ]
        return [
            'qualified' => [
                'schema_attrfd_0001.xsd', TRUE, FALSE, 
            ], 
            'unqualified' => [
                'schema_attrfd_0002.xsd', FALSE, TRUE, 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "blockDefault" attributes.
     * 
     * @return  array[]
     */
    public function getValidBlockDefaultAttributes():array
    {
        // [ $fileName, $restriction, $extension, $substitution, ]
        return [
            'Empty string' => [
                'schema_blockd_0001.xsd', FALSE, FALSE, FALSE, 
            ], 
            'Only white spaces' => [
                'schema_blockd_0002.xsd', FALSE, FALSE, FALSE, 
            ], 
            '#all' => [
                'schema_blockd_0003.xsd', TRUE, TRUE, TRUE, 
            ], 
            'extension, restriction and substitution with white spaces' => [
                'schema_blockd_0004.xsd', TRUE, TRUE, TRUE, 
            ], 
            'restriction with white spaces' => [
                'schema_blockd_0005.xsd', TRUE, FALSE, FALSE, 
            ], 
            'extension with white spaces' => [
                'schema_blockd_0006.xsd', FALSE, TRUE, FALSE, 
            ], 
            'substitution with white spaces' => [
                'schema_blockd_0007.xsd', FALSE, FALSE, TRUE, 
            ], 
            'restriction and extension with white spaces' => [
                'schema_blockd_0008.xsd', TRUE, TRUE, FALSE, 
            ], 
            'substitution and restriction with white spaces' => [
                'schema_blockd_0009.xsd', TRUE, FALSE, TRUE, 
            ], 
            'extension and substitution with white spaces' => [
                'schema_blockd_0010.xsd', FALSE, TRUE, TRUE, 
            ], 
            'Duplicated restriction' => [
                'schema_blockd_0011.xsd', TRUE, FALSE, FALSE, 
            ], 
            'Duplicated extension' => [
                'schema_blockd_0012.xsd', FALSE, TRUE, FALSE, 
            ], 
            'Duplicated substitution' => [
                'schema_blockd_0013.xsd', FALSE, FALSE, TRUE, 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "elementFormDefault" attributes.
     * 
     * @return  array[]
     */
    public function getValidElementFormDefaultAttributes():array
    {
        // [ $fileName, $qualified, $unqualified, ]
        return [
            'qualified' => [
                'schema_eltfd_0001.xsd', TRUE, FALSE, 
            ], 
            'unqualified' => [
                'schema_eltfd_0002.xsd', FALSE, TRUE, 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "finalDefault" attributes.
     * 
     * @return  array[]
     */
    public function getValidFinalDefaultAttributes():array
    {
        // [ $fileName, $extension, $restriction, $list, $union, ]
        return [
            'Empty string' => [
                'schema_finald_0001.xsd', FALSE, FALSE, FALSE, FALSE, 
            ], 
            'Only white spaces' => [
                'schema_finald_0002.xsd', FALSE, FALSE, FALSE, FALSE, 
            ], 
            '#all' => [
                'schema_finald_0003.xsd', TRUE, TRUE, TRUE, TRUE, 
            ], 
            'extension, restriction, list and union with white spaces' => [
                'schema_finald_0004.xsd', TRUE, TRUE, TRUE, TRUE, 
            ], 
            'extension with white spaces' => [
                'schema_finald_0005.xsd', TRUE, FALSE, FALSE, FALSE, 
            ], 
            'restriction with white spaces' => [
                'schema_finald_0006.xsd', FALSE, TRUE, FALSE, FALSE, 
            ], 
            'list with white spaces' => [
                'schema_finald_0007.xsd', FALSE, FALSE, TRUE, FALSE, 
            ], 
            'union with white spaces' => [
                'schema_finald_0008.xsd', FALSE, FALSE, FALSE, TRUE, 
            ], 
            'extension and restriction with white spaces' => [
                'schema_finald_0009.xsd', TRUE, TRUE, FALSE, FALSE, 
            ], 
            'list and union with white spaces' => [
                'schema_finald_0010.xsd', FALSE, FALSE, TRUE, TRUE, 
            ], 
            'extension and union with white spaces' => [
                'schema_finald_0011.xsd', TRUE, FALSE, FALSE, TRUE, 
            ], 
            'restriction and list with white spaces' => [
                'schema_finald_0012.xsd', FALSE, TRUE, TRUE, FALSE, 
            ], 
            'extension and list with white spaces' => [
                'schema_finald_0013.xsd', TRUE, FALSE, TRUE, FALSE, 
            ], 
            'restriction and union with white spaces' => [
                'schema_finald_0014.xsd', FALSE, TRUE, FALSE, TRUE, 
            ], 
            'Duplicated extension' => [
                'schema_finald_0015.xsd', FALSE, FALSE, FALSE, TRUE, 
            ], 
            'Duplicated restriction' => [
                'schema_finald_0016.xsd', FALSE, TRUE, FALSE, FALSE, 
            ], 
            'Duplicated list' => [
                'schema_finald_0017.xsd', FALSE, FALSE, TRUE, FALSE, 
            ], 
        ];
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
                'schema_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'schema_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'schema_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'schema_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'schema_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'schema_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'schema_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'schema_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "xml:lang" attributes.
     * 
     * @return  array[]
     */
    public function getValidLangAttributes():array
    {
        return [
            'Primary subtag of 1 character' => [
                'schema_lang_0001.xsd', 
                'f', 
                [], 
            ], 
            'Primary subtag of 8 characters' => [
                'schema_lang_0002.xsd', 
                'foobarba', 
                [], 
            ], 
            'Subtag of 1 character' => [
                'schema_lang_0003.xsd', 
                'foo', 
                [ 'b' ], 
            ], 
            'Subtag with number' => [
                'schema_lang_0004.xsd', 
                'foo', 
                [ 'bar1' ], 
            ], 
            'Language with white spaces' => [
                'schema_lang_0005.xsd', 
                'foo', 
                [ 'bar1', 'baz2', 'qux3' ], 
            ], 
        ];
    }
}
