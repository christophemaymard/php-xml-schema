<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\AnnotationElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\AnnotationElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnnotationElementTest extends AbstractCompositeElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new AnnotationElement();
    }
    
    /**
     * Tests that getAppInfoElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AppInfoElement element has been added
     * - an indexed array of all added AppInfoElement elements
     * 
     * @group   elt-content
     */
    public function testGetAppInfoElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getAppInfoElements(), 'No element has been added.');
        
        $this->sut->addDocumentationElement($this->createDocumentationElementDummy());
        self::assertSame($elements, $this->sut->getAppInfoElements(), 'Added elements but no AppInfoElement element.');
        
        $elements[] = $this->createAppInfoElementDummy();
        $this->sut->addAppInfoElement($elements[0]);
        self::assertSame($elements, $this->sut->getAppInfoElements(), 'Added 1 AppInfoElement element.');
        
        $this->sut->addDocumentationElement($this->createDocumentationElementDummy());
        self::assertSame($elements, $this->sut->getAppInfoElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAppInfoElementDummy();
        $this->sut->addAppInfoElement($elements[1]);
        self::assertSame($elements, $this->sut->getAppInfoElements(), 'Added 2 AppInfoElement elements.');
    }
    
    /**
     * Tests that getDocumentationElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no DocumentationElement element has been added
     * - an indexed array of all added DocumentationElement elements
     * 
     * @group   elt-content
     */
    public function testGetDocumentationElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getDocumentationElements(), 'No element has been added.');
        
        $this->sut->addAppInfoElement($this->createAppInfoElementDummy());
        self::assertSame($elements, $this->sut->getDocumentationElements(), 'Added elements but no DocumentationElement element.');
        
        $elements[] = $this->createDocumentationElementDummy();
        $this->sut->addDocumentationElement($elements[0]);
        self::assertSame($elements, $this->sut->getDocumentationElements(), 'Added 1 DocumentationElement element.');
        
        $this->sut->addAppInfoElement($this->createAppInfoElementDummy());
        self::assertSame($elements, $this->sut->getDocumentationElements(), 'Added 1 element between.');
        
        $elements[] = $this->createDocumentationElementDummy();
        $this->sut->addDocumentationElement($elements[1]);
        self::assertSame($elements, $this->sut->getDocumentationElements(), 'Added 2 DocumentationElement elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 0 ((appinfo | documentation)*).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer0()
    {
        $children = [];
        $children[] = $this->createAppInfoElementDummy();
        $children[] = $this->createDocumentationElementDummy();
        $children[] = $this->createAppInfoElementDummy();
        $children[] = $this->createDocumentationElementDummy();
        $this->sut->addAppInfoElement($children[0]);
        $this->sut->addDocumentationElement($children[1]);
        $this->sut->addAppInfoElement($children[2]);
        $this->sut->addDocumentationElement($children[3]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 0.');
    }
}
