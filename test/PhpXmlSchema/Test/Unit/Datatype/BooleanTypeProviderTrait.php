<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

/**
 * Represents a trait that provides datasets to unit test "boolean" datatype.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait BooleanTypeProviderTrait
{
    /**
     * Returns a set of valid "boolean" datatype values.
     * 
     * @return  array[]
     */
    public function getValidBooleanTypeValues():array
    {
        return [
            'true (string)' => [ 
                'true', 
                TRUE, 
            ], 
            'true (numeric)' => [ 
                '1', 
                TRUE, 
            ], 
            'true (string) surrounded by white spaces' => [ 
                " \t \r  \n  true   \t \r  \n   ", 
                TRUE, 
            ], 
            'true (numeric) surrounded by white spaces' => [ 
                " \n  \t \r  1   \r \t   \n  ", 
                TRUE, 
            ], 
            'false (string)' => [ 
                'false', 
                FALSE, 
            ], 
            'false (numeric)' => [ 
                '0', 
                FALSE, 
            ], 
            'false (string) surrounded by white spaces' => [ 
                "  \n  \r  \t false   \r ", 
                FALSE, 
            ], 
            'false (numeric) surrounded by white spaces' => [ 
                "   \r  \r 0   \r  \t   \n ", 
                FALSE, 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid "boolean" datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidBooleanTypeValues():array
    {
        return [
            'true (uppercase)' => [ 
                'True', 
            ], 
            'false (uppercase)' => [ 
                'False', 
            ], 
            'Numeric other than 0 or 1' => [ 
                '2', 
            ], 
        ];
    }
}