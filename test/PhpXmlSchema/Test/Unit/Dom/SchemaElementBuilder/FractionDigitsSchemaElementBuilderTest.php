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
 * class when the current element is the "fractionDigits" element.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FractionDigitsSchemaElementBuilderTest extends AbstractSchemaElementBuilderTestCase
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
    use BuildAppInfoElementDoesNotCreateElementTestTrait;
    use BuildSourceAttributeDoesNotCreateAttributeTestTrait;
    use BuildLeafElementContentDoesNotCreateContentTestTrait;
    use BuildDocumentationElementDoesNotCreateElementTestTrait;
    use BuildImportElementDoesNotCreateElementTestTrait;
    use BuildNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildSchemaLocationAttributeDoesNotCreateAttributeTestTrait;
    use BuildIncludeElementDoesNotCreateElementTestTrait;
    use BuildNotationElementDoesNotCreateElementTestTrait;
    use BuildNameAttributeDoesNotCreateAttributeTestTrait;
    use BuildPublicAttributeDoesNotCreateAttributeTestTrait;
    use BuildSystemNamespaceAttributeDoesNotCreateAttributeTestTrait;
    use BuildDefinitionAnnotationElementDoesNotCreateElementTestTrait;
    use BuildAttributeElementDoesNotCreateElementTestTrait;
    use BuildDefaultAttributeDoesNotCreateAttributeTestTrait;
    use BuildTypeAttributeDoesNotCreateAttributeTestTrait;
    use BuildSimpleTypeElementDoesNotCreateElementTestTrait;
    use BuildRestrictionElementDoesNotCreateElementTestTrait;
    use BuildBaseAttributeDoesNotCreateAttributeTestTrait;
    use BuildMinExclusiveElementDoesNotCreateElementTestTrait;
    use BuildMinInclusiveElementDoesNotCreateElementTestTrait;
    use BuildMaxExclusiveElementDoesNotCreateElementTestTrait;
    use BuildMaxInclusiveElementDoesNotCreateElementTestTrait;
    use BuildTotalDigitsElementDoesNotCreateElementTestTrait;
    use BuildFractionDigitsElementDoesNotCreateElementTestTrait;
    use BuildLengthElementDoesNotCreateElementTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertSchemaElementNotChanged(SchemaElement $sch)
    {
        self::assertAncestorsNotChanged($sch);
        
        $fd = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $fd);
        self::assertFractionDigitsElementHasNoAttribute($fd);
        self::assertSame([], $fd->getElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch)
    {
        self::assertElementNamespaceDeclarations([], $sch);
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
        self::assertCount(1, $res->getFractionDigitsElements());
    }
    
    /**
     * {@inheritDoc}
     */
    public static function assertCurrentElementHasNotAttribute(SchemaElement $sch)
    {
        self::assertFractionDigitsElementHasNoAttribute(self::getCurrentElement($sch));
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch)
    {
        return $sch->getAttributeElements()[0]
            ->getSimpleTypeElement()
            ->getDerivationElement()
            ->getFractionDigitsElements()[0];
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildAttributeElement();
        $this->sut->buildSimpleTypeElement();
        $this->sut->buildRestrictionElement();
        $this->sut->buildFractionDigitsElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that buildFixedAttribute() creates the attribute when the 
     * current element is the "fractionDigits" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   bool    $bool   The expected value for the boolean.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidBooleanValues
     */
    public function testBuildFixedAttributeCreatesAttrWhenFractionDigitsAndValueIsValid(
        string $value, 
        bool $bool
    ) {
        $this->sut->buildFixedAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $fd = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $fd);
        self::assertFractionDigitsElementHasOnlyFixedAttribute($fd);
        self::assertSame($bool, $fd->getFixed());
        self::assertSame([], $fd->getElements());
    }
    
    /**
     * Tests that buildFixedAttribute() throws an exception when the current 
     * element is the "fractionDigits" element and the value is invalid.
     * 
     * @param   string  $value  The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidBooleanValues
     */
    public function testBuildFixedAttributeThrowsExceptionWhenFractionDigitsAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid boolean datatype.', $value));
        
        $this->sut->buildFixedAttribute($value);
    }
    
    /**
     * Tests that buildIdAttribute() creates the attribute when the current 
     * element is the "fractionDigits" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   string  $id     The expected value for the ID.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidIdValues
     */
    public function testBuildIdAttributeCreatesAttrWhenFractionDigitsAndValueIsValid(
        string $value, 
        string $id
    ) {
        $this->sut->buildIdAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $fd = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $fd);
        self::assertFractionDigitsElementHasOnlyIdAttribute($fd);
        self::assertSame($id, $fd->getId()->getId());
        self::assertSame([], $fd->getElements());
    }
    
    /**
     * Tests that buildIdAttribute() throws an exception when the current 
     * element is the "fractionDigits" element and the value is invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidIdValues
     */
    public function testBuildIdAttributeThrowsExceptionWhenFractionDigitsAndValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        
        $this->sut->buildIdAttribute($value);
    }
    
    /**
     * Tests that buildValueAttribute() creates the attribute when the 
     * current element is the "fractionDigits" element and the value is valid.
     * 
     * @param   string  $value  The value to test.
     * @param   \GMP    $nni    The expected value for the non-negative integer.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getValidNonNegativeIntegerValues
     */
    public function testBuildValueAttributeCreatesAttrWhenFractionDigitsAndValueIsValid(
        string $value, 
        \GMP $nni
    ) {
        $this->sut->buildValueAttribute($value);
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $fd = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $fd);
        self::assertFractionDigitsElementHasOnlyValueAttribute($fd);
        self::assertEquals($nni, $fd->getValue()->getInteger());
        self::assertSame([], $fd->getElements());
    }
    
    /**
     * Tests that buildValueAttribute() throws an exception when the current 
     * element is the "fractionDigits" element and the value is invalid.
     * 
     * @param   string  $value      The value to test.
     * 
     * @group           attribute
     * @group           parsing
     * @dataProvider    getInvalidNonNegativeIntegerValues
     */
    public function testBuildValueAttributeThrowsExceptionWhenFractionDigitsAndValueIsInvalid(
        string $value
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid non-negative integer.', $value));
        
        $this->sut->buildValueAttribute($value);
    }
    
    /**
     * Tests that buildAnnotationElement() creates the element when the 
     * current element is the "fractionDigits" element.
     * 
     * @group   content
     * @group   element
     */
    public function testBuildAnnotationElementCreateEltWhenFractionDigits()
    {
        $this->sut->buildAnnotationElement();
        $sch = $this->sut->getSchema();
        
        self::assertAncestorsNotChanged($sch);
        
        $fd = self::getCurrentElement($sch);
        self::assertElementNamespaceDeclarations([], $fd);
        self::assertFractionDigitsElementHasNoAttribute($fd);
        self::assertCount(1, $fd->getElements());
        
        $ann = $fd->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
}