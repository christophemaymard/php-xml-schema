<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\XmlNamespace;
use PhpXmlSchema\Exception\InvalidOperationException;

/**
 * Represents a factory of specifications.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SpecificationFactory
{
    /**
     * The map that associates a context ID with an initial state.
     * An associative where:
     * - the key is the context ID, and
     * - the value is the initial state.
     * @var int[]
     */
    private $initialStates = [
        ContextId::ELT_ROOT => 0, 
        ContextId::ELT_SCHEMA => 0, 
        ContextId::ELT_ANNOTATION => 0, 
        ContextId::ELT_IMPORT => 0, 
        ContextId::ELT_INCLUDE => 0, 
        ContextId::ELT_NOTATION => 0, 
        ContextId::ELT_TOP_ATTRIBUTE => 0, 
        ContextId::ELT_LOCAL_SIMPLETYPE => 0, 
        ContextId::ELT_SIMPLETYPE_RESTRICTION => 0, 
        ContextId::ELT_MINEXCLUSIVE => 0, 
        ContextId::ELT_MININCLUSIVE => 0, 
        ContextId::ELT_MAXEXCLUSIVE => 0, 
        ContextId::ELT_MAXINCLUSIVE => 0, 
        ContextId::ELT_TOTALDIGITS => 0, 
        ContextId::ELT_FRACTIONDIGITS => 0, 
        ContextId::ELT_LENGTH => 0, 
        ContextId::ELT_MINLENGTH => 0, 
        ContextId::ELT_MAXLENGTH => 0, 
        ContextId::ELT_ENUMERATION => 0, 
        ContextId::ELT_WHITESPACE => 0, 
        ContextId::ELT_PATTERN => 0, 
        ContextId::ELT_LIST => 0, 
        ContextId::ELT_UNION => 0, 
        ContextId::ELT_TOP_SIMPLETYPE => 0, 
        ContextId::ELT_NAMED_ATTRIBUTEGROUP => 0, 
        ContextId::ELT_ATTRIBUTE => 0, 
    ];
    
    /**
     * The map that associates a state and a symbol with an element name.
     * @var array[]
     */
    private $transitionElementNames = [
        ContextId::ELT_ROOT => [
            [ 0, ContextId::ELT_SCHEMA, 'schema', ], 
        ], 
        ContextId::ELT_SCHEMA => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
            [ 0, ContextId::ELT_IMPORT, 'import', ], 
            [ 0, ContextId::ELT_INCLUDE, 'include', ], 
            [ 0, ContextId::ELT_TOP_SIMPLETYPE, 'simpleType', ], 
            [ 0, ContextId::ELT_NAMED_ATTRIBUTEGROUP, 'attributeGroup', ], 
            [ 0, ContextId::ELT_TOP_ATTRIBUTE, 'attribute', ], 
            [ 0, ContextId::ELT_NOTATION, 'notation', ], 
            [ 1, ContextId::ELT_TOP_SIMPLETYPE, 'simpleType', ], 
            [ 1, ContextId::ELT_NAMED_ATTRIBUTEGROUP, 'attributeGroup', ], 
            [ 1, ContextId::ELT_TOP_ATTRIBUTE, 'attribute', ], 
            [ 1, ContextId::ELT_NOTATION, 'notation', ], 
            [ 1, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_ANNOTATION => [
            [ 0, ContextId::ELT_APPINFO, 'appinfo', ], 
            [ 0, ContextId::ELT_DOCUMENTATION, 'documentation', ], 
        ], 
        ContextId::ELT_IMPORT => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_INCLUDE => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_NOTATION => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_TOP_ATTRIBUTE => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
            [ 0, ContextId::ELT_LOCAL_SIMPLETYPE, 'simpleType', ], 
            [ 1, ContextId::ELT_LOCAL_SIMPLETYPE, 'simpleType', ], 
        ], 
        ContextId::ELT_LOCAL_SIMPLETYPE => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
            [ 0, ContextId::ELT_SIMPLETYPE_RESTRICTION, 'restriction', ], 
            [ 0, ContextId::ELT_LIST, 'list', ], 
            [ 0, ContextId::ELT_UNION, 'union', ], 
            [ 1, ContextId::ELT_SIMPLETYPE_RESTRICTION, 'restriction', ], 
            [ 1, ContextId::ELT_LIST, 'list', ], 
            [ 1, ContextId::ELT_UNION, 'union', ], 
        ], 
        ContextId::ELT_SIMPLETYPE_RESTRICTION => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
            [ 0, ContextId::ELT_LOCAL_SIMPLETYPE, 'simpleType', ], 
            [ 0, ContextId::ELT_MINEXCLUSIVE, 'minExclusive', ], 
            [ 0, ContextId::ELT_MININCLUSIVE, 'minInclusive', ], 
            [ 0, ContextId::ELT_MAXEXCLUSIVE, 'maxExclusive', ], 
            [ 0, ContextId::ELT_MAXINCLUSIVE, 'maxInclusive', ], 
            [ 0, ContextId::ELT_TOTALDIGITS, 'totalDigits', ], 
            [ 0, ContextId::ELT_FRACTIONDIGITS, 'fractionDigits', ], 
            [ 0, ContextId::ELT_LENGTH, 'length', ], 
            [ 0, ContextId::ELT_MINLENGTH, 'minLength', ], 
            [ 0, ContextId::ELT_MAXLENGTH, 'maxLength', ], 
            [ 0, ContextId::ELT_ENUMERATION, 'enumeration', ], 
            [ 0, ContextId::ELT_WHITESPACE, 'whiteSpace', ], 
            [ 0, ContextId::ELT_PATTERN, 'pattern', ], 
            [ 1, ContextId::ELT_LOCAL_SIMPLETYPE, 'simpleType', ], 
            [ 1, ContextId::ELT_MINEXCLUSIVE, 'minExclusive', ], 
            [ 1, ContextId::ELT_MININCLUSIVE, 'minInclusive', ], 
            [ 1, ContextId::ELT_MAXEXCLUSIVE, 'maxExclusive', ], 
            [ 1, ContextId::ELT_MAXINCLUSIVE, 'maxInclusive', ], 
            [ 1, ContextId::ELT_TOTALDIGITS, 'totalDigits', ], 
            [ 1, ContextId::ELT_FRACTIONDIGITS, 'fractionDigits', ], 
            [ 1, ContextId::ELT_LENGTH, 'length', ], 
            [ 1, ContextId::ELT_MINLENGTH, 'minLength', ], 
            [ 1, ContextId::ELT_MAXLENGTH, 'maxLength', ], 
            [ 1, ContextId::ELT_ENUMERATION, 'enumeration', ], 
            [ 1, ContextId::ELT_WHITESPACE, 'whiteSpace', ], 
            [ 1, ContextId::ELT_PATTERN, 'pattern', ], 
            [ 2, ContextId::ELT_MINEXCLUSIVE, 'minExclusive', ], 
            [ 2, ContextId::ELT_MININCLUSIVE, 'minInclusive', ], 
            [ 2, ContextId::ELT_MAXEXCLUSIVE, 'maxExclusive', ], 
            [ 2, ContextId::ELT_MAXINCLUSIVE, 'maxInclusive', ], 
            [ 2, ContextId::ELT_TOTALDIGITS, 'totalDigits', ], 
            [ 2, ContextId::ELT_FRACTIONDIGITS, 'fractionDigits', ], 
            [ 2, ContextId::ELT_LENGTH, 'length', ], 
            [ 2, ContextId::ELT_MINLENGTH, 'minLength', ], 
            [ 2, ContextId::ELT_MAXLENGTH, 'maxLength', ], 
            [ 2, ContextId::ELT_ENUMERATION, 'enumeration', ], 
            [ 2, ContextId::ELT_WHITESPACE, 'whiteSpace', ], 
            [ 2, ContextId::ELT_PATTERN, 'pattern', ], 
        ], 
        ContextId::ELT_MINEXCLUSIVE => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_MININCLUSIVE => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_MAXEXCLUSIVE => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_MAXINCLUSIVE => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_TOTALDIGITS => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_FRACTIONDIGITS => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_LENGTH => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_MINLENGTH => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_MAXLENGTH => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_ENUMERATION => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_WHITESPACE => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_PATTERN => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
        ], 
        ContextId::ELT_LIST => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
            [ 0, ContextId::ELT_LOCAL_SIMPLETYPE, 'simpleType', ], 
            [ 1, ContextId::ELT_LOCAL_SIMPLETYPE, 'simpleType', ], 
        ], 
        ContextId::ELT_UNION => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
            [ 0, ContextId::ELT_LOCAL_SIMPLETYPE, 'simpleType', ], 
            [ 1, ContextId::ELT_LOCAL_SIMPLETYPE, 'simpleType', ], 
        ], 
        ContextId::ELT_TOP_SIMPLETYPE => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
            [ 0, ContextId::ELT_SIMPLETYPE_RESTRICTION, 'restriction', ], 
            [ 0, ContextId::ELT_LIST, 'list', ], 
            [ 0, ContextId::ELT_UNION, 'union', ], 
            [ 1, ContextId::ELT_SIMPLETYPE_RESTRICTION, 'restriction', ], 
            [ 1, ContextId::ELT_LIST, 'list', ], 
            [ 1, ContextId::ELT_UNION, 'union', ], 
        ], 
        ContextId::ELT_NAMED_ATTRIBUTEGROUP => [
            [ 0, ContextId::ELT_ANNOTATION, 'annotation', ], 
            [ 0, ContextId::ELT_ATTRIBUTE, 'attribute', ], 
            [ 1, ContextId::ELT_ATTRIBUTE, 'attribute', ], 
        ], 
    ];
    
    /**
     * The map that associates a state and a symbol with a method used to 
     * create an element.
     * @var array[]
     */
    private $transitionElementBuilders = [
        ContextId::ELT_ROOT => [
            [ 0, ContextId::ELT_SCHEMA, 'buildSchemaElement', ], 
        ], 
        ContextId::ELT_SCHEMA => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildCompositionAnnotationElement', ], 
            [ 0, ContextId::ELT_IMPORT, 'buildImportElement', ], 
            [ 0, ContextId::ELT_INCLUDE, 'buildIncludeElement', ], 
            [ 0, ContextId::ELT_TOP_SIMPLETYPE, 'buildSimpleTypeElement', ], 
            [ 0, ContextId::ELT_NAMED_ATTRIBUTEGROUP, 'buildAttributeGroupElement', ], 
            [ 0, ContextId::ELT_TOP_ATTRIBUTE, 'buildAttributeElement', ], 
            [ 0, ContextId::ELT_NOTATION, 'buildNotationElement', ], 
            [ 1, ContextId::ELT_TOP_SIMPLETYPE, 'buildSimpleTypeElement', ], 
            [ 1, ContextId::ELT_NAMED_ATTRIBUTEGROUP, 'buildAttributeGroupElement', ], 
            [ 1, ContextId::ELT_TOP_ATTRIBUTE, 'buildAttributeElement', ], 
            [ 1, ContextId::ELT_NOTATION, 'buildNotationElement', ], 
            [ 1, ContextId::ELT_ANNOTATION, 'buildDefinitionAnnotationElement', ], 
        ], 
        ContextId::ELT_ANNOTATION => [
            [ 0, ContextId::ELT_APPINFO, 'buildAppInfoElement', ], 
            [ 0, ContextId::ELT_DOCUMENTATION, 'buildDocumentationElement', ], 
        ], 
        ContextId::ELT_IMPORT => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_INCLUDE => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_NOTATION => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_TOP_ATTRIBUTE => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
            [ 0, ContextId::ELT_LOCAL_SIMPLETYPE, 'buildSimpleTypeElement', ], 
            [ 1, ContextId::ELT_LOCAL_SIMPLETYPE, 'buildSimpleTypeElement', ], 
        ], 
        ContextId::ELT_LOCAL_SIMPLETYPE => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
            [ 0, ContextId::ELT_SIMPLETYPE_RESTRICTION, 'buildRestrictionElement', ], 
            [ 0, ContextId::ELT_LIST, 'buildListElement', ], 
            [ 0, ContextId::ELT_UNION, 'buildUnionElement', ], 
            [ 1, ContextId::ELT_SIMPLETYPE_RESTRICTION, 'buildRestrictionElement', ], 
            [ 1, ContextId::ELT_LIST, 'buildListElement', ], 
            [ 1, ContextId::ELT_UNION, 'buildUnionElement', ], 
        ], 
        ContextId::ELT_SIMPLETYPE_RESTRICTION => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
            [ 0, ContextId::ELT_LOCAL_SIMPLETYPE, 'buildSimpleTypeElement', ], 
            [ 0, ContextId::ELT_MINEXCLUSIVE, 'buildMinExclusiveElement', ], 
            [ 0, ContextId::ELT_MININCLUSIVE, 'buildMinInclusiveElement', ], 
            [ 0, ContextId::ELT_MAXEXCLUSIVE, 'buildMaxExclusiveElement', ], 
            [ 0, ContextId::ELT_MAXINCLUSIVE, 'buildMaxInclusiveElement', ], 
            [ 0, ContextId::ELT_TOTALDIGITS, 'buildTotalDigitsElement', ], 
            [ 0, ContextId::ELT_FRACTIONDIGITS, 'buildFractionDigitsElement', ], 
            [ 0, ContextId::ELT_LENGTH, 'buildLengthElement', ], 
            [ 0, ContextId::ELT_MINLENGTH, 'buildMinLengthElement', ], 
            [ 0, ContextId::ELT_MAXLENGTH, 'buildMaxLengthElement', ], 
            [ 0, ContextId::ELT_ENUMERATION, 'buildEnumerationElement', ], 
            [ 0, ContextId::ELT_WHITESPACE, 'buildWhiteSpaceElement', ], 
            [ 0, ContextId::ELT_PATTERN, 'buildPatternElement', ], 
            [ 1, ContextId::ELT_LOCAL_SIMPLETYPE, 'buildSimpleTypeElement', ], 
            [ 1, ContextId::ELT_MINEXCLUSIVE, 'buildMinExclusiveElement', ], 
            [ 1, ContextId::ELT_MININCLUSIVE, 'buildMinInclusiveElement', ], 
            [ 1, ContextId::ELT_MAXEXCLUSIVE, 'buildMaxExclusiveElement', ], 
            [ 1, ContextId::ELT_MAXINCLUSIVE, 'buildMaxInclusiveElement', ], 
            [ 1, ContextId::ELT_TOTALDIGITS, 'buildTotalDigitsElement', ], 
            [ 1, ContextId::ELT_FRACTIONDIGITS, 'buildFractionDigitsElement', ], 
            [ 1, ContextId::ELT_LENGTH, 'buildLengthElement', ], 
            [ 1, ContextId::ELT_MINLENGTH, 'buildMinLengthElement', ], 
            [ 1, ContextId::ELT_MAXLENGTH, 'buildMaxLengthElement', ], 
            [ 1, ContextId::ELT_ENUMERATION, 'buildEnumerationElement', ], 
            [ 1, ContextId::ELT_WHITESPACE, 'buildWhiteSpaceElement', ], 
            [ 1, ContextId::ELT_PATTERN, 'buildPatternElement', ], 
            [ 2, ContextId::ELT_MINEXCLUSIVE, 'buildMinExclusiveElement', ], 
            [ 2, ContextId::ELT_MININCLUSIVE, 'buildMinInclusiveElement', ], 
            [ 2, ContextId::ELT_MAXEXCLUSIVE, 'buildMaxExclusiveElement', ], 
            [ 2, ContextId::ELT_MAXINCLUSIVE, 'buildMaxInclusiveElement', ], 
            [ 2, ContextId::ELT_TOTALDIGITS, 'buildTotalDigitsElement', ], 
            [ 2, ContextId::ELT_FRACTIONDIGITS, 'buildFractionDigitsElement', ], 
            [ 2, ContextId::ELT_LENGTH, 'buildLengthElement', ], 
            [ 2, ContextId::ELT_MINLENGTH, 'buildMinLengthElement', ], 
            [ 2, ContextId::ELT_MAXLENGTH, 'buildMaxLengthElement', ], 
            [ 2, ContextId::ELT_ENUMERATION, 'buildEnumerationElement', ], 
            [ 2, ContextId::ELT_WHITESPACE, 'buildWhiteSpaceElement', ], 
            [ 2, ContextId::ELT_PATTERN, 'buildPatternElement', ], 
        ], 
        ContextId::ELT_MINEXCLUSIVE => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_MININCLUSIVE => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_MAXEXCLUSIVE => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_MAXINCLUSIVE => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_TOTALDIGITS => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_FRACTIONDIGITS => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_LENGTH => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_MINLENGTH => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_MAXLENGTH => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_ENUMERATION => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_WHITESPACE => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_PATTERN => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
        ], 
        ContextId::ELT_LIST => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
            [ 0, ContextId::ELT_LOCAL_SIMPLETYPE, 'buildSimpleTypeElement', ], 
            [ 1, ContextId::ELT_LOCAL_SIMPLETYPE, 'buildSimpleTypeElement', ], 
        ], 
        ContextId::ELT_UNION => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
            [ 0, ContextId::ELT_LOCAL_SIMPLETYPE, 'buildSimpleTypeElement', ], 
            [ 1, ContextId::ELT_LOCAL_SIMPLETYPE, 'buildSimpleTypeElement', ], 
        ], 
        ContextId::ELT_TOP_SIMPLETYPE => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
            [ 0, ContextId::ELT_SIMPLETYPE_RESTRICTION, 'buildRestrictionElement', ], 
            [ 0, ContextId::ELT_LIST, 'buildListElement', ], 
            [ 0, ContextId::ELT_UNION, 'buildUnionElement', ], 
            [ 1, ContextId::ELT_SIMPLETYPE_RESTRICTION, 'buildRestrictionElement', ], 
            [ 1, ContextId::ELT_LIST, 'buildListElement', ], 
            [ 1, ContextId::ELT_UNION, 'buildUnionElement', ], 
        ], 
        ContextId::ELT_NAMED_ATTRIBUTEGROUP => [
            [ 0, ContextId::ELT_ANNOTATION, 'buildAnnotationElement', ], 
            [ 0, ContextId::ELT_ATTRIBUTE, 'buildAttributeElement', ], 
            [ 1, ContextId::ELT_ATTRIBUTE, 'buildAttributeElement', ], 
        ], 
    ];
    
    /**
     * The map that associates a state and a symbol with a next state.
     * @var array[]
     */
    private $transitionNextStates = [
        ContextId::ELT_ROOT => [
            [ 0, ContextId::ELT_SCHEMA, 1, ], 
        ], 
        ContextId::ELT_SCHEMA => [
            [ 0, ContextId::ELT_ANNOTATION, 0, ], 
            [ 0, ContextId::ELT_IMPORT, 0, ], 
            [ 0, ContextId::ELT_INCLUDE, 0, ], 
            [ 0, ContextId::ELT_TOP_SIMPLETYPE, 1, ], 
            [ 0, ContextId::ELT_NAMED_ATTRIBUTEGROUP, 1, ], 
            [ 0, ContextId::ELT_TOP_ATTRIBUTE, 1, ], 
            [ 0, ContextId::ELT_NOTATION, 1, ], 
            [ 1, ContextId::ELT_TOP_SIMPLETYPE, 1, ], 
            [ 1, ContextId::ELT_NAMED_ATTRIBUTEGROUP, 1, ], 
            [ 1, ContextId::ELT_TOP_ATTRIBUTE, 1, ], 
            [ 1, ContextId::ELT_NOTATION, 1, ], 
            [ 1, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_ANNOTATION => [
            [ 0, ContextId::ELT_APPINFO, 0, ], 
            [ 0, ContextId::ELT_DOCUMENTATION, 0, ], 
        ], 
        ContextId::ELT_IMPORT => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_INCLUDE => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_NOTATION => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_TOP_ATTRIBUTE => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
            [ 0, ContextId::ELT_LOCAL_SIMPLETYPE, 2, ], 
            [ 1, ContextId::ELT_LOCAL_SIMPLETYPE, 2, ], 
        ], 
        ContextId::ELT_LOCAL_SIMPLETYPE => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
            [ 0, ContextId::ELT_SIMPLETYPE_RESTRICTION, 2, ], 
            [ 0, ContextId::ELT_LIST, 2, ], 
            [ 0, ContextId::ELT_UNION, 2, ], 
            [ 1, ContextId::ELT_SIMPLETYPE_RESTRICTION, 2, ], 
            [ 1, ContextId::ELT_LIST, 2, ], 
            [ 1, ContextId::ELT_UNION, 2, ], 
        ], 
        ContextId::ELT_SIMPLETYPE_RESTRICTION => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
            [ 0, ContextId::ELT_LOCAL_SIMPLETYPE, 2, ], 
            [ 0, ContextId::ELT_MINEXCLUSIVE, 2, ], 
            [ 0, ContextId::ELT_MININCLUSIVE, 2, ], 
            [ 0, ContextId::ELT_MAXEXCLUSIVE, 2, ], 
            [ 0, ContextId::ELT_MAXINCLUSIVE, 2, ], 
            [ 0, ContextId::ELT_TOTALDIGITS, 2, ], 
            [ 0, ContextId::ELT_FRACTIONDIGITS, 2, ], 
            [ 0, ContextId::ELT_LENGTH, 2, ], 
            [ 0, ContextId::ELT_MINLENGTH, 2, ], 
            [ 0, ContextId::ELT_MAXLENGTH, 2, ], 
            [ 0, ContextId::ELT_ENUMERATION, 2, ], 
            [ 0, ContextId::ELT_WHITESPACE, 2, ], 
            [ 0, ContextId::ELT_PATTERN, 2, ], 
            [ 1, ContextId::ELT_LOCAL_SIMPLETYPE, 2, ], 
            [ 1, ContextId::ELT_MINEXCLUSIVE, 2, ], 
            [ 1, ContextId::ELT_MININCLUSIVE, 2, ], 
            [ 1, ContextId::ELT_MAXEXCLUSIVE, 2, ], 
            [ 1, ContextId::ELT_MAXINCLUSIVE, 2, ], 
            [ 1, ContextId::ELT_TOTALDIGITS, 2, ], 
            [ 1, ContextId::ELT_FRACTIONDIGITS, 2, ], 
            [ 1, ContextId::ELT_LENGTH, 2, ], 
            [ 1, ContextId::ELT_MINLENGTH, 2, ], 
            [ 1, ContextId::ELT_MAXLENGTH, 2, ], 
            [ 1, ContextId::ELT_ENUMERATION, 2, ], 
            [ 1, ContextId::ELT_WHITESPACE, 2, ], 
            [ 1, ContextId::ELT_PATTERN, 2, ], 
            [ 2, ContextId::ELT_MINEXCLUSIVE, 2, ], 
            [ 2, ContextId::ELT_MININCLUSIVE, 2, ], 
            [ 2, ContextId::ELT_MAXEXCLUSIVE, 2, ], 
            [ 2, ContextId::ELT_MAXINCLUSIVE, 2, ], 
            [ 2, ContextId::ELT_TOTALDIGITS, 2, ], 
            [ 2, ContextId::ELT_FRACTIONDIGITS, 2, ], 
            [ 2, ContextId::ELT_LENGTH, 2, ], 
            [ 2, ContextId::ELT_MINLENGTH, 2, ], 
            [ 2, ContextId::ELT_MAXLENGTH, 2, ], 
            [ 2, ContextId::ELT_ENUMERATION, 2, ], 
            [ 2, ContextId::ELT_WHITESPACE, 2, ], 
            [ 2, ContextId::ELT_PATTERN, 2, ], 
        ], 
        ContextId::ELT_MINEXCLUSIVE => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_MININCLUSIVE => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_MAXEXCLUSIVE => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_MAXINCLUSIVE => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_TOTALDIGITS => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_FRACTIONDIGITS => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_LENGTH => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_MINLENGTH => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_MAXLENGTH => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_ENUMERATION => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_WHITESPACE => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_PATTERN => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
        ], 
        ContextId::ELT_LIST => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
            [ 0, ContextId::ELT_LOCAL_SIMPLETYPE, 2, ], 
            [ 1, ContextId::ELT_LOCAL_SIMPLETYPE, 2, ], 
        ], 
        ContextId::ELT_UNION => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
            [ 0, ContextId::ELT_LOCAL_SIMPLETYPE, 1, ], 
            [ 1, ContextId::ELT_LOCAL_SIMPLETYPE, 1, ], 
        ], 
        ContextId::ELT_TOP_SIMPLETYPE => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
            [ 0, ContextId::ELT_SIMPLETYPE_RESTRICTION, 2, ], 
            [ 0, ContextId::ELT_LIST, 2, ], 
            [ 0, ContextId::ELT_UNION, 2, ], 
            [ 1, ContextId::ELT_SIMPLETYPE_RESTRICTION, 2, ], 
            [ 1, ContextId::ELT_LIST, 2, ], 
            [ 1, ContextId::ELT_UNION, 2, ], 
        ], 
        ContextId::ELT_NAMED_ATTRIBUTEGROUP => [
            [ 0, ContextId::ELT_ANNOTATION, 1, ], 
            [ 0, ContextId::ELT_ATTRIBUTE, 1, ], 
            [ 1, ContextId::ELT_ATTRIBUTE, 1, ], 
        ], 
    ];
    
    /**
     * The map that associates an attribute with a method used to create an 
     * attribute.
     * @var array[]
     */
    private $attributeBuilders = [
        ContextId::ELT_SCHEMA => [
            [ 'attributeFormDefault', '', 'buildAttributeFormDefaultAttribute', ], 
            [ 'blockDefault', '', 'buildBlockDefaultAttribute', ], 
            [ 'elementFormDefault', '', 'buildElementFormDefaultAttribute', ], 
            [ 'finalDefault', '', 'buildFinalDefaultAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'targetNamespace', '', 'buildTargetNamespaceAttribute', ], 
            [ 'version', '', 'buildVersionAttribute', ], 
            [ 'lang', XmlNamespace::XML_1_0, 'buildLangAttribute', ], 
        ], 
        ContextId::ELT_ANNOTATION => [
            [ 'id', '', 'buildIdAttribute', ], 
        ], 
        ContextId::ELT_APPINFO => [
            [ 'source', '', 'buildSourceAttribute', ], 
        ], 
        ContextId::ELT_DOCUMENTATION => [
            [ 'source', '', 'buildSourceAttribute', ], 
            [ 'lang', XmlNamespace::XML_1_0, 'buildLangAttribute', ], 
        ], 
        ContextId::ELT_IMPORT => [
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'namespace', '', 'buildNamespaceAttribute', ], 
            [ 'schemaLocation', '', 'buildSchemaLocationAttribute', ], 
        ], 
        ContextId::ELT_INCLUDE => [
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'schemaLocation', '', 'buildSchemaLocationAttribute', ], 
        ], 
        ContextId::ELT_NOTATION => [
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'name', '', 'buildNameAttribute', ], 
            [ 'public', '', 'buildPublicAttribute', ], 
            [ 'system', '', 'buildSystemAttribute', ], 
        ], 
        ContextId::ELT_TOP_ATTRIBUTE => [
            [ 'default', '', 'buildDefaultAttribute', ], 
            [ 'fixed', '', 'buildFixedAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'name', '', 'buildNameAttribute', ], 
            [ 'type', '', 'buildTypeAttribute', ], 
        ], 
        ContextId::ELT_LOCAL_SIMPLETYPE => [
            [ 'id', '', 'buildIdAttribute', ], 
        ], 
        ContextId::ELT_SIMPLETYPE_RESTRICTION => [
            [ 'base', '', 'buildBaseAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
        ], 
        ContextId::ELT_MINEXCLUSIVE => [
            [ 'fixed', '', 'buildFixedAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'value', '', 'buildValueAttribute', ], 
        ], 
        ContextId::ELT_MININCLUSIVE => [
            [ 'fixed', '', 'buildFixedAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'value', '', 'buildValueAttribute', ], 
        ], 
        ContextId::ELT_MAXEXCLUSIVE => [
            [ 'fixed', '', 'buildFixedAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'value', '', 'buildValueAttribute', ], 
        ], 
        ContextId::ELT_MAXINCLUSIVE => [
            [ 'fixed', '', 'buildFixedAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'value', '', 'buildValueAttribute', ], 
        ], 
        ContextId::ELT_TOTALDIGITS => [
            [ 'fixed', '', 'buildFixedAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'value', '', 'buildValueAttribute', ], 
        ], 
        ContextId::ELT_FRACTIONDIGITS => [
            [ 'fixed', '', 'buildFixedAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'value', '', 'buildValueAttribute', ], 
        ], 
        ContextId::ELT_LENGTH => [
            [ 'fixed', '', 'buildFixedAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'value', '', 'buildValueAttribute', ], 
        ], 
        ContextId::ELT_MINLENGTH => [
            [ 'fixed', '', 'buildFixedAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'value', '', 'buildValueAttribute', ], 
        ], 
        ContextId::ELT_MAXLENGTH => [
            [ 'fixed', '', 'buildFixedAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'value', '', 'buildValueAttribute', ], 
        ], 
        ContextId::ELT_ENUMERATION => [
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'value', '', 'buildValueAttribute', ], 
        ], 
        ContextId::ELT_WHITESPACE => [
            [ 'fixed', '', 'buildFixedAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'value', '', 'buildValueAttribute', ], 
        ], 
        ContextId::ELT_PATTERN => [
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'value', '', 'buildValueAttribute', ], 
        ], 
        ContextId::ELT_LIST => [
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'itemType', '', 'buildItemTypeAttribute', ], 
        ], 
        ContextId::ELT_UNION => [
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'memberTypes', '', 'buildMemberTypesAttribute', ], 
        ], 
        ContextId::ELT_TOP_SIMPLETYPE => [
            [ 'final', '', 'buildFinalAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'name', '', 'buildNameAttribute', ], 
        ], 
        ContextId::ELT_NAMED_ATTRIBUTEGROUP => [
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'name', '', 'buildNameAttribute', ], 
        ], 
        ContextId::ELT_ATTRIBUTE => [
            [ 'default', '', 'buildDefaultAttribute', ], 
            [ 'fixed', '', 'buildFixedAttribute', ], 
            [ 'form', '', 'buildFormAttribute', ], 
            [ 'id', '', 'buildIdAttribute', ], 
            [ 'name', '', 'buildNameAttribute', ], 
        ], 
    ];
    
    /**
     * Creates the specification for the specified context ID.
     * 
     * @param   int $cid    The context ID to create the specification for.
     * @return  Specification   The created instance of Specification.
     * 
     * @throws  InvalidOperationException   When the context ID is not supported.
     */
    public function create(int $cid):Specification
    {
        if (!isset($this->initialStates[$cid]) && !isset($this->attributeBuilders[$cid])) {
            throw new InvalidOperationException(\sprintf(
                'The specification cannot be created because the context ID %s is not supported.',
                $cid
            ));
        }
        
        $spec = new Specification($cid);
        
        // Initializes the initial state.
        if (isset($this->initialStates[$cid])) {
            $spec->setInitialState($this->initialStates[$cid]);
        }
        
        // Associates transitions with element names.
        if (isset($this->transitionElementNames[$cid])) {
            foreach ($this->transitionElementNames[$cid] as list($state, $sym, $name)) {
                $spec->setTransitionElementName($state, $sym, $name);
            }
        }
        
        // Associates transitions with element builders.
        if (isset($this->transitionElementBuilders[$cid])) {
            foreach ($this->transitionElementBuilders[$cid] as list($state, $sym, $builder)) {
                $spec->setTransitionElementBuilder($state, $sym, $builder);
            }
        }
        
        // Associates transitions with next states.
        if (isset($this->transitionNextStates[$cid])) {
            foreach ($this->transitionNextStates[$cid] as list($state, $sym, $nextState)) {
                $spec->setTransitionNextState($state, $sym, $nextState);
            }
        }
        
        // Associates attributes with attribute builders.
        if (isset($this->attributeBuilders[$cid])) {
            foreach ($this->attributeBuilders[$cid] as list($name, $ns, $method)) {
                $spec->setAttributeBuilder($name, $ns, $method);
            }
        }
        
        return $spec;
    }
}
