<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Exception;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Exception\Message;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Exception\Message} 
 * class.
 * 
 * @group   exception
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class MessageTest extends TestCase
{
    /**
     * Tests that unexpectedElement() returns a message with "none" when no 
     * element is expected.
     */
    public function testUnexpectedElementReturnsNoneWhenExpectNoElement()
    {
        self::assertSame(
            'The "foo" element (from bar namespace) is unexpected, expected: none.', 
            Message::unexpectedElement('foo', 'bar', []),
            'Expect no element.'
        );
    }
    
    /**
     * Tests that unexpectedElement() returns a message with 1 element name 
     * when 1 element is expected.
     */
    public function testUnexpectedElementReturns1ElementWhenExpect1Element()
    {
        self::assertSame(
            'The "foo" element (from bar namespace) is unexpected, expected: "baz".', 
            Message::unexpectedElement('foo', 'bar', [ 'baz', ]),
            'Expect 1 element.'
        );
    }
    
    /**
     * Tests that unexpectedElement() returns a message with 2 element names 
     * that are separated by "or" when 2 elements are expected.
     */
    public function testUnexpectedElementReturns1ElementOr1ElementWhenExpect2Elements()
    {
        self::assertSame(
            'The "foo" element (from bar namespace) is unexpected, expected: "baz" or "qux".', 
            Message::unexpectedElement('foo', 'bar', [ 'baz', 'qux', ]),
            'Expect 2 elements.'
        );
    }
    
    /**
     * Tests that unexpectedElement() returns a message with 3 element names 
     * that are separated by a comma (for the first and the second) and by 
     * "or" (for the second and the third) when 3 elements are expected.
     */
    public function testUnexpectedElementReturns1ElementComma1ElementOr1ElementWhenExpect3Elements()
    {
        self::assertSame(
            'The "foo" element (from bar namespace) is unexpected, expected: "baz", "qux" or "quux".', 
            Message::unexpectedElement('foo', 'bar', [ 'baz', 'qux', 'quux', ]),
            'Expect 3 elements.'
        );
    }
    
    /**
     * Tests that unexpectedElement() returns a message with "no" namespace 
     * when the unexpected element has an empty namespace.
     */
    public function testUnexpectedElementReturnsNoNamespaceWhenNamespaceIsEmptyString()
    {
        self::assertSame(
            'The "foo" element (from no namespace) is unexpected, expected: "baz", "qux" or "quux".', 
            Message::unexpectedElement('foo', '', [ 'baz', 'qux', 'quux', ]),
            'No namespace.'
        );
    }
}