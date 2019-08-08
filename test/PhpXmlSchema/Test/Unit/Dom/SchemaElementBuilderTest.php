<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SchemaElementBuilderTest extends TestCase
{
    use ElementAssertTrait;
    
    /**
     * The system under test.
     * @var SchemaElementBuilder
     */
    private $sut;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that getSchema() returns the same instance of SchemaElement when 
     * instantiated.
     */
    public function testGetSchemaReturnsSameInstanceOfEmptySchemaElementWhenInstantiated()
    {
        $sch1 = $this->sut->getSchema();
        self::assertSchemaElementHasNoAttribute($sch1);
        self::assertSame([], $sch1->getElements());
        $sch2 = $this->sut->getSchema();
        self::assertSame($sch1, $sch2, 'Same instance of SchemaElement.');
    }
    
    /**
     * Tests that buildSchemaElement() creates an empty "schema" element and 
     * replaces the current one that is being built.
     */
    public function testBuildSchemaElementCreateNewInstanceOfEmptySchemaElement()
    {
        $sch1 = $this->sut->getSchema();
        $this->sut->buildSchemaElement();
        $sch2 = $this->sut->getSchema();
        self::assertSchemaElementHasNoAttribute($sch2);
        self::assertSame([], $sch2->getElements());
        self::assertNotSame($sch2, $sch1, 'Not same instance of SchemaElement.');
    }
    
    /**
     * Tests that buildAttributeFormDefaultAttribute() creates and sets a 
     * "qualified" FormType value in the "schema" element when the value is 
     * "qualified".
     * 
     * @group   attribute
     */
    public function testBuildAttributeFormDefaultAttributeWhenValueIsQualified()
    {
        $this->sut->buildAttributeFormDefaultAttribute('qualified');
        $sch = $this->sut->getSchema();
        
        self::assertTrue($sch->getAttributeFormDefault()->isQualified());
        self::assertSchemaElementHasOnlyAttributeFormDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildAttributeFormDefaultAttribute() creates and sets an 
     * "unqualified" FormType value in the "schema" element when the value is 
     * "unqualified".
     * 
     * @group   attribute
     */
    public function testBuildAttributeFormDefaultAttributeWhenValueIsUnqualified()
    {
        $this->sut->buildAttributeFormDefaultAttribute('unqualified');
        $sch = $this->sut->getSchema();
        
        self::assertTrue($sch->getAttributeFormDefault()->isUnqualified());
        self::assertSchemaElementHasOnlyAttributeFormDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildAttributeFormDefaultAttribute() throws an exception 
     * when the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @dataProvider    getInvalidFormeTypeValues
     */
    public function testBuildAttributeFormDefaultAttributeThrowsExceptionWhenValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid value for the "attributeFormDefault" '.
            'attribute (from no namespace), expected: "qualified" or '.
            '"unqualified".'
        );
        $this->sut->buildAttributeFormDefaultAttribute($value);
    }
    
    /**
     * Tests that buildBlockDefaultAttribute() creates and sets a 
     * DerivationType value in the "schema" element.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $res    The expected value for the "restriction" flag.
     * @param   bool    $ext    The expected value for the "extension" flag.
     * @param   bool    $sub    The expected value for the "substitution" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidBlockSetValues
     */
    public function testBuildBlockDefaultAttribute(
        string $value, 
        bool $res, 
        bool $ext, 
        bool $sub
    ) {
        $this->sut->buildBlockDefaultAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertSchemaElementBlockDefaultAttribute($res, $ext, $sub, $sch);
        self::assertSchemaElementHasOnlyBlockDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildBlockDefaultAttribute() throws an exception when the 
     * value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @dataProvider    getInvalidBlockSetValues
     */
    public function testBuildBlockDefaultAttributeThrowsExceptionWhenValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid value for the "blockDefault" '.
            'attribute (from no namespace), expected: "#all" or '.
            '"List of (extension | restriction | substitution)".'
        );
        
        $this->sut->buildBlockDefaultAttribute($value);
    }
    
    /**
     * Tests that buildElementFormDefaultAttribute() creates and sets a 
     * "qualified" FormType value in the "schema" element when the value is 
     * "qualified".
     * 
     * @group   attribute
     */
    public function testBuildElementFormDefaultAttributeWhenValueIsQualified()
    {
        $this->sut->buildElementFormDefaultAttribute('qualified');
        $sch = $this->sut->getSchema();
        
        self::assertTrue($sch->getElementFormDefault()->isQualified());
        self::assertSchemaElementHasOnlyElementFormDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildElementFormDefaultAttribute() creates and sets a 
     * "unqualified" FormType value in the "schema" element when the value is 
     * "unqualified".
     * 
     * @group   attribute
     */
    public function testBuildElementFormDefaultAttributeWhenValueIsUnqualified()
    {
        $this->sut->buildElementFormDefaultAttribute('unqualified');
        $sch = $this->sut->getSchema();
        
        self::assertTrue($sch->getElementFormDefault()->isUnqualified());
        self::assertSchemaElementHasOnlyElementFormDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildElementFormDefaultAttribute() throws an exception when 
     * the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @dataProvider    getInvalidFormeTypeValues
     */
    public function testBuildElementFormDefaultAttributeThrowsExceptionWhenValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid value for the "elementFormDefault" '.
            'attribute (from no namespace), expected: "qualified" or '.
            '"unqualified".'
        );
        
        $this->sut->buildElementFormDefaultAttribute($value);
    }
    
    /**
     * Tests that buildFinalDefaultAttribute() creates and sets a 
     * DerivationType value in the "schema" element.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $ext    The expected value for the "extension" flag.
     * @param   bool    $res    The expected value for the "restriction" flag.
     * @param   bool    $lst    The expected value for the "list" flag.
     * @param   bool    $unn    The expected value for the "union" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidFullDerivationSetValues
     */
    public function testBuildFinalDefaultAttribute(
        string $value,
        bool $ext, 
        bool $res, 
        bool $lst, 
        bool $unn
    ) {
        $this->sut->buildFinalDefaultAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertSchemaElementFinalDefaultAttribute($ext, $res, $lst, $unn, $sch);
        self::assertSchemaElementHasOnlyFinalDefaultAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildFinalDefaultAttribute() throws an exception when the 
     * value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @dataProvider    getInvalidFullDerivationSetValues
     */
    public function testBuildFinalDefaultAttributeThrowsExceptionWhenValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid value for the "finalDefault" '.
            'attribute (from no namespace), expected: "#all" or '.
            '"List of (extension | restriction | list | union)".'
        );
        
        $this->sut->buildFinalDefaultAttribute($value);
    }
    
    /**
     * Tests that buildIdAttribute() creates and sets an IDType value in the 
     * "id" attribute of the "schema" element.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @dataProvider    getValidIdValues
     */
    public function testBuildIdAttribute(string $value, string $id)
    {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertSame($id, $sch->getId()->getId());
        self::assertSchemaElementHasOnlyIdAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the value is 
     * invalid.
     * 
     * @group   attribute
     */
    public function testBuildIdAttributeThrowsExceptionWhenValueIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('"foo:bar" is an invalid ID.');
        
        $this->sut->buildIdAttribute('foo:bar');
    }
    
    /**
     * Tests that buildTargetNamespaceAttribute() creates and sets an 
     * AnyUriType value in the "targetNamespace" attribute of the "schema" 
     * element.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $uri    The expected value for the URI.
     * 
     * @group           attribute
     * @dataProvider    getValidAnyUriValues
     */
    public function testBuildTargetNamespaceAttribute(string $value, string $uri)
    {
        $this->sut->buildTargetNamespaceAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertSame($uri, $sch->getTargetNamespace()->getUri());
        self::assertSchemaElementHasOnlyTargetNamespaceAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildTargetNamespaceAttribute() throws an exception when 
     * the value is invalid.
     * 
     * @group   attribute
     */
    public function testBuildTargetNamespaceAttributeThrowsExceptionWhenValueIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        
        $this->sut->buildTargetNamespaceAttribute(':');
    }
    
    /**
     * Tests that buildVersionAttribute() creates and sets a TokenType value 
     * in the "version" attribute of the "schema" element.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $version    The expected value for the version.
     * 
     * @group           attribute
     * @dataProvider    getValidTokenValues
     */
    public function testBuildVersionAttribute(string $value, string $version)
    {
        $this->sut->buildVersionAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertSame($version, $sch->getVersion()->getString());
        self::assertSchemaElementHasOnlyVersionAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildVersionAttribute() throws an exception when the value 
     * is invalid.
     * 
     * @group   attribute
     */
    public function testBuildVersionAttributeThrowsExceptionWhenValueIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage("\"\u{001F}\" is an invalid token.");
        
        $this->sut->buildVersionAttribute("\u{001F}");
    }
    
    /**
     * Tests that buildLangAttribute() creates and sets a LanguageType value 
     * in the "xml:lang" attribute of the "schema" element.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $version    The expected value for the version.
     * 
     * @group           attribute
     * @dataProvider    getValidLanguageValues
     */
    public function testBuildLangAttribute(
        string $value, 
        string $primary,
        array $subtags
    ) {
        $this->sut->buildLangAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertSame($primary, $sch->getLang()->getPrimarySubtag());
        self::assertSame($subtags, $sch->getLang()->getSubtags());
        self::assertSchemaElementHasOnlyLangAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests that buildLangAttribute() throws an exception when the value is 
     * invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected message.
     * 
     * @group           attribute
     * @dataProvider    getInvalidLanguageValues
     */
    public function testBuildLangAttributeThrowsExceptionWhenValueIsInvalid(
        string $value,
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildLangAttribute($value);
    }
    
    /**
     * Tests that buildSourceAttribute() creates and sets an AnyUriType value 
     * in the "source" attribute of the "appinfo" element.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $uri    The expected value for the URI.
     * 
     * @group           attribute
     * @dataProvider    getValidAnyUriValues
     */
    public function testBuildSourceAttribute(string $value, string $uri)
    {
        $this->sut->buildCompositionAnnotationElement();
        $this->sut->buildAppInfoElement();
        $this->sut->buildSourceAttribute($value);
        $sch = $this->sut->getSchema();
        
        $appinfo = $sch->getCompositionAnnotationElements()[0]->getAppInfoElements()[0];
        self::assertSame($uri, $appinfo->getSource()->getUri());
    }
    
    /**
     * Tests that buildSourceAttribute() throws an exception when the value 
     * is invalid.
     * 
     * @group   attribute
     */
    public function testBuildSourceAttributeThrowsExceptionWhenValueIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        
        $this->sut->buildCompositionAnnotationElement();
        $this->sut->buildAppInfoElement();
        $this->sut->buildSourceAttribute(':');
    }
    
    /**
     * Tests building methods when the current element is NULL.
     */
    public function testBuildMethodsWhenCurrentElementIsNull()
    {
        $this->sut->endElement();
        $this->sut->endElement();
        
        // Uses methods, with invalid values, that must not build attributes.
        $this->sut->buildAttributeFormDefaultAttribute('foo');
        $this->sut->buildBlockDefaultAttribute('foo');
        $this->sut->buildElementFormDefaultAttribute('foo');
        $this->sut->buildFinalDefaultAttribute('foo');
        $this->sut->buildIdAttribute('foo:bar');
        $this->sut->buildSourceAttribute(':');
        $this->sut->buildTargetNamespaceAttribute(':');
        $this->sut->buildVersionAttribute("\u{001F}");
        $this->sut->buildLangAttribute(':');
        
        // Uses methods that must not build elements.
        $this->sut->buildCompositionAnnotationElement();
        $this->sut->buildAppInfoElement();
        $this->sut->buildDocumentationElement();
        
        // Uses method that must not build content.
        $this->sut->buildLeafElementContent('foo bar baz');
        
        $sch = $this->sut->getSchema();
        
        // Asserts "schema".
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertSame([], $sch->getElements());
    }
    
    /**
     * Tests building methods when the current element is a "schema" element.
     */
    public function testBuildMethodsWhenCurrentElementIsSchema()
    {
        // Uses methods, with invalid values, that must not build attributes.
        $this->sut->buildSourceAttribute(':');
        
        // Uses methods that must not build elements.
        $this->sut->buildAppInfoElement();
        $this->sut->buildDocumentationElement();
        
        // Uses method that must not build content.
        $this->sut->buildLeafElementContent('foo bar baz');
        
        // Uses methods, with valid values, that must build attributes.
        $this->sut->buildAttributeFormDefaultAttribute('qualified');
        $this->sut->buildBlockDefaultAttribute('extension');
        $this->sut->buildElementFormDefaultAttribute('unqualified');
        $this->sut->buildFinalDefaultAttribute('restriction');
        $this->sut->buildIdAttribute('schema');
        $this->sut->buildTargetNamespaceAttribute('http://example.org');
        $this->sut->buildVersionAttribute('1.0');
        $this->sut->buildLangAttribute('en-us');
        
        // Uses methods that must build elements.
        $this->sut->buildCompositionAnnotationElement();
        $this->sut->endElement();
        
        $sch = $this->sut->getSchema();
        
        // Asserts "schema".
        self::assertTrue($sch->getAttributeFormDefault()->isQualified());
        self::assertSchemaElementBlockDefaultAttribute(FALSE, TRUE, FALSE, $sch);
        self::assertTrue($sch->getElementFormDefault()->isUnqualified());
        self::assertSchemaElementFinalDefaultAttribute(FALSE, TRUE, FALSE, FALSE, $sch);
        self::assertSame('schema', $sch->getId()->getId());
        self::assertSame('http://example.org', $sch->getTargetNamespace()->getUri());
        self::assertSame('1.0', $sch->getVersion()->getString());
        self::assertSame('en', $sch->getLang()->getPrimarySubtag());
        self::assertSame(['us'], $sch->getLang()->getSubtags());
        self::assertCount(1, $sch->getElements());
        
        // Asserts "annotation" (composition).
        self::assertCount(1, $sch->getCompositionAnnotationElements());
        $ann1 = $sch->getCompositionAnnotationElements()[0];
        self::assertAnnotationElementHasNoAttribute($ann1);
        self::assertSame([], $ann1->getElements());
    }
    
    /**
     * Tests building methods when the current element is an "annotation" 
     * element.
     */
    public function testBuildMethodsWhenCurrentElementIsAnnotation()
    {
        $this->sut->buildCompositionAnnotationElement();
        
        // Uses methods, with invalid values, that must not build attributes.
        $this->sut->buildAttributeFormDefaultAttribute('foo');
        $this->sut->buildBlockDefaultAttribute('foo');
        $this->sut->buildElementFormDefaultAttribute('foo');
        $this->sut->buildFinalDefaultAttribute('foo');
        $this->sut->buildSourceAttribute(':');
        $this->sut->buildTargetNamespaceAttribute(':');
        $this->sut->buildVersionAttribute("\u{001F}");
        $this->sut->buildLangAttribute(':');
        
        // Uses methods that must not build elements.
        $this->sut->buildCompositionAnnotationElement();
        
        // Uses method that must not build content.
        $this->sut->buildLeafElementContent('foo bar baz');
        
        // Uses methods, with valid values, that must build attributes.
        $this->sut->buildIdAttribute('id');
        
        // Uses methods that must build elements.
        $this->sut->buildAppInfoElement();
        $this->sut->endElement();
        $this->sut->buildDocumentationElement();
        $this->sut->endElement();
        
        $sch = $this->sut->getSchema();
        
        // Asserts "schema".
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        // Asserts "annotation" (composition).
        self::assertCount(1, $sch->getCompositionAnnotationElements());
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertAnnotationElementHasOnlyIdAttribute($ann);
        self::assertSame('id', $ann->getId()->getId());
        self::assertCount(2, $ann->getElements());
        
        // Asserts "appinfo".
        $appinfo = $ann->getElements()[0];
        self::assertAppInfoElementHasNoAttribute($appinfo);
        self::assertSame('', $appinfo->getContent());
        
        // Asserts "documentation".
        $doc = $ann->getElements()[1];
        self::assertDocumentationElementHasNoAttribute($doc);
        self::assertSame('', $doc->getContent());
    }
    
    /**
     * Tests building methods when the current element is an "appinfo".
     */
    public function testBuildMethodsWhenCurrentElementIsAppInfo()
    {
        $this->sut->buildCompositionAnnotationElement();
        $this->sut->buildAppInfoElement();
        
        // Uses methods, with invalid values, that must not build attributes.
        $this->sut->buildAttributeFormDefaultAttribute('foo');
        $this->sut->buildBlockDefaultAttribute('foo');
        $this->sut->buildElementFormDefaultAttribute('foo');
        $this->sut->buildFinalDefaultAttribute('foo');
        $this->sut->buildIdAttribute('foo:bar');
        $this->sut->buildTargetNamespaceAttribute(':');
        $this->sut->buildVersionAttribute("\u{001F}");
        $this->sut->buildLangAttribute(':');
        
        // Uses methods that must not build elements.
        $this->sut->buildCompositionAnnotationElement();
        $this->sut->buildAppInfoElement();
        $this->sut->buildDocumentationElement();
        
        // Uses methods, with valid values, that must build attributes.
        $this->sut->buildSourceAttribute('http://example.org');
        
        // Uses method that must build content.
        $this->sut->buildLeafElementContent('foo bar baz');
        
        $sch = $this->sut->getSchema();
        
        // Asserts "schema".
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        // Asserts "annotation" (composition).
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(1, $ann->getElements());
        
        // Asserts "appinfo".
        $appinfo = $ann->getAppInfoElements()[0];
        self::assertAppInfoElementHasOnlySourceAttribute($appinfo);
        self::assertSame('http://example.org', $appinfo->getSource()->getUri());
        self::assertSame('foo bar baz', $appinfo->getContent());
    }
    
    /**
     * Tests building methods when the current element is a "documentation" 
     * element.
     */
    public function testBuildMethodsWhenCurrentElementIsDocumentation()
    {
        $this->sut->buildCompositionAnnotationElement();
        $this->sut->buildDocumentationElement();
        
        // Uses methods, with invalid values, that must not build attributes.
        $this->sut->buildAttributeFormDefaultAttribute('foo');
        $this->sut->buildBlockDefaultAttribute('foo');
        $this->sut->buildElementFormDefaultAttribute('foo');
        $this->sut->buildFinalDefaultAttribute('foo');
        $this->sut->buildIdAttribute('foo:bar');
        $this->sut->buildSourceAttribute(':');
        $this->sut->buildTargetNamespaceAttribute(':');
        $this->sut->buildVersionAttribute("\u{001F}");
        $this->sut->buildLangAttribute(':');
        
        // Uses methods that must not build elements.
        $this->sut->buildCompositionAnnotationElement();
        $this->sut->buildAppInfoElement();
        $this->sut->buildDocumentationElement();
        
        // Uses method that must build content.
        $this->sut->buildLeafElementContent('foo bar baz');
        
        $sch = $this->sut->getSchema();
        
        // Asserts "schema".
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        // Asserts "annotation" (composition).
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(1, $ann->getElements());
        
        // Asserts "documentation".
        $doc = $ann->getDocumentationElements()[0];
        self::assertDocumentationElementHasNoAttribute($doc);
        self::assertSame('foo bar baz', $doc->getContent());
    }
    
    /**
     * Returns a set of invalid FormeType values.
     * 
     * @return  array[]
     */
    public function getInvalidFormeTypeValues():array
    {
        return [
            '"Qualified"' => [ 
                'Qualified', 
            ],
            '"Unqualified"' => [ 
                'Unqualified', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "blockSet" values.
     * 
     * @return  array[]
     */
    public function getValidBlockSetValues():array
    {
        // [ $value, $restriction, $extension, $substitution, ]
        return [
            '' => [ 
                "", FALSE, FALSE, FALSE, 
            ],
            '#all' => [ 
                '#all', TRUE, TRUE, TRUE, 
            ],
            
            'restriction' => [ 
                "\t \r \n  restriction  ", TRUE, FALSE, FALSE, 
            ],
            'extension' => [ 
                " extension\r", FALSE, TRUE, FALSE, 
            ],
            'substitution' => [ 
                "   substitution   ", FALSE, FALSE, TRUE, 
            ],
            
            'restriction extension' => [ 
                "\t\t\t restriction \n   \rextension\n ", TRUE, TRUE, FALSE, 
            ],
            'substitution restriction' => [ 
                "\n\n\nsubstitution restriction", TRUE, FALSE, TRUE, 
            ],
            'extension substitution' => [ 
                "extension\t\t\tsubstitution\n\n\n", FALSE, TRUE, TRUE, 
            ],
            'restriction restriction' => [ 
                "    restriction      restriction   ", TRUE, FALSE, FALSE, 
            ],
            'extension extension' => [ 
                "extension extension", FALSE, TRUE, FALSE, 
            ],
            'substitution substitution' => [ 
                "substitution substitution", FALSE, FALSE, TRUE, 
            ],
            
            'substitution extension restriction' => [ 
                "substitution\t \r \nextension\t \r \nrestriction", TRUE, TRUE, TRUE, 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid "blockSet" values.
     * 
     * @return  array[]
     */
    public function getInvalidBlockSetValues():array
    {
        return [
            '#ALL' => [ 
                '#ALL', 
            ],
            'subStitution exTension Restriction' => [ 
                'subStitution exTension Restriction', 
            ],
            '#all substitution extension restriction' => [ 
                '#all substitution extension restriction', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "fullDerivationSet" values.
     * 
     * @return  array[]
     */
    public function getValidFullDerivationSetValues():array
    {
        // [ $value, $extension, $restriction, $list, $union, ]
        return [
            '' => [ 
                "", FALSE, FALSE, FALSE, FALSE, 
            ],
            '#all' => [ 
                '#all', TRUE, TRUE, TRUE, TRUE, 
            ],
            
            'extension' => [ 
                "\t \r \n  extension  ", TRUE, FALSE, FALSE, FALSE, 
            ],
            'restriction' => [ 
                " restriction\r", FALSE, TRUE, FALSE, FALSE, 
            ],
            'list' => [ 
                "   list   ", FALSE, FALSE, TRUE, FALSE, 
            ],
            'union' => [ 
                "   union   ", FALSE, FALSE, FALSE, TRUE, 
            ],
            
            'extension extension' => [ 
                "\t extension\r \n  extension  ", TRUE, FALSE, FALSE, FALSE, 
            ],
            'restriction restriction' => [ 
                "restriction restriction\r", FALSE, TRUE, FALSE, FALSE, 
            ],
            'list list' => [ 
                "  list list   ", FALSE, FALSE, TRUE, FALSE, 
            ],
            'union union' => [ 
                "   union union  ", FALSE, FALSE, FALSE, TRUE, 
            ],
            
            'extension restriction' => [ 
                "\t \r \n  extension   restriction\r", TRUE, TRUE, FALSE, FALSE, 
            ],
            'extension list' => [ 
                "\t \r \n  extension     list   ", TRUE, FALSE, TRUE, FALSE, 
            ],
            'extension union' => [ 
                "\t \r \n  extension     union   ", TRUE, FALSE, FALSE, TRUE, 
            ],
            'restriction extension' => [ 
                " restriction\r\t \r \n  extension  ", TRUE, TRUE, FALSE, FALSE, 
            ],
            'restriction list' => [ 
                " restriction\r   list   ", FALSE, TRUE, TRUE, FALSE, 
            ],
            'restriction union' => [ 
                " restriction\r   union   ", FALSE, TRUE, FALSE, TRUE, 
            ],
            'list extension' => [ 
                "   list \t \r \n  extension    ", TRUE, FALSE, TRUE, FALSE, 
            ],
            'list restriction' => [ 
                "   list  restriction\r  ", FALSE, TRUE, TRUE, FALSE, 
            ],
            'list union' => [ 
                "   list   union    ", FALSE, FALSE, TRUE, TRUE, 
            ],
            'union extension' => [ 
                "   union \r \n  extension  ", TRUE, FALSE, FALSE, TRUE, 
            ],
            'union restriction' => [ 
                "   union  restriction\r   ", FALSE, TRUE, FALSE, TRUE, 
            ],
            'union list' => [ 
                "   union \r \n list  ", FALSE, FALSE, TRUE, TRUE, 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid "fullDerivationSet" values.
     * 
     * @return  array[]
     */
    public function getInvalidFullDerivationSetValues():array
    {
        return [
            '#ALL' => [ 
                '#ALL', 
            ],
            'substitution' => [ 
                'substitution', 
            ],
            'list exTension union restriction' => [ 
                'list exTension union restriction', 
            ],
            'liSt extension union restriction' => [ 
                'liSt extension union restriction', 
            ],
            'list extension uniOn restriction' => [ 
                'list extension uniOn restriction', 
            ],
            'list extension union resTriction' => [ 
                'list extension union resTriction', 
            ],
            '#all extension restriction list union' => [ 
                '#all extension restriction list union', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid ID values.
     * 
     * @return  array[]
     */
    public function getValidIdValues():array
    {
        return [
            'foo' => [ 
                'foo', 'foo', 
            ],
            '  bar  ' => [ 
                '  bar  ', 'bar', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "anyURI" values.
     * 
     * @return  array[]
     */
    public function getValidAnyUriValues():array
    {
        return [
            'http://example.org' => [ 
                'http://example.org', 'http://example.org', 
            ],
            '  http://example.org  ' => [ 
                '  http://example.org  ', 'http://example.org', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "token" values.
     * 
     * @return  array[]
     */
    public function getValidTokenValues():array
    {
        return [
            'foo bar baz qux' => [ 
                'foo bar baz qux', 'foo bar baz qux', 
            ],
            '     foo       bar      baz      qux     ' => [ 
                '     foo       bar      baz      qux     ', 'foo bar baz qux', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "language" values.
     * 
     * @return  array[]
     */
    public function getValidLanguageValues():array
    {
        return [
            'fr' => [ 
                'fr', 'fr', [], 
            ],
            'en-us' => [ 
                'en-us', 'en', [ 'us', ], 
            ],
            'foo-bar1-baz2-qux3' => [ 
                'foo-bar1-baz2-qux3', 'foo', [ 'bar1', 'baz2', 'qux3', ], 
            ],
            '    foo-bar1-baz2-qux3    ' => [ 
                '    foo-bar1-baz2-qux3    ', 'foo', [ 'bar1', 'baz2', 'qux3', ], 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid "language" values.
     * 
     * @return  array[]
     */
    public function getInvalidLanguageValues():array
    {
        return [
            '' => [ 
                '', 
                '"" is an invalid primary subtag.', 
            ], 
            ' ' => [ 
                ' ', 
                '"" is an invalid primary subtag.', 
            ], 
            'foo9' => [ 
                'foo9', 
                '"foo9" is an invalid primary subtag.', 
            ], 
            'foo+' => [ 
                'foo+', 
                '"foo+" is an invalid primary subtag.', 
            ], 
            'veryverylongprimarytag' => [ 
                'veryverylongprimarytag', 
                '"veryverylongprimarytag" is an invalid primary subtag.', 
            ], 
            'foo-bar1-veryverylongsubtag' => [ 
                'foo-bar1-veryverylongsubtag', 
                '"veryverylongsubtag" is an invalid subtag.', 
            ],
            'foo-bar1-baz+' => [ 
                'foo-bar1-baz+', 
                '"baz+" is an invalid subtag.', 
            ], 
        ];
    }
}
