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
}
