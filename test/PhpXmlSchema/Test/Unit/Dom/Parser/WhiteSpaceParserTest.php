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
    protected function getContextName():string
    {
        return 'whiteSpace';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
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
    public function testParseProcessFixedAttribute(string $fileName, bool $bool)
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
     * Returns a set of valid "fixed" attributes.
     * 
     * @return  array[]
     */
    public function getValidFixedAttributes():array
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
}
