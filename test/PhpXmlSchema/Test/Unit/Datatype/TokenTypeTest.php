<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\TokenType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Datatype\TokenType} 
 * class.
 * 
 * @group   type
 * @group   datatype
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TokenTypeTest extends TestCase
{
    use TokenTypeProviderTrait;
    
    /**
     * Tests that __construct() stores the value when it is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $token  The expected value for the token.
     * 
     * @dataProvider    getValidTokenTypeValues
     */
    public function test__constructStoresValueWhenItIsValid(
        string $value, 
        string $token
    ): void
    {
        $sut = new TokenType($value);
        self::assertSame($token, $sut->getToken());
    }
    
    /**
     * Tests that __construct() throws an exception when the specified value 
     * is invalid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $mValue The string representation of the value in the exception message.
     * 
     * @dataProvider    getInvalidTokenTypeValues
     */
    public function test__constructThrowsExceptionWhenValueIsInvalid(
        string $value, 
        string $mValue
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid token datatype.', 
            $mValue
        ));
        
        $sut = new TokenType($value);
    }
}