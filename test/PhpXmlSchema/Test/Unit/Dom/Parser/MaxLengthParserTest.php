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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_MAXLENGTH}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class MaxLengthParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'maxLength';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('maxLength_0006.xsd'));
        
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
        
        $maxl = $res->getMaxLengthElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $maxl
        );
        self::assertMaxLengthElementHasNoAttribute($maxl);
        self::assertSame([], $maxl->getElements());
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
        
        $maxl = $res->getMaxLengthElements()[0];
        self::assertElementNamespaceDeclarations([], $maxl);
        self::assertMaxLengthElementHasOnlyFixedAttribute($maxl);
        self::assertSame($bool, $maxl->getFixed());
        self::assertSame([], $maxl->getElements());
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
        
        $maxl = $res->getMaxLengthElements()[0];
        self::assertElementNamespaceDeclarations([], $maxl);
        self::assertMaxLengthElementHasOnlyIdAttribute($maxl);
        self::assertSame($id, $maxl->getId()->getId());
        self::assertSame([], $maxl->getElements());
    }
    
    /**
     * Tests that parse() processes "value" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   \GMP    $nni        The expected value for the non-negative integer.
     * 
     * @group           attribute
     * @dataProvider    getValidValueAttributes
     */
    public function testParseProcessValueAttribute(string $fileName, \GMP $nni)
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
        
        $maxl = $res->getMaxLengthElements()[0];
        self::assertElementNamespaceDeclarations([], $maxl);
        self::assertMaxLengthElementHasOnlyValueAttribute($maxl);
        self::assertEquals($nni, $maxl->getValue()->getInteger());
        self::assertSame([], $maxl->getElements());
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
                'maxLength_fixed_0001.xsd', 
                TRUE, 
            ], 
            'true (numeric)' => [
                'maxLength_fixed_0002.xsd', 
                TRUE, 
            ], 
            'true (string) surrounded by white spaces' => [
                'maxLength_fixed_0003.xsd', 
                TRUE, 
            ], 
            'true (numeric) surrounded by white spaces' => [
                'maxLength_fixed_0004.xsd', 
                TRUE, 
            ], 
            'false (string)' => [
                'maxLength_fixed_0005.xsd', 
                FALSE, 
            ], 
            'false (numeric)' => [
                'maxLength_fixed_0006.xsd', 
                FALSE, 
            ], 
            'false (string) surrounded by white spaces' => [
                'maxLength_fixed_0007.xsd', 
                FALSE, 
            ], 
            'false (numeric) surrounded by white spaces' => [
                'maxLength_fixed_0008.xsd', 
                FALSE, 
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
                'maxLength_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'maxLength_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'maxLength_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'maxLength_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'maxLength_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'maxLength_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'maxLength_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'maxLength_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "value" attributes.
     * 
     * @return  array[]
     */
    public function getValidValueAttributes():array
    {
        return [
            '0' => [
                'maxLength_value_0001.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign' => [
                'maxLength_value_0002.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign and leading zeroes' => [
                'maxLength_value_0003.xsd', 
                \gmp_init(0), 
            ], 
            '0 with positive sign, leading zeroes and surrounded by white spaces' => [
                'maxLength_value_0004.xsd', 
                \gmp_init(0), 
            ], 
            '1234567890' => [
                'maxLength_value_0005.xsd', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign' => [
                'maxLength_value_0006.xsd', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign and leading zeroes' => [
                'maxLength_value_0007.xsd', 
                \gmp_init(1234567890), 
            ], 
            '1234567890 with positive sign, leading zeroes and surrounded by white spaces' => [
                'maxLength_value_0008.xsd', 
                \gmp_init(1234567890), 
            ], 
        ];
    }
}
