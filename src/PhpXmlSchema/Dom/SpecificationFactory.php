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
            [ 0, ContextId::ELT_NOTATION, 'notation', ], 
            [ 1, ContextId::ELT_NOTATION, 'notation', ], 
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
            [ 0, ContextId::ELT_NOTATION, 'buildNotationElement', ], 
            [ 1, ContextId::ELT_NOTATION, 'buildNotationElement', ], 
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
            [ 0, ContextId::ELT_NOTATION, 1, ], 
            [ 1, ContextId::ELT_NOTATION, 1, ], 
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
