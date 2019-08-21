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
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_APPINFO}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AppInfoParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName():string
    {
        return 'appinfo';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations()
    {
        $sch = $this->sut->parse($this->getXs('appinfo_0005.xsd'));
        
        self::assertSame(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch->getNamespaceDeclarations()
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertSame([], $ann->getNamespaceDeclarations());
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(1, $ann->getElements());
        
        $appinfo = $ann->getAppInfoElements()[0];
        $decls = [
            '' => 'http://example.org', 
            'foo' => 'http://example.org/foo', 
        ];
        self::assertArraySubset($decls, $appinfo->getNamespaceDeclarations(), TRUE);
        self::assertCount(0, \array_diff_assoc($appinfo->getNamespaceDeclarations(), $decls));
        self::assertAppInfoElementHasNoAttribute($appinfo);
        self::assertSame('', $appinfo->getContent());
    }
    
    /**
     * Tests that parse() processes "source" attribute.
     * 
     * @group   attribute
     */
    public function testParseProcessSourceAttribute()
    {
        $sch = $this->sut->parse($this->getXs('appinfo_src_0001.xsd'));
        
        self::assertSame(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch->getNamespaceDeclarations()
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertSame([], $ann->getNamespaceDeclarations());
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(1, $ann->getElements());
        
        $appinfo = $ann->getAppInfoElements()[0];
        self::assertSame([], $appinfo->getNamespaceDeclarations());
        self::assertAppInfoElementHasOnlySourceAttribute($appinfo);
        self::assertSame('http://example.org', $appinfo->getSource()->getUri());
        self::assertSame('', $appinfo->getContent());
    }
    
    /**
     * Tests that parse() processes the content.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessContent()
    {
        $sch = $this->sut->parse($this->getXs('appinfo_0004.xsd'));
        
        self::assertSame(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch->getNamespaceDeclarations()
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ann = $sch->getCompositionAnnotationElements()[0];
        self::assertSame([], $ann->getNamespaceDeclarations());
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertCount(2, $ann->getElements());
        
        $appinfos = $ann->getAppInfoElements();
        
        self::assertSame([], $appinfos[0]->getNamespaceDeclarations());
        self::assertAppInfoElementHasNoAttribute($appinfos[0]);
        self::assertSame('foo', $appinfos[0]->getContent());
        
        self::assertSame([], $appinfos[1]->getNamespaceDeclarations());
        self::assertAppInfoElementHasNoAttribute($appinfos[1]);
        self::assertSame('bar', $appinfos[1]->getContent());
    }
}
