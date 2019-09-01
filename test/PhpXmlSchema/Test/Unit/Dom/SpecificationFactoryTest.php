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
            [ 1, 0, 26, 'attributeGroup', ], // ELT_NAMED_ATTRIBUTEGROUP
            [ 1, 0, 8, 'attribute', ], // ELT_TOP_ATTRIBUTE
            [ 1, 0, 7, 'notation', ], // ELT_NOTATION
            [ 1, 1, 25, 'simpleType', ], // ELT_TOP_SIMPLETYPE
            [ 1, 1, 26, 'attributeGroup', ], // ELT_NAMED_ATTRIBUTEGROUP
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
            [ 26, 1, 27, 'attribute', ], // ELT_ATTRIBUTE
            [ 26, 1, 28, 'attributeGroup', ], // ELT_ATTRIBUTEGROUP_REF
            // Context: ELT_ATTRIBUTE
            [ 27, 0, 2, 'annotation', ], // ELT_ANNOTATION
            [ 27, 0, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            [ 27, 1, 9, 'simpleType', ], // ELT_LOCAL_SIMPLETYPE
            // Context: ELT_ATTRIBUTEGROUP_REF
            [ 28, 0, 2, 'annotation', ], // ELT_ANNOTATION
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
            [ 1, 0, 26, 'buildAttributeGroupElement', ], // ELT_NAMED_ATTRIBUTEGROUP
            [ 1, 0, 8, 'buildAttributeElement', ], // ELT_TOP_ATTRIBUTE
            [ 1, 0, 7, 'buildNotationElement', ], // ELT_NOTATION
            [ 1, 1, 25, 'buildSimpleTypeElement', ], // ELT_TOP_SIMPLETYPE
            [ 1, 1, 26, 'buildAttributeGroupElement', ], // ELT_NAMED_ATTRIBUTEGROUP
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
            [ 26, 1, 27, 'buildAttributeElement', ], // ELT_ATTRIBUTE
            [ 26, 1, 28, 'buildAttributeGroupElement', ], // ELT_ATTRIBUTEGROUP_REF
            // Context: ELT_ATTRIBUTE
            [ 27, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
            [ 27, 0, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            [ 27, 1, 9, 'buildSimpleTypeElement', ], // ELT_LOCAL_SIMPLETYPE
            // Context: ELT_ATTRIBUTEGROUP_REF
            [ 28, 0, 2, 'buildAnnotationElement', ], // ELT_ANNOTATION
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
            [ 1, 0, 26, 1, ], // ELT_NAMED_ATTRIBUTEGROUP
            [ 1, 0, 8, 1, ], // ELT_TOP_ATTRIBUTE
            [ 1, 0, 7, 1, ], // ELT_NOTATION
            [ 1, 1, 25, 1, ], // ELT_TOP_SIMPLETYPE
            [ 1, 1, 26, 1, ], // ELT_NAMED_ATTRIBUTEGROUP
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
            [ 26, 1, 27, 1, ], // ELT_ATTRIBUTE
            [ 26, 1, 28, 1, ], // ELT_ATTRIBUTEGROUP_REF
            // Context: ELT_ATTRIBUTE
            [ 27, 0, 2, 1, ], // ELT_ANNOTATION
            [ 27, 0, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            [ 27, 1, 9, 2, ], // ELT_LOCAL_SIMPLETYPE
            // Context: ELT_ATTRIBUTEGROUP_REF
            [ 28, 0, 2, 1, ], // ELT_ANNOTATION
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
        ];
    }
}
