<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom\Parser;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\Parser} class 
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_TOP_COMPLEXTYPE}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NamedGroupParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName(): string
    {
        return 'named_grp';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations(): void
    {
        $sch = $this->sut->parse($this->getXs('group_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $grp = $sch->getGroupElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $grp
        );
        self::assertGroupElementHasNoAttribute($grp);
        self::assertCount(1, $grp->getElements());
        
        $all = $grp->getModelGroupElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertSame([], $all->getElements());
    }
    
    /**
     * Tests that parse() processes "all" element (anonymous).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAllElement(): void
    {
        $sch = $this->sut->parse($this->getXs('all_0002.xsd'));
        
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
        
        $all = $grp->getModelGroupElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertSame([], $all->getElements());
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
    public function testParseProcessIdAttribute(string $fileName, string $id): void
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
        self::assertGroupElementHasOnlyIdAttribute($grp);
        self::assertSame($id, $grp->getId()->getId());
        self::assertCount(1, $grp->getElements());
        
        $all = $grp->getModelGroupElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertSame([], $all->getElements());
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
    public function testParseProcessNameAttribute(string $fileName, string $name): void
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
        self::assertGroupElementHasOnlyNameAttribute($grp);
        self::assertSame($name, $grp->getName()->getNCName());
        self::assertCount(1, $grp->getElements());
        
        $all = $grp->getModelGroupElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertSame([], $all->getElements());
    }
    
    /**
     * Tests that parse() processes "annotation" element.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAnnotationElement(): void
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
        
        $grp = $sch->getGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasNoAttribute($grp);
        self::assertCount(2, $grp->getElements());
        
        $ann = $grp->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
        
        $all = $grp->getModelGroupElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertSame([], $all->getElements());
    }
    
    /**
     * Tests that parse() processes "choice" element (simpleExplicitGroup).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessChoiceElement(): void
    {
        $sch = $this->sut->parse($this->getXs('choice_0002.xsd'));
        
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
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertSame([], $choice->getElements());
    }
    
    /**
     * Tests that parse() processes "sequence" element (simpleExplicitGroup).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessSequenceElement(): void
    {
        $sch = $this->sut->parse($this->getXs('sequence_0002.xsd'));
        
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
        
        $seq = $grp->getModelGroupElement();
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertSame([], $seq->getElements());
    }
    
    /**
     * Returns a set of valid "id" attributes.
     * 
     * @return  array[]
     */
    public function getValidIdAttributes(): array
    {
        return [
            'Starts with _' => [
                'group_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'group_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'group_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'group_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'group_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'group_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'group_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'group_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "name" attributes.
     * 
     * @return  array[]
     */
    public function getValidNameAttributes(): array
    {
        return [
            'Starts with _' => [
                'group_name_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'group_name_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'group_name_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'group_name_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'group_name_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'group_name_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'group_name_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'group_name_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}
