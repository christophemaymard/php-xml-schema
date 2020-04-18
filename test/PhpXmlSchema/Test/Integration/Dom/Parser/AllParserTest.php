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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_ALL}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AllParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName(): string
    {
        return 'all_all';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations(): void
    {
        $sch = $this->sut->parse($this->getXs('all_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $all
        );
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
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasOnlyIdAttribute($all);
        self::assertSame($id, $all->getId()->getId());
        self::assertSame([], $all->getElements());
    }
    
    /**
     * Tests that parse() processes "maxOccurs" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * 
     * @group           attribute
     * @dataProvider    getValidMaxOccursAttributes
     */
    public function testParseProcessMaxOccursAttribute(string $fileName): void
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
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasOnlyMaxOccursAttribute($all);
        self::assertEquals(\gmp_init(1), $all->getMaxOccurs()->getLimit()->getNonNegativeInteger());
        self::assertSame([], $all->getElements());
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
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $cc);
        self::assertComplexContentElementHasNoAttribute($cc);
        self::assertCount(1, $cc->getElements());
        
        $res = $cc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertComplexContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $all = $res->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasOnlyMinOccursAttribute($all);
        self::assertEquals($nni, $all->getMinOccurs()->getNonNegativeInteger());
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
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
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
        
        $ann = $all->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that parse() processes "element" elements (narrowMaxMin).
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
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
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
        self::assertCount(2, $all->getElements());
        
        $elts = $all->getElementElements();
        
        self::assertElementNamespaceDeclarations([], $elts[0]);
        self::assertElementElementHasNoAttribute($elts[0]);
        self::assertSame([], $elts[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $elts[1]);
        self::assertElementElementHasNoAttribute($elts[1]);
        self::assertSame([], $elts[1]->getElements());
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
                'all_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'all_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'all_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'all_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'all_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'all_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'all_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'all_id_0008.xsd', 'foo_bar', 
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
            '1' => [
                'all_maxOccurs_0001.xsd', 
            ], 
            '1 surrounded by white spaces' => [
                'all_maxOccurs_0002.xsd', 
            ], 
            '1 with positive sign' => [
                'all_maxOccurs_0003.xsd', 
            ], 
            '1 with leading zeroes' => [
                'all_maxOccurs_0004.xsd', 
            ], 
            '1 with positive sign and leading zeroes' => [
                'all_maxOccurs_0005.xsd', 
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
                'all_minOccurs_0001.xsd', 
                \gmp_init(0), 
            ], 
            '0 surrounded by white spaces' => [
                'all_minOccurs_0002.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign' => [
                'all_minOccurs_0003.xsd', 
                \gmp_init(0), 
            ], 
            '0 with leading zeroes' => [
                'all_minOccurs_0004.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign and leading zeroes' => [
                'all_minOccurs_0005.xsd', 
                \gmp_init(0), 
            ], 
            '1' => [
                'all_minOccurs_0006.xsd', 
                \gmp_init(1), 
            ], 
            '1 surrounded by white spaces' => [
                'all_minOccurs_0007.xsd', 
                \gmp_init(1), 
            ], 
            '1 with positive sign' => [
                'all_minOccurs_0008.xsd', 
                \gmp_init(1), 
            ], 
            '1 with leading zeroes' => [
                'all_minOccurs_0009.xsd', 
                \gmp_init(1), 
            ], 
            '1 with positive sign and leading zeroes' => [
                'all_minOccurs_0010.xsd', 
                \gmp_init(1), 
            ], 
        ];
    }
}
