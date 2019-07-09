<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Datatype;

use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the "ID" datatype.
 * 
 * It is the ID attribute type; it matches the "NCName" production of 
 * "Namespaces in XML" defined as below:
 * 
 * NCName ::= (Letter | '_') (NCNameChar)*
 * 
 * It is partially implemented because the "BaseChar" and the "CombiningChar" 
 * character classes are partially implemented ({@see PhpXmlSchema\Datatype\XmlCharClass}).
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IDType
{
    /**
     * The ID.
     * @var string
     */
    private $id;
    
    /**
     * Constructor.
     * 
     * @param   string  $id The ID to set.
     */
    public function __construct(string $id)
    {
        $this->setId($id);
    }
    
    /**
     * Sets the value.
     * 
     * @param   string  $id The ID to set.
     * 
     * @throws  InvalidValueException   When the ID is invalid.
     */
    private function setId(string $id)
    {
        if (!\preg_match('`^'.NCNameType::PATTERN.'$`u', $id)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid ID.', $id));
        }
        
        $this->id = $id;
    }
    
    /**
     * Returns the ID.
     * 
     * @return  string
     */
    public function getId():string
    {
        return $this->id;
    }
}
