<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the base to unit tests a datatype that matches the "NCName" 
 * production in "Namespaces in XML".
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractNCNameTypeTestCase extends TestCase
{
    /**
     * Creates the SUT with the specified value.
     * 
     * @param   string  The value to test.
     * @return  mixed   The instance of the SUT.
     * 
     * @throws  InvalidValueException   When the value is invalid.
     */
    abstract protected function createSut(string $value);
    
    /**
     * Returns the name of the type.
     * 
     * @return  string
     */
    abstract protected function getTypeName():string;
    
    /**
     * Tests that __construct() throws an exception when the specified value 
     * is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @dataProvider    getInvalidValues
     */
    public function test__constructThrowsExceptionWhenValueIsInvalid(string $value)
    {
        $this->expectException(InvalidValueException::class);
        
        $message = \sprintf('"%s" is an invalid %s.', $value, $this->getTypeName());
        $this->expectExceptionMessage($message);
        
        $sut = $this->createSut($value);
    }
    
    /**
     * Tests that __construct() stores the value when it is valid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @dataProvider    getValidValues
     */
    public function test__constructStoresValueWhenItIsValid(string $value)
    {
        $sut = $this->createSut($value);
        self::assertSame($value, $sut->getString());
    }
    
    /**
     * Returns a set of invalid values.
     * 
     * @return  array[]
     */
    public function getInvalidValues():array
    {
        $datasets = [];
        
        $datasets['Empty string.'] = [ '', ];
        
        // Starts with a "Digit" character.
        $digits = $this->getValidDigitChars();
        
        foreach ($digits as $name => $char) {
            $idx = \sprintf('Start with a "Digit" (%s).', $name);
            $datasets[$idx] = [ $char, ];
        }
        
        $datasets['Start with a letter and contain a colon.'] = [ "A:", ];
        
        return $datasets;
    }
    
    /**
     * Returns a set of valid values.
     * 
     * @return  array[]
     */
    public function getValidValues():array
    {
        $datasets = [];
        $datasets['Start with an underscore.'] = [ '_', ];
        
        $baseChars = $this->getValidBaseChars();
        
        // Starts with a "BaseChar" character.
        foreach ($baseChars as $name => $char) {
            $idx = \sprintf('Start with a "BaseChar" (%s).', $name);
            $datasets[$idx] = [ $char, ];
        }
        
        $ideographics = $this->getValidIdeographicChars();
        
        // Starts with an "Ideographic" character.
        foreach ($ideographics as $name => $char) {
            $idx = \sprintf('Start with an "Ideographic" (%s).', $name);
            $datasets[$idx] = [ $char, ];
        }
        
        $datasets['Start with a letter and contain letters.'] = [ "XmlSchemaName", ];
        $datasets['Start with a letter and contain a dot.'] = [ "A.", ];
        $datasets['Start with a letter and contain a hyphen-minus.'] = [ "A-", ];
        $datasets['Start with a letter and contain an underscore.'] = [ "A_", ];
        
        // Starts with a letter and contains a "Digit" character.
        $digits = $this->getValidDigitChars();
        
        foreach ($digits as $name => $char) {
            $idx = \sprintf('Start with a letter and contain a "Digit" (%s).', $name);
            $datasets[$idx] = [ "A".$char, ];
        }
        
        // Starts with a letter and contains a "BaseChar" character.
        foreach ($baseChars as $name => $char) {
            $idx = \sprintf('Start with a letter and contain a "BaseChar" (%s).', $name);
            $datasets[$idx] = [ "A".$char, ];
        }
        
        // Starts with a letter and contains an "Ideographic" character.
        foreach ($ideographics as $name => $char) {
            $idx = \sprintf('Start with a letter and contain an "Ideographic" (%s).', $name);
            $datasets[$idx] = [ "A".$char, ];
        }
        
        // Starts with a letter and contains a "CombiningChar" character.
        $combiningChars = $this->getValidCombiningChars();
        
        foreach ($combiningChars as $name => $char) {
            $idx = \sprintf('Start with a letter and contain a "CombiningChar" (%s).', $name);
            $datasets[$idx] = [ "A".$char, ];
        }
        
        // Starts with a letter and contains an "Extender" character.
        $extenders = $this->getValidExtenderChars();
        
        foreach ($extenders as $name => $char) {
            $idx = \sprintf('Start with a letter and contain an "Extender" (%s).', $name);
            $datasets[$idx] = [ "A".$char, ];
        }
        
        return $datasets;
    }
    
    /**
     * Returns a set of valid "BaseChar" characters.
     * 
     * It returns an associative array where:
     * - the key is the identifier of the character
     * - the value is a valid character
     * 
     * @return  string[]
     */
    private function getValidBaseChars():array
    {
        return [
            'Latin: uppercase alphabet (first)' => "A",
            'Latin: uppercase alphabet (arbitrary)' => "M",
            'Latin: uppercase alphabet (last)' => "Z",
            'Latin: lowercase alphabet (first)' => "a",
            'Latin: lowercase alphabet (arbitrary)' => "m",
            'Latin: lowercase alphabet (last)' => "z",
        ];
    }
    
    /**
     * Returns a set of valid "Ideographic" characters.
     * 
     * It returns an associative array where:
     * - the key is the identifier of the character
     * - the value is a valid character
     * 
     * @return  string[]
     */
    private function getValidIdeographicChars():array
    {
        return [
            'CJK: Unified ideograph (first)' => "\u{4E00}",
            'CJK: Unified ideograph (arbitrary)' => "\u{7000}",
            'CJK: Unified ideograph (last)' => "\u{9FA5}",
            'CJK: Number 0' => "\u{3007}",
            'CJK: Suzhou numerals (first)' => "\u{3021}",
            'CJK: Suzhou numerals (arbitrary)' => "\u{3025}",
            'CJK: Suzhou numerals (last)' => "\u{3029}",
        ];
    }
    
    /**
     * Returns a set of valid "Digit" characters.
     * 
     * It returns an associative array where:
     * - the key is the identifier of the character
     * - the value is a valid character
     * 
     * @return  string[]
     */
    private function getValidDigitChars():array
    {
        return [
            'Latin: ASCII digits (first)' => "\u{0030}",
            'Latin: ASCII digits (arbitrary)' => "\u{0035}",
            'Latin: ASCII digits (last)' => "\u{0039}",
            'Arabic: Arabic-Indic digits (first)' => "\u{0660}",
            'Arabic: Arabic-Indic digits (arbitrary)' => "\u{0665}",
            'Arabic: Arabic-Indic digits (last)' => "\u{0669}",
            'Arabic: Eastern Arabic-Indic digits (first)' => "\u{06F0}",
            'Arabic: Eastern Arabic-Indic digits (arbitrary)' => "\u{06F5}",
            'Arabic: Eastern Arabic-Indic digits (last)' => "\u{06F9}",
            'Devanagari: Digits (first)' => "\u{0966}",
            'Devanagari: Digits (arbitrary)' => "\u{096B}",
            'Devanagari: Digits (last)' => "\u{096F}",
            'Bengali: Digits (first)' => "\u{09E6}",
            'Bengali: Digits (arbitrary)' => "\u{09EB}",
            'Bengali: Digits (last)' => "\u{09EF}",
            'Gurmukhi: Digits (first)' => "\u{0A66}",
            'Gurmukhi: Digits (arbitrary)' => "\u{0A6B}",
            'Gurmukhi: Digits (last)' => "\u{0A6F}",
            'Gujarati: Digits (first)' => "\u{0AE6}",
            'Gujarati: Digits (arbitrary)' => "\u{0AEB}",
            'Gujarati: Digits (last)' => "\u{0AEF}",
            'Oriya: Digits (first)' => "\u{0B66}",
            'Oriya: Digits (arbitrary)' => "\u{0B6B}",
            'Oriya: Digits (last)' => "\u{0B6F}",
            'Tamil: Digits (first)' => "\u{0BE7}",
            'Tamil: Digits (arbitrary)' => "\u{0BEC}",
            'Tamil: Digits (last)' => "\u{0BEF}",
            'Telugu: Digits (first)' => "\u{0C66}",
            'Telugu: Digits (arbitrary)' => "\u{0C6B}",
            'Telugu: Digits (last)' => "\u{0C6F}",
            'Kannada: Digits (first)' => "\u{0CE6}",
            'Kannada: Digits (arbitrary)' => "\u{0CEB}",
            'Kannada: Digits (last)' => "\u{0CEF}",
            'Malayalam: Digits (first)' => "\u{0D66}",
            'Malayalam: Digits (arbitrary)' => "\u{0D6B}",
            'Malayalam: Digits (last)' => "\u{0D6F}",
            'Thai: Digits (first)' => "\u{0E50}",
            'Thai: Digits (arbitrary)' => "\u{0E55}",
            'Thai: Digits (last)' => "\u{0E59}",
            'Lao: Digits (first)' => "\u{0ED0}",
            'Lao: Digits (arbitrary)' => "\u{0ED5}",
            'Lao: Digits (last)' => "\u{0ED9}",
            'Tibetan: Digits (first)' => "\u{0F20}",
            'Tibetan: Digits (arbitrary)' => "\u{0F25}",
            'Tibetan: Digits (last)' => "\u{0F29}",
        ];
    }
    
    /**
     * Returns a set of valid "CombiningChar" characters.
     * 
     * It returns an associative array where:
     * - the key is the identifier of the character
     * - the value is a valid character
     * 
     * @return  string[]
     */
    private function getValidCombiningChars():array
    {
        return [
            'Combining diacritical marks (first)' => "\u{0300}",
            'Combining diacritical marks (arbitrary)' => "\u{0320}",
            'Combining diacritical marks (last)' => "\u{0345}",
        ];
    }
    
    /**
     * Returns a set of valid "Extender" characters.
     * 
     * It returns an associative array where:
     * - the key is the identifier of the character
     * - the value is a valid character
     * 
     * @return  string[]
     */
    private function getValidExtenderChars():array
    {
        return [
            'Latin-1: Middle dot' => "\u{00B7}",
            'Spacing modifier letter: Triangular colon' => "\u{02D0}",
            'Spacing modifier letter: Half triangular colon' => "\u{02D1}",
            'Greek: Ano Teleia' => "\u{0387}",
            'Arabic: Tatweel' => "\u{0640}",
            'Thai: Maiyamok' => "\u{0E46}",
            'Lao: Ko La' => "\u{0EC6}",
            'CJK: Iteration mark' => "\u{3005}",
            'CJK: Vertical kana repeat (first)' => "\u{3031}",
            'CJK: Vertical kana repeat (last)' => "\u{3035}",
            'Hiragana: Hiragana iteration mark' => "\u{309D}",
            'Hiragana: Hiragana voiced iteration mark' => "\u{309E}",
            'Katakana: Katakana-hiragana prolonged sound mark' => "\u{30FC}",
            'Katakana: Katakana iteration mark' => "\u{30FD}",
            'Katakana: Katakana voiced iteration mark' => "\u{30FE}",
        ];
    }
}
