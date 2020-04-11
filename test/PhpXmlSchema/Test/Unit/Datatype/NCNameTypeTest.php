<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\NCNameType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Datatype\NCNameType} 
 * class.
 * 
 * @group   type
 * @group   datatype
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NCNameTypeTest extends TestCase
{
    use NCNameTypeProviderTrait;
    
    /**
     * Tests that __construct() throws an exception when the specified NCName 
     * is invalid.
     * 
     * @param   string  $name   The name to test.
     * 
     * @dataProvider    getInvalidNCNameTypeValues
     */
    public function test__constructThrowsExceptionWhenNCNameIsInvalid(string $name): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid NCName datatype.', $name));
        
        $sut = new NCNameType($name);
    }
    
    /**
     * Tests that __construct() stores the NCName when it is valid.
     * 
     * @param   string  $name  The value to test.
     * 
     * @dataProvider    getValidNCNameTypeValues
     */
    public function test__constructStoresNCNameWhenItIsValid(string $name): void
    {
        $sut = new NCNameType($name);
        self::assertSame($name, $sut->getNCName());
    }
}
