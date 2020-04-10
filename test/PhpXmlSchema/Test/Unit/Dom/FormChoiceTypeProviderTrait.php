<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents a trait that provides datasets to unit test "formChoice" type.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait FormChoiceTypeProviderTrait
{
    /**
     * Returns a set of valid "formChoice" values.
     * 
     * @return  array[]
     */
    public function getValidFormChoiceTypeValues():array
    {
        return [
            'qualified' => [
                'qualified', TRUE, FALSE, 
            ], 
            'unqualified' => [
                'unqualified', FALSE, TRUE, 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid "formChoice" values.
     * 
     * @return  array[]
     */
    public function getInvalidFormChoiceTypeValues():array
    {
        return [
            'Empty string' => [
                '', 
            ], 
            'Only white spaces' => [
                '       ', 
            ], 
            'Not qualified neither unqualified' => [ 
                'foo', 
            ], 
            'qualified with whitespaces' => [
                '    qualified     ', 
            ], 
            'unqualified with whitespaces' => [
                '    unqualified     ', 
            ], 
            'qualified (uppercase)' => [ 
                'Qualified', 
            ], 
            'unqualified (uppercase)' => [ 
                'Unqualified', 
            ], 
            'qualified and unqualified' => [ 
                'qualified unqualified', 
            ], 
        ];
    }
}
