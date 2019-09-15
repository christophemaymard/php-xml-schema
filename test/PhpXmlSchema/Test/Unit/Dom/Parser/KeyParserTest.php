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
        
        $ct1 = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct1);
        self::assertComplexTypeElementHasNoAttribute($ct1);
        self::assertCount(1, $ct1->getElements());
        
        $cc = $ct1->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $resElt = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $resElt);
        self::assertComplexContentRestrictionElementHasNoAttribute($resElt);
        self::assertCount(1, $resElt->getElements());
        
        $all = $resElt->getTypeDefinitionParticleElement();
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
        self::assertKeyElementHasOnlyIdAttribute($key);
        self::assertSame($id, $key->getId()->getId());
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
        self::assertKeyElementHasOnlyNameAttribute($key);
        self::assertSame($name, $key->getName()->getNCName());
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
     * Returns a set of valid "id" attributes.
     * 
     * @return  array[]
     */
    public function getValidIdAttributes():array
    {
        return [
            'Starts with _' => [
                'key_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'key_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'key_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'key_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'key_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'key_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'key_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'key_id_0008.xsd', 'foo_bar', 
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
                'key_name_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'key_name_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'key_name_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'key_name_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'key_name_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'key_name_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'key_name_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'key_name_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}
