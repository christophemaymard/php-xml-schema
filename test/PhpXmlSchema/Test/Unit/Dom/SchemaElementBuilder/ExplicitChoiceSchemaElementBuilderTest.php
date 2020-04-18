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
use PhpXmlSchema\Test\Datatype\NonNegativeIntegerTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Dom\NonNegativeIntegerLimitTypeProviderTrait;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "choice" element (explicitGroup).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ExplicitChoiceSchemaElementBuilderTest extends AbstractChoiceSchemaElementBuilderTestCase
{
    use NonNegativeIntegerLimitTypeProviderTrait;
    use NonNegativeIntegerTypeProviderTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch): void
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct1 = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct1);
        self::assertComplexTypeElementHasNoAttribute($ct1);
        self::assertCount(1, $ct1->getElements());
        
        $cc = $ct1->getContentElement();
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(1, $elt->getElements());
        
        $ct2 = $elt->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct2);
        self::assertComplexTypeElementHasNoAttribute($ct2);
        self::assertCount(1, $ct2->getElements());
        self::assertNotNull($ct2->getTypeDefinitionParticleElement());
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
            ->getElementElements()[0]
            ->getTypeElement()
            ->getTypeDefinitionParticleElement();
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
        $this->sut->buildComplexTypeElement();
        $this->sut->buildChoiceElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildMaxOccursAttribute() creates the attribute when the 
     * current element is the "choice" element (explicitGroup) and the value 
     * is "unbounded".
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildMaxOccursAttributeCreatesAttrWhenExplicitChoiceAndValueIsUnbounded(): void
    {
        $this->sut->buildMaxOccursAttribute('unbounded');
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $choice = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasOnlyMaxOccursAttribute($choice);
        self::assertTrue($choice->getMaxOccurs()->isUnlimited());
        self::assertSame([], $choice->getElements());
    }
    
    /**
     * Tests that buildMaxOccursAttribute() creates the attribute when the 
     * current element is the "choice" element (explicitGroup) and the value 
     * is a valid non-negative integer.
     * 
     * @param   string  $value  The value to test.
     * @param   \GMP    $nni    The expected value for the non-negative integer.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNonNegativeIntegerTypeValues
     */
    public function testBuildMaxOccursAttributeCreatesAttrWhenExplicitChoiceAndValueIsNonNegativeInteger(
        string $value, 
        \GMP $nni
    ): void
    {
        $this->sut->buildMaxOccursAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $choice = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasOnlyMaxOccursAttribute($choice);
        self::assertEquals($nni, $choice->getMaxOccurs()->getLimit()->getNonNegativeInteger());
        self::assertSame([], $choice->getElements());
    }
    
    /**
     * Tests that buildMaxOccursAttribute() throws an exception when the 
     * current element is the "choice" element (explicitGroup) and the value 
     * is invalid.
     * 
     * @param   string  $value      The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNonNegativeIntegerLimitTypeValues
     * @dataProvider    getInvalidNonNegativeIntegerTypeValues
     */
    public function testBuildMaxOccursAttributeThrowsExceptionWhenExplicitChoiceAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid non-negative integer limit type.', $value));
        
        $this->sut->buildMaxOccursAttribute($value);
    }
    
    /**
     * Tests that buildMinOccursAttribute() creates the attribute when the 
     * current element is the "choice" element (explicitGroup) and the value 
     * is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   \GMP    $nni    The expected value for the non-negative integer.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNonNegativeIntegerTypeValues
     */
    public function testBuildMinOccursAttributeCreatesAttrWhenExplicitChoiceAndValueIsValid(
        string $value, 
        \GMP $nni
    ): void
    {
        $this->sut->buildMinOccursAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $choice = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasOnlyMinOccursAttribute($choice);
        self::assertEquals($nni, $choice->getMinOccurs()->getNonNegativeInteger());
        self::assertSame([], $choice->getElements());
    }
    
    /**
     * Tests that buildMinOccursAttribute() throws an exception when the 
     * current element is the "choice" element (explicitGroup) and the value 
     * is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNonNegativeIntegerTypeValues
     */
    public function testBuildMinOccursAttributeThrowsExceptionWhenExplicitChoiceAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid nonNegativeInteger datatype.', 
            $value
        ));
        
        $this->sut->buildMinOccursAttribute($value);
    }
}
