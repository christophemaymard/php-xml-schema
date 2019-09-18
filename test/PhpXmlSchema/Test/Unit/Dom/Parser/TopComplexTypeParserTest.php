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
     * Tests that parse() processes "block" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   bool    $ext        The expected value for the "extension" flag.
     * @param   bool    $res        The expected value for the "restriction" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidBlockAttributes
     */
    public function testParseProcessBlockAttribute(
        string $fileName,
        bool $ext, 
        bool $res
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
        self::assertComplexTypeElementHasOnlyBlockAttribute($ct);
        self::assertComplexTypeElementBlockAttribute($ext, $res, $ct);
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that parse() processes "final" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   bool    $ext        The expected value for the "extension" flag.
     * @param   bool    $res        The expected value for the "restriction" flag.
     * 
     * @group           attribute
     * @dataProvider    getValidFinalAttributes
     */
    public function testParseProcessFinalAttribute(
        string $fileName,
        bool $ext, 
        bool $res
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
        self::assertComplexTypeElementHasOnlyFinalAttribute($ct);
        self::assertComplexTypeElementFinalAttribute($ext, $res, $ct);
        self::assertSame([], $ct->getElements());
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
        self::assertComplexTypeElementHasOnlyIdAttribute($ct);
        self::assertSame($id, $ct->getId()->getId());
        self::assertSame([], $ct->getElements());
    }
    
    /**
     * Tests that parse() processes "mixed" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $bool       The expected value for the boolean.
     * 
     * @group           attribute
     * @dataProvider    getValidMixedAttributes
     */
    public function testParseProcessMixedAttribute(string $fileName, bool $bool)
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
        self::assertComplexTypeElementHasOnlyMixedAttribute($ct);
        self::assertSame($bool, $ct->getMixed());
        self::assertSame([], $ct->getElements());
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
        self::assertComplexTypeElementHasOnlyNameAttribute($ct);
        self::assertSame($name, $ct->getName()->getNCName());
        self::assertSame([], $ct->getElements());
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
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $ann = $ct->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that parse() processes "simpleContent" element.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessSimpleContentElement()
    {
        $sch = $this->sut->parse($this->getXs('simpleContent_0002.xsd'));
        
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
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that parse() processes "complexContent" element.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessComplexContentElement()
    {
        $sch = $this->sut->parse($this->getXs('complexContent_0002.xsd'));
        
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
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that parse() processes "group" element (groupRef).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessGroupElement()
    {
        $sch = $this->sut->parse($this->getXs('group_0002.xsd'));
        
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
        
        $grp = $ct->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasNoAttribute($grp);
        self::assertSame([], $grp->getElements());
    }
    
    /**
     * Tests that parse() processes "all" element (all).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAllElement()
    {
        $sch = $this->sut->parse($this->getXs('all_0002.xsd'));
        
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
        
        $all = $ct->getTypeDefinitionParticleElement();
        self::assertElementNamespaceDeclarations([], $all);
        self::assertAllElementHasNoAttribute($all);
        self::assertSame([], $all->getElements());
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
    
    /**
     * Returns a set of valid "block" attributes.
     * 
     * @return  array[]
     */
    public function getValidBlockAttributes():array
    {
        // [ $fileName, $extension, $restriction, ]
        return [
            'Empty string' => [
                'complexType_block_0001.xsd', FALSE, FALSE, 
            ], 
            'Only white spaces' => [
                'complexType_block_0002.xsd', FALSE, FALSE, 
            ], 
            '#all' => [
                'complexType_block_0003.xsd', TRUE, TRUE, 
            ], 
            'extension and restriction with white spaces' => [
                'complexType_block_0004.xsd', TRUE, TRUE, 
            ], 
            'extension with white spaces' => [
                'complexType_block_0005.xsd', TRUE, FALSE, 
            ], 
            'restriction with white spaces' => [
                'complexType_block_0006.xsd', FALSE, TRUE, 
            ], 
            'Duplicated extension' => [
                'complexType_block_0007.xsd', TRUE, FALSE, 
            ], 
            'Duplicated restriction' => [
                'complexType_block_0008.xsd', FALSE, TRUE, 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "final" attributes.
     * 
     * @return  array[]
     */
    public function getValidFinalAttributes():array
    {
        // [ $fileName, $extension, $restriction, ]
        return [
            'Empty string' => [
                'complexType_final_0001.xsd', FALSE, FALSE, 
            ], 
            'Only white spaces' => [
                'complexType_final_0002.xsd', FALSE, FALSE, 
            ], 
            '#all' => [
                'complexType_final_0003.xsd', TRUE, TRUE, 
            ], 
            'extension and restriction with white spaces' => [
                'complexType_final_0004.xsd', TRUE, TRUE, 
            ], 
            'extension with white spaces' => [
                'complexType_final_0005.xsd', TRUE, FALSE, 
            ], 
            'restriction with white spaces' => [
                'complexType_final_0006.xsd', FALSE, TRUE, 
            ], 
            'Duplicated extension' => [
                'complexType_final_0007.xsd', TRUE, FALSE, 
            ], 
            'Duplicated restriction' => [
                'complexType_final_0008.xsd', FALSE, TRUE, 
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
                'complexType_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'complexType_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'complexType_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'complexType_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'complexType_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'complexType_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'complexType_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'complexType_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "mixed" attributes.
     * 
     * @return  array[]
     */
    public function getValidMixedAttributes():array
    {
        return [
            'true (string)' => [
                'complexType_mixed_0001.xsd', 
                TRUE, 
            ], 
            'true (numeric)' => [
                'complexType_mixed_0002.xsd', 
                TRUE, 
            ], 
            'true (string) surrounded by white spaces' => [
                'complexType_mixed_0003.xsd', 
                TRUE, 
            ], 
            'true (numeric) surrounded by white spaces' => [
                'complexType_mixed_0004.xsd', 
                TRUE, 
            ], 
            'false (string)' => [
                'complexType_mixed_0005.xsd', 
                FALSE, 
            ], 
            'false (numeric)' => [
                'complexType_mixed_0006.xsd', 
                FALSE, 
            ], 
            'false (string) surrounded by white spaces' => [
                'complexType_mixed_0007.xsd', 
                FALSE, 
            ], 
            'false (numeric) surrounded by white spaces' => [
                'complexType_mixed_0008.xsd', 
                FALSE, 
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
                'complexType_name_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'complexType_name_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'complexType_name_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'complexType_name_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'complexType_name_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'complexType_name_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'complexType_name_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'complexType_name_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}
