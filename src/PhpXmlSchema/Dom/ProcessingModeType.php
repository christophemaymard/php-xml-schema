<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the type for the mode of content processing.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ProcessingModeType
{
    /**
     * XML processor validates elements and attributes for which it can 
     * obtain schema information, but it will not signal errors for those it 
     * cannot obtain any schema information.
     */
    private const LAX = 1;
    
    /**
     * XML processor does not attempt to validate any elements from the 
     * specified namespaces.
     */
    private const SKIP = 2;
    
    /**
     * XML processor must obtain the schema associated with the required 
     * namespaces and validate the elements.
     */
    private const STRICT = 3;
    
    /**
     * The mode of the content processing.
     * @var int
     */
    private $mode;
    
    /**
     * Creates a "lax" mode of content processing.
     * 
     * @return  ProcessingModeType  A new instance of ProcessingModeType.
     */
    public static function createLax(): self
    {
        $type = new self();
        $type->mode = self::LAX;
        
        return $type;
    }
    
    /**
     * Creates a "skip" mode of content processing.
     * 
     * @return  ProcessingModeType  A new instance of ProcessingModeType.
     */
    public static function createSkip(): self
    {
        $type = new self();
        $type->mode = self::SKIP;
        
        return $type;
    }
    
    /**
     * Creates a "strict" mode of content processing.
     * 
     * @return  ProcessingModeType  A new instance of ProcessingModeType.
     */
    public static function createStrict(): self
    {
        $type = new self();
        $type->mode = self::STRICT;
        
        return $type;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Indicates whether the mode of the content processing is "lax".
     * 
     * @return  bool    TRUE if the mode is "lax", otherwise FALSE.
     */
    public function isLax(): bool
    {
        return $this->mode == self::LAX;
    }
    
    /**
     * Indicates whether the mode of the content processing is "skip".
     * 
     * @return  bool    TRUE if the mode is "skip", otherwise FALSE.
     */
    public function isSkip(): bool
    {
        return $this->mode == self::SKIP;
    }
    
    /**
     * Indicates whether the mode of the content processing is "strict".
     * 
     * @return  bool    TRUE if the mode is "strict", otherwise FALSE.
     */
    public function isStrict(): bool
    {
        return $this->mode == self::STRICT;
    }
}
