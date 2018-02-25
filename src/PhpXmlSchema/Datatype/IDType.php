<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Datatype;

/**
 * Represents the "ID" datatype.
 * 
 * It is a XML "non-colonized" name; it matches the "NCName" production of 
 * "Namespaces in XML" defined as below:
 * 
 * NCName ::= (Letter | '_') (NCNameChar)*
 * 
 * The "BaseChar" and the "CombiningChar" character classes are partially 
 * implemented.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IDType extends AbstractNCNameType
{
}
