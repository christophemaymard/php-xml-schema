<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the base class for a facet element that holds the "fixed" 
 * attribute.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractFixedFacetElement extends AbstractAnnotatedElement implements FacetElementInterface
{
    /**
     * The value of the "fixed" attribute.
     * @var bool|NULL
     */
    private $fixedAttr;
    
    /**
     * Returns the value of the "fixed" attribute.
     * 
     * @return  bool|NULL   The value of the attribute if it has been set, otherwise NULL.
     */
    public function getFixed()
    {
        return $this->fixedAttr;
    }
    
    /**
     * Sets the value of the "fixed" attribute.
     * 
     * @param   bool    $value  The value to set.
     */
    public function setFixed(bool $value)
    {
        $this->fixedAttr = $value;
    }
    
    /**
     * Indicates whether the "fixed" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasFixed():bool
    {
        return $this->fixedAttr !== NULL;
    }
}
