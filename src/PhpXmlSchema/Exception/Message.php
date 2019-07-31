<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Exception;

/**
 * Represents a class that formats messages related to exceptions.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class Message
{
    /**
     * Formats a message when an element, from a namespace, is unexpected and 
     * list the expected element names.
     * 
     * @param   string      $name   The local name of the unexpected element.
     * @param   string      $ns     The namespace of the unexpected element.
     * @param   string[]    $names  The local names of the expected elements.
     * @return  string
     */
    public static function unexpectedElement(string $name, string $ns, array $names):string
    {
        if (empty($names)) {
            $expectedElements = 'none';
        } else {
            $expectedElements = self::formatCommaOrList($names);
        }
        
        return \sprintf(
            'The "%s" element (from %s namespace) is unexpected, expected: %s.',
            $name,
            $ns == '' ? 'no' : $ns,
            $expectedElements
        );
    }
    
    /**
     * Formats a message when a value of an attribute, from a namespace, is 
     * invalid and list the expected values.
     * 
     * @param   string      $invalidValue   The invalid value.
     * @param   string      $name           The local name of the attribute.
     * @param   string      $ns             The namespace of the attribute.
     * @param   string[]    $values         The expected values.
     * @return  string
     */
    public static function invalidAttributeValue(
        string $invalidValue, 
        string $name, 
        string $ns, 
        array $values
    ):string {
        if (empty($values)) {
            $expected = '';
        } else {
            $expected = ', expected: '.self::formatCommaOrList($values);
        }
        
        return \sprintf(
            '"%s" is an invalid value for the "%s" attribute (from %s '.
            'namespace)%s.', 
            $invalidValue, 
            $name, 
            $ns == '' ? 'no' : $ns, 
            $expected
        );
    }
    
    /**
     * Formats a list with specified items.
     * 
     * Items are surrounded with double quote and separated by comma or "or".
     * 
     * @param   string[]    $items  The items used to format a list.
     * @return  string
     */
    private static function formatCommaOrList(array $items)
    {
        $last = '"'.\array_pop($items).'"';
        
        return (empty($items)) ? 
            $last : 
            '"'.implode('", "', $items).'" or '.$last;
    }
}
