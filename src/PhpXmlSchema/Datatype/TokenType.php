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
 * Represents the "token" datatype.
 * 
 * It represents tokenized strings.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TokenType
{
    /**
     * The "Char" character class.
     * 
     * Char ::= [#x21-#xD7FF] | [#xE000-#xFFFD] | [#x10000-#x10FFFF]
     */
    const CHAR = "\u{0021}-\u{D7FF}\u{E000}-\u{FFFD}\u{10000}-\u{10FFFF}";
    
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
     * @throws  InvalidValueException   When the value is an invalid value.
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
     * @throws  InvalidValueException   When the value is invalid.
     */
    private function setValue(string $value)
    {
        if ($value != '' && !\preg_match('`^(['.self::CHAR.']+( ['.self::CHAR.']+)*)$`u', $value)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid token.', $value));
        }
        
        $this->value = $value;
    }
    
    /**
     * Returns the string representation of the value.
     * 
     * @return  string
     */
    public function getString():string
    {
        return $this->value;
    }
}
