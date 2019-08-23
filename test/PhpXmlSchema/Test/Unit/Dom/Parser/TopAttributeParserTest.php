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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_TOP_ATTRIBUTE}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TopAttributeParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'top_attribute';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('attribute_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $attr
        );
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that parse() processes "default" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $string     The expected value for the string.
     * 
     * @group           attribute
     * @dataProvider    getValidDefaultAttributes
     */
    public function testParseProcessDefaultAttribute(
        string $fileName, 
        string $string
    ) {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyDefaultAttribute($attr);
        self::assertSame($string, $attr->getDefault()->getString());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that parse() processes "fixed" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $string     The expected value for the string.
     * 
     * @group           attribute
     * @dataProvider    getValidFixedAttributes
     */
    public function testParseProcessFixedAttribute(
        string $fileName, 
        string $string
    ) {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyFixedAttribute($attr);
        self::assertSame($string, $attr->getFixed()->getString());
        self::assertSame([], $attr->getElements());
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
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyIdAttribute($attr);
        self::assertSame($id, $attr->getId()->getId());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that parse() processes "name" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $name       The expected value for the name.
     * 
     * @group           attribute
     * @dataProvider    getValidNameAttributes
     */
    public function testParseProcessNameAttribute(string $fileName, string $name)
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
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyNameAttribute($attr);
        self::assertSame($name, $attr->getName()->getNCName());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that parse() processes "type" attribute when the prefix is 
     * absent and there is no default namespace.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @dataProvider    getValidNoNamespaceTypeAttributes
     */
    public function testParseProcessTypeAttributeWhenPrefixAbsentAndNoDefaultNamespace(
        string $fileName, 
        string $localPart
    ) {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyTypeAttribute($attr);
        self::assertFalse($attr->getType()->hasNamespace());
        self::assertSame($localPart, $attr->getType()->getLocalPart()->getNCName());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that parse() processes "type" attribute.
     * 
     * @param   string      $fileName   The name of the file used for the test.
     * @param   string[]    $decls      The expected value for the namespace declarations.
     * @param   string      $namespace  The expected value for the namespace.
     * @param   string      $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @dataProvider    getValidTypeAttributes
     */
    public function testParseProcessTypeAttribute(
        string $fileName, 
        array $decls, 
        string $namespace, 
        string $localPart
    ) {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations($decls, $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasOnlyTypeAttribute($attr);
        self::assertSame($namespace, $attr->getType()->getNamespace()->getUri());
        self::assertSame($localPart, $attr->getType()->getLocalPart()->getNCName());
        self::assertSame([], $attr->getElements());
    }
    
    /**
     * Tests that parse() processes "annotation" element.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAnnotationElement()
    {
        $sch = $this->sut->parse($this->getXs('annotation_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $ann = $attr->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that parse() processes "simpleType" element (localSimpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessSimpleTypeElement()
    {
        $sch = $this->sut->parse($this->getXs('simpletype_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $st = $attr->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertSame([], $st->getElements());
    }
    
    /**
     * Returns a set of valid "default" attributes.
     * 
     * @return  array[]
     */
    public function getValidDefaultAttributes():array
    {
        return [
            'Empty string' => [
                'attribute_dflt_0001.xsd', 
                '', 
            ], 
            'Only white spaces' => [
                'attribute_dflt_0002.xsd', 
                '                  ', 
            ], 
            'Alphanumeric' => [
                'attribute_dflt_0003.xsd', 
                'foo3bar6baz9', 
            ], 
            'Alphanumeric with white spaces' => [
                'attribute_dflt_0004.xsd', 
                '  foo2    bar9   baz8    qux1  ', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "fixed" attributes.
     * 
     * @return  array[]
     */
    public function getValidFixedAttributes():array
    {
        return [
            'Empty string' => [
                'attribute_fixed_0001.xsd', 
                '', 
            ], 
            'Only white spaces' => [
                'attribute_fixed_0002.xsd', 
                '                  ', 
            ], 
            'Alphanumeric' => [
                'attribute_fixed_0003.xsd', 
                'foo3bar6baz9', 
            ], 
            'Alphanumeric with white spaces' => [
                'attribute_fixed_0004.xsd', 
                '  foo2    bar9   baz8    qux1  ', 
            ], 
        ];
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
                'attribute_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'attribute_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'attribute_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'attribute_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'attribute_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'attribute_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'attribute_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'attribute_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "name" attributes.
     * 
     * @return  array[]
     */
    public function getValidNameAttributes():array
    {
        return [
            'Starts with _' => [
                'attribute_name_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'attribute_name_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'attribute_name_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'attribute_name_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'attribute_name_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'attribute_name_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'attribute_name_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'attribute_name_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "type" attributes with no prefix and no default 
     * namespace.
     * 
     * @return  array[]
     */
    public function getValidNoNamespaceTypeAttributes():array
    {
        return [
            'Local part starts with _' => [
                'attribute_type_0001.xsd', 
                '_foo', 
            ], 
            'Local part starts with letter' => [
                'attribute_type_0002.xsd', 
                'f', 
            ], 
            'Local part contains letter' => [
                'attribute_type_0003.xsd', 
                'foo', 
            ], 
            'Local part contains digit' => [
                'attribute_type_0004.xsd', 
                'f00', 
            ], 
            'Local part contains .' => [
                'attribute_type_0005.xsd', 
                'f.bar', 
            ], 
            'Local part contains -' => [
                'attribute_type_0006.xsd', 
                'f-bar', 
            ], 
            'Local part contains _' => [
                'attribute_type_0007.xsd', 
                'f_bar', 
            ], 
            'Local part surrounded by white spaces' => [
                'attribute_type_0008.xsd', 
                'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "type" attributes.
     * 
     * @return  array[]
     */
    public function getValidTypeAttributes():array
    {
        return [
            'Prefix (absent) and bound to default namespace' => [
                'attribute_type_0009.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                'http://example.org', 
                'foo', 
            ], 
            'Prefix and local part (starts with _)' => [
                'attribute_type_0010.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                '_foo', 
            ], 
            'Prefix and local part (starts with letter)' => [
                'attribute_type_0011.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f', 
            ], 
            'Prefix and local part (contains letter)' => [
                'attribute_type_0012.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'foo', 
            ], 
            'Prefix and local part (contains digit)' => [
                'attribute_type_0013.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f00', 
            ], 
            'Prefix and local part (contains .)' => [
                'attribute_type_0014.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f.bar', 
            ], 
            'Prefix and local part (contains -)' => [
                'attribute_type_0015.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f-bar', 
            ], 
            'Prefix and local part (contains _)' => [
                'attribute_type_0016.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f_bar', 
            ], 
            'Prefix (starts with _) and local part' => [
                'attribute_type_0017.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    '_foo' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (starts with letter) and local part' => [
                'attribute_type_0018.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains letter) and local part' => [
                'attribute_type_0019.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'foo' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains digit) and local part' => [
                'attribute_type_0020.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f00' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains .) and local part' => [
                'attribute_type_0021.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f.bar' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains -) and local part' => [
                'attribute_type_0022.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f-bar' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains _) and local part' => [
                'attribute_type_0023.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f_bar' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
        ];
    }
}
