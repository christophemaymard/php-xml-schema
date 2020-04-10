<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\AttributeElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\AttributeElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AttributeElementTest extends AbstractSimpleTypedElementTestCase
{
    use DefaultAttributeTestCaseTrait;
    use FixedAttributeTestCaseTrait;
    use NameAttributeTestCaseTrait;
    use RefAttributeTestCaseTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new AttributeElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function testGetLocalNameReturnsSpecificString()
    {
        self::assertSame('attribute', $this->sut->getLocalName());
    }
    
    /**
     * Tests that hasForm() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasForm()
    {
        self::assertFalse($this->sut->hasForm(), 'The attribute has not been set.');
        
        $this->sut->setForm($this->createFormTypeDummy());
        self::assertTrue($this->sut->hasForm(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getForm() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetForm()
    {
        self::assertNull($this->sut->getForm(), 'The attribute has not been set.');
        
        $form1 = $this->createFormTypeDummy();
        $this->sut->setForm($form1);
        self::assertSame($form1, $this->sut->getForm(), 'Set the attribute with a value: FormType.');
        
        $form2 = $this->createFormTypeDummy();
        $this->sut->setForm($form2);
        self::assertSame($form2, $this->sut->getForm(), 'Set the attribute with another value: FormType.');
    }
    
    /**
     * Tests that hasType() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasType()
    {
        self::assertFalse($this->sut->hasType(), 'The attribute has not been set.');
        
        $this->sut->setType($this->createQNameTypeDummy());
        self::assertTrue($this->sut->hasType(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getType() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetType()
    {
        self::assertNull($this->sut->getType(), 'The attribute has not been set.');
        
        $qname1 = $this->createQNameTypeDummy();
        $this->sut->setType($qname1);
        self::assertSame($qname1, $this->sut->getType(), 'Set the attribute with a value: QNameType.');
        
        $qname2 = $this->createQNameTypeDummy();
        $this->sut->setType($qname2);
        self::assertSame($qname2, $this->sut->getType(), 'Set the attribute with another value: QNameType.');
    }
    
    /**
     * Tests that hasUse() returns a boolean:
     * - FALSE when the attribute has not been set
     * - TRUE when the attribute has been set
     * 
     * @group   attribute
     */
    public function testHasUse()
    {
        self::assertFalse($this->sut->hasUse(), 'The attribute has not been set.');
        
        $this->sut->setUse($this->createUseTypeDummy());
        self::assertTrue($this->sut->hasUse(), 'The attribute has been set.');
    }
    
    /**
     * Tests that getUse() returns:
     * - NULL when the attribute has not been set
     * - the value of the attribute that has been set
     * 
     * @group   attribute
     */
    public function testGetUse()
    {
        self::assertNull($this->sut->getUse(), 'The attribute has not been set.');
        
        $use1 = $this->createUseTypeDummy();
        $this->sut->setUse($use1);
        self::assertSame($use1, $this->sut->getUse(), 'Set the attribute with a value: UseType.');
        
        $use2 = $this->createUseTypeDummy();
        $this->sut->setUse($use2);
        self::assertSame($use2, $this->sut->getUse(), 'Set the attribute with another value: UseType.');
    }
}
