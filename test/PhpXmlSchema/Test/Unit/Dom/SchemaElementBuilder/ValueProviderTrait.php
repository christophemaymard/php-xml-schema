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
            'Primary subtag of 1 character' => [
                'f', 
                'f', 
                [], 
            ], 
            'Primary subtag of 8 characters' => [
                'foobarba', 
                'foobarba', 
                [], 
            ], 
            'Subtag of 1 character' => [
                'foo-b', 
                'foo', 
                [ 'b', ], 
            ], 
            'Subtag with number' => [
                'foo-bar1', 
                'foo', 
                [ 'bar1', ], 
            ], 
            'Language with white spaces' => [
                '    foo-bar1-baz2-qux3    ', 
                'foo', 
                [ 'bar1', 'baz2', 'qux3', ], 
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
            'Empty string' => [
                '', 
                '"" is an invalid primary subtag.', 
            ], 
            'Only white spaces' => [
                '       ', 
                '"" is an invalid primary subtag.', 
            ], 
            'Primary subtag contains number' => [ 
                'foo9', 
                '"foo9" is an invalid primary subtag.', 
            ], 
            'Primary subtag contains invalid character' => [ 
                'foo+', 
                '"foo+" is an invalid primary subtag.', 
            ], 
            'Primary subtag length is greater than 8' => [ 
                'verylongp', 
                '"verylongp" is an invalid primary subtag.', 
            ], 
            'Subtag contains invalid character' => [ 
                'foo-bar1-baz+', 
                '"baz+" is an invalid subtag.', 
            ], 
            'Subtag length is greater than 8' => [ 
                'foo-bar1-verylongs', 
                '"verylongs" is an invalid subtag.', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid NCName values.
     * 
     * @return  array[]
     */
    public function getValidNCNameValues():array
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
     * Returns a set of invalid NCName values.
     * 
     * @return  array[]
     */
    public function getInvalidNCNameValues():array
    {
        return [
            'Empty string' => [
                '', 
                '"" is an invalid NCName.', 
            ], 
            'Only white spaces' => [
                '       ', 
                '"" is an invalid NCName.', 
            ], 
            'Separated by whitespaces' => [
                'foo bar', 
                '"foo bar" is an invalid NCName.', 
            ], 
            'Starts with digit' => [
                '8foo', 
                '"8foo" is an invalid NCName.', 
            ], 
            'Starts with .' => [
                '.foo', 
                '".foo" is an invalid NCName.', 
            ], 
            'Starts with -' => [
                '-foo', 
                '"-foo" is an invalid NCName.', 
            ], 
            'Contains invalid character' => [
                'foo:bar', 
                '"foo:bar" is an invalid NCName.', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "string" datatype values.
     * 
     * @return  array[]
     */
    public function getValidStringValues():array
    {
        return [
            'Empty string' => [ '', ], 
            'Contains U+0009 character' => [ "\u{0009}", ], 
            'Contains U+000A character' => [ "\u{000A}", ], 
            'Contains U+000D character' => [ "\u{000D}", ], 
            'Contains U+0020 character' => [ "\u{0020}", ], 
            'Contains U+6C10 character' => [ "\u{6C10}", ], 
            'Contains U+D7FF character' => [ "\u{D7FF}", ], 
            'Contains U+E000 character' => [ "\u{E000}", ], 
            'Contains U+EFFF character' => [ "\u{EFFF}", ], 
            'Contains U+FFFD character' => [ "\u{FFFD}", ], 
            'Contains U+10000 character' => [ "\u{10000}", ], 
            'Contains U+10000 character' => [ "\u{10000}", ], 
            'Contains U+90000 character' => [ "\u{90000}", ], 
            'Contains U+10FFFF character' => [ "\u{10FFFF}", ], 
        ];
    }
    
    /**
     * Returns a set of invalid "string" datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidStringValues():array
    {
        return [
            'Contains invalid character (U+0000)' => [ "\u{0000}", ], 
            'Contains invalid character (U+0008)' => [ "\u{0008}", ], 
            'Contains invalid character (U+000E)' => [ "\u{000E}", ], 
            'Contains invalid character (U+001F)' => [ "\u{001F}", ], 
            'Contains invalid character (U+D800)' => [ "\u{D800}", ], 
            'Contains invalid character (U+DC00)' => [ "\u{DC00}", ], 
            'Contains invalid character (U+DFFF)' => [ "\u{DFFF}", ], 
            'Contains invalid character (U+DFFF)' => [ "\u{DFFF}", ], 
            'Contains invalid character (U+FFFE)' => [ "\u{FFFE}", ], 
            'Contains invalid character (U+FFFF)' => [ "\u{FFFF}", ], 
        ];
    }
    
    /**
     * Returns a set of valid QName (without prefix) values.
     * 
     * @return  array[]
     */
    public function getValidQNameLocalPartValues():array
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
     * Returns a set of invalid QName values.
     * 
     * @return  array[]
     */
    public function getInvalidQNameValues():array
    {
        return [
            // Prefix is absent and local part is invalid.
            'Prefix (absent), local part (empty string)' => [
                '', 
                '"" is an invalid NCName.', 
            ], 
            'Prefix (absent), local part (only white spaces)' => [
                '       ', 
                '"" is an invalid NCName.', 
            ], 
            'Prefix (absent), local part (separated by white spaces)' => [
                'foo bar', 
                '"foo bar" is an invalid NCName.', 
            ], 
            'Prefix (absent), local part (starts with digit)' => [
                '8foo', 
                '"8foo" is an invalid NCName.', 
            ], 
            'Prefix (absent), local part (starts with .)' => [
                '.foo', 
                '".foo" is an invalid NCName.', 
            ], 
            'Prefix (absent), local part (starts with -)' => [
                '-foo', 
                '"-foo" is an invalid NCName.', 
            ], 
            'Prefix (absent), local part (contains invalid character)' => [
                'foo+bar', 
                '"foo+bar" is an invalid NCName.', 
            ], 
            // Prefix is invalid and local part is valid.
            'Prefix (empty string), local part (valid)' => [
                ':qux', 
                '"" is an invalid NCName.', 
            ], 
            'Prefix (only white spaces), local part (valid)' => [
                '       :qux', 
                '"" is an invalid NCName.', 
            ], 
            'Prefix (separated by white spaces), local part (valid)' => [
                'foo bar:qux', 
                '"foo bar" is an invalid NCName.', 
            ], 
            'Prefix (starts with digit), local part (valid)' => [
                '8foo:qux', 
                '"8foo" is an invalid NCName.', 
            ], 
            'Prefix (starts with .), local part (valid)' => [
                '.foo:qux', 
                '".foo" is an invalid NCName.', 
            ], 
            'Prefix (starts with -), local part (valid)' => [
                '-foo:qux', 
                '"-foo" is an invalid NCName.', 
            ], 
            'Prefix (contains invalid character), local part (valid)' => [
                'foo+bar:qux', 
                '"foo+bar" is an invalid NCName.', 
            ], 
            // Prefix is valid, and local part is invalid.
            'Prefix (valid), local part (empty string)' => [
                'qux:', 
                '"" is an invalid NCName.', 
            ], 
            'Prefix (valid), local part (only white spaces)' => [
                'qux:       ', 
                '"" is an invalid NCName.', 
            ], 
            'Prefix (valid), local part (separated by white spaces)' => [
                'qux:foo bar', 
                '"foo bar" is an invalid NCName.', 
            ], 
            'Prefix (valid), local part (starts with digit)' => [
                'qux:8foo', 
                '"8foo" is an invalid NCName.', 
            ], 
            'Prefix (valid), local part (starts with .)' => [
                'qux:.foo', 
                '".foo" is an invalid NCName.', 
            ], 
            'Prefix (valid), local part (starts with -)' => [
                'qux:-foo', 
                '"-foo" is an invalid NCName.', 
            ], 
            'Prefix (valid), local part (contains invalid character)' => [
                'qux:foo+bar', 
                '"foo+bar" is an invalid NCName.', 
            ], 
        ];
    }
}
