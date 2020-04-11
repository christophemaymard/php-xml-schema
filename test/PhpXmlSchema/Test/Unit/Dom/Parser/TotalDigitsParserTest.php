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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_TOTALDIGITS}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TotalDigitsParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName(): string
    {
        return 'totalDigits';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations(): void
    {
        $sch = $this->sut->parse($this->getXs('totalDigits_0006.xsd'));
        
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
        
        $td = $res->getTotalDigitsElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $td
        );
        self::assertTotalDigitsElementHasNoAttribute($td);
        self::assertSame([], $td->getElements());
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
        
        $td = $res->getTotalDigitsElements()[0];
        self::assertElementNamespaceDeclarations([], $td);
        self::assertTotalDigitsElementHasOnlyFixedAttribute($td);
        self::assertSame($bool, $td->getFixed());
        self::assertSame([], $td->getElements());
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
        
        $td = $res->getTotalDigitsElements()[0];
        self::assertElementNamespaceDeclarations([], $td);
        self::assertTotalDigitsElementHasOnlyIdAttribute($td);
        self::assertSame($id, $td->getId()->getId());
        self::assertSame([], $td->getElements());
    }
    
    /**
     * Tests that parse() processes "value" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   \GMP    $pi         The expected value for the positive integer.
     * 
     * @group           attribute
     * @dataProvider    getValidValueAttributes
     */
    public function testParseProcessValueAttribute(string $fileName, \GMP $pi): void
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
        
        $td = $res->getTotalDigitsElements()[0];
        self::assertElementNamespaceDeclarations([], $td);
        self::assertTotalDigitsElementHasOnlyValueAttribute($td);
        self::assertEquals($pi, $td->getValue()->getPositiveInteger());
        self::assertSame([], $td->getElements());
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
        
        $td = $res->getTotalDigitsElements()[0];
        self::assertElementNamespaceDeclarations([], $td);
        self::assertTotalDigitsElementHasNoAttribute($td);
        self::assertCount(1, $td->getElements());
        
        $ann = $td->getAnnotationElement();
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
                'totalDigits_fixed_0001.xsd', 
                TRUE, 
            ], 
            'true (numeric)' => [
                'totalDigits_fixed_0002.xsd', 
                TRUE, 
            ], 
            'true (string) surrounded by white spaces' => [
                'totalDigits_fixed_0003.xsd', 
                TRUE, 
            ], 
            'true (numeric) surrounded by white spaces' => [
                'totalDigits_fixed_0004.xsd', 
                TRUE, 
            ], 
            'false (string)' => [
                'totalDigits_fixed_0005.xsd', 
                FALSE, 
            ], 
            'false (numeric)' => [
                'totalDigits_fixed_0006.xsd', 
                FALSE, 
            ], 
            'false (string) surrounded by white spaces' => [
                'totalDigits_fixed_0007.xsd', 
                FALSE, 
            ], 
            'false (numeric) surrounded by white spaces' => [
                'totalDigits_fixed_0008.xsd', 
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
                'totalDigits_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'totalDigits_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'totalDigits_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'totalDigits_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'totalDigits_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'totalDigits_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'totalDigits_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'totalDigits_id_0008.xsd', 'foo_bar', 
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
            '1' => [
                'totalDigits_value_0001.xsd', 
                \gmp_init(1), 
            ], 
            '1 with positive sign' => [
                'totalDigits_value_0002.xsd', 
                \gmp_init(1), 
            ], 
            '1 with positive sign and surrounded by white spaces' => [
                'totalDigits_value_0003.xsd', 
                \gmp_init(1), 
            ], 
            '1234567890' => [
                'totalDigits_value_0004.xsd', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign' => [
                'totalDigits_value_0005.xsd', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign and surrounded by white spaces' => [
                'totalDigits_value_0006.xsd', 
                \gmp_init(1234567890), 
            ], 
        ];
    }
}
