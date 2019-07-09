<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents the base class for all the leaf element test cases.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractLeafElementTestCase extends AbstractElementTestCase
{
    /**
     * Tests that getContent() returns:
     * - an empty string when no content has been set
     * - the string of the content that has been set
     * 
     * @group   elt-content
     */
    public function testGetContent()
    {
        self::assertSame('', $this->sut->getContent(), 'No content has been set.');
        
        $this->sut->setContent('foo');
        self::assertSame('foo', $this->sut->getContent(), 'Set with a content: foo.');
        
        $this->sut->setContent('bar');
        self::assertSame('bar', $this->sut->getContent(), 'Set with another content: bar.');
    }
}
