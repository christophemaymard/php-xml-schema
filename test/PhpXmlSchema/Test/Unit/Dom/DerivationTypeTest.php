<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\DerivationType;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\DerivationType} 
 * class.
 * 
 * @group   type
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class DerivationTypeTest extends TestCase
{
    /**
     * Tests that byRestriction() returns TRUE, and the others FALSE, when 
     * TRUE is provided in construct(). 
     */
    public function testByRestrictionReturnsTrue()
    {
        $sut = new DerivationType(TRUE, FALSE, FALSE, FALSE, FALSE);
        self::assertTrue($sut->byRestriction());
        self::assertFalse($sut->byExtension());
        self::assertFalse($sut->bySubstitution());
        self::assertFalse($sut->byList());
        self::assertFalse($sut->byUnion());
    }
    
    /**
     * Tests that byExtension() returns TRUE, and the others FALSE, when 
     * TRUE is provided in construct(). 
     */
    public function testByExtensionReturnsTrue()
    {
        $sut = new DerivationType(FALSE, TRUE, FALSE, FALSE, FALSE);
        self::assertFalse($sut->byRestriction());
        self::assertTrue($sut->byExtension());
        self::assertFalse($sut->bySubstitution());
        self::assertFalse($sut->byList());
        self::assertFalse($sut->byUnion());
    }
    
    /**
     * Tests that bySubstitution() returns TRUE, and the others FALSE, when 
     * TRUE is provided in construct(). 
     */
    public function testBySubstitutionReturnsTrue()
    {
        $sut = new DerivationType(FALSE, FALSE, TRUE, FALSE, FALSE);
        self::assertFalse($sut->byRestriction());
        self::assertFalse($sut->byExtension());
        self::assertTrue($sut->bySubstitution());
        self::assertFalse($sut->byList());
        self::assertFalse($sut->byUnion());
    }
    
    /**
     * Tests that byList() returns TRUE, and the others FALSE, when 
     * TRUE is provided in construct(). 
     */
    public function testByListReturnsTrue()
    {
        $sut = new DerivationType(FALSE, FALSE, FALSE, TRUE, FALSE);
        self::assertFalse($sut->byRestriction());
        self::assertFalse($sut->byExtension());
        self::assertFalse($sut->bySubstitution());
        self::assertTrue($sut->byList());
        self::assertFalse($sut->byUnion());
    }
    
    /**
     * Tests that byUnion() returns TRUE, and the others FALSE, when 
     * TRUE is provided in construct(). 
     */
    public function testByUnionReturnsTrue()
    {
        $sut = new DerivationType(FALSE, FALSE, FALSE, FALSE, TRUE);
        self::assertFalse($sut->byRestriction());
        self::assertFalse($sut->byExtension());
        self::assertFalse($sut->bySubstitution());
        self::assertFalse($sut->byList());
        self::assertTrue($sut->byUnion());
    }
}
