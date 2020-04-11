<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
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
    public const ELT_ROOT = 0;
    public const ELT_SCHEMA = 1;
    public const ELT_ANNOTATION = 2;
    public const ELT_APPINFO = 3;
    public const ELT_DOCUMENTATION = 4;
    public const ELT_IMPORT = 5;
    public const ELT_INCLUDE = 6;
    public const ELT_NOTATION = 7;
    public const ELT_TOP_ATTRIBUTE = 8;
    public const ELT_LOCAL_SIMPLETYPE = 9;
    public const ELT_SIMPLETYPE_RESTRICTION = 10;
    public const ELT_MINEXCLUSIVE = 11;
    public const ELT_MININCLUSIVE = 12;
    public const ELT_MAXEXCLUSIVE = 13;
    public const ELT_MAXINCLUSIVE = 14;
    public const ELT_TOTALDIGITS = 15;
    public const ELT_FRACTIONDIGITS = 16;
    public const ELT_LENGTH = 17;
    public const ELT_MINLENGTH = 18;
    public const ELT_MAXLENGTH = 19;
    public const ELT_ENUMERATION = 20;
    public const ELT_WHITESPACE = 21;
    public const ELT_PATTERN = 22;
    public const ELT_LIST = 23;
    public const ELT_UNION = 24;
    public const ELT_TOP_SIMPLETYPE = 25;
    public const ELT_NAMED_ATTRIBUTEGROUP = 26;
    public const ELT_ATTRIBUTE = 27;
    public const ELT_ATTRIBUTEGROUP_REF = 28;
    public const ELT_ANYATTRIBUTE = 29;
    public const ELT_TOP_COMPLEXTYPE = 30;
    public const ELT_SIMPLECONTENT = 31;
    public const ELT_SIMPLECONTENT_RESTRICTION = 32;
    public const ELT_SIMPLECONTENT_EXTENSION = 33;
    public const ELT_COMPLEXCONTENT = 34;
    public const ELT_COMPLEXCONTENT_RESTRICTION = 35;
    public const ELT_GROUP_REF = 36;
    public const ELT_ALL = 37;
    public const ELT_NARROW_ELEMENT = 38;
    public const ELT_LOCAL_COMPLEXTYPE = 39;
    public const ELT_EXPLICIT_CHOICE = 40;
    public const ELT_LOCAL_ELEMENT = 41;
    public const ELT_UNIQUE = 42;
    public const ELT_SELECTOR = 43;
    public const ELT_FIELD = 44;
    public const ELT_KEY = 45;
    public const ELT_KEYREF = 46;
    public const ELT_EXPLICIT_SEQUENCE = 47;
    public const ELT_ANY = 48;
    public const ELT_COMPLEXCONTENT_EXTENSION = 49;
    public const ELT_NAMED_GROUP = 50;
    public const ELT_ANONYMOUS_ALL = 51;
    public const ELT_SIMPLE_CHOICE = 52;
    public const ELT_SIMPLE_SEQUENCE = 53;
    public const ELT_TOP_ELEMENT = 54;
}
