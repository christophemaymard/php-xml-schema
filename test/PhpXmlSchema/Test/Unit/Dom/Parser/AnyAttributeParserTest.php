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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_ANYATTRIBUTE}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnyAttributeParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName(): string
    {
        return 'anyattr';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations(): void
    {
        $sch = $this->sut->parse($this->getXs('anyAttribute_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        
        $anyAttr = $ag->getAnyAttributeElement();
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $anyAttr
        );
        self::assertAnyAttributeElementHasNoAttribute($anyAttr);
        self::assertSame([], $anyAttr->getElements());
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
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        
        $anyAttr = $ag->getAnyAttributeElement();
        self::assertElementNamespaceDeclarations([], $anyAttr);
        self::assertAnyAttributeElementHasOnlyIdAttribute($anyAttr);
        self::assertSame($id, $anyAttr->getId()->getId());
        self::assertSame([], $anyAttr->getElements());
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
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        
        $anyAttr = $ag->getAnyAttributeElement();
        self::assertElementNamespaceDeclarations([], $anyAttr);
        self::assertAnyAttributeElementHasOnlyNamespaceAttribute($anyAttr);
        self::assertAnyAttributeElementNamespaceAttribute(
            $any, 
            $other, 
            $targetNs, 
            $local, 
            $uris, 
            $anyAttr
        );
        self::assertSame([], $anyAttr->getElements());
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
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        
        $anyAttr = $ag->getAnyAttributeElement();
        self::assertElementNamespaceDeclarations([], $anyAttr);
        self::assertAnyAttributeElementHasOnlyProcessContentsAttribute($anyAttr);
        self::assertSame($lax, $anyAttr->getProcessContents()->isLax());
        self::assertSame($skip, $anyAttr->getProcessContents()->isSkip());
        self::assertSame($strict, $anyAttr->getProcessContents()->isStrict());
        self::assertSame([], $anyAttr->getElements());
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
        
        $ag = $sch->getAttributeGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $ag);
        self::assertAttributeGroupElementHasNoAttribute($ag);
        self::assertCount(1, $ag->getElements());
        
        $anyAttr = $ag->getAnyAttributeElement();
        self::assertElementNamespaceDeclarations([], $anyAttr);
        self::assertAnyAttributeElementHasNoAttribute($anyAttr);
        self::assertCount(1, $anyAttr->getElements());
        
        $ann = $anyAttr->getAnnotationElement();
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
                'anyAttribute_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'anyAttribute_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'anyAttribute_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'anyAttribute_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'anyAttribute_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'anyAttribute_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'anyAttribute_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'anyAttribute_id_0008.xsd', 'foo_bar', 
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
                'anyAttribute_namespace_0001.xsd', 
                FALSE, 
                FALSE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            'Only white spaces' => [
                'anyAttribute_namespace_0002.xsd', 
                FALSE, 
                FALSE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            '##any' => [
                'anyAttribute_namespace_0003.xsd', 
                TRUE, 
                FALSE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            '##other' => [
                'anyAttribute_namespace_0004.xsd', 
                FALSE, 
                TRUE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            '##targetNamespace' => [
                'anyAttribute_namespace_0005.xsd', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [], 
            ], 
            '##targetNamespace surrounded by white spaces' => [
                'anyAttribute_namespace_0006.xsd', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [], 
            ], 
            'Duplicated ##targetNamespace' => [
                'anyAttribute_namespace_0007.xsd', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [], 
            ], 
            '##local' => [
                'anyAttribute_namespace_0008.xsd', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [], 
            ], 
            '##local surrounded by white spaces' => [
                'anyAttribute_namespace_0009.xsd', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [], 
            ], 
            'Duplicated ##local' => [
                'anyAttribute_namespace_0010.xsd', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [], 
            ], 
            '##targetNamespace and ##local' => [
                'anyAttribute_namespace_0011.xsd', 
                FALSE, 
                FALSE, 
                TRUE, 
                TRUE, 
                [], 
            ], 
            '##targetNamespace and 1 anyURI' => [
                'anyAttribute_namespace_0012.xsd', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [
                    'http://example.org/foo', 
                ], 
            ], 
            '##local and 1 anyURI' => [
                'anyAttribute_namespace_0013.xsd', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [
                    'http://example.org/foo', 
                ], 
            ], 
            '##targetNamespace and 2 anyURI' => [
                'anyAttribute_namespace_0014.xsd', 
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
                'anyAttribute_namespace_0015.xsd', 
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
                'anyAttribute_namespace_0016.xsd', 
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
                'anyAttribute_processContents_0001.xsd', TRUE, FALSE, FALSE, 
            ], 
            'skip' => [
                'anyAttribute_processContents_0002.xsd', FALSE, TRUE, FALSE, 
            ], 
            'strict' => [
                'anyAttribute_processContents_0003.xsd', FALSE, FALSE, TRUE, 
            ], 
        ];
    }
}
