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
}
