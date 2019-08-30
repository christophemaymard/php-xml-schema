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
    public function buildAttributeFormDefaultAttribute(string $value)
    {
        if ($this->currentElement instanceof SchemaElement) {
            if (NULL === $attr = $this->parseFormType($value)) {
                throw new InvalidValueException(Message::invalidAttributeValue(
                    $value, 
                    'attributeFormDefault', 
                    '', 
                    [ 'qualified', 'unqualified', ]
                ));
            }
            
            $this->currentElement->setAttributeFormDefault($attr);
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
        if ($this->currentElement instanceof SimpleTypeRestrictionElement) {
            $this->currentElement->setBase($this->parseQName($value));
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildBlockDefaultAttribute(string $value)
    {
        if ($this->currentElement instanceof SchemaElement) {
            if (NULL === $attr = $this->parseBlockSetValue($value)) {
                throw new InvalidValueException(Message::invalidAttributeValue(
                    $value, 
                    'blockDefault', 
                    '', 
                    [ '#all', 'List of (extension | restriction | substitution)', ]
                ));
            }
            
            $this->currentElement->setBlockDefault($attr);
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
            if (NULL === $attr = $this->parseFormType($value)) {
                throw new InvalidValueException(Message::invalidAttributeValue(
                    $value, 
                    'elementFormDefault', 
                    '', 
                    [ 'qualified', 'unqualified', ]
                ));
            }
            
            $this->currentElement->setElementFormDefault($attr);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildFinalDefaultAttribute(string $value)
    {
        if ($this->currentElement instanceof SchemaElement) {
            if (NULL === $attr = $this->parseFullDerivationSetValue($value)) {
                throw new InvalidValueException(Message::invalidAttributeValue(
                    $value, 
                    'finalDefault', 
                    '', 
                    [ '#all', 'List of (extension | restriction | list | union)', ]
                ));
            }
            
            $this->currentElement->setFinalDefault($attr);
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
    public function buildIdAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE:
                    if ($this->currentElement->getParent() instanceof SchemaElement) {
                        break;
                    }
                case ElementId::ELT_SCHEMA:
                case ElementId::ELT_ANNOTATION:
                case ElementId::ELT_IMPORT:
                case ElementId::ELT_INCLUDE:
                case ElementId::ELT_NOTATION:
                case ElementId::ELT_ATTRIBUTE:
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
    public function buildNameAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()){
                case ElementId::ELT_NOTATION:
                case ElementId::ELT_ATTRIBUTE:
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
        if ($this->currentElement instanceof ImportElement) {
            $this->currentElement->setNamespace(
                new AnyUriType($this->collapseWhiteSpace($value))
            );
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
    public function buildAnnotationElement()
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch ($this->currentElement->getElementId()) {
                case ElementId::ELT_SIMPLETYPE:
                    if ($this->currentElement->getParent() instanceof SchemaElement) {
                        break;
                    }
                case ElementId::ELT_IMPORT:
                case ElementId::ELT_INCLUDE:
                case ElementId::ELT_NOTATION:
                case ElementId::ELT_ATTRIBUTE:
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
        if ($this->currentElement instanceof SchemaElement) {
            $elt = new AttributeElement();
            $this->currentElement->addAttributeElement($elt);
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
    public function buildEnumerationElement()
    {
        if ($this->currentElement instanceof SimpleTypeRestrictionElement) {
            $elt = new EnumerationElement();
            $this->currentElement->addEnumerationElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildFractionDigitsElement()
    {
        if ($this->currentElement instanceof SimpleTypeRestrictionElement) {
            $elt = new FractionDigitsElement();
            $this->currentElement->addFractionDigitsElement($elt);
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
        if ($this->currentElement instanceof SimpleTypeRestrictionElement) {
            $elt = new LengthElement();
            $this->currentElement->addLengthElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildListElement()
    {
        if ($this->currentElement instanceof SimpleTypeElement && 
            !$this->currentElement->getParent() instanceof SchemaElement
        ) {
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
        if ($this->currentElement instanceof SimpleTypeRestrictionElement) {
            $elt = new MaxExclusiveElement();
            $this->currentElement->addMaxExclusiveElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMaxInclusiveElement()
    {
        if ($this->currentElement instanceof SimpleTypeRestrictionElement) {
            $elt = new MaxInclusiveElement();
            $this->currentElement->addMaxInclusiveElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMaxLengthElement()
    {
        if ($this->currentElement instanceof SimpleTypeRestrictionElement) {
            $elt = new MaxLengthElement();
            $this->currentElement->addMaxLengthElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMinExclusiveElement()
    {
        if ($this->currentElement instanceof SimpleTypeRestrictionElement) {
            $elt = new MinExclusiveElement();
            $this->currentElement->addMinExclusiveElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMinInclusiveElement()
    {
        if ($this->currentElement instanceof SimpleTypeRestrictionElement) {
            $elt = new MinInclusiveElement();
            $this->currentElement->addMinInclusiveElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildMinLengthElement()
    {
        if ($this->currentElement instanceof SimpleTypeRestrictionElement) {
            $elt = new MinLengthElement();
            $this->currentElement->addMinLengthElement($elt);
            $this->currentElement = $elt;
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
        if ($this->currentElement instanceof SimpleTypeRestrictionElement) {
            $elt = new PatternElement();
            $this->currentElement->addPatternElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildRestrictionElement()
    {
        if ($this->currentElement instanceof SimpleTypeElement && 
            !$this->currentElement->getParent() instanceof SchemaElement
        ) {
            $elt = new SimpleTypeRestrictionElement();
            $this->currentElement->setDerivationElement($elt);
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
        if ($this->currentElement instanceof SimpleTypeRestrictionElement) {
            $elt = new TotalDigitsElement();
            $this->currentElement->addTotalDigitsElement($elt);
            $this->currentElement = $elt;
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function buildUnionElement()
    {
        if ($this->currentElement instanceof SimpleTypeElement && 
            !$this->currentElement->getParent() instanceof SchemaElement
        ) {
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
        if ($this->currentElement instanceof SimpleTypeRestrictionElement) {
            $elt = new WhiteSpaceElement();
            $this->currentElement->addWhiteSpaceElement($elt);
            $this->currentElement = $elt;
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
     * @return  DerivationType|NULL A created instance of DerivationType if the value is valid, otherwise NULL.
     */
    private function parseBlockSetValue(string $value)
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
                    return NULL;
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
     * @return  DerivationType|NULL A created instance of DerivationType if the value is valid, otherwise NULL.
     */
    private function parseFullDerivationSetValue(string $value)
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
                    return NULL;
                }
            }
        }
        
        return new DerivationType($rest, $ext, FALSE, $list, $union);
    }
    
    /**
     * Parses the specified value in FormType value.
     * 
     * @param   string  $value  The value to parse.
     * @return  FormType|NULL   A created instance of FormType if the value is valid, otherwise NULL.
     */
    private function parseFormType(string $value)
    {
        $ft = NULL;
        
        if ($value == 'qualified') {
            $ft = FormType::createQualified();
        } elseif ($value == 'unqualified') {
            $ft = FormType::createUnqualified();
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
            throw new InvalidValueException(\sprintf('"%s" is an invalid positive integer.', $value));
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
            throw new InvalidValueException(\sprintf('"%s" is an invalid non-negative integer.', $value));
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
