<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\NonNegativeIntegerType;
use PhpXmlSchema\Dom\NonNegativeIntegerLimitType;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\NonNegativeIntegerLimitType} 
 * class.
 * 
 * @group   type
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NonNegativeIntegerLimitTypeTest extends TestCase
{
    /**
     * Tests that __construct() stores an unlimited limit.
     */
    public function test_constructStoresUnlimitedWhenNoArgument()
    {
        $sut = new  NonNegativeIntegerLimitType();
        self::assertNull($sut->getLimit());
        self::assertTrue($sut->isUnlimited());
    }
    
    /**
     * Tests that __construct() stores a non-negative integer limit.
     */
    public function test__constructStoresNonNegativeIntegerLimit()
    {
        $nni = $this->createNonNegativeIntegerTypeDummy();
        $sut = new  NonNegativeIntegerLimitType($nni);
        self::assertSame($nni, $sut->getLimit());
        self::assertFalse($sut->isUnlimited());
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\NonNegativeIntegerType} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    private function createNonNegativeIntegerTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(NonNegativeIntegerType::class)->reveal();
    }
}
