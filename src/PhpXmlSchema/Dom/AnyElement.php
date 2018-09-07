<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\NonNegativeIntegerType;

/**
 * Represents the XML schema "any" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - minOccurs = nonNegativeInteger
 * - processContents = (lax | skip | strict)
 * 
 * Content (version 1.0):
 * (annotation?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnyElement extends AbstractAnnotatedElement implements ParticleElementInterface
{
    /**
     * The value of the "minOccurs" attribute.
     * @var NonNegativeIntegerType|NULL
     */
    private $minOccursAttr;
    
    /**
     * The value of the "processContents" attribute.
     * @var ProcessingModeType|NULL
     */
    private $processContentsAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getMinOccurs()
    {
        return $this->minOccursAttr;
    }
    
    /**
     * {@inheritDoc}
     */
    public function setMinOccurs(NonNegativeIntegerType $value)
    {
        $this->minOccursAttr = $value;
    }
    
    /**
     * {@inheritDoc}
     */
    public function hasMinOccurs():bool
    {
        return $this->minOccursAttr !== NULL;
    }
    
    /**
     * Returns the value of the "processContents" attribute.
     * 
     * @return  ProcessingModeType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getProcessContents()
    {
        return $this->processContentsAttr;
    }
    
    /**
     * Sets the value of the "processContents" attribute.
     * 
     * @param   ProcessingModeType  $value  The value to set.
     */
    public function setProcessContents(ProcessingModeType $value)
    {
        $this->processContentsAttr = $value;
    }
    
    /**
     * Indicates whether the "processContents" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasProcessContents():bool
    {
        return $this->processContentsAttr !== NULL;
    }
}
