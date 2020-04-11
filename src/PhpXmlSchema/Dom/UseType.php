<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the type for an use.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UseType
{
    /**
     * The use is optional.
     */
    public const OPTIONAL = 1;
    
    /**
     * The use is prohibited.
     */
    public const PROHIBITED = 2;
    
    /**
     * The use is required.
     */
    public const REQUIRED = 3;
    
    /**
     * The use.
     * @var int
     */
    private $use;
    
    /**
     * Creates an "optional" use.
     * 
     * @return  UseType A new instance of UseType.
     */
    public static function createOptional(): self
    {
        return new self(self::OPTIONAL);
    }
    
    /**
     * Creates a "prohibited" use.
     * 
     * @return  UseType A new instance of UseType.
     */
    public static function createProhibited(): self
    {
        return new self(self::PROHIBITED);
    }
    
    /**
     * Creates a "required" use.
     * 
     * @return  UseType A new instance of UseType.
     */
    public static function createRequired(): self
    {
        return new self(self::REQUIRED);
    }
    
    /**
     * Constructor.
     * 
     * @param   int $use    The use to set.
     */
    public function __construct(int $use)
    {
        $this->setUse($use);
    }
    
    /**
     * Sets the use.
     * 
     * @param   int $use    The use to set.
     * 
     * @throws  InvalidValueException   When the use is an invalid value.
     */
    private function setUse(int $use): void
    {
        if ($use != self::OPTIONAL && $use != self::PROHIBITED && $use != self::REQUIRED) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid use.', $use));
        }
        
        $this->use = $use;
    }
    
    /**
     * Indicates whether the use is "optional".
     * 
     * @return  bool    TRUE if the use is "optional", otherwise FALSE.
     */
    public function isOptional(): bool
    {
        return $this->use == self::OPTIONAL;
    }
    
    /**
     * Indicates whether the use is "prohibited".
     * 
     * @return  bool    TRUE if the use is "prohibited", otherwise FALSE.
     */
    public function isProhibited(): bool
    {
        return $this->use == self::PROHIBITED;
    }
    
    /**
     * Indicates whether the use is "required".
     * 
     * @return  bool    TRUE if the use is "required", otherwise FALSE.
     */
    public function isRequired(): bool
    {
        return $this->use == self::REQUIRED;
    }
}
