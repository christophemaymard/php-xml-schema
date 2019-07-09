<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\AnyUriType;
use PhpXmlSchema\Datatype\IDType;
use PhpXmlSchema\Datatype\LanguageType;
use PhpXmlSchema\Datatype\NCNameType;
use PhpXmlSchema\Datatype\NonNegativeIntegerType;
use PhpXmlSchema\Datatype\PositiveIntegerType;
use PhpXmlSchema\Datatype\QNameType;
use PhpXmlSchema\Datatype\StringType;
use PhpXmlSchema\Datatype\TokenType;
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
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\IDType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createIDTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(IDType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\LanguageType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createLanguageTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(LanguageType::class)->reveal();
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
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\NCNameType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createNCNameTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(NCNameType::class)->reveal();
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
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\NonNegativeIntegerType} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createNonNegativeIntegerTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(NonNegativeIntegerType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\PositiveIntegerType} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createPositiveIntegerTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(PositiveIntegerType::class)->reveal();
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
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\TokenType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createTokenTypeDummy():ProphecySubjectInterface
    {
        return $this->prophesize(TokenType::class)->reveal();
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
