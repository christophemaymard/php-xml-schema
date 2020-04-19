<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

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
    private const OPTIONAL = 1;
    
    /**
     * The use is prohibited.
     */
    private const PROHIBITED = 2;
    
    /**
     * The use is required.
     */
    private const REQUIRED = 3;
    
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
        $type = new self();
        $type->use = self::OPTIONAL;
        
        return $type;
    }
    
    /**
     * Creates a "prohibited" use.
     * 
     * @return  UseType A new instance of UseType.
     */
    public static function createProhibited(): self
    {
        $type = new self();
        $type->use = self::PROHIBITED;
        
        return $type;
    }
    
    /**
     * Creates a "required" use.
     * 
     * @return  UseType A new instance of UseType.
     */
    public static function createRequired(): self
    {
        $type = new self();
        $type->use = self::REQUIRED;
        
        return $type;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
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
