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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_SIMPLE_CHOICE}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleChoiceParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'simple_choice';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('choice_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $grp = $sch->getGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasNoAttribute($grp);
        self::assertCount(1, $grp->getElements());
        
        $choice = $grp->getModelGroupElement();
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $choice
        );
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertSame([], $choice->getElements());
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
        
        $grp = $sch->getGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasNoAttribute($grp);
        self::assertCount(1, $grp->getElements());
        
        $choice = $grp->getModelGroupElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasOnlyIdAttribute($choice);
        self::assertSame($id, $choice->getId()->getId());
        self::assertSame([], $choice->getElements());
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
                'choice_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'choice_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'choice_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'choice_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'choice_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'choice_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'choice_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'choice_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}