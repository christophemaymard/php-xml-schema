<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\NCNameType;
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
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\NCNameType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createNCNameTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(NCNameType::class)->reveal();
    }
}
