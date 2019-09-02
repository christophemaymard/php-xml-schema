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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_TOP_COMPLEXTYPE}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TopComplexTypeParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'top_ct';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('complexType_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $ct
        );
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that parse() processes "abstract" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $bool       The expected value for the boolean.
     * 
     * @group           attribute
     * @dataProvider    getValidAbstractAttributes
     */
    public function testParseProcessAbstractAttribute(string $fileName, bool $bool)
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
        self::assertComplexTypeElementHasOnlyAbstractAttribute($ct);
        self::assertSame($bool, $ct->getAbstract());
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Returns a set of valid "abstract" attributes.
     * 
     * @return  array[]
     */
    public function getValidAbstractAttributes():array
    {
        return [
            'true (string)' => [
                'complexType_abstract_0001.xsd', 
                TRUE, 
            ], 
            'true (numeric)' => [
                'complexType_abstract_0002.xsd', 
                TRUE, 
            ], 
            'true (string) surrounded by white spaces' => [
                'complexType_abstract_0003.xsd', 
                TRUE, 
            ], 
            'true (numeric) surrounded by white spaces' => [
                'complexType_abstract_0004.xsd', 
                TRUE, 
            ], 
            'false (string)' => [
                'complexType_abstract_0005.xsd', 
                FALSE, 
            ], 
            'false (numeric)' => [
                'complexType_abstract_0006.xsd', 
                FALSE, 
            ], 
            'false (string) surrounded by white spaces' => [
                'complexType_abstract_0007.xsd', 
                FALSE, 
            ], 
            'false (numeric) surrounded by white spaces' => [
                'complexType_abstract_0008.xsd', 
                FALSE, 
            ], 
        ];
    }
}
