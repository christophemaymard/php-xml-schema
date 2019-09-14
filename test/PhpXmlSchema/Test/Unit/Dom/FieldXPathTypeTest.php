<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\FieldXPathType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\FieldXPathType} 
 * class.
 * 
 * @group   type
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FieldXPathTypeTest extends TestCase
{
    use FieldXPathTypeProviderTrait;
    
    /**
     * Tests that __construct() stores the expression when it is valid.
     * 
     * @param   string  $expr   The expression to test.
     * 
     * @dataProvider    getValidFieldXPathTypeValues
     */
    public function test__constructStoresExpressionWhenItIsValid(string $expr)
    {
        $sut =  new FieldXPathType($expr);
        self::assertSame($expr, $sut->getXPath());
    }
    
    /**
     * Tests that __construct() throws an exception when the specified 
     * expression is invalid.
     * 
     * @param   string  $expr   The expression to test.
     * 
     * @dataProvider    getInvalidFieldXPathTypeValues
     */
    public function test__constructThrowsExceptionWhenExpressionIsInvalid(string $expr)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            \sprintf('"%s" is an invalid XPath expression for a "field" element.', $expr)
        );
        $sut = new FieldXPathType($expr);
    }
}
