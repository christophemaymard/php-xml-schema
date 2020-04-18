<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Datatype;

use PhpXmlSchema\Datatype\AnyUriType;
use PhpXmlSchema\Datatype\IDType;
use PhpXmlSchema\Datatype\LanguageType;
use PhpXmlSchema\Datatype\NCNameType;
use PhpXmlSchema\Datatype\NonNegativeIntegerType;
use PhpXmlSchema\Datatype\PositiveIntegerType;
use PhpXmlSchema\Datatype\QNameType;
use PhpXmlSchema\Datatype\StringType;
use PhpXmlSchema\Datatype\TokenType;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents a factory of datatype dummies.
 * 
 * It must be used in a class that extends the {@see PHPUnit\Framework\TestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait DatatypeDummyFactoryTrait
{
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\AnyUriType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAnyUriTypeDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(AnyUriType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\IDType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createIDTypeDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(IDType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\LanguageType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createLanguageTypeDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(LanguageType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\NCNameType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createNCNameTypeDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(NCNameType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\NonNegativeIntegerType} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createNonNegativeIntegerTypeDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(NonNegativeIntegerType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\PositiveIntegerType} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createPositiveIntegerTypeDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(PositiveIntegerType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\QNameType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createQNameTypeDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(QNameType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\StringType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createStringTypeDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(StringType::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Datatype\TokenType} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createTokenTypeDummy(): ProphecySubjectInterface
    {
        return $this->prophesize(TokenType::class)->reveal();
    }
}
