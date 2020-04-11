<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the type for a derivation set.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DerivationType
{
    /**
     * @var bool
     */
    private $restriction;
    
    /**
     * @var bool
     */
    private $extension;
    
    /**
     * @var bool
     */
    private $substitution;
    
    /**
     * @var bool
     */
    private $list;
    
    /**
     * @var bool
     */
    private $union;
    
    /**
     * Constructor.
     * 
     * @param   bool    $restriction    The flag for the "restriction" derivation to set.
     * @param   bool    $extension      The flag for the "extension" derivation to set.
     * @param   bool    $substitution   The flag for the "substitution" derivation to set.
     * @param   bool    $list           The flag for the "list" derivation to set.
     * @param   bool    $union          The flag for the "union" derivation to set.
     */
    public function __construct(
        bool $restriction, 
        bool $extension, 
        bool $substitution,
        bool $list,
        bool $union
    ) {
        $this->restriction = $restriction;
        $this->extension = $extension;
        $this->substitution = $substitution;
        $this->list = $list;
        $this->union = $union;
    }
    
    /**
     * Indicates whether one of the derivations is "restriction".
     * 
     * @return  bool    TRUE if one of the derivations is "restriction", otherwise FALSE.
     */
    public function byRestriction(): bool
    {
        return $this->restriction;
    }
    
    /**
     * Indicates whether one of the derivations is "extension".
     * 
     * @return  bool    TRUE if one of the derivations is "extension", otherwise FALSE.
     */
    public function byExtension(): bool
    {
        return $this->extension;
    }
    
    /**
     * Indicates whether one of the derivations is "substitution".
     * 
     * @return  bool    TRUE if one of the derivations is "substitution", otherwise FALSE.
     */
    public function bySubstitution(): bool
    {
        return $this->substitution;
    }
    
    /**
     * Indicates whether one of the derivations is "list".
     * 
     * @return  bool    TRUE if one of the derivations is "list", otherwise FALSE.
     */
    public function byList(): bool
    {
        return $this->list;
    }
    
    /**
     * Indicates whether one of the derivations is "union".
     * 
     * @return  bool    TRUE if one of the derivations is "union", otherwise FALSE.
     */
    public function byUnion(): bool
    {
        return $this->union;
    }
}
