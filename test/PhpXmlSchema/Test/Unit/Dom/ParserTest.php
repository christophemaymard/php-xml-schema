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
use PhpXmlSchema\Exception\InvalidOperationException;

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
        $sut->parse($this->getSchemaXs('error_0001.xsd'));
    }
    
    /**
     * Tests that parse() throws an expcetion when the root element is not 
     * part of the XML Schema 1.0 namespace.
     */
    public function testParseThrowsExceptionWhenRootNotPartOfXs10()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The root element must belong to '.
            'the XML Schema 1.0 namespace.');
        
        $sut = new Parser();
        $sut->parse($this->getSchemaXs('error_0002.xsd'));
    }
    
    /**
     * Tests that parse() throws an expcetion when the root element is not 
     * the "schema" element.
     */
    public function testParseThrowsExceptionWhenRootNotSchemaElement()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" element '.
            '(from http://www.w3.org/2001/XMLSchema namespace) is '.
            'unexpected, expected: "schema".');
        
        $sut = new Parser();
        $sut->parse($this->getSchemaXs('error_0003.xsd'));
    }
    
    /**
     * Tests that parse() returns an empty "schema" element.
     */
    public function testParseReturnsEmptySchema()
    {
        $sut = new Parser();
        $sch = $sut->parse($this->getSchemaXs('schema_0001.xsd'));
        self::assertSchemaElementEmpty($sch);
    }
    
    /**
     * Tests that parse() skip all nodes before the root element.
     */
    public function testParseSkipAllNodesBeforeRootElement()
    {
        $sut = new Parser();
        $sch = $sut->parse($this->getSchemaXs('schema_0002.xsd'));
        self::assertSchemaElementEmpty($sch);
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
        $sch = $sut->parse($this->getSchemaXs('attr_attrfd_0001.xsd'));
        
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
        $sch = $sut->parse($this->getSchemaXs('attr_attrfd_0002.xsd'));
        
        self::assertTrue($sch->getAttributeFormDefault()->isUnqualified());
        self::assertSchemaElementHasOnlyAttributeFormDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
     }
    
    /**
     * Tests that parse() throws an exception when the value of the 
     * "attributeFormDefault" attribute is invalid.
     * 
     * @group   attribute
     */
    public function testParseThrowsExceptionWhenAttributeFormDefaultIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"foo" is an invalid value for the "attributeFormDefault" '.
            'attribute (from no namespace), expected: "qualified" or '.
            '"unqualified".'
        );
        
        $sut = new Parser();
        $sut->parse($this->getSchemaXs('attr_attrfd_0003.xsd'));
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
        $sch = $sut->parse($this->getSchemaXs($fileName));
        
        self::assertSchemaElementBlockDefaultAttribute($res, $ext, $sub, $sch);
        self::assertSchemaElementHasOnlyBlockDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() throws an exception when the value of the 
     * "blockDefault" attribute is invalid in a "schema" element.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $value      The invalid value.
     * 
     * @group           attribute
     * @dataProvider    getInvalidBlockDefaultAttributes
     */
    public function testParseThrowsExceptionWhenBlockDefaultIsInvalidInSchemaElement(
        string $fileName,
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid value for the "blockDefault" '.
            'attribute (from no namespace), expected: "#all" or '.
            '"List of (extension | restriction | substitution)".'
        );
        
        $sut = new Parser();
        $sut->parse($this->getSchemaXs($fileName));
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
        $sch = $sut->parse($this->getSchemaXs('attr_eltfd_0001.xsd'));
        
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
        $sch = $sut->parse($this->getSchemaXs('attr_eltfd_0002.xsd'));
        
        self::assertTrue($sch->getElementFormDefault()->isUnqualified());
        self::assertSchemaElementHasOnlyElementFormDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() throws an exception when the value of the 
     * "elementFormDefault" attribute in a "schema" element is invalid.
     * 
     * @group   attribute
     */
    public function testParseThrowsExceptionWhenElementFormDefaultAttributeInSchemaElementIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"foo" is an invalid value for the "elementFormDefault" '.
            'attribute (from no namespace), expected: "qualified" or '.
            '"unqualified".'
        );
        
        $sut = new Parser();
        $sut->parse($this->getSchemaXs('attr_eltfd_0003.xsd'));
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
        $sch = $sut->parse($this->getSchemaXs($fileName));
        
        self::assertSchemaElementFinalDefaultAttribute($ext, $res, $lst, $unn, $sch);
        self::assertSchemaElementHasOnlyFinalDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() throws an exception when the value of the 
     * "finalDefault" attribute is invalid in a "schema" element.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $value      The invalid value.
     * 
     * @group           attribute
     * @dataProvider    getInvalidFinalDefaultAttributes
     */
    public function testParseThrowsExceptionWhenFinalDefaultIsInvalidInSchemaElement(
        string $fileName,
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid value for the "finalDefault" '.
            'attribute (from no namespace), expected: "#all" or '.
            '"List of (extension | restriction | list | union)".'
        );
        
        $sut = new Parser();
        $sut->parse($this->getSchemaXs($fileName));
    }
    
    /**
     * Tests that parse() processes "id" attribute in a "schema" element.
     * 
     * @group   attribute
     */
    public function testParseProcessIdAttributeInSchemaElement()
    {
        $sut = new Parser();
        $sch = $sut->parse($this->getSchemaXs('attr_id_0001.xsd'));
        
        self::assertSame('foo', $sch->getId()->getId());
        self::assertSchemaElementHasOnlyIdAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() throws an exception when the value of the 
     * "id" attribute is invalid in a "schema" element.
     * 
     * @group   attribute
     */
    public function testParseThrowsExceptionWhenIdIsInvalidInSchemaElement()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('"foo:bar" is an invalid ID.');
        
        $sut = new Parser();
        $sut->parse($this->getSchemaXs('attr_id_0002.xsd'));
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
        $sch = $sut->parse($this->getSchemaXs('attr_target_0001.xsd'));
        
        self::assertSame('http://example.org', $sch->getTargetNamespace()->getUri());
        self::assertSchemaElementHasOnlyTargetNamespaceAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() throws an exception when the value of the 
     * "id" attribute is invalid in a "schema" element.
     * 
     * @group   attribute
     */
    public function testParseThrowsExceptionWhenTargetNamespaceAttributeIsInvalidInSchemaElement()
    {
        $this->expectException(InvalidValueException::class);
        
        $sut = new Parser();
        $sut->parse($this->getSchemaXs('attr_target_0002.xsd'));
    }
    
    /**
     * Tests that parse() processes "version" attribute in a "schema" element.
     * 
     * @group   attribute
     */
    public function testParseProcessVersionAttributeInSchemaElement()
    {
        $sut = new Parser();
        $sch = $sut->parse($this->getSchemaXs('attr_version_0001.xsd'));
        
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
        $sch = $sut->parse($this->getSchemaXs('attr_lang_0001.xsd'));
        
        self::assertSame('Foo', $sch->getLang()->getPrimarySubtag());
        self::assertSame([ 'Bar1', 'baZ2', 'qUx3', ], $sch->getLang()->getSubtags());
        self::assertSchemaElementHasOnlyLangAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that parse() throws an exception when the value of the 
     * "xml:lang" attribute is invalid in a "schema" element.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @dataProvider    getInvalidLangAttributes
     */
    public function testParseThrowsExceptionWhenLangAttributeIsInvalidInSchemaElement(
        string $fileName, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $sut = new Parser();
        $sut->parse($this->getSchemaXs($fileName));
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
     * Returns a set of invalid "blockDefault" attribute in a "schema" element.
     * 
     * @return  array[]
     */
    public function getInvalidBlockDefaultAttributes():array
    {
        return [
            '  foo  ' => [ 
                'attr_blockd_0007.xsd', '  foo  ', 
            ],
            '#ALL' => [ 
                'attr_blockd_0008.xsd', '#ALL', 
            ],
            'subStitution exTension Restriction' => [ 
                'attr_blockd_0009.xsd', 'subStitution exTension Restriction', 
            ],
            '#all substitution extension restriction' => [ 
                'attr_blockd_0010.xsd', '#all substitution extension restriction', 
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
     * Returns a set of invalid "finalDefault" attribute in a "schema" element.
     * 
     * @return  array[]
     */
    public function getInvalidFinalDefaultAttributes():array
    {
        return [
            'foo' => [ 
                'attr_finald_0006.xsd', 'foo', 
            ],
            '#ALL' => [ 
                'attr_finald_0007.xsd', '#ALL', 
            ],
            'extension liSt' => [ 
                'attr_finald_0008.xsd', 'extension liSt', 
            ],
            '#all extension restriction list union' => [ 
                'attr_finald_0009.xsd', '#all extension restriction list union', 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid "finalDefault" attribute in a "schema" element.
     * 
     * @return  array[]
     */
    public function getInvalidLangAttributes():array
    {
        return [
            '' => [ 
                'attr_lang_0002.xsd', 
                '"" is an invalid primary subtag.', 
            ],
            ' ' => [ 
                'attr_lang_0003.xsd', 
                '"" is an invalid primary subtag.', 
            ],
            'foo9' => [ 
                'attr_lang_0004.xsd', 
                '"foo9" is an invalid primary subtag.', 
            ],
            'foo+' => [ 
                'attr_lang_0005.xsd', 
                '"foo+" is an invalid primary subtag.', 
            ],
            'veryverylongprimarytag' => [ 
                'attr_lang_0006.xsd', 
                '"veryverylongprimarytag" is an invalid primary subtag.', 
            ],
            'foo-bar1-veryverylongsubtag' => [ 
                'attr_lang_0007.xsd', 
                '"veryverylongsubtag" is an invalid subtag.', 
            ],
            'foo-bar1-baz+' => [ 
                'attr_lang_0008.xsd', 
                '"baz+" is an invalid subtag.', 
            ],
        ];
    }
    
    /**
     * Returns the content of the specified filename located at the "schema" 
     * directory.
     * 
     * @param   string  $fileName
     * @return  string
     */
    private function getSchemaXs(string $fileName):string
    {
        return \file_get_contents(
            __DIR__.'/../../../../../res/test/unit/parser/schema/'.$fileName
        );
    }
}
