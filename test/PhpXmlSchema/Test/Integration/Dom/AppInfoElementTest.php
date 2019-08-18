<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PhpXmlSchema\Dom\AnnotationElement;
use PhpXmlSchema\Dom\AppInfoElement;
use PhpXmlSchema\Dom\ElementId;

/**
 * Represents the integration tests for the {@see PhpXmlSchema\Dom\AppInfoElement} class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AppInfoElementTest extends AbstractAbstractElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new AppInfoElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetElementIdReturnsSpecificElementIdConstant()
    {
        self::assertSame(ElementId::ELT_APPINFO, $this->sut->getElementId());
    }
    
    /**
     * Tests hasParent() and getParent() when the element is added to 
     * AnnotationElement.
     * 
     * @group   content
     */
    public function testAppInfoElementWhenAddedToAnnotationElement()
    {
        $parent = new AnnotationElement();
        $parent->addAppInfoElement($this->sut);
        self::assertTrue($this->sut->hasParent());
        self::assertSame($parent, $this->sut->getParent());
    }
    
    /**
     * Tests that an exception is thrown when adding an element, that already 
     * belongs to another element, with AnnotationElement::addAppInfoElement().
     * 
     * @group   content
     */
    public function testAppInfoElementWithParentThrowsExceptionWhenAnnotationElementAddAppInfoElement()
    {
        $parent1 = new AnnotationElement();
        $parent1->addAppInfoElement($this->sut);
        
        $parent2 = new AnnotationElement();
        $this->expectInvalidOperationExceptionChildOfAnotherElement($this->sut, $parent2);
        $parent2->addAppInfoElement($this->sut);
    }
    
    /**
     * Tests that lookupNamespace() returns a string when:
     * - the element is added to a AnnotationElement element, and 
     * - the prefix is bound to a namespace in the parent element.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testLookupNamespaceReturnsStringWhenAddedToAnnotationElementAndParentPrefixBoundToNamespace()
    {
        $parent = new AnnotationElement();
        $parent->addAppInfoElement($this->sut);
        $parent->bindNamespace('foo', 'http://example.org/foo');
        self::assertSame('http://example.org/foo', $this->sut->lookupNamespace('foo'));
    }
}
