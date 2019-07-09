<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\MaxExclusiveElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\MaxExclusiveElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class MaxExclusiveElementTest extends AbstractAbstractAnyFacetElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new MaxExclusiveElement();
    }
}
