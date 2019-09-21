<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Test\Unit\Dom\DerivationTypeProviderTrait;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "simpleType" element 
 * (topLevelSimpleType).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TopSimpleTypeSchemaElementBuilderTest extends AbstractSimpleTypeSchemaElementBuilderTestCase
{
    use DerivationTypeProviderTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch)
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getSimpleTypeElements());
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch)
    {
        return $sch->getSimpleTypeElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildSimpleTypeElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildFinalAttribute() creates the attribute when the 
     * current element is the "simpleType" element (topLevelSimpleType) and 
     * the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $list   The expected value for the "list" flag.
     * @param   bool    $union  The expected value for the "union" flag.
     * @param   bool    $res    The expected value for the "restriction" flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidSimpleDerivationSetTypeValues
     */
    public function testBuildFinalAttributeCreatesAttrWhenTopSimpleTypeAndValueIsValid(
        string $value, 
        bool $list, 
        bool $union, 
        bool $res
    ) {
        $this->sut->buildFinalAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $st = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasOnlyFinalAttribute($st);
        self::assertSimpleTypeElementFinalAttribute($list, $union, $res, $st);
        self::assertSame([], $st->getElements());
    }
    
    /**
     * Tests that buildFinalAttribute() throws an exception when the current 
     * element is the "simpleType" element (topLevelSimpleType) and the value 
     * is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidSimpleDerivationSetTypeValues
     */
    public function testBuildFinalAttributeThrowsExceptionWhenTopSimpleTypeAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid simpleDerivationSet type, expected "#all" '.
            'or a list of "list", "union" and/or "restriction".', 
            $value
        ));
        
        $this->sut->buildFinalAttribute($value);
    }
    
    /**
     * Tests that buildNameAttribute() creates the attribute when the current 
     * element is the "simpleType" element (topLevelSimpleType) and the value 
     * is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $name   The expected value for the name.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNCNameTypeWSValues
     */
    public function testBuildNameAttributeCreatesAttrWhenTopSimpleTypeAndValueIsValid(
        string $value, 
        string $name
    ) {
        $this->sut->buildNameAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $st = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasOnlyNameAttribute($st);
        self::assertSame($name, $st->getName()->getNCName());
        self::assertSame([], $st->getElements());
    }
    
    /**
     * Tests that buildNameAttribute() throws an exception when the current 
     * element is the "simpleType" element (topLevelSimpleType) and the value 
     * is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNCNameTypeWSValues
     */
    public function testBuildNameAttributeThrowsExceptionWhenTopSimpleTypeAndValueIsInvalid(
        string $value, 
        string $mValue
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid NCName datatype.', 
            $mValue
        ));
        
        $this->sut->buildNameAttribute($value);
    }
}
