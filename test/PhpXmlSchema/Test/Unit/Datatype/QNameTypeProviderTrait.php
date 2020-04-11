<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

/**
 * Represents a trait that provides datasets to unit test "QName" datatype.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait QNameTypeProviderTrait
{
    /**
     * Returns a set of valid "QName" datatype (without prefix) values.
     * 
     * @return  array[]
     */
    public function getValidLocalPartQNameTypeValues(): array
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
     * Returns a set of invalid "QName" datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidQNameTypeValues(): array
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
}
