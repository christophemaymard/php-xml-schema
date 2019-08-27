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
    const ELT_TOP_ATTRIBUTE = 8;
    const ELT_LOCAL_SIMPLETYPE = 9;
    const ELT_SIMPLETYPE_RESTRICTION = 10;
    const ELT_MINEXCLUSIVE = 11;
    const ELT_MININCLUSIVE = 12;
    const ELT_MAXEXCLUSIVE = 13;
    const ELT_MAXINCLUSIVE = 14;
    const ELT_TOTALDIGITS = 15;
    const ELT_FRACTIONDIGITS = 16;
    const ELT_LENGTH = 17;
    const ELT_MINLENGTH = 18;
    const ELT_MAXLENGTH = 19;
    const ELT_ENUMERATION = 20;
}
