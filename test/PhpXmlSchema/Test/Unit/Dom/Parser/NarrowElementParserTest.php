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
}
