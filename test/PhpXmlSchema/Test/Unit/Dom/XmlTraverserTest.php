<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\XmlTraverser;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\XmlTraverser} 
 * class.
 * 
 * @group   xml
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class XmlTraverserTest extends TestCase
{
    /**
     * Tests that __construct() throws an exception the source is an invalid 
     * XML.
     * 
     * @param   string  $src    The XML source to test.
     * 
     * @dataProvider    getInvalidXmlSources
     */
    public function test__constructThrowsExceptionWhenSourceInvalid(string $src)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The source is an invalid XML.');
        $sut = new XmlTraverser($src);
    }
    
    /**
     * Tests that getLocalName() returns the local name of the document first 
     * child node when the cursor is positioned on it.
     * 
     * @param   string  $src        The XML source to test.
     * @param   string  $localName  The expected local name.
     * 
     * @dataProvider    getDocFirstChildNodeLocalNameXmlSources
     */
    public function testGetLocalNameWhenCursorOnDocFirstChildNode(string $src, string $localName)
    {
        $sut = new XmlTraverser($src);
        self::assertSame($localName, $sut->getLocalName());
    }
    
    /**
     * Tests that getNamespace() returns the namespace of the document first 
     * child node when the cursor is positioned on it.
     * 
     * @param   string  $src        The XML source to test.
     * @param   string  $namespace  The expected namespace.
     * 
     * @dataProvider    getDocFirstChildNodeNamespaceXmlSources
     */
    public function testGetNamespaceWhenCursorOnDocFirstChildNode(string $src, string $namespace)
    {
        $sut = new XmlTraverser($src);
        self::assertSame($namespace, $sut->getNamespace());
    }
    
    /**
     * Tests that getValue() returns the value of the document first child 
     * node when the cursor is positioned on it.
     * 
     * @param   string  $src    The XML source to test.
     * @param   string  $value  The expected value.
     * 
     * @dataProvider    getDocFirstChildNodeValueXmlSources
     */
    public function testGetValueWhenCursorOnDocFirstChildNode(string $src, string $value)
    {
        $sut = new XmlTraverser($src);
        self::assertSame($value, $sut->getValue());
    }
    
    /**
     * Tests that moveToFirstAttribute() returns FALSE  and does not move the 
     * cursor when the cursor is positioned on an element node that has no 
     * attribute.
     */
    public function testMoveToFirstAttributeReturnsFalseAndDoesNotMoveCursorWhenCursorOnElementNodeWithNoAttribute()
    {
        $sut = new XmlTraverser($this->getXml('firstattribute_0001.xml'));
        
        $localName = 'root';
        $namespace = 'http://example.org';
        $value = "\n";
        
        // Before.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
        
        self::assertFalse($sut->moveToFirstAttribute());
        
        // After.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
    }
    
    /**
     * Tests that moveToFirstAttribute() returns TRUE and moves the cursor 
     * when the cursor is positioned on an element node that has at least 
     * 1 attribute.
     */
    public function testMoveToFirstAttributeReturnsTrueAndMovesCursorWhenCursorOnElementNodeWith1Attribute()
    {
        $sut = new XmlTraverser($this->getXml('firstattribute_0002.xml'));
        
        // Before.
        self::assertSame('root', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame("\n", $sut->getValue());
        
        self::assertTrue($sut->moveToFirstAttribute());
        
        // After.
        self::assertSame('first', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame(' foo ', $sut->getValue());
    }
    
    /**
     * Tests that moveToFirstAttribute() returns FALSE and does not move the 
     * cursor when the cursor is positioned on a comment node.
     */
    public function testMoveToFirstAttributeReturnsFalseAndDoesNotMoveCursorWhenCursorOnCommentNode()
    {
        $sut = new XmlTraverser($this->getXml('firstattribute_0003.xml'));
        
        $localName = '';
        $namespace = '';
        $value = ' Comment ';
        
        // Before.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
        
        self::assertFalse($sut->moveToFirstAttribute());
        
        // After.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
    }
    
    /**
     * Tests that moveToNextAttribute() returns FALSE and does not move the 
     * cursor when the cursor is positioned on the first attribute node of an 
     * element that has 1 attribute.
     */
    public function testMoveToNextAttributeReturnsFalseAndDoesNotMoveCursorWhenCursorOnFirstAttributeNodeWithNoMoreAttribute()
    {
        $sut = new XmlTraverser($this->getXml('nextattribute_0001.xml'));
        $sut->moveToFirstAttribute();
        
        $localName = 'first';
        $namespace = 'http://example.org';
        $value = 'foo';
        
        // Before.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
        
        self::assertFalse($sut->moveToNextAttribute());
        
        // After.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
    }
    
    /**
     * Tests that moveToNextAttribute() returns TRUE and moves the cursor 
     * when the cursor is positioned on the first attribute node of an 
     * element node that has more than 1 attribute node.
     */
    public function testMoveToNextAttributeReturnsTrueAndMovesCursorWhenCursorOnFirstAttributeNodeWithMoreAttribute()
    {
        $sut = new XmlTraverser($this->getXml('nextattribute_0002.xml'));
        $sut->moveToFirstAttribute();
        
        // Before.
        self::assertSame('first', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame('foo', $sut->getValue());
        
        self::assertTrue($sut->moveToNextAttribute());
        
        // After.
        self::assertSame('second', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame('bar', $sut->getValue());
    }
    
    /**
     * Tests that moveToNextAttribute() returns FALSE and does not move the 
     * cursor when the cursor is positioned on a comment node.
     */
    public function testMoveToNextAttributeReturnsFalseAndDoesNotMoveCursorWhenCursorOnCommentNode()
    {
        $sut = new XmlTraverser($this->getXml('nextattribute_0003.xml'));
        
        $localName = '';
        $namespace = '';
        $value = ' Comment ';
        
        // Before.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
        
        self::assertFalse($sut->moveToNextAttribute());
        
        // After.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
    }
    
    /**
     * Tests that moveToFirstChildNode() returns FALSE and does not move the 
     * cursor when the cursor is positioned on an element node that has no 
     * child node.
     */
    public function testMoveToFirstChildNodeReturnsFalseAndDoesNotMoveCursorWhenCursorOnElementNodeWhithNoChildNode()
    {
        $sut = new XmlTraverser($this->getXml('firstchildnode_0001.xml'));
        
        $localName = 'root';
        $namespace = 'http://example.org';
        $value = '';
        
        // Before.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
        
        self::assertFalse($sut->moveToFirstChildNode());
        
        // After.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
    }
    
    /**
     * Tests that moveToFirstChildNode() returns TRUE and moves the cursor 
     * when the cursor is positioned on an element node that has at least 
     * 1 child node.
     */
    public function testMoveToFirstChildNodeReturnsTrueAndMovesCursorWhenCursorOnElementNodeWhithChildNode()
    {
        $sut = new XmlTraverser($this->getXml('firstchildnode_0002.xml'));
        
        // Before.
        $beforeValue = "\n".
            "  <!-- Comment -->\n".
            "  <first>foo</first>\n";
        self::assertSame('root', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame($beforeValue, $sut->getValue());
        
        self::assertTrue($sut->moveToFirstChildNode());
        
        // After.
        self::assertSame('', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame("\n  ", $sut->getValue());
    }
    
    /**
     * Tests that moveToFirstChildNode() returns TRUE and moves the cursor 
     * when the cursor is positioned on an attribute node. 
     */
    public function testMoveToFirstChildNodeReturnsTrueAndMovesCursorWhenCursorOnAttributeNode()
    {
        $sut = new XmlTraverser($this->getXml('firstchildnode_0003.xml'));
        $sut->moveToFirstAttribute();
        
        // Before.
        self::assertSame('first', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame('foo', $sut->getValue());
        
        self::assertTrue($sut->moveToFirstChildNode());
        
        // After.
        self::assertSame('', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame('foo', $sut->getValue());
    }
    
    /**
     * Tests that moveToFirstChildNode() returns FALSE and does not move the 
     * cursor when the cursor is positioned on a comment node.
     */
    public function testMoveToFirstChildNodeReturnsFalseAndDoesNotMoveCursorWhenCursorOnCommentNode()
    {
        $sut = new XmlTraverser($this->getXml('firstchildnode_0004.xml'));
        
        $localName = '';
        $namespace = '';
        $value = ' Comment ';
        
        // Before.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
        
        self::assertFalse($sut->moveToFirstChildNode());
        
        // After.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
    }
    
    /**
     * Tests that moveToNextNode() returns FALSE and does not move the cursor 
     * when the cursor is positioned on an element node that has no next 
     * sibling node.
     */
    public function testMoveToNextNodeReturnsFalseAndDoesNotMoveCursorWhenCursorOnElementNodeWithNoNextSiblingNode()
    {
        $sut = new XmlTraverser($this->getXml('nextnode_0001.xml'));
        
        $localName = 'root';
        $namespace = 'http://example.org';
        $value = "\n";
        
        // Before.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
        
        self::assertFalse($sut->moveToNextNode());
        
        // After.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
    }
    
    /**
     * Tests that moveToNextNode() returns TRUE and moves the cursor when the 
     * cursor is positioned on an element node that has a next sibling node.
     */
    public function testMoveToNextNodeReturnsTrueAndMovesCursorWhenCursorOnElementNodeWithNextSiblingNode()
    {
        $sut = new XmlTraverser($this->getXml('nextnode_0002.xml'));
        $sut->moveToFirstChildNode();
        
        // Before.
        self::assertSame('first', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame('foo', $sut->getValue());
        
        self::assertTrue($sut->moveToNextNode());
        
        // After.
        self::assertSame('', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame("bar\n", $sut->getValue());
    }
    
    /**
     * Tests that moveToNextNode() returns FALSE and does not move the cursor 
     * when the cursor is positioned on a comment node that has no next 
     * sibling node.
     */
    public function testMoveToNextNodeReturnsFalseAndDoesNotMoveCursorWhenCursorOnCommentNodeWithNoNextSiblingNode()
    {
        $sut = new XmlTraverser($this->getXml('nextnode_0003.xml'));
        $sut->moveToFirstChildNode();
        
        $localName = '';
        $namespace = '';
        $value = ' Comment ';
        
        // Before.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
        
        self::assertFalse($sut->moveToNextNode());
        
        // After.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
    }
    
    /**
     * Tests that moveToNextNode() returns TRUE and moves the cursor when the 
     * cursor is positioned on a comment node that has a next sibling node.
     */
    public function testMoveToNextNodeReturnsTrueAndMovesCursorWhenCursorOnCommentNodeWithNextSiblingNode()
    {
        $sut = new XmlTraverser($this->getXml('nextnode_0004.xml'));
        
        // Before.
        self::assertSame('', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame(' Comment ', $sut->getValue());
        
        self::assertTrue($sut->moveToNextNode());
        
        // After.
        self::assertSame('root', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame("\n", $sut->getValue());
    }
    
    /**
     * Tests that moveToNextNode() returns FALSE and does not move the cursor 
     * when the cursor is positioned on the first attribute node of an 
     * element that has 1 attribute.
     */
    public function testMoveToNextNodeReturnsFalseAndDoesNotMoveCursorWhenCursorOnAttributeNodeWithNoOtherAttributeNode()
    {
        $sut = new XmlTraverser($this->getXml('nextnode_0005.xml'));
        $sut->moveToFirstAttribute();
        
        $localName = 'first';
        $namespace = 'http://example.org';
        $value = 'foo';
        
        // Before.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
        
        self::assertFalse($sut->moveToNextNode());
        
        // After.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
    }
    
    /**
     * Tests that moveToNextNode() returns TRUE and moves the cursor when the 
     * cursor is positioned on the first attribute node of an element that 
     * has more than 1 attribute.
     */
    public function testMoveToNextNodeReturnsTrueAndMovesCursorWhenCursorOnAttributeNodeWithOtherAttributeNode()
    {
        $sut = new XmlTraverser($this->getXml('nextnode_0006.xml'));
        $sut->moveToFirstAttribute();
        
        // Before.
        self::assertSame('first', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame('foo', $sut->getValue());
        
        self::assertTrue($sut->moveToNextNode());
        
        // After.
        self::assertSame('second', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame('bar', $sut->getValue());
    }
    
    /**
     * Tests that moveToNextNode() returns FALSE and does not move the cursor 
     * when the cursor is positioned on a text node that has no next 
     * sibling node.
     */
    public function testMoveToNextNodeReturnsFalseAndDoesNotMoveCursorWhenCursorOnTextNodeWithNoNextSiblingNode()
    {
        $sut = new XmlTraverser($this->getXml('nextnode_0007.xml'));
        $sut->moveToFirstChildNode();
        
        $localName = '';
        $namespace = '';
        $value = "\n  foo\n";
        
        // Before.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
        
        self::assertFalse($sut->moveToNextNode());
        
        // After.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
    }
    
    /**
     * Tests that moveToNextNode() returns TRUE and moves the cursor when the 
     * cursor is positioned on a text node that has a next sibling node.
     */
    public function testMoveToNextNodeReturnsTrueAndMovesCursorWhenCursorOnTextNodeWithNextSiblingNode()
    {
        $sut = new XmlTraverser($this->getXml('nextnode_0008.xml'));
        $sut->moveToFirstChildNode();
        
        // Before.
        self::assertSame('', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame("\n  foo\n  ", $sut->getValue());
        
        self::assertTrue($sut->moveToNextNode());
        
        // After.
        self::assertSame('first', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame('bar', $sut->getValue());
    }
    
    /**
     * Tests that moveToParentNode() returns TRUE and moves the cursor when 
     * the cursor is positioned on a document child node.
     */
    public function testMoveToParentNodeReturnsTrueAndMovesCursorWhenCursorOnDocumentChildNode()
    {
        $sut = new XmlTraverser($this->getXml('parentnode_0001.xml'));
        
        // Before.
        self::assertSame('root', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame('foo', $sut->getValue());
        
        self::assertTrue($sut->moveToParentNode());
        
        // After.
        self::assertSame('', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame('<x:root xmlns:x="http://example.org">foo</x:root>', $sut->getValue());
    }
    
    /**
     * Tests that moveToParentNode() returns FALSE and does not move the 
     * cursor when the cursor is positioned on the document node.
     */
    public function testMoveToParentNodeReturnsFalseAndDoesNotMoveCursorWhenCursorOnDocumentNode()
    {
        $sut = new XmlTraverser($this->getXml('parentnode_0002.xml'));
        $sut->moveToParentNode();
        
        $localName = '';
        $namespace = '';
        $value = '<x:root xmlns:x="http://example.org">foo</x:root>';
        
        // Before.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
        
        self::assertFalse($sut->moveToParentNode());
        
        // After.
        self::assertSame($localName, $sut->getLocalName());
        self::assertSame($namespace, $sut->getNamespace());
        self::assertSame($value, $sut->getValue());
    }
    
    /**
     * Tests that moveToParentNode() returns TRUE and moves the cursor when 
     * the cursor is positioned on an attribute node.
     */
    public function testMoveToParentNodeReturnsTrueAndMovesCursorWhenCursorOnAttributeNode()
    {
        $sut = new XmlTraverser($this->getXml('parentnode_0003.xml'));
        $sut->moveToFirstAttribute();
        $sut->moveToNextAttribute();
        
        // Before.
        self::assertSame('second', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame('bar', $sut->getValue());
        
        self::assertTrue($sut->moveToParentNode());
        
        // After.
        self::assertSame('root', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame("\n", $sut->getValue());
    }
    
    /**
     * Tests that moveToParentNode() returns TRUE and moves the cursor when 
     * the cursor is positioned on an element node.
     */
    public function testMoveToParentNodeReturnsTrueAndMovesCursorWhenCursorOnElementNode()
    {
        $sut = new XmlTraverser($this->getXml('parentnode_0004.xml'));
        $sut->moveToFirstChildNode();
        $sut->moveToNextNode();
        
        // Before.
        self::assertSame('first', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame('foo', $sut->getValue());
        
        self::assertTrue($sut->moveToParentNode());
        
        // After.
        self::assertSame('root', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame("\n  <first>foo</first>\n", $sut->getValue());
    }
    
    /**
     * Tests that moveToParentNode() returns TRUE and moves the cursor when 
     * the cursor is positioned on a comment node.
     */
    public function testMoveToParentNodeReturnsTrueAndMovesCursorWhenCursorOnCommentNode()
    {
        $sut = new XmlTraverser($this->getXml('parentnode_0005.xml'));
        $sut->moveToFirstChildNode();
        $sut->moveToNextNode();
        
        // Before.
        self::assertSame('', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame(' Comment ', $sut->getValue());
        
        self::assertTrue($sut->moveToParentNode());
        
        // After.
        self::assertSame('root', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame("\n  <!-- Comment -->\n", $sut->getValue());
    }
    
    /**
     * Tests that moveToParentNode() returns TRUE and moves the cursor when 
     * the cursor is positioned on a text node.
     */
    public function testMoveToParentNodeReturnsTrueAndMovesCursorWhenCursorOnTextNode()
    {
        $sut = new XmlTraverser($this->getXml('parentnode_0006.xml'));
        $sut->moveToFirstChildNode();
        $sut->moveToNextNode();
        
        // Before.
        self::assertSame('', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame("\n  foo\n", $sut->getValue());
        
        self::assertTrue($sut->moveToParentNode());
        
        // After.
        self::assertSame('root', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame("\n  foo\n", $sut->getValue());
    }
    
    /**
     * Tests that moveToParentNode() returns TRUE and moves the cursor when 
     * the cursor is positioned on a white space node.
     */
    public function testMoveToParentNodeReturnsTrueAndMovesCursorWhenCursorOnWhiteSpaceNode()
    {
        $sut = new XmlTraverser($this->getXml('parentnode_0007.xml'));
        $sut->moveToFirstChildNode();
        
        // Before.
        self::assertSame('', $sut->getLocalName());
        self::assertSame('', $sut->getNamespace());
        self::assertSame("\n", $sut->getValue());
        
        self::assertTrue($sut->moveToParentNode());
        
        // After.
        self::assertSame('root', $sut->getLocalName());
        self::assertSame('http://example.org', $sut->getNamespace());
        self::assertSame("\n", $sut->getValue());
    }
    
    /**
     * Tests that isCommentNode() returns TRUE when the cursor is positioned 
     * on a comment node.
     */
    public function testIsCommentNodeReturnsTrueWhenCursorOnCommentNode()
    {
        $sut = new XmlTraverser($this->getXml('iscomment_0001.xml'));
        self::assertTrue($sut->isCommentNode());
        self::assertFalse($sut->isElementNode());
        self::assertFalse($sut->isTextNode());
        self::assertFalse($sut->isWhiteSpaceNode());
    }
    
    /**
     * Tests that isCommentNode() returns FALSE when the cursor is positioned 
     * on a node that is not a comment node.
     */
    public function testIsCommentNodeReturnsFalseWhenCursorOnNodeNotCommentNode()
    {
        $sut = new XmlTraverser($this->getXml('iscomment_0002.xml'));
        self::assertFalse($sut->isCommentNode());
    }
    
    /**
     * Tests that isElementNode() returns TRUE when the cursor is positioned 
     * on an element node.
     */
    public function testIsElementNodeReturnsTrueWhenCursorOnElementNode()
    {
        $sut = new XmlTraverser($this->getXml('iselement_0001.xml'));
        self::assertTrue($sut->isElementNode());
        self::assertFalse($sut->isCommentNode());
        self::assertFalse($sut->isTextNode());
        self::assertFalse($sut->isWhiteSpaceNode());
    }
    
    /**
     * Tests that isElementNode() returns FALSE when the cursor is positioned 
     * on a node that is not an element node.
     */
    public function testIsElementNodeReturnsFalseWhenCursorOnNodeNotElementNode()
    {
        $sut = new XmlTraverser($this->getXml('iselement_0002.xml'));
        self::assertFalse($sut->isElementNode());
    }
    
    /**
     * Tests that isTextNode() returns TRUE when the cursor is positioned on 
     * a text node.
     */
    public function testIsTextNodeReturnsTrueWhenCursorOnTextNode()
    {
        $sut = new XmlTraverser($this->getXml('istext_0001.xml'));
        $sut->moveToFirstChildNode();
        self::assertTrue($sut->isTextNode());
        self::assertFalse($sut->isCommentNode());
        self::assertFalse($sut->isElementNode());
        self::assertFalse($sut->isWhiteSpaceNode());
    }
    
    /**
     * Tests that isTextNode() returns FALSE when the cursor is positioned on 
     * a node that is not a text node.
     */
    public function testIsTextNodeReturnsFalseWhenCursorOnNodeNotTextNode()
    {
        $sut = new XmlTraverser($this->getXml('istext_0002.xml'));
        self::assertFalse($sut->isTextNode());
    }
    
    /**
     * Tests that isWhiteSpaceNode() and isTextNode() return TRUE  when the 
     * cursor is positioned on a white space node.
     */
    public function testIsWhiteSpaceNodeIsTextNodeReturnTrueWhenCursorOnWhiteSpaceNode()
    {
        $sut = new XmlTraverser($this->getXml('iswhitespace_0001.xml'));
        $sut->moveToFirstChildNode();
        self::assertTrue($sut->isWhiteSpaceNode());
        self::assertTrue($sut->isTextNode());
        self::assertFalse($sut->isCommentNode());
        self::assertFalse($sut->isElementNode());
    }
    
    /**
     * Tests that isWhiteSpaceNode() returns FALSE when the cursor is 
     * positioned on a node that is not a white space node.
     */
    public function testIsWhiteSpaceNodeReturnsFalseWhenCursorOnNodeNotWhiteSpaceNode()
    {
        $sut = new XmlTraverser($this->getXml('iswhitespace_0002.xml'));
        $sut->moveToFirstChildNode();
        self::assertFalse($sut->isWhiteSpaceNode());
    }
    
    /**
     * Tests that getNamespaceDeclarations() returns an empty array when the 
     * cursor is positioned on a comment node.
     */
    public function testGetNamespaceDeclarationsReturnsEmptyArrayWhenCursorOnCommentNode()
    {
        $sut = new XmlTraverser($this->getXml('nsdecl_0001.xml'));
        self::assertTrue($sut->isCommentNode());
        self::assertSame([], $sut->getNamespaceDeclarations());
    }
    
    /**
     * Tests that getNamespaceDeclarations() returns an empty array when the 
     * cursor is positioned on a text node.
     */
    public function testGetNamespaceDeclarationsReturnsEmptyArrayWhenCursorOnTextNode()
    {
        $sut = new XmlTraverser($this->getXml('nsdecl_0002.xml'));
        $sut->moveToFirstChildNode();
        
        self::assertTrue($sut->isTextNode());
        self::assertFalse($sut->isWhiteSpaceNode());
        self::assertSame([], $sut->getNamespaceDeclarations());
    }
    
    /**
     * Tests that getNamespaceDeclarations() returns an empty array when the 
     * cursor is positioned on a white space node.
     */
    public function testGetNamespaceDeclarationsReturnsEmptyArrayWhenCursorOnWhiteSpaceNode()
    {
        $sut = new XmlTraverser($this->getXml('nsdecl_0003.xml'));
        $sut->moveToFirstChildNode();
        
        self::assertTrue($sut->isTextNode());
        self::assertTrue($sut->isWhiteSpaceNode());
        self::assertSame([], $sut->getNamespaceDeclarations());
    }
    
    /**
     * Tests that getNamespaceDeclarations() returns an empty array when the 
     * cursor is positioned on an attribute node.
     */
    public function testGetNamespaceDeclarationsReturnsEmptyArrayWhenCursorOnAttributeNode()
    {
        $sut = new XmlTraverser($this->getXml('nsdecl_0004.xml'));
        
        self::assertTrue($sut->moveToFirstAttribute());
        self::assertSame([], $sut->getNamespaceDeclarations());
    }
    
    /**
     * Tests that getNamespaceDeclarations() returns an associative of strings 
     * when the cursor is positioned on the root element.
     * 
     * @param   string  $fileName
     * @param   array   $decls
     * 
     * @dataProvider    getRootElementNamespaceDeclarations
     */
    public function testGetNamespaceDeclarationsReturnsArrayOfStringsWhenCursorOnRootElement(
        string $fileName, 
        array $decls
    ) {
        $sut = new XmlTraverser($this->getXml($fileName));
        
        self::assertTrue($sut->isElementNode());
        self::assertArraySubset($decls, $sut->getNamespaceDeclarations(), TRUE);
        self::assertCount(0, \array_diff_assoc($sut->getNamespaceDeclarations(), $decls));
    }
    
    /**
     * Tests that getNamespaceDeclarations() returns an associative of strings 
     * when the cursor is positioned on a child element.
     * 
     * @param   string  $fileName
     * @param   array   $decls
     * 
     * @dataProvider    getChildElementNamespaceDeclarations
     */
    public function testGetNamespaceDeclarationsReturnsArrayOfStringsWhenCursorOnChildElement(
        string $fileName, 
        array $decls
    ) {
        $sut = new XmlTraverser($this->getXml($fileName));
        $sut->moveToFirstChildNode();
        
        self::assertTrue($sut->isElementNode());
        self::assertArraySubset($decls, $sut->getNamespaceDeclarations(), TRUE);
        self::assertCount(0, \array_diff_assoc($sut->getNamespaceDeclarations(), $decls));
    }
    
    /**
     * Returns a set of invalid XML sources.
     * 
     * @return  array[]
     */
    public function getInvalidXmlSources():array
    {
        return [
            'Empty string' => [ $this->getXml('xmlerr_0001.xml'), ], 
            'XML declaration only' => [ $this->getXml('xmlerr_0002.xml'), ], 
            'Root end tag missing' => [ $this->getXml('xmlerr_0003.xml'), ], 
            'Attribute redefined' => [ $this->getXml('xmlerr_0004.xml'), ], 
            'Content before root' => [ $this->getXml('xmlerr_0005.xml'), ], 
        ];
    }
    
    /**
     * Returns a set of valid XML sources.
     * 
     * @return  array[]
     */
    public function getDocFirstChildNodeLocalNameXmlSources():array
    {
        return [
            'Element node' => [ 
                $this->getXml('localname_0001.xml'), 
                'root', 
            ], 
            'Element node with prefix not binded to namespace' => [ 
                $this->getXml('localname_0002.xml'), 
                'x:root', 
            ], 
            'Element node with prefix binded to namespace' => [ 
                $this->getXml('localname_0003.xml'), 
                'root', 
            ], 
            'Comment node' => [ 
                $this->getXml('localname_0004.xml'), 
                '', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid XML sources.
     * 
     * @return  array[]
     */
    public function getDocFirstChildNodeNamespaceXmlSources():array
    {
        return [
            'Element node' => [ 
                $this->getXml('namespace_0001.xml'), 
                '', 
            ], 
            'Element node with prefix not binded to namespace' => [ 
                $this->getXml('namespace_0002.xml'), 
                '', 
            ], 
            'Element node with prefix binded to namespace' => [ 
                $this->getXml('namespace_0003.xml'), 
                '  http://example.org  ', 
            ], 
            'Comment node' => [ 
                $this->getXml('namespace_0004.xml'), 
                '', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid XML sources.
     * 
     * @return  array[]
     */
    public function getDocFirstChildNodeValueXmlSources():array
    {
        return [
            'Element node with empty content' => [ 
                $this->getXml('value_0001.xml'), 
                '', 
            ], 
            'Element node empty' => [ 
                $this->getXml('value_0002.xml'), 
                '', 
            ], 
            'Element node with content' => [ 
                $this->getXml('value_0003.xml'), 
                "\n    foo\n    bar \n    <!-- Comment -->\n", 
            ], 
            'Comment node' => [ 
                $this->getXml('value_0004.xml'), 
                ' Comment ', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid XML sources related to namespace declarations 
     * in a root element.
     * 
     * @return  array[]
     */
    public function getRootElementNamespaceDeclarations():array
    {
        return [
            'No declaration' => [
                'nsdecl_0005.xml', 
                [ 
                ], 
            ], 
            'Declaration with no prefix' => [
                'nsdecl_0006.xml', 
                [
                    '' => 'http://example.org', 
                ], 
            ], 
            'Declaration with prefix' => [
                'nsdecl_0007.xml', 
                [
                    'foo' => 'http://example.org/foo', 
                ], 
            ], 
            'Multiple declarations' => [
                'nsdecl_0008.xml', 
                [
                    'foo' => 'http://example.org/foo', 
                    '' => 'http://example.org', 
                    'bar' => 'http://example.org/bar', 
                ], 
            ],
        ];
    }
    
    /**
     * Returns a set of valid XML sources related to namespace declarations 
     * in a child element.
     * 
     * @return  array[]
     */
    public function getChildElementNamespaceDeclarations():array
    {
        return [
            'No declaration' => [
                'nsdecl_0009.xml', 
                [ 
                ], 
            ], 
            'Declaration with no prefix' => [
                'nsdecl_0010.xml', 
                [
                    '' => 'http://example.org', 
                ], 
            ], 
            'Declaration with prefix' => [
                'nsdecl_0011.xml', 
                [
                    'foo' => 'http://example.org/foo', 
                ], 
            ], 
            'Multiple declarations' => [
                'nsdecl_0012.xml', 
                [
                    'foo' => 'http://example.org/foo', 
                    '' => 'http://example.org', 
                    'bar' => 'http://example.org/bar', 
                ], 
            ],
        ];
    }
    
    /**
     * Returns the content of the specified filename.
     * 
     * @param   string  $fileName
     * @return  string
     */
    private function getXml(string $fileName):string
    {
        return \file_get_contents(__DIR__.'/../../../../../res/test/unit/xmltraverser/'.$fileName);
    }
}
