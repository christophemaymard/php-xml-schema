<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Datatype;

/**
 * Represents the value space of the "QName" datatype.
 * 
 * It is a XML qualified name.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class QNameType
{
    /**
     * The local part of the qualified name.
     * @var NCNameType
     */
    private $localPart;
    
    /**
     * The namespace of the qualified name.
     * @var AnyUriType|NULL
     */
    private $namespace;
    
    /**
     * Constructor.
     * 
     * @param   NCNameType  $localPart  The local part of the qualified name.
     * @param   AnyUriType  $namespace  The namespace of the qualified name (optional)(default to NULL).
     */
    public function __construct(NCNameType $localPart, AnyUriType $namespace = NULL)
    {
        $this->localPart = $localPart;
        $this->namespace = $namespace;
    }
    
    /**
     * Returns the local part of the qualified name.
     * 
     * @return  NCNameType  The instance of the local part.
     */
    public function getLocalPart():NCNameType
    {
        return $this->localPart;
    }
    
    /**
     * Returns the namespace of the qualified name.
     * 
     * @return  AnyUriType|NULL The instance of the namespace, otherwise NULL.
     */
    public function getNamespace()
    {
        return $this->namespace;
    }
    
    /**
     * Indicates whether the qualified name has a namespace.
     * 
     * @return  bool    TRUE if the qualified name has a namespace, otherwise FALSE.
     */
    public function hasNamespace():bool
    {
        return $this->namespace !== NULL;
    }
}
