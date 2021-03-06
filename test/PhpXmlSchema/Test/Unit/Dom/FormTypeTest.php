<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\FormType;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\FormType} class.
 * 
 * @group   type
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FormTypeTest extends TestCase
{
    /**
     * Asserts that isQualified() returns TRUE and isUnqualified() returns 
     * FALSE.
     * 
     * @param   FormType    $sut
     */
    private static function assertFormQualified(FormType $sut): void
    {
        self::assertTrue($sut->isQualified());
        self::assertFalse($sut->isUnqualified());
    }
    
    /**
     * Asserts that isUnqualified() returns TRUE and isQualified() returns 
     * FALSE.
     * 
     * @param   FormType    $sut
     */
    private static function assertFormUnqualified(FormType $sut): void
    {
        self::assertTrue($sut->isUnqualified());
        self::assertFalse($sut->isQualified());
    }
    
    /**
     * Tests that __construct() throws an exception.
     */
    public function test__constructThrowsException(): void
    {
        $this->expectException(\Throwable::class);
        $this->expectExceptionMessageMatches('`private `');
        $sut = new FormType();
    }
    
    /**
     * Tests that createQualified() creates a new instance of FormType 
     * configured in "qualified" form.
     */
    public function testCreateQualifiedReturnsInstanceFormQualified(): void
    {
        $sut = FormType::createQualified();
        self::assertFormQualified($sut);
    }
    
    /**
     * Tests that createQualified() creates a new instance.
     */
    public function testCreateQualifiedReturnsNewInstance(): void
    {
        $sut1 = FormType::createQualified();
        $sut2 = FormType::createQualified();
        self::assertNotSame($sut1, $sut2);
    }
    
    /**
     * Tests that createUnqualified() creates a new instance of FormType 
     * configured in "unqualified" form.
     */
    public function testCreateUnqualifiedReturnsInstanceFormUnqualified(): void
    {
        $sut = FormType::createUnqualified();
        self::assertFormUnqualified($sut);
    }
    
    /**
     * Tests that createUnqualified() creates a new instance.
     */
    public function testCreateUnqualifiedReturnsNewInstance(): void
    {
        $sut1 = FormType::createUnqualified();
        $sut2 = FormType::createUnqualified();
        self::assertNotSame($sut1, $sut2);
    }
}
