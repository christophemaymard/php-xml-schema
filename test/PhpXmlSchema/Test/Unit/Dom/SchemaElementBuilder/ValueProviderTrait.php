<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

/**
 * Represents a trait that provides set of values for the tests related to 
 * attributes.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait ValueProviderTrait
{
    /**
     * Returns a set of invalid "formChoice" values.
     * 
     * @return  array[]
     */
    public function getInvalidFormChoiceValues():array
    {
        return [
            'Qualified' => [ 
                'Qualified', 
            ],
            'Unqualified' => [ 
                'Unqualified', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "blockSet" values.
     * 
     * @return  array[]
     */
    public function getValidBlockSetValues():array
    {
        // [ $value, $restriction, $extension, $substitution, ]
        return [
            '' => [ 
                '', FALSE, FALSE, FALSE, 
            ],
            '#all' => [ 
                '#all', TRUE, TRUE, TRUE, 
            ],
            
            'restriction' => [ 
                "\t \r \n  restriction  ", TRUE, FALSE, FALSE, 
            ],
            'extension' => [ 
                " extension\r", FALSE, TRUE, FALSE, 
            ],
            'substitution' => [ 
                "   substitution   ", FALSE, FALSE, TRUE, 
            ],
            
            'restriction extension' => [ 
                "\t\t\t restriction \n   \rextension\n ", TRUE, TRUE, FALSE, 
            ],
            'substitution restriction' => [ 
                "\n\n\nsubstitution restriction", TRUE, FALSE, TRUE, 
            ],
            'extension substitution' => [ 
                "extension\t\t\tsubstitution\n\n\n", FALSE, TRUE, TRUE, 
            ],
            'restriction restriction' => [ 
                "    restriction      restriction   ", TRUE, FALSE, FALSE, 
            ],
            'extension extension' => [ 
                "extension extension", FALSE, TRUE, FALSE, 
            ],
            'substitution substitution' => [ 
                "substitution substitution", FALSE, FALSE, TRUE, 
            ],
            
            'substitution extension restriction' => [ 
                "substitution\t \r \nextension\t \r \nrestriction", TRUE, TRUE, TRUE, 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid "blockSet" values.
     * 
     * @return  array[]
     */
    public function getInvalidBlockSetValues():array
    {
        return [
            '#ALL' => [ 
                '#ALL', 
            ],
            
            'subStitution' => [ 
                'subStitution', 
            ],
            'exTension' => [ 
                'exTension', 
            ],
            'Restriction' => [ 
                'Restriction', 
            ],
            
            '#all substitution' => [ 
                '#all substitution', 
            ],
            'extension #all' => [ 
                'extension #all', 
            ],
            '#all restriction' => [ 
                '#all restriction', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "fullDerivationSet" values.
     * 
     * @return  array[]
     */
    public function getValidFullDerivationSetValues():array
    {
        // [ $value, $extension, $restriction, $list, $union, ]
        return [
            '' => [ 
                "", FALSE, FALSE, FALSE, FALSE, 
            ],
            '#all' => [ 
                '#all', TRUE, TRUE, TRUE, TRUE, 
            ],
            
            'extension' => [ 
                "\t \r \n  extension  ", TRUE, FALSE, FALSE, FALSE, 
            ],
            'restriction' => [ 
                " restriction\r", FALSE, TRUE, FALSE, FALSE, 
            ],
            'list' => [ 
                "   list   ", FALSE, FALSE, TRUE, FALSE, 
            ],
            'union' => [ 
                "   union   ", FALSE, FALSE, FALSE, TRUE, 
            ],
            
            'extension extension' => [ 
                "\t extension\r \n  extension  ", TRUE, FALSE, FALSE, FALSE, 
            ],
            'restriction restriction' => [ 
                "restriction restriction\r", FALSE, TRUE, FALSE, FALSE, 
            ],
            'list list' => [ 
                "  list list   ", FALSE, FALSE, TRUE, FALSE, 
            ],
            'union union' => [ 
                "   union union  ", FALSE, FALSE, FALSE, TRUE, 
            ],
            
            'extension restriction' => [ 
                "\t \r \n  extension   restriction\r", TRUE, TRUE, FALSE, FALSE, 
            ],
            'extension list' => [ 
                "\t \r \n  extension     list   ", TRUE, FALSE, TRUE, FALSE, 
            ],
            'extension union' => [ 
                "\t \r \n  extension     union   ", TRUE, FALSE, FALSE, TRUE, 
            ],
            'restriction extension' => [ 
                " restriction\r\t \r \n  extension  ", TRUE, TRUE, FALSE, FALSE, 
            ],
            'restriction list' => [ 
                " restriction\r   list   ", FALSE, TRUE, TRUE, FALSE, 
            ],
            'restriction union' => [ 
                " restriction\r   union   ", FALSE, TRUE, FALSE, TRUE, 
            ],
            'list extension' => [ 
                "   list \t \r \n  extension    ", TRUE, FALSE, TRUE, FALSE, 
            ],
            'list restriction' => [ 
                "   list  restriction\r  ", FALSE, TRUE, TRUE, FALSE, 
            ],
            'list union' => [ 
                "   list   union    ", FALSE, FALSE, TRUE, TRUE, 
            ],
            'union extension' => [ 
                "   union \r \n  extension  ", TRUE, FALSE, FALSE, TRUE, 
            ],
            'union restriction' => [ 
                "   union  restriction\r   ", FALSE, TRUE, FALSE, TRUE, 
            ],
            'union list' => [ 
                "   union \r \n list  ", FALSE, FALSE, TRUE, TRUE, 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid "fullDerivationSet" values.
     * 
     * @return  array[]
     */
    public function getInvalidFullDerivationSetValues():array
    {
        return [
            '#ALL' => [ 
                '#ALL', 
            ], 
            
            'substitution' => [ 
                'substitution', 
            ], 
            
            'extensiOn' => [ 
                'extensiOn', 
            ], 
            'resTriction' => [ 
                'resTriction', 
            ], 
            'lIst' => [ 
                'lIst', 
            ], 
            'uNion' => [ 
                'uNion', 
            ], 
            
            '#all extension' => [ 
                '#all extension', 
            ], 
            'restriction #all' => [ 
                'restriction #all', 
            ], 
            '#all list' => [ 
                '#all list', 
            ], 
            'union #all' => [ 
                'union #all', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid ID values.
     * 
     * @return  array[]
     */
    public function getValidIdValues():array
    {
        return [
            'foo' => [ 
                'foo', 'foo', 
            ],
            '  bar  ' => [ 
                '  bar  ', 'bar', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "anyURI" values.
     * 
     * @return  array[]
     */
    public function getValidAnyUriValues():array
    {
        return [
            'http://example.org' => [ 
                'http://example.org', 'http://example.org', 
            ],
            '  http://example.org  ' => [ 
                '  http://example.org  ', 'http://example.org', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "token" values.
     * 
     * @return  array[]
     */
    public function getValidTokenValues():array
    {
        return [
            'foo bar baz qux' => [ 
                'foo bar baz qux', 'foo bar baz qux', 
            ],
            '     foo       bar      baz      qux     ' => [ 
                '     foo       bar      baz      qux     ', 'foo bar baz qux', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "language" values.
     * 
     * @return  array[]
     */
    public function getValidLanguageValues():array
    {
        return [
            'fr' => [ 
                'fr', 'fr', [], 
            ],
            'en-us' => [ 
                'en-us', 'en', [ 'us', ], 
            ],
            'foo-bar1-baz2-qux3' => [ 
                'foo-bar1-baz2-qux3', 'foo', [ 'bar1', 'baz2', 'qux3', ], 
            ],
            '    foo-bar1-baz2-qux3    ' => [ 
                '    foo-bar1-baz2-qux3    ', 'foo', [ 'bar1', 'baz2', 'qux3', ], 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid "language" values.
     * 
     * @return  array[]
     */
    public function getInvalidLanguageValues():array
    {
        return [
            '' => [ 
                '', 
                '"" is an invalid primary subtag.', 
            ], 
            ' ' => [ 
                ' ', 
                '"" is an invalid primary subtag.', 
            ], 
            'foo9' => [ 
                'foo9', 
                '"foo9" is an invalid primary subtag.', 
            ], 
            'foo+' => [ 
                'foo+', 
                '"foo+" is an invalid primary subtag.', 
            ], 
            'veryverylongprimarytag' => [ 
                'veryverylongprimarytag', 
                '"veryverylongprimarytag" is an invalid primary subtag.', 
            ], 
            'foo-bar1-veryverylongsubtag' => [ 
                'foo-bar1-veryverylongsubtag', 
                '"veryverylongsubtag" is an invalid subtag.', 
            ],
            'foo-bar1-baz+' => [ 
                'foo-bar1-baz+', 
                '"baz+" is an invalid subtag.', 
            ], 
        ];
    }
}
