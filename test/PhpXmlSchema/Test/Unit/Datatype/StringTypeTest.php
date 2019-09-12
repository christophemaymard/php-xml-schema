<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\StringType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Datatype\StringType} 
 * class.
 * 
 * @group   type
 * @group   datatype
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class StringTypeTest extends TestCase
{
    use StringTypeProviderTrait;
    
    /**
     * Tests that __construct() stores the value when it is valid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @dataProvider    getValidStringTypeValues
     */
    public function test__constructStoresValueWhenItIsValid(string $value)
    {
        $sut = new StringType($value);
        self::assertSame($value, $sut->getString());
    }
    
    /**
     * Tests that __construct() throws an exception when the specified value 
     * is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @dataProvider    getInvalidStringTypeValues
     */
    public function test__constructThrowsExceptionWhenValueIsInvalid(string $value)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid string datatype.', $value));
        
        $sut = new StringType($value);
    }
}