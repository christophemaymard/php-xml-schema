<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema;

/**
 * Represents all the values related to XML namespaces.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class XmlNamespace
{
    /**
     * The prefix of the XML 1.0 namespace.
     */
    const XML_1_0_PREFIX = 'xml';
    
    /**
     * The XML 1.0 namespace.
     */
    const XML_1_0 = 'http://www.w3.org/XML/1998/namespace';
    
    /**
     * The prefix of the XML NS 1.0 namespace.
     */
    const XMLNS_1_0_PREFIX = 'xmlns';
    
    /**
     * The XML NS 1.0 namespace.
     */
    const XMLNS_1_0 = 'http://www.w3.org/2000/xmlns/';
    
    /**
     * The XML Schema 1.0 namespace.
     */
    const XML_SCHEMA_1_0 = 'http://www.w3.org/2001/XMLSchema';
}
