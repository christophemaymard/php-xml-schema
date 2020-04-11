<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\NCNameType;
use PhpXmlSchema\Datatype\QNameType;
use PhpXmlSchema\Datatype\StringType;

/**
 * Represents the XML schema "attribute" element.
 * 
 * Attributes (version 1.0):
 * - default = string
 * - fixed = string
 * - form = (qualified | unqualified)
 * - id = ID
 * - name = NCName
 * - ref = QName
 * - type = QName
 * - use = (optional | prohibited | required) : optional
 * 
 * Content (version 1.0):
 * (annotation?, simpleType?)
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AttributeElement extends AbstractSimpleTypedElement implements AttributeDeclarationElementInterface
{
    /**
     * The value of the "default" attribute.
     * @var StringType|NULL
     */
    private $defaultAttr;
    
    /**
     * The value of the "fixed" attribute.
     * @var StringType|NULL
     */
    private $fixedAttr;
    
    /**
     * The value of the "form" attribute.
     * @var FormType|NULL
     */
    private $formAttr;
    
    /**
     * The value of the "name" attribute.
     * @var NCNameType|NULL
     */
    private $nameAttr;
    
    /**
     * The value of the "ref" attribute.
     * @var QNameType|NULL
     */
    private $refAttr;
    
    /**
     * The value of the "type" attribute.
     * @var QNameType|NULL
     */
    private $typeAttr;
    
    /**
     * The value of the "use" attribute.
     * @var UseType|NULL
     */
    private $useAttr;
    
    /**
     * {@inheritDoc}
     */
    public function getElementId(): int
    {
        return ElementId::ELT_ATTRIBUTE;
    }
    
    /**
     * {@inheritDoc}
     */
    public function getLocalName(): string
    {
        return 'attribute';
    }
    
    /**
     * Returns the value of the "default" attribute.
     * 
     * @return  StringType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getDefault(): ?StringType
    {
        return $this->defaultAttr;
    }
    
    /**
     * Sets the value of the "default" attribute.
     * 
     * @param   StringType  $value  The value to set.
     */
    public function setDefault(StringType $value): void
    {
        $this->defaultAttr = $value;
    }
    
    /**
     * Indicates whether the "default" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasDefault(): bool
    {
        return $this->defaultAttr !== NULL;
    }
    
    /**
     * Returns the value of the "fixed" attribute.
     * 
     * @return  StringType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getFixed(): ?StringType
    {
        return $this->fixedAttr;
    }
    
    /**
     * Sets the value of the "fixed" attribute.
     * 
     * @param   StringType  $value  The value to set.
     */
    public function setFixed(StringType $value): void
    {
        $this->fixedAttr = $value;
    }
    
    /**
     * Indicates whether the "fixed" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasFixed(): bool
    {
        return $this->fixedAttr !== NULL;
    }
    
    /**
     * Returns the value of the "form" attribute.
     * 
     * @return  FormType|NULL   The value of the attribute if it has been set, otherwise NULL.
     */
    public function getForm(): ?FormType
    {
        return $this->formAttr;
    }
    
    /**
     * Sets the value of the "form" attribute.
     * 
     * @param   FormType    $value  The value to set.
     */
    public function setForm(FormType $value): void
    {
        $this->formAttr = $value;
    }
    
    /**
     * Indicates whether the "form" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasForm(): bool
    {
        return $this->formAttr !== NULL;
    }
    
    /**
     * Returns the value of the "name" attribute.
     * 
     * @return  NCNameType|NULL The value of the attribute if it has been set, otherwise NULL.
     */
    public function getName(): ?NCNameType
    {
        return $this->nameAttr;
    }
    
    /**
     * Sets the value of the "name" attribute.
     * 
     * @param   NCNameType  $value  The value to set.
     */
    public function setName(NCNameType $value): void
    {
        $this->nameAttr = $value;
    }
    
    /**
     * Indicates whether the "name" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasName(): bool
    {
        return $this->nameAttr !== NULL;
    }
    
    /**
     * Returns the value of the "ref" attribute.
     * 
     * @return  QNameType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getRef(): ?QNameType
    {
        return $this->refAttr;
    }
    
    /**
     * Sets the value of the "ref" attribute.
     * 
     * @param   QNameType   $value  The value to set.
     */
    public function setRef(QNameType $value): void
    {
        $this->refAttr = $value;
    }
    
    /**
     * Indicates whether the "ref" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasRef(): bool
    {
        return $this->refAttr !== NULL;
    }
    
    /**
     * Returns the value of the "type" attribute.
     * 
     * @return  QNameType|NULL  The value of the attribute if it has been set, otherwise NULL.
     */
    public function getType(): ?QNameType
    {
        return $this->typeAttr;
    }
    
    /**
     * Sets the value of the "type" attribute.
     * 
     * @param   QNameType   $value  The value to set.
     */
    public function setType(QNameType $value): void
    {
        $this->typeAttr = $value;
    }
    
    /**
     * Indicates whether the "type" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasType(): bool
    {
        return $this->typeAttr !== NULL;
    }
    
    /**
     * Returns the value of the "use" attribute.
     * 
     * @return  UseType|NULL    The value of the attribute if it has been set, otherwise NULL.
     */
    public function getUse(): ?UseType
    {
        return $this->useAttr;
    }
    
    /**
     * Sets the value of the "use" attribute.
     * 
     * @param   UseType $value  The value to set.
     */
    public function setUse(UseType $value): void
    {
        $this->useAttr = $value;
    }
    
    /**
     * Indicates whether the "use" attribute has been set.
     * 
     * @return  bool    TRUE if the attribute has been set, otherwise FALSE.
     */
    public function hasUse(): bool
    {
        return $this->useAttr !== NULL;
    }
}
