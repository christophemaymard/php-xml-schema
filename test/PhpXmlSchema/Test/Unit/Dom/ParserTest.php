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
     * The system under test.
     * @var Parser
     */
    private $sut;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new Parser();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
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
        
        $this->sut->parse($this->getXs('schema', 'schema_0001.xsd'));
    }
    
    /**
     * Tests that parse() returns an empty "schema" element.
     */
    public function testParseReturnsEmptySchema()
    {
        $sch = $this->sut->parse($this->getXs('schema', 'schema_0004.xsd'));
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() skip all nodes before the root element.
     */
    public function testParseSkipAllNodesBeforeRootElement()
    {
        $sch = $this->sut->parse($this->getXs('schema', 'schema_0005.xsd'));
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "attributeFormDefault" attribute with 
     * "qualified" value.
     * 
     * @group   attribute
     */
    public function testParseProcessAttributeFormDefaultAttributeWithQualifiedInSchemaElement()
    {
        $sch = $this->sut->parse($this->getXs('schema', 'attr_attrfd_0001.xsd'));
        
        self::assertTrue($sch->getAttributeFormDefault()->isQualified());
        self::assertSchemaElementHasOnlyAttributeFormDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "attributeFormDefault" attribute with 
     * "unqualified" value.
     * 
     * @group   attribute
     */
    public function testParseProcessAttributeFormDefaultAttributeWithUnqualifiedInSchemaElement()
    {
        $sch = $this->sut->parse($this->getXs('schema', 'attr_attrfd_0002.xsd'));
        
        self::assertTrue($sch->getAttributeFormDefault()->isUnqualified());
        self::assertSchemaElementHasOnlyAttributeFormDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "blockDefault" attribute in a "schema" 
     * element.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   bool    $res        The expected value for the "restriction" flag.
     * @param   bool    $ext        The expected value for the "extension" flag.
     * @param   bool    $sub        The expected value for the "substitution" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidBlockDefaultAttributes
     */
    public function testParseProcessBlockDefaultAttributeInSchemaElement(
        string $fileName,
        bool $res, 
        bool $ext, 
        bool $sub
    ) {
        $sch = $this->sut->parse($this->getXs('schema', $fileName));
        
        self::assertSchemaElementBlockDefaultAttribute($res, $ext, $sub, $sch);
        self::assertSchemaElementHasOnlyBlockDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "elementFormDefault" attribute in a 
     * "schema" element with "qualified" value.
     * 
     * @group   attribute
     */
    public function testParseProcessElementFormDefaultAttributeWithQualifiedInSchemaElement()
    {
        $sch = $this->sut->parse($this->getXs('schema', 'attr_eltfd_0001.xsd'));
        
        self::assertTrue($sch->getElementFormDefault()->isQualified());
        self::assertSchemaElementHasOnlyElementFormDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "elementFormDefault" attribute in a 
     * "schema" element with "unqualified" value.
     * 
     * @group   attribute
     */
    public function testParseProcessElementFormDefaultAttributeWithUnqualifiedInSchemaElement()
    {
        $sch = $this->sut->parse($this->getXs('schema', 'attr_eltfd_0002.xsd'));
        
        self::assertTrue($sch->getElementFormDefault()->isUnqualified());
        self::assertSchemaElementHasOnlyElementFormDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "finalDefault" attribute in a "schema" 
     * element.
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
    public function testParseProcessFinalDefaultAttributeInSchemaElement(
        string $fileName,
        bool $ext, 
        bool $res, 
        bool $lst, 
        bool $unn
    ) {
        $sch = $this->sut->parse($this->getXs('schema', $fileName));
        
        self::assertSchemaElementFinalDefaultAttribute($ext, $res, $lst, $unn, $sch);
        self::assertSchemaElementHasOnlyFinalDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "id" attribute in a "schema" element.
     * 
     * @group   attribute
     */
    public function testParseProcessIdAttributeInSchemaElement()
    {
        $sch = $this->sut->parse($this->getXs('schema', 'attr_id_0001.xsd'));
        
        self::assertSame('foo', $sch->getId()->getId());
        self::assertSchemaElementHasOnlyIdAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "targetNamespace" attribute in a "schema" 
     * element.
     * 
     * @group   attribute
     */
    public function testParseProcessTargetNamespaceAttributeInSchemaElement()
    {
        $sch = $this->sut->parse($this->getXs('schema', 'attr_target_0001.xsd'));
        
        self::assertSame('http://example.org', $sch->getTargetNamespace()->getUri());
        self::assertSchemaElementHasOnlyTargetNamespaceAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "version" attribute in a "schema" element.
     * 
     * @group   attribute
     */
    public function testParseProcessVersionAttributeInSchemaElement()
    {
        $sch = $this->sut->parse($this->getXs('schema', 'attr_version_0001.xsd'));
        
        self::assertSame('foo bar baz qux', $sch->getVersion()->getString());
        self::assertSchemaElementHasOnlyVersionAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "xml:lang" attribute in a "schema" 
     * element.
     * 
     * @group   attribute
     */
    public function testParseProcessLangAttributeInSchemaElement()
    {
        $sch = $this->sut->parse($this->getXs('schema', 'attr_lang_0001.xsd'));
        
        self::assertSame('Foo', $sch->getLang()->getPrimarySubtag());
        self::assertSame([ 'Bar1', 'baZ2', 'qUx3', ], $sch->getLang()->getSubtags());
        self::assertSchemaElementHasOnlyLangAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes all the attributes in a "schema" element.
     * 
     * @group   attribute
     */
    public function testParseProcessAllAttributesInSchemaElement()
    {
        $sch = $this->sut->parse($this->getXs('schema', 'schema_0006.xsd'));
        
        self::assertTrue($sch->getAttributeFormDefault()->isUnqualified());
        self::assertSchemaElementBlockDefaultAttribute(FALSE, TRUE, FALSE, $sch);
        self::assertTrue($sch->getElementFormDefault()->isQualified());
        self::assertSchemaElementFinalDefaultAttribute(FALSE, TRUE, FALSE, FALSE, $sch);
        self::assertSame('schema', $sch->getId()->getId());
        self::assertSame('http://example.org', $sch->getTargetNamespace()->getUri());
        self::assertSame('1.0', $sch->getVersion()->getString());
        self::assertSame('en', $sch->getLang()->getPrimarySubtag());
        self::assertSame([ 'us', ], $sch->getLang()->getSubtags());
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() processes "annotation" elements (composition) in a 
     * "schema" element.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessCompositionAnnotationElementInSchemaElement()
    {
        $sch = $this->sut->parse($this->getXs('annotation', 'schema_0002.xsd'));
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        $anns = $sch->getCompositionAnnotationElements();
        self::assertCount(2, $anns);
        self::assertAnnotationElementHasNoAttribute($anns[0]);
        self::assertAnnotationElementHasNoAttribute($anns[1]);
    }
    
    /**
     * Tests that parse() processes "id" attribute in an "annotation" element 
     * (composition).
     * 
     * @group   attribute
     */
    public function testParseProcessIdAttributeInCompositionAnnotationElement()
    {
        $sch = $this->sut->parse($this->getXs('annotation', 'attr_id_0001.xsd'));
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertSame('foo', $ann->getId()->getId());
        self::assertAnnotationElementHasOnlyIdAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that parse() processes "appinfo" elements in an "annotation" 
     * element (composition).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAppInfoElementInCompositionAnnotationElement()
    {
        $sch = $this->sut->parse($this->getXs('annotation', 'appinfo_0002.xsd'));
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(2, $ann->getElements());
        
        $appinfos = $ann->getAppInfoElements();
        self::assertAppInfoElementHasNoAttribute($appinfos[0]);
        self::assertSame('foo', $appinfos[0]->getContent());
        self::assertAppInfoElementHasNoAttribute($appinfos[1]);
        self::assertSame('bar', $appinfos[1]->getContent());
    }
    
    /**
     * Tests that parse() processes "source" attribute in an "appinfo" 
     * element.
     * 
     * @group   attribute
     */
    public function testParseProcessSourceAttributeInAppInfoElement()
    {
        $sch = $this->sut->parse($this->getXs('annotation', 'appinfo_0003.xsd'));
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(1, $ann->getElements());
        
        $appinfo = $ann->getAppInfoElements()[0];
        self::assertAppInfoElementHasOnlySourceAttribute($appinfo);
        self::assertSame('http://example.org', $appinfo->getSource()->getUri());
        self::assertSame('', $appinfo->getContent());
    }
    
    /**
     * Tests that parse() processes "documentation" elements in an 
     * "annotation" element (composition).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessDocumentationElementInCompositionAnnotationElement()
    {
        $sch = $this->sut->parse($this->getXs('annotation', 'documentation_0002.xsd'));
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(2, $ann->getElements());
        
        $docs = $ann->getDocumentationElements();
        self::assertDocumentationElementHasNoAttribute($docs[0]);
        self::assertSame('foo', $docs[0]->getContent());
        self::assertDocumentationElementHasNoAttribute($docs[1]);
        self::assertSame('bar', $docs[1]->getContent());
    }
    
    /**
     * Tests that parse() processes "source" attribute in a "documentation" 
     * element.
     * 
     * @group   attribute
     */
    public function testParseProcessSourceAttributeInDocumentationElement()
    {
        $sch = $this->sut->parse($this->getXs('annotation', 'documentation_0003.xsd'));
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(1, $ann->getElements());
        
        $doc = $ann->getDocumentationElements()[0];
        self::assertDocumentationElementHasOnlySourceAttribute($doc);
        self::assertSame('http://example.org', $doc->getSource()->getUri());
        self::assertSame('', $doc->getContent());
    }
    
    /**
     * Tests that parse() processes "xml:lang" attribute in a "documentation" 
     * element.
     * 
     * @group   attribute
     */
    public function testParseProcessLangAttributeInDocumentationElement()
    {
        $sch = $this->sut->parse($this->getXs('annotation', 'documentation_0005.xsd'));
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(1, $ann->getElements());
        
        $doc = $ann->getDocumentationElements()[0];
        self::assertDocumentationElementHasOnlyLangAttribute($doc);
        self::assertSame('Foo', $doc->getLang()->getPrimarySubtag());
        self::assertSame([ 'Bar1', 'baZ2', 'qUx3', ], $doc->getLang()->getSubtags());
        self::assertSame('', $doc->getContent());
    }
    
    /**
     * Tests that parse() processes "import" elements in a "schema" element.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessImportElementInSchemaElement()
    {
        $sch = $this->sut->parse($this->getXs('extern', 'import_0002.xsd'));
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(2, $sch->getElements());
        
        $imp1 = $sch->getImportElements()[0];
        self::assertImportElementHasNoAttribute($imp1);
        self::assertCount(0, $imp1->getElements());
        
        $imp2 = $sch->getImportElements()[0];
        self::assertImportElementHasNoAttribute($imp2);
        self::assertCount(0, $imp2->getElements());
    }
    
    /**
     * Tests that parse() processes "id" attribute in an "import" element.
     * 
     * @group   attribute
     */
    public function testParseProcessIdAttributeInImportElement()
    {
        $sch = $this->sut->parse($this->getXs('extern', 'import_0003.xsd'));
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $imp = $sch->getImportElements()[0];
        self::assertSame('import_id', $imp->getId()->getId());
        self::assertImportElementHasOnlyIdAttribute($imp);
        self::assertSame([], $imp->getElements());
    }
    
    /**
     * Tests that parse() throws an exception when the content is invalid.
     * 
     * @param   string  $dir        The directory of the file to test.
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $exception  The expected exception class name.
     * @param   string  $message    The expected exception message.
     * 
     * @group           content
     * @group           element
     * @dataProvider    getInvalidContents
     */
    public function testParseThrowsExceptionWhenContentIsInvalid(
        string $dir, 
        string $fileName, 
        string $exception, 
        string $message
    ) {
        $this->expectException($exception);
        $this->expectExceptionMessage($message);
        
        $this->sut->parse($this->getXs($dir, $fileName));
    }
    
    /**
     * Tests that parse() throws an exception when the attribute is invalid.
     * 
     * @param   string  $dir        The directory of the file to test.
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $exception  The expected exception class name.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @dataProvider    getInvalidAttributeValues
     */
    public function testParseThrowsExceptionWhenAttributeValueIsInvalid(
        string $dir, 
        string $fileName, 
        string $exception, 
        string $message
    ) {
        $this->expectException($exception);
        $this->expectExceptionMessage($message);
        
        $this->sut->parse($this->getXs($dir, $fileName));
    }
    
    /**
     * Returns a set of valid "blockDefault" attribute in a "schema" element.
     * 
     * @return  array[]
     */
    public function getValidBlockDefaultAttributes():array
    {
        // [ $fileName, $restriction, $extension, $substitution, ]
        return [
            'Empty' => [ 
                'attr_blockd_0001.xsd', FALSE, FALSE, FALSE, 
            ],
            ' #all ' => [ 
                'attr_blockd_0002.xsd', TRUE, TRUE, TRUE, 
            ],
            '    substitution    extension     restriction     ' => [ 
                'attr_blockd_0003.xsd', TRUE, TRUE, TRUE, 
            ],
            'restriction' => [ 
                'attr_blockd_0004.xsd', TRUE, FALSE, FALSE, 
            ],
            'extension' => [ 
                'attr_blockd_0005.xsd', FALSE, TRUE, FALSE, 
            ],
            'substitution' => [ 
                'attr_blockd_0006.xsd', FALSE, FALSE, TRUE, 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "finalDefault" attribute in a "schema" element.
     * 
     * @return  array[]
     */
    public function getValidFinalDefaultAttributes():array
    {
        // [ $fileName, $extension, $restriction, $list, $union, ]
        return [
            'Empty' => [ 
                'attr_finald_0001.xsd', FALSE, FALSE, FALSE, FALSE, 
            ],
            '#all' => [ 
                'attr_finald_0002.xsd', TRUE, TRUE, TRUE, TRUE, 
            ],
            'list restriction union extension' => [ 
                'attr_finald_0003.xsd', TRUE, TRUE, TRUE, TRUE, 
            ],
            'restriction restriction restriction' => [ 
                'attr_finald_0004.xsd', FALSE, TRUE, FALSE, FALSE, 
            ],
            '    union     list    ' => [ 
                'attr_finald_0005.xsd', FALSE, FALSE, TRUE, TRUE, 
            ],
        ];
    }
    
    /**
     * Returns a set of tests related to invalid content.
     * 
     * @return  array[]
     */
    public function getInvalidContents():array
    {
        return $this->createDataSets('content');
    }
    
    /**
     * Returns a set of tests related to invalid attribute.
     * 
     * @return  array[]
     */
    public function getInvalidAttributeValues():array
    {
        return $this->createDataSets('attribute');
    }
    
    /**
     * 
     * @param   string  $group
     */
    private function createDataSets(string $group):array
    {
        $sxe = \simplexml_load_file(
            __DIR__.'/../../../../../res/test/unit/parser/parser_test_set.xml'
        );
        
        $datasets = [];
        
        foreach($sxe->children() as $test) {
            if ($test['group'] != $group) {
                continue;
            }
            
            $datasets[(string)$test['name']] = [ 
                (string)$test->schema['dir'], 
                (string)$test->schema['fileName'], 
                (string)$test->schema->exception, 
                (string)$test->schema->message, 
            ];
        }
        
        return $datasets;
    }
    
    /**
     * Returns the content of the specified filename located at the specified  
     * directory.
     * 
     * @param   string  $dir        The directory of the file.
     * @param   string  $fileName   The name of the file.
     * @return  string
     */
    private function getXs(string $dir, string $fileName):string
    {
        return \file_get_contents(
            __DIR__.'/../../../../../res/test/unit/parser/'.$dir.'/'.$fileName
        );
    }
}
