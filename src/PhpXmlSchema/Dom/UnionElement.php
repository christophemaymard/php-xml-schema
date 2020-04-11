<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\QNameType;

/**
 * Represents the XML schema "union" element.
 * 
 * Attributes (version 1.0):
 * - id = ID
 * - memberTypes = List of QName
 * 
 * Content (version 1.0):
 * (annotation?, simpleType*)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UnionElement extends AbstractAnnotatedElement implements SimpleTypeDerivationElementInterface
{
    /**
     * The value of the "memberTypes" attribute.
     * @var QNameType[]
     */
    private $memberTypesAttr = [];
    
    /**
     * {@inheritDoc}
     */
    public function getElementId(): int
    {
        return ElementId::ELT_UNION;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName(): string
    {
        return 'union';
    }
    
    /**
     * Adds the value of the "memberTypes" attribute.
     * 
     * @param   QNameType   $value  The value to set.
     */
    public function addMemberType(QNameType $value): void
    {
        $this->memberTypesAttr[] = $value;
    }
    
    /**
     * Returns all the values of the "memberTypes" attribute.
     * 
     * @return  QNameType[] An indexed array of QName instances.
     */
    public function getMemberTypes(): array
    {
        return $this->memberTypesAttr;
    }
    
    /**
     * Indicates whether the "memberTypes" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasMemberTypes(): bool
    {
        return !empty($this->memberTypesAttr);
    }
    
    /**
     * Adds a "simpleType" element to this element.
     * 
     * @param   SimpleTypeElement   $element    The element to add.
     */
    public function addSimpleTypeElement(SimpleTypeElement $element): void
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "simpleType" child elements.
     * 
     * @return  SimpleTypeElement[] An indexed array of SimpleTypeElement instances.
     */
    public function getSimpleTypeElements(): array
    {
        return $this->getChildElementsByType(1, SimpleTypeElement::class);
    }
}
