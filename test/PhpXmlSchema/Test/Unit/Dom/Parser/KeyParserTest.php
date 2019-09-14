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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_KEY}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class KeyParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'key';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('key_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct1 = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct1);
        self::assertComplexTypeElementHasNoAttribute($ct1);
        self::assertCount(1, $ct1->getElements());
        
        $cc = $ct1->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertCount(1, $all->getElements());
        
        $elt1 = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt1);
        self::assertElementElementHasNoAttribute($elt1);
        self::assertCount(1, $elt1->getElements());
        
        $ct2 = $elt1->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct2);
        self::assertComplexTypeElementHasNoAttribute($ct2);
        self::assertCount(1, $ct2->getElements());
        
        $choice = $ct2->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(1, $choice->getElements());
        
        $elt2 = $choice->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt2);
        self::assertElementElementHasNoAttribute($elt2);
        self::assertCount(1, $elt2->getElements());
        
        $key = $elt2->getKeyElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $key
        );
        self::assertKeyElementHasNoAttribute($key);
        self::assertCount(2, $key->getElements());
        
        $sel = $key->getSelectorElement();
        self::assertElementNamespaceDeclarations([], $sel);
        self::assertSelectorElementHasNoAttribute($sel);
        self::assertSame([], $sel->getElements());
        
        $field = $key->getFieldElements()[0];
        self::assertElementNamespaceDeclarations([], $field);
        self::assertFieldElementHasNoAttribute($field);
        self::assertSame([], $field->getElements());
    }
    
    /**
     * Tests that parse() processes "selector" element.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessSelectorElement()
    {
        $sch = $this->sut->parse($this->getXs('selector_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct1 = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct1);
        self::assertComplexTypeElementHasNoAttribute($ct1);
        self::assertCount(1, $ct1->getElements());
        
        $cc = $ct1->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertCount(1, $all->getElements());
        
        $elt1 = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt1);
        self::assertElementElementHasNoAttribute($elt1);
        self::assertCount(1, $elt1->getElements());
        
        $ct2 = $elt1->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct2);
        self::assertComplexTypeElementHasNoAttribute($ct2);
        self::assertCount(1, $ct2->getElements());
        
        $choice = $ct2->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(1, $choice->getElements());
        
        $elt2 = $choice->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt2);
        self::assertElementElementHasNoAttribute($elt2);
        self::assertCount(1, $elt2->getElements());
        
        $key = $elt2->getKeyElements()[0];
        self::assertElementNamespaceDeclarations([], $key);
        self::assertKeyElementHasNoAttribute($key);
        self::assertCount(2, $key->getElements());
        
        $sel = $key->getSelectorElement();
        self::assertElementNamespaceDeclarations([], $sel);
        self::assertSelectorElementHasNoAttribute($sel);
        self::assertSame([], $sel->getElements());
        
        $field = $key->getFieldElements()[0];
        self::assertElementNamespaceDeclarations([], $field);
        self::assertFieldElementHasNoAttribute($field);
        self::assertSame([], $field->getElements());
    }
    
    /**
     * Tests that parse() processes "field" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessFieldElement()
    {
        $sch = $this->sut->parse($this->getXs('field_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct1 = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct1);
        self::assertComplexTypeElementHasNoAttribute($ct1);
        self::assertCount(1, $ct1->getElements());
        
        $cc = $ct1->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertCount(1, $all->getElements());
        
        $elt1 = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt1);
        self::assertElementElementHasNoAttribute($elt1);
        self::assertCount(1, $elt1->getElements());
        
        $ct2 = $elt1->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct2);
        self::assertComplexTypeElementHasNoAttribute($ct2);
        self::assertCount(1, $ct2->getElements());
        
        $choice = $ct2->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(1, $choice->getElements());
        
        $elt2 = $choice->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt2);
        self::assertElementElementHasNoAttribute($elt2);
        self::assertCount(1, $elt2->getElements());
        
        $key = $elt2->getKeyElements()[0];
        self::assertElementNamespaceDeclarations([], $key);
        self::assertKeyElementHasNoAttribute($key);
        self::assertCount(3, $key->getElements());
        
        $sel = $key->getSelectorElement();
        self::assertElementNamespaceDeclarations([], $sel);
        self::assertSelectorElementHasNoAttribute($sel);
        self::assertSame([], $sel->getElements());
        
        $fields = $key->getFieldElements();
        
        self::assertElementNamespaceDeclarations([], $fields[0]);
        self::assertFieldElementHasNoAttribute($fields[0]);
        self::assertSame([], $fields[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $fields[1]);
        self::assertFieldElementHasNoAttribute($fields[1]);
        self::assertSame([], $fields[1]->getElements());
    }
}
