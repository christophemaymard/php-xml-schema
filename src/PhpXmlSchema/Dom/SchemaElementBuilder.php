<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\AnyUriType;
use PhpXmlSchema\Datatype\IDType;
use PhpXmlSchema\Datatype\LanguageType;
use PhpXmlSchema\Datatype\NCNameType;
use PhpXmlSchema\Datatype\NonNegativeIntegerType;
use PhpXmlSchema\Datatype\PositiveIntegerType;
use PhpXmlSchema\Datatype\QNameType;
use PhpXmlSchema\Datatype\StringType;
use PhpXmlSchema\Datatype\TokenType;
use PhpXmlSchema\Exception\InvalidOperationException;
use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Exception\Message;
use PhpXmlSchema\Exception\PhpXmlSchemaExceptionInterface;

/**
 * Represents a builder of "schema" element.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SchemaElementBuilder implements SchemaBuilderInterface
{
    /**
     * The instance of the current element that is being built.
     * @var ElementInterface|NULL
     */
    private $currentElement;
    
    /**
     * The instance of the "schema" element that is being built.
     * @var SchemaElement
     */
    private $schemaElement;
    
    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->buildSchemaElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildAbstractAttribute(string $value)
    {
        if ($this->currentElement instanceof ComplexTypeElement) {
            $this->currentElement->setAbstract($this->parseBoolean($value));
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildAttributeFormDefaultAttribute(string $value)
    {
        if ($this->currentElement instanceof SchemaElement) {
            $this->currentElement->setAttributeFormDefault($this->parseFormChoice($value));
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function bindNamespace(string $prefix, string $namespace)
    {
        if ($this->currentElement !== NULL) {
            $this->currentElement->bindNamespace($prefix, $namespace);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildBaseAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_EXTENSION:
                case ElementId::ELT_COMPLEXCONTENT_RESTRICTION:
                    $this->currentElement->setBase($this->parseQName($value));
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildBlockAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_COMPLEXTYPE:
                    $this->currentElement->setBlock($this->parseDerivationSet($value));
                    break;
                case ElementId::ELT_ELEMENT:
                    $this->currentElement->setBlock($this->parseBlockSet($value));
                    break;
            }
            
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildBlockDefaultAttribute(string $value)
    {
        if ($this->currentElement instanceof SchemaElement) {
            $this->currentElement->setBlockDefault($this->parseBlockSet($value));
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildDefaultAttribute(string $value)
    {
        if ($this->currentElement instanceof AttributeElement) {
            $this->currentElement->setDefault(new StringType($value));
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildElementFormDefaultAttribute(string $value)
    {
        if ($this->currentElement instanceof SchemaElement) {
            $this->currentElement->setElementFormDefault($this->parseFormChoice($value));
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildFinalAttribute(string $value)
    {
        if ($this->currentElement instanceof SimpleTypeElement && 
            $this->currentElement->getParent() instanceof SchemaElement
        ) {
            $this->currentElement->setFinal($this->parseSimpleDerivationSet($value));
        } elseif ($this->currentElement instanceof ComplexTypeElement) {
            $this->currentElement->setFinal($this->parseDerivationSet($value));
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildFinalDefaultAttribute(string $value)
    {
        if ($this->currentElement instanceof SchemaElement) {
            $this->currentElement->setFinalDefault($this->parseFullDerivationSet($value));
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildFixedAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_ATTRIBUTE:
                    $this->currentElement->setFixed(new StringType($value));
                    break;
                case ElementId::ELT_MINEXCLUSIVE:
                case ElementId::ELT_MININCLUSIVE:
                case ElementId::ELT_MAXEXCLUSIVE:
                case ElementId::ELT_MAXINCLUSIVE:
                case ElementId::ELT_TOTALDIGITS:
                case ElementId::ELT_FRACTIONDIGITS:
                case ElementId::ELT_LENGTH:
                case ElementId::ELT_MINLENGTH:
                case ElementId::ELT_MAXLENGTH:
                case ElementId::ELT_WHITESPACE:
                    $this->currentElement->setFixed($this->parseBoolean($value));
                    break;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildFormAttribute(string $value)
    {
        if ($this->currentElement instanceof AttributeElement &&
            !$this->currentElement->getParent() instanceof SchemaElement
        ) {
            $this->currentElement->setForm($this->parseFormChoice($value));
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildIdAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch($this->currentElement->getElementId()) {
                case ElementId::ELT_ATTRIBUTEGROUP:
                case ElementId::ELT_ATTRIBUTE:
                case ElementId::ELT_SIMPLETYPE:
                case ElementId::ELT_SCHEMA:
                case ElementId::ELT_ANNOTATION:
                case ElementId::ELT_IMPORT:
                case ElementId::ELT_INCLUDE:
                case ElementId::ELT_NOTATION:
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_MINEXCLUSIVE:
                case ElementId::ELT_MININCLUSIVE:
                case ElementId::ELT_MAXEXCLUSIVE:
                case ElementId::ELT_MAXINCLUSIVE:
                case ElementId::ELT_TOTALDIGITS:
                case ElementId::ELT_FRACTIONDIGITS:
                case ElementId::ELT_LENGTH:
                case ElementId::ELT_MINLENGTH:
                case ElementId::ELT_MAXLENGTH:
                case ElementId::ELT_ENUMERATION:
                case ElementId::ELT_WHITESPACE:
                case ElementId::ELT_PATTERN:
                case ElementId::ELT_LIST:
                case ElementId::ELT_UNION:
                case ElementId::ELT_ANYATTRIBUTE:
                case ElementId::ELT_COMPLEXTYPE:
                case ElementId::ELT_SIMPLECONTENT:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_EXTENSION:
                case ElementId::ELT_COMPLEXCONTENT:
                case ElementId::ELT_COMPLEXCONTENT_RESTRICTION:
                case ElementId::ELT_GROUP:
                case ElementId::ELT_ALL:
                    $this->currentElement->setId(new IDType($this->collapseWhiteSpace($value)));
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildItemTypeAttribute(string $value)
    {
        if ($this->currentElement instanceof ListElement) {
            $this->currentElement->setItemType($this->parseQName($value));
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMaxOccursAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_ALL:
                    $this->currentElement->setMaxOccurs($this->parseOneNonNegativeIntegerLimit($value));
                    break;
                case ElementId::ELT_GROUP:
                    $this->currentElement->setMaxOccurs($this->parseNonNegativeIntegerLimit($value));
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMemberTypesAttribute(string $value)
    {
        if ($this->currentElement instanceof UnionElement) {
            foreach ($this->parseQNameList($value) as $qname) {
                $this->currentElement->addMemberType($qname);
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMinOccursAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_ALL:
                    $this->currentElement->setMinOccurs($this->parseZeroOrOneNonNegativeInteger($value));
                    break;
                case ElementId::ELT_GROUP:
                    $this->currentElement->setMinOccurs($this->parseNonNegativeInteger($value));
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMixedAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_COMPLEXTYPE:
                case ElementId::ELT_COMPLEXCONTENT:
                    $this->currentElement->setMixed($this->parseBoolean($value));
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildNameAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()){
                case ElementId::ELT_SIMPLETYPE:
                case ElementId::ELT_ATTRIBUTEGROUP:
                    if (!$this->currentElement->getParent() instanceof SchemaElement) {
                        break;
                    }
                case ElementId::ELT_ATTRIBUTE:
                case ElementId::ELT_NOTATION:
                case ElementId::ELT_COMPLEXTYPE:
                    $this->currentElement->setName(
                        new NCNameType($this->collapseWhiteSpace($value))
                    );
            }
            
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildNamespaceAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_IMPORT:
                    $this->currentElement->setNamespace(
                        new AnyUriType($this->collapseWhiteSpace($value))
                    );
                    break;
                case ElementId::ELT_ANYATTRIBUTE:
                    $this->currentElement->setNamespace(
                        $this->parseNamespaceList($value)
                    );
                    break;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildProcessContentsAttribute(string $value)
    {
        if ($this->currentElement instanceof AnyAttributeElement) {
            $this->currentElement->setProcessContents($this->parseProcessingMode($value));
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildPublicAttribute(string $value)
    {
        if ($this->currentElement instanceof NotationElement) {
            $this->currentElement->setPublic(
                new TokenType($this->collapseWhiteSpace($value))
            );
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildRefAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_GROUP:
                    $this->currentElement->setRef($this->parseQName($value));
                    break;
                case ElementId::ELT_ATTRIBUTE:
                case ElementId::ELT_ATTRIBUTEGROUP:
                    if ($this->currentElement->getParent() instanceof AttributeGroupElement) {
                        $this->currentElement->setRef($this->parseQName($value));
                    }
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildSchemaLocationAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch($this->currentElement->getElementId()) {
                case ElementId::ELT_IMPORT:
                case ElementId::ELT_INCLUDE:
                    $this->currentElement->setSchemaLocation(
                        new AnyUriType($this->collapseWhiteSpace($value))
                    );
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildSourceAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            $eid = $this->currentElement->getElementId();
            
            if ($eid == ElementId::ELT_APPINFO || $eid == ElementId::ELT_DOCUMENTATION) {
                $this->currentElement->setSource(
                    new AnyUriType($this->collapseWhiteSpace($value))
                );
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildSystemAttribute(string $value)
    {
        if ($this->currentElement instanceof NotationElement) {
            $this->currentElement->setSystem(
                new AnyUriType($this->collapseWhiteSpace($value))
            );
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildTargetNamespaceAttribute(string $value)
    {
        if ($this->currentElement instanceof SchemaElement) {
            $this->currentElement->setTargetNamespace(
                new AnyUriType($this->collapseWhiteSpace($value))
            );
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildTypeAttribute(string $value)
    {
        if ($this->currentElement instanceof AttributeElement) {
            $this->currentElement->setType($this->parseQName($value));
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildUseAttribute(string $value)
    {
        if ($this->currentElement instanceof AttributeElement && 
            !$this->currentElement->getParent() instanceof SchemaElement
        ) {
            if (NULL === $attr = $this->parseUse($value)) {
                throw new InvalidValueException(Message::invalidAttributeValue(
                    $value, 
                    'use', 
                    '', 
                    [ 'optional', 'prohibited', 'required', ]
                ));
            }
            
            $this->currentElement->setUse($attr);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildValueAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_MINEXCLUSIVE:
                case ElementId::ELT_MININCLUSIVE:
                case ElementId::ELT_MAXEXCLUSIVE:
                case ElementId::ELT_MAXINCLUSIVE:
                case ElementId::ELT_ENUMERATION:
                    $this->currentElement->setValue($value);
                    break;
                case ElementId::ELT_TOTALDIGITS:
                    $this->currentElement->setValue($this->parsePositiveInteger($value));
                    break;
                case ElementId::ELT_FRACTIONDIGITS:
                case ElementId::ELT_LENGTH:
                case ElementId::ELT_MINLENGTH:
                case ElementId::ELT_MAXLENGTH:
                    $this->currentElement->setValue($this->parseNonNegativeInteger($value));
                    break;
                case ElementId::ELT_WHITESPACE:
                    $this->currentElement->setValue($this->parseWhiteSpace($value));
                    break;
                case ElementId::ELT_PATTERN:
                    $this->currentElement->setValue(new StringType($value));
                    break;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildVersionAttribute(string $value)
    {
        if ($this->currentElement instanceof SchemaElement) {
            $this->currentElement->setVersion(
                new TokenType($this->collapseWhiteSpace($value))
            );
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildLangAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            $eid = $this->currentElement->getElementId();
            
            if ($eid == ElementId::ELT_SCHEMA || $eid == ElementId::ELT_DOCUMENTATION) {
                $tags = \explode('-', $this->collapseWhiteSpace($value));

                $this->currentElement->setLang(
                    new LanguageType(\array_shift($tags), $tags)
                );
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildAllElement()
    {
        if ($this->currentElement instanceof ComplexContentRestrictionElement) {
            $elt = new AllElement();
            $this->currentElement->setTypeDefinitionParticleElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildAnnotationElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_ATTRIBUTEGROUP:
                case ElementId::ELT_ATTRIBUTE:
                case ElementId::ELT_SIMPLETYPE:
                case ElementId::ELT_IMPORT:
                case ElementId::ELT_INCLUDE:
                case ElementId::ELT_NOTATION:
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_MINEXCLUSIVE:
                case ElementId::ELT_MININCLUSIVE:
                case ElementId::ELT_MAXEXCLUSIVE:
                case ElementId::ELT_MAXINCLUSIVE:
                case ElementId::ELT_TOTALDIGITS:
                case ElementId::ELT_FRACTIONDIGITS:
                case ElementId::ELT_LENGTH:
                case ElementId::ELT_MINLENGTH:
                case ElementId::ELT_MAXLENGTH:
                case ElementId::ELT_ENUMERATION:
                case ElementId::ELT_WHITESPACE:
                case ElementId::ELT_PATTERN:
                case ElementId::ELT_LIST:
                case ElementId::ELT_UNION:
                case ElementId::ELT_ANYATTRIBUTE:
                case ElementId::ELT_COMPLEXTYPE:
                case ElementId::ELT_SIMPLECONTENT:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_EXTENSION:
                case ElementId::ELT_COMPLEXCONTENT:
                case ElementId::ELT_COMPLEXCONTENT_RESTRICTION:
                case ElementId::ELT_GROUP:
                case ElementId::ELT_ALL:
                    $elt = new AnnotationElement();
                    $this->currentElement->setAnnotationElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildCompositionAnnotationElement()
    {
        if ($this->currentElement instanceof SchemaElement) {
            $elt = new AnnotationElement();
            $this->currentElement->addCompositionAnnotationElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildDefinitionAnnotationElement()
    {
        if ($this->currentElement instanceof SchemaElement) {
            $elt = new AnnotationElement();
            $this->currentElement->addDefinitionAnnotationElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildAnyAttributeElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_ATTRIBUTEGROUP:
                    if (!$this->currentElement->getParent() instanceof SchemaElement) {
                        break;
                    }
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_EXTENSION:
                    $elt = new AnyAttributeElement();
                    $this->currentElement->setAnyAttributeElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildAppInfoElement()
    {
        if ($this->currentElement instanceof AnnotationElement) {
            $elt = new AppInfoElement();
            $this->currentElement->addAppInfoElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildAttributeElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_ATTRIBUTEGROUP:
                    if (!$this->currentElement->getParent() instanceof SchemaElement) {
                        break;
                    }
                case ElementId::ELT_SCHEMA:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_EXTENSION:
                    $elt = new AttributeElement();
                    $this->currentElement->addAttributeElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildAttributeGroupElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_ATTRIBUTEGROUP:
                    if (!$this->currentElement->getParent() instanceof SchemaElement) {
                        break;
                    }
                case ElementId::ELT_SCHEMA:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_EXTENSION:
                    $elt = new AttributeGroupElement();
                    $this->currentElement->addAttributeGroupElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildComplexContentElement()
    {
        if ($this->currentElement instanceof ComplexTypeElement) {
            $elt = new ComplexContentElement();
            $this->currentElement->setContentElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildComplexTypeElement()
    {
        if ($this->currentElement instanceof SchemaElement) {
            $elt = new ComplexTypeElement();
            $this->currentElement->addComplexTypeElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildDocumentationElement()
    {
        if ($this->currentElement instanceof AnnotationElement) {
            $elt = new DocumentationElement();
            $this->currentElement->addDocumentationElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildElementElement()
    {
        if ($this->currentElement instanceof AllElement) {
            $elt = new ElementElement();
            $this->currentElement->addElementElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildEnumerationElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                    $elt = new EnumerationElement();
                    $this->currentElement->addEnumerationElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildExtensionElement()
    {
        if ($this->currentElement instanceof SimpleContentElement) {
            $elt = new SimpleContentExtensionElement();
            $this->currentElement->setDerivationElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildFractionDigitsElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                    $elt = new FractionDigitsElement();
                    $this->currentElement->addFractionDigitsElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildGroupElement()
    {
        if ($this->currentElement instanceof ComplexContentRestrictionElement) {
            $elt = new GroupElement();
            $this->currentElement->setTypeDefinitionParticleElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildImportElement()
    {
        if ($this->currentElement instanceof SchemaElement) {
            $elt = new ImportElement();
            $this->currentElement->addImportElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildIncludeElement()
    {
        if ($this->currentElement instanceof SchemaElement) {
            $elt = new IncludeElement();
            $this->currentElement->addIncludeElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildLengthElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                    $elt = new LengthElement();
                    $this->currentElement->addLengthElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildListElement()
    {
        if ($this->currentElement instanceof SimpleTypeElement) {
            $elt = new ListElement();
            $this->currentElement->setDerivationElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMaxExclusiveElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                    $elt = new MaxExclusiveElement();
                    $this->currentElement->addMaxExclusiveElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMaxInclusiveElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                    $elt = new MaxInclusiveElement();
                    $this->currentElement->addMaxInclusiveElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMaxLengthElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                    $elt = new MaxLengthElement();
                    $this->currentElement->addMaxLengthElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMinExclusiveElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                    $elt = new MinExclusiveElement();
                    $this->currentElement->addMinExclusiveElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMinInclusiveElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                    $elt = new MinInclusiveElement();
                    $this->currentElement->addMinInclusiveElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMinLengthElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                    $elt = new MinLengthElement();
                    $this->currentElement->addMinLengthElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildNotationElement()
    {
        if ($this->currentElement instanceof SchemaElement) {
            $elt = new NotationElement();
            $this->currentElement->addNotationElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildPatternElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                    $elt = new PatternElement();
                    $this->currentElement->addPatternElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildRestrictionElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE:
                    $elt = new SimpleTypeRestrictionElement();
                    $this->currentElement->setDerivationElement($elt);
                    $this->currentElement = $elt;
                    break;
                case ElementId::ELT_SIMPLECONTENT:
                    $elt = new SimpleContentRestrictionElement();
                    $this->currentElement->setDerivationElement($elt);
                    $this->currentElement = $elt;
                    break;
                case ElementId::ELT_COMPLEXCONTENT:
                    $elt = new ComplexContentRestrictionElement();
                    $this->currentElement->setDerivationElement($elt);
                    $this->currentElement = $elt;
                    break;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildSimpleContentElement()
    {
        if ($this->currentElement instanceof ComplexTypeElement) {
            $elt = new SimpleContentElement();
            $this->currentElement->setContentElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildSimpleTypeElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_ATTRIBUTE:
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_LIST:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                    $elt = new SimpleTypeElement();
                    $this->currentElement->setSimpleTypeElement($elt);
                    $this->currentElement = $elt;
                    break;
                case ElementId::ELT_UNION:
                case ElementId::ELT_SCHEMA:
                    $elt = new SimpleTypeElement();
                    $this->currentElement->addSimpleTypeElement($elt);
                    $this->currentElement = $elt;
                    break;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildTotalDigitsElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                    $elt = new TotalDigitsElement();
                    $this->currentElement->addTotalDigitsElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildUnionElement()
    {
        if ($this->currentElement instanceof SimpleTypeElement) {
            $elt = new UnionElement();
            $this->currentElement->setDerivationElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildWhiteSpaceElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE_RESTRICTION:
                case ElementId::ELT_SIMPLECONTENT_RESTRICTION:
                    $elt = new WhiteSpaceElement();
                    $this->currentElement->addWhiteSpaceElement($elt);
                    $this->currentElement = $elt;
            }
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildSchemaElement()
    {
        $this->schemaElement = $this->currentElement = new SchemaElement();
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildLeafElementContent(string $content)
    {
        if ($this->currentElement instanceof LeafElementInterface) {
            $this->currentElement->setContent($content);
        }
    }
    
    /**
     * Returns the instance of the "schema" element that has been built.
     * 
     * @return  SchemaElement
     */
    public function getSchema():SchemaElement
    {
        return $this->schemaElement;
    }
    
    /**
     * {@inheritDoc}
     */
    public function endElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            $this->currentElement = $this->currentElement->getParent();
        }
    }
    
    /**
     * Parses the specified value in "blockSet" DerivationType value.
     * 
     * If the value is not '#all' then white space characters (i.e. TAB, LF, 
     * CR and SPACE) are collapsed before parsing.
     * 
     * @param   string  $value  The value to parse.
     * @return  DerivationType
     * 
     * @throws  InvalidValueException   When the value is an invalid blockSet type.
     */
    private function parseBlockSet(string $value):DerivationType
    {
        $rest = $ext = $sub = FALSE;
        
        if ($value == '#all') {
            $rest = $ext = $sub = TRUE;
        } else {
            foreach (\array_filter(\explode(' ', $this->collapseWhiteSpace($value)), 'strlen') as $flag) {
                if ($flag == 'restriction') {
                    $rest = TRUE;
                } elseif ($flag == 'extension') {
                    $ext = TRUE;
                } elseif ($flag == 'substitution') {
                    $sub = TRUE;
                } else {
                    throw new InvalidValueException(\sprintf(
                        '"%s" is an invalid blockSet type, expected "#all" or '.
                        'a list of "extension", "restriction" and/or '.
                        '"substitution".', 
                        $value
                    ));
                }
            }
        }
        
        return new DerivationType($rest, $ext, $sub, FALSE, FALSE);
    }
    
    /**
     * Parses the specified value in "fullDerivationSet" DerivationType value.
     * 
     * If the value is not '#all' then white space characters (i.e. TAB, LF, 
     * CR and SPACE) are collapsed before parsing.
     * 
     * @param   string  $value  The value to parse.
     * @return  DerivationType
     * 
     * @throws  InvalidValueException   When the value is an invalid fullDerivationSet type.
     */
    private function parseFullDerivationSet(string $value):DerivationType
    {
        $ext = $rest = $list = $union = FALSE;
        
        if ($value == '#all') {
            $ext = $rest = $list = $union = TRUE;
        } else {
            foreach (\array_filter(\explode(' ', $this->collapseWhiteSpace($value)), 'strlen') as $flag) {
                if ($flag == 'extension') {
                    $ext = TRUE;
                } elseif ($flag == 'restriction') {
                    $rest = TRUE;
                } elseif ($flag == 'list') {
                    $list = TRUE;
                } elseif ($flag == 'union') {
                    $union = TRUE;
                } else {
                    throw new InvalidValueException(\sprintf(
                        '"%s" is an invalid fullDerivationSet type, '.
                        'expected "#all" or a list of "extension", '.
                        '"restriction", "list" and/or "union".', 
                        $value
                    ));
                }
            }
        }
        
        return new DerivationType($rest, $ext, FALSE, $list, $union);
    }
    
    /**
     * Parses the specified value in "formChoice" FormType value.
     * 
     * @param   string  $value  The value to parse.
     * @return  FormType
     * 
     * @throws  InvalidValueException   When the value is an invalid formChoice type.
     */
    private function parseFormChoice(string $value):FormType
    {
        if ($value == 'qualified') {
            $ft = FormType::createQualified();
        } elseif ($value == 'unqualified') {
            $ft = FormType::createUnqualified();
        } else {
            throw new InvalidValueException(\sprintf(
                '"%s" is an invalid formChoice type, expected "qualified" or "unqualified".', 
                $value
            ));
        }
        
        return $ft;
    }
    
    /**
     * Parses the specified value in QNameType values.
     * 
     * @param   string  $value  The value to parse.
     * @return  QNameType[] An indexed array of QName instances.
     */
    private function parseQNameList(string $value):array
    {
        $qnames = [];
        
        foreach (\explode(' ', $this->collapseWhiteSpace($value)) as $qnameValue) {
            $qnames[] = $this->parseQName($qnameValue);
        }
        
        return $qnames;
    }
    
    /**
     * Parses the specified value in QNameType value.
     * 
     * @param   string  $value  The value to parse.
     * @return  QNameType   A created instance of QNameType.
     * 
     * @throws  InvalidOperationException   When the prefix is not bound to a namespace.
     */
    private function parseQName(string $value):QNameType
    {
        $parts = \explode(':', $this->collapseWhiteSpace($value), 2);
        
        if (\count($parts) == 1) {
            $namespace = $this->currentElement->lookupNamespace('');
            $localPart = new NCNameType($parts[0]);
        } else {
            $prefix = new NCNameType($parts[0]);
            $localPart = new NCNameType($parts[1]);
            
            if (NULL === $namespace = $this->currentElement->lookupNamespace($prefix->getNCName())) {
                throw new InvalidOperationException(\sprintf(
                    'The "%s" prefix is not bound to a namespace.', 
                    $parts[0]
                ));
            }
        }
        
        return isset($namespace) ? 
            new QNameType($localPart, new AnyUriType($namespace)):
            new QNameType($localPart);
    }
    
    /**
     * Parses the specified value in boolean value.
     * 
     * @param   string  $value  The value to parse.
     * @return  bool
     * 
     * @throws  InvalidValueException   When the value is an invalid boolean datatype.
     */
    private function parseBoolean(string $value):bool
    {
        $cvalue = $this->collapseWhiteSpace($value);
        
        if ($cvalue === 'true' || $cvalue === '1') {
            $bool = TRUE;
        } elseif ($cvalue === 'false' || $cvalue === '0') {
            $bool = FALSE;
        } else {
            throw new InvalidValueException(\sprintf('"%s" is an invalid boolean datatype.', $value));
        }
        
        return $bool;
    }
    
    /**
     * Parses the specified value in NonNegativeIntegerLimitType value.
     * 
     * @param   string  $value  The value to parse.
     * @return  NonNegativeIntegerLimitType
     * 
     * @throws  InvalidValueException   When the value is an invalid non-negative integer limit type.
     */
    private function parseNonNegativeIntegerLimit(string $value):NonNegativeIntegerLimitType
    {
        try {
            if ($value == 'unbounded') {
                $limit = new NonNegativeIntegerLimitType();
            } else {
                $nni = $this->parseNonNegativeInteger($value);
                $limit = new NonNegativeIntegerLimitType($nni);
            }
       } catch (\Throwable $ex) {
            throw new InvalidValueException(\sprintf(
                '"%s" is an invalid non-negative integer limit type.', 
                $value
            ));
        }
        
        return $limit;
    }
    
    /**
     * Parses the specified value in NonNegativeIntegerLimitType value (only 
     * "1" is accepted). 
     * 
     * @param   string  $value  The value to parse.
     * @return  NonNegativeIntegerLimitType
     * 
     * @throws  InvalidValueException   When the value is not the "1" non-negative integer.
     */
    private function parseOneNonNegativeIntegerLimit(string $value):NonNegativeIntegerLimitType
    {
        try {
            $nni = $this->parseNonNegativeInteger($value);
            
            if ($nni->getNonNegativeInteger() != 1) {
                throw new InvalidValueException();
            }
            
            $limit = new NonNegativeIntegerLimitType($nni);
       } catch (\Throwable $ex) {
            throw new InvalidValueException(\sprintf(
                '"%s" is invalid, expected "1".', 
                $value
            ));
        }
        
        return $limit;
    }
    
    /**
     * Parses the specified value in NonNegativeIntegerType value (only "0" 
     * or "1" is accepted). 
     * 
     * @param   string  $value  The value to parse.
     * @return  NonNegativeIntegerType
     * 
     * @throws  InvalidValueException   When the value is not "0" or "1" non-negative integer.
     */
    private function parseZeroOrOneNonNegativeInteger(string $value):NonNegativeIntegerType
    {
        try {
            $nni = $this->parseNonNegativeInteger($value);
            
            if ($nni->getNonNegativeInteger() != 0 && $nni->getNonNegativeInteger() != 1) {
                throw new InvalidValueException();
            }
       } catch (\Throwable $ex) {
            throw new InvalidValueException(\sprintf(
                '"%s" is invalid, expected "0" or "1".', 
                $value
            ));
        }
        
        return new NonNegativeIntegerType($nni->getNonNegativeInteger());
    }
    
    /**
     * Parses the specified value in PositiveIntegerType value.
     * 
     * @param   string  $value  The value to parse.
     * @return  PositiveIntegerType
     * 
     * @throws  InvalidValueException   When the value is an invalid positive integer datatype.
     */
    private function parsePositiveInteger(string $value):PositiveIntegerType
    {
        $cvalue = $this->collapseWhiteSpace($value);
        
        if (!\preg_match('`^(\\+)?([1-9][0-9]*)$`', $cvalue, $matches)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid positiveInteger datatype.', $value));
        }
        
        return new PositiveIntegerType(\gmp_init($matches[2], 10));
    }
    
    /**
     * Parses the specified value in NonNegativeIntegerType value.
     * 
     * @param   string  $value  The value to parse.
     * @return  NonNegativeIntegerType
     * 
     * @throws  InvalidValueException   When the value is an invalid non-negative integer datatype.
     */
    private function parseNonNegativeInteger(string $value):NonNegativeIntegerType
    {
        $cvalue = $this->collapseWhiteSpace($value);
        
        if (!\preg_match('`^(\\+)?([0-9]+)$`', $cvalue, $matches)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid nonNegativeInteger datatype.', $value));
        }
        
        // \gmp_init() removes leading zeroes when the decimal base (10) is 
        // provided.
        return new NonNegativeIntegerType(\gmp_init($matches[2], 10));
    }
    
    /**
     * Parses the specified value in WhiteSpaceType value.
     * 
     * @param   string  $value  The value to parse.
     * @return  WhiteSpaceType
     * 
     * @throws  InvalidValueException   When the value is an invalid white space type.
     */
    private function parseWhiteSpace(string $value):WhiteSpaceType
    {
        if ($value == 'collapse') {
            $ws = WhiteSpaceType::createCollapse();
        } elseif ($value == 'preserve') {
            $ws = WhiteSpaceType::createPreserve();
        } elseif ($value == 'replace') {
            $ws = WhiteSpaceType::createReplace();
        } else {
            throw new InvalidValueException(\sprintf('"%s" is an invalid white space type.', $value));
        }
        
        return $ws;
    }
    
    /**
     * Parses the specified value in "simpleDerivationSet" DerivationType 
     * value.
     * 
     * If the value is not '#all' then white space characters (i.e. TAB, LF, 
     * CR and SPACE) are collapsed before parsing.
     * 
     * @param   string  $value  The value to parse.
     * @return  DerivationType
     * 
     * @throws  InvalidValueException   When the value is an invalid simpleDerivationSet type.
     */
    private function parseSimpleDerivationSet(string $value):DerivationType
    {
        $list = $union = $res = FALSE;
        
        if ($value == '#all') {
            $list = $union = $res = TRUE;
        } else {
            foreach (\array_filter(\explode(' ', $this->collapseWhiteSpace($value)), 'strlen') as $flag) {
                if ($flag == 'list') {
                    $list = TRUE;
                } elseif ($flag == 'union') {
                    $union = TRUE;
                } elseif ($flag == 'restriction') {
                    $res = TRUE;
                } else {
                    throw new InvalidValueException(\sprintf(
                        '"%s" is an invalid simpleDerivationSet type, '.
                        'expected "#all" or a list of "list", "union" '.
                        'and/or "restriction".', 
                        $value
                    ));
                }
            }
        }
        
        return new DerivationType($res, FALSE, FALSE, $list, $union);
    }
    
    /**
     * Parses the specified value in UseType value.
     * 
     * @param   string  $value  The value to parse.
     * @return  UseType|NULL    A created instance of UseType if the value is valid, otherwise NULL.
     */
    private function parseUse(string $value)
    {
        $use = NULL;
        
        if ($value == 'optional') {
            $use = UseType::createOptional();
        } elseif ($value == 'prohibited') {
            $use = UseType::createProhibited();
        } elseif ($value == 'required') {
            $use = UseType::createRequired();
        }
        
        return $use;
    }
    
    /**
     * Parses the specified value in "namespaceList" NamespaceListType value.
     * 
     * If the value is not '##any' neither '##other' then white space 
     * characters (i.e. TAB, LF, CR and SPACE) are collapsed before parsing.
     * 
     * @param   string  $value  The value to parse.
     * @return  NamespaceListType   A created instance of NamespaceListType.
     * 
     * @throws  InvalidValueException   When the value is an invalid namespace list.
     */
    private function parseNamespaceList(string $value):NamespaceListType
    {
        $nsList = NULL;
        
        if ($value == '##any') {
            $nsList = NamespaceListType::createAny();
        } elseif ($value == '##other') {
            $nsList = NamespaceListType::createOther();
        } else {
            $targetNs = $local = FALSE;
            $uris = [];
            
            foreach (\array_filter(\explode(' ', $this->collapseWhiteSpace($value)), 'strlen') as $v) {
                try {
                    if ($v == '##targetNamespace') {
                        $targetNs = TRUE;
                    } elseif ($v == '##local') {
                        $local = TRUE;
                    } elseif ($v == '##any' || $v == '##other') {
                        throw new InvalidValueException();
                    } else {
                        $uris[] = new AnyUriType($v);
                    }
                } catch (PhpXmlSchemaExceptionInterface $ex) {
                    throw new InvalidValueException(
                        \sprintf('"%s" is an invalid namespace list.', $value)
                    );
                }
            }
            
            $nsList = NamespaceListType::create($targetNs, $local, $uris);
        }
        
        return $nsList;
    }
    
    /**
     * Parses the specified value in ProcessingModeType value.
     * 
     * @param   string  $value  The value to parse.
     * @return  ProcessingModeType
     * 
     * @throws  InvalidValueException   When the value is an invalid mode of content processing.
     */
    private function parseProcessingMode(string $value):ProcessingModeType
    {
        if ($value == 'lax') {
            $pm = ProcessingModeType::createLax();
        } elseif ($value == 'skip') {
            $pm = ProcessingModeType::createSkip();
        } elseif ($value == 'strict') {
            $pm = ProcessingModeType::createStrict();
        } else {
            throw new InvalidValueException(\sprintf(
                '"%s" is an invalid mode of content processing, expected '.
                '"lax", "skip" or "strict".', 
                $value
            ));
        }
        
        return $pm;
    }
    
    /**
     * Parses the specified value in "derivationSet" DerivationType value.
     * 
     * If the value is not '#all' then white space characters (i.e. TAB, LF, 
     * CR and SPACE) are collapsed before parsing.
     * 
     * @param   string  $value  The value to parse.
     * @return  DerivationType
     * 
     * @throws  InvalidValueException   When the value is an invalid derivationSet type.
     */
    private function parseDerivationSet(string $value):DerivationType
    {
        $ext = $res = FALSE;
        
        if ($value == '#all') {
            $ext = $res = TRUE;
        } else {
            foreach (\array_filter(\explode(' ', $this->collapseWhiteSpace($value)), 'strlen') as $flag) {
                if ($flag == 'extension') {
                    $ext = TRUE;
                } elseif ($flag == 'restriction') {
                    $res = TRUE;
                } else {
                    throw new InvalidValueException(\sprintf(
                        '"%s" is an invalid derivationSet type, expected "#all" '.
                        'or a list of "extension" and/or "restriction".', 
                        $value
                    ));
                }
            }
        }
        
        return new DerivationType($res, $ext, FALSE, FALSE, FALSE);
    }
    
    /**
     * Replaces all the occurrences of TAB, LINE FEED and CARRIAGE RETURN 
     * with SPACE, collapses to a single SPACE contiguous sequences of 
     * SPACEs and removes leading and trailing SPACEs.
     * 
     * @param   string  $value  The value to process.
     * @return  string
     */
    private function collapseWhiteSpace(string $value):string
    {
        return \implode(
            ' ', 
            \array_filter(
                \explode(' ', $this->replaceWhiteSpace($value)),
                'strlen'
            )
        );
    }
    
    /**
     * Replaces all the occurrences of TAB, LINE FEED and CARRIAGE RETURN 
     * with SPACE.
     * 
     * @param   string  $value  The value to process.
     * @return  string
     */
    private function replaceWhiteSpace(string $value):string
    {
        return \str_replace(
            [ "\t", "\n", "\r", ],
            ' ',
            $value
        );
    }
}
