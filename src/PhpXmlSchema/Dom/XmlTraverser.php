<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\XmlNamespace;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents a traverser of XML document.
 * 
 * It supports:
 * - comment node
 * - element node
 * - attribute node
 * - text node
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class XmlTraverser
{
    /**
     * @var \DOMDocument
     */
    private $doc;
    
    /**
     * @var \DOMXPath
     */
    private $xpath;
    
    /**
     * The instance of the node where the cursor is positioned.
     * @var \DOMNode
     */
    private $currentNode;
    
    /**
     * Constructor.
     * 
     * Once the XML source is loaded, the cursor is positioned on the first  
     * child node of the document.
     * 
     * @param   string  $src    The XML source to load.
     */
    public function __construct(string $src)
    {
        $this->loadSource($src);
    }
    
    /**
     * Loads the specified XML source and moves the cursor on the first child 
     * node of the document.
     * 
     * @param   string  $src    The XML source to load.
     * 
     * @throws  InvalidValueException   When the source is an invalid XML.
     */
    private function loadSource(string $src)
    {
        $this->doc = new \DOMDocument();
        $this->doc->formatOutput = FALSE;
        $this->doc->preserveWhiteSpace = TRUE;
        
        if (@$this->doc->loadXML($src) === FALSE) {
            throw new InvalidValueException('The source is an invalid XML.');
        }
        
        $this->xpath = new \DOMXPath($this->doc);
        $this->currentNode = $this->doc->firstChild;
    }
    
    /**
     * Returns the local name of the current node.
     * 
     * @return  string
     */
    public function getLocalName():string
    {
        return (string)$this->currentNode->localName;
    }
    
    /**
     * Returns the namespace URI of the current node.
     * 
     * @return  string
     */
    public function getNamespace():string
    {
        return (string)$this->currentNode->namespaceURI;
    }
    
    /**
     * Returns the content of the current node.
     * 
     * @return  string
     */
    public function getValue():string
    {
        $value = '';
        
        if ($this->currentNode->childNodes !== NULL){
            foreach ($this->currentNode->childNodes as $node) {
                $value .= $this->doc->saveXML($node);
            }
        } else {
            $value = $this->currentNode->nodeValue;
        }
        
        return $value;
    }
    
    /**
     * Returns all the namespace declarations defined in the current node.
     * 
     * If the current node is not an element, it will return an empty array.
     * 
     * @return  string[]    An associative array where the key is the prefix, and the value is the binded namespace.
     */
    public function getNamespaceDeclarations():array
    {
        $decls = [];
        
        if ($this->isElementNode()) {
            // $node is an instance of \DOMNameSpaceNode.
            foreach ($this->xpath->query('namespace::*', $this->currentNode) as $node) {
                if ($this->currentNode->hasAttribute($node->nodeName)) {
                    $decls[$node->prefix] = $node->nodeValue; 
                }
            }
        }
        
        return $decls;
    }
    
    /**
     * Moves the cursor on the parent node.
     * 
     * If the current node has no parent node then the position of the cursor 
     * does not change.
     * 
     * @return  bool    TRUE if the cursor has been moved, otherwise FALSE.
     */
    public function moveToParentNode():bool
    {
        $moved = FALSE;
        $node = $this->currentNode->parentNode;
        
        if ($node instanceof \DOMNode) {
            $this->currentNode = $node;
            $moved = TRUE;
        }
        
        return $moved;
    }
    
    /**
     * Moves the cursor on the first attribute.
     * 
     * If the current node is not an element or there is no attribute then 
     * the position of the cursor does not change.
     * 
     * @return  bool    TRUE if the cursor has been moved, otherwise FALSE.
     */
    public function moveToFirstAttribute():bool
    {
        $moved = FALSE;
        
        if ($this->currentNode instanceof \DOMElement) {
            $node = $this->currentNode->attributes->item(0);
            
            if ($node instanceof \DOMAttr) {
                $this->currentNode = $node;
                $moved = TRUE;
            }
        }
        
        return $moved;
    }
    
    /**
     * Moves the cursor on the next attribute.
     * 
     * If the current node is not an attribute or there is no more attributes 
     * then the position of the cursor does not change.
     * 
     * @return  bool    TRUE if the cursor has been moved, otherwise FALSE.
     */
    public function moveToNextAttribute():bool
    {
        $moved = FALSE;
        $node = $this->currentNode->nextSibling;
        
        if ($node instanceof \DOMAttr) {
            $this->currentNode = $node;
            $moved = TRUE;
        }
        
        return $moved;
    }
    
    /**
     * Moves the cursor on the next sibling node.
     * 
     * If there is no next sibling node then the position of the cursor does 
     * not change.
     * 
     * @return  bool    TRUE if the cursor has been moved, otherwise FALSE.
     */
    public function moveToNextNode():bool
    {
        $moved = FALSE;
        $node = $this->currentNode->nextSibling;
        
        if ($node instanceof \DOMNode) {
            $this->currentNode = $node;
            $moved = TRUE;
        }
        
        return $moved;
    }
    
    /**
     * Moves the cursor on the first child node.
     * 
     * If the current node has no child node then the position of the cursor 
     * does not change.
     * 
     * @return  bool    TRUE if the cursor has been moved, otherwise FALSE.
     */
    public function moveToFirstChildNode():bool
    {
        $moved = FALSE;
        $node = $this->currentNode->firstChild;
        
        if ($node instanceof \DOMNode) {
            $this->currentNode = $node;
            $moved = TRUE;
        }
        
        return $moved;
    }
    
    /**
     * Indicates whether the current node is a comment.
     * 
     * @return  bool    TRUE if the current node is a comment, otherwise FALSE.
     */
    public function isCommentNode():bool
    {
        return $this->currentNode->nodeType == XML_COMMENT_NODE;
    }
    
    /**
     * Indicates whether the current node is an element.
     * 
     * @return  bool    TRUE if the current node is an element, otherwise FALSE.
     */
    public function isElementNode():bool
    {
        return $this->currentNode->nodeType == XML_ELEMENT_NODE;
    }
    
    /**
     * Indicates whether the current node is a text.
     * 
     * @return  bool    TRUE if the current node is a text, otherwise FALSE.
     */
    public function isTextNode():bool
    {
        return $this->currentNode->nodeType == XML_TEXT_NODE;
    }
    
    /**
     * Indicates whether the current node is a white space (i.e. a text that 
     * only contains white space characters).
     * 
     * @return  bool    TRUE if the current node is a white space, otherwise FALSE.
     */
    public function isWhiteSpaceNode():bool
    {
        return $this->currentNode->nodeType == XML_TEXT_NODE && 
            $this->currentNode->isElementContentWhitespace();
    }
}
