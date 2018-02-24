<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Datatype;

use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the "NCName" datatype.
 * 
 * It is a XML "non-colonized" name; it matches the "NCName" production of 
 * "Namespaces in XML" defined as below:
 * 
 * NCName ::= (Letter | '_') (NCNameChar)*
 * 
 * The "BaseChar" and the "CombiningChar" character classes are partially 
 * implemented.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NCNameType
{
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
     * The "BaseChar" character class.
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
     * The "CombiningChar" character class.
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
    
    /**
     * The value.
     * @var string
     */
    private $value;
    
    /**
     * Constructor.
     * 
     * @param   string  $value  The name to set.
     * 
     * @throws  InvalidValueException   When the value is an invalid NCName.
     */
    public function __construct(string $value)
    {
        $this->setValue($value);
    }
    
    /**
     * Sets the value.
     * 
     * @param   string  $value  The value to set.
     * 
     * @throws  InvalidValueException   When the value is an invalid NCName.
     */
    private function setValue(string $value)
    {
        if (!\preg_match('`^[_'.self::LETTER.']['.self::NCNAMECHAR.']*$`u', $value)) {
            throw new InvalidValueException(sprintf('"%s" is an invalid NCName.', $value));
        }
        
        $this->value = $value;
    }
    
    /**
     * Returns the string representation of the name.
     * 
     * @return  string
     */
    public function getString():string
    {
        return $this->value;
    }
}
