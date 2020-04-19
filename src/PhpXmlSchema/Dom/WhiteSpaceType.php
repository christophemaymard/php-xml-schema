<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the type for a white space.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class WhiteSpaceType
{
    /**
     * All occurrences of #x9, #xA and #xD are replaced with #x20.
     * 
     * Contiguous sequences of #x20s are collapsed to a single #x20.
     * 
     * Leading and trailing #x20s are removed.
     */
    private const COLLAPSE = 1;
    
    /**
     * No normalization is done.
     */
    private const PRESERVE = 2;
    
    /**
     * All occurrences of #x9, #xA and #xD are replaced with #x20.
     */
    private const REPLACE = 3;
    
    /**
     * The white space.
     * @var int
     */
    private $ws;
    
    /**
     * Creates a "collapse" white space.
     * 
     * @return  WhiteSpaceType  A new instance of WhiteSpaceType.
     */
    public static function createCollapse(): self
    {
        $type = new self();
        $type->ws = self::COLLAPSE;
        
        return $type;
    }
    
    /**
     * Creates a "preserve" white space.
     * 
     * @return  WhiteSpaceType  A new instance of WhiteSpaceType.
     */
    public static function createPreserve(): self
    {
        $type = new self();
        $type->ws = self::PRESERVE;
        
        return $type;
    }
    
    /**
     * Creates a "replace" white space.
     * 
     * @return  WhiteSpaceType  A new instance of WhiteSpaceType.
     */
    public static function createReplace(): self
    {
        $type = new self();
        $type->ws = self::REPLACE;
        
        return $type;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Indicates whether the white space is "collapse".
     * 
     * @return  bool    TRUE if the white space is "collapse", otherwise FALSE.
     */
    public function isCollapse(): bool
    {
        return $this->ws == self::COLLAPSE;
    }
    
    /**
     * Indicates whether the white space is "preserve".
     * 
     * @return  bool    TRUE if the white space is "preserve", otherwise FALSE.
     */
    public function isPreserve(): bool
    {
        return $this->ws == self::PRESERVE;
    }
    
    /**
     * Indicates whether the white space is "replace".
     * 
     * @return  bool    TRUE if the white space is "replace", otherwise FALSE.
     */
    public function isReplace(): bool
    {
        return $this->ws == self::REPLACE;
    }
}
