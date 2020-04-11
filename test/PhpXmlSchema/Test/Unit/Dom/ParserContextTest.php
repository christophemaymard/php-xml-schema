<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\ParserContext;
use PhpXmlSchema\Dom\SchemaBuilderInterface;
use PhpXmlSchema\Dom\Specification;
use PhpXmlSchema\Exception\InvalidOperationException;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\ParserContext} 
 * class.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ParserContextTest extends TestCase
{
    use ProphecyTrait;
    
    /**
     * Tests that isComposite() returns FALSE when the context is for a leaf 
     * element.
     */
    public function testIsCompositeReturnsFalseWhenLEC(): void
    {
        $specMock = $this->createLESpecificationProphecy()->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertFalse($sut->isComposite());
    }
    
    /**
     * Tests that isComposite() returns TRUE when the context is for a 
     * composite element.
     */
    public function testIsCompositeReturnsTrueWhenCEC(): void
    {
        $specMock = $this->createCESpecificationProphecy(0)->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertTrue($sut->isComposite());
    }
    
    /**
     * Tests that isElementAccepted() returns FALSE when the defined context 
     * is for leaf element.
     */
    public function testIsElementAcceptedReturnsFalseWhenLEC(): void
    {
        $specMock = $this->createLESpecificationProphecy()->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertFalse($sut->isElementAccepted('foo'));
    }
    
    /**
     * Tests that isElementAccepted() returns FALSE when:
     * - the defined context is for a composite element, and 
     * - findTransitionElementNameSymbol() returns NULL.
     */
    public function testIsElementAcceptedReturnsFalseWhenCECFindTransitionElementNameSymbolReturnsNull(): void
    {
        $specProphecy = $this->createCESpecificationProphecy(0);
        $specProphecy->findTransitionElementNameSymbol(0, 'foo')->willReturn(NULL)->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertFalse($sut->isElementAccepted('foo'));
    }
    
    /**
     * Tests that isElementAccepted() returns TRUE when:
     * - the defined context is for a composite element, and 
     * - findTransitionElementNameSymbol() returns an integer.
     */
    public function testIsElementAcceptedReturnsTrueWhenCECFindTransitionElementNameSymbolReturnsInt(): void
    {
        $specProphecy = $this->createCESpecificationProphecy(0);
        $specProphecy->findTransitionElementNameSymbol(0, 'foo')->willReturn(TRUE)->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertTrue($sut->isElementAccepted('foo'));
    }
    
    /**
     * Tests that getAcceptedElements() returns an empty array when the 
     * defined context is for leaf element.
     */
    public function testGetAcceptedElementsReturnsEmptyArrayWhenLEC(): void
    {
        $specMock = $this->createLESpecificationProphecy()->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertSame([], $sut->getAcceptedElements());
    }
    
    /**
     * Tests that isElementAccepted() returns FALSE when:
     * - the defined context is for a composite element, and 
     * - findTransitionElementNameSymbol() returns NULL.
     */
    public function testGetAcceptedElementsReturnsArrayOfStrings(): void
    {
        $specProphecy = $this->createCESpecificationProphecy(0);
        $specProphecy->getTransitionElementNames(0)->willReturn([ 'foo', 'bar', ])->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertSame([ 'foo', 'bar', ], $sut->getAcceptedElements());
    }
    
    /**
     * Tests that createElement() throws an exception when the context is for 
     * a leaf element.
     * 
     * @group   element
     * @group   content
     * @group   fa
     */
    public function testCreateElementThrowsExceptionWhenLEC(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" element cannot be created '.
            'because this context is defined for a leaf element.');
        
        $specMock = $this->createLESpecificationProphecy()->reveal();
        $builderDummy = $this->createSchemaBuilderInterfaceDummy();
        
        $sut = new ParserContext($specMock);
        $sut->createElement('foo', $builderDummy);
    }
    
    /**
     * Tests that createElement() throws an exception when:
     * - the defined context is for a composite element, and 
     * - findTransitionElementNameSymbol() returns NULL.
     * 
     * @group   element
     * @group   content
     * @group   fa
     */
    public function testCreateElementThrowsExceptionWhenCECElementNotAccepted(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" element cannot be created '.
            'because it is not supported in the current state.');
        
        $specProphecy = $this->createCESpecificationProphecy(0);
        $specProphecy->findTransitionElementNameSymbol(0, 'foo')
            ->willReturn(NULL)
            ->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $builderDummy = $this->createSchemaBuilderInterfaceDummy();
        
        $sut = new ParserContext($specMock);
        $sut->createElement('foo', $builderDummy);
    }
    
    /**
     * Tests that createElement() throws an exception when:
     * - the defined context is for a composite element, and 
     * - findTransitionElementNameSymbol() returns an integer, and 
     * - no transition, with the current state and the found symbol, mapped.
     * 
     * @group   element
     * @group   content
     * @group   fa
     */
    public function testCreateElementThrowsExceptionWhenCECNoElementBuilder(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" element cannot be created '.
            'because it is not supported in the current state.');
        
        $specProphecy = $this->createCESpecificationProphecy(0);
        $specProphecy->findTransitionElementNameSymbol(0, 'foo')
            ->willReturn(1)
            ->shouldBeCalled();
        $specProphecy->hasTransitionElementBuilder(0, 1)
            ->willReturn(FALSE)
            ->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $builderDummy = $this->createSchemaBuilderInterfaceDummy();
        
        $sut = new ParserContext($specMock);
        $sut->createElement('foo', $builderDummy);
    }
    
    /**
     * Tests that createElement() throws an exception when:
     * - the defined context is for a composite element, and 
     * - findTransitionElementNameSymbol() returns an integer, and 
     * - a transition with a method name, and 
     * - the method is not part of the instance.
     * 
     * @group   element
     * @group   content
     * @group   fa
     */
    public function testCreateElementThrowsExceptionWhenCECNotCallable(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" element cannot be created '.
            'because the "buildFoo" method is not part of the builder instance.');
        
        $specProphecy = $this->createCESpecificationProphecy(0);
        $specProphecy->findTransitionElementNameSymbol(0, 'foo')
            ->willReturn(1)
            ->shouldBeCalled();
        $specProphecy->hasTransitionElementBuilder(0, 1)
            ->willReturn(TRUE)
            ->shouldBeCalled();
        $specProphecy->getTransitionElementBuilder(0, 1)
            ->willReturn('buildFoo')
            ->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $builderDummy = $this->createSchemaBuilderConcreteDummy();
        
        $sut = new ParserContext($specMock);
        $sut->createElement('foo', $builderDummy);
    }
    
    /**
     * Tests that createElement() returns an integer when:
     * - the defined context is for a composite element, and 
     * - findTransitionElementNameSymbol() returns an integer, and 
     * - a transition with a method name, and 
     * - the method is part of the instance.
     * 
     * @group   element
     * @group   content
     * @group   fa
     */
    public function testCreateElementReturnsInt(): void
    {
        $sym = 10;
        $name = 'schema';
        
        $specProphecy = $this->createCESpecificationProphecy(
            0,
            [], 
            [
                [ 0, $sym ], 
                
                // This is used to test that the symbol has been to the DFA.
                [ 2, 0 ], 
                [ 2, 1 ], 
            ], 
            [
                [ 2, 0, $sym, ], 
                
                // This is used to test that the symbol has been to the DFA.
                [ 3, 2, 0, ], 
                [ 3, 2, 1, ], 
            ]
        );
        $specProphecy->findTransitionElementNameSymbol(0, $name)
            ->willReturn($sym)->shouldBeCalled();
        $specProphecy->hasTransitionElementBuilder(0, $sym)
            ->willReturn(TRUE)->shouldBeCalled();
        $specProphecy->getTransitionElementBuilder(0, $sym)
            ->willReturn('buildSchemaElement')->shouldBeCalled();
        
        // This is used to test that the symbol has been to the DFA using 
        // getAcceptedElements().
        $specProphecy->getTransitionElementNames(2)
            ->willReturn([ 'foo', 'bar', ])
            ->shouldBeCalled();
        
        $specMock = $specProphecy->reveal();

        $builderProphecy = $this->prophesize(SchemaBuilderInterface::class);
        $builderProphecy->buildSchemaElement()->shouldBeCalledOnce();
        $builderMock = $builderProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertSame($sym, $sut->createElement($name, $builderMock));
        self::assertSame([ 'foo', 'bar', ], $sut->getAcceptedElements());
    }
    
    /**
     * Tests that isAttributeSupported() returns FALSE when the attribute is 
     * not associated with a builder.
     */
    public function testIsAttributeSupportedReturnsFalseWhenNoAttributeBuilder(): void
    {
        $specProphecy = $this->createLESpecificationProphecy();
        $specProphecy->hasAttributeBuilder('foo', '')
            ->willReturn(FALSE)
            ->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertFalse($sut->isAttributeSupported('foo', ''));
    }
    
    /**
     * Tests that isAttributeSupported() returns TRUE when the attribute is 
     * associated with a builder.
     */
    public function testIsAttributeSupportedReturnsTrueWhenAttributeBuilderSet(): void
    {
        $specProphecy = $this->createCESpecificationProphecy(0);
        $specProphecy->hasAttributeBuilder('foo', '')
            ->willReturn(TRUE)
            ->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertTrue($sut->isAttributeSupported('foo', ''));
    }
    
    /**
     * Tests that createAttribute() throws an exception when the element is 
     * not supported.
     */
    public function testCreateAttributeThrowsExceptionWhenAttributeNotSupported(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The attribute with the local name '.
            '"foo" and the namespace "" cannot be created because it is '.
            'not supported.');
        
        $specProphecy = $this->createLESpecificationProphecy();
        $specProphecy->hasAttributeBuilder('foo', '')
            ->willReturn(FALSE)
            ->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $builderDummy = $this->createSchemaBuilderInterfaceDummy();
        
        $sut = new ParserContext($specMock);
        $sut->createAttribute('foo', '', 'bar', $builderDummy);
    }
    
    /**
     * Tests that createAttribute() throws an exception the method is not 
     * part of the builder instance.
     */
    public function testCreateAttributeThrowsExceptionWhenNotCallable(): void
    {
        // 'The "%s" element cannot be created because the "%s" method is not part of the builder instance.'
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The attribute with the local name '.
            '"foo" and the namespace "" cannot be created because the '.
            '"buildFooAttribute" method is not part of the builder instance.');
        
        $specProphecy = $this->createLESpecificationProphecy();
        $specProphecy->hasAttributeBuilder('foo', '')
            ->willReturn(TRUE)
            ->shouldBeCalled();
        $specProphecy->getAttributeBuilder('foo', '')
            ->willReturn('buildFooAttribute')
            ->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $builderDummy = $this->createSchemaBuilderConcreteDummy();
        
        $sut = new ParserContext($specMock);
        $sut->createAttribute('foo', '', 'bar', $builderDummy);
    }
    
    /**
     * Tests that createAttribute() calls a method of the builder instance.
     */
    public function testCreateAttributeCallsMethod(): void
    {
        $specProphecy = $this->createLESpecificationProphecy();
        $specProphecy->hasAttributeBuilder('attributeFormDefault', '')
            ->willReturn(TRUE)
            ->shouldBeCalled();
        $specProphecy->getAttributeBuilder('attributeFormDefault', '')
            ->willReturn('buildAttributeFormDefaultAttribute')
            ->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $builderProphecy = $this->prophesize(SchemaBuilderInterface::class);
        $builderProphecy->buildAttributeFormDefaultAttribute('qualified')
            ->shouldBeCalledOnce();
        $builderMock = $builderProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        $sut->createAttribute('attributeFormDefault', '', 'qualified', $builderMock);
    }
    
    /**
     * Tests that isContentValid() returns TRUE when the defined context is 
     * for leaf element.
     */
    public function testIsContentValidReturnsTrueWhenLEC(): void
    {
        $specProphecy = $this->createLESpecificationProphecy();
        $specMock = $specProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertTrue($sut->isContentValid());
    }
    
    /**
     * Tests that isContentValid() returns FALSE when:
     * - the defined context is for a composite element, and 
     * - there is no final state.
     * 
     * @group   element
     * @group   content
     * @group   fa
     */
    public function testIsContentValidReturnsFalseWhenCECNoFinalState(): void
    {
        $specProphecy = $this->createCESpecificationProphecy(0);
        $specMock = $specProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertFalse($sut->isContentValid());
    }
    
    /**
     * Tests that isContentValid() returns FALSE when:
     * - the defined context is for a composite element, and 
     * - no element has been created, and 
     * - the initial state is not among the set of final states.
     * 
     * @group   element
     * @group   content
     * @group   fa
     */
    public function testIsContentValidReturnsFalseWhenCECInitialStateNotInFinalStates(): void
    {
        $specProphecy = $this->createCESpecificationProphecy(0, [ 1, ]);
        $specMock = $specProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertFalse($sut->isContentValid());
    }
    
    /**
     * Tests that isContentValid() returns TRUE when:
     * - the defined context is for a composite element, and 
     * - no element has been created, and 
     * - the initial state is among the set of final states.
     * 
     * @group   element
     * @group   content
     * @group   fa
     */
    public function testIsContentValidReturnsTrueWhenCECInitialStateInFinalStates(): void
    {
        $specProphecy = $this->createCESpecificationProphecy(0, [ 0, ]);
        $specMock = $specProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertTrue($sut->isContentValid());
    }
    
    /**
     * Tests that isContentValid() returns FALSE when:
     * - the defined context is for a composite element, and 
     * - an element has been created, and 
     * - the current state is not among the set of final states.
     * 
     * @group   element
     * @group   content
     * @group   fa
     */
    public function testIsContentValidReturnsFalseWhenCECCreateElementAndCurrentStateNotInFinalStates(): void
    {
        $specProphecy = $this->createCESpecificationProphecy(
            0,
            [], 
            [
                [ 0, 10 ], 
            ], 
            [
                [ 2, 0, 10, ], 
            ]
        );
        $specProphecy->findTransitionElementNameSymbol(0, 'schema')
            ->willReturn(10)->shouldBeCalled();
        $specProphecy->hasTransitionElementBuilder(0, 10)
            ->willReturn(TRUE)->shouldBeCalled();
        $specProphecy->getTransitionElementBuilder(0, 10)
            ->willReturn('buildSchemaElement')->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $builderProphecy = $this->prophesize(SchemaBuilderInterface::class);
        $builderProphecy->buildSchemaElement()->shouldBeCalledOnce();
        $builderMock = $builderProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        $sut->createElement('schema', $builderMock);
        self::assertFalse($sut->isContentValid());
    }
    
    /**
     * Tests that isContentValid() returns TRUE when:
     * - the defined context is for a composite element, and 
     * - an element has been created, and 
     * - the current state is among the set of final states.
     * 
     * @group   element
     * @group   content
     * @group   fa
     */
    public function testIsContentValidReturnsTrueWhenCECCreateElementAndCurrentStateInFinalStates(): void
    {
        $specProphecy = $this->createCESpecificationProphecy(
            0,
            [ 2, ], 
            [
                [ 0, 10 ], 
            ], 
            [
                [ 2, 0, 10, ], 
            ]
        );
        $specProphecy->findTransitionElementNameSymbol(0, 'schema')
            ->willReturn(10)->shouldBeCalled();
        $specProphecy->hasTransitionElementBuilder(0, 10)
            ->willReturn(TRUE)->shouldBeCalled();
        $specProphecy->getTransitionElementBuilder(0, 10)
            ->willReturn('buildSchemaElement')->shouldBeCalled();
        $specMock = $specProphecy->reveal();
        
        $builderProphecy = $this->prophesize(SchemaBuilderInterface::class);
        $builderProphecy->buildSchemaElement()->shouldBeCalledOnce();
        $builderMock = $builderProphecy->reveal();
        
        $sut = new ParserContext($specMock);
        $sut->createElement('schema', $builderMock);
        self::assertTrue($sut->isContentValid());
    }
    
    /**
     * Creates a prophecy of the {@see PhpXmlSchema\Dom\Specification} class, 
     * for the sepcification of a leaf element, where:
     * - hasInitialState() will return FALSE and should be called.
     * 
     * @return  ObjectProphecy
     */
    private function createLESpecificationProphecy(): ObjectProphecy
    {
        $prophecy = $this->prophesize(Specification::class);
        $prophecy->hasInitialState()->willReturn(FALSE)->shouldBeCalled();
        
        return $prophecy;
    }
    
    /**
     * Creates a prophecy of the {@see PhpXmlSchema\Dom\Specification} class, 
     * for the sepcification of a leaf element, where:
     * - hasInitialState() will return TRUE and should be called, and 
     * - getInitialState() will return the specified value and should be 
     * called, and 
     * - getFinalStates() will return the specified value and should be 
     * called.
     * 
     * @param   int     $initialState           The value that getInitialState() will return.
     * @param   int[]   $finalStates            The value that getFinalStates() will return (optional)(default to an empty array).
     * @param   array[] $transitions            The value that getNextStateTransitions() will return (optional)(default to an empty array).
     * @param   array[] $transitionNextStates   The input and return values that getTransitionNextState()s will have (optional)(default to an empty array).
     * @return  ObjectProphecy
     */
    private function createCESpecificationProphecy(
        int $initialState, 
        array $finalStates = [], 
        array $transitions = [], 
        array $transitionNextStates = []
    ): ObjectProphecy
    {
        $prophecy = $this->prophesize(Specification::class);
        $prophecy->hasInitialState()->willReturn(TRUE)->shouldBeCalled();
        $prophecy->getInitialState()->willReturn($initialState)->shouldBeCalled();
        $prophecy->getFinalStates()->willReturn($finalStates)->shouldBeCalled();
        $prophecy->getNextStateTransitions()
            ->willReturn($transitions)
            ->shouldBeCalled();
        
        foreach ($transitionNextStates as $tns) {
            $prophecy->getTransitionNextState($tns[1], $tns[2])
                ->willReturn($tns[0])
                ->shouldBeCalled();
        }
        
        return $prophecy;
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\SchemaBuilderInterface} 
     * interface.
     * 
     * @return  ProphecySubjectInterface
     */
    private function createSchemaBuilderInterfaceDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(SchemaBuilderInterface::class)->reveal();
    }
    
    /**
     * Creates a concrete dummy of the {@see PhpXmlSchema\Dom\SchemaBuilderInterface} 
     * interface.
     * 
     * This method has been created because the __call() magic method is 
     * implemented so the test, that checks a method does not exits, cannot 
     * fail.
     * 
     * @return  SchemaBuilderInterface
     */
    private function createSchemaBuilderConcreteDummy(): SchemaBuilderInterface
    {
        return new class() implements SchemaBuilderInterface
        {
            public function bindNamespace(string $prefix, string $namespace): void {}
            public function buildAbstractAttribute(string $value): void {}
            public function buildAttributeFormDefaultAttribute(string $value): void {}
            public function buildBaseAttribute(string $value): void {}
            public function buildBlockAttribute(string $value): void {}
            public function buildBlockDefaultAttribute(string $value): void {}
            public function buildDefaultAttribute(string $value): void {}
            public function buildElementFormDefaultAttribute(string $value): void {}
            public function buildFinalAttribute(string $value): void {}
            public function buildFinalDefaultAttribute(string $value): void {}
            public function buildFixedAttribute(string $value): void {}
            public function buildFormAttribute(string $value): void {}
            public function buildIdAttribute(string $value): void {}
            public function buildItemTypeAttribute(string $value): void {}
            public function buildMaxOccursAttribute(string $value): void {}
            public function buildMemberTypesAttribute(string $value): void {}
            public function buildMinOccursAttribute(string $value): void {}
            public function buildMixedAttribute(string $value): void {}
            public function buildNameAttribute(string $value): void {}
            public function buildNamespaceAttribute(string $value): void {}
            public function buildNillableAttribute(string $value): void {}
            public function buildProcessContentsAttribute(string $value): void {}
            public function buildPublicAttribute(string $value): void {}
            public function buildRefAttribute(string $value): void {}
            public function buildReferAttribute(string $value): void {}
            public function buildSchemaLocationAttribute(string $value): void {}
            public function buildSourceAttribute(string $value): void {}
            public function buildSystemAttribute(string $value): void {}
            public function buildTargetNamespaceAttribute(string $value): void {}
            public function buildTypeAttribute(string $value): void {}
            public function buildUseAttribute(string $value): void {}
            public function buildValueAttribute(string $value): void {}
            public function buildVersionAttribute(string $value): void {}
            public function buildXPathAttribute(string $value): void {}
            public function buildLangAttribute(string $value): void {}
            
            public function buildAllElement(): void {}
            public function buildAnnotationElement(): void {}
            public function buildCompositionAnnotationElement(): void {}
            public function buildDefinitionAnnotationElement(): void {}
            public function buildAnyElement(): void {}
            public function buildAnyAttributeElement(): void {}
            public function buildAppInfoElement(): void {}
            public function buildAttributeElement(): void {}
            public function buildAttributeGroupElement(): void {}
            public function buildChoiceElement(): void {}
            public function buildComplexContentElement(): void {}
            public function buildComplexTypeElement(): void {}
            public function buildDocumentationElement(): void {}
            public function buildElementElement(): void {}
            public function buildEnumerationElement(): void {}
            public function buildExtensionElement(): void {}
            public function buildFieldElement(): void {}
            public function buildFractionDigitsElement(): void {}
            public function buildGroupElement(): void {}
            public function buildImportElement(): void {}
            public function buildIncludeElement(): void {}
            public function buildKeyElement(): void {}
            public function buildKeyRefElement(): void {}
            public function buildLengthElement(): void {}
            public function buildListElement(): void {}
            public function buildMaxExclusiveElement(): void {}
            public function buildMaxInclusiveElement(): void {}
            public function buildMaxLengthElement(): void {}
            public function buildMinExclusiveElement(): void {}
            public function buildMinInclusiveElement(): void {}
            public function buildMinLengthElement(): void {}
            public function buildNotationElement(): void {}
            public function buildPatternElement(): void {}
            public function buildRestrictionElement(): void {}
            public function buildSelectorElement(): void {}
            public function buildSequenceElement(): void {}
            public function buildSimpleContentElement(): void {}
            public function buildSimpleTypeElement(): void {}
            public function buildTotalDigitsElement(): void {}
            public function buildUnionElement(): void {}
            public function buildUniqueElement(): void {}
            public function buildWhiteSpaceElement(): void {}
            public function buildSchemaElement(): void {}
            
            public function buildLeafElementContent(string $content): void {}
            
            public function endElement(): void {}
        };
    }
}
