<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Dom;

/**
 * Represents a trait that provides datasets to unit test white space type.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait WhiteSpaceTypeProviderTrait
{
    /**
     * Returns a set of valid white space type values.
     * 
     * @return  array[]
     */
    public function getValidWhiteSpaceTypeValues(): array
    {
        return [
            'collapse' => [ 
                'collapse', 
                TRUE, 
                FALSE, 
                FALSE, 
            ], 
            'preserve' => [ 
                'preserve', 
                FALSE, 
                TRUE, 
                FALSE, 
            ], 
            'replace' => [ 
                'replace', 
                FALSE, 
                FALSE, 
                TRUE, 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid white space type values.
     * 
     * @return  array[]
     */
    public function getInvalidWhiteSpaceTypeValues(): array
    {
        return [
            'Empty string' => [ 
                '', 
            ], 
            'collapse (uppercase)' => [ 
                'Collapse', 
            ], 
            'preserve (uppercase)' => [ 
                'Preserve', 
            ], 
            'replace (uppercase)' => [ 
                'Replace', 
            ], 
            'collapse preserve' => [ 
                'collapse preserve', 
            ], 
            'collapse replace' => [ 
                'collapse replace', 
            ], 
            'preserve replace' => [ 
                'preserve replace', 
            ], 
        ];
    }
}
