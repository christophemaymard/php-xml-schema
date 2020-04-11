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
    public const LAX = 1;
    
    /**
     * XML processor does not attempt to validate any elements from the 
     * specified namespaces.
     */
    public const SKIP = 2;
    
    /**
     * XML processor must obtain the schema associated with the required 
     * namespaces and validate the elements.
     */
    public const STRICT = 3;
    
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
        return new self(self::LAX);
    }
    
    /**
     * Creates a "skip" mode of content processing.
     * 
     * @return  ProcessingModeType  A new instance of ProcessingModeType.
     */
    public static function createSkip(): self
    {
        return new self(self::SKIP);
    }
    
    /**
     * Creates a "strict" mode of content processing.
     * 
     * @return  ProcessingModeType  A new instance of ProcessingModeType.
     */
    public static function createStrict(): self
    {
        return new self(self::STRICT);
    }
    
    /**
     * Constructor.
     * 
     * @param   int $mode   The mode of the content processing to set.
     */
    public function __construct(int $mode)
    {
        $this->setMode($mode);
    }
    
    /**
     * Sets the mode of the content processing.
     * 
     * @param   int $mode   The mode of the content processing to set.
     * 
     * @throws  InvalidValueException   When the mode of the content processing is an invalid value.
     */
    private function setMode(int $mode): void
    {
        if ($mode != self::LAX && $mode != self::SKIP && $mode != self::STRICT) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid mode of content processing.', $mode));
        }
        
        $this->mode = $mode;
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
