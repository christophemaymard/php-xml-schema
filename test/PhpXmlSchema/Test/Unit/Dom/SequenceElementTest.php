<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\SequenceElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SequenceElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SequenceElementTest extends AbstractExplicitModelGroupElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new SequenceElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString(): void
    {
        self::assertSame('sequence', $this->sut->getLocalName());
    }
}
