<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
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
use PhpXmlSchema\Dom\ComplexContentElement;
use PhpXmlSchema\Dom\ComplexContentExtensionElement;
use PhpXmlSchema\Dom\ComplexContentRestrictionElement;
use PhpXmlSchema\Dom\ComplexTypeElement;
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
use PhpXmlSchema\Dom\NotationElement;
use PhpXmlSchema\Dom\PatternElement;
use PhpXmlSchema\Dom\RedefineElement;
use PhpXmlSchema\Dom\SelectorElement;
use PhpXmlSchema\Dom\SequenceElement;
use PhpXmlSchema\Dom\SimpleContentElement;
use PhpXmlSchema\Dom\SimpleContentExtensionElement;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use PhpXmlSchema\Dom\SimpleTypeElement;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;
use PhpXmlSchema\Dom\TotalDigitsElement;
use PhpXmlSchema\Dom\UnionElement;
use PhpXmlSchema\Dom\UniqueElement;
use PhpXmlSchema\Dom\WhiteSpaceElement;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of element mocks.
 * 
 * It must be used in a class that extends the {@see PHPUnit\Framework\TestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait ElementMockFactoryTrait
{
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\AllElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAllElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(AllElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\AnnotationElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAnnotationElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(AnnotationElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\AnyAttributeElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAnyAttributeElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(AnyAttributeElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\AnyElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAnyElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(AnyElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\AppInfoElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAppInfoElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(AppInfoElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\AttributeElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAttributeElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(AttributeElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\AttributeGroupElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAttributeGroupElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(AttributeGroupElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\ChoiceElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createChoiceElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(ChoiceElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\ComplexContentElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createComplexContentElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(ComplexContentElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\ComplexContentExtensionElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createComplexContentExtensionElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(ComplexContentExtensionElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\ComplexContentRestrictionElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createComplexContentRestrictionElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(ComplexContentRestrictionElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\ComplexTypeElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createComplexTypeElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(ComplexTypeElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\DocumentationElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createDocumentationElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(DocumentationElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\ElementElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createElementElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(ElementElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\EnumerationElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createEnumerationElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(EnumerationElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\FieldElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createFieldElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(FieldElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\FractionDigitsElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createFractionDigitsElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(FractionDigitsElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\GroupElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createGroupElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(GroupElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\ImportElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createImportElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(ImportElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\IncludeElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createIncludeElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(IncludeElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\KeyElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createKeyElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(KeyElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\KeyRefElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createKeyRefElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(KeyRefElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\LengthElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createLengthElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(LengthElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\ListElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createListElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(ListElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\MaxExclusiveElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createMaxExclusiveElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(MaxExclusiveElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\MaxInclusiveElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createMaxInclusiveElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(MaxInclusiveElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\MaxLengthElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createMaxLengthElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(MaxLengthElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\MinExclusiveElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createMinExclusiveElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(MinExclusiveElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\MinInclusiveElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createMinInclusiveElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(MinInclusiveElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\MinLengthElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createMinLengthElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(MinLengthElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\NotationElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createNotationElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(NotationElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\PatternElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createPatternElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(PatternElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\RedefineElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createRedefineElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(RedefineElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\SelectorElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSelectorElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(SelectorElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\SequenceElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSequenceElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(SequenceElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\SimpleContentElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSimpleContentElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(SimpleContentElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\SimpleContentExtensionElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSimpleContentExtensionElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(SimpleContentExtensionElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\SimpleContentRestrictionElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSimpleContentRestrictionElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(SimpleContentRestrictionElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\SimpleTypeElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSimpleTypeElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(SimpleTypeElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\SimpleTypeRestrictionElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSimpleTypeRestrictionElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(SimpleTypeRestrictionElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\TotalDigitsElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createTotalDigitsElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(TotalDigitsElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\UnionElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createUnionElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(UnionElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\UniqueElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createUniqueElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(UniqueElement::class);
    }
    
    /**
     * Creates a mock for the {@see PhpXmlSchema\Dom\WhiteSpaceElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createWhiteSpaceElementHasParentFalse1TimeMock(): ProphecySubjectInterface
    {
        return $this->createElementHasParentFalse1TimeMock(WhiteSpaceElement::class);
    }
    
    /**
     * Creates a mock for an element, with the specified class name, where 
     * hasParent() returns FALSE and should be called once.
     * 
     * @param   string  $className  The element class name used to create a mock.
     * @return  ProphecySubjectInterface
     */
    protected function createElementHasParentFalse1TimeMock(string $className): ProphecySubjectInterface
    {
        $p = $this->prophesize($className);
        $p->hasParent()->willReturn(FALSE)->shouldBeCalledTimes(1);
        
        return $p->reveal();
    }
}