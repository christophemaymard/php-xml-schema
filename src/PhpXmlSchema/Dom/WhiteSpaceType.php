<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Exception\InvalidValueException;

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
    const COLLAPSE = 1;
    
    /**
     * No normalization is done.
     */
    const PRESERVE = 2;
    
    /**
     * All occurrences of #x9, #xA and #xD are replaced with #x20.
     */
    const REPLACE = 3;
    
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
    public static function createCollapse():self
    {
        return new self(self::COLLAPSE);
    }
    
    /**
     * Creates a "preserve" white space.
     * 
     * @return  WhiteSpaceType  A new instance of WhiteSpaceType.
     */
    public static function createPreserve():self
    {
        return new self(self::PRESERVE);
    }
    
    /**
     * Creates a "replace" white space.
     * 
     * @return  WhiteSpaceType  A new instance of WhiteSpaceType.
     */
    public static function createReplace():self
    {
        return new self(self::REPLACE);
    }
    
    /**
     * Constructor.
     * 
     * @param   int $ws The white space to set.
     */
    public function __construct(int $ws)
    {
        $this->setWhiteSpace($ws);
    }
    
    /**
     * Sets the white space.
     * 
     * @param   int $ws The white space to set.
     * 
     * @throws  InvalidValueException   When the white space is an invalid value.
     */
    private function setWhiteSpace(int $ws)
    {
        if ($ws != self::COLLAPSE && $ws != self::PRESERVE && $ws != self::REPLACE) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid white space.', $ws));
        }
        
        $this->ws = $ws;
    }
    
    /**
     * Indicates whether the white space is "collapse".
     * 
     * @return  bool    TRUE if the white space is "collapse", otherwise FALSE.
     */
    public function isCollapse():bool
    {
        return $this->ws == self::COLLAPSE;
    }
    
    /**
     * Indicates whether the white space is "preserve".
     * 
     * @return  bool    TRUE if the white space is "preserve", otherwise FALSE.
     */
    public function isPreserve():bool
    {
        return $this->ws == self::PRESERVE;
    }
    
    /**
     * Indicates whether the white space is "replace".
     * 
     * @return  bool    TRUE if the white space is "replace", otherwise FALSE.
     */
    public function isReplace():bool
    {
        return $this->ws == self::REPLACE;
    }
}
