<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\AttributeGroupElement;
use PhpXmlSchema\Dom\AttributeNamingElementInterface;
use PhpXmlSchema\Dom\ComplexContentExtensionElement;
use PhpXmlSchema\Dom\ComplexContentRestrictionElement;
use PhpXmlSchema\Dom\ComplexTypeElement;
use PhpXmlSchema\Dom\ElementInterface;
use PhpXmlSchema\Dom\SimpleContentExtensionElement;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use PhpXmlSchema\Dom\TypeNamingElementInterface;
use PhpXmlSchema\Exception\InvalidOperationException;

/**
 * Represents the base class for all the element integration test cases.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractAbstractElementTestCase extends TestCase
{
    /**
     * The element to test.
     * @var ElementInterface
     */
    protected $sut;
    
    /**
     * Tests that hasParent() returns FALSE and getParent() returns NULL when 
     * the element is instantiated.
     * 
     * @group   content
     */
    public function testHasParentGetParentWhenElementInstantiated()
    {
        self::assertFalse($this->sut->hasParent());
        self::assertNull($this->sut->getParent());
    }
    
    /**
     * Expects that InvalidOperationException exception is thrown with the 
     * message 'The "CHILD_LOCALNAME" element cannot be added to the 
     * "PARENT_LOCALNAME" element because it already belongs to another 
     * element.'.
     * 
     * @param   ElementInterface    $childElement
     * @param   ElementInterface    $parentElement
     */
    protected function expectInvalidOperationExceptionChildOfAnotherElement(
        ElementInterface $childElement,
        ElementInterface $parentElement
    ){
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage(\sprintf(
            'The "%s" element cannot be added to the "%s" element because it already belongs to another element.',
            $childElement->getLocalName(),
            $parentElement->getLocalName()
        ));
    }
    
    /**
     * Returns a set of all the attribute naming element values.
     * 
     * @return  array[]
     */
    public function getAllAttributeNamingElementValues():array
    {
        $datasets = [];
        
        foreach ($this->getAllAttributeNamingElements() as $element) {
            $datasets[] = [ $element, ];
        }
        
        return $datasets;
    }
    
    /**
     * Returns a set of all the attribute naming element parent values.
     * 
     * @return  array[]
     */
    public function getAllAttributeNamingElementParentValues():array
    {
        $datasets = [];
        
        $parents1 = $this->getAllAttributeNamingElements();
        $parents2 = $this->getAllAttributeNamingElements();
        $count = count($parents1);
        
        for ($num = 0; $num < $count; $num++) {
            $datasets[] = [ \array_shift($parents1), \array_shift($parents2), ];
        }
        
        return $datasets;
    }
    
    /**
     * Returns a set of all the attribute naming elements.
     * 
     * @return  AttributeNamingElementInterface[]
     */
    private function getAllAttributeNamingElements():array
    {
        return [
            new AttributeGroupElement(),
            new ComplexContentExtensionElement(),
            new ComplexContentRestrictionElement(),
            new ComplexTypeElement(),
            new SimpleContentExtensionElement(),
            new SimpleContentRestrictionElement(),
        ];
    }
    
    /**
     * Returns a set of all the type naming element values.
     * 
     * @return  array[]
     */
    public function getAllTypeNamingElementValues():array
    {
        $datasets = [];
        
        foreach ($this->getAllTypeNamingElements() as $element) {
            $datasets[] = [ $element, ];
        }
        
        return $datasets;
    }
    
    /**
     * Returns a set of all the type naming element parent values.
     * 
     * @return  array[]
     */
    public function getAllTypeNamingElementParentValues():array
    {
        $datasets = [];
        
        $parents1 = $this->getAllTypeNamingElements();
        $parents2 = $this->getAllTypeNamingElements();
        $count = count($parents1);
        
        for ($num = 0; $num < $count; $num++) {
            $datasets[] = [ \array_shift($parents1), \array_shift($parents2), ];
        }
        
        return $datasets;
    }
    
    /**
     * Returns a set of all the type naming elements.
     * 
     * @return  TypeNamingElementInterface[]
     */
    private function getAllTypeNamingElements():array
    {
        return [
            new ComplexContentExtensionElement(),
            new ComplexContentRestrictionElement(),
            new ComplexTypeElement(),
        ];
    }
}
