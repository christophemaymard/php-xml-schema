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
    protected function getContextName(): string
    {
        return 'simple_choice';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations(): void
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
        self::assertGroupElementHasNoAttribute($grp);
        self::assertCount(1, $grp->getElements());
        
        $choice = $grp->getModelGroupElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasOnlyIdAttribute($choice);
        self::assertSame($id, $choice->getId()->getId());
        self::assertSame([], $choice->getElements());
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
        self::assertCount(1, $grp->getElements());
        
        $choice = $grp->getModelGroupElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(1, $choice->getElements());
        
        $ann = $choice->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that parse() processes "element" elements (localElement).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessElementElement(): void
    {
        $sch = $this->sut->parse($this->getXs('element_0002.xsd'));
        
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
        self::assertCount(2, $choice->getElements());
        
        $elts = $choice->getElementElements();
        
        self::assertElementNamespaceDeclarations([], $elts[0]);
        self::assertElementElementHasNoAttribute($elts[0]);
        self::assertSame([], $elts[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $elts[1]);
        self::assertElementElementHasNoAttribute($elts[1]);
        self::assertSame([], $elts[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "group" elements (groupRef).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessGroupElement(): void
    {
        $sch = $this->sut->parse($this->getXs('group_0002.xsd'));
        
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
        self::assertCount(2, $choice->getElements());
        
        $grps = $choice->getGroupElements();
        
        self::assertElementNamespaceDeclarations([], $grps[0]);
        self::assertGroupElementHasNoAttribute($grps[0]);
        self::assertSame([], $grps[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $grps[1]);
        self::assertGroupElementHasNoAttribute($grps[1]);
        self::assertSame([], $grps[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "choice" elements (explicitGroup).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessChoiceElement(): void
    {
        $sch = $this->sut->parse($this->getXs('choice_explicit_0002.xsd'));
        
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
        self::assertCount(2, $choice->getElements());
        
        $choices = $choice->getChoiceElements();
        
        self::assertElementNamespaceDeclarations([], $choices[0]);
        self::assertChoiceElementHasNoAttribute($choices[0]);
        self::assertSame([], $choices[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $choices[1]);
        self::assertChoiceElementHasNoAttribute($choices[1]);
        self::assertSame([], $choices[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "sequence" elements (explicitGroup).
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
        
        $choice = $grp->getModelGroupElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(2, $choice->getElements());
        
        $seqs = $choice->getSequenceElements();
        
        self::assertElementNamespaceDeclarations([], $seqs[0]);
        self::assertSequenceElementHasNoAttribute($seqs[0]);
        self::assertSame([], $seqs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $seqs[1]);
        self::assertSequenceElementHasNoAttribute($seqs[1]);
        self::assertSame([], $seqs[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "any" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAnyElement(): void
    {
        $sch = $this->sut->parse($this->getXs('any_0002.xsd'));
        
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
        self::assertCount(2, $choice->getElements());
        
        $anys = $choice->getAnyElements();
        
        self::assertElementNamespaceDeclarations([], $anys[0]);
        self::assertAnyElementHasNoAttribute($anys[0]);
        self::assertSame([], $anys[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $anys[1]);
        self::assertAnyElementHasNoAttribute($anys[1]);
        self::assertSame([], $anys[1]->getElements());
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
