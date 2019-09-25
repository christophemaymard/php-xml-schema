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
     * Tests that getFinalStates(), of the instance created by create(), 
     * returns an array of integers.
     * 
     * @param   int     $cid    The context ID used to create the specification.
     * @param   int[]   $states The expected final states.
     * 
     * @dataProvider    getFinalStates
     */
    public function testCreateGetFinalStatesReturnsArrayOfInt(int $cid, array $states)
    {
        $spec = $this->sut->create($cid);
        self::assertSame($states, $spec->getFinalStates());
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
            [ 11, 0, ], // ELT_MINEXCLUSIVE
            [ 12, 0, ], // ELT_MININCLUSIVE
            [ 13, 0, ], // ELT_MAXEXCLUSIVE
            [ 14, 0, ], // ELT_MAXINCLUSIVE
            [ 15, 0, ], // ELT_TOTALDIGITS
            [ 16, 0, ], // ELT_FRACTIONDIGITS
            [ 17, 0, ], // ELT_LENGTH
            [ 18, 0, ], // ELT_MINLENGTH
            [ 19, 0, ], // ELT_MAXLENGTH
            [ 20, 0, ], // ELT_ENUMERATION
            [ 21, 0, ], // ELT_WHITESPACE
            [ 22, 0, ], // ELT_PATTERN
            [ 23, 0, ], // ELT_LIST
            [ 24, 0, ], // ELT_UNION
            [ 25, 0, ], // ELT_TOP_SIMPLETYPE
            [ 26, 0, ], // ELT_NAMED_ATTRIBUTEGROUP
            [ 27, 0, ], // ELT_ATTRIBUTE
            [ 28, 0, ], // ELT_ATTRIBUTEGROUP_REF
            [ 29, 0, ], // ELT_ANYATTRIBUTE
            [ 30, 0, ], // ELT_TOP_COMPLEXTYPE
            [ 31, 0, ], // ELT_SIMPLECONTENT
            [ 32, 0, ], // ELT_SIMPLECONTENT_RESTRICTION
            [ 33, 0, ], // ELT_SIMPLECONTENT_EXTENSION
            [ 34, 0, ], // ELT_COMPLEXCONTENT
            [ 35, 0, ], // ELT_COMPLEXCONTENT_RESTRICTION
            [ 36, 0, ], // ELT_GROUP_REF
            [ 37, 0, ], // ELT_ALL
            [ 38, 0, ], // ELT_NARROW_ELEMENT
            [ 39, 0, ], // ELT_LOCAL_COMPLEXTYPE
            [ 40, 0, ], // ELT_EXPLICIT_CHOICE
            [ 41, 0, ], // ELT_LOCAL_ELEMENT
            [ 42, 0, ], // ELT_UNIQUE
            [ 43, 0, ], // ELT_SELECTOR
            [ 44, 0, ], // ELT_FIELD
            [ 45, 0, ], // ELT_KEY
            [ 46, 0, ], // ELT_KEYREF
            [ 47, 0, ], // ELT_EXPLICIT_SEQUENCE
            [ 48, 0, ], // ELT_ANY
            [ 49, 0, ], // ELT_COMPLEXCONTENT_EXTENSION
            [ 50, 0, ], // ELT_NAMED_GROUP
            [ 51, 0, ], // ELT_ANONYMOUS_ALL
            [ 52, 0, ], // ELT_SIMPLE_CHOICE
            [ 53, 0, ], // ELT_SIMPLE_SEQUENCE
            [ 54, 0, ], // ELT_TOP_ELEMENT
        ];
    }
    
    /**
     * Returns a set of final states with the context IDs.
     * 
     * @return  array[]
     */
    public function getFinalStates():array
    {
        return [
            [ 0, [ 1, ], ], // ELT_ROOT
            [ 1, [ 0, 1, ], ], // ELT_SCHEMA
            [ 2, [ 0, ], ], // ELT_ANNOTATION
            [ 5, [ 0, 1, ], ], // ELT_IMPORT
            [ 6, [ 0, 1, ], ], // ELT_INCLUDE
            [ 7, [ 0, 1, ], ], // ELT_NOTATION
            [ 8, [ 0, 1, 2, ], ], // ELT_TOP_ATTRIBUTE
            [ 9, [ 2, ], ], // ELT_LOCAL_SIMPLETYPE
            [ 10, [ 0, 1, 2, ], ], // ELT_SIMPLETYPE_RESTRICTION
            [ 11, [ 0, 1, ], ], // ELT_MINEXCLUSIVE
            [ 12, [ 0, 1, ], ], // ELT_MININCLUSIVE
            [ 13, [ 0, 1, ], ], // ELT_MAXEXCLUSIVE
            [ 14, [ 0, 1, ], ], // ELT_MAXINCLUSIVE
            [ 15, [ 0, 1, ], ], // ELT_TOTALDIGITS
            [ 16, [ 0, 1, ], ], // ELT_FRACTIONDIGITS
            [ 17, [ 0, 1, ], ], // ELT_LENGTH
            [ 18, [ 0, 1, ], ], // ELT_MINLENGTH
            [ 19, [ 0, 1, ], ], // ELT_MAXLENGTH
            [ 20, [ 0, 1, ], ], // ELT_ENUMERATION
            [ 21, [ 0, 1, ], ], // ELT_WHITESPACE
            [ 22, [ 0, 1, ], ], // ELT_PATTERN
            [ 23, [ 0, 1, 2, ], ], // ELT_LIST
            [ 24, [ 0, 1, ], ], // ELT_UNION
            [ 25, [ 2, ], ], // ELT_TOP_SIMPLETYPE
            [ 26, [ 0, 1, 2, ], ], // ELT_NAMED_ATTRIBUTEGROUP
            [ 27, [ 0, 1, 2, ], ], // ELT_ATTRIBUTE
            [ 28, [ 0, 1, ], ], // ELT_ATTRIBUTEGROUP_REF
            [ 29, [ 0, 1, ], ], // ELT_ANYATTRIBUTE
            [ 30, [ 0, 1, 2, 3, ], ], // ELT_TOP_COMPLEXTYPE
            [ 31, [ 2, ], ], // ELT_SIMPLECONTENT
            [ 32, [ 0, 1, 2, 3, 4, ], ], // ELT_SIMPLECONTENT_RESTRICTION
            [ 33, [ 0, 1, 2, ], ], // ELT_SIMPLECONTENT_EXTENSION
            [ 34, [ 2, ], ], // ELT_COMPLEXCONTENT
            [ 35, [ 0, 1, 2, 3, ], ], // ELT_COMPLEXCONTENT_RESTRICTION
            [ 36, [ 0, 1, ], ], // ELT_GROUP_REF
            [ 37, [ 0, 1, ], ], // ELT_ALL
            [ 38, [ 0, 1, 2, ], ], // ELT_NARROW_ELEMENT
            [ 39, [ 0, 1, 2, 3, ], ], // ELT_LOCAL_COMPLEXTYPE
            [ 40, [ 0, 1, ], ], // ELT_EXPLICIT_CHOICE
            [ 41, [ 0, 1, 2, ], ], // ELT_LOCAL_ELEMENT
            [ 42, [ 3, ], ], // ELT_UNIQUE
            [ 43, [ 0, 1, ], ], // ELT_SELECTOR
            [ 44, [ 0, 1, ], ], // ELT_FIELD
            [ 45, [ 3, ], ], // ELT_KEY
            [ 46, [ 3, ], ], // ELT_KEYREF
            [ 47, [ 0, 1, ], ], // ELT_EXPLICIT_SEQUENCE
            [ 48, [ 0, 1, ], ], // ELT_ANY
            [ 49, [ 0, 1, 2, 3, ], ], // ELT_COMPLEXCONTENT_EXTENSION
            [ 50, [ 2, ], ], // ELT_NAMED_GROUP
            [ 51, [ 0, 1, ], ], // ELT_ANONYMOUS_ALL
            [ 52, [ 0, 1, ], ], // ELT_SIMPLE_CHOICE
            [ 53, [ 0, 1, ], ], // ELT_SIMPLE_SEQUENCE
            [ 54, [ 0, 1, 2, ], ], // ELT_LOCAL_ELEMENT
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
            [ 1, 0, 25, 'simpleType', ], // ELT_TOP_SIMPLETYPE
            [ 1, 0, 30, 'complexType', ], // ELT_TOP_COMPLEXTYPE
            [ 1, 0, 50, 'group', ], // ELT_NAMED_GROUP
            [ 1, 0, 26, 'attributeGroup', ], // ELT_NAMED_ATTRIBUTEGROUP
            [ 1, 0, 54, 'element', ], // ELT_TOP_ELEMENT
            [ 1, 0, 8, 'attribute', ], // ELT_TOP_ATTRIBUTE
            [ 1, 0, 7, 'notation', ], // ELT_NOTATION
            [ 1, 1, 25, 'simpleType', ], // ELT_TOP_SIMPLETYPE
            [ 1, 1, 30, 'complexType', ], // ELT_TOP_COMPLEXTYPE
            [ 1, 1, 50, 'group', ], // ELT_NAMED_GROUP
            [ 1, 1, 26, 'attributeGroup', ], // ELT_NAMED_ATTRIBUTEGROUP
            [ 1, 1, 54, 'element', ], // ELT_TOP_ELEMENT
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
            [ 9, 0, 23, 'list', ], // ELT_LIST
            [ 9, 0, 24, 'union', ], // ELT_UNION
            [ 9, 1, 10, 'restriction', ], // ELT_SIMPLETYPE_RESTRICTION
            [ 9, 1, 23, 'list', ], // ELT_LIST
            [ 9, 1, 24, 'union', ], // ELT_UNION
            // Context: ELT_SIMPLETYPE_RESTRICTION
            [ 10, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 10, 0, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            [ 10, 0, 11, 'minExclusive', ], // ELT_MINEXCLUSIVE
            [ 10, 0, 12, 'minInclusive', ], // ELT_MININCLUSIVE
            [ 10, 0, 13, 'maxExclusive', ], // ELT_MAXEXCLUSIVE
            [ 10, 0, 14, 'maxInclusive', ], // ELT_MAXINCLUSIVE
            [ 10, 0, 15, 'totalDigits', ], // ELT_TOTALDIGITS
            [ 10, 0, 16, 'fractionDigits', ], // ELT_FRACTIONDIGITS
            [ 10, 0, 17, 'length', ], // ELT_LENGTH
            [ 10, 0, 18, 'minLength', ], // ELT_MINLENGTH
            [ 10, 0, 19, 'maxLength', ], // ELT_MAXLENGTH
            [ 10, 0, 20, 'enumeration', ], // ELT_ENUMERATION
            [ 10, 0, 21, 'whiteSpace', ], // ELT_WHITESPACE
            [ 10, 0, 22, 'pattern', ], // ELT_PATTERN
            [ 10, 1, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            [ 10, 1, 11, 'minExclusive', ], // ELT_MINEXCLUSIVE
            [ 10, 1, 12, 'minInclusive', ], // ELT_MININCLUSIVE
            [ 10, 1, 13, 'maxExclusive', ], // ELT_MAXEXCLUSIVE
            [ 10, 1, 14, 'maxInclusive', ], // ELT_MAXINCLUSIVE
            [ 10, 1, 15, 'totalDigits', ], // ELT_TOTALDIGITS
            [ 10, 1, 16, 'fractionDigits', ], // ELT_FRACTIONDIGITS
            [ 10, 1, 17, 'length', ], // ELT_LENGTH
            [ 10, 1, 18, 'minLength', ], // ELT_MINLENGTH
            [ 10, 1, 19, 'maxLength', ], // ELT_MAXLENGTH
            [ 10, 1, 20, 'enumeration', ], // ELT_ENUMERATION
            [ 10, 1, 21, 'whiteSpace', ], // ELT_WHITESPACE
            [ 10, 1, 22, 'pattern', ], // ELT_PATTERN
            [ 10, 2, 11, 'minExclusive', ], // ELT_MINEXCLUSIVE
            [ 10, 2, 12, 'minInclusive', ], // ELT_MININCLUSIVE
            [ 10, 2, 13, 'maxExclusive', ], // ELT_MAXEXCLUSIVE
            [ 10, 2, 14, 'maxInclusive', ], // ELT_MAXINCLUSIVE
            [ 10, 2, 15, 'totalDigits', ], // ELT_TOTALDIGITS
            [ 10, 2, 16, 'fractionDigits', ], // ELT_FRACTIONDIGITS
            [ 10, 2, 17, 'length', ], // ELT_LENGTH
            [ 10, 2, 18, 'minLength', ], // ELT_MINLENGTH
            [ 10, 2, 19, 'maxLength', ], // ELT_MAXLENGTH
            [ 10, 2, 20, 'enumeration', ], // ELT_ENUMERATION
            [ 10, 2, 21, 'whiteSpace', ], // ELT_WHITESPACE
            [ 10, 2, 22, 'pattern', ], // ELT_PATTERN
            // Context: ELT_MINEXCLUSIVE
            [ 11, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_MININCLUSIVE
            [ 12, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_MAXEXCLUSIVE
            [ 13, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_MAXINCLUSIVE
            [ 14, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_TOTALDIGITS
            [ 15, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_FRACTIONDIGITS
            [ 16, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_LENGTH
            [ 17, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_MINLENGTH
            [ 18, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_MAXLENGTH
            [ 19, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_ENUMERATION
            [ 20, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_WHITESPACE
            [ 21, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_PATTERN
            [ 22, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_LIST
            [ 23, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 23, 0, 9, 'simpleType', ], // ELT_ANNOTATION
            [ 23, 1, 9, 'simpleType', ], // ELT_ANNOTATION
            // Context: ELT_UNION
            [ 24, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 24, 0, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            [ 24, 1, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            // Context: ELT_TOP_SIMPLETYPE
            [ 25, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 25, 0, 10, 'restriction', ], // ELT_SIMPLETYPE_RESTRICTION
            [ 25, 0, 23, 'list', ], // ELT_LIST
            [ 25, 0, 24, 'union', ], // ELT_UNION
            [ 25, 1, 10, 'restriction', ], // ELT_SIMPLETYPE_RESTRICTION
            [ 25, 1, 23, 'list', ], // ELT_LIST
            [ 25, 1, 24, 'union', ], // ELT_UNION
            // Context: ELT_NAMED_ATTRIBUTEGROUP
            [ 26, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 26, 0, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 26, 0, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 26, 0, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            [ 26, 1, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 26, 1, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 26, 1, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            // Context: ELT_ATTRIBUTE
            [ 27, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 27, 0, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            [ 27, 1, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            // Context: ELT_ATTRIBUTEGROUP_REF
            [ 28, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_ANYATTRIBUTE
            [ 29, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_TOP_COMPLEXTYPE
            [ 30, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 30, 0, 31, 'simpleContent', ], // ELT_SIMPLECONTENT
            [ 30, 0, 34, 'complexContent', ], // ELT_COMPLEXCONTENT
            [ 30, 0, 36, 'group', ], // ELT_GROUP_REF
            [ 30, 0, 37, 'all', ], // ELT_ALL
            [ 30, 0, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 30, 0, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 30, 0, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 30, 0, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 30, 0, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            [ 30, 1, 31, 'simpleContent', ], // ELT_SIMPLECONTENT
            [ 30, 1, 34, 'complexContent', ], // ELT_COMPLEXCONTENT
            [ 30, 1, 36, 'group', ], // ELT_GROUP_REF
            [ 30, 1, 37, 'all', ], // ELT_ALL
            [ 30, 1, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 30, 1, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 30, 1, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 30, 1, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 30, 1, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            [ 30, 2, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 30, 2, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 30, 2, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            // Context: ELT_SIMPLECONTENT
            [ 31, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 31, 0, 32, 'restriction', ], // ELT_SIMPLECONTENT_RESTRICTION
            [ 31, 0, 33, 'extension', ], // ELT_SIMPLECONTENT_EXTENSION
            [ 31, 1, 32, 'restriction', ], // ELT_SIMPLECONTENT_RESTRICTION
            [ 31, 1, 33, 'extension', ], // ELT_SIMPLECONTENT_EXTENSION
            // Context: ELT_SIMPLECONTENT_RESTRICTION
            [ 32, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 32, 0, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            [ 32, 0, 11, 'minExclusive', ], // ELT_MINEXCLUSIVE
            [ 32, 0, 12, 'minInclusive', ], // ELT_MININCLUSIVE
            [ 32, 0, 13, 'maxExclusive', ], // ELT_MAXEXCLUSIVE
            [ 32, 0, 14, 'maxInclusive', ], // ELT_MAXINCLUSIVE
            [ 32, 0, 15, 'totalDigits', ], // ELT_TOTALDIGITS
            [ 32, 0, 16, 'fractionDigits', ], // ELT_FRACTIONDIGITS
            [ 32, 0, 17, 'length', ], // ELT_LENGTH
            [ 32, 0, 18, 'minLength', ], // ELT_MINLENGTH
            [ 32, 0, 19, 'maxLength', ], // ELT_MAXLENGTH
            [ 32, 0, 20, 'enumeration', ], // ELT_ENUMERATION
            [ 32, 0, 21, 'whiteSpace', ], // ELT_WHITESPACE
            [ 32, 0, 22, 'pattern', ], // ELT_PATTERN
            [ 32, 0, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 32, 0, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 32, 0, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            [ 32, 1, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            [ 32, 1, 11, 'minExclusive', ], // ELT_MINEXCLUSIVE
            [ 32, 1, 12, 'minInclusive', ], // ELT_MININCLUSIVE
            [ 32, 1, 13, 'maxExclusive', ], // ELT_MAXEXCLUSIVE
            [ 32, 1, 14, 'maxInclusive', ], // ELT_MAXINCLUSIVE
            [ 32, 1, 15, 'totalDigits', ], // ELT_TOTALDIGITS
            [ 32, 1, 16, 'fractionDigits', ], // ELT_FRACTIONDIGITS
            [ 32, 1, 17, 'length', ], // ELT_LENGTH
            [ 32, 1, 18, 'minLength', ], // ELT_MINLENGTH
            [ 32, 1, 19, 'maxLength', ], // ELT_MAXLENGTH
            [ 32, 1, 20, 'enumeration', ], // ELT_ENUMERATION
            [ 32, 1, 21, 'whiteSpace', ], // ELT_WHITESPACE
            [ 32, 1, 22, 'pattern', ], // ELT_PATTERN
            [ 32, 1, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 32, 1, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 32, 1, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            [ 32, 2, 11, 'minExclusive', ], // ELT_MINEXCLUSIVE
            [ 32, 2, 12, 'minInclusive', ], // ELT_MININCLUSIVE
            [ 32, 2, 13, 'maxExclusive', ], // ELT_MAXEXCLUSIVE
            [ 32, 2, 14, 'maxInclusive', ], // ELT_MAXINCLUSIVE
            [ 32, 2, 15, 'totalDigits', ], // ELT_TOTALDIGITS
            [ 32, 2, 16, 'fractionDigits', ], // ELT_FRACTIONDIGITS
            [ 32, 2, 17, 'length', ], // ELT_LENGTH
            [ 32, 2, 18, 'minLength', ], // ELT_MINLENGTH
            [ 32, 2, 19, 'maxLength', ], // ELT_MAXLENGTH
            [ 32, 2, 20, 'enumeration', ], // ELT_ENUMERATION
            [ 32, 2, 21, 'whiteSpace', ], // ELT_WHITESPACE
            [ 32, 2, 22, 'pattern', ], // ELT_PATTERN
            [ 32, 2, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 32, 2, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 32, 2, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            [ 32, 3, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 32, 3, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 32, 3, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            // Context: ELT_SIMPLECONTENT_EXTENSION
            [ 33, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 33, 0, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 33, 0, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 33, 0, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            [ 33, 1, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 33, 1, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 33, 1, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            // Context: ELT_COMPLEXCONTENT
            [ 34, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 34, 0, 35, 'restriction', ], // ELT_COMPLEXCONTENT_RESTRICTION
            [ 34, 0, 49, 'extension', ], // ELT_COMPLEXCONTENT_EXTENSION
            [ 34, 1, 35, 'restriction', ], // ELT_COMPLEXCONTENT_RESTRICTION
            [ 34, 1, 49, 'extension', ], // ELT_COMPLEXCONTENT_EXTENSION
            // Context: ELT_COMPLEXCONTENT_RESTRICTION
            [ 35, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 35, 0, 36, 'group', ], // ELT_GROUP_REF
            [ 35, 0, 37, 'all', ], // ELT_ALL
            [ 35, 0, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 35, 0, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 35, 0, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 35, 0, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 35, 0, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            [ 35, 1, 36, 'group', ], // ELT_GROUP_REF
            [ 35, 1, 37, 'all', ], // ELT_ALL
            [ 35, 1, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 35, 1, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 35, 1, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 35, 1, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 35, 1, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            [ 35, 2, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 35, 2, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 35, 2, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            // Context: ELT_GROUP_REF
            [ 36, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_ALL
            [ 37, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 37, 0, 38, 'element', ], // ELT_NARROW_ELEMENT
            [ 37, 1, 38, 'element', ], // ELT_NARROW_ELEMENT
            // Context: ELT_NARROW_ELEMENT
            [ 38, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 38, 0, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            [ 38, 0, 39, 'complexType', ], // ELT_LOCAL_COMPLEXTYPE
            [ 38, 0, 42, 'unique', ], // ELT_UNIQUE
            [ 38, 0, 45, 'key', ], // ELT_KEY
            [ 38, 0, 46, 'keyref', ], // ELT_KEYREF
            [ 38, 1, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            [ 38, 1, 39, 'complexType', ], // ELT_LOCAL_COMPLEXTYPE
            [ 38, 1, 42, 'unique', ], // ELT_UNIQUE
            [ 38, 1, 45, 'key', ], // ELT_KEY
            [ 38, 1, 46, 'keyref', ], // ELT_KEYREF
            [ 38, 2, 42, 'unique', ], // ELT_UNIQUE
            [ 38, 2, 45, 'key', ], // ELT_KEY
            [ 38, 2, 46, 'keyref', ], // ELT_KEYREF
            // Context: ELT_LOCAL_COMPLEXTYPE
            [ 39, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 39, 0, 31, 'simpleContent', ], // ELT_SIMPLECONTENT
            [ 39, 0, 34, 'complexContent', ], // ELT_COMPLEXCONTENT
            [ 39, 0, 36, 'group', ], // ELT_GROUP_REF
            [ 39, 0, 37, 'all', ], // ELT_ALL
            [ 39, 0, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 39, 0, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 39, 0, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 39, 0, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 39, 0, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            [ 39, 1, 31, 'simpleContent', ], // ELT_SIMPLECONTENT
            [ 39, 1, 34, 'complexContent', ], // ELT_COMPLEXCONTENT
            [ 39, 1, 36, 'group', ], // ELT_GROUP_REF
            [ 39, 1, 37, 'all', ], // ELT_ALL
            [ 39, 1, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 39, 1, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 39, 1, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 39, 1, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 39, 1, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            [ 39, 2, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 39, 2, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 39, 2, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            // Context: ELT_EXPLICIT_CHOICE
            [ 40, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 40, 0, 41, 'element', ], // ELT_LOCAL_ELEMENT
            [ 40, 0, 36, 'group', ], // ELT_GROUP_REF
            [ 40, 0, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 40, 0, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 40, 0, 48, 'any', ], // ELT_ANY
            [ 40, 1, 41, 'element', ], // ELT_LOCAL_ELEMENT
            [ 40, 1, 36, 'group', ], // ELT_GROUP_REF
            [ 40, 1, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 40, 1, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 40, 1, 48, 'any', ], // ELT_ANY
            // Context: ELT_LOCAL_ELEMENT
            [ 41, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 41, 0, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            [ 41, 0, 39, 'complexType', ], // ELT_LOCAL_COMPLEXTYPE
            [ 41, 0, 42, 'unique', ], // ELT_UNIQUE
            [ 41, 0, 45, 'key', ], // ELT_KEY
            [ 41, 0, 46, 'keyref', ], // ELT_KEYREF
            [ 41, 1, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            [ 41, 1, 39, 'complexType', ], // ELT_LOCAL_COMPLEXTYPE
            [ 41, 1, 42, 'unique', ], // ELT_UNIQUE
            [ 41, 1, 45, 'key', ], // ELT_KEY
            [ 41, 1, 46, 'keyref', ], // ELT_KEYREF
            [ 41, 2, 42, 'unique', ], // ELT_UNIQUE
            [ 41, 2, 45, 'key', ], // ELT_KEY
            [ 41, 2, 46, 'keyref', ], // ELT_KEYREF
            // Context: ELT_UNIQUE
            [ 42, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 42, 0, 43, 'selector', ], // ELT_SELECTOR
            [ 42, 1, 43, 'selector', ], // ELT_SELECTOR
            [ 42, 2, 44, 'field', ], // ELT_FIELD
            [ 42, 3, 44, 'field', ], // ELT_FIELD
            // Context: ELT_SELECTOR
            [ 43, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_FIELD
            [ 44, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_KEY
            [ 45, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 45, 0, 43, 'selector', ], // ELT_SELECTOR
            [ 45, 1, 43, 'selector', ], // ELT_SELECTOR
            [ 45, 2, 44, 'field', ], // ELT_FIELD
            [ 45, 3, 44, 'field', ], // ELT_FIELD
            // Context: ELT_KEYREF
            [ 46, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 46, 0, 43, 'selector', ], // ELT_SELECTOR
            [ 46, 1, 43, 'selector', ], // ELT_SELECTOR
            [ 46, 2, 44, 'field', ], // ELT_FIELD
            [ 46, 3, 44, 'field', ], // ELT_FIELD
            // Context: ELT_EXPLICIT_SEQUENCE
            [ 47, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 47, 0, 41, 'element', ], // ELT_LOCAL_ELEMENT
            [ 47, 0, 36, 'group', ], // ELT_GROUP_REF
            [ 47, 0, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 47, 0, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 47, 0, 48, 'any', ], // ELT_ANY
            [ 47, 1, 41, 'element', ], // ELT_LOCAL_ELEMENT
            [ 47, 1, 36, 'group', ], // ELT_GROUP_REF
            [ 47, 1, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 47, 1, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 47, 1, 48, 'any', ], // ELT_ANY
            // Context: ELT_ANY
            [ 48, 0, 2, 'annotation', ], // ELT_ANNOTATION
            // Context: ELT_COMPLEXCONTENT_EXTENSION
            [ 49, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 49, 0, 36, 'group', ], // ELT_GROUP_REF
            [ 49, 0, 37, 'all', ], // ELT_ALL
            [ 49, 0, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 49, 0, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 49, 0, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 49, 0, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 49, 0, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            [ 49, 1, 36, 'group', ], // ELT_GROUP_REF
            [ 49, 1, 37, 'all', ], // ELT_ALL
            [ 49, 1, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 49, 1, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 49, 1, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 49, 1, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 49, 1, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            [ 49, 2, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 49, 2, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            [ 49, 2, 29, 'anyAttribute', ], // ELT_ANYATTRIBUTE
            // Context: ELT_NAMED_GROUP
            [ 50, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 50, 0, 51, 'all', ], // ELT_ANONYMOUS_ALL
            [ 50, 0, 52, 'choice', ], // ELT_SIMPLE_CHOICE
            [ 50, 0, 53, 'sequence', ], // ELT_SIMPLE_SEQUENCE
            [ 50, 1, 51, 'all', ], // ELT_ANONYMOUS_ALL
            [ 50, 1, 52, 'choice', ], // ELT_SIMPLE_CHOICE
            [ 50, 1, 53, 'sequence', ], // ELT_SIMPLE_SEQUENCE
            // Context: ELT_ANONYMOUS_ALL
            [ 51, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 51, 0, 38, 'element', ], // ELT_NARROW_ELEMENT
            [ 51, 1, 38, 'element', ], // ELT_NARROW_ELEMENT
            // Context: ELT_SIMPLE_CHOICE
            [ 52, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 52, 0, 41, 'element', ], // ELT_LOCAL_ELEMENT
            [ 52, 0, 36, 'group', ], // ELT_GROUP_REF
            [ 52, 0, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 52, 0, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 52, 0, 48, 'any', ], // ELT_ANY
            [ 52, 1, 41, 'element', ], // ELT_LOCAL_ELEMENT
            [ 52, 1, 36, 'group', ], // ELT_GROUP_REF
            [ 52, 1, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 52, 1, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 52, 1, 48, 'any', ], // ELT_ANY
            // Context: ELT_SIMPLE_SEQUENCE
            [ 53, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 53, 0, 41, 'element', ], // ELT_LOCAL_ELEMENT
            [ 53, 0, 36, 'group', ], // ELT_GROUP_REF
            [ 53, 0, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 53, 0, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 53, 0, 48, 'any', ], // ELT_ANY
            [ 53, 1, 41, 'element', ], // ELT_LOCAL_ELEMENT
            [ 53, 1, 36, 'group', ], // ELT_GROUP_REF
            [ 53, 1, 40, 'choice', ], // ELT_EXPLICIT_CHOICE
            [ 53, 1, 47, 'sequence', ], // ELT_EXPLICIT_SEQUENCE
            [ 53, 1, 48, 'any', ], // ELT_ANY
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
            [ 1, 0, 25, 'buildSimpleTypeElement', ], // ELT_TOP_SIMPLETYPE
            [ 1, 0, 30, 'buildComplexTypeElement', ], // ELT_TOP_COMPLEXTYPE
            [ 1, 0, 50, 'buildGroupElement', ], // ELT_NAMED_GROUP
            [ 1, 0, 26, 'buildAttributeGroupElement', ], // ELT_NAMED_ATTRIBUTEGROUP
            [ 1, 0, 54, 'buildElementElement', ], // ELT_TOP_ELEMENT
            [ 1, 0, 8, 'buildAttributeElement', ], // ELT_TOP_ATTRIBUTE
            [ 1, 0, 7, 'buildNotationElement', ], // ELT_NOTATION
            [ 1, 1, 25, 'buildSimpleTypeElement', ], // ELT_TOP_SIMPLETYPE
            [ 1, 1, 30, 'buildComplexTypeElement', ], // ELT_TOP_COMPLEXTYPE
            [ 1, 1, 50, 'buildGroupElement', ], // ELT_NAMED_GROUP
            [ 1, 1, 26, 'buildAttributeGroupElement', ], // ELT_NAMED_ATTRIBUTEGROUP
            [ 1, 1, 54, 'buildElementElement', ], // ELT_TOP_ELEMENT
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
            [ 9, 0, 23, 'buildListElement', ], // ELT_LIST
            [ 9, 0, 24, 'buildUnionElement', ], // ELT_UNION
            [ 9, 1, 10, 'buildRestrictionElement', ], // ELT_SIMPLETYPE_RESTRICTION
            [ 9, 1, 23, 'buildListElement', ], // ELT_LIST
            [ 9, 1, 24, 'buildUnionElement', ], // ELT_UNION
            // Context: ELT_SIMPLETYPE_RESTRICTION
            [ 10, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 10, 0, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            [ 10, 0, 11, 'buildMinExclusiveElement', ], // ELT_MINEXCLUSIVE
            [ 10, 0, 12, 'buildMinInclusiveElement', ], // ELT_MININCLUSIVE
            [ 10, 0, 13, 'buildMaxExclusiveElement', ], // ELT_MAXEXCLUSIVE
            [ 10, 0, 14, 'buildMaxInclusiveElement', ], // ELT_MAXINCLUSIVE
            [ 10, 0, 15, 'buildTotalDigitsElement', ], // ELT_TOTALDIGITS
            [ 10, 0, 16, 'buildFractionDigitsElement', ], // ELT_FRACTIONDIGITS
            [ 10, 0, 17, 'buildLengthElement', ], // ELT_LENGTH
            [ 10, 0, 18, 'buildMinLengthElement', ], // ELT_MINLENGTH
            [ 10, 0, 19, 'buildMaxLengthElement', ], // ELT_MAXLENGTH
            [ 10, 0, 20, 'buildEnumerationElement', ], // ELT_ENUMERATION
            [ 10, 0, 21, 'buildWhiteSpaceElement', ], // ELT_WHITESPACE
            [ 10, 0, 22, 'buildPatternElement', ], // ELT_PATTERN
            [ 10, 1, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            [ 10, 1, 11, 'buildMinExclusiveElement', ], // ELT_MINEXCLUSIVE
            [ 10, 1, 12, 'buildMinInclusiveElement', ], // ELT_MININCLUSIVE
            [ 10, 1, 13, 'buildMaxExclusiveElement', ], // ELT_MAXEXCLUSIVE
            [ 10, 1, 14, 'buildMaxInclusiveElement', ], // ELT_MAXINCLUSIVE
            [ 10, 1, 15, 'buildTotalDigitsElement', ], // ELT_TOTALDIGITS
            [ 10, 1, 16, 'buildFractionDigitsElement', ], // ELT_FRACTIONDIGITS
            [ 10, 1, 17, 'buildLengthElement', ], // ELT_LENGTH
            [ 10, 1, 18, 'buildMinLengthElement', ], // ELT_MINLENGTH
            [ 10, 1, 19, 'buildMaxLengthElement', ], // ELT_MAXLENGTH
            [ 10, 1, 20, 'buildEnumerationElement', ], // ELT_ENUMERATION
            [ 10, 1, 21, 'buildWhiteSpaceElement', ], // ELT_WHITESPACE
            [ 10, 1, 22, 'buildPatternElement', ], // ELT_PATTERN
            [ 10, 2, 11, 'buildMinExclusiveElement', ], // ELT_MINEXCLUSIVE
            [ 10, 2, 12, 'buildMinInclusiveElement', ], // ELT_MININCLUSIVE
            [ 10, 2, 13, 'buildMaxExclusiveElement', ], // ELT_MAXEXCLUSIVE
            [ 10, 2, 14, 'buildMaxInclusiveElement', ], // ELT_MAXINCLUSIVE
            [ 10, 2, 15, 'buildTotalDigitsElement', ], // ELT_TOTALDIGITS
            [ 10, 2, 16, 'buildFractionDigitsElement', ], // ELT_FRACTIONDIGITS
            [ 10, 2, 17, 'buildLengthElement', ], // ELT_LENGTH
            [ 10, 2, 18, 'buildMinLengthElement', ], // ELT_MINLENGTH
            [ 10, 2, 19, 'buildMaxLengthElement', ], // ELT_MAXLENGTH
            [ 10, 2, 20, 'buildEnumerationElement', ], // ELT_ENUMERATION
            [ 10, 2, 21, 'buildWhiteSpaceElement', ], // ELT_WHITESPACE
            [ 10, 2, 22, 'buildPatternElement', ], // ELT_PATTERN
            // Context: ELT_MINEXCLUSIVE
            [ 11, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_MININCLUSIVE
            [ 12, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_MAXEXCLUSIVE
            [ 13, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_MAXINCLUSIVE
            [ 14, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_TOTALDIGITS
            [ 15, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_FRACTIONDIGITS
            [ 16, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_LENGTH
            [ 17, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_MINLENGTH
            [ 18, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_MAXLENGTH
            [ 19, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_ENUMERATION
            [ 20, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_WHITESPACE
            [ 21, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_PATTERN
            [ 22, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_LIST
            [ 23, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 23, 0, 9, 'buildSimpleTypeElement', ], // ELT_ANNOTATION
            [ 23, 1, 9, 'buildSimpleTypeElement', ], // ELT_ANNOTATION
            // Context: ELT_UNION
            [ 24, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 24, 0, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            [ 24, 1, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            // Context: ELT_TOP_SIMPLETYPE
            [ 25, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 25, 0, 10, 'buildRestrictionElement', ], // ELT_SIMPLETYPE_RESTRICTION
            [ 25, 0, 23, 'buildListElement', ], // ELT_LIST
            [ 25, 0, 24, 'buildUnionElement', ], // ELT_UNION
            [ 25, 1, 10, 'buildRestrictionElement', ], // ELT_SIMPLETYPE_RESTRICTION
            [ 25, 1, 23, 'buildListElement', ], // ELT_LIST
            [ 25, 1, 24, 'buildUnionElement', ], // ELT_UNION
            // Context: ELT_NAMED_ATTRIBUTEGROUP
            [ 26, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 26, 0, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 26, 0, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 26, 0, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            [ 26, 1, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 26, 1, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 26, 1, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            // Context: ELT_ATTRIBUTE
            [ 27, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 27, 0, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            [ 27, 1, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            // Context: ELT_ATTRIBUTEGROUP_REF
            [ 28, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_ANYATTRIBUTE
            [ 29, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_TOP_COMPLEXTYPE
            [ 30, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 30, 0, 31, 'buildSimpleContentElement', ], // ELT_SIMPLECONTENT
            [ 30, 0, 34, 'buildComplexContentElement', ], // ELT_COMPLEXCONTENT
            [ 30, 0, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 30, 0, 37, 'buildAllElement', ], // ELT_ALL
            [ 30, 0, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 30, 0, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 30, 0, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 30, 0, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 30, 0, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            [ 30, 1, 31, 'buildSimpleContentElement', ], // ELT_SIMPLECONTENT
            [ 30, 1, 34, 'buildComplexContentElement', ], // ELT_COMPLEXCONTENT
            [ 30, 1, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 30, 1, 37, 'buildAllElement', ], // ELT_ALL
            [ 30, 1, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 30, 1, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 30, 1, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 30, 1, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 30, 1, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            [ 30, 2, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 30, 2, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 30, 2, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            // Context: ELT_SIMPLECONTENT
            [ 31, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 31, 0, 32, 'buildRestrictionElement', ], // ELT_SIMPLECONTENT_RESTRICTION
            [ 31, 0, 33, 'buildExtensionElement', ], // ELT_SIMPLECONTENT_EXTENSION
            [ 31, 1, 32, 'buildRestrictionElement', ], // ELT_SIMPLECONTENT_RESTRICTION
            [ 31, 1, 33, 'buildExtensionElement', ], // ELT_SIMPLECONTENT_EXTENSION
            // Context: ELT_SIMPLECONTENT_RESTRICTION
            [ 32, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 32, 0, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            [ 32, 0, 11, 'buildMinExclusiveElement', ], // ELT_MINEXCLUSIVE
            [ 32, 0, 12, 'buildMinInclusiveElement', ], // ELT_MININCLUSIVE
            [ 32, 0, 13, 'buildMaxExclusiveElement', ], // ELT_MAXEXCLUSIVE
            [ 32, 0, 14, 'buildMaxInclusiveElement', ], // ELT_MAXINCLUSIVE
            [ 32, 0, 15, 'buildTotalDigitsElement', ], // ELT_TOTALDIGITS
            [ 32, 0, 16, 'buildFractionDigitsElement', ], // ELT_FRACTIONDIGITS
            [ 32, 0, 17, 'buildLengthElement', ], // ELT_LENGTH
            [ 32, 0, 18, 'buildMinLengthElement', ], // ELT_MINLENGTH
            [ 32, 0, 19, 'buildMaxLengthElement', ], // ELT_MAXLENGTH
            [ 32, 0, 20, 'buildEnumerationElement', ], // ELT_ENUMERATION
            [ 32, 0, 21, 'buildWhiteSpaceElement', ], // ELT_WHITESPACE
            [ 32, 0, 22, 'buildPatternElement', ], // ELT_PATTERN
            [ 32, 0, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 32, 0, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 32, 0, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            [ 32, 1, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            [ 32, 1, 11, 'buildMinExclusiveElement', ], // ELT_MINEXCLUSIVE
            [ 32, 1, 12, 'buildMinInclusiveElement', ], // ELT_MININCLUSIVE
            [ 32, 1, 13, 'buildMaxExclusiveElement', ], // ELT_MAXEXCLUSIVE
            [ 32, 1, 14, 'buildMaxInclusiveElement', ], // ELT_MAXINCLUSIVE
            [ 32, 1, 15, 'buildTotalDigitsElement', ], // ELT_TOTALDIGITS
            [ 32, 1, 16, 'buildFractionDigitsElement', ], // ELT_FRACTIONDIGITS
            [ 32, 1, 17, 'buildLengthElement', ], // ELT_LENGTH
            [ 32, 1, 18, 'buildMinLengthElement', ], // ELT_MINLENGTH
            [ 32, 1, 19, 'buildMaxLengthElement', ], // ELT_MAXLENGTH
            [ 32, 1, 20, 'buildEnumerationElement', ], // ELT_ENUMERATION
            [ 32, 1, 21, 'buildWhiteSpaceElement', ], // ELT_WHITESPACE
            [ 32, 1, 22, 'buildPatternElement', ], // ELT_PATTERN
            [ 32, 1, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 32, 1, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 32, 1, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            [ 32, 2, 11, 'buildMinExclusiveElement', ], // ELT_MINEXCLUSIVE
            [ 32, 2, 12, 'buildMinInclusiveElement', ], // ELT_MININCLUSIVE
            [ 32, 2, 13, 'buildMaxExclusiveElement', ], // ELT_MAXEXCLUSIVE
            [ 32, 2, 14, 'buildMaxInclusiveElement', ], // ELT_MAXINCLUSIVE
            [ 32, 2, 15, 'buildTotalDigitsElement', ], // ELT_TOTALDIGITS
            [ 32, 2, 16, 'buildFractionDigitsElement', ], // ELT_FRACTIONDIGITS
            [ 32, 2, 17, 'buildLengthElement', ], // ELT_LENGTH
            [ 32, 2, 18, 'buildMinLengthElement', ], // ELT_MINLENGTH
            [ 32, 2, 19, 'buildMaxLengthElement', ], // ELT_MAXLENGTH
            [ 32, 2, 20, 'buildEnumerationElement', ], // ELT_ENUMERATION
            [ 32, 2, 21, 'buildWhiteSpaceElement', ], // ELT_WHITESPACE
            [ 32, 2, 22, 'buildPatternElement', ], // ELT_PATTERN
            [ 32, 2, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 32, 2, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 32, 2, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            [ 32, 3, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 32, 3, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 32, 3, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            // Context: ELT_SIMPLECONTENT_EXTENSION
            [ 33, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 33, 0, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 33, 0, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 33, 0, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            [ 33, 1, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 33, 1, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 33, 1, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            // Context: ELT_COMPLEXCONTENT
            [ 34, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 34, 0, 35, 'buildRestrictionElement', ], // ELT_COMPLEXCONTENT_RESTRICTION
            [ 34, 0, 49, 'buildExtensionElement', ], // ELT_COMPLEXCONTENT_EXTENSION
            [ 34, 1, 35, 'buildRestrictionElement', ], // ELT_COMPLEXCONTENT_RESTRICTION
            [ 34, 1, 49, 'buildExtensionElement', ], // ELT_COMPLEXCONTENT_EXTENSION
            // Context: ELT_COMPLEXCONTENT_RESTRICTION
            [ 35, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 35, 0, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 35, 0, 37, 'buildAllElement', ], // ELT_ALL
            [ 35, 0, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 35, 0, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 35, 0, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 35, 0, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 35, 0, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            [ 35, 1, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 35, 1, 37, 'buildAllElement', ], // ELT_ALL
            [ 35, 1, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 35, 1, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 35, 1, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 35, 1, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 35, 1, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            [ 35, 2, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 35, 2, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 35, 2, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            // Context: ELT_GROUP_REF
            [ 36, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_ALL
            [ 37, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 37, 0, 38, 'buildElementElement', ], // ELT_NARROW_ELEMENT
            [ 37, 1, 38, 'buildElementElement', ], // ELT_NARROW_ELEMENT
            // Context: ELT_NARROW_ELEMENT
            [ 38, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 38, 0, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            [ 38, 0, 39, 'buildComplexTypeElement', ], // ELT_LOCAL_COMPLEXTYPE
            [ 38, 0, 42, 'buildUniqueElement', ], // ELT_UNIQUE
            [ 38, 0, 45, 'buildKeyElement', ], // ELT_KEY
            [ 38, 0, 46, 'buildKeyRefElement', ], // ELT_KEYREF
            [ 38, 1, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            [ 38, 1, 39, 'buildComplexTypeElement', ], // ELT_LOCAL_COMPLEXTYPE
            [ 38, 1, 42, 'buildUniqueElement', ], // ELT_UNIQUE
            [ 38, 1, 45, 'buildKeyElement', ], // ELT_KEY
            [ 38, 1, 46, 'buildKeyRefElement', ], // ELT_KEYREF
            [ 38, 2, 42, 'buildUniqueElement', ], // ELT_UNIQUE
            [ 38, 2, 45, 'buildKeyElement', ], // ELT_KEY
            [ 38, 2, 46, 'buildKeyRefElement', ], // ELT_KEYREF
            // Context: ELT_LOCAL_COMPLEXTYPE
            [ 39, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 39, 0, 31, 'buildSimpleContentElement', ], // ELT_SIMPLECONTENT
            [ 39, 0, 34, 'buildComplexContentElement', ], // ELT_COMPLEXCONTENT
            [ 39, 0, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 39, 0, 37, 'buildAllElement', ], // ELT_ALL
            [ 39, 0, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 39, 0, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 39, 0, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 39, 0, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 39, 0, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            [ 39, 1, 31, 'buildSimpleContentElement', ], // ELT_SIMPLECONTENT
            [ 39, 1, 34, 'buildComplexContentElement', ], // ELT_COMPLEXCONTENT
            [ 39, 1, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 39, 1, 37, 'buildAllElement', ], // ELT_ALL
            [ 39, 1, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 39, 1, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 39, 1, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 39, 1, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 39, 1, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            [ 39, 2, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 39, 2, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 39, 2, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            // Context: ELT_EXPLICIT_CHOICE
            [ 40, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 40, 0, 41, 'buildElementElement', ], // ELT_LOCAL_ELEMENT
            [ 40, 0, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 40, 0, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 40, 0, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 40, 0, 48, 'buildAnyElement', ], // ELT_ANY
            [ 40, 1, 41, 'buildElementElement', ], // ELT_LOCAL_ELEMENT
            [ 40, 1, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 40, 1, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 40, 1, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 40, 1, 48, 'buildAnyElement', ], // ELT_ANY
            // Context: ELT_LOCAL_ELEMENT
            [ 41, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 41, 0, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            [ 41, 0, 39, 'buildComplexTypeElement', ], // ELT_LOCAL_COMPLEXTYPE
            [ 41, 0, 42, 'buildUniqueElement', ], // ELT_UNIQUE
            [ 41, 0, 45, 'buildKeyElement', ], // ELT_KEY
            [ 41, 0, 46, 'buildKeyRefElement', ], // ELT_KEYREF
            [ 41, 1, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            [ 41, 1, 39, 'buildComplexTypeElement', ], // ELT_LOCAL_COMPLEXTYPE
            [ 41, 1, 42, 'buildUniqueElement', ], // ELT_UNIQUE
            [ 41, 1, 45, 'buildKeyElement', ], // ELT_KEY
            [ 41, 1, 46, 'buildKeyRefElement', ], // ELT_KEYREF
            [ 41, 2, 42, 'buildUniqueElement', ], // ELT_UNIQUE
            [ 41, 2, 45, 'buildKeyElement', ], // ELT_KEY
            [ 41, 2, 46, 'buildKeyRefElement', ], // ELT_KEYREF
            // Context: ELT_UNIQUE
            [ 42, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 42, 0, 43, 'buildSelectorElement', ], // ELT_SELECTOR
            [ 42, 1, 43, 'buildSelectorElement', ], // ELT_SELECTOR
            [ 42, 2, 44, 'buildFieldElement', ], // ELT_FIELD
            [ 42, 3, 44, 'buildFieldElement', ], // ELT_FIELD
            // Context: ELT_SELECTOR
            [ 43, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_FIELD
            [ 44, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_KEY
            [ 45, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 45, 0, 43, 'buildSelectorElement', ], // ELT_SELECTOR
            [ 45, 1, 43, 'buildSelectorElement', ], // ELT_SELECTOR
            [ 45, 2, 44, 'buildFieldElement', ], // ELT_FIELD
            [ 45, 3, 44, 'buildFieldElement', ], // ELT_FIELD
            // Context: ELT_KEYREF
            [ 46, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 46, 0, 43, 'buildSelectorElement', ], // ELT_SELECTOR
            [ 46, 1, 43, 'buildSelectorElement', ], // ELT_SELECTOR
            [ 46, 2, 44, 'buildFieldElement', ], // ELT_FIELD
            [ 46, 3, 44, 'buildFieldElement', ], // ELT_FIELD
            // Context: ELT_EXPLICIT_SEQUENCE
            [ 47, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 47, 0, 41, 'buildElementElement', ], // ELT_LOCAL_ELEMENT
            [ 47, 0, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 47, 0, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 47, 0, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 47, 0, 48, 'buildAnyElement', ], // ELT_ANY
            [ 47, 1, 41, 'buildElementElement', ], // ELT_LOCAL_ELEMENT
            [ 47, 1, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 47, 1, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 47, 1, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 47, 1, 48, 'buildAnyElement', ], // ELT_ANY
            // Context: ELT_ANY
            [ 48, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            // Context: ELT_COMPLEXCONTENT_EXTENSION
            [ 49, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 49, 0, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 49, 0, 37, 'buildAllElement', ], // ELT_ALL
            [ 49, 0, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 49, 0, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 49, 0, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 49, 0, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 49, 0, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            [ 49, 1, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 49, 1, 37, 'buildAllElement', ], // ELT_ALL
            [ 49, 1, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 49, 1, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 49, 1, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 49, 1, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 49, 1, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            [ 49, 2, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 49, 2, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            [ 49, 2, 29, 'buildAnyAttributeElement', ], // ELT_ANYATTRIBUTE
            // Context: ELT_NAMED_GROUP
            [ 50, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 50, 0, 51, 'buildAllElement', ], // ELT_ANONYMOUS_ALL
            [ 50, 0, 52, 'buildChoiceElement', ], // ELT_SIMPLE_CHOICE
            [ 50, 0, 53, 'buildSequenceElement', ], // ELT_SIMPLE_SEQUENCE
            [ 50, 1, 51, 'buildAllElement', ], // ELT_ANONYMOUS_ALL
            [ 50, 1, 52, 'buildChoiceElement', ], // ELT_SIMPLE_CHOICE
            [ 50, 1, 53, 'buildSequenceElement', ], // ELT_SIMPLE_SEQUENCE
            // Context: ELT_ANONYMOUS_ALL
            [ 51, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 51, 0, 38, 'buildElementElement', ], // ELT_NARROW_ELEMENT
            [ 51, 1, 38, 'buildElementElement', ], // ELT_NARROW_ELEMENT
            // Context: ELT_SIMPLE_CHOICE
            [ 52, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 52, 0, 41, 'buildElementElement', ], // ELT_LOCAL_ELEMENT
            [ 52, 0, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 52, 0, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 52, 0, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 52, 0, 48, 'buildAnyElement', ], // ELT_ANY
            [ 52, 1, 41, 'buildElementElement', ], // ELT_LOCAL_ELEMENT
            [ 52, 1, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 52, 1, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 52, 1, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 52, 1, 48, 'buildAnyElement', ], // ELT_ANY
            // Context: ELT_SIMPLE_SEQUENCE
            [ 53, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 53, 0, 41, 'buildElementElement', ], // ELT_LOCAL_ELEMENT
            [ 53, 0, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 53, 0, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 53, 0, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 53, 0, 48, 'buildAnyElement', ], // ELT_ANY
            [ 53, 1, 41, 'buildElementElement', ], // ELT_LOCAL_ELEMENT
            [ 53, 1, 36, 'buildGroupElement', ], // ELT_GROUP_REF
            [ 53, 1, 40, 'buildChoiceElement', ], // ELT_EXPLICIT_CHOICE
            [ 53, 1, 47, 'buildSequenceElement', ], // ELT_EXPLICIT_SEQUENCE
            [ 53, 1, 48, 'buildAnyElement', ], // ELT_ANY
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
            [ 1, 0, 25, 1, ], // ELT_TOP_SIMPLETYPE
            [ 1, 0, 30, 1, ], // ELT_TOP_COMPLEXTYPE
            [ 1, 0, 50, 1, ], // ELT_NAMED_GROUP
            [ 1, 0, 26, 1, ], // ELT_NAMED_ATTRIBUTEGROUP
            [ 1, 0, 54, 1, ], // ELT_TOP_ELEMENT
            [ 1, 0, 8, 1, ], // ELT_TOP_ATTRIBUTE
            [ 1, 0, 7, 1, ], // ELT_NOTATION
            [ 1, 1, 25, 1, ], // ELT_TOP_SIMPLETYPE
            [ 1, 1, 30, 1, ], // ELT_TOP_COMPLEXTYPE
            [ 1, 1, 50, 1, ], // ELT_NAMED_GROUP
            [ 1, 1, 26, 1, ], // ELT_NAMED_ATTRIBUTEGROUP
            [ 1, 1, 54, 1, ], // ELT_TOP_ELEMENT
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
            [ 9, 0, 23, 2, ], // ELT_LIST
            [ 9, 0, 24, 2, ], // ELT_UNION
            [ 9, 1, 10, 2, ], // ELT_SIMPLETYPE_RESTRICTION
            [ 9, 1, 23, 2, ], // ELT_LIST
            [ 9, 1, 24, 2, ], // ELT_UNION
            // Context: ELT_SIMPLETYPE_RESTRICTION
            [ 10, 0, 2, 1, ], // ELT_ANNOTATION
            [ 10, 0, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            [ 10, 0, 11, 2, ], // ELT_MINEXCLUSIVE
            [ 10, 0, 12, 2, ], // ELT_MININCLUSIVE
            [ 10, 0, 13, 2, ], // ELT_MAXEXCLUSIVE
            [ 10, 0, 14, 2, ], // ELT_MAXINCLUSIVE
            [ 10, 0, 15, 2, ], // ELT_TOTALDIGITS
            [ 10, 0, 16, 2, ], // ELT_FRACTIONDIGITS
            [ 10, 0, 17, 2, ], // ELT_LENGTH
            [ 10, 0, 18, 2, ], // ELT_MINLENGTH
            [ 10, 0, 19, 2, ], // ELT_MAXLENGTH
            [ 10, 0, 20, 2, ], // ELT_ENUMERATION
            [ 10, 0, 21, 2, ], // ELT_WHITESPACE
            [ 10, 0, 22, 2, ], // ELT_PATTERN
            [ 10, 1, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            [ 10, 1, 11, 2, ], // ELT_MINEXCLUSIVE
            [ 10, 1, 12, 2, ], // ELT_MININCLUSIVE
            [ 10, 1, 13, 2, ], // ELT_MAXEXCLUSIVE
            [ 10, 1, 14, 2, ], // ELT_MAXINCLUSIVE
            [ 10, 1, 15, 2, ], // ELT_TOTALDIGITS
            [ 10, 1, 16, 2, ], // ELT_FRACTIONDIGITS
            [ 10, 1, 17, 2, ], // ELT_LENGTH
            [ 10, 1, 18, 2, ], // ELT_MINLENGTH
            [ 10, 1, 19, 2, ], // ELT_MAXLENGTH
            [ 10, 1, 20, 2, ], // ELT_ENUMERATION
            [ 10, 1, 21, 2, ], // ELT_WHITESPACE
            [ 10, 1, 22, 2, ], // ELT_PATTERN
            [ 10, 2, 11, 2, ], // ELT_MINEXCLUSIVE
            [ 10, 2, 12, 2, ], // ELT_MININCLUSIVE
            [ 10, 2, 13, 2, ], // ELT_MAXEXCLUSIVE
            [ 10, 2, 14, 2, ], // ELT_MAXINCLUSIVE
            [ 10, 2, 15, 2, ], // ELT_TOTALDIGITS
            [ 10, 2, 16, 2, ], // ELT_FRACTIONDIGITS
            [ 10, 2, 17, 2, ], // ELT_LENGTH
            [ 10, 2, 18, 2, ], // ELT_MINLENGTH
            [ 10, 2, 19, 2, ], // ELT_MAXLENGTH
            [ 10, 2, 20, 2, ], // ELT_ENUMERATION
            [ 10, 2, 21, 2, ], // ELT_WHITESPACE
            [ 10, 2, 22, 2, ], // ELT_PATTERN
            // Context: ELT_MINEXCLUSIVE
            [ 11, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_MININCLUSIVE
            [ 12, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_MAXEXCLUSIVE
            [ 13, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_MAXINCLUSIVE
            [ 14, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_TOTALDIGITS
            [ 15, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_FRACTIONDIGITS
            [ 16, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_LENGTH
            [ 17, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_MINLENGTH
            [ 18, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_MAXLENGTH
            [ 19, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_ENUMERATION
            [ 20, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_WHITESPACE
            [ 21, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_PATTERN
            [ 22, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_LIST
            [ 23, 0, 2, 1, ], // ELT_ANNOTATION
            [ 23, 0, 9, 2, ], // ELT_ANNOTATION
            [ 23, 1, 9, 2, ], // ELT_ANNOTATION
            // Context: ELT_UNION
            [ 24, 0, 2, 1, ], // ELT_ANNOTATION
            [ 24, 0, 9, 1, ], // ELT_LOCAL_SIMPLETYPE
            [ 24, 1, 9, 1, ], // ELT_LOCAL_SIMPLETYPE
            // Context: ELT_TOP_SIMPLETYPE
            [ 25, 0, 2, 1, ], // ELT_ANNOTATION
            [ 25, 0, 10, 2, ], // ELT_SIMPLETYPE_RESTRICTION
            [ 25, 0, 23, 2, ], // ELT_LIST
            [ 25, 0, 24, 2, ], // ELT_UNION
            [ 25, 1, 10, 2, ], // ELT_SIMPLETYPE_RESTRICTION
            [ 25, 1, 23, 2, ], // ELT_LIST
            [ 25, 1, 24, 2, ], // ELT_UNION
            // Context: ELT_NAMED_ATTRIBUTEGROUP
            [ 26, 0, 2, 1, ], // ELT_ANNOTATION
            [ 26, 0, 27, 1, ], // ELT_ATTRIBUTE
            [ 26, 0, 28, 1, ], // ELT_ATTRIBUTEGROUP_REF
            [ 26, 0, 29, 2, ], // ELT_ANYATTRIBUTE
            [ 26, 1, 27, 1, ], // ELT_ATTRIBUTE
            [ 26, 1, 28, 1, ], // ELT_ATTRIBUTEGROUP_REF
            [ 26, 1, 29, 2, ], // ELT_ANYATTRIBUTE
            // Context: ELT_ATTRIBUTE
            [ 27, 0, 2, 1, ], // ELT_ANNOTATION
            [ 27, 0, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            [ 27, 1, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            // Context: ELT_ATTRIBUTEGROUP_REF
            [ 28, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_ANYATTRIBUTE
            [ 29, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_TOP_COMPLEXTYPE
            [ 30, 0, 2, 1, ], // ELT_ANNOTATION
            [ 30, 0, 31, 3, ], // ELT_SIMPLECONTENT
            [ 30, 0, 34, 3, ], // ELT_COMPLEXCONTENT
            [ 30, 0, 36, 2, ], // ELT_GROUP_REF
            [ 30, 0, 37, 2, ], // ELT_ALL
            [ 30, 0, 40, 2, ], // ELT_EXPLICIT_CHOICE
            [ 30, 0, 47, 2, ], // ELT_EXPLICIT_SEQUENCE
            [ 30, 0, 27, 2, ], // ELT_ATTRIBUTE
            [ 30, 0, 28, 2, ], // ELT_ATTRIBUTEGROUP_REF
            [ 30, 0, 29, 3, ], // ELT_ANYATTRIBUTE
            [ 30, 1, 31, 3, ], // ELT_SIMPLECONTENT
            [ 30, 1, 34, 3, ], // ELT_COMPLEXCONTENT
            [ 30, 1, 36, 2, ], // ELT_GROUP_REF
            [ 30, 1, 37, 2, ], // ELT_ALL
            [ 30, 1, 40, 2, ], // ELT_EXPLICIT_CHOICE
            [ 30, 1, 47, 2, ], // ELT_EXPLICIT_SEQUENCE
            [ 30, 1, 27, 2, ], // ELT_ATTRIBUTE
            [ 30, 1, 28, 2, ], // ELT_ATTRIBUTEGROUP_REF
            [ 30, 1, 29, 3, ], // ELT_ANYATTRIBUTE
            [ 30, 2, 27, 2, ], // ELT_ATTRIBUTE
            [ 30, 2, 28, 2, ], // ELT_ATTRIBUTEGROUP_REF
            [ 30, 2, 29, 3, ], // ELT_ANYATTRIBUTE
            // Context: ELT_SIMPLECONTENT
            [ 31, 0, 2, 1, ], // ELT_ANNOTATION
            [ 31, 0, 32, 2, ], // ELT_SIMPLECONTENT_RESTRICTION
            [ 31, 0, 33, 2, ], // ELT_SIMPLECONTENT_EXTENSION
            [ 31, 1, 32, 2, ], // ELT_SIMPLECONTENT_RESTRICTION
            [ 31, 1, 33, 2, ], // ELT_SIMPLECONTENT_EXTENSION
            // Context: ELT_SIMPLECONTENT_RESTRICTION
            [ 32, 0, 2, 1, ], // ELT_ANNOTATION
            [ 32, 0, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            [ 32, 0, 11, 2, ], // ELT_MINEXCLUSIVE
            [ 32, 0, 12, 2, ], // ELT_MININCLUSIVE
            [ 32, 0, 13, 2, ], // ELT_MAXEXCLUSIVE
            [ 32, 0, 14, 2, ], // ELT_MAXINCLUSIVE
            [ 32, 0, 15, 2, ], // ELT_TOTALDIGITS
            [ 32, 0, 16, 2, ], // ELT_FRACTIONDIGITS
            [ 32, 0, 17, 2, ], // ELT_LENGTH
            [ 32, 0, 18, 2, ], // ELT_MINLENGTH
            [ 32, 0, 19, 2, ], // ELT_MAXLENGTH
            [ 32, 0, 20, 2, ], // ELT_ENUMERATION
            [ 32, 0, 21, 2, ], // ELT_WHITESPACE
            [ 32, 0, 22, 2, ], // ELT_PATTERN
            [ 32, 0, 27, 3, ], // ELT_ATTRIBUTE
            [ 32, 0, 28, 3, ], // ELT_ATTRIBUTEGROUP_REF
            [ 32, 0, 29, 4, ], // ELT_ANYATTRIBUTE
            [ 32, 1, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            [ 32, 1, 11, 2, ], // ELT_MINEXCLUSIVE
            [ 32, 1, 12, 2, ], // ELT_MININCLUSIVE
            [ 32, 1, 13, 2, ], // ELT_MAXEXCLUSIVE
            [ 32, 1, 14, 2, ], // ELT_MAXINCLUSIVE
            [ 32, 1, 15, 2, ], // ELT_TOTALDIGITS
            [ 32, 1, 16, 2, ], // ELT_FRACTIONDIGITS
            [ 32, 1, 17, 2, ], // ELT_LENGTH
            [ 32, 1, 18, 2, ], // ELT_MINLENGTH
            [ 32, 1, 19, 2, ], // ELT_MAXLENGTH
            [ 32, 1, 20, 2, ], // ELT_ENUMERATION
            [ 32, 1, 21, 2, ], // ELT_WHITESPACE
            [ 32, 1, 22, 2, ], // ELT_PATTERN
            [ 32, 1, 27, 3, ], // ELT_ATTRIBUTE
            [ 32, 1, 28, 3, ], // ELT_ATTRIBUTEGROUP_REF
            [ 32, 1, 29, 4, ], // ELT_ANYATTRIBUTE
            [ 32, 2, 11, 2, ], // ELT_MINEXCLUSIVE
            [ 32, 2, 12, 2, ], // ELT_MININCLUSIVE
            [ 32, 2, 13, 2, ], // ELT_MAXEXCLUSIVE
            [ 32, 2, 14, 2, ], // ELT_MAXINCLUSIVE
            [ 32, 2, 15, 2, ], // ELT_TOTALDIGITS
            [ 32, 2, 16, 2, ], // ELT_FRACTIONDIGITS
            [ 32, 2, 17, 2, ], // ELT_LENGTH
            [ 32, 2, 18, 2, ], // ELT_MINLENGTH
            [ 32, 2, 19, 2, ], // ELT_MAXLENGTH
            [ 32, 2, 20, 2, ], // ELT_ENUMERATION
            [ 32, 2, 21, 2, ], // ELT_WHITESPACE
            [ 32, 2, 22, 2, ], // ELT_PATTERN
            [ 32, 2, 27, 3, ], // ELT_ATTRIBUTE
            [ 32, 2, 28, 3, ], // ELT_ATTRIBUTEGROUP_REF
            [ 32, 2, 29, 4, ], // ELT_ANYATTRIBUTE
            [ 32, 3, 27, 3, ], // ELT_ATTRIBUTE
            [ 32, 3, 28, 3, ], // ELT_ATTRIBUTEGROUP_REF
            [ 32, 3, 29, 4, ], // ELT_ANYATTRIBUTE
            // Context: ELT_SIMPLECONTENT_EXTENSION
            [ 33, 0, 2, 1, ], // ELT_ANNOTATION
            [ 33, 0, 27, 1, ], // ELT_ATTRIBUTE
            [ 33, 0, 28, 1, ], // ELT_ATTRIBUTEGROUP_REF
            [ 33, 0, 29, 2, ], // ELT_ANYATTRIBUTE
            [ 33, 1, 27, 1, ], // ELT_ATTRIBUTE
            [ 33, 1, 28, 1, ], // ELT_ATTRIBUTEGROUP_REF
            [ 33, 1, 29, 2, ], // ELT_ANYATTRIBUTE
            // Context: ELT_COMPLEXCONTENT
            [ 34, 0, 2, 1, ], // ELT_ANNOTATION
            [ 34, 0, 35, 2, ], // ELT_COMPLEXCONTENT_RESTRICTION
            [ 34, 0, 49, 2, ], // ELT_COMPLEXCONTENT_EXTENSION
            [ 34, 1, 35, 2, ], // ELT_COMPLEXCONTENT_RESTRICTION
            [ 34, 1, 49, 2, ], // ELT_COMPLEXCONTENT_EXTENSION
            // Context: ELT_COMPLEXCONTENT_RESTRICTION
            [ 35, 0, 2, 1, ], // ELT_ANNOTATION
            [ 35, 0, 36, 2, ], // ELT_GROUP_REF
            [ 35, 0, 37, 2, ], // ELT_ALL
            [ 35, 0, 40, 2, ], // ELT_EXPLICIT_CHOICE
            [ 35, 0, 47, 2, ], // ELT_EXPLICIT_SEQUENCE
            [ 35, 0, 27, 2, ], // ELT_ATTRIBUTE
            [ 35, 0, 28, 2, ], // ELT_ATTRIBUTEGROUP_REF
            [ 35, 0, 29, 3, ], // ELT_ANYATTRIBUTE
            [ 35, 1, 36, 2, ], // ELT_GROUP_REF
            [ 35, 1, 37, 2, ], // ELT_ALL
            [ 35, 1, 40, 2, ], // ELT_EXPLICIT_CHOICE
            [ 35, 1, 47, 2, ], // ELT_EXPLICIT_SEQUENCE
            [ 35, 1, 27, 2, ], // ELT_ATTRIBUTE
            [ 35, 1, 28, 2, ], // ELT_ATTRIBUTEGROUP_REF
            [ 35, 1, 29, 3, ], // ELT_ANYATTRIBUTE
            [ 35, 2, 27, 2, ], // ELT_ATTRIBUTE
            [ 35, 2, 28, 2, ], // ELT_ATTRIBUTEGROUP_REF
            [ 35, 2, 29, 3, ], // ELT_ANYATTRIBUTE
            // Context: ELT_GROUP_REF
            [ 36, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_ALL
            [ 37, 0, 2, 1, ], // ELT_ANNOTATION
            [ 37, 0, 38, 1, ], // ELT_NARROW_ELEMENT
            [ 37, 1, 38, 1, ], // ELT_NARROW_ELEMENT
            // Context: ELT_NARROW_ELEMENT
            [ 38, 0, 2, 1, ], // ELT_ANNOTATION
            [ 38, 0, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            [ 38, 0, 39, 2, ], // ELT_LOCAL_COMPLEXTYPE
            [ 38, 0, 42, 2, ], // ELT_UNIQUE
            [ 38, 0, 45, 2, ], // ELT_KEY
            [ 38, 0, 46, 2, ], // ELT_KEYREF
            [ 38, 1, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            [ 38, 1, 39, 2, ], // ELT_LOCAL_COMPLEXTYPE
            [ 38, 1, 42, 2, ], // ELT_UNIQUE
            [ 38, 1, 45, 2, ], // ELT_KEY
            [ 38, 1, 46, 2, ], // ELT_KEYREF
            [ 38, 2, 42, 2, ], // ELT_UNIQUE
            [ 38, 2, 45, 2, ], // ELT_KEY
            [ 38, 2, 46, 2, ], // ELT_KEYREF
            // Context: ELT_LOCAL_COMPLEXTYPE
            [ 39, 0, 2, 1, ], // ELT_ANNOTATION
            [ 39, 0, 31, 3, ], // ELT_SIMPLECONTENT
            [ 39, 0, 34, 3, ], // ELT_COMPLEXCONTENT
            [ 39, 0, 36, 2, ], // ELT_GROUP_REF
            [ 39, 0, 37, 2, ], // ELT_ALL
            [ 39, 0, 40, 2, ], // ELT_EXPLICIT_CHOICE
            [ 39, 0, 47, 2, ], // ELT_EXPLICIT_SEQUENCE
            [ 39, 0, 27, 2, ], // ELT_ATTRIBUTE
            [ 39, 0, 28, 2, ], // ELT_ATTRIBUTEGROUP_REF
            [ 39, 0, 29, 3, ], // ELT_ANYATTRIBUTE
            [ 39, 1, 31, 3, ], // ELT_SIMPLECONTENT
            [ 39, 1, 34, 3, ], // ELT_COMPLEXCONTENT
            [ 39, 1, 36, 2, ], // ELT_GROUP_REF
            [ 39, 1, 37, 2, ], // ELT_ALL
            [ 39, 1, 40, 2, ], // ELT_EXPLICIT_CHOICE
            [ 39, 1, 47, 2, ], // ELT_EXPLICIT_SEQUENCE
            [ 39, 1, 27, 2, ], // ELT_ATTRIBUTE
            [ 39, 1, 28, 2, ], // ELT_ATTRIBUTEGROUP_REF
            [ 39, 1, 29, 3, ], // ELT_ANYATTRIBUTE
            [ 39, 2, 27, 2, ], // ELT_ATTRIBUTE
            [ 39, 2, 28, 2, ], // ELT_ATTRIBUTEGROUP_REF
            [ 39, 2, 29, 3, ], // ELT_ANYATTRIBUTE
            // Context: ELT_EXPLICIT_CHOICE
            [ 40, 0, 2, 1, ], // ELT_ANNOTATION
            [ 40, 0, 41, 1, ], // ELT_LOCAL_ELEMENT
            [ 40, 0, 36, 1, ], // ELT_GROUP_REF
            [ 40, 0, 40, 1, ], // ELT_EXPLICIT_CHOICE
            [ 40, 0, 47, 1, ], // ELT_EXPLICIT_SEQUENCE
            [ 40, 0, 48, 1, ], // ELT_ANY
            [ 40, 1, 41, 1, ], // ELT_LOCAL_ELEMENT
            [ 40, 1, 36, 1, ], // ELT_GROUP_REF
            [ 40, 1, 40, 1, ], // ELT_EXPLICIT_CHOICE
            [ 40, 1, 47, 1, ], // ELT_EXPLICIT_SEQUENCE
            [ 40, 1, 48, 1, ], // ELT_ANY
            // Context: ELT_LOCAL_ELEMENT
            [ 41, 0, 2, 1, ], // ELT_ANNOTATION
            [ 41, 0, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            [ 41, 0, 39, 2, ], // ELT_LOCAL_COMPLEXTYPE
            [ 41, 0, 42, 2, ], // ELT_UNIQUE
            [ 41, 0, 45, 2, ], // ELT_KEY
            [ 41, 0, 46, 2, ], // ELT_KEYREF
            [ 41, 1, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            [ 41, 1, 39, 2, ], // ELT_LOCAL_COMPLEXTYPE
            [ 41, 1, 42, 2, ], // ELT_UNIQUE
            [ 41, 1, 45, 2, ], // ELT_KEY
            [ 41, 1, 46, 2, ], // ELT_KEYREF
            [ 41, 2, 42, 2, ], // ELT_UNIQUE
            [ 41, 2, 45, 2, ], // ELT_KEY
            [ 41, 2, 46, 2, ], // ELT_KEYREF
            // Context: ELT_UNIQUE
            [ 42, 0, 2, 1, ], // ELT_ANNOTATION
            [ 42, 0, 43, 2, ], // ELT_SELECTOR
            [ 42, 1, 43, 2, ], // ELT_SELECTOR
            [ 42, 2, 44, 3, ], // ELT_FIELD
            [ 42, 3, 44, 3, ], // ELT_FIELD
            // Context: ELT_SELECTOR
            [ 43, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_FIELD
            [ 44, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_KEY
            [ 45, 0, 2, 1, ], // ELT_ANNOTATION
            [ 45, 0, 43, 2, ], // ELT_SELECTOR
            [ 45, 1, 43, 2, ], // ELT_SELECTOR
            [ 45, 2, 44, 3, ], // ELT_FIELD
            [ 45, 3, 44, 3, ], // ELT_FIELD
            // Context: ELT_KEYREF
            [ 46, 0, 2, 1, ], // ELT_ANNOTATION
            [ 46, 0, 43, 2, ], // ELT_SELECTOR
            [ 46, 1, 43, 2, ], // ELT_SELECTOR
            [ 46, 2, 44, 3, ], // ELT_FIELD
            [ 46, 3, 44, 3, ], // ELT_FIELD
            // Context: ELT_EXPLICIT_SEQUENCE
            [ 47, 0, 2, 1, ], // ELT_ANNOTATION
            [ 47, 0, 41, 1, ], // ELT_LOCAL_ELEMENT
            [ 47, 0, 36, 1, ], // ELT_GROUP_REF
            [ 47, 0, 40, 1, ], // ELT_EXPLICIT_CHOICE
            [ 47, 0, 47, 1, ], // ELT_EXPLICIT_SEQUENCE
            [ 47, 0, 48, 1, ], // ELT_ANY
            [ 47, 1, 41, 1, ], // ELT_LOCAL_ELEMENT
            [ 47, 1, 36, 1, ], // ELT_GROUP_REF
            [ 47, 1, 40, 1, ], // ELT_EXPLICIT_CHOICE
            [ 47, 1, 47, 1, ], // ELT_EXPLICIT_SEQUENCE
            [ 47, 1, 48, 1, ], // ELT_ANY
            // Context: ELT_ANY
            [ 48, 0, 2, 1, ], // ELT_ANNOTATION
            // Context: ELT_COMPLEXCONTENT_EXTENSION
            [ 49, 0, 2, 1, ], // ELT_ANNOTATION
            [ 49, 0, 36, 2, ], // ELT_GROUP_REF
            [ 49, 0, 37, 2, ], // ELT_ALL
            [ 49, 0, 40, 2, ], // ELT_EXPLICIT_CHOICE
            [ 49, 0, 47, 2, ], // ELT_EXPLICIT_SEQUENCE
            [ 49, 0, 27, 2, ], // ELT_ATTRIBUTE
            [ 49, 0, 28, 2, ], // ELT_ATTRIBUTEGROUP_REF
            [ 49, 0, 29, 3, ], // ELT_ANYATTRIBUTE
            [ 49, 1, 36, 2, ], // ELT_GROUP_REF
            [ 49, 1, 37, 2, ], // ELT_ALL
            [ 49, 1, 40, 2, ], // ELT_EXPLICIT_CHOICE
            [ 49, 1, 47, 2, ], // ELT_EXPLICIT_SEQUENCE
            [ 49, 1, 27, 2, ], // ELT_ATTRIBUTE
            [ 49, 1, 28, 2, ], // ELT_ATTRIBUTEGROUP_REF
            [ 49, 1, 29, 3, ], // ELT_ANYATTRIBUTE
            [ 49, 2, 27, 2, ], // ELT_ATTRIBUTE
            [ 49, 2, 28, 2, ], // ELT_ATTRIBUTEGROUP_REF
            [ 49, 2, 29, 3, ], // ELT_ANYATTRIBUTE
            // Context: ELT_NAMED_GROUP
            [ 50, 0, 2, 1, ], // ELT_ANNOTATION
            [ 50, 0, 51, 2, ], // ELT_ANONYMOUS_ALL
            [ 50, 0, 52, 2, ], // ELT_SIMPLE_CHOICE
            [ 50, 0, 53, 2, ], // ELT_SIMPLE_SEQUENCE
            [ 50, 1, 51, 2, ], // ELT_ANONYMOUS_ALL
            [ 50, 1, 52, 2, ], // ELT_SIMPLE_CHOICE
            [ 50, 1, 53, 2, ], // ELT_SIMPLE_SEQUENCE
            // Context: ELT_ANONYMOUS_ALL
            [ 51, 0, 2, 1, ], // ELT_ANNOTATION
            [ 51, 0, 38, 1, ], // ELT_NARROW_ELEMENT
            [ 51, 1, 38, 1, ], // ELT_NARROW_ELEMENT
            // Context: ELT_SIMPLE_CHOICE
            [ 52, 0, 2, 1, ], // ELT_ANNOTATION
            [ 52, 0, 41, 1, ], // ELT_LOCAL_ELEMENT
            [ 52, 0, 36, 1, ], // ELT_GROUP_REF
            [ 52, 0, 40, 1, ], // ELT_EXPLICIT_CHOICE
            [ 52, 0, 47, 1, ], // ELT_EXPLICIT_SEQUENCE
            [ 52, 0, 48, 1, ], // ELT_ANY
            [ 52, 1, 41, 1, ], // ELT_LOCAL_ELEMENT
            [ 52, 1, 36, 1, ], // ELT_GROUP_REF
            [ 52, 1, 40, 1, ], // ELT_EXPLICIT_CHOICE
            [ 52, 1, 47, 1, ], // ELT_EXPLICIT_SEQUENCE
            [ 52, 1, 48, 1, ], // ELT_ANY
            // Context: ELT_SIMPLE_SEQUENCE
            [ 53, 0, 2, 1, ], // ELT_ANNOTATION
            [ 53, 0, 41, 1, ], // ELT_LOCAL_ELEMENT
            [ 53, 0, 36, 1, ], // ELT_GROUP_REF
            [ 53, 0, 40, 1, ], // ELT_EXPLICIT_CHOICE
            [ 53, 0, 47, 1, ], // ELT_EXPLICIT_SEQUENCE
            [ 53, 0, 48, 1, ], // ELT_ANY
            [ 53, 1, 41, 1, ], // ELT_LOCAL_ELEMENT
            [ 53, 1, 36, 1, ], // ELT_GROUP_REF
            [ 53, 1, 40, 1, ], // ELT_EXPLICIT_CHOICE
            [ 53, 1, 47, 1, ], // ELT_EXPLICIT_SEQUENCE
            [ 53, 1, 48, 1, ], // ELT_ANY
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
            // Context: ELT_MINEXCLUSIVE
            [ 11, 'fixed', '', 'buildFixedAttribute', ], 
            [ 11, 'id', '', 'buildIdAttribute', ], 
            [ 11, 'value', '', 'buildValueAttribute', ], 
            // Context: ELT_MININCLUSIVE
            [ 12, 'fixed', '', 'buildFixedAttribute', ], 
            [ 12, 'id', '', 'buildIdAttribute', ], 
            [ 12, 'value', '', 'buildValueAttribute', ], 
            // Context: ELT_MAXEXCLUSIVE
            [ 13, 'fixed', '', 'buildFixedAttribute', ], 
            [ 13, 'id', '', 'buildIdAttribute', ], 
            [ 13, 'value', '', 'buildValueAttribute', ], 
            // Context: ELT_MAXINCLUSIVE
            [ 14, 'fixed', '', 'buildFixedAttribute', ], 
            [ 14, 'id', '', 'buildIdAttribute', ], 
            [ 14, 'value', '', 'buildValueAttribute', ], 
            // Context: ELT_TOTALDIGITS
            [ 15, 'fixed', '', 'buildFixedAttribute', ], 
            [ 15, 'id', '', 'buildIdAttribute', ], 
            [ 15, 'value', '', 'buildValueAttribute', ], 
            // Context: ELT_FRACTIONDIGITS
            [ 16, 'fixed', '', 'buildFixedAttribute', ], 
            [ 16, 'id', '', 'buildIdAttribute', ], 
            [ 16, 'value', '', 'buildValueAttribute', ], 
            // Context: ELT_LENGTH
            [ 17, 'fixed', '', 'buildFixedAttribute', ], 
            [ 17, 'id', '', 'buildIdAttribute', ], 
            [ 17, 'value', '', 'buildValueAttribute', ], 
            // Context: ELT_MINLENGTH
            [ 18, 'fixed', '', 'buildFixedAttribute', ], 
            [ 18, 'id', '', 'buildIdAttribute', ], 
            [ 18, 'value', '', 'buildValueAttribute', ], 
            // Context: ELT_MAXLENGTH
            [ 19, 'fixed', '', 'buildFixedAttribute', ], 
            [ 19, 'id', '', 'buildIdAttribute', ], 
            [ 19, 'value', '', 'buildValueAttribute', ], 
            // Context: ELT_ENUMERATION
            [ 20, 'id', '', 'buildIdAttribute', ], 
            [ 20, 'value', '', 'buildValueAttribute', ], 
            // Context: ELT_WHITESPACE
            [ 21, 'fixed', '', 'buildFixedAttribute', ], 
            [ 21, 'id', '', 'buildIdAttribute', ], 
            [ 21, 'value', '', 'buildValueAttribute', ], 
            // Context: ELT_PATTERN
            [ 22, 'id', '', 'buildIdAttribute', ], 
            [ 22, 'value', '', 'buildValueAttribute', ], 
            // Context: ELT_LIST
            [ 23, 'id', '', 'buildIdAttribute', ], 
            [ 23, 'itemType', '', 'buildItemTypeAttribute', ], 
            // Context: ELT_UNION
            [ 24, 'id', '', 'buildIdAttribute', ], 
            [ 24, 'memberTypes', '', 'buildMemberTypesAttribute', ], 
            // Context: ELT_TOP_SIMPLETYPE
            [ 25, 'final', '', 'buildFinalAttribute', ], 
            [ 25, 'id', '', 'buildIdAttribute', ], 
            [ 25, 'name', '', 'buildNameAttribute', ], 
            // Context: ELT_NAMED_ATTRIBUTEGROUP
            [ 26, 'id', '', 'buildIdAttribute', ], 
            [ 26, 'name', '', 'buildNameAttribute', ], 
            // Context: ELT_ATTRIBUTE
            [ 27, 'default', '', 'buildDefaultAttribute', ], 
            [ 27, 'fixed', '', 'buildFixedAttribute', ], 
            [ 27, 'form', '', 'buildFormAttribute', ], 
            [ 27, 'id', '', 'buildIdAttribute', ], 
            [ 27, 'name', '', 'buildNameAttribute', ], 
            [ 27, 'ref', '', 'buildRefAttribute', ], 
            [ 27, 'type', '', 'buildTypeAttribute', ], 
            [ 27, 'use', '', 'buildUseAttribute', ], 
            // Context: ELT_ATTRIBUTEGROUP_REF
            [ 28, 'id', '', 'buildIdAttribute', ], 
            [ 28, 'ref', '', 'buildRefAttribute', ], 
            // Context: ELT_ANYATTRIBUTE
            [ 29, 'id', '', 'buildIdAttribute', ], 
            [ 29, 'namespace', '', 'buildNamespaceAttribute', ], 
            [ 29, 'processContents', '', 'buildProcessContentsAttribute', ], 
            // Context: ELT_TOP_COMPLEXTYPE
            [ 30, 'abstract', '', 'buildAbstractAttribute', ], 
            [ 30, 'block', '', 'buildBlockAttribute', ], 
            [ 30, 'final', '', 'buildFinalAttribute', ], 
            [ 30, 'id', '', 'buildIdAttribute', ], 
            [ 30, 'mixed', '', 'buildMixedAttribute', ], 
            [ 30, 'name', '', 'buildNameAttribute', ], 
            // Context: ELT_SIMPLECONTENT
            [ 31, 'id', '', 'buildIdAttribute', ], 
            // Context: ELT_SIMPLECONTENT_RESTRICTION
            [ 32, 'base', '', 'buildBaseAttribute', ], 
            [ 32, 'id', '', 'buildIdAttribute', ], 
            // Context: ELT_SIMPLECONTENT_EXTENSION
            [ 33, 'base', '', 'buildBaseAttribute', ], 
            [ 33, 'id', '', 'buildIdAttribute', ], 
            // Context: ELT_COMPLEXCONTENT
            [ 34, 'id', '', 'buildIdAttribute', ], 
            [ 34, 'mixed', '', 'buildMixedAttribute', ], 
            // Context: ELT_COMPLEXCONTENT_RESTRICTION
            [ 35, 'base', '', 'buildBaseAttribute', ], 
            [ 35, 'id', '', 'buildIdAttribute', ], 
            // Context: ELT_GROUP_REF
            [ 36, 'id', '', 'buildIdAttribute', ], 
            [ 36, 'maxOccurs', '', 'buildMaxOccursAttribute', ], 
            [ 36, 'minOccurs', '', 'buildMinOccursAttribute', ], 
            [ 36, 'ref', '', 'buildRefAttribute', ], 
            // Context: ELT_ALL
            [ 37, 'id', '', 'buildIdAttribute', ], 
            [ 37, 'maxOccurs', '', 'buildMaxOccursAttribute', ], 
            [ 37, 'minOccurs', '', 'buildMinOccursAttribute', ], 
            // Context: ELT_NARROW_ELEMENT
            [ 38, 'block', '', 'buildBlockAttribute', ], 
            [ 38, 'default', '', 'buildDefaultAttribute', ], 
            [ 38, 'fixed', '', 'buildFixedAttribute', ], 
            [ 38, 'form', '', 'buildFormAttribute', ], 
            [ 38, 'id', '', 'buildIdAttribute', ], 
            [ 38, 'maxOccurs', '', 'buildMaxOccursAttribute', ], 
            [ 38, 'minOccurs', '', 'buildMinOccursAttribute', ], 
            [ 38, 'name', '', 'buildNameAttribute', ], 
            [ 38, 'nillable', '', 'buildNillableAttribute', ], 
            [ 38, 'ref', '', 'buildRefAttribute', ], 
            [ 38, 'type', '', 'buildTypeAttribute', ], 
            // Context: ELT_LOCAL_COMPLEXTYPE
            [ 39, 'id', '', 'buildIdAttribute', ], 
            [ 39, 'mixed', '', 'buildMixedAttribute', ], 
            // Context: ELT_EXPLICIT_CHOICE
            [ 40, 'id', '', 'buildIdAttribute', ], 
            [ 40, 'maxOccurs', '', 'buildMaxOccursAttribute', ], 
            [ 40, 'minOccurs', '', 'buildMinOccursAttribute', ], 
            // Context: ELT_LOCAL_ELEMENT
            [ 41, 'block', '', 'buildBlockAttribute', ], 
            [ 41, 'default', '', 'buildDefaultAttribute', ], 
            [ 41, 'fixed', '', 'buildFixedAttribute', ], 
            [ 41, 'form', '', 'buildFormAttribute', ], 
            [ 41, 'id', '', 'buildIdAttribute', ], 
            [ 41, 'maxOccurs', '', 'buildMaxOccursAttribute', ], 
            [ 41, 'minOccurs', '', 'buildMinOccursAttribute', ], 
            [ 41, 'name', '', 'buildNameAttribute', ], 
            [ 41, 'nillable', '', 'buildNillableAttribute', ], 
            [ 41, 'ref', '', 'buildRefAttribute', ], 
            [ 41, 'type', '', 'buildTypeAttribute', ], 
            // Context: ELT_UNIQUE
            [ 42, 'id', '', 'buildIdAttribute', ], 
            [ 42, 'name', '', 'buildNameAttribute', ], 
            // Context: ELT_SELECTOR
            [ 43, 'id', '', 'buildIdAttribute', ], 
            [ 43, 'xpath', '', 'buildXPathAttribute', ], 
            // Context: ELT_FIELD
            [ 44, 'id', '', 'buildIdAttribute', ], 
            [ 44, 'xpath', '', 'buildXPathAttribute', ], 
            // Context: ELT_KEY
            [ 45, 'id', '', 'buildIdAttribute', ], 
            [ 45, 'name', '', 'buildNameAttribute', ], 
            // Context: ELT_KEYREF
            [ 46, 'id', '', 'buildIdAttribute', ], 
            [ 46, 'name', '', 'buildNameAttribute', ], 
            [ 46, 'refer', '', 'buildReferAttribute', ], 
            // Context: ELT_EXPLICIT_SEQUENCE
            [ 47, 'id', '', 'buildIdAttribute', ], 
            [ 47, 'maxOccurs', '', 'buildMaxOccursAttribute', ], 
            [ 47, 'minOccurs', '', 'buildMinOccursAttribute', ], 
            // Context: ELT_ANY
            [ 48, 'id', '', 'buildIdAttribute', ], 
            [ 48, 'maxOccurs', '', 'buildMaxOccursAttribute', ], 
            [ 48, 'minOccurs', '', 'buildMinOccursAttribute', ], 
            [ 48, 'namespace', '', 'buildNamespaceAttribute', ], 
            [ 48, 'processContents', '', 'buildProcessContentsAttribute', ], 
            // Context: ELT_COMPLEXCONTENT_EXTENSION
            [ 49, 'base', '', 'buildBaseAttribute', ], 
            [ 49, 'id', '', 'buildIdAttribute', ], 
            // Context: ELT_NAMED_GROUP
            [ 50, 'id', '', 'buildIdAttribute', ], 
            [ 50, 'name', '', 'buildNameAttribute', ], 
            // Context: ELT_ANONYMOUS_ALL
            [ 51, 'id', '', 'buildIdAttribute', ], 
            // Context: ELT_SIMPLE_CHOICE
            [ 52, 'id', '', 'buildIdAttribute', ], 
            // Context: ELT_SIMPLE_SEQUENCE
            [ 53, 'id', '', 'buildIdAttribute', ], 
            // Context: ELT_TOP_ELEMENT
            [ 54, 'abstract', '', 'buildAbstractAttribute', ], 
            [ 54, 'block', '', 'buildBlockAttribute', ], 
            [ 54, 'default', '', 'buildDefaultAttribute', ], 
            [ 54, 'final', '', 'buildFinalAttribute', ], 
        ];
    }
}
