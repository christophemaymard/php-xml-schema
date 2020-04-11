<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents a trait that provides datasets to unit test 
 * NonNegativeIntegerLimitType type.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait NonNegativeIntegerLimitTypeProviderTrait
{
    /**
     * Returns a set of invalid NonNegativeIntegerLimitType type values.
     * 
     * @return  array[]
     */
    public function getInvalidNonNegativeIntegerLimitTypeValues(): array
    {
        return [
            'unbounded surrounded by white spaces' => [
                "   \t  \n  unbounded  \r   ", 
            ],
        ];
    }
    
    /**
     * Returns a set of valid NonNegativeIntegerLimitType type (with only 1) 
     * values.
     * 
     * @return  array[]
     */
    public function getValidOneNonNegativeIntegerLimitTypeValues(): array
    {
        return [
            '1' => [ 
                '1', 
            ], 
            '1 surrounded by white spaces' => [ 
                "   \r  \n   1    \t", 
            ], 
            '1 with positive sign' => [ 
                '+1', 
            ], 
            '1 with leading zeroes' => [ 
                '001', 
            ], 
            '1 with positive sign and leading zeroes' => [ 
                '+001', 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid NonNegativeIntegerLimitType type values.
     * 
     * @return  array[]
     */
    public function getInvalidOneNonNegativeIntegerLimitTypeValues(): array
    {
        return [
            'unbounded' => [ 
                'unbounded', 
            ], 
            'Non-negative integer other than 1' => [ 
                '0', 
            ], 
            'Negative integer' => [ 
                '-9', 
            ], 
        ];
    }
}
