<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Datatype;

/**
 * Represents a class that specifies character classes defined in the XML 
 * specification.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class XmlCharClass
{
    /**
     * The "Char" character class.
     * 
     * Char ::= #x9 | #xA | #xD | [#x20-#xD7FF] | [#xE000-#xFFFD] | [#x10000-#x10FFFF]
     */
    const CHAR = "\u{0009}\u{000A}\u{000D}\u{0020}-\u{D7FF}\u{E000}-\u{FFFD}\u{10000}-\u{10FFFF}";
    
    /**
     * The "NCNameChar" character class.
     * 
     * NCNameChar ::= Letter | Digit | '.' | '-' | '_' | CombiningChar | Extender
     */
    const NCNAMECHAR = self::LETTER.self::DIGIT.'.\\-_'.self::COMBININGCHAR.self::EXTENDER;
    
    /**
     * The "Letter" character class.
     * 
     * Letter ::= BaseChar | Ideographic
     */
    const LETTER = self::BASECHAR.self::IDEOGRAPHIC;
    
    /**
     * The "BaseChar" character class (partially implemented).
     */
    const BASECHAR = "\u{0041}-\u{005A}". // Latin: Uppercase alphabet.
        "\u{0061}-\u{007A}"; // Latin: Lowercase alphabet.
    
    /**
     * The "Ideographic" character class.
     */
    const IDEOGRAPHIC = "\u{4E00}-\u{9FA5}". // CJK: Unified ideographs.
        "\u{3007}". // CJK: Number 0.
        "\u{3021}-\u{3029}"; // CJK: Suzhou numerals.
    
    /**
     * The "Digit" character class.
     */
    const DIGIT = "\u{0030}-\u{0039}". // Latin: ASCII digits.
        "\u{0660}-\u{0669}". // Arabic: Arabic-Indic digits.
        "\u{06F0}-\u{06F9}". // Arabic: Eastern Arabic-Indic digits.
        "\u{0966}-\u{096F}". // Devanagari: Digits.
        "\u{09E6}-\u{09EF}". // Bengali: Digits.
        "\u{0A66}-\u{0A6F}". // Gurmukhi: Digits.
        "\u{0AE6}-\u{0AEF}". // Gujarati: Digits.
        "\u{0B66}-\u{0B6F}". // Oriya: Digits.
        "\u{0BE7}-\u{0BEF}". // Tamil: Digits.
        "\u{0C66}-\u{0C6F}". // Telugu: Digits.
        "\u{0CE6}-\u{0CEF}". // Kannada: Digits.
        "\u{0D66}-\u{0D6F}". // Malayalam: Digits.
        "\u{0E50}-\u{0E59}". // Thai: Digits.
        "\u{0ED0}-\u{0ED9}". // Lao: Digits.
        "\u{0F20}-\u{0F29}"; // Tibetan: Digits.
    
    /**
     * The "CombiningChar" character class (partially implemented).
     */
    const COMBININGCHAR = "\u{0300}-\u{0345}"; // Combining diacritical marks.
    
    /**
     * The "Extender" character class.
     */
    const EXTENDER = "\u{00B7}". // Latin-1: Middle dot.
        "\u{02D0}". // Spacing modifier letter: Triangular colon.
        "\u{02D1}". // Spacing modifier letter: Half triangular colon.
        "\u{0387}". // Greek: Ano Teleia.
        "\u{0640}". // Arabic: Tatweel.
        "\u{0E46}". // Thai: Maiyamok.
        "\u{0EC6}". // Lao: Ko La.
        "\u{3005}". // CJK: Iteration mark.
        "\u{3031}-\u{3035}". // CJK: Vertical kana repeat.
        "\u{309D}". // Hiragana: Hiragana iteration mark.
        "\u{309E}". // Hiragana: Hiragana voiced iteration mark.
        "\u{30FC}". // Katakana: Katakana-hiragana prolonged sound mark.
        "\u{30FD}". // Katakana: Katakana iteration mark.
        "\u{30FE}"; // Katakana: Katakana voiced iteration mark.
}
