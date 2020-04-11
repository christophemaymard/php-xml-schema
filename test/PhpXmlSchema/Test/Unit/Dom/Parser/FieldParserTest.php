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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_FIELD}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FieldParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName(): string
    {
        return 'field';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations(): void
    {
        $sch = $this->sut->parse($this->getXs('field_0006.xsd'));
        
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
        self::assertElementNamespaceDeclarations([], $sel);
        self::assertSelectorElementHasNoAttribute($sel);
        self::assertSame([], $sel->getElements());
        
        $field = $unique->getFieldElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $field
        );
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
        self::assertSame([], $sel->getElements());
        
        $field = $unique->getFieldElements()[0];
        self::assertElementNamespaceDeclarations([], $field);
        self::assertFieldElementHasOnlyIdAttribute($field);
        self::assertSame($id, $field->getId()->getId());
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
    public function testParseProcessXPathAttribute(string $fileName, string $expr): void
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
        self::assertSelectorElementHasNoAttribute($sel);
        self::assertSame([], $sel->getElements());
        
        $field = $unique->getFieldElements()[0];
        self::assertElementNamespaceDeclarations([], $field);
        self::assertFieldElementHasOnlyXPathAttribute($field);
        self::assertSame($expr, $field->getXPath()->getXPath());
        self::assertSame([], $field->getElements());
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
        self::assertSame([], $sel->getElements());
        
        $field = $unique->getFieldElements()[0];
        self::assertElementNamespaceDeclarations([], $field);
        self::assertFieldElementHasNoAttribute($field);
        self::assertCount(1, $field->getElements());
        
        $ann = $field->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
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
                'field_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'field_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'field_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'field_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'field_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'field_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'field_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'field_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "xpath" attributes.
     * 
     * @return  array[]
     */
    public function getValidXpathAttributes(): array
    {
        return [
            '.' => [
                'field_xpath_0001.xsd', 
                '.', 
            ], 
            'QName' => [
                'field_xpath_0002.xsd', 
                'q1:name1', 
            ], 
            '*' => [
                'field_xpath_0003.xsd', 
                '*', 
            ], 
            'NCName:*' => [
                'field_xpath_0004.xsd', 
                'n1:*', 
            ], 
            'child::QName' => [
                'field_xpath_0005.xsd', 
                'child::q3:name3', 
            ], 
            'child::*' => [
                'field_xpath_0006.xsd', 
                'child::*', 
            ], 
            'child::NCName:*' => [
                'field_xpath_0007.xsd', 
                'child::n3:*', 
            ], 
            '@QName' => [
                'field_xpath_0008.xsd', 
                '@q3:name3', 
            ], 
            '@*' => [
                'field_xpath_0009.xsd', 
                '@*', 
            ], 
            '@NCName:*' => [
                'field_xpath_0010.xsd', 
                '@n3:*', 
            ], 
            'attribute::QName' => [
                'field_xpath_0011.xsd', 
                'attribute::q3:name3', 
            ], 
            'attribute::*' => [
                'field_xpath_0012.xsd', 
                'attribute::*', 
            ], 
            'attribute::NCName:*' => [
                'field_xpath_0013.xsd', 
                'attribute::n3:*', 
            ], 
            './.' => [
                'field_xpath_0014.xsd', 
                './.', 
            ], 
            './QName' => [
                'field_xpath_0015.xsd', 
                './q2:name2', 
            ], 
            './*' => [
                'field_xpath_0016.xsd', 
                './*', 
            ], 
            './NCName:*' => [
                'field_xpath_0017.xsd', 
                './n2:*', 
            ], 
            'QName/.' => [
                'field_xpath_0018.xsd', 
                'q1:name1/.', 
            ], 
            'QName/QName' => [
                'field_xpath_0019.xsd', 
                'q1:name1/q2:name2', 
            ], 
            'QName/*' => [
                'field_xpath_0020.xsd', 
                'q1:name1/*', 
            ], 
            'QName/NCName:*' => [
                'field_xpath_0021.xsd', 
                'q1:name1/n2:*', 
            ], 
            '*/.' => [
                'field_xpath_0022.xsd', 
                '*/.', 
            ], 
            '*/QName' => [
                'field_xpath_0023.xsd', 
                '*/q2:name2', 
            ], 
            '*/*' => [
                'field_xpath_0024.xsd', 
                '*/*', 
            ], 
            '*/NCName:*' => [
                'field_xpath_0025.xsd', 
                '*/n2:*', 
            ], 
            'NCName:*/.' => [
                'field_xpath_0026.xsd', 
                'n1:*/.', 
            ], 
            'NCName:*/QName' => [
                'field_xpath_0027.xsd', 
                'n1:*/q2:name2', 
            ], 
            'NCName:*/*' => [
                'field_xpath_0028.xsd', 
                'n1:*/*', 
            ], 
            'NCName:*/NCName:*' => [
                'field_xpath_0029.xsd', 
                'n1:*/n2:*', 
            ], 
            './@QName' => [
                'field_xpath_0030.xsd', 
                './@q3:name3', 
            ], 
            './@*' => [
                'field_xpath_0031.xsd', 
                './@*', 
            ], 
            './@NCName:*' => [
                'field_xpath_0032.xsd', 
                './@n3:*', 
            ], 
            'QName/@QName' => [
                'field_xpath_0033.xsd', 
                'q1:name1/@q3:name3', 
            ], 
            'QName/@*' => [
                'field_xpath_0034.xsd', 
                'q1:name1/@*', 
            ], 
            'QName/@NCName:*' => [
                'field_xpath_0035.xsd', 
                'q1:name1/@n3:*', 
            ], 
            '*/@QName' => [
                'field_xpath_0036.xsd', 
                '*/@q3:name3', 
            ], 
            '*/@*' => [
                'field_xpath_0037.xsd', 
                '*/@*', 
            ], 
            '*/@NCName:*' => [
                'field_xpath_0038.xsd', 
                '*/@n3:*', 
            ], 
            'NCName:*/@QName' => [
                'field_xpath_0039.xsd', 
                'n1:*/@q3:name3', 
            ], 
            'NCName:*/@*' => [
                'field_xpath_0040.xsd', 
                'n1:*/@*', 
            ], 
            'NCName:*/@NCName:*' => [
                'field_xpath_0041.xsd', 
                'n1:*/@n3:*', 
            ], 
            './/.' => [
                'field_xpath_0042.xsd', 
                './/.', 
            ], 
            './/QName' => [
                'field_xpath_0043.xsd', 
                './/q1:name1', 
            ], 
            './/*' => [
                'field_xpath_0044.xsd', 
                './/*', 
            ], 
            './/NCName:*' => [
                'field_xpath_0045.xsd', 
                './/n1:*', 
            ], 
            './/child::QName' => [
                'field_xpath_0046.xsd', 
                './/child::q3:name3', 
            ], 
            './/child::*' => [
                'field_xpath_0047.xsd', 
                './/child::*', 
            ], 
            './/child::NCName:*' => [
                'field_xpath_0048.xsd', 
                './/child::n3:*', 
            ], 
            './/@QName' => [
                'field_xpath_0049.xsd', 
                './/@q3:name3', 
            ], 
            './/@*' => [
                'field_xpath_0050.xsd', 
                './/@*', 
            ], 
            './/@NCName:*' => [
                'field_xpath_0051.xsd', 
                './/@n3:*', 
            ], 
            './/attribute::QName' => [
                'field_xpath_0052.xsd', 
                './/attribute::q3:name3', 
            ], 
            './/attribute::*' => [
                'field_xpath_0053.xsd', 
                './/attribute::*', 
            ], 
            './/attribute::NCName:*' => [
                'field_xpath_0054.xsd', 
                './/attribute::n3:*', 
            ], 
            './/./.' => [
                'field_xpath_0055.xsd', 
                './/./.', 
            ], 
            './/./QName' => [
                'field_xpath_0056.xsd', 
                './/./q2:name2', 
            ], 
            './/./*' => [
                'field_xpath_0057.xsd', 
                './/./*', 
            ], 
            './/./NCName:*' => [
                'field_xpath_0058.xsd', 
                './/./n2:*', 
            ], 
            './/QName/.' => [
                'field_xpath_0059.xsd', 
                './/q1:name1/.', 
            ], 
            './/QName/QName' => [
                'field_xpath_0060.xsd', 
                './/q1:name1/q2:name2', 
            ], 
            './/QName/*' => [
                'field_xpath_0061.xsd', 
                './/q1:name1/*', 
            ], 
            './/QName/NCName:*' => [
                'field_xpath_0062.xsd', 
                './/q1:name1/n2:*', 
            ], 
            './/*/.' => [
                'field_xpath_0063.xsd', 
                './/*/.', 
            ], 
            './/*/QName' => [
                'field_xpath_0064.xsd', 
                './/*/q2:name2', 
            ], 
            './/*/*' => [
                'field_xpath_0065.xsd', 
                './/*/*', 
            ], 
            './/*/NCName:*' => [
                'field_xpath_0066.xsd', 
                './/*/n2:*', 
            ], 
            './/NCName:*/.' => [
                'field_xpath_0067.xsd', 
                './/n1:*/.', 
            ], 
            './/NCName:*/QName' => [
                'field_xpath_0068.xsd', 
                './/n1:*/q2:name2', 
            ], 
            './/NCName:*/*' => [
                'field_xpath_0069.xsd', 
                './/n1:*/*', 
            ], 
            './/NCName:*/NCName:*' => [
                'field_xpath_0070.xsd', 
                './/n1:*/n2:*', 
            ], 
            './/./@QName' => [
                'field_xpath_0071.xsd', 
                './/./@q3:name3', 
            ], 
            './/./@*' => [
                'field_xpath_0072.xsd', 
                './/./@*', 
            ], 
            './/./@NCName:*' => [
                'field_xpath_0073.xsd', 
                './/./@n3:*', 
            ], 
            './/QName/@QName' => [
                'field_xpath_0074.xsd', 
                './/q1:name1/@q3:name3', 
            ], 
            './/QName/@*' => [
                'field_xpath_0075.xsd', 
                './/q1:name1/@*', 
            ], 
            './/QName/@NCName:*' => [
                'field_xpath_0076.xsd', 
                './/q1:name1/@n3:*', 
            ], 
            './/*/@QName' => [
                'field_xpath_0077.xsd', 
                './/*/@q3:name3', 
            ], 
            './/*/@*' => [
                'field_xpath_0078.xsd', 
                './/*/@*', 
            ], 
            './/*/@NCName:*' => [
                'field_xpath_0079.xsd', 
                './/*/@n3:*', 
            ], 
            './/NCName:*/@QName' => [
                'field_xpath_0080.xsd', 
                './/n1:*/@q3:name3', 
            ], 
            './/NCName:*/@*' => [
                'field_xpath_0081.xsd', 
                './/n1:*/@*', 
            ], 
            './/NCName:*/@NCName:*' => [
                'field_xpath_0082.xsd', 
                './/n1:*/@n3:*', 
            ], 
            '.|.' => [
                'field_xpath_0083.xsd', 
                '.|.', 
            ], 
            '.|QName' => [
                'field_xpath_0084.xsd', 
                '.|q1:name1', 
            ], 
            '.|*' => [
                'field_xpath_0085.xsd', 
                '.|*', 
            ], 
            '.|NCName:*' => [
                'field_xpath_0086.xsd', 
                '.|n1:*', 
            ], 
            '.|child::QName' => [
                'field_xpath_0087.xsd', 
                '.|child::q3:name3', 
            ], 
            '.|child::*' => [
                'field_xpath_0088.xsd', 
                '.|child::*', 
            ], 
            '.|child::NCName:*' => [
                'field_xpath_0089.xsd', 
                '.|child::n3:*', 
            ], 
            '.|@QName' => [
                'field_xpath_0090.xsd', 
                '.|@q3:name3', 
            ], 
            '.|@*' => [
                'field_xpath_0091.xsd', 
                '.|@*', 
            ], 
            '.|@NCName:*' => [
                'field_xpath_0092.xsd', 
                '.|@n3:*', 
            ], 
            '.|attribute::QName' => [
                'field_xpath_0093.xsd', 
                '.|attribute::q3:name3', 
            ], 
            '.|attribute::*' => [
                'field_xpath_0094.xsd', 
                '.|attribute::*', 
            ], 
            '.|attribute::NCName:*' => [
                'field_xpath_0095.xsd', 
                '.|attribute::n3:*', 
            ], 
            '.|./.' => [
                'field_xpath_0096.xsd', 
                '.|./.', 
            ], 
            '.|./QName' => [
                'field_xpath_0097.xsd', 
                '.|./q2:name2', 
            ], 
            '.|./*' => [
                'field_xpath_0098.xsd', 
                '.|./*', 
            ], 
            '.|./NCName:*' => [
                'field_xpath_0099.xsd', 
                '.|./n2:*', 
            ], 
            '.|QName/.' => [
                'field_xpath_0100.xsd', 
                '.|q1:name1/.', 
            ], 
            '.|QName/QName' => [
                'field_xpath_0101.xsd', 
                '.|q1:name1/q2:name2', 
            ], 
            '.|QName/*' => [
                'field_xpath_0102.xsd', 
                '.|q1:name1/*', 
            ], 
            '.|QName/NCName:*' => [
                'field_xpath_0103.xsd', 
                '.|q1:name1/n2:*', 
            ], 
            '.|*/.' => [
                'field_xpath_0104.xsd', 
                '.|*/.', 
            ], 
            '.|*/QName' => [
                'field_xpath_0105.xsd', 
                '.|*/q2:name2', 
            ], 
            '.|*/*' => [
                'field_xpath_0106.xsd', 
                '.|*/*', 
            ], 
            '.|*/NCName:*' => [
                'field_xpath_0107.xsd', 
                '.|*/n2:*', 
            ], 
            '.|NCName:*/.' => [
                'field_xpath_0108.xsd', 
                '.|n1:*/.', 
            ], 
            '.|NCName:*/QName' => [
                'field_xpath_0109.xsd', 
                '.|n1:*/q2:name2', 
            ], 
            '.|NCName:*/*' => [
                'field_xpath_0110.xsd', 
                '.|n1:*/*', 
            ], 
            '.|NCName:*/NCName:*' => [
                'field_xpath_0111.xsd', 
                '.|n1:*/n2:*', 
            ], 
            '.|./@QName' => [
                'field_xpath_0112.xsd', 
                '.|./@q3:name3', 
            ], 
            '.|./@*' => [
                'field_xpath_0113.xsd', 
                '.|./@*', 
            ], 
            '.|./@NCName:*' => [
                'field_xpath_0114.xsd', 
                '.|./@n3:*', 
            ], 
            '.|QName/@QName' => [
                'field_xpath_0115.xsd', 
                '.|q1:name1/@q3:name3', 
            ], 
            '.|QName/@*' => [
                'field_xpath_0116.xsd', 
                '.|q1:name1/@*', 
            ], 
            '.|QName/@NCName:*' => [
                'field_xpath_0117.xsd', 
                '.|q1:name1/@n3:*', 
            ], 
            '.|*/@QName' => [
                'field_xpath_0118.xsd', 
                '.|*/@q3:name3', 
            ], 
            '.|*/@*' => [
                'field_xpath_0119.xsd', 
                '.|*/@*', 
            ], 
            '.|*/@NCName:*' => [
                'field_xpath_0120.xsd', 
                '.|*/@n3:*', 
            ], 
            '.|NCName:*/@QName' => [
                'field_xpath_0121.xsd', 
                '.|n1:*/@q3:name3', 
            ], 
            '.|NCName:*/@*' => [
                'field_xpath_0122.xsd', 
                '.|n1:*/@*', 
            ], 
            '.|NCName:*/@NCName:*' => [
                'field_xpath_0123.xsd', 
                '.|n1:*/@n3:*', 
            ], 
            'QName|.' => [
                'field_xpath_0124.xsd', 
                'q4:name4|.', 
            ], 
            'QName|QName' => [
                'field_xpath_0125.xsd', 
                'q4:name4|q1:name1', 
            ], 
            'QName|*' => [
                'field_xpath_0126.xsd', 
                'q4:name4|*', 
            ], 
            'QName|NCName:*' => [
                'field_xpath_0127.xsd', 
                'q4:name4|n1:*', 
            ], 
            'QName|child::QName' => [
                'field_xpath_0128.xsd', 
                'q4:name4|child::q3:name3', 
            ], 
            'QName|child::*' => [
                'field_xpath_0129.xsd', 
                'q4:name4|child::*', 
            ], 
            'QName|child::NCName:*' => [
                'field_xpath_0130.xsd', 
                'q4:name4|child::n3:*', 
            ], 
            'QName|@QName' => [
                'field_xpath_0131.xsd', 
                'q4:name4|@q3:name3', 
            ], 
            'QName|@*' => [
                'field_xpath_0132.xsd', 
                'q4:name4|@*', 
            ], 
            'QName|@NCName:*' => [
                'field_xpath_0133.xsd', 
                'q4:name4|@n3:*', 
            ], 
            'QName|attribute::QName' => [
                'field_xpath_0134.xsd', 
                'q4:name4|attribute::q3:name3', 
            ], 
            'QName|attribute::*' => [
                'field_xpath_0135.xsd', 
                'q4:name4|attribute::*', 
            ], 
            'QName|attribute::NCName:*' => [
                'field_xpath_0136.xsd', 
                'q4:name4|attribute::n3:*', 
            ], 
            'QName|./.' => [
                'field_xpath_0137.xsd', 
                'q4:name4|./.', 
            ], 
            'QName|./QName' => [
                'field_xpath_0138.xsd', 
                'q4:name4|./q2:name2', 
            ], 
            'QName|./*' => [
                'field_xpath_0139.xsd', 
                'q4:name4|./*', 
            ], 
            'QName|./NCName:*' => [
                'field_xpath_0140.xsd', 
                'q4:name4|./n2:*', 
            ], 
            'QName|QName/.' => [
                'field_xpath_0141.xsd', 
                'q4:name4|q1:name1/.', 
            ], 
            'QName|QName/QName' => [
                'field_xpath_0142.xsd', 
                'q4:name4|q1:name1/q2:name2', 
            ], 
            'QName|QName/*' => [
                'field_xpath_0143.xsd', 
                'q4:name4|q1:name1/*', 
            ], 
            'QName|QName/NCName:*' => [
                'field_xpath_0144.xsd', 
                'q4:name4|q1:name1/n2:*', 
            ], 
            'QName|*/.' => [
                'field_xpath_0145.xsd', 
                'q4:name4|*/.', 
            ], 
            'QName|*/QName' => [
                'field_xpath_0146.xsd', 
                'q4:name4|*/q2:name2', 
            ], 
            'QName|*/*' => [
                'field_xpath_0147.xsd', 
                'q4:name4|*/*', 
            ], 
            'QName|*/NCName:*' => [
                'field_xpath_0148.xsd', 
                'q4:name4|*/n2:*', 
            ], 
            'QName|NCName:*/.' => [
                'field_xpath_0149.xsd', 
                'q4:name4|n1:*/.', 
            ], 
            'QName|NCName:*/QName' => [
                'field_xpath_0150.xsd', 
                'q4:name4|n1:*/q2:name2', 
            ], 
            'QName|NCName:*/*' => [
                'field_xpath_0151.xsd', 
                'q4:name4|n1:*/*', 
            ], 
            'QName|NCName:*/NCName:*' => [
                'field_xpath_0152.xsd', 
                'q4:name4|n1:*/n2:*', 
            ], 
            'QName|./@QName' => [
                'field_xpath_0153.xsd', 
                'q4:name4|./@q3:name3', 
            ], 
            'QName|./@*' => [
                'field_xpath_0154.xsd', 
                'q4:name4|./@*', 
            ], 
            'QName|./@NCName:*' => [
                'field_xpath_0155.xsd', 
                'q4:name4|./@n3:*', 
            ], 
            'QName|QName/@QName' => [
                'field_xpath_0156.xsd', 
                'q4:name4|q1:name1/@q3:name3', 
            ], 
            'QName|QName/@*' => [
                'field_xpath_0157.xsd', 
                'q4:name4|q1:name1/@*', 
            ], 
            'QName|QName/@NCName:*' => [
                'field_xpath_0158.xsd', 
                'q4:name4|q1:name1/@n3:*', 
            ], 
            'QName|*/@QName' => [
                'field_xpath_0159.xsd', 
                'q4:name4|*/@q3:name3', 
            ], 
            'QName|*/@*' => [
                'field_xpath_0160.xsd', 
                'q4:name4|*/@*', 
            ], 
            'QName|*/@NCName:*' => [
                'field_xpath_0161.xsd', 
                'q4:name4|*/@n3:*', 
            ], 
            'QName|NCName:*/@QName' => [
                'field_xpath_0162.xsd', 
                'q4:name4|n1:*/@q3:name3', 
            ], 
            'QName|NCName:*/@*' => [
                'field_xpath_0163.xsd', 
                'q4:name4|n1:*/@*', 
            ], 
            'QName|NCName:*/@NCName:*' => [
                'field_xpath_0164.xsd', 
                'q4:name4|n1:*/@n3:*', 
            ], 
            '*|.' => [
                'field_xpath_0165.xsd', 
                '*|.', 
            ], 
            '*|QName' => [
                'field_xpath_0166.xsd', 
                '*|q1:name1', 
            ], 
            '*|*' => [
                'field_xpath_0167.xsd', 
                '*|*', 
            ], 
            '*|NCName:*' => [
                'field_xpath_0168.xsd', 
                '*|n1:*', 
            ], 
            '*|child::QName' => [
                'field_xpath_0169.xsd', 
                '*|child::q3:name3', 
            ], 
            '*|child::*' => [
                'field_xpath_0170.xsd', 
                '*|child::*', 
            ], 
            '*|child::NCName:*' => [
                'field_xpath_0171.xsd', 
                '*|child::n3:*', 
            ], 
            '*|@QName' => [
                'field_xpath_0172.xsd', 
                '*|@q3:name3', 
            ], 
            '*|@*' => [
                'field_xpath_0173.xsd', 
                '*|@*', 
            ], 
            '*|@NCName:*' => [
                'field_xpath_0174.xsd', 
                '*|@n3:*', 
            ], 
            '*|attribute::QName' => [
                'field_xpath_0175.xsd', 
                '*|attribute::q3:name3', 
            ], 
            '*|attribute::*' => [
                'field_xpath_0176.xsd', 
                '*|attribute::*', 
            ], 
            '*|attribute::NCName:*' => [
                'field_xpath_0177.xsd', 
                '*|attribute::n3:*', 
            ], 
            '*|./.' => [
                'field_xpath_0178.xsd', 
                '*|./.', 
            ], 
            '*|./QName' => [
                'field_xpath_0179.xsd', 
                '*|./q2:name2', 
            ], 
            '*|./*' => [
                'field_xpath_0180.xsd', 
                '*|./*', 
            ], 
            '*|./NCName:*' => [
                'field_xpath_0181.xsd', 
                '*|./n2:*', 
            ], 
            '*|QName/.' => [
                'field_xpath_0182.xsd', 
                '*|q1:name1/.', 
            ], 
            '*|QName/QName' => [
                'field_xpath_0183.xsd', 
                '*|q1:name1/q2:name2', 
            ], 
            '*|QName/*' => [
                'field_xpath_0184.xsd', 
                '*|q1:name1/*', 
            ], 
            '*|QName/NCName:*' => [
                'field_xpath_0185.xsd', 
                '*|q1:name1/n2:*', 
            ], 
            '*|*/.' => [
                'field_xpath_0186.xsd', 
                '*|*/.', 
            ], 
            '*|*/QName' => [
                'field_xpath_0187.xsd', 
                '*|*/q2:name2', 
            ], 
            '*|*/*' => [
                'field_xpath_0188.xsd', 
                '*|*/*', 
            ], 
            '*|*/NCName:*' => [
                'field_xpath_0189.xsd', 
                '*|*/n2:*', 
            ], 
            '*|NCName:*/.' => [
                'field_xpath_0190.xsd', 
                '*|n1:*/.', 
            ], 
            '*|NCName:*/QName' => [
                'field_xpath_0191.xsd', 
                '*|n1:*/q2:name2', 
            ], 
            '*|NCName:*/*' => [
                'field_xpath_0192.xsd', 
                '*|n1:*/*', 
            ], 
            '*|NCName:*/NCName:*' => [
                'field_xpath_0193.xsd', 
                '*|n1:*/n2:*', 
            ], 
            '*|./@QName' => [
                'field_xpath_0194.xsd', 
                '*|./@q3:name3', 
            ], 
            '*|./@*' => [
                'field_xpath_0195.xsd', 
                '*|./@*', 
            ], 
            '*|./@NCName:*' => [
                'field_xpath_0196.xsd', 
                '*|./@n3:*', 
            ], 
            '*|QName/@QName' => [
                'field_xpath_0197.xsd', 
                '*|q1:name1/@q3:name3', 
            ], 
            '*|QName/@*' => [
                'field_xpath_0198.xsd', 
                '*|q1:name1/@*', 
            ], 
            '*|QName/@NCName:*' => [
                'field_xpath_0199.xsd', 
                '*|q1:name1/@n3:*', 
            ], 
            '*|*/@QName' => [
                'field_xpath_0200.xsd', 
                '*|*/@q3:name3', 
            ], 
            '*|*/@*' => [
                'field_xpath_0201.xsd', 
                '*|*/@*', 
            ], 
            '*|*/@NCName:*' => [
                'field_xpath_0202.xsd', 
                '*|*/@n3:*', 
            ], 
            '*|NCName:*/@QName' => [
                'field_xpath_0203.xsd', 
                '*|n1:*/@q3:name3', 
            ], 
            '*|NCName:*/@*' => [
                'field_xpath_0204.xsd', 
                '*|n1:*/@*', 
            ], 
            '*|NCName:*/@NCName:*' => [
                'field_xpath_0205.xsd', 
                '*|n1:*/@n3:*', 
            ], 
            'NCName:*|.' => [
                'field_xpath_0206.xsd', 
                'n4:*|.', 
            ], 
            'NCName:*|QName' => [
                'field_xpath_0207.xsd', 
                'n4:*|q1:name1', 
            ], 
            'NCName:*|*' => [
                'field_xpath_0208.xsd', 
                'n4:*|*', 
            ], 
            'NCName:*|NCName:*' => [
                'field_xpath_0209.xsd', 
                'n4:*|n1:*', 
            ], 
            'NCName:*|child::QName' => [
                'field_xpath_0210.xsd', 
                'n4:*|child::q3:name3', 
            ], 
            'NCName:*|child::*' => [
                'field_xpath_0211.xsd', 
                'n4:*|child::*', 
            ], 
            'NCName:*|child::NCName:*' => [
                'field_xpath_0212.xsd', 
                'n4:*|child::n3:*', 
            ], 
            'NCName:*|@QName' => [
                'field_xpath_0213.xsd', 
                'n4:*|@q3:name3', 
            ], 
            'NCName:*|@*' => [
                'field_xpath_0214.xsd', 
                'n4:*|@*', 
            ], 
            'NCName:*|@NCName:*' => [
                'field_xpath_0215.xsd', 
                'n4:*|@n3:*', 
            ], 
            'NCName:*|attribute::QName' => [
                'field_xpath_0216.xsd', 
                'n4:*|attribute::q3:name3', 
            ], 
            'NCName:*|attribute::*' => [
                'field_xpath_0217.xsd', 
                'n4:*|attribute::*', 
            ], 
            'NCName:*|attribute::NCName:*' => [
                'field_xpath_0218.xsd', 
                'n4:*|attribute::n3:*', 
            ], 
            'NCName:*|./.' => [
                'field_xpath_0219.xsd', 
                'n4:*|./.', 
            ], 
            'NCName:*|./QName' => [
                'field_xpath_0220.xsd', 
                'n4:*|./q2:name2', 
            ], 
            'NCName:*|./*' => [
                'field_xpath_0221.xsd', 
                'n4:*|./*', 
            ], 
            'NCName:*|./NCName:*' => [
                'field_xpath_0222.xsd', 
                'n4:*|./n2:*', 
            ], 
            'NCName:*|QName/.' => [
                'field_xpath_0223.xsd', 
                'n4:*|q1:name1/.', 
            ], 
            'NCName:*|QName/QName' => [
                'field_xpath_0224.xsd', 
                'n4:*|q1:name1/q2:name2', 
            ], 
            'NCName:*|QName/*' => [
                'field_xpath_0225.xsd', 
                'n4:*|q1:name1/*', 
            ], 
            'NCName:*|QName/NCName:*' => [
                'field_xpath_0226.xsd', 
                'n4:*|q1:name1/n2:*', 
            ], 
            'NCName:*|*/.' => [
                'field_xpath_0227.xsd', 
                'n4:*|*/.', 
            ], 
            'NCName:*|*/QName' => [
                'field_xpath_0228.xsd', 
                'n4:*|*/q2:name2', 
            ], 
            'NCName:*|*/*' => [
                'field_xpath_0229.xsd', 
                'n4:*|*/*', 
            ], 
            'NCName:*|*/NCName:*' => [
                'field_xpath_0230.xsd', 
                'n4:*|*/n2:*', 
            ], 
            'NCName:*|NCName:*/.' => [
                'field_xpath_0231.xsd', 
                'n4:*|n1:*/.', 
            ], 
            'NCName:*|NCName:*/QName' => [
                'field_xpath_0232.xsd', 
                'n4:*|n1:*/q2:name2', 
            ], 
            'NCName:*|NCName:*/*' => [
                'field_xpath_0233.xsd', 
                'n4:*|n1:*/*', 
            ], 
            'NCName:*|NCName:*/NCName:*' => [
                'field_xpath_0234.xsd', 
                'n4:*|n1:*/n2:*', 
            ], 
            'NCName:*|./@QName' => [
                'field_xpath_0235.xsd', 
                'n4:*|./@q3:name3', 
            ], 
            'NCName:*|./@*' => [
                'field_xpath_0236.xsd', 
                'n4:*|./@*', 
            ], 
            'NCName:*|./@NCName:*' => [
                'field_xpath_0237.xsd', 
                'n4:*|./@n3:*', 
            ], 
            'NCName:*|QName/@QName' => [
                'field_xpath_0238.xsd', 
                'n4:*|q1:name1/@q3:name3', 
            ], 
            'NCName:*|QName/@*' => [
                'field_xpath_0239.xsd', 
                'n4:*|q1:name1/@*', 
            ], 
            'NCName:*|QName/@NCName:*' => [
                'field_xpath_0240.xsd', 
                'n4:*|q1:name1/@n3:*', 
            ], 
            'NCName:*|*/@QName' => [
                'field_xpath_0241.xsd', 
                'n4:*|*/@q3:name3', 
            ], 
            'NCName:*|*/@*' => [
                'field_xpath_0242.xsd', 
                'n4:*|*/@*', 
            ], 
            'NCName:*|*/@NCName:*' => [
                'field_xpath_0243.xsd', 
                'n4:*|*/@n3:*', 
            ], 
            'NCName:*|NCName:*/@QName' => [
                'field_xpath_0244.xsd', 
                'n4:*|n1:*/@q3:name3', 
            ], 
            'NCName:*|NCName:*/@*' => [
                'field_xpath_0245.xsd', 
                'n4:*|n1:*/@*', 
            ], 
            'NCName:*|NCName:*/@NCName:*' => [
                'field_xpath_0246.xsd', 
                'n4:*|n1:*/@n3:*', 
            ], 
            '@QName|.' => [
                'field_xpath_0247.xsd', 
                '@q5:name5|.', 
            ], 
            '@QName|QName' => [
                'field_xpath_0248.xsd', 
                '@q5:name5|q1:name1', 
            ], 
            '@QName|*' => [
                'field_xpath_0249.xsd', 
                '@q5:name5|*', 
            ], 
            '@QName|NCName:*' => [
                'field_xpath_0250.xsd', 
                '@q5:name5|n1:*', 
            ], 
            '@QName|child::QName' => [
                'field_xpath_0251.xsd', 
                '@q5:name5|child::q3:name3', 
            ], 
            '@QName|child::*' => [
                'field_xpath_0252.xsd', 
                '@q5:name5|child::*', 
            ], 
            '@QName|child::NCName:*' => [
                'field_xpath_0253.xsd', 
                '@q5:name5|child::n3:*', 
            ], 
            '@QName|@QName' => [
                'field_xpath_0254.xsd', 
                '@q5:name5|@q3:name3', 
            ], 
            '@QName|@*' => [
                'field_xpath_0255.xsd', 
                '@q5:name5|@*', 
            ], 
            '@QName|@NCName:*' => [
                'field_xpath_0256.xsd', 
                '@q5:name5|@n3:*', 
            ], 
            '@QName|attribute::QName' => [
                'field_xpath_0257.xsd', 
                '@q5:name5|attribute::q3:name3', 
            ], 
            '@QName|attribute::*' => [
                'field_xpath_0258.xsd', 
                '@q5:name5|attribute::*', 
            ], 
            '@QName|attribute::NCName:*' => [
                'field_xpath_0259.xsd', 
                '@q5:name5|attribute::n3:*', 
            ], 
            '@QName|./.' => [
                'field_xpath_0260.xsd', 
                '@q5:name5|./.', 
            ], 
            '@QName|./QName' => [
                'field_xpath_0261.xsd', 
                '@q5:name5|./q2:name2', 
            ], 
            '@QName|./*' => [
                'field_xpath_0262.xsd', 
                '@q5:name5|./*', 
            ], 
            '@QName|./NCName:*' => [
                'field_xpath_0263.xsd', 
                '@q5:name5|./n2:*', 
            ], 
            '@QName|QName/.' => [
                'field_xpath_0264.xsd', 
                '@q5:name5|q1:name1/.', 
            ], 
            '@QName|QName/QName' => [
                'field_xpath_0265.xsd', 
                '@q5:name5|q1:name1/q2:name2', 
            ], 
            '@QName|QName/*' => [
                'field_xpath_0266.xsd', 
                '@q5:name5|q1:name1/*', 
            ], 
            '@QName|QName/NCName:*' => [
                'field_xpath_0267.xsd', 
                '@q5:name5|q1:name1/n2:*', 
            ], 
            '@QName|*/.' => [
                'field_xpath_0268.xsd', 
                '@q5:name5|*/.', 
            ], 
            '@QName|*/QName' => [
                'field_xpath_0269.xsd', 
                '@q5:name5|*/q2:name2', 
            ], 
            '@QName|*/*' => [
                'field_xpath_0270.xsd', 
                '@q5:name5|*/*', 
            ], 
            '@QName|*/NCName:*' => [
                'field_xpath_0271.xsd', 
                '@q5:name5|*/n2:*', 
            ], 
            '@QName|NCName:*/.' => [
                'field_xpath_0272.xsd', 
                '@q5:name5|n1:*/.', 
            ], 
            '@QName|NCName:*/QName' => [
                'field_xpath_0273.xsd', 
                '@q5:name5|n1:*/q2:name2', 
            ], 
            '@QName|NCName:*/*' => [
                'field_xpath_0274.xsd', 
                '@q5:name5|n1:*/*', 
            ], 
            '@QName|NCName:*/NCName:*' => [
                'field_xpath_0275.xsd', 
                '@q5:name5|n1:*/n2:*', 
            ], 
            '@QName|./@QName' => [
                'field_xpath_0276.xsd', 
                '@q5:name5|./@q3:name3', 
            ], 
            '@QName|./@*' => [
                'field_xpath_0277.xsd', 
                '@q5:name5|./@*', 
            ], 
            '@QName|./@NCName:*' => [
                'field_xpath_0278.xsd', 
                '@q5:name5|./@n3:*', 
            ], 
            '@QName|QName/@QName' => [
                'field_xpath_0279.xsd', 
                '@q5:name5|q1:name1/@q3:name3', 
            ], 
            '@QName|QName/@*' => [
                'field_xpath_0280.xsd', 
                '@q5:name5|q1:name1/@*', 
            ], 
            '@QName|QName/@NCName:*' => [
                'field_xpath_0281.xsd', 
                '@q5:name5|q1:name1/@n3:*', 
            ], 
            '@QName|*/@QName' => [
                'field_xpath_0282.xsd', 
                '@q5:name5|*/@q3:name3', 
            ], 
            '@QName|*/@*' => [
                'field_xpath_0283.xsd', 
                '@q5:name5|*/@*', 
            ], 
            '@QName|*/@NCName:*' => [
                'field_xpath_0284.xsd', 
                '@q5:name5|*/@n3:*', 
            ], 
            '@QName|NCName:*/@QName' => [
                'field_xpath_0285.xsd', 
                '@q5:name5|n1:*/@q3:name3', 
            ], 
            '@QName|NCName:*/@*' => [
                'field_xpath_0286.xsd', 
                '@q5:name5|n1:*/@*', 
            ], 
            '@QName|NCName:*/@NCName:*' => [
                'field_xpath_0287.xsd', 
                '@q5:name5|n1:*/@n3:*', 
            ], 
            '@*|.' => [
                'field_xpath_0288.xsd', 
                '@*|.', 
            ], 
            '@*|QName' => [
                'field_xpath_0289.xsd', 
                '@*|q1:name1', 
            ], 
            '@*|*' => [
                'field_xpath_0290.xsd', 
                '@*|*', 
            ], 
            '@*|NCName:*' => [
                'field_xpath_0291.xsd', 
                '@*|n1:*', 
            ], 
            '@*|child::QName' => [
                'field_xpath_0292.xsd', 
                '@*|child::q3:name3', 
            ], 
            '@*|child::*' => [
                'field_xpath_0293.xsd', 
                '@*|child::*', 
            ], 
            '@*|child::NCName:*' => [
                'field_xpath_0294.xsd', 
                '@*|child::n3:*', 
            ], 
            '@*|@QName' => [
                'field_xpath_0295.xsd', 
                '@*|@q3:name3', 
            ], 
            '@*|@*' => [
                'field_xpath_0296.xsd', 
                '@*|@*', 
            ], 
            '@*|@NCName:*' => [
                'field_xpath_0297.xsd', 
                '@*|@n3:*', 
            ], 
            '@*|attribute::QName' => [
                'field_xpath_0298.xsd', 
                '@*|attribute::q3:name3', 
            ], 
            '@*|attribute::*' => [
                'field_xpath_0299.xsd', 
                '@*|attribute::*', 
            ], 
            '@*|attribute::NCName:*' => [
                'field_xpath_0300.xsd', 
                '@*|attribute::n3:*', 
            ], 
            '@*|./.' => [
                'field_xpath_0301.xsd', 
                '@*|./.', 
            ], 
            '@*|./QName' => [
                'field_xpath_0302.xsd', 
                '@*|./q2:name2', 
            ], 
            '@*|./*' => [
                'field_xpath_0303.xsd', 
                '@*|./*', 
            ], 
            '@*|./NCName:*' => [
                'field_xpath_0304.xsd', 
                '@*|./n2:*', 
            ], 
            '@*|QName/.' => [
                'field_xpath_0305.xsd', 
                '@*|q1:name1/.', 
            ], 
            '@*|QName/QName' => [
                'field_xpath_0306.xsd', 
                '@*|q1:name1/q2:name2', 
            ], 
            '@*|QName/*' => [
                'field_xpath_0307.xsd', 
                '@*|q1:name1/*', 
            ], 
            '@*|QName/NCName:*' => [
                'field_xpath_0308.xsd', 
                '@*|q1:name1/n2:*', 
            ], 
            '@*|*/.' => [
                'field_xpath_0309.xsd', 
                '@*|*/.', 
            ], 
            '@*|*/QName' => [
                'field_xpath_0310.xsd', 
                '@*|*/q2:name2', 
            ], 
            '@*|*/*' => [
                'field_xpath_0311.xsd', 
                '@*|*/*', 
            ], 
            '@*|*/NCName:*' => [
                'field_xpath_0312.xsd', 
                '@*|*/n2:*', 
            ], 
            '@*|NCName:*/.' => [
                'field_xpath_0313.xsd', 
                '@*|n1:*/.', 
            ], 
            '@*|NCName:*/QName' => [
                'field_xpath_0314.xsd', 
                '@*|n1:*/q2:name2', 
            ], 
            '@*|NCName:*/*' => [
                'field_xpath_0315.xsd', 
                '@*|n1:*/*', 
            ], 
            '@*|NCName:*/NCName:*' => [
                'field_xpath_0316.xsd', 
                '@*|n1:*/n2:*', 
            ], 
            '@*|./@QName' => [
                'field_xpath_0317.xsd', 
                '@*|./@q3:name3', 
            ], 
            '@*|./@*' => [
                'field_xpath_0318.xsd', 
                '@*|./@*', 
            ], 
            '@*|./@NCName:*' => [
                'field_xpath_0319.xsd', 
                '@*|./@n3:*', 
            ], 
            '@*|QName/@QName' => [
                'field_xpath_0320.xsd', 
                '@*|q1:name1/@q3:name3', 
            ], 
            '@*|QName/@*' => [
                'field_xpath_0321.xsd', 
                '@*|q1:name1/@*', 
            ], 
            '@*|QName/@NCName:*' => [
                'field_xpath_0322.xsd', 
                '@*|q1:name1/@n3:*', 
            ], 
            '@*|*/@QName' => [
                'field_xpath_0323.xsd', 
                '@*|*/@q3:name3', 
            ], 
            '@*|*/@*' => [
                'field_xpath_0324.xsd', 
                '@*|*/@*', 
            ], 
            '@*|*/@NCName:*' => [
                'field_xpath_0325.xsd', 
                '@*|*/@n3:*', 
            ], 
            '@*|NCName:*/@QName' => [
                'field_xpath_0326.xsd', 
                '@*|n1:*/@q3:name3', 
            ], 
            '@*|NCName:*/@*' => [
                'field_xpath_0327.xsd', 
                '@*|n1:*/@*', 
            ], 
            '@*|NCName:*/@NCName:*' => [
                'field_xpath_0328.xsd', 
                '@*|n1:*/@n3:*', 
            ], 
            '@NCName:*|.' => [
                'field_xpath_0329.xsd', 
                '@n5:*|.', 
            ], 
            '@NCName:*|QName' => [
                'field_xpath_0330.xsd', 
                '@n5:*|q1:name1', 
            ], 
            '@NCName:*|*' => [
                'field_xpath_0331.xsd', 
                '@n5:*|*', 
            ], 
            '@NCName:*|NCName:*' => [
                'field_xpath_0332.xsd', 
                '@n5:*|n1:*', 
            ], 
            '@NCName:*|child::QName' => [
                'field_xpath_0333.xsd', 
                '@n5:*|child::q3:name3', 
            ], 
            '@NCName:*|child::*' => [
                'field_xpath_0334.xsd', 
                '@n5:*|child::*', 
            ], 
            '@NCName:*|child::NCName:*' => [
                'field_xpath_0335.xsd', 
                '@n5:*|child::n3:*', 
            ], 
            '@NCName:*|@QName' => [
                'field_xpath_0336.xsd', 
                '@n5:*|@q3:name3', 
            ], 
            '@NCName:*|@*' => [
                'field_xpath_0337.xsd', 
                '@n5:*|@*', 
            ], 
            '@NCName:*|@NCName:*' => [
                'field_xpath_0338.xsd', 
                '@n5:*|@n3:*', 
            ], 
            '@NCName:*|attribute::QName' => [
                'field_xpath_0339.xsd', 
                '@n5:*|attribute::q3:name3', 
            ], 
            '@NCName:*|attribute::*' => [
                'field_xpath_0340.xsd', 
                '@n5:*|attribute::*', 
            ], 
            '@NCName:*|attribute::NCName:*' => [
                'field_xpath_0341.xsd', 
                '@n5:*|attribute::n3:*', 
            ], 
            '@NCName:*|./.' => [
                'field_xpath_0342.xsd', 
                '@n5:*|./.', 
            ], 
            '@NCName:*|./QName' => [
                'field_xpath_0343.xsd', 
                '@n5:*|./q2:name2', 
            ], 
            '@NCName:*|./*' => [
                'field_xpath_0344.xsd', 
                '@n5:*|./*', 
            ], 
            '@NCName:*|./NCName:*' => [
                'field_xpath_0345.xsd', 
                '@n5:*|./n2:*', 
            ], 
            '@NCName:*|QName/.' => [
                'field_xpath_0346.xsd', 
                '@n5:*|q1:name1/.', 
            ], 
            '@NCName:*|QName/QName' => [
                'field_xpath_0347.xsd', 
                '@n5:*|q1:name1/q2:name2', 
            ], 
            '@NCName:*|QName/*' => [
                'field_xpath_0348.xsd', 
                '@n5:*|q1:name1/*', 
            ], 
            '@NCName:*|QName/NCName:*' => [
                'field_xpath_0349.xsd', 
                '@n5:*|q1:name1/n2:*', 
            ], 
            '@NCName:*|*/.' => [
                'field_xpath_0350.xsd', 
                '@n5:*|*/.', 
            ], 
            '@NCName:*|*/QName' => [
                'field_xpath_0351.xsd', 
                '@n5:*|*/q2:name2', 
            ], 
            '@NCName:*|*/*' => [
                'field_xpath_0352.xsd', 
                '@n5:*|*/*', 
            ], 
            '@NCName:*|*/NCName:*' => [
                'field_xpath_0353.xsd', 
                '@n5:*|*/n2:*', 
            ], 
            '@NCName:*|NCName:*/.' => [
                'field_xpath_0354.xsd', 
                '@n5:*|n1:*/.', 
            ], 
            '@NCName:*|NCName:*/QName' => [
                'field_xpath_0355.xsd', 
                '@n5:*|n1:*/q2:name2', 
            ], 
            '@NCName:*|NCName:*/*' => [
                'field_xpath_0356.xsd', 
                '@n5:*|n1:*/*', 
            ], 
            '@NCName:*|NCName:*/NCName:*' => [
                'field_xpath_0357.xsd', 
                '@n5:*|n1:*/n2:*', 
            ], 
            '@NCName:*|./@QName' => [
                'field_xpath_0358.xsd', 
                '@n5:*|./@q3:name3', 
            ], 
            '@NCName:*|./@*' => [
                'field_xpath_0359.xsd', 
                '@n5:*|./@*', 
            ], 
            '@NCName:*|./@NCName:*' => [
                'field_xpath_0360.xsd', 
                '@n5:*|./@n3:*', 
            ], 
            '@NCName:*|QName/@QName' => [
                'field_xpath_0361.xsd', 
                '@n5:*|q1:name1/@q3:name3', 
            ], 
            '@NCName:*|QName/@*' => [
                'field_xpath_0362.xsd', 
                '@n5:*|q1:name1/@*', 
            ], 
            '@NCName:*|QName/@NCName:*' => [
                'field_xpath_0363.xsd', 
                '@n5:*|q1:name1/@n3:*', 
            ], 
            '@NCName:*|*/@QName' => [
                'field_xpath_0364.xsd', 
                '@n5:*|*/@q3:name3', 
            ], 
            '@NCName:*|*/@*' => [
                'field_xpath_0365.xsd', 
                '@n5:*|*/@*', 
            ], 
            '@NCName:*|*/@NCName:*' => [
                'field_xpath_0366.xsd', 
                '@n5:*|*/@n3:*', 
            ], 
            '@NCName:*|NCName:*/@QName' => [
                'field_xpath_0367.xsd', 
                '@n5:*|n1:*/@q3:name3', 
            ], 
            '@NCName:*|NCName:*/@*' => [
                'field_xpath_0368.xsd', 
                '@n5:*|n1:*/@*', 
            ], 
            '@NCName:*|NCName:*/@NCName:*' => [
                'field_xpath_0369.xsd', 
                '@n5:*|n1:*/@n3:*', 
            ], 
            '.|.//.' => [
                'field_xpath_0370.xsd', 
                '.|.//.', 
            ], 
            '.|.//QName' => [
                'field_xpath_0371.xsd', 
                '.|.//q1:name1', 
            ], 
            '.|.//*' => [
                'field_xpath_0372.xsd', 
                '.|.//*', 
            ], 
            '.|.//NCName:*' => [
                'field_xpath_0373.xsd', 
                '.|.//n1:*', 
            ], 
            '.|.//child::QName' => [
                'field_xpath_0374.xsd', 
                '.|.//child::q3:name3', 
            ], 
            '.|.//child::*' => [
                'field_xpath_0375.xsd', 
                '.|.//child::*', 
            ], 
            '.|.//child::NCName:*' => [
                'field_xpath_0376.xsd', 
                '.|.//child::n3:*', 
            ], 
            '.|.//@QName' => [
                'field_xpath_0377.xsd', 
                '.|.//@q3:name3', 
            ], 
            '.|.//@*' => [
                'field_xpath_0378.xsd', 
                '.|.//@*', 
            ], 
            '.|.//@NCName:*' => [
                'field_xpath_0379.xsd', 
                '.|.//@n3:*', 
            ], 
            '.|.//attribute::QName' => [
                'field_xpath_0380.xsd', 
                '.|.//attribute::q3:name3', 
            ], 
            '.|.//attribute::*' => [
                'field_xpath_0381.xsd', 
                '.|.//attribute::*', 
            ], 
            '.|.//attribute::NCName:*' => [
                'field_xpath_0382.xsd', 
                '.|.//attribute::n3:*', 
            ], 
            '.|.//./.' => [
                'field_xpath_0383.xsd', 
                '.|.//./.', 
            ], 
            '.|.//./QName' => [
                'field_xpath_0384.xsd', 
                '.|.//./q2:name2', 
            ], 
            '.|.//./*' => [
                'field_xpath_0385.xsd', 
                '.|.//./*', 
            ], 
            '.|.//./NCName:*' => [
                'field_xpath_0386.xsd', 
                '.|.//./n2:*', 
            ], 
            '.|.//QName/.' => [
                'field_xpath_0387.xsd', 
                '.|.//q1:name1/.', 
            ], 
            '.|.//QName/QName' => [
                'field_xpath_0388.xsd', 
                '.|.//q1:name1/q2:name2', 
            ], 
            '.|.//QName/*' => [
                'field_xpath_0389.xsd', 
                '.|.//q1:name1/*', 
            ], 
            '.|.//QName/NCName:*' => [
                'field_xpath_0390.xsd', 
                '.|.//q1:name1/n2:*', 
            ], 
            '.|.//*/.' => [
                'field_xpath_0391.xsd', 
                '.|.//*/.', 
            ], 
            '.|.//*/QName' => [
                'field_xpath_0392.xsd', 
                '.|.//*/q2:name2', 
            ], 
            '.|.//*/*' => [
                'field_xpath_0393.xsd', 
                '.|.//*/*', 
            ], 
            '.|.//*/NCName:*' => [
                'field_xpath_0394.xsd', 
                '.|.//*/n2:*', 
            ], 
            '.|.//NCName:*/.' => [
                'field_xpath_0395.xsd', 
                '.|.//n1:*/.', 
            ], 
            '.|.//NCName:*/QName' => [
                'field_xpath_0396.xsd', 
                '.|.//n1:*/q2:name2', 
            ], 
            '.|.//NCName:*/*' => [
                'field_xpath_0397.xsd', 
                '.|.//n1:*/*', 
            ], 
            '.|.//NCName:*/NCName:*' => [
                'field_xpath_0398.xsd', 
                '.|.//n1:*/n2:*', 
            ], 
            '.|.//./@QName' => [
                'field_xpath_0399.xsd', 
                '.|.//./@q3:name3', 
            ], 
            '.|.//./@*' => [
                'field_xpath_0400.xsd', 
                '.|.//./@*', 
            ], 
            '.|.//./@NCName:*' => [
                'field_xpath_0401.xsd', 
                '.|.//./@n3:*', 
            ], 
            '.|.//QName/@QName' => [
                'field_xpath_0402.xsd', 
                '.|.//q1:name1/@q3:name3', 
            ], 
            '.|.//QName/@*' => [
                'field_xpath_0403.xsd', 
                '.|.//q1:name1/@*', 
            ], 
            '.|.//QName/@NCName:*' => [
                'field_xpath_0404.xsd', 
                '.|.//q1:name1/@n3:*', 
            ], 
            '.|.//*/@QName' => [
                'field_xpath_0405.xsd', 
                '.|.//*/@q3:name3', 
            ], 
            '.|.//*/@*' => [
                'field_xpath_0406.xsd', 
                '.|.//*/@*', 
            ], 
            '.|.//*/@NCName:*' => [
                'field_xpath_0407.xsd', 
                '.|.//*/@n3:*', 
            ], 
            '.|.//NCName:*/@QName' => [
                'field_xpath_0408.xsd', 
                '.|.//n1:*/@q3:name3', 
            ], 
            '.|.//NCName:*/@*' => [
                'field_xpath_0409.xsd', 
                '.|.//n1:*/@*', 
            ], 
            '.|.//NCName:*/@NCName:*' => [
                'field_xpath_0410.xsd', 
                '.|.//n1:*/@n3:*', 
            ], 
            'QName|.//.' => [
                'field_xpath_0411.xsd', 
                'q4:name4|.//.', 
            ], 
            'QName|.//QName' => [
                'field_xpath_0412.xsd', 
                'q4:name4|.//q1:name1', 
            ], 
            'QName|.//*' => [
                'field_xpath_0413.xsd', 
                'q4:name4|.//*', 
            ], 
            'QName|.//NCName:*' => [
                'field_xpath_0414.xsd', 
                'q4:name4|.//n1:*', 
            ], 
            'QName|.//child::QName' => [
                'field_xpath_0415.xsd', 
                'q4:name4|.//child::q3:name3', 
            ], 
            'QName|.//child::*' => [
                'field_xpath_0416.xsd', 
                'q4:name4|.//child::*', 
            ], 
            'QName|.//child::NCName:*' => [
                'field_xpath_0417.xsd', 
                'q4:name4|.//child::n3:*', 
            ], 
            'QName|.//@QName' => [
                'field_xpath_0418.xsd', 
                'q4:name4|.//@q3:name3', 
            ], 
            'QName|.//@*' => [
                'field_xpath_0419.xsd', 
                'q4:name4|.//@*', 
            ], 
            'QName|.//@NCName:*' => [
                'field_xpath_0420.xsd', 
                'q4:name4|.//@n3:*', 
            ], 
            'QName|.//attribute::QName' => [
                'field_xpath_0421.xsd', 
                'q4:name4|.//attribute::q3:name3', 
            ], 
            'QName|.//attribute::*' => [
                'field_xpath_0422.xsd', 
                'q4:name4|.//attribute::*', 
            ], 
            'QName|.//attribute::NCName:*' => [
                'field_xpath_0423.xsd', 
                'q4:name4|.//attribute::n3:*', 
            ], 
            'QName|.//./.' => [
                'field_xpath_0424.xsd', 
                'q4:name4|.//./.', 
            ], 
            'QName|.//./QName' => [
                'field_xpath_0425.xsd', 
                'q4:name4|.//./q2:name2', 
            ], 
            'QName|.//./*' => [
                'field_xpath_0426.xsd', 
                'q4:name4|.//./*', 
            ], 
            'QName|.//./NCName:*' => [
                'field_xpath_0427.xsd', 
                'q4:name4|.//./n2:*', 
            ], 
            'QName|.//QName/.' => [
                'field_xpath_0428.xsd', 
                'q4:name4|.//q1:name1/.', 
            ], 
            'QName|.//QName/QName' => [
                'field_xpath_0429.xsd', 
                'q4:name4|.//q1:name1/q2:name2', 
            ], 
            'QName|.//QName/*' => [
                'field_xpath_0430.xsd', 
                'q4:name4|.//q1:name1/*', 
            ], 
            'QName|.//QName/NCName:*' => [
                'field_xpath_0431.xsd', 
                'q4:name4|.//q1:name1/n2:*', 
            ], 
            'QName|.//*/.' => [
                'field_xpath_0432.xsd', 
                'q4:name4|.//*/.', 
            ], 
            'QName|.//*/QName' => [
                'field_xpath_0433.xsd', 
                'q4:name4|.//*/q2:name2', 
            ], 
            'QName|.//*/*' => [
                'field_xpath_0434.xsd', 
                'q4:name4|.//*/*', 
            ], 
            'QName|.//*/NCName:*' => [
                'field_xpath_0435.xsd', 
                'q4:name4|.//*/n2:*', 
            ], 
            'QName|.//NCName:*/.' => [
                'field_xpath_0436.xsd', 
                'q4:name4|.//n1:*/.', 
            ], 
            'QName|.//NCName:*/QName' => [
                'field_xpath_0437.xsd', 
                'q4:name4|.//n1:*/q2:name2', 
            ], 
            'QName|.//NCName:*/*' => [
                'field_xpath_0438.xsd', 
                'q4:name4|.//n1:*/*', 
            ], 
            'QName|.//NCName:*/NCName:*' => [
                'field_xpath_0439.xsd', 
                'q4:name4|.//n1:*/n2:*', 
            ], 
            'QName|.//./@QName' => [
                'field_xpath_0440.xsd', 
                'q4:name4|.//./@q3:name3', 
            ], 
            'QName|.//./@*' => [
                'field_xpath_0441.xsd', 
                'q4:name4|.//./@*', 
            ], 
            'QName|.//./@NCName:*' => [
                'field_xpath_0442.xsd', 
                'q4:name4|.//./@n3:*', 
            ], 
            'QName|.//QName/@QName' => [
                'field_xpath_0443.xsd', 
                'q4:name4|.//q1:name1/@q3:name3', 
            ], 
            'QName|.//QName/@*' => [
                'field_xpath_0444.xsd', 
                'q4:name4|.//q1:name1/@*', 
            ], 
            'QName|.//QName/@NCName:*' => [
                'field_xpath_0445.xsd', 
                'q4:name4|.//q1:name1/@n3:*', 
            ], 
            'QName|.//*/@QName' => [
                'field_xpath_0446.xsd', 
                'q4:name4|.//*/@q3:name3', 
            ], 
            'QName|.//*/@*' => [
                'field_xpath_0447.xsd', 
                'q4:name4|.//*/@*', 
            ], 
            'QName|.//*/@NCName:*' => [
                'field_xpath_0448.xsd', 
                'q4:name4|.//*/@n3:*', 
            ], 
            'QName|.//NCName:*/@QName' => [
                'field_xpath_0449.xsd', 
                'q4:name4|.//n1:*/@q3:name3', 
            ], 
            'QName|.//NCName:*/@*' => [
                'field_xpath_0450.xsd', 
                'q4:name4|.//n1:*/@*', 
            ], 
            'QName|.//NCName:*/@NCName:*' => [
                'field_xpath_0451.xsd', 
                'q4:name4|.//n1:*/@n3:*', 
            ], 
            '*|.//.' => [
                'field_xpath_0452.xsd', 
                '*|.//.', 
            ], 
            '*|.//QName' => [
                'field_xpath_0453.xsd', 
                '*|.//q1:name1', 
            ], 
            '*|.//*' => [
                'field_xpath_0454.xsd', 
                '*|.//*', 
            ], 
            '*|.//NCName:*' => [
                'field_xpath_0455.xsd', 
                '*|.//n1:*', 
            ], 
            '*|.//child::QName' => [
                'field_xpath_0456.xsd', 
                '*|.//child::q3:name3', 
            ], 
            '*|.//child::*' => [
                'field_xpath_0457.xsd', 
                '*|.//child::*', 
            ], 
            '*|.//child::NCName:*' => [
                'field_xpath_0458.xsd', 
                '*|.//child::n3:*', 
            ], 
            '*|.//@QName' => [
                'field_xpath_0459.xsd', 
                '*|.//@q3:name3', 
            ], 
            '*|.//@*' => [
                'field_xpath_0460.xsd', 
                '*|.//@*', 
            ], 
            '*|.//@NCName:*' => [
                'field_xpath_0461.xsd', 
                '*|.//@n3:*', 
            ], 
            '*|.//attribute::QName' => [
                'field_xpath_0462.xsd', 
                '*|.//attribute::q3:name3', 
            ], 
            '*|.//attribute::*' => [
                'field_xpath_0463.xsd', 
                '*|.//attribute::*', 
            ], 
            '*|.//attribute::NCName:*' => [
                'field_xpath_0464.xsd', 
                '*|.//attribute::n3:*', 
            ], 
            '*|.//./.' => [
                'field_xpath_0465.xsd', 
                '*|.//./.', 
            ], 
            '*|.//./QName' => [
                'field_xpath_0466.xsd', 
                '*|.//./q2:name2', 
            ], 
            '*|.//./*' => [
                'field_xpath_0467.xsd', 
                '*|.//./*', 
            ], 
            '*|.//./NCName:*' => [
                'field_xpath_0468.xsd', 
                '*|.//./n2:*', 
            ], 
            '*|.//QName/.' => [
                'field_xpath_0469.xsd', 
                '*|.//q1:name1/.', 
            ], 
            '*|.//QName/QName' => [
                'field_xpath_0470.xsd', 
                '*|.//q1:name1/q2:name2', 
            ], 
            '*|.//QName/*' => [
                'field_xpath_0471.xsd', 
                '*|.//q1:name1/*', 
            ], 
            '*|.//QName/NCName:*' => [
                'field_xpath_0472.xsd', 
                '*|.//q1:name1/n2:*', 
            ], 
            '*|.//*/.' => [
                'field_xpath_0473.xsd', 
                '*|.//*/.', 
            ], 
            '*|.//*/QName' => [
                'field_xpath_0474.xsd', 
                '*|.//*/q2:name2', 
            ], 
            '*|.//*/*' => [
                'field_xpath_0475.xsd', 
                '*|.//*/*', 
            ], 
            '*|.//*/NCName:*' => [
                'field_xpath_0476.xsd', 
                '*|.//*/n2:*', 
            ], 
            '*|.//NCName:*/.' => [
                'field_xpath_0477.xsd', 
                '*|.//n1:*/.', 
            ], 
            '*|.//NCName:*/QName' => [
                'field_xpath_0478.xsd', 
                '*|.//n1:*/q2:name2', 
            ], 
            '*|.//NCName:*/*' => [
                'field_xpath_0479.xsd', 
                '*|.//n1:*/*', 
            ], 
            '*|.//NCName:*/NCName:*' => [
                'field_xpath_0480.xsd', 
                '*|.//n1:*/n2:*', 
            ], 
            '*|.//./@QName' => [
                'field_xpath_0481.xsd', 
                '*|.//./@q3:name3', 
            ], 
            '*|.//./@*' => [
                'field_xpath_0482.xsd', 
                '*|.//./@*', 
            ], 
            '*|.//./@NCName:*' => [
                'field_xpath_0483.xsd', 
                '*|.//./@n3:*', 
            ], 
            '*|.//QName/@QName' => [
                'field_xpath_0484.xsd', 
                '*|.//q1:name1/@q3:name3', 
            ], 
            '*|.//QName/@*' => [
                'field_xpath_0485.xsd', 
                '*|.//q1:name1/@*', 
            ], 
            '*|.//QName/@NCName:*' => [
                'field_xpath_0486.xsd', 
                '*|.//q1:name1/@n3:*', 
            ], 
            '*|.//*/@QName' => [
                'field_xpath_0487.xsd', 
                '*|.//*/@q3:name3', 
            ], 
            '*|.//*/@*' => [
                'field_xpath_0488.xsd', 
                '*|.//*/@*', 
            ], 
            '*|.//*/@NCName:*' => [
                'field_xpath_0489.xsd', 
                '*|.//*/@n3:*', 
            ], 
            '*|.//NCName:*/@QName' => [
                'field_xpath_0490.xsd', 
                '*|.//n1:*/@q3:name3', 
            ], 
            '*|.//NCName:*/@*' => [
                'field_xpath_0491.xsd', 
                '*|.//n1:*/@*', 
            ], 
            '*|.//NCName:*/@NCName:*' => [
                'field_xpath_0492.xsd', 
                '*|.//n1:*/@n3:*', 
            ], 
            'NCName:*|.//.' => [
                'field_xpath_0493.xsd', 
                'n4:*|.//.', 
            ], 
            'NCName:*|.//QName' => [
                'field_xpath_0494.xsd', 
                'n4:*|.//q1:name1', 
            ], 
            'NCName:*|.//*' => [
                'field_xpath_0495.xsd', 
                'n4:*|.//*', 
            ], 
            'NCName:*|.//NCName:*' => [
                'field_xpath_0496.xsd', 
                'n4:*|.//n1:*', 
            ], 
            'NCName:*|.//child::QName' => [
                'field_xpath_0497.xsd', 
                'n4:*|.//child::q3:name3', 
            ], 
            'NCName:*|.//child::*' => [
                'field_xpath_0498.xsd', 
                'n4:*|.//child::*', 
            ], 
            'NCName:*|.//child::NCName:*' => [
                'field_xpath_0499.xsd', 
                'n4:*|.//child::n3:*', 
            ], 
            'NCName:*|.//@QName' => [
                'field_xpath_0500.xsd', 
                'n4:*|.//@q3:name3', 
            ], 
            'NCName:*|.//@*' => [
                'field_xpath_0501.xsd', 
                'n4:*|.//@*', 
            ], 
            'NCName:*|.//@NCName:*' => [
                'field_xpath_0502.xsd', 
                'n4:*|.//@n3:*', 
            ], 
            'NCName:*|.//attribute::QName' => [
                'field_xpath_0503.xsd', 
                'n4:*|.//attribute::q3:name3', 
            ], 
            'NCName:*|.//attribute::*' => [
                'field_xpath_0504.xsd', 
                'n4:*|.//attribute::*', 
            ], 
            'NCName:*|.//attribute::NCName:*' => [
                'field_xpath_0505.xsd', 
                'n4:*|.//attribute::n3:*', 
            ], 
            'NCName:*|.//./.' => [
                'field_xpath_0506.xsd', 
                'n4:*|.//./.', 
            ], 
            'NCName:*|.//./QName' => [
                'field_xpath_0507.xsd', 
                'n4:*|.//./q2:name2', 
            ], 
            'NCName:*|.//./*' => [
                'field_xpath_0508.xsd', 
                'n4:*|.//./*', 
            ], 
            'NCName:*|.//./NCName:*' => [
                'field_xpath_0509.xsd', 
                'n4:*|.//./n2:*', 
            ], 
            'NCName:*|.//QName/.' => [
                'field_xpath_0510.xsd', 
                'n4:*|.//q1:name1/.', 
            ], 
            'NCName:*|.//QName/QName' => [
                'field_xpath_0511.xsd', 
                'n4:*|.//q1:name1/q2:name2', 
            ], 
            'NCName:*|.//QName/*' => [
                'field_xpath_0512.xsd', 
                'n4:*|.//q1:name1/*', 
            ], 
            'NCName:*|.//QName/NCName:*' => [
                'field_xpath_0513.xsd', 
                'n4:*|.//q1:name1/n2:*', 
            ], 
            'NCName:*|.//*/.' => [
                'field_xpath_0514.xsd', 
                'n4:*|.//*/.', 
            ], 
            'NCName:*|.//*/QName' => [
                'field_xpath_0515.xsd', 
                'n4:*|.//*/q2:name2', 
            ], 
            'NCName:*|.//*/*' => [
                'field_xpath_0516.xsd', 
                'n4:*|.//*/*', 
            ], 
            'NCName:*|.//*/NCName:*' => [
                'field_xpath_0517.xsd', 
                'n4:*|.//*/n2:*', 
            ], 
            'NCName:*|.//NCName:*/.' => [
                'field_xpath_0518.xsd', 
                'n4:*|.//n1:*/.', 
            ], 
            'NCName:*|.//NCName:*/QName' => [
                'field_xpath_0519.xsd', 
                'n4:*|.//n1:*/q2:name2', 
            ], 
            'NCName:*|.//NCName:*/*' => [
                'field_xpath_0520.xsd', 
                'n4:*|.//n1:*/*', 
            ], 
            'NCName:*|.//NCName:*/NCName:*' => [
                'field_xpath_0521.xsd', 
                'n4:*|.//n1:*/n2:*', 
            ], 
            'NCName:*|.//./@QName' => [
                'field_xpath_0522.xsd', 
                'n4:*|.//./@q3:name3', 
            ], 
            'NCName:*|.//./@*' => [
                'field_xpath_0523.xsd', 
                'n4:*|.//./@*', 
            ], 
            'NCName:*|.//./@NCName:*' => [
                'field_xpath_0524.xsd', 
                'n4:*|.//./@n3:*', 
            ], 
            'NCName:*|.//QName/@QName' => [
                'field_xpath_0525.xsd', 
                'n4:*|.//q1:name1/@q3:name3', 
            ], 
            'NCName:*|.//QName/@*' => [
                'field_xpath_0526.xsd', 
                'n4:*|.//q1:name1/@*', 
            ], 
            'NCName:*|.//QName/@NCName:*' => [
                'field_xpath_0527.xsd', 
                'n4:*|.//q1:name1/@n3:*', 
            ], 
            'NCName:*|.//*/@QName' => [
                'field_xpath_0528.xsd', 
                'n4:*|.//*/@q3:name3', 
            ], 
            'NCName:*|.//*/@*' => [
                'field_xpath_0529.xsd', 
                'n4:*|.//*/@*', 
            ], 
            'NCName:*|.//*/@NCName:*' => [
                'field_xpath_0530.xsd', 
                'n4:*|.//*/@n3:*', 
            ], 
            'NCName:*|.//NCName:*/@QName' => [
                'field_xpath_0531.xsd', 
                'n4:*|.//n1:*/@q3:name3', 
            ], 
            'NCName:*|.//NCName:*/@*' => [
                'field_xpath_0532.xsd', 
                'n4:*|.//n1:*/@*', 
            ], 
            'NCName:*|.//NCName:*/@NCName:*' => [
                'field_xpath_0533.xsd', 
                'n4:*|.//n1:*/@n3:*', 
            ], 
            '@QName|.//.' => [
                'field_xpath_0534.xsd', 
                '@q5:name5|.//.', 
            ], 
            '@QName|.//QName' => [
                'field_xpath_0535.xsd', 
                '@q5:name5|.//q1:name1', 
            ], 
            '@QName|.//*' => [
                'field_xpath_0536.xsd', 
                '@q5:name5|.//*', 
            ], 
            '@QName|.//NCName:*' => [
                'field_xpath_0537.xsd', 
                '@q5:name5|.//n1:*', 
            ], 
            '@QName|.//child::QName' => [
                'field_xpath_0538.xsd', 
                '@q5:name5|.//child::q3:name3', 
            ], 
            '@QName|.//child::*' => [
                'field_xpath_0539.xsd', 
                '@q5:name5|.//child::*', 
            ], 
            '@QName|.//child::NCName:*' => [
                'field_xpath_0540.xsd', 
                '@q5:name5|.//child::n3:*', 
            ], 
            '@QName|.//@QName' => [
                'field_xpath_0541.xsd', 
                '@q5:name5|.//@q3:name3', 
            ], 
            '@QName|.//@*' => [
                'field_xpath_0542.xsd', 
                '@q5:name5|.//@*', 
            ], 
            '@QName|.//@NCName:*' => [
                'field_xpath_0543.xsd', 
                '@q5:name5|.//@n3:*', 
            ], 
            '@QName|.//attribute::QName' => [
                'field_xpath_0544.xsd', 
                '@q5:name5|.//attribute::q3:name3', 
            ], 
            '@QName|.//attribute::*' => [
                'field_xpath_0545.xsd', 
                '@q5:name5|.//attribute::*', 
            ], 
            '@QName|.//attribute::NCName:*' => [
                'field_xpath_0546.xsd', 
                '@q5:name5|.//attribute::n3:*', 
            ], 
            '@QName|.//./.' => [
                'field_xpath_0547.xsd', 
                '@q5:name5|.//./.', 
            ], 
            '@QName|.//./QName' => [
                'field_xpath_0548.xsd', 
                '@q5:name5|.//./q2:name2', 
            ], 
            '@QName|.//./*' => [
                'field_xpath_0549.xsd', 
                '@q5:name5|.//./*', 
            ], 
            '@QName|.//./NCName:*' => [
                'field_xpath_0550.xsd', 
                '@q5:name5|.//./n2:*', 
            ], 
            '@QName|.//QName/.' => [
                'field_xpath_0551.xsd', 
                '@q5:name5|.//q1:name1/.', 
            ], 
            '@QName|.//QName/QName' => [
                'field_xpath_0552.xsd', 
                '@q5:name5|.//q1:name1/q2:name2', 
            ], 
            '@QName|.//QName/*' => [
                'field_xpath_0553.xsd', 
                '@q5:name5|.//q1:name1/*', 
            ], 
            '@QName|.//QName/NCName:*' => [
                'field_xpath_0554.xsd', 
                '@q5:name5|.//q1:name1/n2:*', 
            ], 
            '@QName|.//*/.' => [
                'field_xpath_0555.xsd', 
                '@q5:name5|.//*/.', 
            ], 
            '@QName|.//*/QName' => [
                'field_xpath_0556.xsd', 
                '@q5:name5|.//*/q2:name2', 
            ], 
            '@QName|.//*/*' => [
                'field_xpath_0557.xsd', 
                '@q5:name5|.//*/*', 
            ], 
            '@QName|.//*/NCName:*' => [
                'field_xpath_0558.xsd', 
                '@q5:name5|.//*/n2:*', 
            ], 
            '@QName|.//NCName:*/.' => [
                'field_xpath_0559.xsd', 
                '@q5:name5|.//n1:*/.', 
            ], 
            '@QName|.//NCName:*/QName' => [
                'field_xpath_0560.xsd', 
                '@q5:name5|.//n1:*/q2:name2', 
            ], 
            '@QName|.//NCName:*/*' => [
                'field_xpath_0561.xsd', 
                '@q5:name5|.//n1:*/*', 
            ], 
            '@QName|.//NCName:*/NCName:*' => [
                'field_xpath_0562.xsd', 
                '@q5:name5|.//n1:*/n2:*', 
            ], 
            '@QName|.//./@QName' => [
                'field_xpath_0563.xsd', 
                '@q5:name5|.//./@q3:name3', 
            ], 
            '@QName|.//./@*' => [
                'field_xpath_0564.xsd', 
                '@q5:name5|.//./@*', 
            ], 
            '@QName|.//./@NCName:*' => [
                'field_xpath_0565.xsd', 
                '@q5:name5|.//./@n3:*', 
            ], 
            '@QName|.//QName/@QName' => [
                'field_xpath_0566.xsd', 
                '@q5:name5|.//q1:name1/@q3:name3', 
            ], 
            '@QName|.//QName/@*' => [
                'field_xpath_0567.xsd', 
                '@q5:name5|.//q1:name1/@*', 
            ], 
            '@QName|.//QName/@NCName:*' => [
                'field_xpath_0568.xsd', 
                '@q5:name5|.//q1:name1/@n3:*', 
            ], 
            '@QName|.//*/@QName' => [
                'field_xpath_0569.xsd', 
                '@q5:name5|.//*/@q3:name3', 
            ], 
            '@QName|.//*/@*' => [
                'field_xpath_0570.xsd', 
                '@q5:name5|.//*/@*', 
            ], 
            '@QName|.//*/@NCName:*' => [
                'field_xpath_0571.xsd', 
                '@q5:name5|.//*/@n3:*', 
            ], 
            '@QName|.//NCName:*/@QName' => [
                'field_xpath_0572.xsd', 
                '@q5:name5|.//n1:*/@q3:name3', 
            ], 
            '@QName|.//NCName:*/@*' => [
                'field_xpath_0573.xsd', 
                '@q5:name5|.//n1:*/@*', 
            ], 
            '@QName|.//NCName:*/@NCName:*' => [
                'field_xpath_0574.xsd', 
                '@q5:name5|.//n1:*/@n3:*', 
            ], 
            '@*|.//.' => [
                'field_xpath_0575.xsd', 
                '@*|.//.', 
            ], 
            '@*|.//QName' => [
                'field_xpath_0576.xsd', 
                '@*|.//q1:name1', 
            ], 
            '@*|.//*' => [
                'field_xpath_0577.xsd', 
                '@*|.//*', 
            ], 
            '@*|.//NCName:*' => [
                'field_xpath_0578.xsd', 
                '@*|.//n1:*', 
            ], 
            '@*|.//child::QName' => [
                'field_xpath_0579.xsd', 
                '@*|.//child::q3:name3', 
            ], 
            '@*|.//child::*' => [
                'field_xpath_0580.xsd', 
                '@*|.//child::*', 
            ], 
            '@*|.//child::NCName:*' => [
                'field_xpath_0581.xsd', 
                '@*|.//child::n3:*', 
            ], 
            '@*|.//@QName' => [
                'field_xpath_0582.xsd', 
                '@*|.//@q3:name3', 
            ], 
            '@*|.//@*' => [
                'field_xpath_0583.xsd', 
                '@*|.//@*', 
            ], 
            '@*|.//@NCName:*' => [
                'field_xpath_0584.xsd', 
                '@*|.//@n3:*', 
            ], 
            '@*|.//attribute::QName' => [
                'field_xpath_0585.xsd', 
                '@*|.//attribute::q3:name3', 
            ], 
            '@*|.//attribute::*' => [
                'field_xpath_0586.xsd', 
                '@*|.//attribute::*', 
            ], 
            '@*|.//attribute::NCName:*' => [
                'field_xpath_0587.xsd', 
                '@*|.//attribute::n3:*', 
            ], 
            '@*|.//./.' => [
                'field_xpath_0588.xsd', 
                '@*|.//./.', 
            ], 
            '@*|.//./QName' => [
                'field_xpath_0589.xsd', 
                '@*|.//./q2:name2', 
            ], 
            '@*|.//./*' => [
                'field_xpath_0590.xsd', 
                '@*|.//./*', 
            ], 
            '@*|.//./NCName:*' => [
                'field_xpath_0591.xsd', 
                '@*|.//./n2:*', 
            ], 
            '@*|.//QName/.' => [
                'field_xpath_0592.xsd', 
                '@*|.//q1:name1/.', 
            ], 
            '@*|.//QName/QName' => [
                'field_xpath_0593.xsd', 
                '@*|.//q1:name1/q2:name2', 
            ], 
            '@*|.//QName/*' => [
                'field_xpath_0594.xsd', 
                '@*|.//q1:name1/*', 
            ], 
            '@*|.//QName/NCName:*' => [
                'field_xpath_0595.xsd', 
                '@*|.//q1:name1/n2:*', 
            ], 
            '@*|.//*/.' => [
                'field_xpath_0596.xsd', 
                '@*|.//*/.', 
            ], 
            '@*|.//*/QName' => [
                'field_xpath_0597.xsd', 
                '@*|.//*/q2:name2', 
            ], 
            '@*|.//*/*' => [
                'field_xpath_0598.xsd', 
                '@*|.//*/*', 
            ], 
            '@*|.//*/NCName:*' => [
                'field_xpath_0599.xsd', 
                '@*|.//*/n2:*', 
            ], 
            '@*|.//NCName:*/.' => [
                'field_xpath_0600.xsd', 
                '@*|.//n1:*/.', 
            ], 
            '@*|.//NCName:*/QName' => [
                'field_xpath_0601.xsd', 
                '@*|.//n1:*/q2:name2', 
            ], 
            '@*|.//NCName:*/*' => [
                'field_xpath_0602.xsd', 
                '@*|.//n1:*/*', 
            ], 
            '@*|.//NCName:*/NCName:*' => [
                'field_xpath_0603.xsd', 
                '@*|.//n1:*/n2:*', 
            ], 
            '@*|.//./@QName' => [
                'field_xpath_0604.xsd', 
                '@*|.//./@q3:name3', 
            ], 
            '@*|.//./@*' => [
                'field_xpath_0605.xsd', 
                '@*|.//./@*', 
            ], 
            '@*|.//./@NCName:*' => [
                'field_xpath_0606.xsd', 
                '@*|.//./@n3:*', 
            ], 
            '@*|.//QName/@QName' => [
                'field_xpath_0607.xsd', 
                '@*|.//q1:name1/@q3:name3', 
            ], 
            '@*|.//QName/@*' => [
                'field_xpath_0608.xsd', 
                '@*|.//q1:name1/@*', 
            ], 
            '@*|.//QName/@NCName:*' => [
                'field_xpath_0609.xsd', 
                '@*|.//q1:name1/@n3:*', 
            ], 
            '@*|.//*/@QName' => [
                'field_xpath_0610.xsd', 
                '@*|.//*/@q3:name3', 
            ], 
            '@*|.//*/@*' => [
                'field_xpath_0611.xsd', 
                '@*|.//*/@*', 
            ], 
            '@*|.//*/@NCName:*' => [
                'field_xpath_0612.xsd', 
                '@*|.//*/@n3:*', 
            ], 
            '@*|.//NCName:*/@QName' => [
                'field_xpath_0613.xsd', 
                '@*|.//n1:*/@q3:name3', 
            ], 
            '@*|.//NCName:*/@*' => [
                'field_xpath_0614.xsd', 
                '@*|.//n1:*/@*', 
            ], 
            '@*|.//NCName:*/@NCName:*' => [
                'field_xpath_0615.xsd', 
                '@*|.//n1:*/@n3:*', 
            ], 
            '@NCName:*|.//.' => [
                'field_xpath_0616.xsd', 
                '@n5:*|.//.', 
            ], 
            '@NCName:*|.//QName' => [
                'field_xpath_0617.xsd', 
                '@n5:*|.//q1:name1', 
            ], 
            '@NCName:*|.//*' => [
                'field_xpath_0618.xsd', 
                '@n5:*|.//*', 
            ], 
            '@NCName:*|.//NCName:*' => [
                'field_xpath_0619.xsd', 
                '@n5:*|.//n1:*', 
            ], 
            '@NCName:*|.//child::QName' => [
                'field_xpath_0620.xsd', 
                '@n5:*|.//child::q3:name3', 
            ], 
            '@NCName:*|.//child::*' => [
                'field_xpath_0621.xsd', 
                '@n5:*|.//child::*', 
            ], 
            '@NCName:*|.//child::NCName:*' => [
                'field_xpath_0622.xsd', 
                '@n5:*|.//child::n3:*', 
            ], 
            '@NCName:*|.//@QName' => [
                'field_xpath_0623.xsd', 
                '@n5:*|.//@q3:name3', 
            ], 
            '@NCName:*|.//@*' => [
                'field_xpath_0624.xsd', 
                '@n5:*|.//@*', 
            ], 
            '@NCName:*|.//@NCName:*' => [
                'field_xpath_0625.xsd', 
                '@n5:*|.//@n3:*', 
            ], 
            '@NCName:*|.//attribute::QName' => [
                'field_xpath_0626.xsd', 
                '@n5:*|.//attribute::q3:name3', 
            ], 
            '@NCName:*|.//attribute::*' => [
                'field_xpath_0627.xsd', 
                '@n5:*|.//attribute::*', 
            ], 
            '@NCName:*|.//attribute::NCName:*' => [
                'field_xpath_0628.xsd', 
                '@n5:*|.//attribute::n3:*', 
            ], 
            '@NCName:*|.//./.' => [
                'field_xpath_0629.xsd', 
                '@n5:*|.//./.', 
            ], 
            '@NCName:*|.//./QName' => [
                'field_xpath_0630.xsd', 
                '@n5:*|.//./q2:name2', 
            ], 
            '@NCName:*|.//./*' => [
                'field_xpath_0631.xsd', 
                '@n5:*|.//./*', 
            ], 
            '@NCName:*|.//./NCName:*' => [
                'field_xpath_0632.xsd', 
                '@n5:*|.//./n2:*', 
            ], 
            '@NCName:*|.//QName/.' => [
                'field_xpath_0633.xsd', 
                '@n5:*|.//q1:name1/.', 
            ], 
            '@NCName:*|.//QName/QName' => [
                'field_xpath_0634.xsd', 
                '@n5:*|.//q1:name1/q2:name2', 
            ], 
            '@NCName:*|.//QName/*' => [
                'field_xpath_0635.xsd', 
                '@n5:*|.//q1:name1/*', 
            ], 
            '@NCName:*|.//QName/NCName:*' => [
                'field_xpath_0636.xsd', 
                '@n5:*|.//q1:name1/n2:*', 
            ], 
            '@NCName:*|.//*/.' => [
                'field_xpath_0637.xsd', 
                '@n5:*|.//*/.', 
            ], 
            '@NCName:*|.//*/QName' => [
                'field_xpath_0638.xsd', 
                '@n5:*|.//*/q2:name2', 
            ], 
            '@NCName:*|.//*/*' => [
                'field_xpath_0639.xsd', 
                '@n5:*|.//*/*', 
            ], 
            '@NCName:*|.//*/NCName:*' => [
                'field_xpath_0640.xsd', 
                '@n5:*|.//*/n2:*', 
            ], 
            '@NCName:*|.//NCName:*/.' => [
                'field_xpath_0641.xsd', 
                '@n5:*|.//n1:*/.', 
            ], 
            '@NCName:*|.//NCName:*/QName' => [
                'field_xpath_0642.xsd', 
                '@n5:*|.//n1:*/q2:name2', 
            ], 
            '@NCName:*|.//NCName:*/*' => [
                'field_xpath_0643.xsd', 
                '@n5:*|.//n1:*/*', 
            ], 
            '@NCName:*|.//NCName:*/NCName:*' => [
                'field_xpath_0644.xsd', 
                '@n5:*|.//n1:*/n2:*', 
            ], 
            '@NCName:*|.//./@QName' => [
                'field_xpath_0645.xsd', 
                '@n5:*|.//./@q3:name3', 
            ], 
            '@NCName:*|.//./@*' => [
                'field_xpath_0646.xsd', 
                '@n5:*|.//./@*', 
            ], 
            '@NCName:*|.//./@NCName:*' => [
                'field_xpath_0647.xsd', 
                '@n5:*|.//./@n3:*', 
            ], 
            '@NCName:*|.//QName/@QName' => [
                'field_xpath_0648.xsd', 
                '@n5:*|.//q1:name1/@q3:name3', 
            ], 
            '@NCName:*|.//QName/@*' => [
                'field_xpath_0649.xsd', 
                '@n5:*|.//q1:name1/@*', 
            ], 
            '@NCName:*|.//QName/@NCName:*' => [
                'field_xpath_0650.xsd', 
                '@n5:*|.//q1:name1/@n3:*', 
            ], 
            '@NCName:*|.//*/@QName' => [
                'field_xpath_0651.xsd', 
                '@n5:*|.//*/@q3:name3', 
            ], 
            '@NCName:*|.//*/@*' => [
                'field_xpath_0652.xsd', 
                '@n5:*|.//*/@*', 
            ], 
            '@NCName:*|.//*/@NCName:*' => [
                'field_xpath_0653.xsd', 
                '@n5:*|.//*/@n3:*', 
            ], 
            '@NCName:*|.//NCName:*/@QName' => [
                'field_xpath_0654.xsd', 
                '@n5:*|.//n1:*/@q3:name3', 
            ], 
            '@NCName:*|.//NCName:*/@*' => [
                'field_xpath_0655.xsd', 
                '@n5:*|.//n1:*/@*', 
            ], 
            '@NCName:*|.//NCName:*/@NCName:*' => [
                'field_xpath_0656.xsd', 
                '@n5:*|.//n1:*/@n3:*', 
            ], 
        ];
    }
}
