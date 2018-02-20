<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\AnnotationElement;
use PhpXmlSchema\Dom\AppInfoElement;
use PhpXmlSchema\Dom\AttributeElement;
use PhpXmlSchema\Dom\AttributeGroupElement;
use PhpXmlSchema\Dom\ComplexTypeElement;
use PhpXmlSchema\Dom\DocumentationElement;
use PhpXmlSchema\Dom\ElementElement;
use PhpXmlSchema\Dom\FieldElement;
use PhpXmlSchema\Dom\GroupElement;
use PhpXmlSchema\Dom\ImportElement;
use PhpXmlSchema\Dom\IncludeElement;
use PhpXmlSchema\Dom\KeyElement;
use PhpXmlSchema\Dom\KeyRefElement;
use PhpXmlSchema\Dom\ListElement;
use PhpXmlSchema\Dom\NotationElement;
use PhpXmlSchema\Dom\RedefineElement;
use PhpXmlSchema\Dom\SelectorElement;
use PhpXmlSchema\Dom\SimpleTypeDerivationElementInterface;
use PhpXmlSchema\Dom\SimpleTypeElement;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;
use PhpXmlSchema\Dom\TypeElementInterface;
use PhpXmlSchema\Dom\UnionElement;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the base class for all the composite element test cases.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractCompositeElementTestCase extends AbstractElementTestCase
{
    /**
     * Tests that getElements() returns an empty array when no element has 
     * been added.
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsEmptyArrayWhenNoElementHasBeenAdded()
    {
        self::assertSame([], $this->sut->getElements(), 'No element has been added.');
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
     * Creates a dummy for the {@see PhpXmlSchema\Dom\FieldElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createFieldElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(FieldElement::class)->reveal();
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
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ListElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createListElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ListElement::class)->reveal();
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
}
