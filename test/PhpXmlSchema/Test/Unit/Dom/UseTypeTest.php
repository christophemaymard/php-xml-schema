<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\UseType;

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
    private static function assertUseOptional(UseType $sut): void
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
    private static function assertUseProhibited(UseType $sut): void
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
    private static function assertUseRequired(UseType $sut): void
    {
        self::assertTrue($sut->isRequired());
        self::assertFalse($sut->isOptional());
        self::assertFalse($sut->isProhibited());
    }
    
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new UseType();
    }
    
    /**
     * Tests that createOptional() creates a new instance of UseType 
     * configured in "optional" use.
     */
    public function testCreateOptionalReturnsInstanceUseOptional(): void
    {
        $sut = UseType::createOptional();
        self::assertUseOptional($sut);
    }
    
    /**
     * Tests that createOptional() creates a new instance.
     */
    public function testCreateOptionalReturnsNewInstance(): void
    {
        $sut1 = UseType::createOptional();
        $sut2 = UseType::createOptional();
        self::assertNotSame($sut1, $sut2);
    }
    
    /**
     * Tests that createProhibited() creates a new instance of UseType 
     * configured in "prohibited" use.
     */
    public function testCreateProhibitedReturnsInstanceUseProhibited(): void
    {
        $sut = UseType::createProhibited();
        self::assertUseProhibited($sut);
    }
    
    /**
     * Tests that createProhibited() creates a new instance.
     */
    public function testCreateProhibitedReturnsNewInstance(): void
    {
        $sut1 = UseType::createProhibited();
        $sut2 = UseType::createProhibited();
        self::assertNotSame($sut1, $sut2);
    }
    
    /**
     * Tests that createRequired() creates a new instance of UseType 
     * configured in "required" use.
     */
    public function testCreateRequiredReturnsInstanceUseRequired(): void
    {
        $sut = UseType::createRequired();
        self::assertUseRequired($sut);
    }
    
    /**
     * Tests that createRequired() creates a new instance.
     */
    public function testCreateRequiredReturnsNewInstance(): void
    {
        $sut1 = UseType::createRequired();
        $sut2 = UseType::createRequired();
        self::assertNotSame($sut1, $sut2);
    }
}
