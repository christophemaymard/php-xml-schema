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
     * Returns a set of valid ID datatype values.
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
     * Returns a set of invalid ID datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidIdValues():array
    {
        return [
            'Empty string' => [
                '', 
                '"" is an invalid ID datatype.', 
            ], 
            'Only white spaces' => [
                '       ', 
                '"" is an invalid ID datatype.', 
            ], 
            'Separated by whitespaces' => [
                'foo bar', 
                '"foo bar" is an invalid ID datatype.', 
            ], 
            'Starts with digit' => [
                '8foo', 
                '"8foo" is an invalid ID datatype.', 
            ], 
            'Starts with .' => [
                '.foo', 
                '".foo" is an invalid ID datatype.', 
            ], 
            'Starts with -' => [
                '-foo', 
                '"-foo" is an invalid ID datatype.', 
            ], 
            'Contains invalid character' => [
                'foo:bar', 
                '"foo:bar" is an invalid ID datatype.', 
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
     * Returns a set of valid "token" datatype values.
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
     * Returns a set of invalid "token" datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidTokenValues():array
    {
        return [
            'Contains invalid character (U+001F)' => [ 
                "\u{001F}", 
                "\"\u{001F}\" is an invalid token datatype.", 
            ],
        ];
    }
    
    /**
     * Returns a set of valid NCName datatype values.
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
     * Returns a set of invalid NCName datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidNCNameValues():array
    {
        return [
            'Empty string' => [
                '', 
                '"" is an invalid NCName datatype.', 
            ], 
            'Only white spaces' => [
                '       ', 
                '"" is an invalid NCName datatype.', 
            ], 
            'Separated by whitespaces' => [
                'foo bar', 
                '"foo bar" is an invalid NCName datatype.', 
            ], 
            'Starts with digit' => [
                '8foo', 
                '"8foo" is an invalid NCName datatype.', 
            ], 
            'Starts with .' => [
                '.foo', 
                '".foo" is an invalid NCName datatype.', 
            ], 
            'Starts with -' => [
                '-foo', 
                '"-foo" is an invalid NCName datatype.', 
            ], 
            'Contains invalid character' => [
                'foo:bar', 
                '"foo:bar" is an invalid NCName datatype.', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid QName datatype (without prefix) values.
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
     * Returns a set of invalid QName datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidQNameValues():array
    {
        return [
            // Prefix is absent and local part is invalid.
            'Prefix (absent), local part (empty string)' => [
                '', 
                '"" is an invalid NCName datatype.', 
            ], 
            'Prefix (absent), local part (only white spaces)' => [
                '       ', 
                '"" is an invalid NCName datatype.', 
            ], 
            'Prefix (absent), local part (separated by white spaces)' => [
                'foo bar', 
                '"foo bar" is an invalid NCName datatype.', 
            ], 
            'Prefix (absent), local part (starts with digit)' => [
                '8foo', 
                '"8foo" is an invalid NCName datatype.', 
            ], 
            'Prefix (absent), local part (starts with .)' => [
                '.foo', 
                '".foo" is an invalid NCName datatype.', 
            ], 
            'Prefix (absent), local part (starts with -)' => [
                '-foo', 
                '"-foo" is an invalid NCName datatype.', 
            ], 
            'Prefix (absent), local part (contains invalid character)' => [
                'foo+bar', 
                '"foo+bar" is an invalid NCName datatype.', 
            ], 
            // Prefix is invalid and local part is valid.
            'Prefix (empty string), local part (valid)' => [
                ':qux', 
                '"" is an invalid NCName datatype.', 
            ], 
            'Prefix (only white spaces), local part (valid)' => [
                '       :qux', 
                '"" is an invalid NCName datatype.', 
            ], 
            'Prefix (separated by white spaces), local part (valid)' => [
                'foo bar:qux', 
                '"foo bar" is an invalid NCName datatype.', 
            ], 
            'Prefix (starts with digit), local part (valid)' => [
                '8foo:qux', 
                '"8foo" is an invalid NCName datatype.', 
            ], 
            'Prefix (starts with .), local part (valid)' => [
                '.foo:qux', 
                '".foo" is an invalid NCName datatype.', 
            ], 
            'Prefix (starts with -), local part (valid)' => [
                '-foo:qux', 
                '"-foo" is an invalid NCName datatype.', 
            ], 
            'Prefix (contains invalid character), local part (valid)' => [
                'foo+bar:qux', 
                '"foo+bar" is an invalid NCName datatype.', 
            ], 
            // Prefix is valid, and local part is invalid.
            'Prefix (valid), local part (empty string)' => [
                'qux:', 
                '"" is an invalid NCName datatype.', 
            ], 
            'Prefix (valid), local part (only white spaces)' => [
                'qux:       ', 
                '"" is an invalid NCName datatype.', 
            ], 
            'Prefix (valid), local part (separated by white spaces)' => [
                'qux:foo bar', 
                '"foo bar" is an invalid NCName datatype.', 
            ], 
            'Prefix (valid), local part (starts with digit)' => [
                'qux:8foo', 
                '"8foo" is an invalid NCName datatype.', 
            ], 
            'Prefix (valid), local part (starts with .)' => [
                'qux:.foo', 
                '".foo" is an invalid NCName datatype.', 
            ], 
            'Prefix (valid), local part (starts with -)' => [
                'qux:-foo', 
                '"-foo" is an invalid NCName datatype.', 
            ], 
            'Prefix (valid), local part (contains invalid character)' => [
                'qux:foo+bar', 
                '"foo+bar" is an invalid NCName datatype.', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid QName list with QName (without prefix) values.
     * 
     * @return  array[]
     */
    public function getValidQNameListLValues():array
    {
        return [
            // 1 QName
            'QName 1 (no prefix, local part starts with _)' => [ 
                '_foo', 
                [ '_foo', ], 
            ], 
            'QName 1 (no prefix, local part starts with letter)' => [ 
                'f', 
                [ 'f', ], 
            ], 
            'QName 1 (no prefix, local part contains letter)' => [ 
                'foo', 
                [ 'foo', ], 
            ], 
            'QName 1 (no prefix, local part contains digit)' => [ 
                'f00', 
                [ 'f00', ], 
            ], 
            'QName 1 (no prefix, local part contains .)' => [ 
                'f.bar', 
                [ 'f.bar', ], 
            ], 
            'QName 1 (no prefix, local part contains -)' => [ 
                'f-bar', 
                [ 'f-bar', ], 
            ], 
            'QName 1 (no prefix, local part contains _)' => [ 
                'f_bar', 
                [ 'f_bar', ], 
            ], 
            'QName 1 (no prefix, local part surrounded by whitespaces)' => [ 
                "  \t  \n  \r  foo_bar  \t  \n  \r  ", 
                [ 'foo_bar', ], 
            ], 
            // 2 QName
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part starts with _)' => [ 
                'baz _foo', 
                [ 'baz', '_foo', ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part starts with letter)' => [ 
                'baz f', 
                [ 'baz', 'f', ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains letter)' => [ 
                'baz foo', 
                [ 'baz', 'foo', ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains digit)' => [ 
                'baz f00', 
                [ 'baz', 'f00', ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains .)' => [ 
                'baz f.bar', 
                [ 'baz', 'f.bar', ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains -)' => [ 
                'baz f-bar', 
                [ 'baz', 'f-bar', ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains _)' => [ 
                'baz f_bar', 
                [ 'baz', 'f_bar', ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part surrounded by whitespaces)' => [ 
                " \r  \t   qux      \t  \n  \r  foo_bar  \t  \n  \r  ", 
                [ 'qux', 'foo_bar', ], 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid QName list values.
     * 
     * @return  array[]
     */
    public function getInvalidQNameListValues():array
    {
        return [
            'Empty string' => [
                '', 
                '"" is an invalid NCName datatype.', 
            ], 
            'Contains only white spaces' => [
                '       ', 
                '"" is an invalid NCName datatype.', 
            ], 
            
            
            
            // QName 1 (no prefix, local part is invalid).
            'QName 1 (prefix is absent, local part starts with digit)' => [
                '8foo', 
                '"8foo" is an invalid NCName datatype.', 
            ], 
            'QName 1 (prefix is absent, local part starts with .)' => [
                '.foo', 
                '".foo" is an invalid NCName datatype.', 
            ], 
            'QName 1 (prefix is absent, local part starts with -)' => [
                '-foo', 
                '"-foo" is an invalid NCName datatype.', 
            ], 
            'QName 1 (prefix is absent, local part contains invalid character)' => [
                'foo+bar', 
                '"foo+bar" is an invalid NCName datatype.', 
            ], 
            // QName 1 (prefix is invalid, local part is valid).
            'QName 1 (prefix is empty string, local part is valid)' => [
                ':foo', 
                '"" is an invalid NCName datatype.', 
            ], 
            'QName 1 (prefix contains only white spaces, local part is valid)' => [
                '       :foo', 
                '"" is an invalid NCName datatype.', 
            ], 
            'QName 1 (prefix starts with digit, local part is valid)' => [
                '8foo:bar', 
                '"8foo" is an invalid NCName datatype.', 
            ], 
            'QName 1 (prefix starts with ., local part is valid)' => [
                '.foo:bar', 
                '".foo" is an invalid NCName datatype.', 
            ], 
            'QName 1 (prefix starts with -, local part is valid)' => [
                '-foo:bar', 
                '"-foo" is an invalid NCName datatype.', 
            ], 
            'QName 1 (prefix contains invalid character, local part is valid)' => [
                'foo+bar:baz', 
                '"foo+bar" is an invalid NCName datatype.', 
            ], 
            // QName 1 (prefix is valid, local part is invalid).
            'QName 1 (prefix is valid, local part is empty string)' => [
                'foo:', 
                '"" is an invalid NCName datatype.', 
            ], 
            'QName 1 (prefix is valid, local part contains only white spaces)' => [
                'foo:       ', 
                '"" is an invalid NCName datatype.', 
            ], 
            'QName 1 (prefix is valid, local part starts with digit)' => [
                'foo:8bar', 
                '"8bar" is an invalid NCName datatype.', 
            ], 
            'QName 1 (prefix is valid, local part starts with .)' => [
                'foo:.bar', 
                '".bar" is an invalid NCName datatype.', 
            ], 
            'QName 1 (prefix is valid, local part starts with -)' => [
                'foo:-bar', 
                '"-bar" is an invalid NCName datatype.', 
            ], 
            'QName 1 (prefix is valid, local part contains invalid character)' => [
                'foo:bar+baz', 
                '"bar+baz" is an invalid NCName datatype.', 
            ], 
            
            
            
            // QName 1 (valid), QName 2 (no prefix, local part is invalid).
            'QName 1 (valid), QName 2 (prefix is absent, local part starts with digit)' => [
                'qux 8foo', 
                '"8foo" is an invalid NCName datatype.', 
            ], 
            'QName 1 (valid), QName 2 (prefix is absent, local part starts with .)' => [
                'qux .foo', 
                '".foo" is an invalid NCName datatype.', 
            ], 
            'QName 1 (valid), QName 2 (prefix is absent, local part starts with -)' => [
                'qux -foo', 
                '"-foo" is an invalid NCName datatype.', 
            ], 
            'QName 1 (valid), QName 2 (prefix is absent, local part contains invalid character)' => [
                'qux foo+bar', 
                '"foo+bar" is an invalid NCName datatype.', 
            ], 
            // QName 1 (valid), QName 2 (prefix is invalid, local part is valid).
            'QName 1 (valid), QName 2 (prefix is empty string, local part is valid)' => [
                'qux :foo', 
                '"" is an invalid NCName datatype.', 
            ], 
            'QName 1 (valid), QName 2 (prefix contains only white spaces, local part is valid)' => [
                'qux        :foo', 
                '"" is an invalid NCName datatype.', 
            ], 
            'QName 1 (valid), QName 2 (prefix starts with digit, local part is valid)' => [
                'qux 8foo:bar', 
                '"8foo" is an invalid NCName datatype.', 
            ], 
            'QName 1 (valid), QName 2 (prefix starts with ., local part is valid)' => [
                'qux .foo:bar', 
                '".foo" is an invalid NCName datatype.', 
            ], 
            'QName 1 (valid), QName 2 (prefix starts with -, local part is valid)' => [
                'qux -foo:bar', 
                '"-foo" is an invalid NCName datatype.', 
            ], 
            'QName 1 (valid), QName 2 (prefix contains invalid character, local part is valid)' => [
                'qux foo+bar:baz', 
                '"foo+bar" is an invalid NCName datatype.', 
            ], 
            // QName 1 (valid), QName 2 (prefix is valid, local part is invalid).
            'QName 1 (valid), QName 2 (prefix is valid, local part is empty string)' => [
                'qux foo:', 
                '"" is an invalid NCName datatype.', 
            ], 
            'QName 1 (valid), QName 2 (prefix is valid, local part contains only white spaces)' => [
                'qux foo:       ', 
                '"" is an invalid NCName datatype.', 
            ], 
            'QName 1 (valid), QName 2 (prefix is valid, local part starts with digit)' => [
                'qux foo:8bar', 
                '"8bar" is an invalid NCName datatype.', 
            ], 
            'QName 1 (valid), QName 2 (prefix is valid, local part starts with .)' => [
                'qux foo:.bar', 
                '".bar" is an invalid NCName datatype.', 
            ], 
            'QName 1 (valid), QName 2 (prefix is valid, local part starts with -)' => [
                'qux foo:-bar', 
                '"-bar" is an invalid NCName datatype.', 
            ], 
            'QName 1 (valid), QName 2 (prefix is valid, local part contains invalid character)' => [
                'qux foo:bar+baz', 
                '"bar+baz" is an invalid NCName datatype.', 
            ], 
        ];
    }
}
