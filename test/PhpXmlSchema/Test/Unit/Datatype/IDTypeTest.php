<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\IDType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Datatype\IDType} 
 * class.
 * 
 * @group   type
 * @group   datatype
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class IDTypeTest extends TestCase
{
    use NCNameTypeProviderTrait;
    
    /**
     * Tests that __construct() throws an exception when the specified ID 
     * is invalid.
     * 
     * @param   string  $id The ID to test.
     * 
     * @dataProvider    getInvalidNCNameTypeValues
     */
    public function test__constructThrowsExceptionWhenIDIsInvalid(string $id)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid ID datatype.', $id));
        
        $sut = new IDType($id);
    }
    
    /**
     * Tests that __construct() stores the ID when it is valid.
     * 
     * @param   string  $id The ID to test.
     * 
     * @dataProvider    getValidNCNameTypeValues
     */
    public function test__constructStoresIDWhenItIsValid(string $id)
    {
        $sut = new IDType($id);
        self::assertSame($id, $sut->getId());
    }
}
