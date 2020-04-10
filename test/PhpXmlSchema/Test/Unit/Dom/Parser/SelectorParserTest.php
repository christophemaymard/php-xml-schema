<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\Parser;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\Parser} class 
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_SELECTOR}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SelectorParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'selector';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('selector_0006.xsd'));
        
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
        
        $unique = $elt2->getUniqueElements()[0];
        self::assertElementNamespaceDeclarations([], $unique);
        self::assertUniqueElementHasNoAttribute($unique);
        self::assertCount(2, $unique->getElements());
        
        $sel = $unique->getSelectorElement();
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $sel
        );
        self::assertSelectorElementHasNoAttribute($sel);
        self::assertSame([], $sel->getElements());
        
        $field = $unique->getFieldElements()[0];
        self::assertElementNamespaceDeclarations([], $field);
        self::assertFieldElementHasNoAttribute($field);
        self::assertSame([], $field->getElements());
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
        
        $unique = $elt2->getUniqueElements()[0];
        self::assertElementNamespaceDeclarations([], $unique);
        self::assertUniqueElementHasNoAttribute($unique);
        self::assertCount(2, $unique->getElements());
        
        $sel = $unique->getSelectorElement();
        self::assertElementNamespaceDeclarations([], $sel);
        self::assertSelectorElementHasOnlyIdAttribute($sel);
        self::assertSame($id, $sel->getId()->getId());
        self::assertSame([], $sel->getElements());
        
        $field = $unique->getFieldElements()[0];
        self::assertElementNamespaceDeclarations([], $field);
        self::assertFieldElementHasNoAttribute($field);
        self::assertSame([], $field->getElements());
    }
    
    /**
     * Tests that parse() processes "xpath" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $expr       The expected value for the XPath expression.
     * 
     * @group           attribute
     * @dataProvider    getValidXpathAttributes
     */
    public function testParseProcessXPathAttribute(string $fileName, string $expr)
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
        
        $unique = $elt2->getUniqueElements()[0];
        self::assertElementNamespaceDeclarations([], $unique);
        self::assertUniqueElementHasNoAttribute($unique);
        self::assertCount(2, $unique->getElements());
        
        $sel = $unique->getSelectorElement();
        self::assertElementNamespaceDeclarations([], $sel);
        self::assertSelectorElementHasOnlyXPathAttribute($sel);
        self::assertSame($expr, $sel->getXPath()->getXPath());
        self::assertSame([], $sel->getElements());
        
        $field = $unique->getFieldElements()[0];
        self::assertElementNamespaceDeclarations([], $field);
        self::assertFieldElementHasNoAttribute($field);
        self::assertSame([], $field->getElements());
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
        
        $unique = $elt2->getUniqueElements()[0];
        self::assertElementNamespaceDeclarations([], $unique);
        self::assertUniqueElementHasNoAttribute($unique);
        self::assertCount(2, $unique->getElements());
        
        $sel = $unique->getSelectorElement();
        self::assertElementNamespaceDeclarations([], $sel);
        self::assertSelectorElementHasNoAttribute($sel);
        self::assertCount(1, $sel->getElements());
        
        $ann = $sel->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
        
        $field = $unique->getFieldElements()[0];
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
                'selector_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'selector_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'selector_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'selector_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'selector_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'selector_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'selector_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'selector_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "xpath" attributes.
     * 
     * @return  array[]
     */
    public function getValidXpathAttributes():array
    {
        return [
            '1 path (1 step .)' => [
                'selector_xpath_0001.xsd', 
                '.', 
            ], 
            '1 path (1 step QName)' => [
                'selector_xpath_0002.xsd', 
                'q1:name1', 
            ], 
            '1 path (1 step *)' => [
                'selector_xpath_0003.xsd', 
                '*', 
            ], 
            '1 path (1 step NCName:*)' => [
                'selector_xpath_0004.xsd', 
                'n1:*', 
            ], 
            '1 path (1 step child::QName)' => [
                'selector_xpath_0005.xsd', 
                'child::q1:name1', 
            ], 
            '1 path (1 step child::*)' => [
                'selector_xpath_0006.xsd', 
                'child::*', 
            ], 
            '1 path (1 step child::NCName:*)' => [
                'selector_xpath_0007.xsd', 
                'child::n1:*', 
            ], 
            '1 path (1 step . and 1 step . separated by /)' => [
                'selector_xpath_0008.xsd', 
                './.', 
            ], 
            '1 path (1 step . and 1 step QName separated by /)' => [
                'selector_xpath_0009.xsd', 
                './q2:name2', 
            ], 
            '1 path (1 step . and 1 step * separated by /)' => [
                'selector_xpath_0010.xsd', 
                './*', 
            ], 
            '1 path (1 step . and 1 step NCName:* separated by /)' => [
                'selector_xpath_0011.xsd', 
                './n2:*', 
            ], 
            '1 path (1 step . and 1 step child::QName separated by /)' => [
                'selector_xpath_0012.xsd', 
                './child::q2:name2', 
            ], 
            '1 path (1 step . and 1 step child::* separated by /)' => [
                'selector_xpath_0013.xsd', 
                './child::*', 
            ], 
            '1 path (1 step . and 1 step child::NCName:* separated by /)' => [
                'selector_xpath_0014.xsd', 
                './child::n2:*', 
            ], 
            '1 path (1 step QName and 1 step . separated by /)' => [
                'selector_xpath_0015.xsd', 
                'q1:name1/.', 
            ], 
            '1 path (1 step QName and 1 step QName separated by /)' => [
                'selector_xpath_0016.xsd', 
                'q1:name1/q2:name2', 
            ], 
            '1 path (1 step QName and 1 step * separated by /)' => [
                'selector_xpath_0017.xsd', 
                'q1:name1/*', 
            ], 
            '1 path (1 step QName and 1 step NCName:* separated by /)' => [
                'selector_xpath_0018.xsd', 
                'q1:name1/n2:*', 
            ], 
            '1 path (1 step QName and 1 step child::QName separated by /)' => [
                'selector_xpath_0019.xsd', 
                'q1:name1/child::q2:name2', 
            ], 
            '1 path (1 step QName and 1 step child::* separated by /)' => [
                'selector_xpath_0020.xsd', 
                'q1:name1/child::*', 
            ], 
            '1 path (1 step QName and 1 step child::NCName:* separated by /)' => [
                'selector_xpath_0021.xsd', 
                'q1:name1/child::n2:*', 
            ], 
            '1 path (1 step * and 1 step . separated by /)' => [
                'selector_xpath_0022.xsd', 
                '*/.', 
            ], 
            '1 path (1 step * and 1 step QName separated by /)' => [
                'selector_xpath_0023.xsd', 
                '*/q2:name2', 
            ], 
            '1 path (1 step * and 1 step * separated by /)' => [
                'selector_xpath_0024.xsd', 
                '*/*', 
            ], 
            '1 path (1 step * and 1 step NCName:* separated by /)' => [
                'selector_xpath_0025.xsd', 
                '*/n2:*', 
            ], 
            '1 path (1 step * and 1 step child::QName separated by /)' => [
                'selector_xpath_0026.xsd', 
                '*/child::q2:name2', 
            ], 
            '1 path (1 step * and 1 step child::* separated by /)' => [
                'selector_xpath_0027.xsd', 
                '*/child::*', 
            ], 
            '1 path (1 step * and 1 step child::NCName:* separated by /)' => [
                'selector_xpath_0028.xsd', 
                '*/child::n2:*', 
            ], 
            '1 path (1 step NCName:* and 1 step . separated by /)' => [
                'selector_xpath_0029.xsd', 
                'n1:*/.', 
            ], 
            '1 path (1 step NCName:* and 1 step QName separated by /)' => [
                'selector_xpath_0030.xsd', 
                'n1:*/q2:name2', 
            ], 
            '1 path (1 step NCName:* and 1 step * separated by /)' => [
                'selector_xpath_0031.xsd', 
                'n1:*/*', 
            ], 
            '1 path (1 step NCName:* and 1 step NCName:* separated by /)' => [
                'selector_xpath_0032.xsd', 
                'n1:*/n2:*', 
            ], 
            '1 path (1 step NCName:* and 1 step child::QName separated by /)' => [
                'selector_xpath_0033.xsd', 
                'n1:*/child::q2:name2', 
            ], 
            '1 path (1 step NCName:* and 1 step child::* separated by /)' => [
                'selector_xpath_0034.xsd', 
                'n1:*/child::*', 
            ], 
            '1 path (1 step NCName:* and 1 step child::NCName:* separated by /)' => [
                'selector_xpath_0035.xsd', 
                'n1:*/child::n2:*', 
            ], 
            '1 path (1 step child::QName and 1 step . separated by /)' => [
                'selector_xpath_0036.xsd', 
                'child::q1:name1/.', 
            ], 
            '1 path (1 step child::QName and 1 step QName separated by /)' => [
                'selector_xpath_0037.xsd', 
                'child::q1:name1/q2:name2', 
            ], 
            '1 path (1 step child::QName and 1 step * separated by /)' => [
                'selector_xpath_0038.xsd', 
                'child::q1:name1/*', 
            ], 
            '1 path (1 step child::QName and 1 step NCName:* separated by /)' => [
                'selector_xpath_0039.xsd', 
                'child::q1:name1/n2:*', 
            ], 
            '1 path (1 step child::QName and 1 step child::QName separated by /)' => [
                'selector_xpath_0040.xsd', 
                'child::q1:name1/child::q2:name2', 
            ], 
            '1 path (1 step child::QName and 1 step child::* separated by /)' => [
                'selector_xpath_0041.xsd', 
                'child::q1:name1/child::*', 
            ], 
            '1 path (1 step child::QName and 1 step child::NCName:* separated by /)' => [
                'selector_xpath_0042.xsd', 
                'child::q1:name1/child::n2:*', 
            ], 
            '1 path (1 step child::* and 1 step . separated by /)' => [
                'selector_xpath_0043.xsd', 
                'child::*/.', 
            ], 
            '1 path (1 step child::* and 1 step QName separated by /)' => [
                'selector_xpath_0044.xsd', 
                'child::*/q2:name2', 
            ], 
            '1 path (1 step child::* and 1 step * separated by /)' => [
                'selector_xpath_0045.xsd', 
                'child::*/*', 
            ], 
            '1 path (1 step child::* and 1 step NCName:* separated by /)' => [
                'selector_xpath_0046.xsd', 
                'child::*/n2:*', 
            ], 
            '1 path (1 step child::* and 1 step child::QName separated by /)' => [
                'selector_xpath_0047.xsd', 
                'child::*/child::q2:name2', 
            ], 
            '1 path (1 step child::* and 1 step child::* separated by /)' => [
                'selector_xpath_0048.xsd', 
                'child::*/child::*', 
            ], 
            '1 path (1 step child::* and 1 step child::NCName:* separated by /)' => [
                'selector_xpath_0049.xsd', 
                'child::*/child::n2:*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step . separated by /)' => [
                'selector_xpath_0050.xsd', 
                'child::n1:*/.', 
            ], 
            '1 path (1 step child::NCName:* and 1 step QName separated by /)' => [
                'selector_xpath_0051.xsd', 
                'child::n1:*/q2:name2', 
            ], 
            '1 path (1 step child::NCName:* and 1 step * separated by /)' => [
                'selector_xpath_0052.xsd', 
                'child::n1:*/*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step NCName:* separated by /)' => [
                'selector_xpath_0053.xsd', 
                'child::n1:*/n2:*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step child::QName separated by /)' => [
                'selector_xpath_0054.xsd', 
                'child::n1:*/child::q2:name2', 
            ], 
            '1 path (1 step child::NCName:* and 1 step child::* separated by /)' => [
                'selector_xpath_0055.xsd', 
                'child::n1:*/child::*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step child::NCName:* separated by /)' => [
                'selector_xpath_0056.xsd', 
                'child::n1:*/child::n2:*', 
            ], 
            '1 path (1 step .) starts with .//' => [
                'selector_xpath_0057.xsd', 
                './/.', 
            ], 
            '1 path (1 step QName) starts with .//' => [
                'selector_xpath_0058.xsd', 
                './/q1:name1', 
            ], 
            '1 path (1 step *) starts with .//' => [
                'selector_xpath_0059.xsd', 
                './/*', 
            ], 
            '1 path (1 step NCName:*) starts with .//' => [
                'selector_xpath_0060.xsd', 
                './/n1:*', 
            ], 
            '1 path (1 step child::QName) starts with .//' => [
                'selector_xpath_0061.xsd', 
                './/child::q1:name1', 
            ], 
            '1 path (1 step child::*) starts with .//' => [
                'selector_xpath_0062.xsd', 
                './/child::*', 
            ], 
            '1 path (1 step child::NCName:*) starts with .//' => [
                'selector_xpath_0063.xsd', 
                './/child::n1:*', 
            ], 
            '1 path (1 step . and 1 step . separated by /) starts with .//' => [
                'selector_xpath_0064.xsd', 
                './/./.', 
            ], 
            '1 path (1 step . and 1 step QName separated by /) starts with .//' => [
                'selector_xpath_0065.xsd', 
                './/./q2:name2', 
            ], 
            '1 path (1 step . and 1 step * separated by /) starts with .//' => [
                'selector_xpath_0066.xsd', 
                './/./*', 
            ], 
            '1 path (1 step . and 1 step NCName:* separated by /) starts with .//' => [
                'selector_xpath_0067.xsd', 
                './/./n2:*', 
            ], 
            '1 path (1 step . and 1 step child::QName separated by /) starts with .//' => [
                'selector_xpath_0068.xsd', 
                './/./child::q2:name2', 
            ], 
            '1 path (1 step . and 1 step child::* separated by /) starts with .//' => [
                'selector_xpath_0069.xsd', 
                './/./child::*', 
            ], 
            '1 path (1 step . and 1 step child::NCName:* separated by /) starts with .//' => [
                'selector_xpath_0070.xsd', 
                './/./child::n2:*', 
            ], 
            '1 path (1 step QName and 1 step . separated by /) starts with .//' => [
                'selector_xpath_0071.xsd', 
                './/q1:name1/.', 
            ], 
            '1 path (1 step QName and 1 step QName separated by /) starts with .//' => [
                'selector_xpath_0072.xsd', 
                './/q1:name1/q2:name2', 
            ], 
            '1 path (1 step QName and 1 step * separated by /) starts with .//' => [
                'selector_xpath_0073.xsd', 
                './/q1:name1/*', 
            ], 
            '1 path (1 step QName and 1 step NCName:* separated by /) starts with .//' => [
                'selector_xpath_0074.xsd', 
                './/q1:name1/n2:*', 
            ], 
            '1 path (1 step QName and 1 step child::QName separated by /) starts with .//' => [
                'selector_xpath_0075.xsd', 
                './/q1:name1/child::q2:name2', 
            ], 
            '1 path (1 step QName and 1 step child::* separated by /) starts with .//' => [
                'selector_xpath_0076.xsd', 
                './/q1:name1/child::*', 
            ], 
            '1 path (1 step QName and 1 step child::NCName:* separated by /) starts with .//' => [
                'selector_xpath_0077.xsd', 
                './/q1:name1/child::n2:*', 
            ], 
            '1 path (1 step * and 1 step . separated by /) starts with .//' => [
                'selector_xpath_0078.xsd', 
                './/*/.', 
            ], 
            '1 path (1 step * and 1 step QName separated by /) starts with .//' => [
                'selector_xpath_0079.xsd', 
                './/*/q2:name2', 
            ], 
            '1 path (1 step * and 1 step * separated by /) starts with .//' => [
                'selector_xpath_0080.xsd', 
                './/*/*', 
            ], 
            '1 path (1 step * and 1 step NCName:* separated by /) starts with .//' => [
                'selector_xpath_0081.xsd', 
                './/*/n2:*', 
            ], 
            '1 path (1 step * and 1 step child::QName separated by /) starts with .//' => [
                'selector_xpath_0082.xsd', 
                './/*/child::q2:name2', 
            ], 
            '1 path (1 step * and 1 step child::* separated by /) starts with .//' => [
                'selector_xpath_0083.xsd', 
                './/*/child::*', 
            ], 
            '1 path (1 step * and 1 step child::NCName:* separated by /) starts with .//' => [
                'selector_xpath_0084.xsd', 
                './/*/child::n2:*', 
            ], 
            '1 path (1 step NCName:* and 1 step . separated by /) starts with .//' => [
                'selector_xpath_0085.xsd', 
                './/n1:*/.', 
            ], 
            '1 path (1 step NCName:* and 1 step QName separated by /) starts with .//' => [
                'selector_xpath_0086.xsd', 
                './/n1:*/q2:name2', 
            ], 
            '1 path (1 step NCName:* and 1 step * separated by /) starts with .//' => [
                'selector_xpath_0087.xsd', 
                './/n1:*/*', 
            ], 
            '1 path (1 step NCName:* and 1 step NCName:* separated by /) starts with .//' => [
                'selector_xpath_0088.xsd', 
                './/n1:*/n2:*', 
            ], 
            '1 path (1 step NCName:* and 1 step child::QName separated by /) starts with .//' => [
                'selector_xpath_0089.xsd', 
                './/n1:*/child::q2:name2', 
            ], 
            '1 path (1 step NCName:* and 1 step child::* separated by /) starts with .//' => [
                'selector_xpath_0090.xsd', 
                './/n1:*/child::*', 
            ], 
            '1 path (1 step NCName:* and 1 step child::NCName:* separated by /) starts with .//' => [
                'selector_xpath_0091.xsd', 
                './/n1:*/child::n2:*', 
            ], 
            '1 path (1 step child::QName and 1 step . separated by /) starts with .//' => [
                'selector_xpath_0092.xsd', 
                './/child::q1:name1/.', 
            ], 
            '1 path (1 step child::QName and 1 step QName separated by /) starts with .//' => [
                'selector_xpath_0093.xsd', 
                './/child::q1:name1/q2:name2', 
            ], 
            '1 path (1 step child::QName and 1 step * separated by /) starts with .//' => [
                'selector_xpath_0094.xsd', 
                './/child::q1:name1/*', 
            ], 
            '1 path (1 step child::QName and 1 step NCName:* separated by /) starts with .//' => [
                'selector_xpath_0095.xsd', 
                './/child::q1:name1/n2:*', 
            ], 
            '1 path (1 step child::QName and 1 step child::QName separated by /) starts with .//' => [
                'selector_xpath_0096.xsd', 
                './/child::q1:name1/child::q2:name2', 
            ], 
            '1 path (1 step child::QName and 1 step child::* separated by /) starts with .//' => [
                'selector_xpath_0097.xsd', 
                './/child::q1:name1/child::*', 
            ], 
            '1 path (1 step child::QName and 1 step child::NCName:* separated by /) starts with .//' => [
                'selector_xpath_0098.xsd', 
                './/child::q1:name1/child::n2:*', 
            ], 
            '1 path (1 step child::* and 1 step . separated by /) starts with .//' => [
                'selector_xpath_0099.xsd', 
                './/child::*/.', 
            ], 
            '1 path (1 step child::* and 1 step QName separated by /) starts with .//' => [
                'selector_xpath_0100.xsd', 
                './/child::*/q2:name2', 
            ], 
            '1 path (1 step child::* and 1 step * separated by /) starts with .//' => [
                'selector_xpath_0101.xsd', 
                './/child::*/*', 
            ], 
            '1 path (1 step child::* and 1 step NCName:* separated by /) starts with .//' => [
                'selector_xpath_0102.xsd', 
                './/child::*/n2:*', 
            ], 
            '1 path (1 step child::* and 1 step child::QName separated by /) starts with .//' => [
                'selector_xpath_0103.xsd', 
                './/child::*/child::q2:name2', 
            ], 
            '1 path (1 step child::* and 1 step child::* separated by /) starts with .//' => [
                'selector_xpath_0104.xsd', 
                './/child::*/child::*', 
            ], 
            '1 path (1 step child::* and 1 step child::NCName:* separated by /) starts with .//' => [
                'selector_xpath_0105.xsd', 
                './/child::*/child::n2:*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step . separated by /) starts with .//' => [
                'selector_xpath_0106.xsd', 
                './/child::n1:*/.', 
            ], 
            '1 path (1 step child::NCName:* and 1 step QName separated by /) starts with .//' => [
                'selector_xpath_0107.xsd', 
                './/child::n1:*/q2:name2', 
            ], 
            '1 path (1 step child::NCName:* and 1 step * separated by /) starts with .//' => [
                'selector_xpath_0108.xsd', 
                './/child::n1:*/*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step NCName:* separated by /) starts with .//' => [
                'selector_xpath_0109.xsd', 
                './/child::n1:*/n2:*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step child::QName separated by /) starts with .//' => [
                'selector_xpath_0110.xsd', 
                './/child::n1:*/child::q2:name2', 
            ], 
            '1 path (1 step child::NCName:* and 1 step child::* separated by /) starts with .//' => [
                'selector_xpath_0111.xsd', 
                './/child::n1:*/child::*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step child::NCName:* separated by /) starts with .//' => [
                'selector_xpath_0112.xsd', 
                './/child::n1:*/child::n2:*', 
            ], 
            '1 path (with 1 step .) and 1 path (with 1 step .) separated by |' => [
                'selector_xpath_0113.xsd', 
                '.|.', 
            ], 
            '1 path (with 1 step .) and 1 path (with 1 step QName) separated by |' => [
                'selector_xpath_0114.xsd', 
                '.|q2:name2', 
            ], 
            '1 path (with 1 step .) and 1 path (with 1 step *) separated by |' => [
                'selector_xpath_0115.xsd', 
                '.|*', 
            ], 
            '1 path (with 1 step .) and 1 path (with 1 step NCName:*) separated by |' => [
                'selector_xpath_0116.xsd', 
                '.|n2:*', 
            ], 
            '1 path (with 1 step .) and 1 path (with 1 step child::QName) separated by |' => [
                'selector_xpath_0117.xsd', 
                '.|child::q2:name2', 
            ], 
            '1 path (with 1 step .) and 1 path (with 1 step child::*) separated by |' => [
                'selector_xpath_0118.xsd', 
                '.|child::*', 
            ], 
            '1 path (with 1 step .) and 1 path (with 1 step child::NCName:*) separated by |' => [
                'selector_xpath_0119.xsd', 
                '.|child::n2:*', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step .) separated by |' => [
                'selector_xpath_0120.xsd', 
                'q1:name1|.', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step QName) separated by |' => [
                'selector_xpath_0121.xsd', 
                'q1:name1|q2:name2', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step *) separated by |' => [
                'selector_xpath_0122.xsd', 
                'q1:name1|*', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step NCName:*) separated by |' => [
                'selector_xpath_0123.xsd', 
                'q1:name1|n2:*', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step child::QName) separated by |' => [
                'selector_xpath_0124.xsd', 
                'q1:name1|child::q2:name2', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step child::*) separated by |' => [
                'selector_xpath_0125.xsd', 
                'q1:name1|child::*', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step child::NCName:*) separated by |' => [
                'selector_xpath_0126.xsd', 
                'q1:name1|child::n2:*', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step .) separated by |' => [
                'selector_xpath_0127.xsd', 
                '*|.', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step QName) separated by |' => [
                'selector_xpath_0128.xsd', 
                '*|q2:name2', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step *) separated by |' => [
                'selector_xpath_0129.xsd', 
                '*|*', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step NCName:*) separated by |' => [
                'selector_xpath_0130.xsd', 
                '*|n2:*', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step child::QName) separated by |' => [
                'selector_xpath_0131.xsd', 
                '*|child::q2:name2', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step child::*) separated by |' => [
                'selector_xpath_0132.xsd', 
                '*|child::*', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step child::NCName:*) separated by |' => [
                'selector_xpath_0133.xsd', 
                '*|child::n2:*', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step .) separated by |' => [
                'selector_xpath_0134.xsd', 
                'n1:*|.', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step QName) separated by |' => [
                'selector_xpath_0135.xsd', 
                'n1:*|q2:name2', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step *) separated by |' => [
                'selector_xpath_0136.xsd', 
                'n1:*|*', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step NCName:*) separated by |' => [
                'selector_xpath_0137.xsd', 
                'n1:*|n2:*', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step child::QName) separated by |' => [
                'selector_xpath_0138.xsd', 
                'n1:*|child::q2:name2', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step child::*) separated by |' => [
                'selector_xpath_0139.xsd', 
                'n1:*|child::*', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step child::NCName:*) separated by |' => [
                'selector_xpath_0140.xsd', 
                'n1:*|child::n2:*', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step .) separated by |' => [
                'selector_xpath_0141.xsd', 
                'child::q1:name1|.', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step QName) separated by |' => [
                'selector_xpath_0142.xsd', 
                'child::q1:name1|q2:name2', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step *) separated by |' => [
                'selector_xpath_0143.xsd', 
                'child::q1:name1|*', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step NCName:*) separated by |' => [
                'selector_xpath_0144.xsd', 
                'child::q1:name1|n2:*', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step child::QName) separated by |' => [
                'selector_xpath_0145.xsd', 
                'child::q1:name1|child::q2:name2', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step child::*) separated by |' => [
                'selector_xpath_0146.xsd', 
                'child::q1:name1|child::*', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step child::NCName:*) separated by |' => [
                'selector_xpath_0147.xsd', 
                'child::q1:name1|child::n2:*', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step .) separated by |' => [
                'selector_xpath_0148.xsd', 
                'child::*|.', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step QName) separated by |' => [
                'selector_xpath_0149.xsd', 
                'child::*|q2:name2', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step *) separated by |' => [
                'selector_xpath_0150.xsd', 
                'child::*|*', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step NCName:*) separated by |' => [
                'selector_xpath_0151.xsd', 
                'child::*|n2:*', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step child::QName) separated by |' => [
                'selector_xpath_0152.xsd', 
                'child::*|child::q2:name2', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step child::*) separated by |' => [
                'selector_xpath_0153.xsd', 
                'child::*|child::*', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step child::NCName:*) separated by |' => [
                'selector_xpath_0154.xsd', 
                'child::*|child::n2:*', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step .) separated by |' => [
                'selector_xpath_0155.xsd', 
                'child::n1:*|.', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step QName) separated by |' => [
                'selector_xpath_0156.xsd', 
                'child::n1:*|q2:name2', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step *) separated by |' => [
                'selector_xpath_0157.xsd', 
                'child::n1:*|*', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step NCName:*) separated by |' => [
                'selector_xpath_0158.xsd', 
                'child::n1:*|n2:*', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step child::QName) separated by |' => [
                'selector_xpath_0159.xsd', 
                'child::n1:*|child::q2:name2', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step child::*) separated by |' => [
                'selector_xpath_0160.xsd', 
                'child::n1:*|child::*', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step child::NCName:*) separated by |' => [
                'selector_xpath_0161.xsd', 
                'child::n1:*|child::n2:*', 
            ], 
        ];
    }
}
