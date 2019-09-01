<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\Parser;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\Parser} class 
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_ATTRIBUTEGROUP_REF}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AttributeGroupRefParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'ag_ref';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('attributeGroup_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        
        $agRef = $ag->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $agRef
        );
        self::assertAttributeGroupElementHasNoAttribute($agRef);
        self::assertSame([], $agRef->getElements());
    }
    
    /**
     * Tests that parse() processes "id" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $id         The expected value for the ID.
     * 
     * @group           attribute
     * @dataProvider    getValidIdAttributes
     */
    public function testParseProcessIdAttribute(string $fileName, string $id)
    {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        
        $agRef = $ag->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $agRef);
        self::assertAttributeGroupElementHasOnlyIdAttribute($agRef);
        self::assertSame($id, $agRef->getId()->getId());
        self::assertSame([], $agRef->getElements());
    }
    
    /**
     * Returns a set of valid "id" attributes.
     * 
     * @return  array[]
     */
    public function getValidIdAttributes():array
    {
        return [
            'Starts with _' => [
                'attributeGroup_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'attributeGroup_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'attributeGroup_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'attributeGroup_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'attributeGroup_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'attributeGroup_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'attributeGroup_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'attributeGroup_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}
