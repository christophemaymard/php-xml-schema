<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\WhiteSpaceType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\WhiteSpaceType} 
 * class.
 * 
 * @group   type
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class WhiteSpaceTypeTest extends TestCase
{
    /**
     * Asserts that isCollapse() returns TRUE, isPreserve() and isReplace() 
     * return FALSE.
     * 
     * @param   WhiteSpaceType  $sut
     */
    private static function assertWhiteSpaceCollapse(WhiteSpaceType $sut)
    {
        self::assertTrue($sut->isCollapse());
        self::assertFalse($sut->isPreserve());
        self::assertFalse($sut->isReplace());
    }
    
    /**
     * Asserts that isPreserve() returns TRUE, isCollapse() and isReplace() 
     * return FALSE.
     * 
     * @param   WhiteSpaceType  $sut
     */
    private static function assertWhiteSpacePreserve(WhiteSpaceType $sut)
    {
        self::assertTrue($sut->isPreserve());
        self::assertFalse($sut->isCollapse());
        self::assertFalse($sut->isReplace());
    }
    
    /**
     * Asserts that isReplace() returns TRUE, isCollapse() and isPreserve() 
     * return FALSE.
     * 
     * @param   WhiteSpaceType  $sut
     */
    private static function assertWhiteSpaceReplace(WhiteSpaceType $sut)
    {
        self::assertTrue($sut->isReplace());
        self::assertFalse($sut->isCollapse());
        self::assertFalse($sut->isPreserve());
    }
    
    /**
     * Tests that isCollapse() returns TRUE, isPreserve() and isReplace() 
     * return FALSE when the specified white space is "collapse".
     */
    public function testIsCollapseReturnsTrueWhenWhiteSpaceCollapse()
    {
        $sut = new WhiteSpaceType(1);
        self::assertWhiteSpaceCollapse($sut);
    }
    
    /**
     * Tests that isPreserve() returns TRUE, isCollapse() and isReplace() 
     * return FALSE when the specified white space is "preserve".
     */
    public function testIsPreserveReturnsTrueWhenWhiteSpacePreserve()
    {
        $sut = new WhiteSpaceType(2);
        self::assertWhiteSpacePreserve($sut);
    }
    
    /**
     * Tests that isReplace() returns TRUE, isCollapse() and isPreserve() 
     * return FALSE when the specified white space is "replace".
     */
    public function testIsReplaceReturnsTrueWhenWhiteSpaceReplace()
    {
        $sut = new WhiteSpaceType(3);
        self::assertWhiteSpaceReplace($sut);
    }
    
    /**
     * Tests that __construct() throws an exception when the specified white 
     * space is invalid.
     */
    public function test__constructThrowsExceptionWhenWhiteSpaceIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('"4" is an invalid white space.');
        
        $sut = new WhiteSpaceType(4);
    }
    
    /**
     * Tests that createCollapse() creates a new instance of WhiteSpaceType 
     * configured in "collapse" white space.
     */
    public function testCreateCollapseReturnsInstanceWhiteSpaceCollapse()
    {
        $sut = WhiteSpaceType::createCollapse();
        self::assertWhiteSpaceCollapse($sut);
    }
    
    /**
     * Tests that createCollapse() creates a new instance.
     */
    public function testCreateCollapseReturnsNewInstance()
    {
        $sut1 = WhiteSpaceType::createCollapse();
        $sut2 = WhiteSpaceType::createCollapse();
        self::assertNotSame($sut1, $sut2);
    }
    
    /**
     * Tests that createPreserve() creates a new instance of WhiteSpaceType 
     * configured in "preserve" white space.
     */
    public function testCreatePreserveReturnsInstanceWhiteSpacePreserve()
    {
        $sut = WhiteSpaceType::createPreserve();
        self::assertWhiteSpacePreserve($sut);
    }
    
    /**
     * Tests that createPreserve() creates a new instance.
     */
    public function testCreatePreserveReturnsNewInstance()
    {
        $sut1 = WhiteSpaceType::createPreserve();
        $sut2 = WhiteSpaceType::createPreserve();
        self::assertNotSame($sut1, $sut2);
    }
    
    /**
     * Tests that createReplace() creates a new instance of WhiteSpaceType 
     * configured in "replace" white space.
     */
    public function testCreateReplaceReturnsInstanceWhiteSpaceReplace()
    {
        $sut = WhiteSpaceType::createReplace();
        self::assertWhiteSpaceReplace($sut);
    }
    
    /**
     * Tests that createReplace() creates a new instance.
     */
    public function testCreateReplaceReturnsNewInstance()
    {
        $sut1 = WhiteSpaceType::createReplace();
        $sut2 = WhiteSpaceType::createReplace();
        self::assertNotSame($sut1, $sut2);
    }
}
