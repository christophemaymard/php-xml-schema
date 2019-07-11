<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\SchemaElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SchemaElementTest extends AbstractCompositeElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElement();
    }
    
    /**
     * Tests that hasAttributeFormDefault() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasAttributeFormDefault()
    {
        self::assertFalse($this->sut->hasAttributeFormDefault(), 'The attribute has not been set.');
        
        $this->sut->setAttributeFormDefault($this->createFormTypeDummy());
        self::assertTrue($this->sut->hasAttributeFormDefault(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getAttributeFormDefault() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetAttributeFormDefault()
    {
        self::assertNull($this->sut->getAttributeFormDefault(), 'The attribute has not been set.');
        
        $form1 = $this->createFormTypeDummy();
        $this->sut->setAttributeFormDefault($form1);
        self::assertSame($form1, $this->sut->getAttributeFormDefault(), 'Set the attribute with a value: FormType.');
        
        $form2 = $this->createFormTypeDummy();
        $this->sut->setAttributeFormDefault($form2);
        self::assertSame($form2, $this->sut->getAttributeFormDefault(), 'Set the attribute with another value: FormType.');
    }
    
    /**
     * Tests that hasBlockDefault() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasBlockDefault()
    {
        self::assertFalse($this->sut->hasBlockDefault(), 'The attribute has not been set.');
        
        $this->sut->setBlockDefault($this->createDerivationTypeDummy());
        self::assertTrue($this->sut->hasBlockDefault(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getBlockDefault() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetBlockDefault()
    {
        self::assertNull($this->sut->getBlockDefault(), 'The attribute has not been set.');
        
        $derivation1 = $this->createDerivationTypeDummy();
        $this->sut->setBlockDefault($derivation1);
        self::assertSame($derivation1, $this->sut->getBlockDefault(), 'Set the attribute with a value: DerivationType.');
        
        $derivation2 = $this->createDerivationTypeDummy();
        $this->sut->setBlockDefault($derivation2);
        self::assertSame($derivation2, $this->sut->getBlockDefault(), 'Set the attribute with another value: DerivationType.');
    }
    
    /**
     * Tests that hasElementFormDefault() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasElementFormDefault()
    {
        self::assertFalse($this->sut->hasElementFormDefault(), 'The attribute has not been set.');
        
        $this->sut->setElementFormDefault($this->createFormTypeDummy());
        self::assertTrue($this->sut->hasElementFormDefault(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getElementFormDefault() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetElementFormDefault()
    {
        self::assertNull($this->sut->getElementFormDefault(), 'The attribute has not been set.');
        
        $form1 = $this->createFormTypeDummy();
        $this->sut->setElementFormDefault($form1);
        self::assertSame($form1, $this->sut->getElementFormDefault(), 'Set the attribute with a value: FormType.');
        
        $form2 = $this->createFormTypeDummy();
        $this->sut->setElementFormDefault($form2);
        self::assertSame($form2, $this->sut->getElementFormDefault(), 'Set the attribute with another value: FormType.');
    }
    
    /**
     * Tests that hasFinalDefault() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasFinalDefault()
    {
        self::assertFalse($this->sut->hasFinalDefault(), 'The attribute has not been set.');
        
        $this->sut->setFinalDefault($this->createDerivationTypeDummy());
        self::assertTrue($this->sut->hasFinalDefault(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getFinalDefault() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetFinalDefault()
    {
        self::assertNull($this->sut->getFinalDefault(), 'The attribute has not been set.');
        
        $derivation1 = $this->createDerivationTypeDummy();
        $this->sut->setFinalDefault($derivation1);
        self::assertSame($derivation1, $this->sut->getFinalDefault(), 'Set the attribute with a value: DerivationType.');
        
        $derivation2 = $this->createDerivationTypeDummy();
        $this->sut->setFinalDefault($derivation2);
        self::assertSame($derivation2, $this->sut->getFinalDefault(), 'Set the attribute with another value: DerivationType.');
    }
    
    /**
     * Tests that hasLang() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasLang()
    {
        self::assertFalse($this->sut->hasLang(), 'The attribute has not been set.');
        
        $this->sut->setLang($this->createLanguageTypeDummy());
        self::assertTrue($this->sut->hasLang(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getLang() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetLang()
    {
        self::assertNull($this->sut->getLang(), 'The attribute has not been set.');
        
        $lang1 = $this->createLanguageTypeDummy();
        $this->sut->setLang($lang1);
        self::assertSame($lang1, $this->sut->getLang(), 'Set the attribute with a value: LanguageType.');
        
        $lang2 = $this->createLanguageTypeDummy();
        $this->sut->setLang($lang2);
        self::assertSame($lang2, $this->sut->getLang(), 'Set the attribute with another value: LanguageType.');
    }
    
    /**
     * Tests that hasTargetNamespace() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasTargetNamespace()
    {
        self::assertFalse($this->sut->hasTargetNamespace(), 'The attribute has not been set.');
        
        $this->sut->setTargetNamespace($this->createAnyUriTypeDummy());
        self::assertTrue($this->sut->hasTargetNamespace(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getTargetNamespace() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetTargetNamespace()
    {
        self::assertNull($this->sut->getTargetNamespace(), 'The attribute has not been set.');
        
        $value1 = $this->createAnyUriTypeDummy();
        $this->sut->setTargetNamespace($value1);
        self::assertSame($value1, $this->sut->getTargetNamespace(), 'Set the attribute with a value: AnyUriType.');
        
        $value2 = $this->createAnyUriTypeDummy();
        $this->sut->setTargetNamespace($value2);
        self::assertSame($value2, $this->sut->getTargetNamespace(), 'Set the attribute with another value: AnyUriType.');
    }
    
    /**
     * Tests that hasVersion() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasVersion()
    {
        self::assertFalse($this->sut->hasVersion(), 'The attribute has not been set.');
        
        $this->sut->setVersion($this->createTokenTypeDummy());
        self::assertTrue($this->sut->hasVersion(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getVersion() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetVersion()
    {
        self::assertNull($this->sut->getVersion(), 'The attribute has not been set.');
        
        $token1 = $this->createTokenTypeDummy();
        $this->sut->setVersion($token1);
        self::assertSame($token1, $this->sut->getVersion(), 'Set the attribute with a value: TokenType.');
        
        $token2 = $this->createTokenTypeDummy();
        $this->sut->setVersion($token2);
        self::assertSame($token2, $this->sut->getVersion(), 'Set the attribute with another value: TokenType.');
    }
    
    /**
     * Tests that getIncludeElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no IncludeElement element has been added
     * - an indexed array of all added IncludeElement elements
     * 
     * @group   content
     */
    public function testGetIncludeElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getIncludeElements(), 'No element has been added.');
        
        $this->sut->addImportElement($this->createImportElementDummy());
        $this->sut->addRedefineElement($this->createRedefineElementDummy());
        $this->sut->addCompositionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getIncludeElements(), 'Added elements but no IncludeElement element.');
        
        $elements[] = $this->createIncludeElementDummy();
        $this->sut->addIncludeElement($elements[0]);
        self::assertSame($elements, $this->sut->getIncludeElements(), 'Added 1 IncludeElement element.');
        
        $this->sut->addImportElement($this->createImportElementDummy());
        self::assertSame($elements, $this->sut->getIncludeElements(), 'Added 1 element between.');
        
        $elements[] = $this->createIncludeElementDummy();
        $this->sut->addIncludeElement($elements[1]);
        self::assertSame($elements, $this->sut->getIncludeElements(), 'Added 2 IncludeElement elements.');
    }
    
    /**
     * Tests that getImportElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no ImportElement element has been added
     * - an indexed array of all added ImportElement elements
     * 
     * @group   content
     */
    public function testGetImportElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getImportElements(), 'No element has been added.');
        
        $this->sut->addIncludeElement($this->createIncludeElementDummy());
        $this->sut->addRedefineElement($this->createRedefineElementDummy());
        $this->sut->addCompositionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getImportElements(), 'Added elements but no ImportElement element.');
        
        $elements[] = $this->createImportElementDummy();
        $this->sut->addImportElement($elements[0]);
        self::assertSame($elements, $this->sut->getImportElements(), 'Added 1 ImportElement element.');
        
        $this->sut->addRedefineElement($this->createRedefineElementDummy());
        self::assertSame($elements, $this->sut->getImportElements(), 'Added 1 element between.');
        
        $elements[] = $this->createImportElementDummy();
        $this->sut->addImportElement($elements[1]);
        self::assertSame($elements, $this->sut->getImportElements(), 'Added 2 ImportElement elements.');
    }
    
    /**
     * Tests that getRedefineElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no RedefineElement element has been added
     * - an indexed array of all added RedefineElement elements
     * 
     * @group   content
     */
    public function testGetRedefineElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getRedefineElements(), 'No element has been added.');
        
        $this->sut->addImportElement($this->createImportElementDummy());
        $this->sut->addIncludeElement($this->createIncludeElementDummy());
        $this->sut->addCompositionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getRedefineElements(), 'Added elements but no RedefineElement element.');
        
        $elements[] = $this->createRedefineElementDummy();
        $this->sut->addRedefineElement($elements[0]);
        self::assertSame($elements, $this->sut->getRedefineElements(), 'Added 1 RedefineElement element.');
        
        $this->sut->addCompositionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getRedefineElements(), 'Added 1 element between.');
        
        $elements[] = $this->createRedefineElementDummy();
        $this->sut->addRedefineElement($elements[1]);
        self::assertSame($elements, $this->sut->getRedefineElements(), 'Added 2 RedefineElement elements.');
    }
    
    /**
     * Tests that getCompositionAnnotationElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AnnotationElement element has been added
     * - an indexed array of all added AnnotationElement elements
     * 
     * @group   content
     */
    public function testGetCompositionAnnotationElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getCompositionAnnotationElements(), 'No element has been added.');
        
        $this->sut->addIncludeElement($this->createIncludeElementDummy());
        $this->sut->addImportElement($this->createImportElementDummy());
        $this->sut->addRedefineElement($this->createRedefineElementDummy());
        self::assertSame($elements, $this->sut->getCompositionAnnotationElements(), 'Added elements but no AnnotationElement element.');
        
        $elements[] = $this->createAnnotationElementDummy();
        $this->sut->addCompositionAnnotationElement($elements[0]);
        self::assertSame($elements, $this->sut->getCompositionAnnotationElements(), 'Added 1 AnnotationElement element.');
        
        $this->sut->addIncludeElement($this->createIncludeElementDummy());
        self::assertSame($elements, $this->sut->getCompositionAnnotationElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAnnotationElementDummy();
        $this->sut->addCompositionAnnotationElement($elements[1]);
        self::assertSame($elements, $this->sut->getCompositionAnnotationElements(), 'Added 2 AnnotationElement elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 0 ((include | import | redefine | annotation)*).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer0()
    {
        $children = [];
        $children[] = $this->createIncludeElementDummy();
        $children[] = $this->createImportElementDummy();
        $children[] = $this->createRedefineElementDummy();
        $children[] = $this->createAnnotationElementDummy();
        $children[] = $this->createIncludeElementDummy();
        $children[] = $this->createImportElementDummy();
        $children[] = $this->createRedefineElementDummy();
        $children[] = $this->createAnnotationElementDummy();
        $this->sut->addIncludeElement($children[0]);
        $this->sut->addImportElement($children[1]);
        $this->sut->addRedefineElement($children[2]);
        $this->sut->addCompositionAnnotationElement($children[3]);
        $this->sut->addIncludeElement($children[4]);
        $this->sut->addImportElement($children[5]);
        $this->sut->addRedefineElement($children[6]);
        $this->sut->addCompositionAnnotationElement($children[7]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 0.');
    }
    
    /**
     * Tests that getSimpleTypeElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no SimpleTypeElement element has been added
     * - an indexed array of all added SimpleTypeElement elements
     * 
     * @group   content
     */
    public function testGetSimpleTypeElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getSimpleTypeElements(), 'No element has been added.');
        
        $this->sut->addComplexTypeElement($this->createComplexTypeElementDummy());
        $this->sut->addGroupElement($this->createGroupElementDummy());
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementDummy());
        $this->sut->addElementElement($this->createElementElementDummy());
        $this->sut->addAttributeElement($this->createAttributeElementDummy());
        $this->sut->addNotationElement($this->createNotationElementDummy());
        $this->sut->addDefinitionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getSimpleTypeElements(), 'Added elements but no SimpleTypeElement element.');
        
        $elements[] = $this->createSimpleTypeElementDummy();
        $this->sut->addSimpleTypeElement($elements[0]);
        self::assertSame($elements, $this->sut->getSimpleTypeElements(), 'Added 1 SimpleTypeElement element.');
        
        $this->sut->addComplexTypeElement($this->createComplexTypeElementDummy());
        self::assertSame($elements, $this->sut->getSimpleTypeElements(), 'Added 1 element between.');
        
        $elements[] = $this->createSimpleTypeElementDummy();
        $this->sut->addSimpleTypeElement($elements[1]);
        self::assertSame($elements, $this->sut->getSimpleTypeElements(), 'Added 2 SimpleTypeElement elements.');
    }
    
    /**
     * Tests that getComplexTypeElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no ComplexTypeElement element has been added
     * - an indexed array of all added ComplexTypeElement elements
     * 
     * @group   content
     */
    public function testGetComplexTypeElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getComplexTypeElements(), 'No element has been added.');
        
        $this->sut->addSimpleTypeElement($this->createSimpleTypeElementDummy());
        $this->sut->addGroupElement($this->createGroupElementDummy());
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementDummy());
        $this->sut->addElementElement($this->createElementElementDummy());
        $this->sut->addAttributeElement($this->createAttributeElementDummy());
        $this->sut->addNotationElement($this->createNotationElementDummy());
        $this->sut->addDefinitionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getComplexTypeElements(), 'Added elements but no ComplexTypeElement element.');
        
        $elements[] = $this->createComplexTypeElementDummy();
        $this->sut->addComplexTypeElement($elements[0]);
        self::assertSame($elements, $this->sut->getComplexTypeElements(), 'Added 1 ComplexTypeElement element.');
        
        $this->sut->addGroupElement($this->createGroupElementDummy());
        self::assertSame($elements, $this->sut->getComplexTypeElements(), 'Added 1 element between.');
        
        $elements[] = $this->createComplexTypeElementDummy();
        $this->sut->addComplexTypeElement($elements[1]);
        self::assertSame($elements, $this->sut->getComplexTypeElements(), 'Added 2 ComplexTypeElement elements.');
    }
    
    /**
     * Tests that getGroupElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no GroupElement element has been added
     * - an indexed array of all added GroupElement elements
     * 
     * @group   content
     */
    public function testGetGroupElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getGroupElements(), 'No element has been added.');
        
        $this->sut->addSimpleTypeElement($this->createSimpleTypeElementDummy());
        $this->sut->addComplexTypeElement($this->createComplexTypeElementDummy());
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementDummy());
        $this->sut->addElementElement($this->createElementElementDummy());
        $this->sut->addAttributeElement($this->createAttributeElementDummy());
        $this->sut->addNotationElement($this->createNotationElementDummy());
        $this->sut->addDefinitionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added elements but no GroupElement element.');
        
        $elements[] = $this->createGroupElementDummy();
        $this->sut->addGroupElement($elements[0]);
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added 1 GroupElement element.');
        
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementDummy());
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added 1 element between.');
        
        $elements[] = $this->createGroupElementDummy();
        $this->sut->addGroupElement($elements[1]);
        self::assertSame($elements, $this->sut->getGroupElements(), 'Added 2 GroupElement elements.');
    }
    
    /**
     * Tests that getAttributeGroupElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AttributeGroupElement element has been added
     * - an indexed array of all added AttributeGroupElement elements
     * 
     * @group   content
     */
    public function testGetAttributeGroupElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'No element has been added.');
        
        $this->sut->addSimpleTypeElement($this->createSimpleTypeElementDummy());
        $this->sut->addComplexTypeElement($this->createComplexTypeElementDummy());
        $this->sut->addGroupElement($this->createGroupElementDummy());
        $this->sut->addElementElement($this->createElementElementDummy());
        $this->sut->addAttributeElement($this->createAttributeElementDummy());
        $this->sut->addNotationElement($this->createNotationElementDummy());
        $this->sut->addDefinitionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added elements but no AttributeGroupElement element.');
        
        $elements[] = $this->createAttributeGroupElementDummy();
        $this->sut->addAttributeGroupElement($elements[0]);
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added 1 AttributeGroupElement element.');
        
        $this->sut->addElementElement($this->createElementElementDummy());
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAttributeGroupElementDummy();
        $this->sut->addAttributeGroupElement($elements[1]);
        self::assertSame($elements, $this->sut->getAttributeGroupElements(), 'Added 2 AttributeGroupElement elements.');
    }
    
    /**
     * Tests that getElementElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no ElementElement element has been added
     * - an indexed array of all added ElementElement elements
     * 
     * @group   content
     */
    public function testGetElementElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getElementElements(), 'No element has been added.');
        
        $this->sut->addSimpleTypeElement($this->createSimpleTypeElementDummy());
        $this->sut->addComplexTypeElement($this->createComplexTypeElementDummy());
        $this->sut->addGroupElement($this->createGroupElementDummy());
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementDummy());
        $this->sut->addAttributeElement($this->createAttributeElementDummy());
        $this->sut->addNotationElement($this->createNotationElementDummy());
        $this->sut->addDefinitionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getElementElements(), 'Added elements but no ElementElement element.');
        
        $elements[] = $this->createElementElementDummy();
        $this->sut->addElementElement($elements[0]);
        self::assertSame($elements, $this->sut->getElementElements(), 'Added 1 ElementElement element.');
        
        $this->sut->addAttributeElement($this->createAttributeElementDummy());
        self::assertSame($elements, $this->sut->getElementElements(), 'Added 1 element between.');
        
        $elements[] = $this->createElementElementDummy();
        $this->sut->addElementElement($elements[1]);
        self::assertSame($elements, $this->sut->getElementElements(), 'Added 2 ElementElement elements.');
    }
    
    /**
     * Tests that getAttributeElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AttributeElement element has been added
     * - an indexed array of all added AttributeElement elements
     * 
     * @group   content
     */
    public function testGetAttributeElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getAttributeElements(), 'No element has been added.');
        
        $this->sut->addSimpleTypeElement($this->createSimpleTypeElementDummy());
        $this->sut->addComplexTypeElement($this->createComplexTypeElementDummy());
        $this->sut->addGroupElement($this->createGroupElementDummy());
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementDummy());
        $this->sut->addElementElement($this->createElementElementDummy());
        $this->sut->addNotationElement($this->createNotationElementDummy());
        $this->sut->addDefinitionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getAttributeElements(), 'Added elements but no AttributeElement element.');
        
        $elements[] = $this->createAttributeElementDummy();
        $this->sut->addAttributeElement($elements[0]);
        self::assertSame($elements, $this->sut->getAttributeElements(), 'Added 1 AttributeElement element.');
        
        $this->sut->addNotationElement($this->createNotationElementDummy());
        self::assertSame($elements, $this->sut->getAttributeElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAttributeElementDummy();
        $this->sut->addAttributeElement($elements[1]);
        self::assertSame($elements, $this->sut->getAttributeElements(), 'Added 2 AttributeElement elements.');
    }
    
    /**
     * Tests that getNotationElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no NotationElement element has been added
     * - an indexed array of all added NotationElement elements
     * 
     * @group   content
     */
    public function testGetNotationElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getNotationElements(), 'No element has been added.');
        
        $this->sut->addSimpleTypeElement($this->createSimpleTypeElementDummy());
        $this->sut->addComplexTypeElement($this->createComplexTypeElementDummy());
        $this->sut->addGroupElement($this->createGroupElementDummy());
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementDummy());
        $this->sut->addElementElement($this->createElementElementDummy());
        $this->sut->addAttributeElement($this->createAttributeElementDummy());
        $this->sut->addDefinitionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getNotationElements(), 'Added elements but no NotationElement element.');
        
        $elements[] = $this->createNotationElementDummy();
        $this->sut->addNotationElement($elements[0]);
        self::assertSame($elements, $this->sut->getNotationElements(), 'Added 1 NotationElement element.');
        
        $this->sut->addDefinitionAnnotationElement($this->createAnnotationElementDummy());
        self::assertSame($elements, $this->sut->getNotationElements(), 'Added 1 element between.');
        
        $elements[] = $this->createNotationElementDummy();
        $this->sut->addNotationElement($elements[1]);
        self::assertSame($elements, $this->sut->getNotationElements(), 'Added 2 NotationElement elements.');
    }
    
    /**
     * Tests that getDefinitionAnnotationElements() returns:
     * - an empty array when no element has been added
     * - an empty array when no AnnotationElement element has been added
     * - an indexed array of all added AnnotationElement elements
     * 
     * @group   content
     */
    public function testGetDefinitionAnnotationElements()
    {
        $elements = [];
        
        self::assertSame($elements, $this->sut->getDefinitionAnnotationElements(), 'No element has been added.');
        
        $this->sut->addSimpleTypeElement($this->createSimpleTypeElementDummy());
        $this->sut->addComplexTypeElement($this->createComplexTypeElementDummy());
        $this->sut->addGroupElement($this->createGroupElementDummy());
        $this->sut->addAttributeGroupElement($this->createAttributeGroupElementDummy());
        $this->sut->addElementElement($this->createElementElementDummy());
        $this->sut->addAttributeElement($this->createAttributeElementDummy());
        $this->sut->addNotationElement($this->createNotationElementDummy());
        self::assertSame($elements, $this->sut->getDefinitionAnnotationElements(), 'Added elements but no AnnotationElement element.');
        
        $elements[] = $this->createAnnotationElementDummy();
        $this->sut->addDefinitionAnnotationElement($elements[0]);
        self::assertSame($elements, $this->sut->getDefinitionAnnotationElements(), 'Added 1 AnnotationElement element.');
        
        $this->sut->addSimpleTypeElement($this->createSimpleTypeElementDummy());
        self::assertSame($elements, $this->sut->getDefinitionAnnotationElements(), 'Added 1 element between.');
        
        $elements[] = $this->createAnnotationElementDummy();
        $this->sut->addDefinitionAnnotationElement($elements[1]);
        self::assertSame($elements, $this->sut->getDefinitionAnnotationElements(), 'Added 2 AnnotationElement elements.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in container 1 ((((simpleType | complexType | group | attributeGroup) | element | attribute | notation), annotation*)*).
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOfContainer1()
    {
        $children = [];
        $children[] = $this->createSimpleTypeElementDummy();
        $children[] = $this->createComplexTypeElementDummy();
        $children[] = $this->createGroupElementDummy();
        $children[] = $this->createAttributeGroupElementDummy();
        $children[] = $this->createElementElementDummy();
        $children[] = $this->createAttributeElementDummy();
        $children[] = $this->createNotationElementDummy();
        $children[] = $this->createAnnotationElementDummy();
        $children[] = $this->createSimpleTypeElementDummy();
        $children[] = $this->createComplexTypeElementDummy();
        $children[] = $this->createGroupElementDummy();
        $children[] = $this->createAttributeGroupElementDummy();
        $children[] = $this->createElementElementDummy();
        $children[] = $this->createAttributeElementDummy();
        $children[] = $this->createNotationElementDummy();
        $children[] = $this->createAnnotationElementDummy();
        $this->sut->addSimpleTypeElement($children[0]);
        $this->sut->addComplexTypeElement($children[1]);
        $this->sut->addGroupElement($children[2]);
        $this->sut->addAttributeGroupElement($children[3]);
        $this->sut->addElementElement($children[4]);
        $this->sut->addAttributeElement($children[5]);
        $this->sut->addNotationElement($children[6]);
        $this->sut->addDefinitionAnnotationElement($children[7]);
        $this->sut->addSimpleTypeElement($children[8]);
        $this->sut->addComplexTypeElement($children[9]);
        $this->sut->addGroupElement($children[10]);
        $this->sut->addAttributeGroupElement($children[11]);
        $this->sut->addElementElement($children[12]);
        $this->sut->addAttributeElement($children[13]);
        $this->sut->addNotationElement($children[14]);
        $this->sut->addDefinitionAnnotationElement($children[15]);
        self::assertSame($children, $this->sut->getElements(), 'Elements in container 1.');
    }
    
    /**
     * Tests that getElements() returns an indexed array of all added 
     * elements in that order:
     * - elements from container 0 ((include | import | redefine | annotation)*)
     * - elements from container 1 ((((simpleType | complexType | group | attributeGroup) | element | attribute | notation), annotation*)*)
     * 
     * @group   content
     */
    public function testGetElementsReturnsElementsOrderedByContainer01()
    {
        $children = [];
        $children[] = $this->createIncludeElementDummy();
        $children[] = $this->createImportElementDummy();
        $children[] = $this->createRedefineElementDummy();
        $children[] = $this->createAnnotationElementDummy();
        $children[] = $this->createIncludeElementDummy();
        $children[] = $this->createImportElementDummy();
        $children[] = $this->createRedefineElementDummy();
        $children[] = $this->createAnnotationElementDummy();
        $children[] = $this->createSimpleTypeElementDummy();
        $children[] = $this->createComplexTypeElementDummy();
        $children[] = $this->createGroupElementDummy();
        $children[] = $this->createAttributeGroupElementDummy();
        $children[] = $this->createElementElementDummy();
        $children[] = $this->createAttributeElementDummy();
        $children[] = $this->createNotationElementDummy();
        $children[] = $this->createAnnotationElementDummy();
        $children[] = $this->createSimpleTypeElementDummy();
        $children[] = $this->createComplexTypeElementDummy();
        $children[] = $this->createGroupElementDummy();
        $children[] = $this->createAttributeGroupElementDummy();
        $children[] = $this->createElementElementDummy();
        $children[] = $this->createAttributeElementDummy();
        $children[] = $this->createNotationElementDummy();
        $children[] = $this->createAnnotationElementDummy();
        
        // Init container 1.
        $this->sut->addSimpleTypeElement($children[8]);
        $this->sut->addComplexTypeElement($children[9]);
        $this->sut->addGroupElement($children[10]);
        $this->sut->addAttributeGroupElement($children[11]);
        $this->sut->addElementElement($children[12]);
        $this->sut->addAttributeElement($children[13]);
        $this->sut->addNotationElement($children[14]);
        $this->sut->addDefinitionAnnotationElement($children[15]);
        $this->sut->addSimpleTypeElement($children[16]);
        $this->sut->addComplexTypeElement($children[17]);
        $this->sut->addGroupElement($children[18]);
        $this->sut->addAttributeGroupElement($children[19]);
        $this->sut->addElementElement($children[20]);
        $this->sut->addAttributeElement($children[21]);
        $this->sut->addNotationElement($children[22]);
        $this->sut->addDefinitionAnnotationElement($children[23]);
        
        // Init container 0.
        $this->sut->addIncludeElement($children[0]);
        $this->sut->addImportElement($children[1]);
        $this->sut->addRedefineElement($children[2]);
        $this->sut->addCompositionAnnotationElement($children[3]);
        $this->sut->addIncludeElement($children[4]);
        $this->sut->addImportElement($children[5]);
        $this->sut->addRedefineElement($children[6]);
        $this->sut->addCompositionAnnotationElement($children[7]);
        
        self::assertSame($children, $this->sut->getElements(), 'Elements ordered by container: 0, 1.');
    }
}
