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
 * Represents the "language" datatype.
 * 
 * It represents natural language identifiers as defined by RFC 3066.
 * 
 * Language-Tag ::= Primary-subtag ( '-' Subtag )*
 * 
 * Primary-subtag ::= [a-zA-Z]{1,8}
 * 
 * Subtag ::= [a-zA-Z0-9]{1,8}
 * 
 * @link    https://www.ietf.org/rfc/rfc3066.txt    Tags for the Identification of Languages (2001)
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class LanguageType
{
    /**
     * The primary subtag.
     * @var string
     */
    private $primarySubtag;
    
    /**
     * The subtags.
     * @var string[]
     */
    private $subtags = [];
    
    /**
     * Constructor.
     * 
     * @param   string      $primary    The primary subtag to set.
     * @param   string[]    $subtags    the subtags to set (optional)(default to an empty array).
     */
    public function __construct(string $primary, array $subtags = [])
    {
        $this->setPrimarySubtag($primary);
        $this->setSubtags($subtags);
    }
    
    /**
     * Sets the primary subtag.
     * 
     * @param   string  $primary    The primary subtag to set.
     * 
     * @throws  InvalidValueException   When the primary subtag is invalid.
     */
    private function setPrimarySubtag(string $primary)
    {
        if (!\preg_match('`^[a-zA-Z]{1,8}$`', $primary)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid primary subtag.', $primary));
        }
        
        $this->primarySubtag = $primary;
    }
    
    /**
     * Returns the primary subtag.
     * 
     * @return  string
     */
    public function getPrimarySubtag():string
    {
        return $this->primarySubtag;
    }
    
    /**
     * Sets the subtags.
     * 
     * @param   string[]    $subtags    The subtags to set.
     */
    private function setSubtags(array $subtags)
    {
        $this->subtags = [];
        
        foreach ($subtags as $subtag) {
            $this->addSubtag($subtag);
        }
    }
    
    /**
     * Adds the specified subtag.
     * 
     * @param   string  $subtag The subtag to add.
     * 
     * @throws  InvalidValueException   When the subtag is invalid.
     */
    private function addSubtag(string $subtag)
    {
        if (!\preg_match('`^[a-zA-Z0-9]{1,8}$`', $subtag)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid subtag.', $subtag));
        }
        
        $this->subtags[] = $subtag;
    }
    
    /**
     * Returns all the subtags.
     * 
     * @return  string[]    An indexed array of subtags.
     */
    public function getSubtags():array
    {
        return $this->subtags;
    }
}