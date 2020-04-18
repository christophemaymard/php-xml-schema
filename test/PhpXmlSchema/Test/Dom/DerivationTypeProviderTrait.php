<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Dom;

/**
 * Represents a trait that provides datasets to unit test derivation type.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait DerivationTypeProviderTrait
{
    /**
     * Returns a set of valid "blockSet" values.
     * 
     * @return  array[]
     */
    public function getValidBlockSetTypeValues(): array
    {
        // [ $value, $restriction, $extension, $substitution, ]
        return [
            'Empty string' => [ 
                '', FALSE, FALSE, FALSE, 
            ],
            'Only white spaces' => [ 
                "\t    \r    \n", FALSE, FALSE, FALSE, 
            ],
            '#all' => [ 
                '#all', TRUE, TRUE, TRUE, 
            ],
            'extension, restriction and substitution with white spaces' => [ 
                " substitution\t \r \nextension\t \r \nrestriction  ", TRUE, TRUE, TRUE, 
            ],
            'restriction with white spaces' => [ 
                "\t \r \n  restriction  ", TRUE, FALSE, FALSE, 
            ],
            'extension with white spaces' => [ 
                " extension\r", FALSE, TRUE, FALSE, 
            ],
            'substitution with white spaces' => [ 
                "   substitution   ", FALSE, FALSE, TRUE, 
            ],
            'restriction and extension with white spaces' => [ 
                "\t\t\t restriction \n   \rextension\n ", TRUE, TRUE, FALSE, 
            ],
            'substitution and restriction with white spaces' => [ 
                "\n\n\nsubstitution restriction", TRUE, FALSE, TRUE, 
            ],
            'extension and substitution with white spaces' => [ 
                "extension\t\t\tsubstitution\n\n\n", FALSE, TRUE, TRUE, 
            ],
            'Duplicated restriction' => [ 
                'restriction restriction', TRUE, FALSE, FALSE, 
            ],
            'Duplicated extension' => [ 
                'extension extension', FALSE, TRUE, FALSE, 
            ],
            'Duplicated substitution' => [ 
                'substitution substitution', FALSE, FALSE, TRUE, 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid "blockSet" values.
     * 
     * @return  array[]
     */
    public function getInvalidBlockSetTypeValues(): array
    {
        return [
            'Not substitution neither extension neither restriction' => [ 
                'foo', 
            ],
            '#all (uppercase)' => [ 
                '#ALL', 
            ],
            '#all with white spaces' => [ 
                '    #all    ', 
            ], 
            'substitution (uppercase)' => [ 
                'subStitution', 
            ],
            'extension (uppercase)' => [ 
                'exTension', 
            ],
            'restriction (uppercase)' => [ 
                'Restriction', 
            ],
            '#all with substitution' => [ 
                '#all substitution', 
            ],
            '#all with extension' => [ 
                'extension #all', 
            ],
            '#all with restriction' => [ 
                '#all restriction', 
            ],
            'Value not substitution neither extension neither restriction in list' => [ 
                'substitution extension foo restriction', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "fullDerivationSet" values.
     * 
     * @return  array[]
     */
    public function getValidFullDerivationSetTypeValues(): array
    {
        // [ $value, $extension, $restriction, $list, $union, ]
        return [
            'Empty string' => [ 
                '', FALSE, FALSE, FALSE, FALSE, 
            ],
            'Only white spaces' => [ 
                "\t    \r    \n", FALSE, FALSE, FALSE, FALSE, 
            ],
            '#all' => [ 
                '#all', TRUE, TRUE, TRUE, TRUE, 
            ],
            'extension, restriction, list and union with white spaces' => [ 
                "\t \r \n  extension   restriction \t \r \n  list  \t \r \n  union  ", TRUE, TRUE, TRUE, TRUE, 
            ],
            'extension with white spaces' => [ 
                "\t \r \n  extension  \t \r \n  ", TRUE, FALSE, FALSE, FALSE, 
            ],
            'restriction with white spaces' => [ 
                "\t \r \n  restriction  \t \r \n  ", FALSE, TRUE, FALSE, FALSE, 
            ],
            'list with white spaces' => [ 
                "\t \r \n  list  \t \r \n  ", FALSE, FALSE, TRUE, FALSE, 
            ],
            'union with white spaces' => [ 
                "\t \r \n  union  \t \r \n  ", FALSE, FALSE, FALSE, TRUE, 
            ],
            'extension and restriction with white spaces' => [ 
                "\t \r \n  extension  \t \r \n restriction   ", TRUE, TRUE, FALSE, FALSE, 
            ], 
            'list and union with white spaces' => [ 
                "\t \r \n  list  \t \r \n union   ", FALSE, FALSE, TRUE, TRUE, 
            ], 
            'extension and union with white spaces' => [ 
                "\t \r \n  union  \t \r \n extension   ", TRUE, FALSE, FALSE, TRUE, 
            ], 
            'restriction and list with white spaces' => [ 
                "\t \r \n  list  \t \r \n restriction   ", FALSE, TRUE, TRUE, FALSE, 
            ], 
            'extension and list with white spaces' => [ 
                "\t \r \n  extension  \t \r \n list   ", TRUE, FALSE, TRUE, FALSE, 
            ], 
            'restriction and union with white spaces' => [ 
                "\t \r \n  restriction  \t \r \n union   ", FALSE, TRUE, FALSE, TRUE, 
            ], 
            'Duplicated extension' => [ 
                'extension extension', TRUE, FALSE, FALSE, FALSE, 
            ],
            'Duplicated restriction' => [ 
                'restriction restriction', FALSE, TRUE, FALSE, FALSE, 
            ],
            'Duplicated list' => [ 
                'list list', FALSE, FALSE, TRUE, FALSE, 
            ],
            'Duplicated extension' => [ 
                'union union', FALSE, FALSE, FALSE, TRUE, 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid "fullDerivationSet" values.
     * 
     * @return  array[]
     */
    public function getInvalidFullDerivationSetTypeValues(): array
    {
        return [
            'Not extension neither restriction neither list neither union' => [ 
                'foo', 
            ],
            '#all (uppercase)' => [ 
                '#ALL', 
            ],
            '#all with white spaces' => [ 
                '    #all    ', 
            ], 
            'extension (uppercase)' => [ 
                'Extension', 
            ],
            'restriction (uppercase)' => [ 
                'Restriction', 
            ],
            'list (uppercase)' => [ 
                'List', 
            ],
            'union (uppercase)' => [ 
                'Union', 
            ],
            '#all with extension' => [ 
                '#all extension', 
            ],
            '#all with restriction' => [ 
                '#all restriction', 
            ],
            '#all with list' => [ 
                '#all list', 
            ],
            '#all with union' => [ 
                '#all union', 
            ],
            'Value not extension neither restriction neither list neither union' => [ 
                'extension restriction foo list restriction', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "simpleDerivationSet" values.
     * 
     * @return  array[]
     */
    public function getValidSimpleDerivationSetTypeValues(): array
    {
        // [ $value, $list, $union, $restriction, ]
        return [
            'Empty string' => [ 
                '', FALSE, FALSE, FALSE, 
            ],
            'Only white spaces' => [ 
                "\t    \r    \n", FALSE, FALSE, FALSE, 
            ],
            '#all' => [ 
                '#all', TRUE, TRUE, TRUE, 
            ],
            'list, union and restriction with white spaces' => [ 
                " union\t \r \nlist\t \r \nrestriction  ", TRUE, TRUE, TRUE, 
            ],
            'list with white spaces' => [ 
                " list\r", TRUE, FALSE, FALSE, 
            ],
            'union with white spaces' => [ 
                "   union   ", FALSE, TRUE, FALSE, 
            ],
            'restriction with white spaces' => [ 
                "\t \r \n  restriction  ", FALSE, FALSE, TRUE, 
            ],
            'restriction and list with white spaces' => [ 
                "\t\t\t restriction \n   \rlist\n ", TRUE, FALSE, TRUE, 
            ],
            'union and restriction with white spaces' => [ 
                "\n\n\nunion restriction", FALSE, TRUE, TRUE, 
            ],
            'list and union with white spaces' => [ 
                "list\t\t\tunion\n\n\n", TRUE, TRUE, FALSE, 
            ],
            'Duplicated list' => [ 
                'list list', TRUE, FALSE, FALSE, 
            ],
            'Duplicated union' => [ 
                'union union', FALSE, TRUE, FALSE, 
            ],
            'Duplicated restriction' => [ 
                'restriction restriction', FALSE, FALSE, TRUE, 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid "simpleDerivationSet" values.
     * 
     * @return  array[]
     */
    public function getInvalidSimpleDerivationSetTypeValues(): array
    {
        return [
            'Not list neither union neither restriction' => [ 
                'foo', 
            ],
            '#all (uppercase)' => [ 
                '#ALL', 
            ],
            '#all with white spaces' => [ 
                '    #all    ', 
            ], 
            'list (uppercase)' => [ 
                'List', 
            ],
            'union (uppercase)' => [ 
                'unIon', 
            ],
            'restriction (uppercase)' => [ 
                'Restriction', 
            ],
            '#all with list' => [ 
                '#all list', 
            ],
            '#all with union' => [ 
                'union #all', 
            ],
            '#all with restriction' => [ 
                '#all restriction', 
            ],
            'Value not list neither union neither restriction in list' => [ 
                'list union foo restriction', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "derivationSet" values.
     * 
     * @return  array[]
     */
    public function getValidDerivationSetTypeValues(): array
    {
        // [ $value, $extension, $restriction, ]
        return [
            'Empty string' => [ 
                '', FALSE, FALSE, 
            ],
            'Only white spaces' => [ 
                "\t    \r    \n", FALSE, FALSE, 
            ],
            '#all' => [ 
                '#all', TRUE, TRUE, 
            ],
            'extension and restriction with white spaces' => [ 
                " extension\t \r \nrestriction  ", TRUE, TRUE, 
            ],
            'extension with white spaces' => [ 
                " extension\r", TRUE, FALSE, 
            ],
            'restriction with white spaces' => [ 
                "\t \r \n  restriction  ", FALSE, TRUE, 
            ],
            'Duplicated extension' => [ 
                'extension extension', TRUE, FALSE, 
            ],
            'Duplicated restriction' => [ 
                'restriction restriction', FALSE, TRUE, 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid "derivationSet" values.
     * 
     * @return  array[]
     */
    public function getInvalidDerivationSetTypeValues(): array
    {
        return [
            'Not extension neither restriction' => [ 
                'foo', 
            ],
            '#all (uppercase)' => [ 
                '#ALL', 
            ],
            '#all with white spaces' => [ 
                '    #all    ', 
            ], 
            'extension (uppercase)' => [ 
                'Extension', 
            ],
            'restriction (uppercase)' => [ 
                'Restriction', 
            ],
            '#all with extension' => [ 
                '#all extension', 
            ],
            '#all with restriction' => [ 
                'restriction #all', 
            ],
            'Value not extension neither restriction in list' => [ 
                'extension foo restriction', 
            ],
        ];
    }
}
