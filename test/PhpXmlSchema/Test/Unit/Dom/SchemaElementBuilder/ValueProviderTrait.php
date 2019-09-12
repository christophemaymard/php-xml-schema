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
     * Returns a set of valid "boolean" datatype values.
     * 
     * @return  array[]
     */
    public function getValidBooleanValues():array
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
    public function getInvalidBooleanValues():array
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
    
    /**
     * Returns a set of valid "positiveInteger" datatype values.
     * 
     * @return  array[]
     */
    public function getValidPositiveIntegerValues():array
    {
        return [
            '1' => [ 
                '1', 
                \gmp_init(1), 
            ], 
            '1 with positive sign' => [ 
                '+1', 
                \gmp_init(1), 
            ], 
            '1 with positive sign and surrounded by white spaces' => [ 
                " \t \r  \n  +1   \t \r  \n   ", 
                \gmp_init(1), 
            ], 
            '1234567890' => [ 
                '1234567890', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign' => [ 
                '+1234567890', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign and surrounded by white spaces' => [ 
                " \t \r  \n  +1234567890   \t \r  \n   ", 
                \gmp_init(1234567890), 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid "positiveInteger" datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidPositiveIntegerValues():array
    {
        return [
            '0' => [ 
                '0', 
                '"0" is an invalid positiveInteger datatype.', 
            ], 
            '0 with positive sign' => [ 
                '+0', 
                '"+0" is an invalid positiveInteger datatype.', 
            ], 
            'Negative integer' => [ 
                '-9', 
                '"-9" is an invalid positiveInteger datatype.', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "nonNegativeInteger" datatype values.
     * 
     * @return  array[]
     */
    public function getValidNonNegativeIntegerValues():array
    {
        return [
            '0' => [ 
                '0', 
                \gmp_init(0), 
            ], 
            '0 with positive sign' => [ 
                '+0', 
                \gmp_init(0), 
            ], 
            '0 with positive sign and leading zeroes' => [ 
                '+000', 
                \gmp_init(0), 
            ], 
            '0 with positive sign, leading zeroes and surrounded by white spaces' => [ 
                " \t \r  \n  +00   \t \r  \n   ", 
                \gmp_init(0), 
            ], 
            '1234567890' => [ 
                '1234567890', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign' => [ 
                '+1234567890', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign and leading zeroes' => [ 
                '+001234567890', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign, leading zeroes and surrounded by white spaces' => [ 
                " \t \r  \n  +001234567890   \t \r  \n   ", 
                \gmp_init(1234567890), 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid "nonNegativeInteger" datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidNonNegativeIntegerValues():array
    {
        return [
            'Negative integer' => [ 
                '-9', 
                '"-9" is an invalid nonNegativeInteger datatype.', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid white space type values.
     * 
     * @return  array[]
     */
    public function getValidWhiteSpaceValues():array
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
    public function getInvalidWhiteSpaceValues():array
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
    
    /**
     * Returns a set of valid UseType values.
     * 
     * @return  array[]
     */
    public function getValidUseSetValues():array
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
    public function getInvalidUseValues():array
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
    
    /**
     * Returns a set of valid "namespaceList" values.
     * 
     * @return  array[]
     */
    public function getValidNamespaceListValues():array
    {
        // [ $value, $any, $other, $targetNamespace, $local, $uris, ]
        return [
            'Empty string' => [
                '', 
                FALSE, 
                FALSE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            'Only white spaces' => [
                '       ', 
                FALSE, 
                FALSE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            '##any' => [
                '##any', 
                TRUE, 
                FALSE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            '##other' => [
                '##other', 
                FALSE, 
                TRUE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            '##targetNamespace' => [
                '##targetNamespace', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [], 
            ],
            '##targetNamespace surrounded by white spaces' => [
                "  \r \n  ##targetNamespace  \t  ", 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [], 
            ],
            'Duplicated ##targetNamespace' => [
                '##targetNamespace ##targetNamespace', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [], 
            ],
            '##local' => [
                '##local', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [], 
            ], 
            '##local surrounded by white spaces' => [
                "   \t  \n    ##local  \r  ", 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [], 
            ], 
            'Duplicated ##local' => [
                '##local ##local', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [], 
            ], 
            '##targetNamespace and ##local' => [
                '##targetNamespace ##local', 
                FALSE, 
                FALSE, 
                TRUE, 
                TRUE, 
                [], 
            ], 
            '##targetNamespace and 1 anyURI' => [
                '##targetNamespace http://example.org/foo', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [ 
                    'http://example.org/foo', 
                ], 
            ], 
            '##local and 1 anyURI' => [
                '##local http://example.org/foo', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [ 
                    'http://example.org/foo', 
                ], 
            ], 
            '##targetNamespace and 2 anyURI' => [
                'http://example.org/foo ##targetNamespace http://example.org/bar', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [ 
                    'http://example.org/foo', 
                    'http://example.org/bar', 
                ], 
            ], 
            '##local and 2 anyURI' => [
                'http://example.org/foo ##local http://example.org/bar', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [ 
                    'http://example.org/foo', 
                    'http://example.org/bar', 
                ], 
            ], 
            '##targetNamespace, ##local and 2 AnyURI' => [
                'http://example.org/foo ##local http://example.org/bar ##targetNamespace', 
                FALSE, 
                FALSE, 
                TRUE, 
                TRUE, 
                [ 
                    'http://example.org/foo', 
                    'http://example.org/bar', 
                ], 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid "namespaceList" values.
     * 
     * @return  array[]
     */
    public function getInvalidNamespaceListValues():array
    {
        return [
            '##any surrounded by white spaces' => [
                "   \t \r  ##any   \n  ", 
            ], 
            '##other surrounded by white spaces' => [
                "  \r \n  ##other  \t  ", 
            ], 
            '##any and ##other' => [
                '##any ##other', 
            ], 
            '##any and ##targetNamespace' => [
                '##any ##targetNamespace', 
            ], 
            '##any and ##local' => [
                '##any ##local', 
            ], 
            '##other and ##targetNamespace' => [
                '##other ##targetNamespace', 
            ], 
            '##other and ##local' => [
                '##other ##local', 
            ], 
            '##any and 1 anyURI' => [
                '##any http://example.org/foo', 
            ], 
            '##other and 1 anyURI' => [
                '##other http://example.org/foo', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid ProcessingMode values.
     * 
     * @return  array[]
     */
    public function getValidProcessingModeValues():array
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
     * Returns a set of invalid ProcessingMode values.
     * 
     * @return  array[]
     */
    public function getInvalidProcessingModeValues():array
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
    
    /**
     * Returns a set of invalid NonNegativeIntegerLimitType type values.
     * 
     * @return  array[]
     */
    public function getInvalidNonNegativeIntegerLimitValues():array
    {
        return [
            'unbounded surrounded by white spaces' => [
                "   \t  \n  unbounded  \r   ", 
            ],
        ];
    }
    
    /**
     * Returns a set of valid NonNegativeIntegerLimitType type (with only 1) 
     * values.
     * 
     * @return  array[]
     */
    public function getValidOneNonNegativeIntegerLimitValues():array
    {
        return [
            '1' => [ 
                '1', 
            ], 
            '1 surrounded by white spaces' => [ 
                "   \r  \n   1    \t", 
            ], 
            '1 with positive sign' => [ 
                '+1', 
            ], 
            '1 with leading zeroes' => [ 
                '001', 
            ], 
            '1 with positive sign and leading zeroes' => [ 
                '+001', 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid NonNegativeIntegerLimitType type values.
     * 
     * @return  array[]
     */
    public function getInvalidOneNonNegativeIntegerLimitValues():array
    {
        return [
            'unbounded' => [ 
                'unbounded', 
            ], 
            'Non-negative integer other than 1' => [ 
                '0', 
            ], 
            'Negative integer' => [ 
                '-9', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "nonNegativeInteger" datatype (with only 0 or 
     * 1) values.
     * 
     * @return  array[]
     */
    public function getValidZeroOrOneNonNegativeIntegerValues():array
    {
        return [
            '0' => [ 
                '0', 
                \gmp_init(0), 
            ], 
            '0 surrounded by white spaces' => [ 
                "   \r  \n   0    \t", 
                \gmp_init(0), 
            ], 
            '0 with positive sign' => [ 
                '+0', 
                \gmp_init(0), 
            ], 
            '0 with leading zeroes' => [ 
                '000', 
                \gmp_init(0), 
            ], 
            '0 with positive sign and leading zeroes' => [ 
                '+000', 
                \gmp_init(0), 
            ], 
            '1' => [ 
                '1', 
                \gmp_init(1), 
            ], 
            '1 surrounded by white spaces' => [ 
                "   \r  \n   1    \t", 
                \gmp_init(1), 
            ], 
            '1 with positive sign' => [ 
                '+1', 
                \gmp_init(1), 
            ], 
            '1 with leading zeroes' => [ 
                '001', 
                \gmp_init(1), 
            ], 
            '1 with positive sign and leading zeroes' => [ 
                '+001', 
                \gmp_init(1), 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid "nonNegativeInteger" datatype (with only 0 or 
     * 1) values.
     * 
     * @return  array[]
     */
    public function getInvalidZeroOrOneNonNegativeIntegerValues():array
    {
        return [
            'Non-negative integer other than 0 or 1' => [ 
                '2', 
            ], 
            'Negative integer' => [ 
                '-9', 
            ], 
        ];
    }
}
