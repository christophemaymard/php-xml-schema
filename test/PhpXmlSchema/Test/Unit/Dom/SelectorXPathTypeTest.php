<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\SelectorXPathType;
use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Test\Dom\SelectorXPathTypeProviderTrait;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SelectorXPathType} 
 * class.
 * 
 * @group   type
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SelectorXPathTypeTest extends TestCase
{
    use SelectorXPathTypeProviderTrait;
    
    /**
     * Tests that __construct() stores the expression when it is valid.
     * 
     * @param   string  $expr   The expression to test.
     * 
     * @dataProvider    getValidSelectorXPathTypeValues
     */
    public function test__constructStoresExpressionWhenItIsValid(string $expr): void
    {
        $sut =  new SelectorXPathType($expr);
        self::assertSame($expr, $sut->getXPath());
    }
    
    /**
     * Tests that __construct() throws an exception when the specified 
     * expression is invalid.
     * 
     * @param   string  $expr   The expression to test.
     * 
     * @dataProvider    getInvalidSelectorXPathTypeValues
     */
    public function test__constructThrowsExceptionWhenExpressionIsInvalid(string $expr): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            \sprintf('"%s" is an invalid XPath expression for a "selector" element.', $expr)
        );
        $sut = new SelectorXPathType($expr);
    }
}
