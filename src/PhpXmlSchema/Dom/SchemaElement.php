<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\AnyUriType;
use PhpXmlSchema\Datatype\LanguageType;
use PhpXmlSchema\Datatype\TokenType;

/**
 * Represents the XML schema "schema" element.
 * 
 * Attributes (version 1.0):
 * - attributeFormDefault = (qualified | unqualified)
 * - blockDefault = (#all | List of (extension | restriction | substitution))  : ''
 * - elementFormDefault = (qualified | unqualified)
 * - id = ID
 * - targetNamespace = anyURI
 * - version = token
 * - xml:lang = language
 * 
 * Content (version 1.0):
 * ((include | import | redefine | annotation)*, (((simpleType | complexType | group | attributeGroup) | element | attribute | notation), annotation*)*)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SchemaElement extends AbstractCompositeElement
{
    /**
     * The value of the "attributeFormDefault" attribute.
     * @var FormType|NULL
     */
    private $attributeFormDefaultAttr;
    
    /**
     * The value of the "blockDefault" attribute.
     * @var DerivationType|NULL
     */
    private $blockDefaultAttr;
    
    /**
     * The value of the "elementFormDefault" attribute.
     * @var FormType|NULL
     */
    private $elementFormDefaultAttr;
    
    /**
     * The value of the "xml:lang" attribute.
     * @var LanguageType|NULL
     */
    private $langAttr;
    
    /**
     * The value of the "targetNamespace" attribute.
     * @var AnyUriType|NULL
     */
    private $targetNamespaceAttr;
    
    /**
     * The value of the "version" attribute.
     * @var TokenType|NULL
     */
    private $versionAttr;
    
    /**
     * Returns the value of the "attributeFormDefault" attribute.
     * 
     * @return  FormType|NULL   The value of the attribute if it has been set, otherwise NULL.
     */
    public function getAttributeFormDefault()
    {
        return $this->attributeFormDefaultAttr;
    }
    
    /**
     * Sets the value of the "attributeFormDefault" attribute.
     * 
     * @param   FormType    $value  The value to set.
     */
    public function setAttributeFormDefault(FormType $value)
    {
        $this->attributeFormDefaultAttr = $value;
    }
    
    /**
     * Indicates whether the "attributeFormDefault" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasAttributeFormDefault():bool
    {
        return $this->attributeFormDefaultAttr !== NULL;
    }
    
    /**
     * Returns the value of the "blockDefault" attribute.
     * 
     * @return  DerivationType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getBlockDefault()
    {
        return $this->blockDefaultAttr;
    }
    
    /**
     * Sets the value of the "blockDefault" attribute.
     * 
     * @param   DerivationType  $value  The value to set.
     */
    public function setBlockDefault(DerivationType $value)
    {
        $this->blockDefaultAttr = $value;
    }
    
    /**
     * Indicates whether the "blockDefault" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasBlockDefault():bool
    {
        return $this->blockDefaultAttr !== NULL;
    }
    
    /**
     * Returns the value of the "elementFormDefault" attribute.
     * 
     * @return  FormType|NULL   The value of the attribute if it has been set, otherwise NULL.
     */
    public function getElementFormDefault()
    {
        return $this->elementFormDefaultAttr;
    }
    
    /**
     * Sets the value of the "elementFormDefault" attribute.
     * 
     * @param   FormType    $value  The value to set.
     */
    public function setElementFormDefault(FormType $value)
    {
        $this->elementFormDefaultAttr = $value;
    }
    
    /**
     * Indicates whether the "elementFormDefault" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasElementFormDefault():bool
    {
        return $this->elementFormDefaultAttr !== NULL;
    }
    
    /**
     * Returns the value of the "xml:lang" attribute.
     * 
     * @return  LanguageType|NULL   The value of the attribute if it has been set, otherwise NULL.
     */
    public function getLang()
    {
        return $this->langAttr;
    }
    
    /**
     * Sets the value of the "xml:lang" attribute.
     * 
     * @param   LanguageType    $value  The value to set.
     */
    public function setLang(LanguageType $value)
    {
        $this->langAttr = $value;
    }
    
    /**
     * Indicates whether the "xml:lang" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasLang():bool
    {
        return $this->langAttr !== NULL;
    }
    
    /**
     * Returns the value of the "targetNamespace" attribute.
     * 
     * @return  AnyUriType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getTargetNamespace()
    {
        return $this->targetNamespaceAttr;
    }
    
    /**
     * Sets the value of the "targetNamespace" attribute.
     * 
     * @param   AnyUriType  $value  The value to set.
     */
    public function setTargetNamespace(AnyUriType $value)
    {
        $this->targetNamespaceAttr = $value;
    }
    
    /**
     * Indicates whether the "targetNamespace" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasTargetNamespace():bool
    {
        return $this->targetNamespaceAttr !== NULL;
    }
    
    /**
     * Returns the value of the "version" attribute.
     * 
     * @return  TokenType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getVersion()
    {
        return $this->versionAttr;
    }
    
    /**
     * Sets the value of the "version" attribute.
     * 
     * @param   TokenType   $value  The value to set.
     */
    public function setVersion(TokenType $value)
    {
        $this->versionAttr = $value;
    }
    
    /**
     * Indicates whether the "version" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasVersion():bool
    {
        return $this->versionAttr !== NULL;
    }
    
    /**
     * Adds an "include" element to this element.
     * 
     * @param   IncludeElement  $element    The element to add.
     */
    public function addIncludeElement(IncludeElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "include" child elements.
     * 
     * @return  IncludeElement[]    An indexed array of IncludeElement instances.
     */
    public function getIncludeElements():array
    {
        return $this->getChildElementsByType(0, IncludeElement::class);
    }
    
    /**
     * Adds an "import" element to this element.
     * 
     * @param   ImportElement   $element    The element to add.
     */
    public function addImportElement(ImportElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "import" child elements.
     * 
     * @return  ImportElement[] An indexed array of ImportElement instances.
     */
    public function getImportElements():array
    {
        return $this->getChildElementsByType(0, ImportElement::class);
    }
    
    /**
     * Adds a "redefine" element to this element.
     * 
     * @param   RedefineElement $element    The element to add.
     */
    public function addRedefineElement(RedefineElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "redefine" child elements.
     * 
     * @return  RedefineElement[]   An indexed array of RedefineElement instances.
     */
    public function getRedefineElements():array
    {
        return $this->getChildElementsByType(0, RedefineElement::class);
    }
    
    /**
     * Adds an "annotation" element to this element.
     * 
     * @param   AnnotationElement   $element    The element to add.
     */
    public function addCompositionAnnotationElement(AnnotationElement $element)
    {
        $this->addChildElement(0, $element);
    }
    
    /**
     * Returns all the "annotation" child elements.
     * 
     * @return  AnnotationElement[] An indexed array of AnnotationElement instances.
     */
    public function getCompositionAnnotationElements():array
    {
        return $this->getChildElementsByType(0, AnnotationElement::class);
    }
    
    /**
     * Adds a "simpleType" element to this element.
     * 
     * @param   SimpleTypeElement   $element    The element to add.
     */
    public function addSimpleTypeElement(SimpleTypeElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "simpleType" child elements.
     * 
     * @return  SimpleTypeElement[] An indexed array of SimpleTypeElement instances.
     */
    public function getSimpleTypeElements():array
    {
        return $this->getChildElementsByType(1, SimpleTypeElement::class);
    }
    
    /**
     * Adds a "complexType" element to this element.
     * 
     * @param   ComplexTypeElement  $element    The element to add.
     */
    public function addComplexTypeElement(ComplexTypeElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "complexType" child elements.
     * 
     * @return  ComplexTypeElement[]    An indexed array of ComplexTypeElement instances.
     */
    public function getComplexTypeElements():array
    {
        return $this->getChildElementsByType(1, ComplexTypeElement::class);
    }
    
    /**
     * Adds a "group" element to this element.
     * 
     * @param   GroupElement    $element    The element to add.
     */
    public function addGroupElement(GroupElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "group" child elements.
     * 
     * @return  GroupElement[]  An indexed array of GroupElement instances.
     */
    public function getGroupElements():array
    {
        return $this->getChildElementsByType(1, GroupElement::class);
    }
    
    /**
     * Adds an "attributeGroup" element to this element.
     * 
     * @param   AttributeGroupElement   $element    The element to add.
     */
    public function addAttributeGroupElement(AttributeGroupElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "attributeGroup" child elements.
     * 
     * @return  AttributeGroupElement[] An indexed array of AttributeGroupElement instances.
     */
    public function getAttributeGroupElements():array
    {
        return $this->getChildElementsByType(1, AttributeGroupElement::class);
    }
    
    /**
     * Adds an "element" element to this element.
     * 
     * @param   ElementElement  $element    The element to add.
     */
    public function addElementElement(ElementElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "element" child elements.
     * 
     * @return  ElementElement[]    An indexed array of ElementElement instances.
     */
    public function getElementElements():array
    {
        return $this->getChildElementsByType(1, ElementElement::class);
    }
    
    /**
     * Adds an "attribute" element to this element.
     * 
     * @param   AttributeElement    $element    The element to add.
     */
    public function addAttributeElement(AttributeElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "attribute" child elements.
     * 
     * @return  AttributeElement[]  An indexed array of AttributeElement instances.
     */
    public function getAttributeElements():array
    {
        return $this->getChildElementsByType(1, AttributeElement::class);
    }
    
    /**
     * Adds a "notation" element to this element.
     * 
     * @param   NotationElement $element    The element to add.
     */
    public function addNotationElement(NotationElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "notation" child elements.
     * 
     * @return  NotationElement[]   An indexed array of NotationElement instances.
     */
    public function getNotationElements():array
    {
        return $this->getChildElementsByType(1, NotationElement::class);
    }
    
    /**
     * Adds a "annotation" element to this element.
     * 
     * @param   AnnotationElement   $element    The element to add.
     */
    public function addDefinitionAnnotationElement(AnnotationElement $element)
    {
        $this->addChildElement(1, $element);
    }
    
    /**
     * Returns all the "annotation" child elements.
     * 
     * @return  AnnotationElement[] An indexed array of AnnotationElement instances.
     */
    public function getDefinitionAnnotationElements():array
    {
        return $this->getChildElementsByType(1, AnnotationElement::class);
    }
}
