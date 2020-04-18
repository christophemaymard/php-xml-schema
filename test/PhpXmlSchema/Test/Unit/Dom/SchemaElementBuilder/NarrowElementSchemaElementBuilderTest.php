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
use PhpXmlSchema\Test\Datatype\NonNegativeIntegerTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Dom\FormChoiceTypeProviderTrait;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "element" element (narrowMaxMin).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NarrowElementSchemaElementBuilderTest extends AbstractElementSchemaElementBuilderTestCase
{
    use FormChoiceTypeProviderTrait;
    use NonNegativeIntegerTypeProviderTrait;
    
    use BuildFinalAttributeDoesNotCreateAttributeTestTrait;
    use BuildAbstractAttributeDoesNotCreateAttributeTestTrait;
    use BuildSubstitutionGroupAttributeDoesNotCreateAttributeTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch): void
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertCount(1, $all->getElements());
        self::assertCount(1, $all->getElementElements());
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch): ?ElementInterface
    {
        return $sch->getComplexTypeElements()[0]
            ->getContentElement()
            ->getDerivationElement()
            ->getTypeDefinitionParticleElement()
            ->getElementElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildComplexTypeElement();
        $this->sut->buildComplexContentElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildAllElement();
        $this->sut->buildElementElement();
    }
    
    /**
     * Tests that buildFormAttribute() creates the attribute when the current 
     * element is the "element" element (narrowMaxMin) and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $qual   The expected value for the "qualified flag.
     * @param   bool    $unqual The expected value for the "unqualified flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidFormChoiceTypeValues
     */
    public function testBuildFormAttributeCreatesAttrWhenNarrowElementAndValueIsValid(
        string $value, 
        bool $qual, 
        bool $unqual
    ): void
    {
        $this->sut->buildFormAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyFormAttribute($elt);
        self::assertSame($qual, $elt->getForm()->isQualified());
        self::assertSame($unqual, $elt->getForm()->isUnqualified());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildFormAttribute() throws an exception when the current 
     * element is the "element" element (narrowMaxMin) and the value is 
     * invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidFormChoiceTypeValues
     */
    public function testBuildFormAttributeThrowsExceptionWhenNarrowElementAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid formChoice type, expected "qualified" or "unqualified".', 
            $value
        ));
        $this->sut->buildFormAttribute($value);
    }
    
    /**
     * Tests that buildMaxOccursAttribute() creates the attribute when the 
     * current element is the "element" element (narrowMaxMin) and the value 
     * is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   \GMP    $nni    The expected value for the non-negative integer.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidZeroOrOneNonNegativeIntegerTypeValues
     */
    public function testBuildMaxOccursAttributeCreatesAttrWhenNarrowElementAndValueIsValid(
        string $value, 
        \GMP $nni
    ): void
    {
        $this->sut->buildMaxOccursAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyMaxOccursAttribute($elt);
        self::assertEquals($nni, $elt->getMaxOccurs()->getLimit()->getNonNegativeInteger());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildMaxOccursAttribute() throws an exception when the 
     * current element is the "element" element (narrowMaxMin) and the value 
     * is invalid.
     * 
     * @param   string  $value      The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidZeroOrOneNonNegativeIntegerTypeValues
     */
    public function testBuildMaxOccursAttributeThrowsExceptionWhenNarrowElementAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is invalid, expected "0" or "1".', $value));
        
        $this->sut->buildMaxOccursAttribute($value);
    }
    
    /**
     * Tests that buildMinOccursAttribute() creates the attribute when the 
     * current element is the "element" element (narrowMaxMin) and the value 
     * is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   \GMP    $nni    The expected value for the non-negative integer.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidZeroOrOneNonNegativeIntegerTypeValues
     */
    public function testBuildMinOccursAttributeCreatesAttrWhenNarrowElementAndValueIsValid(
        string $value, 
        \GMP $nni
    ): void
    {
        $this->sut->buildMinOccursAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyMinOccursAttribute($elt);
        self::assertEquals($nni, $elt->getMinOccurs()->getNonNegativeInteger());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildMinOccursAttribute() throws an exception when the 
     * current element is the "element" element (narrowMaxMin) and the value 
     * is invalid.
     * 
     * @param   string  $value      The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidZeroOrOneNonNegativeIntegerTypeValues
     */
    public function testBuildMinOccursAttributeThrowsExceptionWhenNarrowElementAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is invalid, expected "0" or "1".', $value));
        
        $this->sut->buildMinOccursAttribute($value);
    }
    
    /**
     * Tests that buildRefAttribute() creates the attribute when:
     * - the current element is the "element" element (narrowMaxMin), and 
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
    public function testBuildRefAttributeCreatesAttrWhenNarrowElementAndValueIsValidQNameLocalPartAndNoDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildRefAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyRefAttribute($elt);
        self::assertSame($localPart, $elt->getRef()->getLocalPart()->getNCName());
        self::assertFalse($elt->getRef()->hasNamespace());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildRefAttribute() creates the attribute when:
     * - the current element is the "element" element (narrowMaxMin), and 
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
    public function testBuildRefAttributeCreatesAttrWhenNarrowElementAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildComplexTypeElement();
        $this->sut->buildComplexContentElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildAllElement();
        $this->sut->buildElementElement();
        $this->sut->buildRefAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['' => 'http://example.org' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertCount(1, $all->getElements());
        self::assertCount(1, $all->getElementElements());
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyRefAttribute($elt);
        self::assertSame($localPart, $elt->getRef()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $elt->getRef()->getNamespace()->getAnyUri());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildRefAttribute() throws an exception when the current 
     * element is the "element" element (narrowMaxMin) and the value is an 
     * invalid QName.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidQNameTypeValues
     */
    public function testBuildRefAttributeThrowsExceptionWhenNarrowElementAndValueIsInvalid(
        string $value, 
        string $message
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildRefAttribute($value);
    }
    
    /**
     * Tests that buildRefAttribute() creates the attribute when:
     * - the current element is the "element" element (narrowMaxMin), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildRefAttributeCreatesAttrWhenNarrowElementAndValueIsValidAndPrefixAssociatedNamespace(): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildComplexTypeElement();
        $this->sut->buildComplexContentElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildAllElement();
        $this->sut->buildElementElement();
        $this->sut->buildRefAttribute('foo:bar');
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['foo' => 'http://example.org/foo' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertCount(1, $all->getElements());
        self::assertCount(1, $all->getElementElements());
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyRefAttribute($elt);
        self::assertSame('bar', $elt->getRef()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $elt->getRef()->getNamespace()->getAnyUri());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildRefAttribute() throws an exception when:
     * - the current element is the "element" element (narrowMaxMin), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is not associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildRefAttributeThrowsExceptionWhenNarrowElementAndValueIsValidAndPrefixNotAssociatedNamespace(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" prefix is not bound to a namespace.');
        
        $this->sut->buildRefAttribute('foo:bar');
    }
    
    /**
     * Tests that buildTypeAttribute() creates the attribute when:
     * - the current element is the "element" element (narrowMaxMin), and 
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
    public function testBuildTypeAttributeCreatesAttrWhenNarrowElementAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildComplexTypeElement();
        $this->sut->buildComplexContentElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildAllElement();
        $this->sut->buildElementElement();
        $this->sut->buildTypeAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['' => 'http://example.org' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertCount(1, $all->getElements());
        self::assertCount(1, $all->getElementElements());
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyTypeAttribute($elt);
        self::assertSame($localPart, $elt->getType()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $elt->getType()->getNamespace()->getAnyUri());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that buildTypeAttribute() creates the attribute when:
     * - the current element is the "element" element (narrowMaxMin), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildTypeAttributeCreatesAttrWhenNarrowElementAndValueIsValidAndPrefixAssociatedNamespace(): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildComplexTypeElement();
        $this->sut->buildComplexContentElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildAllElement();
        $this->sut->buildElementElement();
        $this->sut->buildTypeAttribute('foo:bar');
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['foo' => 'http://example.org/foo' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertCount(1, $all->getElements());
        self::assertCount(1, $all->getElementElements());
        
        $elt = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyTypeAttribute($elt);
        self::assertSame('bar', $elt->getType()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $elt->getType()->getNamespace()->getAnyUri());
        self::assertSame([], $elt->getElements());
    }
}
