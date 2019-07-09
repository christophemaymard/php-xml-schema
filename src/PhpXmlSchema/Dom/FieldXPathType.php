<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\NCNameType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the type for a XPath expression in a "field" element.
 * 
 * Selector ::= Path ( '|' Path )*
 * 
 * Path ::= ('.//')? ( Step '/' )* ( Step | ( ( '@' | 'attribute::' ) NameTest ) )
 * 
 * Step ::= '.' | ( ('child::')? NameTest )
 * 
 * NameTest ::= QName | '*' | NCName ':' '*'
 * 
 * @todo    XML whitespace may be added within patterns before or after any token in "field" XPath.
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FieldXPathType
{
    /**
     * The "Path" pattern (it must be used with the u modifier).
     * 
     * Path ::= ('.//')? ( Step '/' )* ( Step | ( ( '@' | 'attribute::' ) NameTest ) )
     */
    const PATH = '('.
        '(\\.//)?'.
        '('.self::STEP.'/)*'.
        '(('.self::STEP.')|((@|attribute::)'.self::NAMETEST.'))'.
        ')';
    
    /**
     * The "Step" pattern (it must be used with the u modifier).
     * 
     * Step ::= '.' | ( ('child::')? NameTest )
     */
    const STEP = '((\\.)|((child::)?'.self::NAMETEST.'))';
    
    
    /**
     * The "NameTest" pattern (it must be used with the u modifier).
     * 
     * NameTest ::= QName | '*' | NCName ':' '*'
     */
    const NAMETEST = '('.'(('.self::QNAME.')|(('.NCNameType::PATTERN.':)?\\*)))';
    
    /**
     * The "QName" pattern (it must be used with the u modifier).
     */
    const QNAME = NCNameType::PATTERN.':'.NCNameType::PATTERN;
    
    /**
     * The XPath expression for a "field" element.
     * @var string
     */
    private $xpath;
    
    /**
     * Constructor.
     * 
     * @param   string  $xpath  The XPath expression, for a "field" element, to set.
     */
    public function __construct(string $xpath)
    {
        $this->setXPath($xpath);
    }
    
    /**
     * Sets the XPath expression for a "field" element.
     * 
     * @param   string  $xpath  The XPath expression to set.
     * 
     * @throws  InvalidValueException   When the XPath expression is invalid for a "field" element.
     */
    private function setXPath(string $xpath)
    {
        if (!\preg_match('`^'.self::PATH.'(\\|'.self::PATH.')*$`u', $xpath)) {
            throw new InvalidValueException(sprintf('"%s" is an invalid XPath expression for a "field" element.', $xpath));
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
