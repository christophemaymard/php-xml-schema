<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\SpecificationFactory;
use PhpXmlSchema\Exception\InvalidOperationException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SpecificationFactory} 
 * class.
 * 
 * @group   specification
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SpecificationFactoryTest extends TestCase
{
    /**
     * @var SpecificationRegistryFactory
     */
    private $sut;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SpecificationFactory();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
    
    /**
     * Tests that create() throws an exception when the context ID has no 
     * initial state.
     */
    public function testCreateThrowsExceptionWhenInitialStateNotSet()
    {
        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('The specification cannot be created '.
            'because the context ID 1000 is not supported.');
        
        $this->sut->create(1000);
    }
    
    /**
     * Tests that getInitialState(), of the instance created by create(), 
     * returns an integer.
     * 
     * @param   int $cid    The context ID used to create the specification.
     * @param   int $state  The expected state.
     * 
     * @dataProvider    getInitialStates
     */
    public function testCreateGetInitialStateReturnsInt(int $cid, int $state)
    {
        $spec = $this->sut->create($cid);
        self::assertSame($state, $spec->getInitialState());
    }
    
    /**
     * Tests that getTransitionElementName(), of the instance created by 
     * create(), returns the name that is associated with a state and a 
     * symbol.
     * 
     * @param   int     $cid    The context ID used to create the specification.
     * @param   array[] $map    The expected state.
     * 
     * @dataProvider    getTransitionElementNames
     */
    public function testCreateGetTransitionElementName(int $cid, array $map)
    {
        $spec = $this->sut->create($cid);
        
        foreach ($map as $state => $symNameMap) {
            foreach ($symNameMap as $sym => $name) {
                self::assertSame($name, $spec->getTransitionElementName($state, $sym));
            }
        }
    }
    
    /**
     * Returns a set of initial states with the context IDs.
     * 
     * @return  array[]
     */
    public function getInitialStates():array
    {
        return [
            [ 0, 0, ], // ELT_ROOT
        ];
    }
    
    /**
     * Returns a set of names that are associated with a state and a symbol 
     * for each context ID.
     * 
     * @return  array[]
     */
    public function getTransitionElementNames():array
    {
        return [
            // ELT_ROOT
            [
                0, 
                [
                    0 => [
                        1 => 'schema',
                    ], 
                ], 
            ], 
        ];
    }
}
