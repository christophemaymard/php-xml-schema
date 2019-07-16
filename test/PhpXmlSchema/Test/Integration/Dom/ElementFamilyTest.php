<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\AllElement;
use PhpXmlSchema\Dom\AnnotationElement;
use PhpXmlSchema\Dom\AnyAttributeElement;
use PhpXmlSchema\Dom\AnyElement;
use PhpXmlSchema\Dom\AppInfoElement;
use PhpXmlSchema\Dom\AttributeElement;
use PhpXmlSchema\Dom\AttributeGroupElement;
use PhpXmlSchema\Dom\ChoiceElement;
use PhpXmlSchema\Dom\ComplexContentElement;
use PhpXmlSchema\Dom\ComplexContentExtensionElement;
use PhpXmlSchema\Dom\ComplexContentRestrictionElement;
use PhpXmlSchema\Dom\ComplexTypeElement;
use PhpXmlSchema\Dom\DocumentationElement;
use PhpXmlSchema\Dom\ElementElement;
use PhpXmlSchema\Dom\ElementInterface;
use PhpXmlSchema\Dom\EnumerationElement;
use PhpXmlSchema\Dom\FieldElement;
use PhpXmlSchema\Dom\FractionDigitsElement;
use PhpXmlSchema\Dom\GroupElement;
use PhpXmlSchema\Dom\ImportElement;
use PhpXmlSchema\Dom\IncludeElement;
use PhpXmlSchema\Dom\KeyElement;
use PhpXmlSchema\Dom\KeyRefElement;
use PhpXmlSchema\Dom\LengthElement;
use PhpXmlSchema\Dom\ListElement;
use PhpXmlSchema\Dom\MaxExclusiveElement;
use PhpXmlSchema\Dom\MaxInclusiveElement;
use PhpXmlSchema\Dom\MaxLengthElement;
use PhpXmlSchema\Dom\MinExclusiveElement;
use PhpXmlSchema\Dom\MinInclusiveElement;
use PhpXmlSchema\Dom\MinLengthElement;
use PhpXmlSchema\Dom\NotationElement;
use PhpXmlSchema\Dom\PatternElement;
use PhpXmlSchema\Dom\RedefineElement;
use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SelectorElement;
use PhpXmlSchema\Dom\SequenceElement;
use PhpXmlSchema\Dom\SimpleContentElement;
use PhpXmlSchema\Dom\SimpleContentExtensionElement;
use PhpXmlSchema\Dom\SimpleContentRestrictionElement;
use PhpXmlSchema\Dom\SimpleTypeElement;
use PhpXmlSchema\Dom\SimpleTypeRestrictionElement;
use PhpXmlSchema\Dom\TotalDigitsElement;
use PhpXmlSchema\Dom\UnionElement;
use PhpXmlSchema\Dom\UniqueElement;
use PhpXmlSchema\Dom\WhiteSpaceElement;

/**
 * Represents the integration tests that implies all the elements.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ElementFamilyTest extends TestCase
{
    /**
     * Tests that getElementId() of all the elements returns an unique 
     * identifier.
     */
    public function testGetElementIdIsUnique()
    {
        $elts = [];
        $id = NULL;
        
        foreach ($this->getAllXmlSchemaElements() as $elt) {
            $id = $elt->getElementId();
            self::assertArrayNotHasKey($id, $elts, \sprintf(
                'An element has the same identifier %s as the "%s" class.',
                $id,
                \get_class($elt)
            ));
            
            $elts[$id] = $elt;
        }
    }
    
    /**
     * Returns a set of all the elements.
     * 
     * @return  ElementInterface[]
     */
    private function getAllXmlSchemaElements():array
    {
        return [
            new AllElement(), 
            new AnnotationElement(), 
            new AnyAttributeElement(), 
            new AnyElement(), 
            new AppInfoElement(), 
            new AttributeElement(), 
            new AttributeGroupElement(), 
            new ChoiceElement(), 
            new ComplexContentElement(), 
            new ComplexContentExtensionElement(), 
            new ComplexContentRestrictionElement(), 
            new ComplexTypeElement(), 
            new DocumentationElement(), 
            new ElementElement(), 
            new EnumerationElement(), 
            new FieldElement(), 
            new FractionDigitsElement(), 
            new GroupElement(), 
            new ImportElement(), 
            new IncludeElement(), 
            new KeyElement(), 
            new KeyRefElement(), 
            new LengthElement(), 
            new ListElement(), 
            new MaxExclusiveElement(), 
            new MaxInclusiveElement(), 
            new MaxLengthElement(), 
            new MinExclusiveElement(), 
            new MinInclusiveElement(), 
            new MinLengthElement(), 
            new NotationElement(), 
            new PatternElement(), 
            new RedefineElement(), 
            new SchemaElement(), 
            new SelectorElement(), 
            new SequenceElement(), 
            new SimpleContentElement(), 
            new SimpleContentExtensionElement(), 
            new SimpleContentRestrictionElement(), 
            new SimpleTypeElement(), 
            new SimpleTypeRestrictionElement(), 
            new TotalDigitsElement(), 
            new UnionElement(), 
            new UniqueElement(), 
            new WhiteSpaceElement(), 
        ];
    }
}
