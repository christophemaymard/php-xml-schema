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
        $sut->parse($this->getXs('schema', 'schema_0001.xsd'));
    }
    
    /**
     * Tests that parse() returns an empty "schema" element.
     */
    public function testParseReturnsEmptySchema()
    {
        $sut = new Parser();
        $sch = $sut->parse($this->getXs('schema', 'schema_0004.xsd'));
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() skip all nodes before the root element.
     */
    public function testParseSkipAllNodesBeforeRootElement()
    {
        $sut = new Parser();
        $sch = $sut->parse($this->getXs('schema', 'schema_0005.xsd'));
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
        $sut = new Parser();
        $sch = $sut->parse($this->getXs('schema', 'attr_attrfd_0001.xsd'));
        
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
        $sut = new Parser();
        $sch = $sut->parse($this->getXs('schema', 'attr_attrfd_0002.xsd'));
        
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
        $sut = new Parser();
        $sch = $sut->parse($this->getXs('schema', $fileName));
        
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
        $sut = new Parser();
        $sch = $sut->parse($this->getXs('schema', 'attr_eltfd_0001.xsd'));
        
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
        $sut = new Parser();
        $sch = $sut->parse($this->getXs('schema', 'attr_eltfd_0002.xsd'));
        
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
        $sut = new Parser();
        $sch = $sut->parse($this->getXs('schema', $fileName));
        
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
        $sut = new Parser();
        $sch = $sut->parse($this->getXs('schema', 'attr_id_0001.xsd'));
        
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
        $sut = new Parser();
        $sch = $sut->parse($this->getXs('schema', 'attr_target_0001.xsd'));
        
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
        $sut = new Parser();
        $sch = $sut->parse($this->getXs('schema', 'attr_version_0001.xsd'));
        
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
        $sut = new Parser();
        $sch = $sut->parse($this->getXs('schema', 'attr_lang_0001.xsd'));
        
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
        $sut = new Parser();
        $sch = $sut->parse($this->getXs('schema', 'schema_0006.xsd'));
        
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
        
        $sut = new Parser();
        $sut->parse($this->getXs($dir, $fileName));
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
        
        $sut = new Parser();
        $sut->parse($this->getXs($dir, $fileName));
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
