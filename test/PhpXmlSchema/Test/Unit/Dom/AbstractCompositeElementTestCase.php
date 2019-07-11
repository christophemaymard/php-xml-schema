<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\AllElement;
use PhpXmlSchema\Dom\AnnotationElement;
use PhpXmlSchema\Dom\AnyAttributeElement;
use PhpXmlSchema\Dom\AnyElement;
use PhpXmlSchema\Dom\AppInfoElement;
use PhpXmlSchema\Dom\AttributeElement;
use PhpXmlSchema\Dom\AttributeGroupElement;
use PhpXmlSchema\Dom\ChoiceElement;
use PhpXmlSchema\Dom\ComplexContentDerivationElementInterface;
use PhpXmlSchema\Dom\ComplexContentElement;
use PhpXmlSchema\Dom\ComplexContentExtensionElement;
use PhpXmlSchema\Dom\ComplexContentRestrictionElement;
use PhpXmlSchema\Dom\ComplexTypeElement;
use PhpXmlSchema\Dom\ContentElementInterface;
use PhpXmlSchema\Dom\DocumentationElement;
use PhpXmlSchema\Dom\ElementElement;
use PhpXmlSchema\Dom\EnumerationElement;
use PhpXmlSchema\Dom\FieldElement;
use PhpXmlSchema\Dom\FractionDigitsElement;
use PhpXmlSchema\Dom\GroupElement;
use PhpXmlSchema\Dom\ImportElement;
use PhpXmlSchema\Dom\IncludeElement;
use PhpXmlSchema\Dom\KeyElement;
use PhpXmlSchema\Dom\KeyRefElement;
use PhpXmlSchema\Dom\LengthElement;
use PhpXmlSchema\Dom\ListElement;
use PhpXmlSchema\Dom\MaxExclusiveElement;
use PhpXmlSchema\Dom\MaxInclusiveElement;
use PhpXmlSchema\Dom\MaxLengthElement;
use PhpXmlSchema\Dom\MinExclusiveElement;
use PhpXmlSchema\Dom\MinInclusiveElement;
use PhpXmlSchema\Dom\MinLengthElement;
use PhpXmlSchema\Dom\ModelGroupElementInterface;
use PhpXmlSchema\Dom\NotationElement;
use PhpXmlSchema\Dom\PatternElement;
use PhpXmlSchema\Dom\RedefineElement;
use PhpXmlSchema\Dom\SelectorElement;
use PhpXmlSchema\Dom\SequenceElement;
use PhpXmlSchema\Dom\SimpleContentDerivationElementInterface;
use PhpXmlSchema\Dom\SimpleContentElement;
use PhpXmlSchema\Dom\SimpleContentExtensionElement;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use PhpXmlSchema\Dom\SimpleTypeDerivationElementInterface;
use PhpXmlSchema\Dom\SimpleTypeElement;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;
use PhpXmlSchema\Dom\TotalDigitsElement;
use PhpXmlSchema\Dom\TypeDefinitionParticleElementInterface;
use PhpXmlSchema\Dom\TypeElementInterface;
use PhpXmlSchema\Dom\UnionElement;
use PhpXmlSchema\Dom\UniqueElement;
use PhpXmlSchema\Dom\WhiteSpaceElement;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the base class for all the composite element test cases.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractCompositeElementTestCase extends AbstractAbstractElementTestCase
{
    /**
     * Tests that getElements() returns an empty array when no element has 
     * been added.
     * 
     * @group   content
     */
    public function testGetElementsReturnsEmptyArrayWhenNoElementHasBeenAdded()
    {
        self::assertSame([], $this->sut->getElements(), 'No element has been added.');
    }
    
    /**
     * Tests that hasId() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasId()
    {
        self::assertFalse($this->sut->hasId(), 'The attribute has not been set.');
        
        $this->sut->setId($this->createIDTypeDummy());
        self::assertTrue($this->sut->hasId(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getId() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetId()
    {
        self::assertNull($this->sut->getId(), 'The attribute has not been set.');
        
        $value1 = $this->createIDTypeDummy();
        $this->sut->setId($value1);
        self::assertSame($value1, $this->sut->getId(), 'Set the attribute with a value: IDType.');
        
        $value2 = $this->createIDTypeDummy();
        $this->sut->setId($value2);
        self::assertSame($value2, $this->sut->getId(), 'Set the attribute with another value: IDType.');
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\AllElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAllElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(AllElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\AnnotationElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAnnotationElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(AnnotationElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\AnyAttributeElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAnyAttributeElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(AnyAttributeElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\AnyElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAnyElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(AnyElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\AppInfoElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAppInfoElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(AppInfoElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\AttributeElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAttributeElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(AttributeElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\AttributeGroupElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAttributeGroupElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(AttributeGroupElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ChoiceElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createChoiceElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ChoiceElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ComplexContentDerivationElementInterface} 
     * interface.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createComplexContentDerivationElementInterfaceDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ComplexContentDerivationElementInterface::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ComplexContentElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createComplexContentElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ComplexContentElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ComplexContentExtensionElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createComplexContentExtensionElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ComplexContentExtensionElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ComplexContentRestrictionElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createComplexContentRestrictionElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ComplexContentRestrictionElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ComplexTypeElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createComplexTypeElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ComplexTypeElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ContentElementInterface} 
     * interface.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createContentElementInterfaceDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ContentElementInterface::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\DocumentationElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createDocumentationElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(DocumentationElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ElementElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createElementElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ElementElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\EnumerationElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createEnumerationElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(EnumerationElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\FieldElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createFieldElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(FieldElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\FractionDigitsElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createFractionDigitsElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(FractionDigitsElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\GroupElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createGroupElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(GroupElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ImportElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createImportElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ImportElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\IncludeElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createIncludeElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(IncludeElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\KeyElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createKeyElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(KeyElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\KeyRefElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createKeyRefElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(KeyRefElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\LengthElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createLengthElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(LengthElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ListElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createListElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ListElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\MaxExclusiveElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createMaxExclusiveElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(MaxExclusiveElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\MaxInclusiveElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createMaxInclusiveElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(MaxInclusiveElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\MaxLengthElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createMaxLengthElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(MaxLengthElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\MinExclusiveElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createMinExclusiveElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(MinExclusiveElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\MinInclusiveElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createMinInclusiveElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(MinInclusiveElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\MinLengthElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createMinLengthElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(MinLengthElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ModelGroupElementInterface} 
     * interface.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createModelGroupElementInterfaceDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ModelGroupElementInterface::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\NotationElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createNotationElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(NotationElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\PatternElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createPatternElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(PatternElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\RedefineElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createRedefineElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(RedefineElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\SelectorElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSelectorElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(SelectorElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\SequenceElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSequenceElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(SequenceElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\SimpleContentDerivationElementInterface} 
     * interface.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSimpleContentDerivationElementInterfaceDummy():ProphecySubjectInterface
    {
        return $this->prophesize(SimpleContentDerivationElementInterface::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\SimpleContentElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSimpleContentElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(SimpleContentElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\SimpleContentExtensionElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSimpleContentExtensionElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(SimpleContentExtensionElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\SimpleContentRestrictionElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSimpleContentRestrictionElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(SimpleContentRestrictionElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\SimpleTypeDerivationElementInterface} 
     * interface.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSimpleTypeDerivationElementInterfaceDummy():ProphecySubjectInterface
    {
        return $this->prophesize(SimpleTypeDerivationElementInterface::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\SimpleTypeElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSimpleTypeElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(SimpleTypeElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\SimpleTypeRestrictionElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSimpleTypeRestrictionElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(SimpleTypeRestrictionElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\TotalDigitsElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createTotalDigitsElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(TotalDigitsElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\TypeDefinitionParticleElementInterface} 
     * interface.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createTypeDefinitionParticleElementInterfaceDummy():ProphecySubjectInterface
    {
        return $this->prophesize(TypeDefinitionParticleElementInterface::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\TypeElementInterface} 
     * interface.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createTypeElementInterfaceDummy():ProphecySubjectInterface
    {
        return $this->prophesize(TypeElementInterface::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\UnionElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createUnionElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(UnionElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\UniqueElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createUniqueElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(UniqueElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\WhiteSpaceElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createWhiteSpaceElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(WhiteSpaceElement::class)->reveal();
    }
}
