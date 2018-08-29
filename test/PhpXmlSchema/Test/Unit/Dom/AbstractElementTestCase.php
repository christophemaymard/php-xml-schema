<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\AnyUriType;
use PhpXmlSchema\Datatype\IDType;
use PhpXmlSchema\Datatype\NCNameType;
use PhpXmlSchema\Datatype\QNameType;
use PhpXmlSchema\Datatype\StringType;
use PhpXmlSchema\Dom\ElementInterface;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the base class for all the element test cases.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractElementTestCase extends TestCase
{
    /**
     * The element to test.
     * @var ElementInterface
     */
    protected $sut;
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\AnyUriType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAnyUriTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(AnyUriType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\IDType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createIDTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(IDType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\NCNameType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createNCNameTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(NCNameType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\QNameType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createQNameTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(QNameType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\StringType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createStringTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(StringType::class)->reveal();
    }
}
