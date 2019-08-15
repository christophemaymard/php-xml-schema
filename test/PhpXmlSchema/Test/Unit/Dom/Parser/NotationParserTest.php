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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_NOTATION}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NotationParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'notation';
    }
    
    /**
     * Tests that parse() processes "id" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   bool    $id         The expected value for the ID.
     * 
     * @group           attribute
     * @dataProvider    getValidIdAttributes
     */
    public function testParseProcessIdAttribute(string $fileName, string $id)
    {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $not = $sch->getNotationElements()[0];
        self::assertNotationElementHasOnlyIdAttribute($not);
        self::assertSame($id, $not->getId()->getId());
        self::assertSame([], $not->getElements());
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
                'notation_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'notation_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'notation_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'notation_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'notation_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'notation_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'notation_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'notation_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}
