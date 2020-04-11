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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_WHITESPACE}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class WhiteSpaceParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName(): string
    {
        return 'whiteSpace';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations(): void
    {
        $sch = $this->sut->parse($this->getXs('whiteSpace_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $st = $attr->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertCount(1, $st->getElements());
        
        $res = $st->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $wp = $res->getWhiteSpaceElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $wp
        );
        self::assertWhiteSpaceElementHasNoAttribute($wp);
        self::assertSame([], $wp->getElements());
    }
    
    /**
     * Tests that parse() processes "fixed" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $bool       The expected value for the boolean.
     * 
     * @group           attribute
     * @dataProvider    getValidFixedAttributes
     */
    public function testParseProcessFixedAttribute(string $fileName, bool $bool): void
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
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $st = $attr->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertCount(1, $st->getElements());
        
        $res = $st->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $wp = $res->getWhiteSpaceElements()[0];
        self::assertElementNamespaceDeclarations([], $wp);
        self::assertWhiteSpaceElementHasOnlyFixedAttribute($wp);
        self::assertSame($bool, $wp->getFixed());
        self::assertSame([], $wp->getElements());
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
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $st = $attr->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertCount(1, $st->getElements());
        
        $res = $st->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $wp = $res->getWhiteSpaceElements()[0];
        self::assertElementNamespaceDeclarations([], $wp);
        self::assertWhiteSpaceElementHasOnlyIdAttribute($wp);
        self::assertSame($id, $wp->getId()->getId());
        self::assertSame([], $wp->getElements());
    }
    
    /**
     * Tests that parse() processes "value" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   bool    $coll       The expected value for the collapse flag.
     * @param   bool    $pres       The expected value for the preserve flag.
     * @param   bool    $rep        The expected value for the replace flag.
     * 
     * @group           attribute
     * @dataProvider    getValidValueAttributes
     */
    public function testParseProcessValueAttribute(
        string $fileName, 
        bool $coll,
        bool $pres,
        bool $rep
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
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $st = $attr->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertCount(1, $st->getElements());
        
        $res = $st->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $wp = $res->getWhiteSpaceElements()[0];
        self::assertElementNamespaceDeclarations([], $wp);
        self::assertWhiteSpaceElementHasOnlyValueAttribute($wp);
        self::assertEquals($coll, $wp->getValue()->isCollapse());
        self::assertEquals($pres, $wp->getValue()->isPreserve());
        self::assertEquals($rep, $wp->getValue()->isReplace());
        self::assertSame([], $wp->getElements());
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
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $st = $attr->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertCount(1, $st->getElements());
        
        $res = $st->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $wp = $res->getWhiteSpaceElements()[0];
        self::assertElementNamespaceDeclarations([], $wp);
        self::assertWhiteSpaceElementHasNoAttribute($wp);
        self::assertCount(1, $wp->getElements());
        
        $ann = $wp->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Returns a set of valid "fixed" attributes.
     * 
     * @return  array[]
     */
    public function getValidFixedAttributes(): array
    {
        return [
            'true (string)' => [
                'whiteSpace_fixed_0001.xsd', 
                TRUE, 
            ], 
            'true (numeric)' => [
                'whiteSpace_fixed_0002.xsd', 
                TRUE, 
            ], 
            'true (string) surrounded by white spaces' => [
                'whiteSpace_fixed_0003.xsd', 
                TRUE, 
            ], 
            'true (numeric) surrounded by white spaces' => [
                'whiteSpace_fixed_0004.xsd', 
                TRUE, 
            ], 
            'false (string)' => [
                'whiteSpace_fixed_0005.xsd', 
                FALSE, 
            ], 
            'false (numeric)' => [
                'whiteSpace_fixed_0006.xsd', 
                FALSE, 
            ], 
            'false (string) surrounded by white spaces' => [
                'whiteSpace_fixed_0007.xsd', 
                FALSE, 
            ], 
            'false (numeric) surrounded by white spaces' => [
                'whiteSpace_fixed_0008.xsd', 
                FALSE, 
            ], 
        ];
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
                'whiteSpace_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'whiteSpace_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'whiteSpace_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'whiteSpace_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'whiteSpace_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'whiteSpace_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'whiteSpace_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'whiteSpace_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "value" attributes.
     * 
     * @return  array[]
     */
    public function getValidValueAttributes(): array
    {
        return [
            'collapse' => [
                'whiteSpace_value_0001.xsd', 
                TRUE, 
                FALSE, 
                FALSE, 
            ], 
            'preserve' => [
                'whiteSpace_value_0002.xsd', 
                FALSE, 
                TRUE, 
                FALSE, 
            ], 
            'replace' => [
                'whiteSpace_value_0003.xsd', 
                FALSE, 
                FALSE, 
                TRUE, 
            ], 
        ];
    }
}
