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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_TOP_ELEMENT}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class TopElementParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'top_elt';
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
        
        $elt = $sch->getElementElements()[0];
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
        
        $elt = $sch->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyAbstractAttribute($elt);
        self::assertSame($bool, $elt->getAbstract());
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
        
        $elt = $sch->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyBlockAttribute($elt);
        self::assertElementElementBlockAttribute($res, $ext, $sub, $elt);
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that parse() processes "default" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $string     The expected value for the string.
     * 
     * @group           attribute
     * @dataProvider    getValidDefaultAttributes
     */
    public function testParseProcessDefaultAttribute(
        string $fileName, 
        string $string
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
        
        $elt = $sch->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyDefaultAttribute($elt);
        self::assertSame($string, $elt->getDefault()->getString());
        self::assertSame([], $elt->getElements());
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
        
        $elt = $sch->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyFinalAttribute($elt);
        self::assertElementElementFinalAttribute($ext, $res, $elt);
        self::assertSame([], $elt->getElements());
    }
    
    /**
     * Tests that parse() processes "fixed" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $string     The expected value for the string.
     * 
     * @group           attribute
     * @dataProvider    getValidFixedAttributes
     */
    public function testParseProcessFixedAttribute(
        string $fileName, 
        string $string
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
        
        $elt = $sch->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyFixedAttribute($elt);
        self::assertSame($string, $elt->getFixed()->getString());
        self::assertSame([], $elt->getElements());
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
        
        $elt = $sch->getElementElements()[0];
        self::assertElementNamespaceDeclarations([], $elt);
        self::assertElementElementHasOnlyIdAttribute($elt);
        self::assertSame($id, $elt->getId()->getId());
        self::assertSame([], $elt->getElements());
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
                'element_abstract_0001.xsd', 
                TRUE, 
            ], 
            'true (numeric)' => [
                'element_abstract_0002.xsd', 
                TRUE, 
            ], 
            'true (string) surrounded by white spaces' => [
                'element_abstract_0003.xsd', 
                TRUE, 
            ], 
            'true (numeric) surrounded by white spaces' => [
                'element_abstract_0004.xsd', 
                TRUE, 
            ], 
            'false (string)' => [
                'element_abstract_0005.xsd', 
                FALSE, 
            ], 
            'false (numeric)' => [
                'element_abstract_0006.xsd', 
                FALSE, 
            ], 
            'false (string) surrounded by white spaces' => [
                'element_abstract_0007.xsd', 
                FALSE, 
            ], 
            'false (numeric) surrounded by white spaces' => [
                'element_abstract_0008.xsd', 
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
    
    /**
     * Returns a set of valid "default" attributes.
     * 
     * @return  array[]
     */
    public function getValidDefaultAttributes():array
    {
        return [
            'Empty string' => [
                'element_default_0001.xsd', 
                '', 
            ], 
            'Only white spaces' => [
                'element_default_0002.xsd', 
                '                  ', 
            ], 
            'Alphanumeric' => [
                'element_default_0003.xsd', 
                'foo3bar6baz9', 
            ], 
            'Alphanumeric with white spaces' => [
                'element_default_0004.xsd', 
                '  foo2    bar9   baz8    qux1  ', 
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
                'element_final_0001.xsd', FALSE, FALSE, 
            ], 
            'Only white spaces' => [
                'element_final_0002.xsd', FALSE, FALSE, 
            ], 
            '#all' => [
                'element_final_0003.xsd', TRUE, TRUE, 
            ], 
            'extension and restriction with white spaces' => [
                'element_final_0004.xsd', TRUE, TRUE, 
            ], 
            'extension with white spaces' => [
                'element_final_0005.xsd', TRUE, FALSE, 
            ], 
            'restriction with white spaces' => [
                'element_final_0006.xsd', FALSE, TRUE, 
            ], 
            'Duplicated extension' => [
                'element_final_0007.xsd', TRUE, FALSE, 
            ], 
            'Duplicated restriction' => [
                'element_final_0008.xsd', FALSE, TRUE, 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "fixed" attributes.
     * 
     * @return  array[]
     */
    public function getValidFixedAttributes():array
    {
        return [
            'Empty string' => [
                'element_fixed_0001.xsd', 
                '', 
            ], 
            'Only white spaces' => [
                'element_fixed_0002.xsd', 
                '                  ', 
            ], 
            'Alphanumeric' => [
                'element_fixed_0003.xsd', 
                'foo3bar6baz9', 
            ], 
            'Alphanumeric with white spaces' => [
                'element_fixed_0004.xsd', 
                '  foo2    bar9   baz8    qux1  ', 
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
                'element_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'element_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'element_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'element_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'element_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'element_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'element_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'element_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}
