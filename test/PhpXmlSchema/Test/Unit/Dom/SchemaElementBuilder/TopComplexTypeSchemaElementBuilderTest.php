<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\ElementInterface;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Test\Unit\Dom\DerivationTypeProviderTrait;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "complexType" element 
 * (topLevelComplexType).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TopComplexTypeSchemaElementBuilderTest extends AbstractComplexTypeSchemaElementBuilderTestCase
{
    use DerivationTypeProviderTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch): void
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getComplexTypeElements());
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch): ?ElementInterface
    {
        return $sch->getComplexTypeElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildComplexTypeElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildAbstractAttribute() creates the attribute when the 
     * current element is the "complexType" element (topLevelComplexType) and 
     * the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $bool   The expected value for the boolean.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidBooleanTypeValues
     */
    public function testBuildAbstractAttributeCreatesAttrWhenTopComplexTypeAndValueIsValid(
        string $value, 
        bool $bool
    ): void
    {
        $this->sut->buildAbstractAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ct = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasOnlyAbstractAttribute($ct);
        self::assertSame($bool, $ct->getAbstract());
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that buildAbstractAttribute() throws an exception when the current 
     * element is the "complexType" element (topLevelComplexType) and the 
     * value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidBooleanTypeValues
     */
    public function testBuildAbstractAttributeThrowsExceptionWhenTopComplexTypeAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid boolean datatype.', $value));
        
        $this->sut->buildAbstractAttribute($value);
    }
    
    /**
     * Tests that buildBlockAttribute() creates the attribute when the 
     * current element is the "complexType" element (topLevelComplexType) and 
     * the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $ext    The expected value for the "extension" flag.
     * @param   bool    $res    The expected value for the "restriction" flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidDerivationSetTypeValues
     */
    public function testBuildBlockAttributeCreatesAttrWhenTopComplexTypeAndValueIsValid(
        string $value, 
        bool $ext, 
        bool $res
    ): void
    {
        $this->sut->buildBlockAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ct = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasOnlyBlockAttribute($ct);
        self::assertComplexTypeElementBlockAttribute($ext, $res, $ct);
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that buildBlockAttribute() throws an exception when the 
     * current element is the "complexType" element (topLevelComplexType) and 
     * the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidDerivationSetTypeValues
     */
    public function testBuildBlockAttributeThrowsExceptionWhenTopComplexTypeAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid derivationSet type, expected "#all" or a '.
            'list of "extension" and/or "restriction".', 
            $value
        ));
        
        $this->sut->buildBlockAttribute($value);
    }
    
    /**
     * Tests that buildFinalAttribute() creates the attribute when the 
     * current element is the "complexType" element (topLevelComplexType) and 
     * the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $ext    The expected value for the "extension" flag.
     * @param   bool    $res    The expected value for the "restriction" flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidDerivationSetTypeValues
     */
    public function testBuildFinalAttributeCreatesAttrWhenTopComplexTypeAndValueIsValid(
        string $value, 
        bool $ext, 
        bool $res
    ): void
    {
        $this->sut->buildFinalAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ct = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasOnlyFinalAttribute($ct);
        self::assertComplexTypeElementFinalAttribute($ext, $res, $ct);
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that buildFinalAttribute() throws an exception when the 
     * current element is the "complexType" element (topLevelComplexType) and 
     * the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidDerivationSetTypeValues
     */
    public function testBuildFinalAttributeThrowsExceptionWhenTopComplexTypeAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid derivationSet type, expected "#all" or a '.
            'list of "extension" and/or "restriction".', 
            $value
        ));
        
        $this->sut->buildFinalAttribute($value);
    }
    
    /**
     * Tests that buildNameAttribute() creates the attribute when the current 
     * element is the "complexType" element (topLevelComplexType) and the 
     * value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $name   The expected value for the name.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildNameAttributeCreatesAttrWhenTopComplexTypeAndValueIsValid(
        string $value, 
        string $name
    ): void
    {
        $this->sut->buildNameAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ct = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasOnlyNameAttribute($ct);
        self::assertSame($name, $ct->getName()->getNCName());
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that buildNameAttribute() throws an exception when the current 
     * element is the "complexType" element (topLevelComplexType) and the 
     * value is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildNameAttributeThrowsExceptionWhenTopComplexTypeAndValueIsInvalid(
        string $value, 
        string $mValue
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid NCName datatype.', 
            $mValue
        ));
        
        $this->sut->buildNameAttribute($value);
    }
}
