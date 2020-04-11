<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\ProcessingModeType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\ProcessingModeType} 
 * class.
 * 
 * @group   type
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ProcessingModeTypeTest extends TestCase
{
    /**
     * Asserts that isLax() returns TRUE, isSkip() and isStrict() return 
     * FALSE.
     * 
     * @param   ProcessingModeType  $sut
     */
    private static function assertProcessingModeLax(ProcessingModeType $sut): void
    {
        self::assertTrue($sut->isLax());
        self::assertFalse($sut->isSkip());
        self::assertFalse($sut->isStrict());
    }
    
    /**
     * Asserts that isSkip() returns TRUE, isLax() and isStrict() return 
     * FALSE.
     * 
     * @param   ProcessingModeType  $sut
     */
    private static function assertProcessingModeSkip(ProcessingModeType $sut): void
    {
        self::assertTrue($sut->isSkip());
        self::assertFalse($sut->isLax());
        self::assertFalse($sut->isStrict());
    }
    
    /**
     * Asserts that isStrict() returns TRUE, isLax() and isSkip() return 
     * FALSE.
     * 
     * @param   ProcessingModeType  $sut
     */
    private static function assertProcessingModeStrict(ProcessingModeType $sut): void
    {
        self::assertTrue($sut->isStrict());
        self::assertFalse($sut->isLax());
        self::assertFalse($sut->isSkip());
    }
    
    /**
     * Tests that isLax() returns TRUE, isSkip() and isStrict() return FALSE 
     * when the specified mode is "lax".
     */
    public function testIsLaxReturnsTrueWhenModeLax(): void
    {
        $sut = new ProcessingModeType(1);
        self::assertProcessingModeLax($sut);
    }
    
    /**
     * Tests that isSkip() returns TRUE, isLax() and isStrict() return FALSE 
     * when the specified mode is "skip".
     */
    public function testIsSkipReturnsTrueWhenModeSkip(): void
    {
        $sut = new ProcessingModeType(2);
        self::assertProcessingModeSkip($sut);
    }
    
    /**
     * Tests that isStrict() returns TRUE, isLax() and isSkip() return FALSE 
     * when the specified mode is "strict".
     */
    public function testIsStrictReturnsTrueWhenModeStrict(): void
    {
        $sut = new ProcessingModeType(3);
        self::assertProcessingModeStrict($sut);
    }
    
    /**
     * Tests that __construct() throws an exception when the specified mode 
     * is invalid.
     */
    public function test__constructThrowsExceptionWhenModeIsInvalid(): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('"4" is an invalid mode of content processing.');
        
        $sut = new ProcessingModeType(4);
    }
    
    /**
     * Tests that createLax() creates a new instance of ProcessingModeType 
     * configured in "lax" mode.
     */
    public function testCreateLaxReturnsInstanceModeLax(): void
    {
        $sut = ProcessingModeType::createLax();
        self::assertProcessingModeLax($sut);
    }
    
    /**
     * Tests that createLax() creates a new instance.
     */
    public function testCreateLaxReturnsNewInstance(): void
    {
        $sut1 = ProcessingModeType::createLax();
        $sut2 = ProcessingModeType::createLax();
        self::assertNotSame($sut1, $sut2);
    }
    
    /**
     * Tests that createSkip() creates a new instance of ProcessingModeType 
     * configured in "skip" mode.
     */
    public function testCreateSkipReturnsInstanceModeSkip(): void
    {
        $sut = ProcessingModeType::createSkip();
        self::assertProcessingModeSkip($sut);
    }
    
    /**
     * Tests that createSkip() creates a new instance.
     */
    public function testCreateSkipReturnsNewInstance(): void
    {
        $sut1 = ProcessingModeType::createSkip();
        $sut2 = ProcessingModeType::createSkip();
        self::assertNotSame($sut1, $sut2);
    }
    
    /**
     * Tests that createStrict() creates a new instance of ProcessingModeType 
     * configured in "strict" mode.
     */
    public function testCreateStrictReturnsInstanceModeStrict(): void
    {
        $sut = ProcessingModeType::createStrict();
        self::assertProcessingModeStrict($sut);
    }
    
    /**
     * Tests that createStrict() creates a new instance.
     */
    public function testCreateStrictReturnsNewInstance(): void
    {
        $sut1 = ProcessingModeType::createStrict();
        $sut2 = ProcessingModeType::createStrict();
        self::assertNotSame($sut1, $sut2);
    }
}
