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
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
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
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
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
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
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
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
        self::assertAttributeElementHasOnlyNameAttribute($attr);
        self::assertSame($name, $attr->getName()->getNCName());
        self::assertSame([], $attr->getElements());
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
}
