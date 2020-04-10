<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\AnyUriType;
use PhpXmlSchema\Dom\NamespaceListType;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\NamespaceListType} 
 * class.
 * 
 * @group   type
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NamespaceListTypeTest extends TestCase
{
    /**
     * Tests that __construct() creates an instance of NamespaceListType where:
     * - any namespace is not present,
     * - any namespace, that is not the target namespace of the parent 
     * element, is not present,
     * - the target namespace is not present,
     * - entities, that are not qualified with a namespace, are not present,
     * - there is no URI references of namespaces.
     */
    public function test__construct()
    {
        $sut = new NamespaceListType();
        self::assertFalse($sut->hasAny());
        self::assertFalse($sut->hasOther());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertFalse($sut->hasLocal());
        self::assertSame([], $sut->getNamespaces());
    }
    
    /**
     * Tests that createAny() creates a new instance of NamespaceListType 
     * where any namespace is present.
     */
    public function testCreateAnyReturnsNewInstanceWithAnyNamespace()
    {
        $sut = NamespaceListType::createAny();
        $nsl2 = NamespaceListType::createAny();
        self::assertNotSame($sut, $nsl2);
        self::assertTrue($sut->hasAny());
        self::assertFalse($sut->hasOther());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertFalse($sut->hasLocal());
        self::assertSame([], $sut->getNamespaces());
    }
    
    /**
     * Tests that createOther() creates a new instance of NamespaceListType 
     * where any namespace, that is not the target namespace of the parent 
     * element, is present.
     */
    public function testCreateOtherReturnsNewInstanceWithOtherNamespace()
    {
        $sut = NamespaceListType::createOther();
        $nsl2 = NamespaceListType::createOther();
        self::assertNotSame($sut, $nsl2);
        self::assertFalse($sut->hasAny());
        self::assertTrue($sut->hasOther());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertFalse($sut->hasLocal());
        self::assertSame([], $sut->getNamespaces());
    }
    
    /**
     * Tests that create() creates a new instance of NamespaceListType where:
     * - the target namespace is not present,
     * - entities, that are not qualified with a namespace, are not present,
     * - there is no URI references of namespaces.
     */
    public function testCreateReturnsNewInstance()
    {
        $sut = NamespaceListType::create(FALSE, FALSE, []);
        $nsl2 = NamespaceListType::create(FALSE, FALSE, []);
        self::assertNotSame($sut, $nsl2);
        self::assertFalse($sut->hasAny());
        self::assertFalse($sut->hasOther());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertFalse($sut->hasLocal());
        self::assertSame([], $sut->getNamespaces());
    }
    
    /**
     * Tests that create() creates a new instance of NamespaceListType where:
     * - the target namespace is present,
     * - entities, that are not qualified with a namespace, are not present,
     * - there is no URI references of namespaces.
     */
    public function testCreateReturnsNewInstanceWithTargetNamespace()
    {
        $sut = NamespaceListType::create(TRUE, FALSE, []);
        $nsl2 = NamespaceListType::create(TRUE, FALSE, []);
        self::assertNotSame($sut, $nsl2);
        self::assertFalse($sut->hasAny());
        self::assertFalse($sut->hasOther());
        self::assertTrue($sut->hasTargetNamespace());
        self::assertFalse($sut->hasLocal());
        self::assertSame([], $sut->getNamespaces());
    }
    
    /**
     * Tests that create() creates a new instance of NamespaceListType where:
     * - the target namespace is not present,
     * - entities, that are not qualified with a namespace, are present,
     * - there is no URI references of namespaces.
     */
    public function testCreateReturnsNewInstanceWithLocalNamespace()
    {
        $sut = NamespaceListType::create(FALSE, TRUE, []);
        $nsl2 = NamespaceListType::create(FALSE, TRUE, []);
        self::assertNotSame($sut, $nsl2);
        self::assertFalse($sut->hasAny());
        self::assertFalse($sut->hasOther());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertTrue($sut->hasLocal());
        self::assertSame([], $sut->getNamespaces());
    }
    
    /**
     * Tests that create() creates a new instance of NamespaceListType where:
     * - the target namespace is not present,
     * - entities, that are not qualified with a namespace, are not present,
     * - there is a set of URI references of namespaces.
     */
    public function testCreateReturnsNewInstanceWithNamespaces()
    {
        $namespaces = [];
        $namespaces[] = $this->createAnyUriTypeDummy();
        $namespaces[] = $this->createAnyUriTypeDummy();
        $namespaces[] = $this->createAnyUriTypeDummy();
        
        $sut = NamespaceListType::create(FALSE, FALSE, $namespaces);
        $nsl2 = NamespaceListType::create(FALSE, FALSE, $namespaces);
        self::assertNotSame($sut, $nsl2);
        self::assertFalse($sut->hasAny());
        self::assertFalse($sut->hasOther());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertFalse($sut->hasLocal());
        self::assertSame($namespaces, $sut->getNamespaces());
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\AnyUriType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    private function createAnyUriTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(AnyUriType::class)->reveal();
    }
}
