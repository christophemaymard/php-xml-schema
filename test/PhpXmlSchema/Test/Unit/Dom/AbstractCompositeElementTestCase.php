<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

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
}
