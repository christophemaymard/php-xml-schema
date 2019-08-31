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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_TOP_SIMPLETYPE}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TopSimpleTypeParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'top_st';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('simpleType_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $st = $sch->getSimpleTypeElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $st
        );
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertSame([], $st->getElements());
    }
    
    /**
     * Tests that parse() processes "final" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   bool    $list       The expected value for the "list" flag.
     * @param   bool    $union      The expected value for the "union" flag.
     * @param   bool    $res        The expected value for the "restriction" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidFinalAttributes
     */
    public function testParseProcessFinalAttribute(
        string $fileName,
        bool $list, 
        bool $union, 
        bool $res
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
        
        $st = $sch->getSimpleTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasOnlyFinalAttribute($st);
        self::assertSimpleTypeElementFinalAttribute($list, $union, $res, $st);
        self::assertSame([], $st->getElements());
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
        
        $st = $sch->getSimpleTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasOnlyIdAttribute($st);
        self::assertSame($id, $st->getId()->getId());
        self::assertSame([], $st->getElements());
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
        
        $st = $sch->getSimpleTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasOnlyNameAttribute($st);
        self::assertSame($name, $st->getName()->getNCName());
        self::assertSame([], $st->getElements());
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
        
        $st = $sch->getSimpleTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertCount(1, $st->getElements());
        
        $ann = $st->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that parse() processes "restriction" element (simpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessSimpleTypeRestrictionElement()
    {
        $sch = $this->sut->parse($this->getXs('restriction_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $st = $sch->getSimpleTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertCount(1, $st->getElements());
        
        $res = $st->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that parse() processes "list" element.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessListElement()
    {
        $sch = $this->sut->parse($this->getXs('list_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $st = $sch->getSimpleTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertCount(1, $st->getElements());
        
        $list = $st->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $list);
        self::assertListElementHasNoAttribute($list);
        self::assertSame([], $list->getElements());
    }
    
    /**
     * Returns a set of valid "final" attributes.
     * 
     * @return  array[]
     */
    public function getValidFinalAttributes():array
    {
        // [ $fileName, $list, $union, $restriction, ]
        return [
            'Empty string' => [
                'simpleType_final_0001.xsd', FALSE, FALSE, FALSE, 
            ], 
            'Only white spaces' => [
                'simpleType_final_0002.xsd', FALSE, FALSE, FALSE, 
            ], 
            '#all' => [
                'simpleType_final_0003.xsd', TRUE, TRUE, TRUE, 
            ], 
            'list, union and restriction with white spaces' => [
                'simpleType_final_0004.xsd', TRUE, TRUE, TRUE, 
            ], 
            'list with white spaces' => [
                'simpleType_final_0005.xsd', TRUE, FALSE, FALSE, 
            ], 
            'union with white spaces' => [
                'simpleType_final_0006.xsd', FALSE, TRUE, FALSE, 
            ], 
            'restriction with white spaces' => [
                'simpleType_final_0007.xsd', FALSE, FALSE, TRUE, 
            ], 
            'restriction and list with white spaces' => [
                'simpleType_final_0008.xsd', TRUE, FALSE, TRUE, 
            ], 
            'union and restriction with white spaces' => [
                'simpleType_final_0009.xsd', FALSE, TRUE, TRUE, 
            ], 
            'list and union with white spaces' => [
                'simpleType_final_0010.xsd', TRUE, TRUE, FALSE, 
            ], 
            'Duplicated list' => [
                'simpleType_final_0011.xsd', TRUE, FALSE, FALSE, 
            ], 
            'Duplicated union' => [
                'simpleType_final_0012.xsd', FALSE, TRUE, FALSE, 
            ], 
            'Duplicated restriction' => [
                'simpleType_final_0013.xsd', FALSE, FALSE, TRUE, 
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
                'simpleType_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'simpleType_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'simpleType_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'simpleType_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'simpleType_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'simpleType_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'simpleType_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'simpleType_id_0008.xsd', 'foo_bar', 
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
                'simpleType_name_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'simpleType_name_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'simpleType_name_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'simpleType_name_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'simpleType_name_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'simpleType_name_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'simpleType_name_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'simpleType_name_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}
