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
     * Tests that getSchema() returns the same instance of SchemaElement when 
     * instantiated.
     */
    public function testGetSchemaReturnsSameInstanceOfEmptySchemaElementWhenInstantiated()
    {
        $sut = new SchemaElementBuilder();
        $sch1 = $sut->getSchema();
        self::assertSchemaElementEmpty($sch1);
        $sch2 = $sut->getSchema();
        self::assertSame($sch1, $sch2, 'Same instance of SchemaElement.');
    }
    
    /**
     * Tests that buildSchemaElement() creates an empty "schema" element and 
     * replaces the current one that is being built.
     */
    public function testBuildSchemaElementCreateNewInstanceOfEmptySchemaElement()
    {
        $sut = new SchemaElementBuilder();
        $sch1 = $sut->getSchema();
        $sut->buildSchemaElement();
        $sch2 = $sut->getSchema();
        self::assertSchemaElementEmpty($sch2);
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
        $sut = new SchemaElementBuilder();
        $sut->buildAttributeFormDefaultAttribute('qualified');
        $sch = $sut->getSchema();
        self::assertTrue($sch->getAttributeFormDefault()->isQualified());
        self::assertFalse($sch->hasBlockDefault());
        self::assertFalse($sch->hasElementFormDefault());
        self::assertFalse($sch->hasFinalDefault());
        self::assertFalse($sch->hasId());
        self::assertFalse($sch->hasTargetNamespace());
        self::assertFalse($sch->hasVersion());
        self::assertFalse($sch->hasLang());
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
        $sut = new SchemaElementBuilder();
        $sut->buildAttributeFormDefaultAttribute('unqualified');
        $sch = $sut->getSchema();
        self::assertTrue($sch->getAttributeFormDefault()->isUnqualified());
        self::assertFalse($sch->hasBlockDefault());
        self::assertFalse($sch->hasElementFormDefault());
        self::assertFalse($sch->hasFinalDefault());
        self::assertFalse($sch->hasId());
        self::assertFalse($sch->hasTargetNamespace());
        self::assertFalse($sch->hasVersion());
        self::assertFalse($sch->hasLang());
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
        $sut = new SchemaElementBuilder();
        $sut->buildAttributeFormDefaultAttribute($value);
    }
    
    /**
     * Tests that buildBlockDefaultAttribute() creates and sets a 
     * DerivationType value in the "schema" element.
     * 
     * @param   string  $value          The value to test.
     * @param   bool    $restriction    The expected value for the "restriction" flag.
     * @param   bool    $extension      The expected value for the "extension" flag.
     * @param   bool    $substitution   The expected value for the "substitution" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidBlockSetValues
     */
    public function testBuildBlockDefaultAttribute(
        string $value,
        bool $restriction, 
        bool $extension, 
        bool $substitution
    ) {
        $sut = new SchemaElementBuilder();
        $sut->buildBlockDefaultAttribute($value);
        $sch = $sut->getSchema();
        
        self::assertSame($extension, $sch->getBlockDefault()->byExtension());
        self::assertFalse($sch->getBlockDefault()->byList());
        self::assertSame($restriction, $sch->getBlockDefault()->byRestriction());
        self::assertSame($substitution, $sch->getBlockDefault()->bySubstitution());
        self::assertFalse($sch->getBlockDefault()->byUnion());
        
        self::assertFalse($sch->hasAttributeFormDefault());
        self::assertFalse($sch->hasElementFormDefault());
        self::assertFalse($sch->hasFinalDefault());
        self::assertFalse($sch->hasId());
        self::assertFalse($sch->hasTargetNamespace());
        self::assertFalse($sch->hasVersion());
        self::assertFalse($sch->hasLang());
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
        $sut = new SchemaElementBuilder();
        $sut->buildBlockDefaultAttribute($value);
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
        $sut = new SchemaElementBuilder();
        $sut->buildElementFormDefaultAttribute('qualified');
        $sch = $sut->getSchema();
        self::assertTrue($sch->getElementFormDefault()->isQualified());
        
        self::assertFalse($sch->hasAttributeFormDefault());
        self::assertFalse($sch->hasBlockDefault());
        self::assertFalse($sch->hasFinalDefault());
        self::assertFalse($sch->hasId());
        self::assertFalse($sch->hasTargetNamespace());
        self::assertFalse($sch->hasVersion());
        self::assertFalse($sch->hasLang());
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
        $sut = new SchemaElementBuilder();
        $sut->buildElementFormDefaultAttribute('unqualified');
        $sch = $sut->getSchema();
        self::assertTrue($sch->getElementFormDefault()->isUnqualified());
        
        self::assertFalse($sch->hasAttributeFormDefault());
        self::assertFalse($sch->hasBlockDefault());
        self::assertFalse($sch->hasFinalDefault());
        self::assertFalse($sch->hasId());
        self::assertFalse($sch->hasTargetNamespace());
        self::assertFalse($sch->hasVersion());
        self::assertFalse($sch->hasLang());
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
        $sut = new SchemaElementBuilder();
        $sut->buildElementFormDefaultAttribute($value);
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
}
