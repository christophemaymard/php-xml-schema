<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\AnnotationElement;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "annotation" element (definition).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DefinitionAnnotationSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
{
    use BuildAttributeFormDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildBlockDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildElementFormDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildFinalDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildTargetNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildVersionAttributeDoesNotCreateAttributeTestTrait;
    use BuildLangAttributeDoesNotCreateAttributeTestTrait;
    use BuildCompositionAnnotationElementDoesNotCreateElementTestTrait;
    use BuildSourceAttributeDoesNotCreateAttributeTestTrait;
    use BuildLeafElementContentDoesNotCreateContentTestTrait;
    use BuildImportElementDoesNotCreateElementTestTrait;
    use BuildNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildSchemaLocationAttributeDoesNotCreateAttributeTestTrait;
    use BuildAnnotationElementDoesNotCreateElementTestTrait;
    use BuildIncludeElementDoesNotCreateElementTestTrait;
    use BuildNotationElementDoesNotCreateElementTestTrait;
    use BuildNameAttributeDoesNotCreateAttributeTestTrait;
    use BuildPublicAttributeDoesNotCreateAttributeTestTrait;
    use BuildSystemNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildDefinitionAnnotationElementDoesNotCreateElementTestTrait;
    use BuildAttributeElementDoesNotCreateElementTestTrait;
    use BuildDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildFixedAttributeDoesNotCreateAttributeTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertAncestorsNotChanged($sch);
        
        $ann = self::getCurrentElement($sch);
        self::assertSame([], $ann->getNamespaceDeclarations());
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Asserts that the ancestors of the current element did not change since 
     * its building.
     * 
     * @param   SchemaElement   $sch    The "schema" element of the current element to assert.
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch)
    {
        self::assertSame([], $sch->getNamespaceDeclarations());
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        self::assertCount(1, $sch->getDefinitionAnnotationElements());
    }
    
    /**
     * Returns the instance of the current element.
     * 
     * @param   SchemaElement   $sch    The "schema" element of the current element
     * @return  AnnotationElement
     */
    private static function getCurrentElement(SchemaElement $sch):AnnotationElement
    {
        return $sch->getDefinitionAnnotationElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildDefinitionAnnotationElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "annotation" element (definition) and the value is 
     * valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidIdValues
     */
    public function testBuildIdAttributeCreatesAttrWhenDefinitionAnnotationAndValueIsValid(
        string $value, 
        string $id
    ) {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ann = self::getCurrentElement($sch);
        self::assertSame([], $ann->getNamespaceDeclarations());
        self::assertAnnotationElementHasOnlyIdAttribute($ann);
        self::assertSame($id, $ann->getId()->getId());
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "annotation" element (definition) and the value is 
     * invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidIdValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenDefinitionAnnotationAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildIdAttribute($value);
    }
    
    /**
     * Tests that buildAppInfoElement() creates the element when the current 
     * element is the "annotation" element (definition).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAppInfoElementCreateEltWhenDefinitionAnnotation()
    {
        $this->sut->buildAppInfoElement();
        $this->sut->endElement();
        $this->sut->buildAppInfoElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ann = self::getCurrentElement($sch);
        self::assertSame([], $ann->getNamespaceDeclarations());
        self::assertAnnotationElementHasNoAttribute($ann);
        $appinfos = $ann->getAppInfoElements();
        self::assertCount(2, $appinfos);
        
        self::assertSame([], $appinfos[0]->getNamespaceDeclarations());
        self::assertAppInfoElementHasNoAttribute($appinfos[0]);
        self::assertSame('', $appinfos[0]->getContent());
        
        self::assertSame([], $appinfos[1]->getNamespaceDeclarations());
        self::assertAppInfoElementHasNoAttribute($appinfos[1]);
        self::assertSame('', $appinfos[1]->getContent());
    }
    
    /**
     * Tests that buildDocumentationElement() creates the element when the 
     * current element is the "annotation" element (definition).
     * 
     * @group   content
     * @group   element
     */
    public function testBuildDocumentationElementCreateEltWhenDefinitionAnnotation()
    {
        $this->sut->buildDocumentationElement();
        $this->sut->endElement();
        $this->sut->buildDocumentationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ann = self::getCurrentElement($sch);
        self::assertSame([], $ann->getNamespaceDeclarations());
        self::assertAnnotationElementHasNoAttribute($ann);
        $docs = $ann->getDocumentationElements();
        self::assertCount(2, $docs);
        
        self::assertSame([], $docs[0]->getNamespaceDeclarations());
        self::assertDocumentationElementHasNoAttribute($docs[0]);
        self::assertSame('', $docs[0]->getContent());
        
        self::assertSame([], $docs[1]->getNamespaceDeclarations());
        self::assertDocumentationElementHasNoAttribute($docs[1]);
        self::assertSame('', $docs[1]->getContent());
    }
}
