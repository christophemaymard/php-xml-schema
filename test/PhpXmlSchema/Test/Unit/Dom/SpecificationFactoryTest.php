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
            [ 2, 0, ], // ELT_COMPOSITION_ANNOTATION
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
            [ 1, 0, 2, 'annotation', ], // ELT_COMPOSITION_ANNOTATION
            // Context: ELT_COMPOSITION_ANNOTATION
            [ 2, 0, 3, 'appinfo', ], // ELT_APPINFO
            [ 2, 0, 4, 'documentation', ], // ELT_DOCUMENTATION
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
            [ 1, 0, 2, 'buildCompositionAnnotationElement', ], // ELT_COMPOSITION_ANNOTATION
            // Context: ELT_COMPOSITION_ANNOTATION
            [ 2, 0, 3, 'buildAppInfoElement', ], // ELT_APPINFO
            [ 2, 0, 4, 'buildDocumentationElement', ], // ELT_DOCUMENTATION
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
            [ 1, 0, 2, 0, ], // ELT_COMPOSITION_ANNOTATION
            // Context: ELT_COMPOSITION_ANNOTATION
            [ 2, 0, 3, 0, ], // ELT_APPINFO
            [ 2, 0, 4, 0, ], // ELT_DOCUMENTATION
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
            // Context: ELT_COMPOSITION_ANNOTATION
            [ 2, 'id', '', 'buildIdAttribute', ], 
            // Context: ELT_APPINFO
            [ 3, 'source', '', 'buildSourceAttribute', ], 
            // Context: ELT_DOCUMENTATION
            [ 4, 'source', '', 'buildSourceAttribute', ], 
            [ 4, 'lang', 'http://www.w3.org/XML/1998/namespace', 'buildLangAttribute', ], 
        ];
    }
}
