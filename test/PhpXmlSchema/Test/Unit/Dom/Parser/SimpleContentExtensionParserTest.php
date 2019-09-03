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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_SIMPLECONTENT_EXTENSION}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleContentExtensionParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'sc_extension';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('extension_0006.xsd'));
        
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
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $ext = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $ext
        );
        self::assertSimpleContentExtensionElementHasNoAttribute($ext);
        self::assertSame([], $ext->getElements());
    }
    
    /**
     * Tests that parse() processes "base" attribute when the prefix is 
     * absent and there is no default namespace.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @dataProvider    getValidNoNamespaceBaseAttributes
     */
    public function testParseProcessBaseAttributeWhenPrefixAbsentAndNoDefaultNamespace(
        string $fileName, 
        string $localPart
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
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $ext = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertSimpleContentExtensionElementHasOnlyBaseAttribute($ext);
        self::assertFalse($ext->getBase()->hasNamespace());
        self::assertSame($localPart, $ext->getBase()->getLocalPart()->getNCName());
        self::assertSame([], $ext->getElements());
    }
    
    /**
     * Tests that parse() processes "base" attribute.
     * 
     * @param   string      $fileName   The name of the file used for the test.
     * @param   string[]    $decls      The expected value for the namespace declarations.
     * @param   string      $namespace  The expected value for the namespace.
     * @param   string      $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @dataProvider    getValidBaseAttributes
     */
    public function testParseProcessBaseAttribute(
        string $fileName, 
        array $decls, 
        string $namespace, 
        string $localPart
    ) {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations($decls, $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $ext = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $ext);
        self::assertSimpleContentExtensionElementHasOnlyBaseAttribute($ext);
        self::assertSame($namespace, $ext->getBase()->getNamespace()->getUri());
        self::assertSame($localPart, $ext->getBase()->getLocalPart()->getNCName());
        self::assertSame([], $ext->getElements());
    }
    
    /**
     * Returns a set of valid "base" attributes with no prefix and no default 
     * namespace.
     * 
     * @return  array[]
     */
    public function getValidNoNamespaceBaseAttributes():array
    {
        return [
            'Local part starts with _' => [
                'extension_base_0001.xsd', 
                '_foo', 
            ], 
            'Local part starts with letter' => [
                'extension_base_0002.xsd', 
                'f', 
            ], 
            'Local part contains letter' => [
                'extension_base_0003.xsd', 
                'foo', 
            ], 
            'Local part contains digit' => [
                'extension_base_0004.xsd', 
                'f00', 
            ], 
            'Local part contains .' => [
                'extension_base_0005.xsd', 
                'f.bar', 
            ], 
            'Local part contains -' => [
                'extension_base_0006.xsd', 
                'f-bar', 
            ], 
            'Local part contains _' => [
                'extension_base_0007.xsd', 
                'f_bar', 
            ], 
            'Local part surrounded by white spaces' => [
                'extension_base_0008.xsd', 
                'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "base" attributes.
     * 
     * @return  array[]
     */
    public function getValidBaseAttributes():array
    {
        return [
            'Prefix (absent) and bound to default namespace' => [
                'extension_base_0009.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                'http://example.org', 
                'foo', 
            ], 
            'Prefix and local part (starts with _)' => [
                'extension_base_0010.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                '_foo', 
            ], 
            'Prefix and local part (starts with letter)' => [
                'extension_base_0011.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f', 
            ], 
            'Prefix and local part (contains letter)' => [
                'extension_base_0012.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'foo', 
            ], 
            'Prefix and local part (contains digit)' => [
                'extension_base_0013.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f00', 
            ], 
            'Prefix and local part (contains .)' => [
                'extension_base_0014.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f.bar', 
            ], 
            'Prefix and local part (contains -)' => [
                'extension_base_0015.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f-bar', 
            ], 
            'Prefix and local part (contains _)' => [
                'extension_base_0016.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f_bar', 
            ], 
            'Prefix (starts with _) and local part' => [
                'extension_base_0017.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    '_foo' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (starts with letter) and local part' => [
                'extension_base_0018.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains letter) and local part' => [
                'extension_base_0019.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'foo' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains digit) and local part' => [
                'extension_base_0020.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f00' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains .) and local part' => [
                'extension_base_0021.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f.bar' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains -) and local part' => [
                'extension_base_0022.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f-bar' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains _) and local part' => [
                'extension_base_0023.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f_bar' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
        ];
    }
}
