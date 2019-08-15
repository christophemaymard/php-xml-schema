<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents all the elements in a specific context.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ContextId
{
    const ELT_ROOT = 0;
    const ELT_SCHEMA = 1;
    const ELT_ANNOTATION = 2;
    const ELT_APPINFO = 3;
    const ELT_DOCUMENTATION = 4;
    const ELT_IMPORT = 5;
    const ELT_INCLUDE = 6;
    const ELT_NOTATION = 7;
}
