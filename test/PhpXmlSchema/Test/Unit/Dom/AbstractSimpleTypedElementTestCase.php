<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the base class to unit test a XML schema element that directly 
 * extends the {@see PhpXmlSchema\Dom\AbstractSimpleTypedElement} class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractSimpleTypedElementTestCase extends AbstractAbstractSimpleTypedElementTestCase
{
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 (annotation?)
     * - elements from container 1 (simpleType?)
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOrderedByContainer01()
    {
        $children = [];
        $children[] = $this->createAnnotationElementDummy();
        $children[] = $this->createSimpleTypeElementDummy();
        
        // Init container 1.
        $this->sut->setSimpleTypeElement($children[1]);
        
        // Init container 0.
        $this->sut->setAnnotationElement($children[0]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 1.');
    }
}
