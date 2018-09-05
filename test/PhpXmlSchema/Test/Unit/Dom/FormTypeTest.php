<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\FormType;
use PhpXmlSchema\Exception\InvalidValueException;

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
    private static function assertFormQualified(FormType $sut)
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
    private static function assertFormUnqualified(FormType $sut)
    {
        self::assertTrue($sut->isUnqualified());
        self::assertFalse($sut->isQualified());
    }
    
    /**
     * Tests that isQualified() returns TRUE and isUnqualified() returns 
     * FALSE when the specified form is "qualified".
     */
    public function testIsQualifiedReturnsTrueWhenFormQualified()
    {
        $sut = new FormType(1);
        self::assertFormQualified($sut);
    }
    
    /**
     * Tests that isUnqualified() returns TRUE and isQualified() returns 
     * FALSE when the specified form is "unqualified".
     */
    public function testIsUnqualifiedReturnsTrueWhenFormUnqualified()
    {
        $sut = new FormType(2);
        self::assertFormUnqualified($sut);
    }
    
    /**
     * Tests that __construct() throws an exception when the specified form 
     * is invalid.
     */
    public function test__constructThrowsExceptionWhenFormIsInvalid()
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('"3" is an invalid form.');
        
        $sut = new FormType(3);
    }
    
    /**
     * Tests that createQualified() creates a new instance of FormType 
     * configured in "qualified" form.
     */
    public function testCreateQualifiedReturnsInstanceFormQualified()
    {
        $sut = FormType::createQualified();
        self::assertFormQualified($sut);
    }
    
    /**
     * Tests that createQualified() creates a new instance.
     */
    public function testCreateQualifiedReturnsNewInstance()
    {
        $sut1 = FormType::createQualified();
        $sut2 = FormType::createQualified();
        self::assertNotSame($sut1, $sut2);
    }
    
    /**
     * Tests that createUnqualified() creates a new instance of FormType 
     * configured in "unqualified" form.
     */
    public function testCreateUnqualifiedReturnsInstanceFormUnqualified()
    {
        $sut = FormType::createUnqualified();
        self::assertFormUnqualified($sut);
    }
    
    /**
     * Tests that createUnqualified() creates a new instance.
     */
    public function testCreateUnqualifiedReturnsNewInstance()
    {
        $sut1 = FormType::createUnqualified();
        $sut2 = FormType::createUnqualified();
        self::assertNotSame($sut1, $sut2);
    }
}
