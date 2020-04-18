<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom\Parser;

/**
 * Represents the unit tests for testing that parse() throws an exception 
 * when the attribute is invalid.
 * 
 * It must be used in a class that extends the {@see PhpXmlSchema\Test\Unit\Dom\Parser\AbstractParserTestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait ParseThrowsExceptionWhenAttributeValueIsInvalidTrait
{
    /**
     * Tests that parse() throws an exception when the attribute is invalid.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $exception  The expected exception class name.
     * @param   string  $message    The expected exception message.
     * 
     * @group           attribute
     * @group           parsing
     * @group           dom
     * @dataProvider    getInvalidAttributeValues
     */
    public function testParseThrowsExceptionWhenAttributeValueIsInvalid(
        string $fileName, 
        string $exception, 
        string $message
    ): void
    {
        $this->expectException($exception);
        $this->expectExceptionMessage($message);
        
        $this->sut->parse($this->getXs($fileName));
    }
    
    /**
     * Returns a set of tests related to invalid attribute.
     * 
     * @return  array[]
     */
    public function getInvalidAttributeValues(): array
    {
        return $this->createDataSets('attribute');
    }
}
