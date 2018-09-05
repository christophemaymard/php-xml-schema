<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\UseType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\UseType} class.
 * 
 * @group   type
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class UseTypeTest extends TestCase
{
    /**
     * Asserts that isOptional() returns TRUE, isProhibited() and 
     * isRequired() return FALSE.
     * 
     * @param   UseType $sut
     */
    private static function assertUseOptional(UseType $sut)
    {
        self::assertTrue($sut->isOptional());
        self::assertFalse($sut->isProhibited());
        self::assertFalse($sut->isRequired());
    }
    
    /**
     * Asserts that isProhibited() returns TRUE, isOptional() and 
     * isRequired() return FALSE.
     * 
     * @param   UseType $sut
     */
    private static function assertUseProhibited(UseType $sut)
    {
        self::assertTrue($sut->isProhibited());
        self::assertFalse($sut->isOptional());
        self::assertFalse($sut->isRequired());
    }
    
    /**
     * Asserts that isRequired() returns TRUE, isOptional() and 
     * isProhibited() return FALSE.
     * 
     * @param   UseType $sut
     */
    private static function assertUseRequired(UseType $sut)
    {
        self::assertTrue($sut->isRequired());
        self::assertFalse($sut->isOptional());
        self::assertFalse($sut->isProhibited());
    }
    
    /**
     * Tests that isOptional() returns TRUE, isProhibited() and isRequired() 
     * return FALSE when the specified use is "optional".
     */
    public function testIsOptionalReturnsTrueWhenUseOptional()
    {
        $sut = new UseType(1);
        self::assertUseOptional($sut);
    }
    
    /**
     * Tests that isProhibited() returns TRUE, isOptional() and isRequired() 
     * return FALSE when the specified use is "prohibited".
     */
    public function testIsProhibitedReturnsTrueWhenUseProhibited()
    {
        $sut = new UseType(2);
        self::assertUseProhibited($sut);
    }
    
    /**
     * Tests that isRequired() returns TRUE, isOptional() and isProhibited() 
     * return FALSE when the specified use is "required".
     */
    public function testIsRequiredReturnsTrueWhenUseRequired()
    {
        $sut = new UseType(3);
        self::assertUseRequired($sut);
    }
    
    /**
     * Tests that __construct() throws an exception when the specified use is 
     * invalid.
     */
    public function test__constructThrowsExceptionWhenUseIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('"4" is an invalid use.');
        
        $sut = new UseType(4);
    }
    
    /**
     * Tests that createOptional() creates a new instance of UseType 
     * configured in "optional" use.
     */
    public function testCreateOptionalReturnsInstanceUseOptional()
    {
        $sut = UseType::createOptional();
        self::assertUseOptional($sut);
    }
    
    /**
     * Tests that createOptional() creates a new instance.
     */
    public function testCreateOptionalReturnsNewInstance()
    {
        $sut1 = UseType::createOptional();
        $sut2 = UseType::createOptional();
        self::assertNotSame($sut1, $sut2);
    }
    
    /**
     * Tests that createProhibited() creates a new instance of UseType 
     * configured in "prohibited" use.
     */
    public function testCreateProhibitedReturnsInstanceUseProhibited()
    {
        $sut = UseType::createProhibited();
        self::assertUseProhibited($sut);
    }
    
    /**
     * Tests that createProhibited() creates a new instance.
     */
    public function testCreateProhibitedReturnsNewInstance()
    {
        $sut1 = UseType::createProhibited();
        $sut2 = UseType::createProhibited();
        self::assertNotSame($sut1, $sut2);
    }
    
    /**
     * Tests that createRequired() creates a new instance of UseType 
     * configured in "required" use.
     */
    public function testCreateRequiredReturnsInstanceUseRequired()
    {
        $sut = UseType::createRequired();
        self::assertUseRequired($sut);
    }
    
    /**
     * Tests that createRequired() creates a new instance.
     */
    public function testCreateRequiredReturnsNewInstance()
    {
        $sut1 = UseType::createRequired();
        $sut2 = UseType::createRequired();
        self::assertNotSame($sut1, $sut2);
    }
}
