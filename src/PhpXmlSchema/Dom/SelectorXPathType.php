<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\NCNameType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the type for a XPath expression in a "selector" element.
 * 
 * Selector ::= Path ( '|' Path )*
 * 
 * Path ::= ('.//')? Step ( '/' Step )*
 * 
 * Step ::= '.' | NameTest
 * 
 * NameTest ::= ('child::')? (QName | '*' | NCName ':' '*')
 * 
 * @todo    XML whitespace may be added within patterns before or after any token in "selector" XPath.
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SelectorXPathType
{
    /**
     * The "Path" pattern (it must be used with the u modifier).
     * 
     * Path ::= ('.//')? Step ( '/' Step )*
     */
    const PATH = '((\\.//)?'.self::STEP.'(/'.self::STEP.')*)';
    
    /**
     * The "Step" pattern (it must be used with the u modifier).
     * 
     * Step ::= '.' | NameTest
     */
    const STEP = '((\\.)|'.self::NAMETEST.')';
    
    /**
     * The "NameTest" pattern (it must be used with the u modifier).
     * 
     * NameTest ::= ('child::')? (QName | '*' | NCName ':' '*')
     */
    const NAMETEST = '((child::)?'.'(('.self::QNAME.')|(('.NCNameType::PATTERN.':)?\\*)))';
    
    /**
     * The "QName" pattern (it must be used with the u modifier).
     */
    const QNAME = NCNameType::PATTERN.':'.NCNameType::PATTERN;
    
    /**
     * The XPath expression for a "selector" element.
     * @var string
     */
    private $xpath;
    
    /**
     * Constructor.
     * 
     * @param   string  $xpath  The XPath expression, for a "selector" element, to set.
     */
    public function __construct(string $xpath)
    {
        $this->setXPath($xpath);
    }
    
    /**
     * Sets the XPath expression for a "selector" element.
     * 
     * @param   string  $xpath  The XPath expression to set.
     * 
     * @throws  InvalidValueException   When the XPath expression is invalid for a "selector" element.
     */
    private function setXPath(string $xpath)
    {
        if (!\preg_match('`^'.self::PATH.'(\\|'.self::PATH.')*$`u', $xpath)) {
            throw new InvalidValueException(sprintf('"%s" is an invalid XPath expression for a "selector" element.', $xpath));
        }
        
        $this->xpath = $xpath;
    }
    
    /**
     * Returns the XPath expression.
     * 
     * @return  string
     */
    public function getXPath():string
    {
        return $this->xpath;
    }
}
