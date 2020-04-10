<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

/**
 * Represents a trait that provides datasets to unit test "token" datatype.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait TokenTypeProviderTrait
{
    /**
     * Returns a set of valid "token" datatype values.
     * 
     * @return  array[]
     */
    public function getValidTokenTypeValues():array
    {
        return $this->getCommonValidTokenTypeValues();
    }
    
    /**
     * Returns a set of valid "token" datatype values (with white space 
     * processing).
     * 
     * @return  array[]
     */
    public function getValidTokenTypeWSValues():array
    {
        return \array_merge(
            $this->getCommonValidTokenTypeValues(), 
            [
                'Only white spaces' => [ 
                    '     ', 
                    '', 
                ], 
                'Contains leading spaces' => [ 
                    '     foo', 
                    'foo', 
                ], 
                'Contains trailing spaces' => [ 
                    'foo   ', 
                    'foo', 
                ], 
                'Contains internal sequence of 2 spaces' => [ 
                    'foo  bar', 
                    'foo bar', 
                ], 
            ]
        );
    }
    
    /**
     * Returns a set of common valid "token" datatype values.
     * 
     * @return  array[]
     */
    private function getCommonValidTokenTypeValues():array
    {
        return [
            'Empty string' => [
                '', 
                '', 
            ],
            'Contains U+6C10 character' => [
                "\u{6C10}", 
                "\u{6C10}", 
            ],
            'Contains U+D7FF character' => [
                "\u{D7FF}", 
                "\u{D7FF}", 
            ],
            'Contains U+E000 character' => [
                "\u{E000}", 
                "\u{E000}", 
            ],
            'Contains U+EFFF character' => [
                "\u{EFFF}", 
                "\u{EFFF}", 
            ],
            'Contains U+FFFD character' => [
                "\u{FFFD}", 
                "\u{FFFD}", 
            ],
            'Contains U+10000 character' => [
                "\u{10000}", 
                "\u{10000}", 
            ],
            'Contains U+90000 character' => [
                "\u{90000}", 
                "\u{90000}", 
            ],
            'Contain U+10FFFF character' => [
                "\u{10FFFF}", 
                "\u{10FFFF}", 
            ],
            'Contains internal sequence of 1 space' => [
                'foo bar baz', 
                'foo bar baz', 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid "token" datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidTokenTypeValues():array
    {
        return \array_merge(
            $this->getCommonInvalidTokenTypeValues(),
            [
                'Contains invalid character (U+0009)' => [ 
                    "\u{0009}", 
                    "\u{0009}", 
                ],
                'Contains invalid character (U+000A)' => [ 
                    "\u{000A}", 
                    "\u{000A}", 
                ],
                'Contains invalid character (U+000D)' => [ 
                    "\u{000D}", 
                    "\u{000D}", 
                ],
                'Contains leading space' => [
                    ' foo', 
                    ' foo', 
                ],
                'Contains trailing space' => [
                    'foo ', 
                    'foo ', 
                ],
                'Contains internal sequence of 2 spaces' => [
                    'foo  bar', 
                    'foo  bar', 
                ],
            ]
        );
    }
    
    /**
     * Returns a set of invalid "token" datatype values (with white space 
     * processing)
     * 
     * @return  array[]
     */
    public function getInvalidTokenTypeWSValues():array
    {
        return $this->getCommonInvalidTokenTypeValues();
    }
    
    /**
     * Returns a set of common invalid "token" datatype values.
     * 
     * @return  array[]
     */
    private function getCommonInvalidTokenTypeValues():array
    {
        return [
            'Contains invalid character (U+0000)' => [ 
                "\u{0000}", 
                "\u{0000}", 
            ],
            'Contains invalid character (U+0008)' => [ 
                "\u{0008}", 
                "\u{0008}", 
            ],
            'Contains invalid character (U+000E)' => [ 
                "\u{000E}", 
                "\u{000E}", 
            ],
            'Contains invalid character (U+001F)' => [ 
                "\u{001F}", 
                "\u{001F}", 
            ],
            'Contains invalid character (U+D800)' => [ 
                "\u{D800}", 
                "\u{D800}", 
            ],
            'Contains invalid character (U+DC00)' => [ 
                "\u{DC00}", 
                "\u{DC00}", 
            ],
            'Contains invalid character (U+DFFF)' => [ 
                "\u{DFFF}", 
                "\u{DFFF}", 
            ],
            'Contains invalid character (U+FFFE)' => [ 
                "\u{FFFE}", 
                "\u{FFFE}", 
            ],
            'Contains invalid character (U+001F)' => [ 
                "\u{001F}", 
                "\u{001F}", 
            ],
            'Contains invalid character (U+001F)' => [ 
                "\u{001F}", 
                "\u{001F}", 
            ],
            'Contains invalid character (U+FFFF)' => [ 
                "\u{FFFF}", 
                "\u{FFFF}", 
            ],
        ];
    }
}
