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
    
    /**
     * Returns a set of valid "blockSet" values.
     * 
     * @return  array[]
     */
    public function getValidBlockSetValues():array
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
    public function getInvalidBlockSetValues():array
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
    public function getValidFullDerivationSetValues():array
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
    public function getInvalidFullDerivationSetValues():array
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
     * Returns a set of valid ID values.
     * 
     * @return  array[]
     */
    public function getValidIdValues():array
    {
        return [
            'Starts with _' => [ 
                '_foo', '_foo', 
            ], 
            'Starts with letter' => [ 
                'f', 'f', 
            ], 
            'Contains letter' => [ 
                'foo', 'foo', 
            ], 
            'Contains digit' => [ 
                'f00', 'f00', 
            ], 
            'Contains .' => [ 
                'f.bar', 'f.bar', 
            ], 
            'Contains -' => [ 
                'f-bar', 'f-bar', 
            ], 
            'Contains _' => [ 
                'f_bar', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [ 
                "  \t  \n  \r  foo_bar  \t  \n  \r  ", 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid ID values.
     * 
     * @return  array[]
     */
    public function getInvalidIdValues():array
    {
        return [
            'Empty string' => [
                '', 
                '"" is an invalid ID.', 
            ], 
            'Only white spaces' => [
                '       ', 
                '"" is an invalid ID.', 
            ], 
            'Separated by whitespaces' => [
                'foo bar', 
                '"foo bar" is an invalid ID.', 
            ], 
            'Starts with digit' => [
                '8foo', 
                '"8foo" is an invalid ID.', 
            ], 
            'Starts with .' => [
                '.foo', 
                '".foo" is an invalid ID.', 
            ], 
            'Starts with -' => [
                '-foo', 
                '"-foo" is an invalid ID.', 
            ], 
            'Contains invalid character' => [
                'foo:bar', 
                '"foo:bar" is an invalid ID.', 
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
