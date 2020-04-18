<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Dom;

/**
 * Represents a trait that provides datasets to unit test "QName" list type.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait QNameListTypeProviderTrait
{
    /**
     * Returns a set of valid QName list type with QName (without prefix) 
     * values.
     * 
     * @return  array[]
     */
    public function getValidQNameListTypeValues(): array
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
     * Returns a set of invalid QName list type values.
     * 
     * @return  array[]
     */
    public function getInvalidQNameListTypeValues(): array
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
