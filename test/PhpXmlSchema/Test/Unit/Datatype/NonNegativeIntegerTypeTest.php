<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\NonNegativeIntegerType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Datatype\NonNegativeIntegerType} 
 * class.
 * 
 * @group   type
 * @group   datatype
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NonNegativeIntegerTypeTest extends TestCase
{
    /**
     * Tests that __construct() stores the value when it is valid.
     * 
     * @param   \GMP    $value  The value to test.
     * 
     * @dataProvider    getValidValues
     */
    public function test__constructStoresValueWhenItIsValid(\GMP $value)
    {
        $sut = new NonNegativeIntegerType($value);
        self::assertSame($value, $sut->getInteger());
    }
    
    /**
     * Tests that __construct() throws an exception when the specified value 
     * is invalid.
     */
    public function test__constructThrowsExceptionWhenValueIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('"-1" is an invalid non-negative integer.');
        
        $sut = new NonNegativeIntegerType(\gmp_init(-1));
    }
    
    /**
     * Returns a set of valid values.
     * 
     * @return  array[]
     */
    public function getValidValues():array
    {
        $datasets = [];
        
        $datasets['Zero.'] = [ \gmp_init(0), ];
        $datasets['Positive value.'] = [ \gmp_init(3), ];
        
        return $datasets;
    }
}
