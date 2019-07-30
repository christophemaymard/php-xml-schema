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
            $last = '"'.\array_pop($names).'"';
            $expectedElements = (empty($names)) ? $last :
                '"'.implode('", "', $names).'" or '.$last;
        }
        
        return \sprintf(
            'The "%s" element (from %s namespace) is unexpected, expected: %s.',
            $name,
            $ns == '' ? 'no' : $ns,
            $expectedElements
        );
    }
}
