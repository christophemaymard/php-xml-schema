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
use PhpXmlSchema\Exception\InvalidOperationException;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "element" element (topLevelElement).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TopElementSchemaElementBuilderTest extends AbstractElementSchemaElementBuilderTestCase
{
    use BuildFormAttributeDoesNotCreateAttributeTestTrait;
    use BuildRefAttributeDoesNotCreateAttributeTestTrait;
    use BuildMaxOccursAttributeDoesNotCreateAttributeTestTrait;
    use BuildMinOccursAttributeDoesNotCreateAttributeTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch): void
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getElementElements());
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch): ?ElementInterface
    {
        return $sch->getElementElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildElementElement();
    }
    
    /**
     * Tests that buildAbstractAttribute() creates the attribute when the 
     * current element is the "element" element (topLevelElement) and the 
     * value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $bool   The expected value for the boolean.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidBooleanTypeValues
     */
    public function testBuildAbstractAttributeCreatesAttrWhenTopElementAndValueIsValid(
        string $value, 
        bool $bool
    ): void
    {
        $this->sut->buildAbstractAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyAbstractAttribute($elt);
        self::assertSame($bool, $elt->getAbstract());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildAbstractAttribute() throws an exception when the current 
     * element is the "element" element (topLevelElement) and the value is 
     * invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidBooleanTypeValues
     */
    public function testBuildAbstractAttributeThrowsExceptionWhenTopElementAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid boolean datatype.', $value));
        
        $this->sut->buildAbstractAttribute($value);
    }
    
    /**
     * Tests that buildFinalAttribute() creates the attribute when the 
     * current element is the "element" element (topLevelElement) and the 
     * value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $ext    The expected value for the "extension" flag.
     * @param   bool    $res    The expected value for the "restriction" flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidDerivationSetTypeValues
     */
    public function testBuildFinalAttributeCreatesAttrWhenTopElementAndValueIsValid(
        string $value, 
        bool $ext, 
        bool $res
    ): void
    {
        $this->sut->buildFinalAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyFinalAttribute($elt);
        self::assertElementElementFinalAttribute($ext, $res, $elt);
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildFinalAttribute() throws an exception when the 
     * current element is the "element" element (topLevelElement) and the 
     * value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidDerivationSetTypeValues
     */
    public function testBuildFinalAttributeThrowsExceptionWhenTopElementAndValueIsInvalid(
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
     * Tests that buildSubstitutionGroupAttribute() creates the attribute 
     * when:
     * - the current element is the "element" element (topLevelElement), and 
     * - the value is a valid QName (local part without prefix), and 
     * - no default namespace.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidLocalPartQNameTypeValues
     */
    public function testBuildSubstitutionGroupAttributeCreatesAttrWhenTopElementAndValueIsValidQNameLocalPartAndNoDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildSubstitutionGroupAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlySubstitutionGroupAttribute($elt);
        self::assertSame($localPart, $elt->getSubstitutionGroup()->getLocalPart()->getNCName());
        self::assertFalse($elt->getSubstitutionGroup()->hasNamespace());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildSubstitutionGroupAttribute() creates the attribute 
     * when:
     * - the current element is the "element" element (topLevelElement), and 
     * - the value is a valid QName (local part without prefix), and 
     * - default namespace.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidLocalPartQNameTypeValues
     */
    public function testBuildSubstitutionGroupAttributeCreatesAttrWhenTopElementAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildElementElement();
        $this->sut->buildSubstitutionGroupAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['' => 'http://example.org' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getElementElements());
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlySubstitutionGroupAttribute($elt);
        self::assertSame($localPart, $elt->getSubstitutionGroup()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $elt->getSubstitutionGroup()->getNamespace()->getAnyUri());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildSubstitutionGroupAttribute() throws an exception when 
     * the current element is the "element" element (topLevelElement) and the 
     * value is an invalid QName.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidQNameTypeValues
     */
    public function testBuildSubstitutionGroupAttributeThrowsExceptionWhenTopElementAndValueIsInvalid(
        string $value, 
        string $message
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildSubstitutionGroupAttribute($value);
    }
    
    /**
     * Tests that buildSubstitutionGroupAttribute() creates the attribute 
     * when:
     * - the current element is the "element" element (topLevelElement), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildSubstitutionGroupAttributeCreatesAttrWhenTopElementAndValueIsValidAndPrefixAssociatedNamespace(): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildElementElement();
        $this->sut->buildSubstitutionGroupAttribute('foo:bar');
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['foo' => 'http://example.org/foo' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getElementElements());
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlySubstitutionGroupAttribute($elt);
        self::assertSame('bar', $elt->getSubstitutionGroup()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $elt->getSubstitutionGroup()->getNamespace()->getAnyUri());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildSubstitutionGroupAttribute() throws an exception when:
     * - the current element is the "element" element (topLevelElement), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is not associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildSubstitutionGroupAttributeThrowsExceptionWhenTopElementAndValueIsValidAndPrefixNotAssociatedNamespace(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" prefix is not bound to a namespace.');
        
        $this->sut->buildSubstitutionGroupAttribute('foo:bar');
    }
    
    /**
     * Tests that buildTypeAttribute() creates the attribute when:
     * - the current element is the "element" element (topLevelElement), and 
     * - the value is a valid QName (local part without prefix), and 
     * - default namespace.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidLocalPartQNameTypeValues
     */
    public function testBuildTypeAttributeCreatesAttrWhenTopElementAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildElementElement();
        $this->sut->buildTypeAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['' => 'http://example.org' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getElementElements());
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyTypeAttribute($elt);
        self::assertSame($localPart, $elt->getType()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $elt->getType()->getNamespace()->getAnyUri());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildTypeAttribute() creates the attribute 
     * when:
     * - the current element is the "element" element (topLevelElement), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildTypeAttributeCreatesAttrWhenTopElementAndValueIsValidAndPrefixAssociatedNamespace(): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildElementElement();
        $this->sut->buildTypeAttribute('foo:bar');
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['foo' => 'http://example.org/foo' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getElementElements());
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyTypeAttribute($elt);
        self::assertSame('bar', $elt->getType()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $elt->getType()->getNamespace()->getAnyUri());
        self::assertSame([], $elt->getElements());
    }
}
