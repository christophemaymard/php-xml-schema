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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_UNION}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UnionParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'union';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('union_0006.xsd'));
        
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
        
        $union = $st->getDerivationElement();
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $union
        );
        self::assertUnionElementHasNoAttribute($union);
        self::assertSame([], $union->getElements());
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
        
        $union = $st->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $union);
        self::assertUnionElementHasOnlyIdAttribute($union);
        self::assertSame($id, $union->getId()->getId());
        self::assertSame([], $union->getElements());
    }
    
    /**
     * Tests that parse() processes "memberTypes" attribute when the prefix 
     * is absent and there is no default namespace.
     * 
     * @param   string      $fileName   The name of the file used for the test.
     * @param   string[]    $localParts The expected value for the local parts.
     * 
     * @group           attribute
     * @dataProvider    getValidNoNamespaceMemberTypesAttributes
     */
    public function testParseProcessMemberTypesAttributeWhenPrefixAbsentAndNoDefaultNamespace(
        string $fileName, 
        array $localParts
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
        
        $attr = $sch->getAttributeElements()[0];
        self::assertElementNamespaceDeclarations([], $attr);
        self::assertAttributeElementHasNoAttribute($attr);
        self::assertCount(1, $attr->getElements());
        
        $st = $attr->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertCount(1, $st->getElements());
        
        $union = $st->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $union);
        self::assertUnionElementHasOnlyMemberTypesAttribute($union);
        $memberTypes = $union->getMemberTypes();
        self::assertSame(\count($localParts), \count($memberTypes));
        
        foreach ($localParts as $idx => $localPart) {
            self::assertSame($localPart, $memberTypes[$idx]->getLocalPart()->getNCName());
            self::assertFalse($memberTypes[$idx]->hasNamespace());
        }
        
        self::assertSame([], $union->getElements());
    }
    
    /**
     * Tests that parse() processes "memberTypes" attribute.
     * 
     * @param   string      $fileName   The name of the file used for the test.
     * @param   string[]    $decls      The expected value for the namespace declarations.
     * @param   array[]     $qnames     The expected qualified names.
     * 
     * @group           attribute
     * @dataProvider    getValidMemberTypesAttributes
     */
    public function testParseProcessMemberTypesAttribute(
        string $fileName, 
        array $decls, 
        array $qnames
    ) {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations($decls, $sch);
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
        
        $union = $st->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $union);
        self::assertUnionElementHasOnlyMemberTypesAttribute($union);
        $memberTypes = $union->getMemberTypes();
        self::assertSame(\count($qnames), \count($memberTypes));
        
        foreach ($qnames as $idx => list($localPart, $namespace)) {
            self::assertSame($localPart, $memberTypes[$idx]->getLocalPart()->getNCName());
            self::assertSame($namespace, $memberTypes[$idx]->getNamespace()->getUri());
        }
        
        self::assertSame([], $union->getElements());
    }
    
    /**
     * Tests that parse() processes "annotation" element.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAnnotationElement()
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
        
        $union = $st->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $union);
        self::assertUnionElementHasNoAttribute($union);
        self::assertCount(1, $union->getElements());
        
        $ann = $union->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
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
                'union_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'union_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'union_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'union_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'union_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'union_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'union_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'union_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "memberTypes" attributes with no prefix and no 
     * default namespace.
     * 
     * @return  array[]
     */
    public function getValidNoNamespaceMemberTypesAttributes():array
    {
        return [
            'QName 1 (no prefix, local part starts with _)' => [
                'union_memberTypes_0001.xsd', 
                [
                    '_foo', 
                ], 
            ], 
            'QName 1 (no prefix, local part starts with letter)' => [
                'union_memberTypes_0002.xsd', 
                [
                    'f', 
                ], 
            ], 
            'QName 1 (no prefix, local part contains letter)' => [
                'union_memberTypes_0003.xsd', 
                [
                    'foo', 
                ], 
            ], 
            'QName 1 (no prefix, local part contains digit)' => [
                'union_memberTypes_0004.xsd', 
                [
                    'f00', 
                ], 
            ], 
            'QName 1 (no prefix, local part contains .)' => [
                'union_memberTypes_0005.xsd', 
                [
                    'f.bar', 
                ], 
            ], 
            'QName 1 (no prefix, local part contains -)' => [
                'union_memberTypes_0006.xsd', 
                [
                    'f-bar', 
                ], 
            ], 
            'QName 1 (no prefix, local part contains _)' => [
                'union_memberTypes_0007.xsd', 
                [
                    'f_bar', 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part starts with _)' => [
                'union_memberTypes_0008.xsd', 
                [
                    'baz', 
                    '_foo', 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part starts with letter)' => [
                'union_memberTypes_0009.xsd', 
                [
                    'baz', 
                    'f', 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains letter)' => [
                'union_memberTypes_0010.xsd', 
                [
                    'baz', 
                    'foo', 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains digit)' => [
                'union_memberTypes_0011.xsd', 
                [
                    'baz', 
                    'f00', 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains .)' => [
                'union_memberTypes_0012.xsd', 
                [
                    'baz', 
                    'f.bar', 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains -)' => [
                'union_memberTypes_0013.xsd', 
                [
                    'baz', 
                    'f-bar', 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains _)' => [
                'union_memberTypes_0014.xsd', 
                [
                    'baz', 
                    'f_bar', 
                ], 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "memberTypes" attributes.
     * 
     * @return  array[]
     */
    public function getValidMemberTypesAttributes():array
    {
        return [
            'QName 1 (no prefix, local part starts with _)' => [
                'union_memberTypes_0015.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        '_foo', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (no prefix, local part starts with letter)' => [
                'union_memberTypes_0016.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'f', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (no prefix, local part contains letter)' => [
                'union_memberTypes_0017.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (no prefix, local part contains digit)' => [
                'union_memberTypes_0018.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'f00', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (no prefix, local part contains .)' => [
                'union_memberTypes_0019.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'f.bar', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (no prefix, local part contains -)' => [
                'union_memberTypes_0020.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'f-bar', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (no prefix, local part contains _)' => [
                'union_memberTypes_0021.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'f_bar', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part starts with _)' => [
                'union_memberTypes_0022.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org', 
                    ], 
                    [
                        '_foo', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part starts with letter)' => [
                'union_memberTypes_0023.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org', 
                    ], 
                    [
                        'f', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains letter)' => [
                'union_memberTypes_0024.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org', 
                    ], 
                    [
                        'foo', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains digit)' => [
                'union_memberTypes_0025.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org', 
                    ], 
                    [
                        'f00', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains .)' => [
                'union_memberTypes_0026.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org', 
                    ], 
                    [
                        'f.bar', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains -)' => [
                'union_memberTypes_0027.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org', 
                    ], 
                    [
                        'f-bar', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (no prefix, local part is baz), QName 2 (no prefix, local part contains _)' => [
                'union_memberTypes_0028.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org', 
                    ], 
                    [
                        'f_bar', 
                        'http://example.org', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is baz, local part starts with _)' => [
                'union_memberTypes_0029.xsd', 
                [
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        '_foo', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is baz, local part starts with letter)' => [
                'union_memberTypes_0030.xsd', 
                [
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'f', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is baz, local part contains letter)' => [
                'union_memberTypes_0031.xsd', 
                [
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is baz, local part contains digit)' => [
                'union_memberTypes_0032.xsd', 
                [
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'f00', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is baz, local part contains .)' => [
                'union_memberTypes_0033.xsd', 
                [
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'f.bar', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is baz, local part contains -)' => [
                'union_memberTypes_0034.xsd', 
                [
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'f-bar', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is baz, local part contains _)' => [
                'union_memberTypes_0035.xsd', 
                [
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'f_bar', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix starts with _, local part is baz)' => [
                'union_memberTypes_0036.xsd', 
                [
                    '_foo' => 'http://example.org/_foo', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org/_foo', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix starts with letter, local part is baz)' => [
                'union_memberTypes_0037.xsd', 
                [
                    'f' => 'http://example.org/f', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org/f', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix contains letter, local part is baz)' => [
                'union_memberTypes_0038.xsd', 
                [
                    'foo' => 'http://example.org/foo', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org/foo', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix contains digit, local part is baz)' => [
                'union_memberTypes_0039.xsd', 
                [
                    'f00' => 'http://example.org/f00', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org/f00', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix contains ., local part is baz)' => [
                'union_memberTypes_0040.xsd', 
                [
                    'f.bar' => 'http://example.org/f.bar', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org/f.bar', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix contains -, local part is baz)' => [
                'union_memberTypes_0041.xsd', 
                [
                    'f-bar' => 'http://example.org/f-bar', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org/f-bar', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix contains _, local part is baz)' => [
                'union_memberTypes_0042.xsd', 
                [
                    'f_bar' => 'http://example.org/f_bar', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'baz', 
                        'http://example.org/f_bar', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix is baz, local part starts with _)' => [
                'union_memberTypes_0043.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        '_foo', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix is baz, local part starts with letter)' => [
                'union_memberTypes_0044.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        'f', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix is baz, local part contains letter)' => [
                'union_memberTypes_0045.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        'foo', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix is baz, local part contains digit)' => [
                'union_memberTypes_0046.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        'f00', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix is baz, local part contains .)' => [
                'union_memberTypes_0047.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        'f.bar', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix is baz, local part contains -)' => [
                'union_memberTypes_0048.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        'f-bar', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix is baz, local part contains _)' => [
                'union_memberTypes_0049.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    'baz' => 'http://example.org/baz', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        'f_bar', 
                        'http://example.org/baz', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix starts with _, local part is baz)' => [
                'union_memberTypes_0050.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    '_foo' => 'http://example.org/_foo', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        'baz', 
                        'http://example.org/_foo', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix starts with letter, local part is baz)' => [
                'union_memberTypes_0051.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    'f' => 'http://example.org/f', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        'baz', 
                        'http://example.org/f', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix contains letter, local part is baz)' => [
                'union_memberTypes_0052.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    'foo' => 'http://example.org/foo', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        'baz', 
                        'http://example.org/foo', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix contains digit, local part is baz)' => [
                'union_memberTypes_0053.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    'f00' => 'http://example.org/f00', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        'baz', 
                        'http://example.org/f00', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix contains ., local part is baz)' => [
                'union_memberTypes_0054.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    'f.bar' => 'http://example.org/f.bar', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        'baz', 
                        'http://example.org/f.bar', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix contains -, local part is baz)' => [
                'union_memberTypes_0055.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    'f-bar' => 'http://example.org/f-bar', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        'baz', 
                        'http://example.org/f-bar', 
                    ], 
                ], 
            ], 
            'QName 1 (prefix is qux, local part is foo), QName 2 (prefix contains _, local part is baz)' => [
                'union_memberTypes_0056.xsd', 
                [
                    'qux' => 'http://example.org/qux', 
                    'f_bar' => 'http://example.org/f_bar', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                [
                    [
                        'foo', 
                        'http://example.org/qux', 
                    ], 
                    [
                        'baz', 
                        'http://example.org/f_bar', 
                    ], 
                ], 
            ], 
        ];
    }
}
