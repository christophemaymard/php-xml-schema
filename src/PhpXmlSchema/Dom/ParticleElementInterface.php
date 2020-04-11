<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\NonNegativeIntegerType;

/**
 * Interface for a XML schema element that contributes to the definition of 
 * content models.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
interface ParticleElementInterface extends AnnotatedElementInterface
{
    /**
     * Returns the value of the "maxOccurs" attribute.
     * 
     * @return  NonNegativeIntegerLimitType|NULL    The value of the attribute if it has been set, otherwise NULL.
     */
    public function getMaxOccurs(): ?NonNegativeIntegerLimitType;
    
    /**
     * Sets the value of the "maxOccurs" attribute.
     * 
     * @param   NonNegativeIntegerLimitType $value  The value to set.
     */
    public function setMaxOccurs(NonNegativeIntegerLimitType $value): void;
    
    /**
     * Indicates whether the "maxOccurs" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasMaxOccurs(): bool;
    
    /**
     * Returns the value of the "minOccurs" attribute.
     * 
     * @return  NonNegativeIntegerType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getMinOccurs(): ?NonNegativeIntegerType;
    
    /**
     * Sets the value of the "minOccurs" attribute.
     * 
     * @param   NonNegativeIntegerType  $value  The value to set.
     */
    public function setMinOccurs(NonNegativeIntegerType $value): void;
    
    /**
     * Indicates whether the "minOccurs" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasMinOccurs(): bool;
}
