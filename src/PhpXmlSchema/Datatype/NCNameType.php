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
 * Represents the "NCName" datatype.
 * 
 * It is a XML "non-colonized" name; it matches the "NCName" production of 
 * "Namespaces in XML" defined as below:
 * 
 * NCName ::= (Letter | '_') (NCNameChar)*
 * 
 * It is partially implemented because the "BaseChar" and the "CombiningChar" 
 * character classes are partially implemented ({@see PhpXmlSchema\Datatype\XmlCharClass}).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NCNameType
{
    /**
     * The "NCName" pattern (it must be used with the u modifier).
     */
    const PATTERN = '[_'.XmlCharClass::LETTER.']['.XmlCharClass::NCNAMECHAR.']*';
    
    /**
     * The Non-Colonized name.
     * @var string
     */
    private $ncName;
    
    /**
     * Constructor.
     * 
     * @param   string  $ncName The Non-Colonized name to set.
     */
    public function __construct(string $ncName)
    {
        $this->setNCName($ncName);
    }
    
    /**
     * Sets the value.
     * 
     * @param   string  $ncName The Non-Colonized name to set.
     * 
     * @throws  InvalidValueException   When the Non-Colonized name is invalid.
     */
    private function setNCName(string $ncName)
    {
        if (!\preg_match('`^'.self::PATTERN.'$`u', $ncName)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid NCName.', $ncName));
        }
        
        $this->ncName = $ncName;
    }
    
    /**
     * Returns the Non-Colonized name.
     * 
     * @return  string
     */
    public function getNCName():string
    {
        return $this->ncName;
    }
}
