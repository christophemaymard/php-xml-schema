<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\ElementInterface;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Exception\InvalidOperationException;
use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Test\Unit\Dom\FormChoiceTypeProviderTrait;
use PhpXmlSchema\Test\Unit\Dom\UseTypeProviderTrait;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "attribute" element (attribute).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AttributeSchemaElementBuilderTest extends AbstractAttributeSchemaElementBuilderTestCase
{
    use FormChoiceTypeProviderTrait;
    use UseTypeProviderTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch): void
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        self::assertCount(1, $ag->getAttributeElements());
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch): ?ElementInterface
    {
        return $sch->getAttributeGroupElements()[0]
            ->getAttributeElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildAttributeGroupElement();
        $this->sut->buildAttributeElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildFormAttribute() creates the attribute when the current 
     * element is the "attribute" element (attribute) and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $qual   The expected value for the "qualified flag.
     * @param   bool    $unqual The expected value for the "unqualified flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidFormChoiceTypeValues
     */
    public function testBuildFormAttributeCreatesAttrWhenAttributeAndValueIsValid(
        string $value, 
        bool $qual, 
        bool $unqual
    ): void
    {
        $this->sut->buildFormAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyFormAttribute($attr);
        self::assertSame($qual, $attr->getForm()->isQualified());
        self::assertSame($unqual, $attr->getForm()->isUnqualified());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildFormAttribute() throws an exception when the current 
     * element is the "attribute" element (attribute) and the value is 
     * invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidFormChoiceTypeValues
     */
    public function testBuildFormAttributeThrowsExceptionWhenAttributeAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            '"'.$value.'" is an invalid formChoice type, expected "qualified" or "unqualified".'
        );
        $this->sut->buildFormAttribute($value);
    }
    
    /**
     * Tests that buildRefAttribute() creates the attribute when:
     * - the current element is the "attribute" element (attribute), and 
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
    public function testBuildRefAttributeCreatesAttrWhenAttributeAndValueIsValidQNameLocalPartAndNoDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildRefAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyRefAttribute($attr);
        self::assertSame($localPart, $attr->getRef()->getLocalPart()->getNCName());
        self::assertFalse($attr->getRef()->hasNamespace());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildRefAttribute() creates the attribute when:
     * - the current element is the "attribute" element (attribute), and 
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
    public function testBuildRefAttributeCreatesAttrWhenAttributeAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildAttributeGroupElement();
        $this->sut->buildAttributeElement();
        $this->sut->buildRefAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['' => 'http://example.org' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        self::assertCount(1, $ag->getAttributeElements());
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyRefAttribute($attr);
        self::assertSame($localPart, $attr->getRef()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $attr->getRef()->getNamespace()->getAnyUri());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildRefAttribute() throws an exception when the current 
     * element is the "attribute" element (attribute) and the value is an 
     * invalid QName.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidQNameTypeValues
     */
    public function testBuildRefAttributeThrowsExceptionWhenAttributeAndValueIsInvalid(
        string $value, 
        string $message
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildRefAttribute($value);
    }
    
    /**
     * Tests that buildRefAttribute() creates the attribute when:
     * - the current element is the "attribute" element (attribute), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildRefAttributeCreatesAttrWhenAttributeAndValueIsValidAndPrefixAssociatedNamespace(): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildAttributeGroupElement();
        $this->sut->buildAttributeElement();
        $this->sut->buildRefAttribute('foo:bar');
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['foo' => 'http://example.org/foo' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        self::assertCount(1, $ag->getAttributeElements());
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyRefAttribute($attr);
        self::assertSame('bar', $attr->getRef()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $attr->getRef()->getNamespace()->getAnyUri());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildRefAttribute() throws an exception when:
     * - the current element is the "attribute" element (attribute), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is not associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildRefAttributeThrowsExceptionWhenAttributeAndValueIsValidAndPrefixNotAssociatedNamespace(): void
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The "foo" prefix is not bound to a namespace.');
        
        $this->sut->buildRefAttribute('foo:bar');
    }
    
    /**
     * Tests that buildTypeAttribute() creates the attribute when:
     * - the current element is the "attribute" element (attribute), and 
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
    public function testBuildTypeAttributeCreatesAttrWhenAttributeAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildAttributeGroupElement();
        $this->sut->buildAttributeElement();
        $this->sut->buildTypeAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['' => 'http://example.org' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        self::assertCount(1, $ag->getAttributeElements());
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyTypeAttribute($attr);
        self::assertSame($localPart, $attr->getType()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $attr->getType()->getNamespace()->getAnyUri());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildTypeAttribute() creates the attribute when:
     * - the current element is the "attribute" element (attribute), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildTypeAttributeCreatesAttrWhenAttributeAndValueIsValidAndPrefixAssociatedNamespace(): void
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildAttributeGroupElement();
        $this->sut->buildAttributeElement();
        $this->sut->buildTypeAttribute('foo:bar');
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['foo' => 'http://example.org/foo' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        self::assertCount(1, $ag->getAttributeElements());
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyTypeAttribute($attr);
        self::assertSame('bar', $attr->getType()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $attr->getType()->getNamespace()->getAnyUri());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildUseAttribute() creates the attribute when the current 
     * element is the "attribute" element (attribute) and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $opt    The expected value for the "optional" flag.
     * @param   bool    $proh   The expected value for the "prohibited" flag.
     * @param   bool    $req    The expected value for the "required" flag.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidUseTypeValues
     */
    public function testBuildUseAttributeCreatesAttrWhenAttributeAndValueIsValid(
        string $value, 
        bool $opt, 
        bool $proh, 
        bool $req
    ): void
    {
        $this->sut->buildUseAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyUseAttribute($attr);
        self::assertSame($opt, $attr->getUse()->isOptional());
        self::assertSame($proh, $attr->getUse()->isProhibited());
        self::assertSame($req, $attr->getUse()->isRequired());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildUseAttribute() throws an exception when the current 
     * element is the "attribute" element (attribute) and the value is 
     * invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidUseTypeValues
     */
    public function testBuildUseAttributeThrowsExceptionWhenAttributeAndValueIsInvalid(
        string $value
    ): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf(
            '"%s" is an invalid use type, expected "optional", "prohibited" '.
            'or "required".', 
            $value
        ));
        
        $this->sut->buildUseAttribute($value);
    }
}
