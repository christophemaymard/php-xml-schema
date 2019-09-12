<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

/**
 * Represents a trait that provides datasets to unit test "string" datatype.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait StringTypeProviderTrait
{
    /**
     * Returns a set of valid "string" datatype values.
     * 
     * @return  array[]
     */
    public function getValidStringTypeValues():array
    {
        return [
            'Empty string' => [
                '', 
            ], 
            'Contains U+0009 character' => [
                "\u{0009}", 
            ], 
            'Contains U+000A character' => [
                "\u{000A}", 
            ], 
            'Contains U+000D character' => [
                "\u{000D}", 
            ], 
            'Contains U+0020 character' => [
                "\u{0020}", 
            ], 
            'Contains U+6C10 character' => [
                "\u{6C10}", 
            ], 
            'Contains U+D7FF character' => [
                "\u{D7FF}", 
            ], 
            'Contains U+E000 character' => [
                "\u{E000}", 
            ], 
            'Contains U+EFFF character' => [
                "\u{EFFF}", 
            ], 
            'Contains U+FFFD character' => [
                "\u{FFFD}", 
            ], 
            'Contains U+10000 character' => [
                "\u{10000}", 
            ], 
            'Contains U+10000 character' => [
                "\u{10000}", 
            ], 
            'Contains U+90000 character' => [
                "\u{90000}", 
            ], 
            'Contains U+10FFFF character' => [
                "\u{10FFFF}", 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid "string" datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidStringTypeValues():array
    {
        return [
            'Contains invalid character (U+0000)' => [
                "\u{0000}", 
            ], 
            'Contains invalid character (U+0008)' => [
                "\u{0008}", 
            ], 
            'Contains invalid character (U+000E)' => [
                "\u{000E}", 
            ], 
            'Contains invalid character (U+001F)' => [
                "\u{001F}", 
            ], 
            'Contains invalid character (U+D800)' => [
                "\u{D800}", 
            ], 
            'Contains invalid character (U+DC00)' => [
                "\u{DC00}", 
            ], 
            'Contains invalid character (U+DFFF)' => [
                "\u{DFFF}", 
            ], 
            'Contains invalid character (U+DFFF)' => [
                "\u{DFFF}", 
            ], 
            'Contains invalid character (U+FFFE)' => [
                "\u{FFFE}", 
            ], 
            'Contains invalid character (U+FFFF)' => [
                "\u{FFFF}", 
            ], 
        ];
    }
}