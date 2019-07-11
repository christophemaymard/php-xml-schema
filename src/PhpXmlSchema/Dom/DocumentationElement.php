<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\AnyUriType;
use PhpXmlSchema\Datatype\LanguageType;

/**
 * Represents the XML schema "documentation" element.
 * 
 * Attributes (version 1.0):
 * - source = anyURI
 * - xml:lang = language
 * 
 * Content (version 1.0):
 * ({any}*)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DocumentationElement extends AbstractLeafElement
{
    /**
     * The value of the "xml:lang" attribute.
     * @var LanguageType|NULL
     */
    private $langAttr;
    
    /**
     * The value of the "source" attribute.
     * @var AnyUriType|NULL
     */
    private $sourceAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName():string
    {
        return 'documentation';
    }
    
    /**
     * Returns the value of the "xml:lang" attribute.
     * 
     * @return  LanguageType|NULL   The value of the attribute if it has been set, otherwise NULL.
     */
    public function getLang()
    {
        return $this->langAttr;
    }
    
    /**
     * Sets the value of the "xml:lang" attribute.
     * 
     * @param   LanguageType    $value  The value to set.
     */
    public function setLang(LanguageType $value)
    {
        $this->langAttr = $value;
    }
    
    /**
     * Indicates whether the "xml:lang" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasLang():bool
    {
        return $this->langAttr !== NULL;
    }
    
    /**
     * Returns the value of the "source" attribute.
     * 
     * @return  AnyUriType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getSource()
    {
        return $this->sourceAttr;
    }
    
    /**
     * Sets the value of the "source" attribute.
     * 
     * @param   AnyUriType  $value  The value to set.
     */
    public function setSource(AnyUriType $value)
    {
        $this->sourceAttr = $value;
    }
    
    /**
     * Indicates whether the "source" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasSource():bool
    {
        return $this->sourceAttr !== NULL;
    }
}
