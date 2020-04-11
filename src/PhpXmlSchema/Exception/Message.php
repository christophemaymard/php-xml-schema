<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
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
    public static function unexpectedElement(string $name, string $ns, array $names): string
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
     * Formats a message when an attribute, from a namespace, is not supported.
     * 
     * @param   string  $name   The local name of the unsupported attribute.
     * @param   string  $ns     The namespace of the unsupported attribute.
     * @return  string
     */
    public static function unsupportedAttribute(string $name, string $ns): string
    {
        return \sprintf(
            'The "%s" attribute (from %s namespace) is not supported.',
            $name, 
            $ns == '' ? 'no' : $ns
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
    private static function formatCommaOrList(array $items): string
    {
        $last = '"'.\array_pop($items).'"';
        
        return (empty($items)) ? 
            $last : 
            '"'.implode('", "', $items).'" or '.$last;
    }
}
