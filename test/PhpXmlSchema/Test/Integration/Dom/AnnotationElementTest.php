<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\AllElement;
use PhpXmlSchema\Dom\AnnotatedElementInterface;
use PhpXmlSchema\Dom\AnnotationElement;
use PhpXmlSchema\Dom\AnyAttributeElement;
use PhpXmlSchema\Dom\AnyElement;
use PhpXmlSchema\Dom\AttributeElement;
use PhpXmlSchema\Dom\AttributeGroupElement;
use PhpXmlSchema\Dom\ChoiceElement;
use PhpXmlSchema\Dom\ComplexContentElement;
use PhpXmlSchema\Dom\ComplexContentExtensionElement;
use PhpXmlSchema\Dom\ComplexContentRestrictionElement;
use PhpXmlSchema\Dom\ComplexTypeElement;
use PhpXmlSchema\Dom\ElementElement;
use PhpXmlSchema\Dom\ElementId;
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
use PhpXmlSchema\Dom\SchemaElement;
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

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\AnnotationElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnnotationElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new AnnotationElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant(): void
    {
        self::assertSame(ElementId::ELT_ANNOTATION, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * AnnotatedElementInterface.
     * 
     * @param   AnnotatedElementInterface   $parent The parent element to use for the test.
     * 
     * @dataProvider    getAllAnnotatedElementValues
     * 
     * @group   content
     */
    public function testAnnotationElementWhenAddedToAnnotatedElement(
        AnnotatedElementInterface $parent
    ): void
    {
        $parent->setAnnotationElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with AnnotatedElementInterface::setAnnotationElement().
     * 
     * @param   AnnotatedElementInterface   $parent1    The first parent element to use for the test.
     * @param   AnnotatedElementInterface   $parent2    The second parent element to use for the test.
     * 
     * @dataProvider    getAllAnnotatedElementParentValues
     * 
     * @group   content
     */
    public function testAnnotationElementWithParentThrowsExceptionWhenAnnotatedElementSetAnnotationElement(
        AnnotatedElementInterface $parent1,
        AnnotatedElementInterface $parent2
    ): void
    {
        $parent1->setAnnotationElement($this->sut);
        
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->setAnnotationElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * RedefineElement.
     * 
     * @group   content
     */
    public function testAnnotationElementWhenAddedToRedefineElement(): void
    {
        $parent = new RedefineElement();
        $parent->addAnnotationElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with RedefineElement::addAnnotationElement().
     * 
     * @group   content
     */
    public function testAnnotationElementWithParentThrowsExceptionWhenRedefineElementAddAnnotationElement(): void
    {
        $parent1 = new RedefineElement();
        $parent1->addAnnotationElement($this->sut);
        
        $parent2 = new RedefineElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addAnnotationElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SchemaElement.
     * 
     * @group   content
     */
    public function testCompositionAnnotationElementWhenAddedToSchemaElement(): void
    {
        $parent = new SchemaElement();
        $parent->addCompositionAnnotationElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SchemaElement::addCompositionAnnotationElement().
     * 
     * @group   content
     */
    public function testCompositionAnnotationElementWithParentThrowsExceptionWhenSchemaElementAddCompositionAnnotationElement(): void
    {
        $parent1 = new SchemaElement();
        $parent1->addCompositionAnnotationElement($this->sut);
        
        $parent2 = new SchemaElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addCompositionAnnotationElement($this->sut);
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * SchemaElement.
     * 
     * @group   content
     */
    public function testDefinitionAnnotationElementWhenAddedToSchemaElement(): void
    {
        $parent = new SchemaElement();
        $parent->addDefinitionAnnotationElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with SchemaElement::addDefinitionAnnotationElement().
     * 
     * @group   content
     */
    public function testDefinitionAnnotationElementWithParentThrowsExceptionWhenSchemaElementAddDefinitionAnnotationElement(): void
    {
        $parent1 = new SchemaElement();
        $parent1->addDefinitionAnnotationElement($this->sut);
        
        $parent2 = new SchemaElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addDefinitionAnnotationElement($this->sut);
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a AnnotatedElementInterface element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @param   AnnotatedElementInterface   $parent The parent element to use for the test.
     * 
     * @group           namespace
     * @group           xml
     * @dataProvider    getAllAnnotatedElementValues
     */
    public function testLookupNamespaceReturnsStringWhenAddedToAnnotatedElementAndParentPrefixBoundToNamespace(
        AnnotatedElementInterface $parent
    ): void
    {
        $parent->setAnnotationElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a RedefineElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToRedefineElementAndParentPrefixBoundToNamespace(): void
    {
        $parent = new RedefineElement();
        $parent->addAnnotationElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a SchemaElement element (composition), and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToSchemaElementCompositionAndParentPrefixBoundToNamespace(): void
    {
        $parent = new SchemaElement();
        $parent->addCompositionAnnotationElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a SchemaElement element (definition), and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToSchemaElementDefinitionAndParentPrefixBoundToNamespace(): void
    {
        $parent = new SchemaElement();
        $parent->addDefinitionAnnotationElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
    
    /**
     * Returns a set of all the annotated element values.
     * 
     * @return  array[]
     */
    public function getAllAnnotatedElementValues(): array
    {
        $datasets = [];
        
        foreach ($this->getAllAnnotatedElements() as $element) {
            $datasets[] = [ $element, ];
        }
        
        return $datasets;
    }
    
    /**
     * Returns a set of all the annotated element parent values.
     * 
     * @return  array[]
     */
    public function getAllAnnotatedElementParentValues(): array
    {
        $datasets = [];
        
        $parents1 = $this->getAllAnnotatedElements();
        $parents2 = $this->getAllAnnotatedElements();
        $count = count($parents1);
        
        for ($num = 0; $num < $count; $num++) {
            $datasets[] = [ \array_shift($parents1), \array_shift($parents2), ];
        }
        
        return $datasets;
    }
    
    /**
     * Returns a set of all the annotated elements.
     * 
     * @return  AnnotatedElementInterface[]
     */
    private function getAllAnnotatedElements(): array
    {
        return [
            new AllElement(),
            new AnyAttributeElement(),
            new AnyElement(),
            new AttributeElement(),
            new AttributeGroupElement(),
            new ChoiceElement(),
            new ComplexContentElement(),
            new ComplexContentExtensionElement(),
            new ComplexContentRestrictionElement(),
            new ComplexTypeElement(),
            new ElementElement(),
            new EnumerationElement(),
            new FieldElement(),
            new FractionDigitsElement(),
            new GroupElement(),
            new ImportElement(),
            new IncludeElement(),
            new KeyElement(),
            new KeyRefElement(),
            new LengthElement(),
            new ListElement(),
            new MaxExclusiveElement(),
            new MaxInclusiveElement(),
            new MaxLengthElement(),
            new MinExclusiveElement(),
            new MinInclusiveElement(),
            new MinLengthElement(),
            new NotationElement(),
            new PatternElement(),
            new SelectorElement(),
            new SequenceElement(),
            new SimpleContentElement(),
            new SimpleContentExtensionElement(),
            new SimpleContentRestrictionElement(),
            new SimpleTypeElement(),
            new SimpleTypeRestrictionElement(),
            new TotalDigitsElement(),
            new UnionElement(),
            new UniqueElement(),
            new WhiteSpaceElement(),
        ];
    }
}
