<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\FractionDigitsElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\FractionDigitsElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FractionDigitsElementTest extends AbstractNumericFacetElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new FractionDigitsElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString(): void
    {
        self::assertSame('fractionDigits', $this->sut->getLocalName());
    }
}
