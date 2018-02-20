<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\SchemaElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SchemaElementTest extends AbstractCompositeElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElement();
    }
    
    /**
     * Tests that getIncludeElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no IncludeElement element has been added
     * - an indexed array of all added IncludeElement elements
     * 
     * @group   elt-content
     */
    public function testGetIncludeElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getIncludeElements(), 'No element has been added.');
        
        $this->sut->addImportElement($this->createImportElementDummy());
        $this->sut->addRedefineElement($this->createRedefineElementDummy());
        $this->sut->addCompositionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getIncludeElements(), 'Added elements but no IncludeElement element.');
        
        $elements[] = $this->createIncludeElementDummy();
        $this->sut->addIncludeElement($elements[0]);
        self::assertSame($elements, $this->sut->getIncludeElements(), 'Added 1 IncludeElement element.');
        
        $this->sut->addImportElement($this->createImportElementDummy());
        self::assertSame($elements, $this->sut->getIncludeElements(), 'Added 1 element between.');
        
        $elements[] = $this->createIncludeElementDummy();
        $this->sut->addIncludeElement($elements[1]);
        self::assertSame($elements, $this->sut->getIncludeElements(), 'Added 2 IncludeElement elements.');
    }
    
    /**
     * Tests that getImportElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no ImportElement element has been added
     * - an indexed array of all added ImportElement elements
     * 
     * @group   elt-content
     */
    public function testGetImportElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getImportElements(), 'No element has been added.');
        
        $this->sut->addIncludeElement($this->createIncludeElementDummy());
        $this->sut->addRedefineElement($this->createRedefineElementDummy());
        $this->sut->addCompositionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getImportElements(), 'Added elements but no ImportElement element.');
        
        $elements[] = $this->createImportElementDummy();
        $this->sut->addImportElement($elements[0]);
        self::assertSame($elements, $this->sut->getImportElements(), 'Added 1 ImportElement element.');
        
        $this->sut->addRedefineElement($this->createRedefineElementDummy());
        self::assertSame($elements, $this->sut->getImportElements(), 'Added 1 element between.');
        
        $elements[] = $this->createImportElementDummy();
        $this->sut->addImportElement($elements[1]);
        self::assertSame($elements, $this->sut->getImportElements(), 'Added 2 ImportElement elements.');
    }
    
    /**
     * Tests that getRedefineElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no RedefineElement element has been added
     * - an indexed array of all added RedefineElement elements
     * 
     * @group   elt-content
     */
    public function testGetRedefineElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getRedefineElements(), 'No element has been added.');
        
        $this->sut->addImportElement($this->createImportElementDummy());
        $this->sut->addIncludeElement($this->createIncludeElementDummy());
        $this->sut->addCompositionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getRedefineElements(), 'Added elements but no RedefineElement element.');
        
        $elements[] = $this->createRedefineElementDummy();
        $this->sut->addRedefineElement($elements[0]);
        self::assertSame($elements, $this->sut->getRedefineElements(), 'Added 1 RedefineElement element.');
        
        $this->sut->addCompositionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getRedefineElements(), 'Added 1 element between.');
        
        $elements[] = $this->createRedefineElementDummy();
        $this->sut->addRedefineElement($elements[1]);
        self::assertSame($elements, $this->sut->getRedefineElements(), 'Added 2 RedefineElement elements.');
    }
    
    /**
     * Tests that getCompositionAnnotationElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AnnotationElement element has been added
     * - an indexed array of all added AnnotationElement elements
     * 
     * @group   elt-content
     */
    public function testGetCompositionAnnotationElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getCompositionAnnotationElements(), 'No element has been added.');
        
        $this->sut->addIncludeElement($this->createIncludeElementDummy());
        $this->sut->addImportElement($this->createImportElementDummy());
        $this->sut->addRedefineElement($this->createRedefineElementDummy());
        self::assertSame($elements, $this->sut->getCompositionAnnotationElements(), 'Added elements but no AnnotationElement element.');
        
        $elements[] = $this->createAnnotationElementDummy();
        $this->sut->addCompositionAnnotationElement($elements[0]);
        self::assertSame($elements, $this->sut->getCompositionAnnotationElements(), 'Added 1 AnnotationElement element.');
        
        $this->sut->addIncludeElement($this->createIncludeElementDummy());
        self::assertSame($elements, $this->sut->getCompositionAnnotationElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAnnotationElementDummy();
        $this->sut->addCompositionAnnotationElement($elements[1]);
        self::assertSame($elements, $this->sut->getCompositionAnnotationElements(), 'Added 2 AnnotationElement elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 0 ((include | import | redefine | annotation)*).
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsElementsOfContainer0()
    {
        $children = [];
        $children[] = $this->createIncludeElementDummy();
        $children[] = $this->createImportElementDummy();
        $children[] = $this->createRedefineElementDummy();
        $children[] = $this->createAnnotationElementDummy();
        $children[] = $this->createIncludeElementDummy();
        $children[] = $this->createImportElementDummy();
        $children[] = $this->createRedefineElementDummy();
        $children[] = $this->createAnnotationElementDummy();
        $this->sut->addIncludeElement($children[0]);
        $this->sut->addImportElement($children[1]);
        $this->sut->addRedefineElement($children[2]);
        $this->sut->addCompositionAnnotationElement($children[3]);
        $this->sut->addIncludeElement($children[4]);
        $this->sut->addImportElement($children[5]);
        $this->sut->addRedefineElement($children[6]);
        $this->sut->addCompositionAnnotationElement($children[7]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 0.');
    }
}
