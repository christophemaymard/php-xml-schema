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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_ANY}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnyParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName(): string
    {
        return 'any';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations(): void
    {
        $sch = $this->sut->parse($this->getXs('any_0006.xsd'));
        
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(1, $elt->getElements());
        
        $ct2 = $elt->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct2);
        self::assertComplexTypeElementHasNoAttribute($ct2);
        self::assertCount(1, $ct2->getElements());
        
        $choice = $ct2->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(1, $choice->getElements());
        
        $seq = $choice->getSequenceElements()[0];
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(1, $seq->getElements());
        
        $any = $seq->getAnyElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $any
        );
        self::assertAnyElementHasNoAttribute($any);
        self::assertSame([], $any->getElements());
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
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertCount(1, $all->getElements());
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(1, $elt->getElements());
        
        $ct2 = $elt->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct2);
        self::assertComplexTypeElementHasNoAttribute($ct2);
        self::assertCount(1, $ct2->getElements());
        
        $choice = $ct2->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(1, $choice->getElements());
        
        $seq = $choice->getSequenceElements()[0];
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(1, $seq->getElements());
        
        $any = $seq->getAnyElements()[0];
        self::assertElementNamespaceDeclarations([], $any);
        self::assertAnyElementHasOnlyIdAttribute($any);
        self::assertSame($id, $any->getId()->getId());
        self::assertSame([], $any->getElements());
    }
    
    /**
     * Tests that parse() processes "maxOccurs" attribute when the value is 
     * "unbounded".
     * 
     * @group   attribute
     */
    public function testParseProcessMaxOccursAttributeWhenValueIsUnbounded(): void
    {
        $sch = $this->sut->parse($this->getXs('any_maxOccurs_0001.xsd'));
        
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(1, $elt->getElements());
        
        $ct2 = $elt->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct2);
        self::assertComplexTypeElementHasNoAttribute($ct2);
        self::assertCount(1, $ct2->getElements());
        
        $choice = $ct2->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(1, $choice->getElements());
        
        $seq = $choice->getSequenceElements()[0];
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(1, $seq->getElements());
        
        $any = $seq->getAnyElements()[0];
        self::assertElementNamespaceDeclarations([], $any);
        self::assertAnyElementHasOnlyMaxOccursAttribute($any);
        self::assertTrue($any->getMaxOccurs()->isUnlimited());
        self::assertSame([], $any->getElements());
    }
    
    /**
     * Tests that parse() processes "maxOccurs" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   \GMP    $nni        The expected value for the non-negative integer.
     * 
     * @group           attribute
     * @dataProvider    getValidMaxOccursAttributes
     */
    public function testParseProcessMaxOccursAttribute(string $fileName, \GMP $nni): void
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(1, $elt->getElements());
        
        $ct2 = $elt->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct2);
        self::assertComplexTypeElementHasNoAttribute($ct2);
        self::assertCount(1, $ct2->getElements());
        
        $choice = $ct2->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(1, $choice->getElements());
        
        $seq = $choice->getSequenceElements()[0];
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(1, $seq->getElements());
        
        $any = $seq->getAnyElements()[0];
        self::assertElementNamespaceDeclarations([], $any);
        self::assertAnyElementHasOnlyMaxOccursAttribute($any);
        self::assertEquals($nni, $any->getMaxOccurs()->getLimit()->getNonNegativeInteger());
        self::assertSame([], $any->getElements());
    }
    
    /**
     * Tests that parse() processes "minOccurs" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   \GMP    $nni        The expected value for the non-negative integer.
     * 
     * @group           attribute
     * @dataProvider    getValidMinOccursAttributes
     */
    public function testParseProcessMinOccursAttribute(string $fileName, \GMP $nni): void
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(1, $elt->getElements());
        
        $ct2 = $elt->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct2);
        self::assertComplexTypeElementHasNoAttribute($ct2);
        self::assertCount(1, $ct2->getElements());
        
        $choice = $ct2->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(1, $choice->getElements());
        
        $seq = $choice->getSequenceElements()[0];
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(1, $seq->getElements());
        
        $any = $seq->getAnyElements()[0];
        self::assertElementNamespaceDeclarations([], $any);
        self::assertAnyElementHasOnlyMinOccursAttribute($any);
        self::assertEquals($nni, $any->getMinOccurs()->getNonNegativeInteger());
        self::assertSame([], $any->getElements());
    }
    
    /**
     * Tests that parse() processes "namespace" attribute.
     * 
     * @param   string      $fileName   The name of the file used for the test.
     * @param   bool        $any        The expected value for the "any" flag.
     * @param   bool        $other      The expected value for the "other" flag.
     * @param   bool        $targetNs   The expected value for the "targetNamespace" flag.
     * @param   bool        $local      The expected value for the "local" flag.
     * @param   string[]    $uris       The expected value for the anyURIs.
     * 
     * @group           attribute
     * @dataProvider    getValidNamespaceAttributes
     */
    public function testParseProcessNamespaceAttribute(
        string $fileName, 
        bool $any, 
        bool $other, 
        bool $targetNs, 
        bool $local, 
        array $uris
    ): void
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(1, $elt->getElements());
        
        $ct2 = $elt->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct2);
        self::assertComplexTypeElementHasNoAttribute($ct2);
        self::assertCount(1, $ct2->getElements());
        
        $choice = $ct2->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(1, $choice->getElements());
        
        $seq = $choice->getSequenceElements()[0];
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(1, $seq->getElements());
        
        $anyElt = $seq->getAnyElements()[0];
        self::assertElementNamespaceDeclarations([], $anyElt);
        self::assertAnyElementHasOnlyNamespaceAttribute($anyElt);
        self::assertAnyElementNamespaceAttribute(
            $any, 
            $other, 
            $targetNs, 
            $local, 
            $uris, 
            $anyElt
        );
        self::assertSame([], $anyElt->getElements());
    }
    
    /**
     * Tests that parse() processes "processContents" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   bool    $lax        The expected value for the "lax" flag.
     * @param   bool    $skip       The expected value for the "skip" flag.
     * @param   bool    $strict     The expected value for the "strict" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidProcessContentsAttributes
     */
    public function testParseProcessProcessContentsAttribute(
        string $fileName, 
        bool $lax, 
        bool $skip, 
        bool $strict
    ): void
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(1, $elt->getElements());
        
        $ct2 = $elt->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct2);
        self::assertComplexTypeElementHasNoAttribute($ct2);
        self::assertCount(1, $ct2->getElements());
        
        $choice = $ct2->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(1, $choice->getElements());
        
        $seq = $choice->getSequenceElements()[0];
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(1, $seq->getElements());
        
        $any = $seq->getAnyElements()[0];
        self::assertElementNamespaceDeclarations([], $any);
        self::assertAnyElementHasOnlyProcessContentsAttribute($any);
        self::assertSame($lax, $any->getProcessContents()->isLax());
        self::assertSame($skip, $any->getProcessContents()->isSkip());
        self::assertSame($strict, $any->getProcessContents()->isStrict());
        self::assertSame([], $any->getElements());
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
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertCount(1, $all->getElements());
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasNoAttribute($elt);
        self::assertCount(1, $elt->getElements());
        
        $ct2 = $elt->getTypeElement();
        self::assertElementNamespaceDeclarations([], $ct2);
        self::assertComplexTypeElementHasNoAttribute($ct2);
        self::assertCount(1, $ct2->getElements());
        
        $choice = $ct2->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $choice);
        self::assertChoiceElementHasNoAttribute($choice);
        self::assertCount(1, $choice->getElements());
        
        $seq = $choice->getSequenceElements()[0];
        self::assertElementNamespaceDeclarations([], $seq);
        self::assertSequenceElementHasNoAttribute($seq);
        self::assertCount(1, $seq->getElements());
        
        $any = $seq->getAnyElements()[0];
        self::assertElementNamespaceDeclarations([], $any);
        self::assertAnyElementHasNoAttribute($any);
        self::assertCount(1, $any->getElements());
        
        $ann = $any->getAnnotationElement();
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
                'any_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'any_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'any_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'any_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'any_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'any_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'any_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'any_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "maxOccurs" attributes.
     * 
     * @return  array[]
     */
    public function getValidMaxOccursAttributes(): array
    {
        return [
            '0' => [
                'any_maxOccurs_0002.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign' => [
                'any_maxOccurs_0003.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign and leading zeroes' => [
                'any_maxOccurs_0004.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign, leading zeroes and surrounded by white spaces' => [
                'any_maxOccurs_0005.xsd', 
                \gmp_init(0), 
            ], 
            '1234567890' => [
                'any_maxOccurs_0006.xsd', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign' => [
                'any_maxOccurs_0007.xsd', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign and leading zeroes' => [
                'any_maxOccurs_0008.xsd', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign, leading zeroes and surrounded by white spaces' => [
                'any_maxOccurs_0009.xsd', 
                \gmp_init(1234567890), 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "minOccurs" attributes.
     * 
     * @return  array[]
     */
    public function getValidMinOccursAttributes(): array
    {
        return [
            '0' => [
                'any_minOccurs_0001.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign' => [
                'any_minOccurs_0002.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign and leading zeroes' => [
                'any_minOccurs_0003.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign, leading zeroes and surrounded by white spaces' => [
                'any_minOccurs_0004.xsd', 
                \gmp_init(0), 
            ], 
            '1234567890' => [
                'any_minOccurs_0005.xsd', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign' => [
                'any_minOccurs_0006.xsd', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign and leading zeroes' => [
                'any_minOccurs_0007.xsd', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign, leading zeroes and surrounded by white spaces' => [
                'any_minOccurs_0008.xsd', 
                \gmp_init(1234567890), 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "namespace" attributes.
     * 
     * @return  array[]
     */
    public function getValidNamespaceAttributes(): array
    {
        // [ $fileName, $any, $other, $targetNamespace, $local, $uris, ]
        return [
            'Empty string' => [
                'any_namespace_0001.xsd', 
                FALSE, 
                FALSE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            'Only white spaces' => [
                'any_namespace_0002.xsd', 
                FALSE, 
                FALSE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            '##any' => [
                'any_namespace_0003.xsd', 
                TRUE, 
                FALSE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            '##other' => [
                'any_namespace_0004.xsd', 
                FALSE, 
                TRUE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            '##targetNamespace' => [
                'any_namespace_0005.xsd', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [], 
            ], 
            '##targetNamespace surrounded by white spaces' => [
                'any_namespace_0006.xsd', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [], 
            ], 
            'Duplicated ##targetNamespace' => [
                'any_namespace_0007.xsd', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [], 
            ], 
            '##local' => [
                'any_namespace_0008.xsd', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [], 
            ], 
            '##local surrounded by white spaces' => [
                'any_namespace_0009.xsd', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [], 
            ], 
            'Duplicated ##local' => [
                'any_namespace_0010.xsd', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [], 
            ], 
            '##targetNamespace and ##local' => [
                'any_namespace_0011.xsd', 
                FALSE, 
                FALSE, 
                TRUE, 
                TRUE, 
                [], 
            ], 
            '##targetNamespace and 1 anyURI' => [
                'any_namespace_0012.xsd', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [
                    'http://example.org/foo', 
                ], 
            ], 
            '##local and 1 anyURI' => [
                'any_namespace_0013.xsd', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [
                    'http://example.org/foo', 
                ], 
            ], 
            '##targetNamespace and 2 anyURI' => [
                'any_namespace_0014.xsd', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [
                    'http://example.org/foo', 
                    'http://example.org/bar', 
                ], 
            ], 
            '##local and 2 anyURI' => [
                'any_namespace_0015.xsd', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [
                    'http://example.org/foo', 
                    'http://example.org/bar', 
                ], 
            ], 
            '##targetNamespace, ##local and 2 AnyURI' => [
                'any_namespace_0016.xsd', 
                FALSE, 
                FALSE, 
                TRUE, 
                TRUE, 
                [
                    'http://example.org/foo', 
                    'http://example.org/bar', 
                ], 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "processContents" attributes.
     * 
     * @return  array[]
     */
    public function getValidProcessContentsAttributes(): array
    {
        // [ $fileName, $lax, $skip, $strict, ]
        return [
            'lax' => [
                'any_processContents_0001.xsd', TRUE, FALSE, FALSE, 
            ], 
            'skip' => [
                'any_processContents_0002.xsd', FALSE, TRUE, FALSE, 
            ], 
            'strict' => [
                'any_processContents_0003.xsd', FALSE, FALSE, TRUE, 
            ], 
        ];
    }
}
