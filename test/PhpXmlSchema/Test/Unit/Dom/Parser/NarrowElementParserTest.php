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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_NARROW_ELEMENT}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NarrowElementParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'narrow_elt';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('element_0006.xsd'));
        
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $elt
        );
        self::assertElementElementHasNoAttribute($elt);
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that parse() processes "block" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   bool    $res        The expected value for the "restriction" flag.
     * @param   bool    $ext        The expected value for the "extension" flag.
     * @param   bool    $sub        The expected value for the "substitution" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidBlockAttributes
     */
    public function testParseProcessBlockAttribute(
        string $fileName,
        bool $res, 
        bool $ext, 
        bool $sub
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
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $cc = $ct->getContentElement();
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyBlockAttribute($elt);
        self::assertElementElementBlockAttribute($res, $ext, $sub, $elt);
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that parse() processes "default" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $string     The expected value for the string.
     * 
     * @group           attribute
     * @dataProvider    getValidDefaultAttributes
     */
    public function testParseProcessDefaultAttribute(
        string $fileName, 
        string $string
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyDefaultAttribute($elt);
        self::assertSame($string, $elt->getDefault()->getString());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that parse() processes "fixed" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $string     The expected value for the string.
     * 
     * @group           attribute
     * @dataProvider    getValidFixedAttributes
     */
    public function testParseProcessFixedAttribute(
        string $fileName, 
        string $string
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyFixedAttribute($elt);
        self::assertSame($string, $elt->getFixed()->getString());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that parse() processes "form" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   bool    $qual       The expected value for the "qualified" flag.
     * @param   bool    $unqual     The expected value for the "unqualified" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidFormAttributes
     */
    public function testParseProcessFormAttribute(
        string $fileName,
        bool $qual, 
        bool $unqual
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyFormAttribute($elt);
        self::assertSame($qual, $elt->getForm()->isQualified());
        self::assertSame($unqual, $elt->getForm()->isUnqualified());
        self::assertSame([], $elt->getElements());
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyIdAttribute($elt);
        self::assertSame($id, $elt->getId()->getId());
        self::assertSame([], $elt->getElements());
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
    public function testParseProcessMaxOccursAttribute(string $fileName, \GMP $nni)
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
        self::assertAllElementHasNoAttribute($all);
        self::assertCount(1, $all->getElements());
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyMaxOccursAttribute($elt);
        self::assertEquals($nni, $elt->getMaxOccurs()->getLimit()->getNonNegativeInteger());
        self::assertSame([], $elt->getElements());
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
    public function testParseProcessMinOccursAttribute(string $fileName, \GMP $nni)
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
        self::assertAllElementHasNoAttribute($all);
        self::assertCount(1, $all->getElements());
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyMinOccursAttribute($elt);
        self::assertEquals($nni, $elt->getMinOccurs()->getNonNegativeInteger());
        self::assertSame([], $elt->getElements());
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
        
        $elt = $all->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyNameAttribute($elt);
        self::assertSame($name, $elt->getName()->getNCName());
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Returns a set of valid "block" attributes.
     * 
     * @return  array[]
     */
    public function getValidBlockAttributes():array
    {
        // [ $fileName, $restriction, $extension, $substitution, ]
        return [
            'Empty string' => [
                'element_block_0001.xsd', FALSE, FALSE, FALSE, 
            ], 
            'Only white spaces' => [
                'element_block_0002.xsd', FALSE, FALSE, FALSE, 
            ], 
            '#all' => [
                'element_block_0003.xsd', TRUE, TRUE, TRUE, 
            ], 
            'extension, restriction and substitution with white spaces' => [
                'element_block_0004.xsd', TRUE, TRUE, TRUE, 
            ], 
            'restriction with white spaces' => [
                'element_block_0005.xsd', TRUE, FALSE, FALSE, 
            ], 
            'extension with white spaces' => [
                'element_block_0006.xsd', FALSE, TRUE, FALSE, 
            ], 
            'substitution with white spaces' => [
                'element_block_0007.xsd', FALSE, FALSE, TRUE, 
            ], 
            'restriction and extension with white spaces' => [
                'element_block_0008.xsd', TRUE, TRUE, FALSE, 
            ], 
            'substitution and restriction with white spaces' => [
                'element_block_0009.xsd', TRUE, FALSE, TRUE, 
            ], 
            'extension and substitution with white spaces' => [
                'element_block_0010.xsd', FALSE, TRUE, TRUE, 
            ], 
            'Duplicated restriction' => [
                'element_block_0011.xsd', TRUE, FALSE, FALSE, 
            ], 
            'Duplicated extension' => [
                'element_block_0012.xsd', FALSE, TRUE, FALSE, 
            ], 
            'Duplicated substitution' => [
                'element_block_0013.xsd', FALSE, FALSE, TRUE, 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "default" attributes.
     * 
     * @return  array[]
     */
    public function getValidDefaultAttributes():array
    {
        return [
            'Empty string' => [
                'element_default_0001.xsd', 
                '', 
            ], 
            'Only white spaces' => [
                'element_default_0002.xsd', 
                '                  ', 
            ], 
            'Alphanumeric' => [
                'element_default_0003.xsd', 
                'foo3bar6baz9', 
            ], 
            'Alphanumeric with white spaces' => [
                'element_default_0004.xsd', 
                '  foo2    bar9   baz8    qux1  ', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "fixed" attributes.
     * 
     * @return  array[]
     */
    public function getValidFixedAttributes():array
    {
        return [
            'Empty string' => [
                'element_fixed_0001.xsd', 
                '', 
            ], 
            'Only white spaces' => [
                'element_fixed_0002.xsd', 
                '                  ', 
            ], 
            'Alphanumeric' => [
                'element_fixed_0003.xsd', 
                'foo3bar6baz9', 
            ], 
            'Alphanumeric with white spaces' => [
                'element_fixed_0004.xsd', 
                '  foo2    bar9   baz8    qux1  ', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "form" attributes.
     * 
     * @return  array[]
     */
    public function getValidFormAttributes():array
    {
        // [ $fileName, $qualified, $unqualified, ]
        return [
            'qualified' => [
                'element_form_0001.xsd', TRUE, FALSE, 
            ], 
            'unqualified' => [
                'element_form_0002.xsd', FALSE, TRUE, 
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
                'element_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'element_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'element_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'element_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'element_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'element_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'element_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'element_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "maxOccurs" attributes.
     * 
     * @return  array[]
     */
    public function getValidMaxOccursAttributes():array
    {
        return [
            '0' => [
                'element_maxOccurs_0001.xsd', 
                \gmp_init(0), 
            ], 
            '0 surrounded by white spaces' => [
                'element_maxOccurs_0002.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign' => [
                'element_maxOccurs_0003.xsd', 
                \gmp_init(0), 
            ], 
            '0 with leading zeroes' => [
                'element_maxOccurs_0004.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign and leading zeroes' => [
                'element_maxOccurs_0005.xsd', 
                \gmp_init(0), 
            ], 
            '1' => [
                'element_maxOccurs_0006.xsd', 
                \gmp_init(1), 
            ], 
            '1 surrounded by white spaces' => [
                'element_maxOccurs_0007.xsd', 
                \gmp_init(1), 
            ], 
            '1 with positive sign' => [
                'element_maxOccurs_0008.xsd', 
                \gmp_init(1), 
            ], 
            '1 with leading zeroes' => [
                'element_maxOccurs_0009.xsd', 
                \gmp_init(1), 
            ], 
            '1 with positive sign and leading zeroes' => [
                'element_maxOccurs_0010.xsd', 
                \gmp_init(1), 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "minOccurs" attributes.
     * 
     * @return  array[]
     */
    public function getValidMinOccursAttributes():array
    {
        return [
            '0' => [
                'element_minOccurs_0001.xsd', 
                \gmp_init(0), 
            ], 
            '0 surrounded by white spaces' => [
                'element_minOccurs_0002.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign' => [
                'element_minOccurs_0003.xsd', 
                \gmp_init(0), 
            ], 
            '0 with leading zeroes' => [
                'element_minOccurs_0004.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign and leading zeroes' => [
                'element_minOccurs_0005.xsd', 
                \gmp_init(0), 
            ], 
            '1' => [
                'element_minOccurs_0006.xsd', 
                \gmp_init(1), 
            ], 
            '1 surrounded by white spaces' => [
                'element_minOccurs_0007.xsd', 
                \gmp_init(1), 
            ], 
            '1 with positive sign' => [
                'element_minOccurs_0008.xsd', 
                \gmp_init(1), 
            ], 
            '1 with leading zeroes' => [
                'element_minOccurs_0009.xsd', 
                \gmp_init(1), 
            ], 
            '1 with positive sign and leading zeroes' => [
                'element_minOccurs_0010.xsd', 
                \gmp_init(1), 
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
                'element_name_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'element_name_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'element_name_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'element_name_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'element_name_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'element_name_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'element_name_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'element_name_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}
