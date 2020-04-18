<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Dom;

/**
 * Represents a trait that provides datasets to unit test "use" type.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait UseTypeProviderTrait
{
    /**
     * Returns a set of valid UseType values.
     * 
     * @return  array[]
     */
    public function getValidUseTypeValues(): array
    {
        // [ $value, $optional, $prohibited, $required, ]
        return [
            'optional' => [ 
                'optional', TRUE, FALSE, FALSE, 
            ],
            'prohibited' => [ 
                'prohibited', FALSE, TRUE, FALSE, 
            ],
            'required' => [ 
                'required', FALSE, FALSE, TRUE, 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid UseType values.
     * 
     * @return  array[]
     */
    public function getInvalidUseTypeValues(): array
    {
        return [
            'Empty string' => [
                '', 
            ], 
            'Only white spaces' => [
                '       ', 
            ], 
            'Not optional neither prohibited neither required' => [ 
                'foo', 
            ], 
            'optional with white spaces' => [
                '    optional     ', 
            ], 
            'prohibited with white spaces' => [
                '    prohibited     ', 
            ], 
            'required with white spaces' => [
                '    required     ', 
            ], 
            'optional (uppercase)' => [ 
                'Optional', 
            ], 
            'prohibited (uppercase)' => [ 
                'Prohibited', 
            ], 
            'required (uppercase)' => [ 
                'Required', 
            ], 
            'optional, prohibited and required' => [ 
                'optional prohibited required', 
            ], 
        ];
    }
}
