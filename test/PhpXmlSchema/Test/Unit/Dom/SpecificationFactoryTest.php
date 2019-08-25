<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\SpecificationFactory;
use PhpXmlSchema\Exception\InvalidOperationException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SpecificationFactory} 
 * class.
 * 
 * @group   specification
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SpecificationFactoryTest extends TestCase
{
    /**
     * @var SpecificationRegistryFactory
     */
    private $sut;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SpecificationFactory();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that create() throws an exception when the context ID has no 
     * initial state.
     */
    public function testCreateThrowsExceptionWhenInitialStateNotSet()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The specification cannot be created '.
            'because the context ID 1000 is not supported.');
        
        $this->sut->create(1000);
    }
    
    /**
     * Tests that getInitialState(), of the instance created by create(), 
     * returns an integer.
     * 
     * @param   int $cid    The context ID used to create the specification.
     * @param   int $state  The expected state.
     * 
     * @dataProvider    getInitialStates
     */
    public function testCreateGetInitialStateReturnsInt(int $cid, int $state)
    {
        $spec = $this->sut->create($cid);
        self::assertSame($state, $spec->getInitialState());
    }
    
    /**
     * Tests that getTransitionElementName(), of the instance created by 
     * create(), returns the name that is associated with a state and a 
     * symbol.
     * 
     * @param   int     $cid    The context ID used to create the specification.
     * @param   int     $state  The state of the transition to test.
     * @param   int     $sym    The symbol of the transition to test.
     * @param   string  $name   The expected name.
     * 
     * @dataProvider    getTransitionElementNames
     */
    public function testCreateGetTransitionElementName(
        int $cid, 
        int $state, 
        int $sym, 
        string $name
    ) {
        $spec = $this->sut->create($cid);
        self::assertSame($name, $spec->getTransitionElementName($state, $sym));
    }
    
    /**
     * Tests that getTransitionElementBuilder(), of the instance created by 
     * create(), returns the method name that is associated with a state and 
     * a symbol.
     * 
     * @param   int     $cid        The context ID used to create the specification.
     * @param   int     $state      The state of the transition to test.
     * @param   int     $sym        The symbol of the transition to test.
     * @param   string  $method     The expected method.
     * 
     * @dataProvider    getTransitionElementBuilders
     */
    public function testCreateGetTransitionElementBuilder(
        int $cid, 
        int $state, 
        int $sym, 
        string $method
    ) {
        $spec = $this->sut->create($cid);
        self::assertSame($method, $spec->getTransitionElementBuilder($state, $sym));
    }
    
    /**
     * Tests that getTransitionNextState(), of the instance created by 
     * create(), returns the next state that is associated with a state and a 
     * symbol.
     * 
     * @param   int     $cid        The context ID used to create the specification.
     * @param   int     $state      The state of the transition to test.
     * @param   int     $sym        The symbol of the transition to test.
     * @param   int     $nextState  The expected next state.
     * 
     * @dataProvider    getTransitionNextStates
     */
    public function testCreateGetTransitionNextState(
        int $cid, 
        int $state, 
        int $sym, 
        int $nextState
    ) {
        $spec = $this->sut->create($cid);
        self::assertSame($nextState, $spec->getTransitionNextState($state, $sym));
    }
    
    /**
     * Tests that getAttributeBuilder(), of the instance created by 
     * create(), returns the method name that is associated with an attribute.
     * 
     * @param   int     $cid    The context ID used to create the specification.
     * @param   string  $name   The local name of the attribute to test.
     * @param   string  $ns     The namespace of the attribute to test.
     * @param   string  $method The expected method name.
     * 
     * @dataProvider    getAttributeBuilders
     */
    public function testCreateGetAttributeBuilder(
        int $cid, 
        string $name, 
        string $ns, 
        string $method
    ) {
        $spec = $this->sut->create($cid);
        self::assertSame($method, $spec->getAttributeBuilder($name, $ns));
    }
    
    /**
     * Returns a set of initial states with the context IDs.
     * 
     * @return  array[]
     */
    public function getInitialStates():array
    {
        return [
            [ 0, 0, ], // ELT_ROOT
            [ 1, 0, ], // ELT_SCHEMA
            [ 2, 0, ], // ELT_ANNOTATION
            [ 5, 0, ], // ELT_IMPORT
            [ 6, 0, ], // ELT_INCLUDE
            [ 7, 0, ], // ELT_NOTATION
            [ 8, 0, ], // ELT_TOP_ATTRIBUTE
            [ 9, 0, ], // ELT_LOCAL_SIMPLETYPE
            [ 10, 0, ], // ELT_SIMPLETYPE_RESTRICTION
        ];
    }
    
    /**
     * Returns a set of names that are associated with a state and a symbol 
     * for each context ID.
     * 
     * @return  array[]
     */
    public function getTransitionElementNames():array
    {
        return [
            // Context: ELT_ROOT
            [ 0, 0, 1, 'schema', ], 
            // Context: ELT_SCHEMA
            [ 1, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 1, 0, 5, 'import', ], // ELT_IMPORT
            [ 1, 0, 6, 'include', ], // ELT_INCLUDE
            [ 1, 0, 8, 'attribute', ], // ELT_TOP_ATTRIBUTE
            [ 1, 0, 7, 'notation', ], // ELT_NOTATION
            [ 1, 1, 8, 'attribute', ], // ELT_TOP_ATTRIBUTE
            [ 1, 1, 7, 'notation', ], // ELT_NOTATION
            [ 1, 1, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_ANNOTATION
            [ 2, 0, 3, 'appinfo', ], // ELT_APPINFO
            [ 2, 0, 4, 'documentation', ], // ELT_DOCUMENTATION
            // Context: ELT_IMPORT
            [ 5, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_INCLUDE
            [ 6, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_NOTATION
            [ 7, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_TOP_ATTRIBUTE
            [ 8, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 8, 0, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            [ 8, 1, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            // Context: ELT_LOCAL_SIMPLETYPE
            [ 9, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 9, 0, 10, 'restriction', ], // ELT_SIMPLETYPE_RESTRICTION
            [ 9, 1, 10, 'restriction', ], // ELT_SIMPLETYPE_RESTRICTION
            // Context: ELT_SIMPLETYPE_RESTRICTION
            [ 10, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 10, 0, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            [ 10, 1, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
        ];
    }
    
    /**
     * Returns a set of method names that are associated with a state and a 
     * symbol for each context ID.
     * 
     * @return  array[]
     */
    public function getTransitionElementBuilders():array
    {
        return [
            // Context: ELT_ROOT
            [ 0, 0, 1, 'buildSchemaElement', ], // ELT_SCHEMA
            // Context: ELT_SCHEMA
            [ 1, 0, 2, 'buildCompositionAnnotationElement', ], // ELT_ANNOTATION
            [ 1, 0, 5, 'buildImportElement', ], // ELT_IMPORT
            [ 1, 0, 6, 'buildIncludeElement', ], // ELT_INCLUDE
            [ 1, 0, 8, 'buildAttributeElement', ], // ELT_TOP_ATTRIBUTE
            [ 1, 0, 7, 'buildNotationElement', ], // ELT_NOTATION
            [ 1, 1, 8, 'buildAttributeElement', ], // ELT_TOP_ATTRIBUTE
            [ 1, 1, 7, 'buildNotationElement', ], // ELT_NOTATION
            [ 1, 1, 2, 'buildDefinitionAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_ANNOTATION
            [ 2, 0, 3, 'buildAppInfoElement', ], // ELT_APPINFO
            [ 2, 0, 4, 'buildDocumentationElement', ], // ELT_DOCUMENTATION
            // Context: ELT_IMPORT
            [ 5, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_INCLUDE
            [ 6, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_NOTATION
            [ 7, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_TOP_ATTRIBUTE
            [ 8, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 8, 0, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            [ 8, 1, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            // Context: ELT_LOCAL_SIMPLETYPE
            [ 9, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 9, 0, 10, 'buildRestrictionElement', ], // ELT_SIMPLETYPE_RESTRICTION
            [ 9, 1, 10, 'buildRestrictionElement', ], // ELT_SIMPLETYPE_RESTRICTION
            // Context: ELT_SIMPLETYPE_RESTRICTION
            [ 10, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 10, 0, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            [ 10, 1, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
        ];
    }
    
    /**
     * Returns a set of next states that are associated with a state and a 
     * symbol for each context ID.
     * 
     * @return  array[]
     */
    public function getTransitionNextStates():array
    {
        return [
            // Context: ELT_ROOT
            [ 0, 0, 1, 1, ], // ELT_SCHEMA
            // Context: ELT_SCHEMA
            [ 1, 0, 2, 0, ], // ELT_ANNOTATION
            [ 1, 0, 5, 0, ], // ELT_IMPORT
            [ 1, 0, 6, 0 ], // ELT_INCLUDE
            [ 1, 0, 8, 1, ], // ELT_TOP_ATTRIBUTE
            [ 1, 0, 7, 1, ], // ELT_NOTATION
            [ 1, 1, 8, 1, ], // ELT_TOP_ATTRIBUTE
            [ 1, 1, 7, 1, ], // ELT_NOTATION
            [ 1, 1, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_ANNOTATION
            [ 2, 0, 3, 0, ], // ELT_APPINFO
            [ 2, 0, 4, 0, ], // ELT_DOCUMENTATION
            // Context: ELT_IMPORT
            [ 5, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_INCLUDE
            [ 6, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_NOTATION
            [ 7, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_TOP_ATTRIBUTE
            [ 8, 0, 2, 1, ], // ELT_ANNOTATION
            [ 8, 0, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            [ 8, 1, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            // Context: ELT_LOCAL_SIMPLETYPE
            [ 9, 0, 2, 1, ], // ELT_ANNOTATION
            [ 9, 0, 10, 2, ], // ELT_SIMPLETYPE_RESTRICTION
            [ 9, 1, 10, 2, ], // ELT_SIMPLETYPE_RESTRICTION
            // Context: ELT_SIMPLETYPE_RESTRICTION
            [ 10, 0, 2, 1, ], // ELT_ANNOTATION
            [ 10, 0, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            [ 10, 1, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
        ];
    }
    
    /**
     * Returns a set of method names that are associated with attributes.
     * 
     * @return  array[]
     */
    public function getAttributeBuilders():array
    {
        return [
            // Context: ELT_SCHEMA
            [ 1, 'attributeFormDefault', '', 'buildAttributeFormDefaultAttribute', ], 
            [ 1, 'blockDefault', '', 'buildBlockDefaultAttribute', ], 
            [ 1, 'elementFormDefault', '', 'buildElementFormDefaultAttribute', ], 
            [ 1, 'finalDefault', '', 'buildFinalDefaultAttribute', ], 
            [ 1, 'id', '', 'buildIdAttribute', ], 
            [ 1, 'targetNamespace', '', 'buildTargetNamespaceAttribute', ], 
            [ 1, 'version', '', 'buildVersionAttribute', ], 
            [ 1, 'lang', 'http://www.w3.org/XML/1998/namespace', 'buildLangAttribute', ], 
            // Context: ELT_ANNOTATION
            [ 2, 'id', '', 'buildIdAttribute', ], 
            // Context: ELT_APPINFO
            [ 3, 'source', '', 'buildSourceAttribute', ], 
            // Context: ELT_DOCUMENTATION
            [ 4, 'source', '', 'buildSourceAttribute', ], 
            [ 4, 'lang', 'http://www.w3.org/XML/1998/namespace', 'buildLangAttribute', ], 
            // Context: ELT_IMPORT
            [ 5, 'id', '', 'buildIdAttribute', ], 
            [ 5, 'namespace', '', 'buildNamespaceAttribute', ], 
            [ 5, 'schemaLocation', '', 'buildSchemaLocationAttribute', ], 
            // Context: ELT_INCLUDE
            [ 6, 'id', '', 'buildIdAttribute', ], 
            [ 6, 'schemaLocation', '', 'buildSchemaLocationAttribute', ], 
            // Context: ELT_NOTATION
            [ 7, 'id', '', 'buildIdAttribute', ], 
            [ 7, 'name', '', 'buildNameAttribute', ], 
            [ 7, 'public', '', 'buildPublicAttribute', ], 
            [ 7, 'system', '', 'buildSystemAttribute', ], 
            // Context: ELT_TOP_ATTRIBUTE
            [ 8, 'default', '', 'buildDefaultAttribute', ], 
            [ 8, 'fixed', '', 'buildFixedAttribute', ], 
            [ 8, 'id', '', 'buildIdAttribute', ], 
            [ 8, 'name', '', 'buildNameAttribute', ], 
            [ 8, 'type', '', 'buildTypeAttribute', ], 
            // Context: ELT_LOCAL_SIMPLETYPE
            [ 9, 'id', '', 'buildIdAttribute', ], 
            // Context: ELT_SIMPLETYPE_RESTRICTION
            [ 10, 'base', '', 'buildBaseAttribute', ], 
            [ 10, 'id', '', 'buildIdAttribute', ], 
        ];
    }
}
