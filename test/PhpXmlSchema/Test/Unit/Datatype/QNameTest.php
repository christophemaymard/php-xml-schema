<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\QNameType;
use PhpXmlSchema\Test\Datatype\DatatypeDummyFactoryTrait;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Datatype\QNameType} 
 * class.
 * 
 * @group   type
 * @group   datatype
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class QNameTest extends TestCase
{
    use DatatypeDummyFactoryTrait;
    use ProphecyTrait;
    
    /**
     * Tests that __construct() stores the local part.
     */
    public function test__constructStoresLocalPart(): void
    {
        $localPart = $this->createNCNameTypeDummy();
        $sut = new QNameType($localPart);
        self::assertSame($localPart, $sut->getLocalPart());
        self::assertNull($sut->getNamespace());
    }
    
    /**
     * Tests that hasNamespace() returns FALSE when no namespace has been 
     * stored.
     */
    public function testHasNamespaceReturnsFalseWhenNoNamespaceStored(): void
    {
        $sut = new QNameType($this->createNCNameTypeDummy());
        self::assertFalse($sut->hasNamespace());
    }
    
    /**
     * Tests that __construct() stores the local part and the namespace.
     */
    public function test__constructStoresLocalPartAndNamespace(): void
    {
        $localPart = $this->createNCNameTypeDummy();
        $namespace = $this->createAnyUriTypeDummy();
        $sut = new QNameType($localPart, $namespace);
        self::assertSame($localPart, $sut->getLocalPart());
        self::assertSame($namespace, $sut->getNamespace());
    }
    
    /**
     * Tests that hasNamespace() returns TRUE when a namespace has been 
     * stored.
     */
    public function testHasNamespaceReturnsTrueWhenNamespaceStored(): void
    {
        $sut = new QNameType(
            $this->createNCNameTypeDummy(), 
            $this->createAnyUriTypeDummy()
        );
        self::assertTrue($sut->hasNamespace());
    }
}
