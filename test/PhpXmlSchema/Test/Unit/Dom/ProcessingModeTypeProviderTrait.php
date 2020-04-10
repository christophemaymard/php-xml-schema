<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents a trait that provides datasets to unit test the mode of content 
 * processing type.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait ProcessingModeTypeProviderTrait
{
    /**
     * Returns a set of valid ProcessingMode type values.
     * 
     * @return  array[]
     */
    public function getValidProcessingModeTypeValues():array
    {
        // [ $value, $lax, $skip, $strict, ]
        return [
            'lax' => [ 
                'lax', TRUE, FALSE, FALSE, 
            ],
            'skip' => [ 
                'skip', FALSE, TRUE, FALSE, 
            ],
            'strict' => [ 
                'strict', FALSE, FALSE, TRUE, 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid ProcessingMode type values.
     * 
     * @return  array[]
     */
    public function getInvalidProcessingModeTypeValues():array
    {
        return [
            'Empty string' => [
                '', 
            ], 
            'Only white spaces' => [
                '       ', 
            ], 
            'Not lax neither skip neither strict' => [ 
                'foo', 
            ], 
            'lax with white spaces' => [
                '    lax     ', 
            ], 
            'skip with white spaces' => [
                '    skip     ', 
            ], 
            'strict with white spaces' => [
                '    strict     ', 
            ], 
            'lax (uppercase)' => [ 
                'Lax', 
            ], 
            'skip (uppercase)' => [ 
                'sKip', 
            ], 
            'strict (uppercase)' => [ 
                'sTrict', 
            ], 
            'lax, skip and strict' => [ 
                'lax skip strict', 
            ], 
        ];
    }
}
