<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\PositiveIntegerType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Datatype\PositiveIntegerType} 
 * class.
 * 
 * @group   type
 * @group   datatype
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class PositiveIntegerTypeTest extends TestCase
{
    /**
     * Tests that __construct() stores the value when it is valid.
     */
    public function test__constructStoresValueWhenItIsValid(): void
    {
        $value = \gmp_init(1);
        $sut = new PositiveIntegerType($value);
        self::assertSame($value, $sut->getPositiveInteger());
    }
    
    /**
     * Tests that __construct() throws an exception when the specified value 
     * is invalid.
     * 
     * @param   \GMP    $value  The value to test.
     * 
     * @dataProvider    getInvalidValues
     */
    public function test__constructThrowsExceptionWhenValueIsInvalid(\GMP $value): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid positiveInteger datatype.', $value));
        
        $sut = new PositiveIntegerType($value);
    }
    
    /**
     * Returns a set of invalid values.
     * 
     * @return  array[]
     */
    public function getInvalidValues(): array
    {
        $datasets = [];
        
        $datasets['Negative value.'] = [ \gmp_init(-3), ];
        $datasets['Zero.'] = [ \gmp_init(0), ];
        
        return $datasets;
    }
}
