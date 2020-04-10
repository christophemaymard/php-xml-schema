<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Exception\InvalidOperationException;
use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Test\Unit\Datatype\QNameTypeProviderTrait;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "attributeGroup" element 
 * (attributeGroupRef).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AttributeGroupRefSchemaElementBuilderTest extends AbstractAttributeGroupSchemaElementBuilderTestCase
{
    use QNameTypeProviderTrait;
    
    use BuildNameAttributeDoesNotCreateAttributeTestTrait;
    use BuildAttributeElementDoesNotCreateElementTestTrait;
    use BuildAttributeGroupElementDoesNotCreateElementTestTrait;
    use BuildAnyAttributeElementDoesNotCreateElementTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch)
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        self::assertCount(1, $ag->getAttributeGroupElements());
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch)
    {
        return $sch->getAttributeGroupElements()[0]
            ->getAttributeGroupElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildAttributeGroupElement();
        $this->sut->buildAttributeGroupElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildRefAttribute() creates the attribute when:
     * - the current element is the "attributeGroup" element 
     * (attributeGroupRef), and 
     * - the value is a valid QName (local part without prefix), and 
     * - no default namespace.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidLocalPartQNameTypeValues
     */
    public function testBuildRefAttributeCreatesAttrWhenAttributeGroupRefAndValueIsValidQNameLocalPartAndNoDefaultNamespace(
        string $value, 
        string $localPart
    ) {
        $this->sut->buildRefAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ag = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasOnlyRefAttribute($ag);
        self::assertSame($localPart, $ag->getRef()->getLocalPart()->getNCName());
        self::assertFalse($ag->getRef()->hasNamespace());
        self::assertSame([], $ag->getElements());
    }
    
    /**
     * Tests that buildRefAttribute() creates the attribute when:
     * - the current element is the "attributeGroup" element 
     * (attributeGroupRef), and 
     * - the value is a valid QName (local part without prefix), and 
     * - default namespace.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidLocalPartQNameTypeValues
     */
    public function testBuildRefAttributeCreatesAttrWhenAttributeGroupRefAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ) {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildAttributeGroupElement();
        $this->sut->buildAttributeGroupElement();
        $this->sut->buildRefAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['' => 'http://example.org' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        self::assertCount(1, $ag->getAttributeGroupElements());
        
        $agRef = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $agRef);
        self::assertAttributeGroupElementHasOnlyRefAttribute($agRef);
        self::assertSame($localPart, $agRef->getRef()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $agRef->getRef()->getNamespace()->getAnyUri());
        self::assertSame([], $agRef->getElements());
    }
    
    /**
     * Tests that buildRefAttribute() throws an exception when the current 
     * element is the "attributeGroup" element (attributeGroupRef) and the 
     * value is an invalid QName.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidQNameTypeValues
     */
    public function testBuildRefAttributeThrowsExceptionWhenAttributeGroupRefAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildRefAttribute($value);
    }
    
    /**
     * Tests that buildRefAttribute() creates the attribute when:
     * - the current element is the "attributeGroup" element 
     * (attributeGroupRef), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildRefAttributeCreatesAttrWhenAttributeGroupRefAndValueIsValidAndPrefixAssociatedNamespace()
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildAttributeGroupElement();
        $this->sut->buildAttributeGroupElement();
        $this->sut->buildRefAttribute('foo:bar');
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['foo' => 'http://example.org/foo' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        self::assertCount(1, $ag->getAttributeGroupElements());
        
        $agRef = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $agRef);
        self::assertAttributeGroupElementHasOnlyRefAttribute($agRef);
        self::assertSame('bar', $agRef->getRef()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $agRef->getRef()->getNamespace()->getAnyUri());
        self::assertSame([], $agRef->getElements());
    }
    
    /**
     * Tests that buildRefAttribute() throws an exception when:
     * - the current element is the "attributeGroup" element 
     * (attributeGroupRef), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is not associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildRefAttributeThrowsExceptionWhenAttributeGroupRefAndValueIsValidAndPrefixNotAssociatedNamespace()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" prefix is not bound to a namespace.');
        
        $this->sut->buildRefAttribute('foo:bar');
    }
}
