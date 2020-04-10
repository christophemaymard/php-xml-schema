<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

/**
 * Represents a trait that provides datasets to unit test "positiveInteger" 
 * datatype.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait PositiveIntegerTypeProviderTrait
{
    /**
     * Returns a set of valid "positiveInteger" datatype values.
     * 
     * @return  array[]
     */
    public function getValidPositiveIntegerTypeValues():array
    {
        return [
            '1' => [ 
                '1', 
                \gmp_init(1), 
            ], 
            '1 with positive sign' => [ 
                '+1', 
                \gmp_init(1), 
            ], 
            '1 with positive sign and surrounded by white spaces' => [ 
                " \t \r  \n  +1   \t \r  \n   ", 
                \gmp_init(1), 
            ], 
            '1234567890' => [ 
                '1234567890', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign' => [ 
                '+1234567890', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign and surrounded by white spaces' => [ 
                " \t \r  \n  +1234567890   \t \r  \n   ", 
                \gmp_init(1234567890), 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid "positiveInteger" datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidPositiveIntegerTypeValues():array
    {
        return [
            '0' => [ 
                '0', 
            ], 
            '0 with positive sign' => [ 
                '+0', 
            ], 
            'Negative integer' => [ 
                '-9', 
            ], 
        ];
    }
}
