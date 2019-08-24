<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\ParserContext;
use PhpXmlSchema\Dom\SchemaBuilderInterface;
use PhpXmlSchema\Dom\Specification;
use PhpXmlSchema\Exception\InvalidOperationException;
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
    /**
     * Tests that isComposite() returns FALSE when the context is for a leaf 
     * element.
     */
    public function testIsCompositeReturnsFalseWhenLEC()
    {
        $specMock = $this->createLESpecificationProphecy()->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertFalse($sut->isComposite());
    }
    
    /**
     * Tests that isComposite() returns TRUE when the context is for a 
     * composite element.
     */
    public function testIsCompositeReturnsTrueWhenCEC()
    {
        $specMock = $this->createCESpecificationProphecy(0)->reveal();
        
        $sut = new ParserContext($specMock);
        self::assertTrue($sut->isComposite());
    }
    
    /**
     * Tests that isElementAccepted() returns FALSE when the defined context 
     * is for leaf element.
     */
    public function testIsElementAcceptedReturnsFalseWhenLEC()
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
    public function testIsElementAcceptedReturnsFalseWhenCECFindTransitionElementNameSymbolReturnsNull()
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
    public function testIsElementAcceptedReturnsTrueWhenCECFindTransitionElementNameSymbolReturnsInt()
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
    public function testGetAcceptedElementsReturnsEmptyArrayWhenLEC()
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
    public function testGetAcceptedElementsReturnsArrayOfStrings()
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
    public function testCreateElementThrowsExceptionWhenLEC()
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
    public function testCreateElementThrowsExceptionWhenCECElementNotAccepted()
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
    public function testCreateElementThrowsExceptionWhenCECNoElementBuilder()
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
    public function testCreateElementThrowsExceptionWhenCECNotCallable()
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
    public function testCreateElementReturnsInt()
    {
        $sym = 10;
        $name = 'schema';
        
        $specProphecy = $this->createCESpecificationProphecy(
            0,
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
    public function testIsAttributeSupportedReturnsFalseWhenNoAttributeBuilder()
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
    public function testIsAttributeSupportedReturnsTrueWhenAttributeBuilderSet()
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
    public function testCreateAttributeThrowsExceptionWhenAttributeNotSupported()
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
    public function testCreateAttributeThrowsExceptionWhenNotCallable()
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
    public function testCreateAttributeCallsMethod()
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
     * Creates a prophecy of the {@see PhpXmlSchema\Dom\Specification} class, 
     * for the sepcification of a leaf element, where:
     * - hasInitialState() will return FALSE and should be called.
     * 
     * @return  ObjectProphecy
     */
    private function createLESpecificationProphecy():ObjectProphecy
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
     * called.
     * 
     * @param   int     $initialState           The value that getInitialState() will return.
     * @param   array[] $transitions            The value that getNextStateTransitions() will return (optional)(default to an empty array).
     * @param   array[] $transitionNextStates   The input and return values that getTransitionNextState()s will have (optional)(default to an empty array).
     * @return  ObjectProphecy
     */
    private function createCESpecificationProphecy(
        int $initialState,
        array $transitions = [], 
        array $transitionNextStates = []
    ):ObjectProphecy {
        $prophecy = $this->prophesize(Specification::class);
        $prophecy->hasInitialState()->willReturn(TRUE)->shouldBeCalled();
        $prophecy->getInitialState()->willReturn($initialState)->shouldBeCalled();
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
    private function createSchemaBuilderInterfaceDummy():ProphecySubjectInterface
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
    private function createSchemaBuilderConcreteDummy():SchemaBuilderInterface
    {
        return new class() implements SchemaBuilderInterface
        {
            public function bindNamespace(string $prefix, string $namespace) {}
            public function buildAttributeFormDefaultAttribute(string $value) {}
            public function buildBlockDefaultAttribute(string $value) {}
            public function buildDefaultAttribute(string $value) {}
            public function buildElementFormDefaultAttribute(string $value) {}
            public function buildFinalDefaultAttribute(string $value) {}
            public function buildFixedAttribute(string $value) {}
            public function buildIdAttribute(string $value) {}
            public function buildNameAttribute(string $value) {}
            public function buildNamespaceAttribute(string $value) {}
            public function buildPublicAttribute(string $value) {}
            public function buildSchemaLocationAttribute(string $value) {}
            public function buildSourceAttribute(string $value) {}
            public function buildSystemAttribute(string $value) {}
            public function buildTargetNamespaceAttribute(string $value) {}
            public function buildTypeAttribute(string $value) {}
            public function buildVersionAttribute(string $value) {}
            public function buildLangAttribute(string $value) {}
            
            public function buildAnnotationElement() {}
            public function buildCompositionAnnotationElement() {}
            public function buildDefinitionAnnotationElement() {}
            public function buildAppInfoElement() {}
            public function buildAttributeElement() {}
            public function buildDocumentationElement() {}
            public function buildImportElement() {}
            public function buildIncludeElement() {}
            public function buildNotationElement() {}
            public function buildRestrictionElement() {}
            public function buildSimpleTypeElement() {}
            public function buildSchemaElement() {}
            
            public function buildLeafElementContent(string $content) {}
            
            public function endElement() {}
        };
    }
}
