<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "annotation" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnnotationSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
{
    use BindNamespaceTestTrait;
    
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
    use BuildTypeAttributeDoesNotCreateAttributeTestTrait;
    use BuildSimpleTypeElementDoesNotCreateElementTestTrait;
    use BuildRestrictionElementDoesNotCreateElementTestTrait;
    use BuildBaseAttributeDoesNotCreateAttributeTestTrait;
    use BuildMinExclusiveElementDoesNotCreateElementTestTrait;
    use BuildValueAttributeDoesNotCreateAttributeTestTrait;
    use BuildMinInclusiveElementDoesNotCreateElementTestTrait;
    use BuildMaxExclusiveElementDoesNotCreateElementTestTrait;
    use BuildMaxInclusiveElementDoesNotCreateElementTestTrait;
    use BuildTotalDigitsElementDoesNotCreateElementTestTrait;
    use BuildFractionDigitsElementDoesNotCreateElementTestTrait;
    use BuildLengthElementDoesNotCreateElementTestTrait;
    use BuildMinLengthElementDoesNotCreateElementTestTrait;
    use BuildMaxLengthElementDoesNotCreateElementTestTrait;
    use BuildEnumerationElementDoesNotCreateElementTestTrait;
    use BuildWhiteSpaceElementDoesNotCreateElementTestTrait;
    use BuildPatternElementDoesNotCreateElementTestTrait;
    use BuildListElementDoesNotCreateElementTestTrait;
    use BuildItemTypeAttributeDoesNotCreateAttributeTestTrait;
    use BuildUnionElementDoesNotCreateElementTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertAncestorsNotChanged($sch);
        
        $ann = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch)
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $import = $sch->getImportElements()[0];
        self::assertElementNamespaceDeclarations([], $import);
        self::assertImportElementHasNoAttribute($import);
        self::assertCount(1, $import->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch)
    {
        self::assertAnnotationElementHasNoAttribute(self::getCurrentElement($sch));
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch)
    {
        return $sch->getImportElements()[0]
            ->getAnnotationElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildImportElement();
        $this->sut->buildAnnotationElement();
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
     * element is the "annotation" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidIdValues
     */
    public function testBuildIdAttributeCreatesAttrWhenAnnotationAndValueIsValid(
        string $value, 
        string $id
    ) {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ann = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasOnlyIdAttribute($ann);
        self::assertSame($id, $ann->getId()->getId());
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "annotation" element and the value is invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidIdValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenAnnotationAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildIdAttribute($value);
    }
    
    /**
     * Tests that buildAppInfoElement() creates the element when the current 
     * element is the "annotation" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAppInfoElementCreateEltWhenAnnotation()
    {
        $this->sut->buildAppInfoElement();
        $this->sut->endElement();
        $this->sut->buildAppInfoElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ann = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        $appinfos = $ann->getAppInfoElements();
        self::assertCount(2, $appinfos);
        
        self::assertElementNamespaceDeclarations([], $appinfos[0]);
        self::assertAppInfoElementHasNoAttribute($appinfos[0]);
        self::assertSame('', $appinfos[0]->getContent());
        
        self::assertElementNamespaceDeclarations([], $appinfos[1]);
        self::assertAppInfoElementHasNoAttribute($appinfos[1]);
        self::assertSame('', $appinfos[1]->getContent());
    }
    
    /**
     * Tests that buildDocumentationElement() creates the element when the 
     * current element is the "annotation" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildDocumentationElementCreateEltWhenAnnotation()
    {
        $this->sut->buildDocumentationElement();
        $this->sut->endElement();
        $this->sut->buildDocumentationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $ann = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        $docs = $ann->getDocumentationElements();
        self::assertCount(2, $docs);
        
        self::assertElementNamespaceDeclarations([], $docs[0]);
        self::assertDocumentationElementHasNoAttribute($docs[0]);
        self::assertSame('', $docs[0]->getContent());
        
        self::assertElementNamespaceDeclarations([], $docs[1]);
        self::assertDocumentationElementHasNoAttribute($docs[1]);
        self::assertSame('', $docs[1]->getContent());
    }
}
