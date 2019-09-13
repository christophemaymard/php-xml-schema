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
}
