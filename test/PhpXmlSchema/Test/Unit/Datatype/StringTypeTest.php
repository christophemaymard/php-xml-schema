<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\StringType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Datatype\StringType} 
 * class.
 * 
 * @group   type
 * @group   datatype
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class StringTypeTest extends TestCase
{
    /**
     * Tests that __construct() stores the value when it is valid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @dataProvider    getValidValues
     */
    public function test__constructStoresValueWhenItIsValid(string $value)
    {
        $sut = new StringType($value);
        self::assertSame($value, $sut->getString());
    }
    
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
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid string datatype.', $value));
        
        $sut = new StringType($value);
    }
    
    /**
     * Returns a set of valid values.
     * 
     * @return  array[]
     */
    public function getValidValues():array
    {
        $datasets = [];
        
        $datasets['Empty string.'] = [ '', ];
        $datasets['Contain U+0009 character.'] = [ "\u{0009}", ];
        $datasets['Contain U+000A character.'] = [ "\u{000A}", ];
        $datasets['Contain U+000D character.'] = [ "\u{000D}", ];
        $datasets['Contain U+0020 character.'] = [ "\u{0020}", ];
        $datasets['Contain U+6C10 character.'] = [ "\u{6C10}", ];
        $datasets['Contain U+D7FF character.'] = [ "\u{D7FF}", ];
        $datasets['Contain U+E000 character.'] = [ "\u{E000}", ];
        $datasets['Contain U+EFFF character.'] = [ "\u{EFFF}", ];
        $datasets['Contain U+FFFD character.'] = [ "\u{FFFD}", ];
        $datasets['Contain U+10000 character.'] = [ "\u{10000}", ];
        $datasets['Contain U+90000 character.'] = [ "\u{90000}", ];
        $datasets['Contain U+10FFFF character.'] = [ "\u{10FFFF}", ];
        
        return $datasets;
    }
    
    /**
     * Returns a set of invalid values.
     * 
     * @return  array[]
     */
    public function getInvalidValues():array
    {
        $datasets = [];
        
        $datasets['Contain invalid character (U+0000).'] = [ "\u{0000}", ];
        $datasets['Contain invalid character (U+0008).'] = [ "\u{0008}", ];
        $datasets['Contain invalid character (U+000E).'] = [ "\u{000E}", ];
        $datasets['Contain invalid character (U+001F).'] = [ "\u{001F}", ];
        $datasets['Contain invalid character (U+D800).'] = [ "\u{D800}", ];
        $datasets['Contain invalid character (U+DC00).'] = [ "\u{DC00}", ];
        $datasets['Contain invalid character (U+DFFF).'] = [ "\u{DFFF}", ];
        $datasets['Contain invalid character (U+FFFE).'] = [ "\u{FFFE}", ];
        $datasets['Contain invalid character (U+FFFF).'] = [ "\u{FFFF}", ];
        
        return $datasets;
    }
}