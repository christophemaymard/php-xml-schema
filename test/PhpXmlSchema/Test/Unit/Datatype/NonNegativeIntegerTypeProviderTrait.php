<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

/**
 * Represents a trait that provides datasets to unit test 
 * "nonNegativeInteger" datatype.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait NonNegativeIntegerTypeProviderTrait
{
    /**
     * Returns a set of valid "nonNegativeInteger" datatype values.
     * 
     * @return  array[]
     */
    public function getValidNonNegativeIntegerTypeValues():array
    {
        return [
            '0' => [ 
                '0', 
                \gmp_init(0), 
            ], 
            '0 with positive sign' => [ 
                '+0', 
                \gmp_init(0), 
            ], 
            '0 with positive sign and leading zeroes' => [ 
                '+000', 
                \gmp_init(0), 
            ], 
            '0 with positive sign, leading zeroes and surrounded by white spaces' => [ 
                " \t \r  \n  +00   \t \r  \n   ", 
                \gmp_init(0), 
            ], 
            '1234567890' => [ 
                '1234567890', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign' => [ 
                '+1234567890', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign and leading zeroes' => [ 
                '+001234567890', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign, leading zeroes and surrounded by white spaces' => [ 
                " \t \r  \n  +001234567890   \t \r  \n   ", 
                \gmp_init(1234567890), 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid "nonNegativeInteger" datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidNonNegativeIntegerTypeValues():array
    {
        return [
            'Negative integer' => [ 
                '-9', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "nonNegativeInteger" datatype (with only 0 or 
     * 1) values.
     * 
     * @return  array[]
     */
    public function getValidZeroOrOneNonNegativeIntegerTypeValues():array
    {
        return [
            '0' => [ 
                '0', 
                \gmp_init(0), 
            ], 
            '0 surrounded by white spaces' => [ 
                "   \r  \n   0    \t", 
                \gmp_init(0), 
            ], 
            '0 with positive sign' => [ 
                '+0', 
                \gmp_init(0), 
            ], 
            '0 with leading zeroes' => [ 
                '000', 
                \gmp_init(0), 
            ], 
            '0 with positive sign and leading zeroes' => [ 
                '+000', 
                \gmp_init(0), 
            ], 
            '1' => [ 
                '1', 
                \gmp_init(1), 
            ], 
            '1 surrounded by white spaces' => [ 
                "   \r  \n   1    \t", 
                \gmp_init(1), 
            ], 
            '1 with positive sign' => [ 
                '+1', 
                \gmp_init(1), 
            ], 
            '1 with leading zeroes' => [ 
                '001', 
                \gmp_init(1), 
            ], 
            '1 with positive sign and leading zeroes' => [ 
                '+001', 
                \gmp_init(1), 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid "nonNegativeInteger" datatype (with only 0 or 
     * 1) values.
     * 
     * @return  array[]
     */
    public function getInvalidZeroOrOneNonNegativeIntegerTypeValues():array
    {
        return [
            'Non-negative integer other than 0 or 1' => [ 
                '2', 
            ], 
            'Negative integer' => [ 
                '-9', 
            ], 
        ];
    }
}
