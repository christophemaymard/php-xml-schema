<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\DerivationType;
use PhpXmlSchema\Dom\ElementInterface;
use PhpXmlSchema\Dom\FieldXPathType;
use PhpXmlSchema\Dom\FormType;
use PhpXmlSchema\Dom\NamespaceListType;
use PhpXmlSchema\Dom\NonNegativeIntegerLimitType;
use PhpXmlSchema\Dom\ProcessingModeType;
use PhpXmlSchema\Dom\SelectorXPathType;
use PhpXmlSchema\Dom\UseType;
use PhpXmlSchema\Dom\WhiteSpaceType;
use PhpXmlSchema\Test\Unit\Datatype\DatatypeDummyFactoryTrait;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the base class for all the element test cases.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractAbstractElementTestCase extends TestCase
{
    use DatatypeDummyFactoryTrait;
    
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
     * Tests that getLocalName() returns a specific string.
     */
    abstract public function testGetLocalNameReturnsSpecificString();
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\DerivationType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createDerivationTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(DerivationType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\FieldXPathType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createFieldXPathTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(FieldXPathType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\FormType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createFormTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(FormType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\NamespaceListType} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createNamespaceListTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(NamespaceListType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\NonNegativeIntegerLimitType} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createNonNegativeIntegerLimitTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(NonNegativeIntegerLimitType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ProcessingModeType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createProcessingModeTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ProcessingModeType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\SelectorXPathType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createSelectorXPathTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(SelectorXPathType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\UseType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createUseTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(UseType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\WhiteSpaceType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createWhiteSpaceTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(WhiteSpaceType::class)->reveal();
    }
}
