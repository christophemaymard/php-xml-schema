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
use PhpXmlSchema\Datatype\TokenType;
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
    public function buildIdAttribute(string $value)
    {
        if ($this->currentElement instanceof ElementInterface) {
            switch($this->currentElement->getElementId()) {
                case ElementId::ELT_SCHEMA:
                case ElementId::ELT_ANNOTATION:
                    $this->currentElement->setId(new IDType($this->collapseWhiteSpace($value)));
            }
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
        if ($this->currentElement instanceof SchemaElement) {
            $tags = \explode('-', $this->collapseWhiteSpace($value));
            
            $this->currentElement->setLang(
                new LanguageType(\array_shift($tags), $tags)
            );
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
    public function buildSchemaElement()
    {
        $this->schemaElement = $this->currentElement = new SchemaElement();
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
     * Before parsing the value, the white space characters (i.e. TAB, LF, CR 
     * and SPACE) are collapsed.
     * 
     * @param   string  $value  The value to parse.
     * @return  DerivationType|NULL A created instance of DerivationType if the value is valid, otherwise NULL.
     */
    private function parseBlockSetValue(string $value)
    {
        $cvalue = $this->collapseWhiteSpace($value);
        $rest = $ext = $sub = FALSE;
        
        if ($cvalue == '#all') {
            $rest = $ext = $sub = TRUE;
        } else {
            foreach (\array_filter(\explode(' ', $cvalue), 'strlen') as $flag) {
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
     * Before parsing the value, the white space characters (i.e. TAB, LF, CR 
     * and SPACE) are collapsed.
     * 
     * @param   string  $value  The value to parse.
     * @return  DerivationType|NULL A created instance of DerivationType if the value is valid, otherwise NULL.
     */
    private function parseFullDerivationSetValue(string $value)
    {
        $cvalue = $this->collapseWhiteSpace($value);
        $ext = $rest = $list = $union = FALSE;
        
        if ($cvalue == '#all') {
            $ext = $rest = $list = $union = TRUE;
        } else {
            foreach (\array_filter(\explode(' ', $cvalue), 'strlen') as $flag) {
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
