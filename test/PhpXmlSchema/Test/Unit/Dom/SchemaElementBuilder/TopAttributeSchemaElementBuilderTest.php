<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "attribute" element 
 * (topLevelAttributeType).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TopAttributeSchemaElementBuilderTest extends AbstractAttributeSchemaElementBuilderTestCase
{
    use BuildFormAttributeDoesNotCreateAttributeTestTrait;
    use BuildRefAttributeDoesNotCreateAttributeTestTrait;
    use BuildUseAttributeDoesNotCreateAttributeTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch)
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getAttributeElements());
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch)
    {
        return $sch->getAttributeElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildAttributeElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildTypeAttribute() creates the attribute when:
     * - the current element is the "attribute" element 
     * (topLevelAttributeType), and 
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
    public function testBuildTypeAttributeCreatesAttrWhenTopAttributeAndValueIsValidQNameLocalPartAndDefaultNamespace(
        string $value, 
        string $localPart
    ) {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('', 'http://example.org');
        $this->sut->buildAttributeElement();
        $this->sut->buildTypeAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['' => 'http://example.org' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getAttributeElements());
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyTypeAttribute($attr);
        self::assertSame($localPart, $attr->getType()->getLocalPart()->getNCName());
        self::assertSame('http://example.org', $attr->getType()->getNamespace()->getAnyUri());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that buildTypeAttribute() creates the attribute when:
     * - the current element is the "attribute" element 
     * (topLevelAttributeType), and 
     * - the value is a valid QName (local part with prefix), and 
     * - the prefix is associated to a namespace.
     * 
     * @group   attribute
     * @group   parsing
     */
    public function testBuildTypeAttributeCreatesAttrWhenTopAttributeAndValueIsValidAndPrefixAssociatedNamespace()
    {
        $this->sut->buildSchemaElement();
        $this->sut->bindNamespace('foo', 'http://example.org/foo');
        $this->sut->buildAttributeElement();
        $this->sut->buildTypeAttribute('foo:bar');
        $sch = $this->sut->getSchema();
        
        self::assertElementNamespaceDeclarations(['foo' => 'http://example.org/foo' ], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getAttributeElements());
        
        $attr = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyTypeAttribute($attr);
        self::assertSame('bar', $attr->getType()->getLocalPart()->getNCName());
        self::assertSame('http://example.org/foo', $attr->getType()->getNamespace()->getAnyUri());
        self::assertSame([], $attr->getElements());
    }
}
