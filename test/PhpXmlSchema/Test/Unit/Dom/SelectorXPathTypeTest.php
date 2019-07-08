<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\SelectorXPathType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SelectorXPathType} 
 * class.
 * 
 * @group   type
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SelectorXPathTypeTest extends TestCase
{
    /**
     * Returns a set of valid "Step" values.
     * 
     * @param   string  $suffix
     * @return  array[]
     */
    private static function getValidStepValues(string $suffix):array
    {
        return [
            // Step '.'.
            '.' => [
                '.',
            ],
            
            // Nametests.
            
            'QName' => [
                'q'.$suffix.':name'.$suffix,
            ],
            '*' => [
                '*',
            ],
            'NCName:*' => [
                'n'.$suffix.':*',
            ],
            
            // Nametests with child axis.
            
            'child::QName' => [
                'child::q'.$suffix.':name'.$suffix,
            ],
            'child::*' => [
                'child::*',
            ],
            'child::NCName:*' => [
                'child::n'.$suffix.':*',
            ],
            
        ];
    }
    
    /**
     * Tests that __construct() stores the expression when it is valid.
     * 
     * @param   string  $expr   The expression to test.
     * 
     * @dataProvider    getValidValues
     */
    public function test__constructStoresExpressionWhenItIsValid(string $expr)
    {
        $sut =  new SelectorXPathType($expr);
        self::assertSame($expr, $sut->getXPath());
    }
    
    /**
     * Tests that __construct() throws an exception when the specified 
     * expression is invalid.
     * 
     * @param   string  $expr   The expression to test.
     * 
     * @dataProvider    getInvalidValues
     */
    public function test__constructThrowsExceptionWhenExpressionIsInvalid(string $expr)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            \sprintf('"%s" is an invalid XPath expression for a "selector" element.', $expr)
        );
        $sut = new SelectorXPathType($expr);
    }
    
    /**
     * Returns a set of valid XPath values.
     * 
     * @return  array[]
     */
    public function getValidValues():array
    {
        $steps1 = self::getValidStepValues('1');
        
        // 1 path (with 1 step).
        $datasets = $steps1;
        
        $steps2 = self::getValidStepValues('2');
        
        // 1 path (with 2 steps separated by '/').
        foreach ($steps1 as $name1 => $dataset1) {
            foreach ($steps2 as $name2 => $dataset2) {
                $datasets[$name1.'/'.$name2] = [ $dataset1[0].'/'.$dataset2[0], ];
            }
        }
        
        // 1 path (with 1 step) starts with './/'.
        foreach ($steps1 as $name => $dataset) {
            $datasets['.//'.$name] = [ './/'.$dataset[0], ];
        }
        
        // 1 path (with 2 steps separated by '/') starts with './/' (USELESS TESTS).
        
        // 1 path (with 1 step) and 1 path (with 1 step) separated by '|'.
        foreach ($steps1 as $name1 => $dataset1) {
            foreach ($steps2 as $name2 => $dataset2) {
                $datasets[$name1.'|'.$name2] = [ $dataset1[0].'|'.$dataset2[0], ];
            }
        }
        
        // 1 path (with 2 steps separated by '/') and 1 path (with 1 step) separated by '|' (USELESS TESTS).
        
        // 1 path (with 1 step) and 1 path (with 2 steps separated by '/') separated by '|' (USELESS TESTS).
        
        return $datasets;
    }
    
    /**
     * Returns a set of invalid XPath values.
     * 
     * @return  array[]
     */
    public function getInvalidValues():array
    {
        return [
            'Empty string' => [ '', ],
            'child::' => [ 'child::', ],
            'child::.' => [ 'child::.', ],
            './/' => [ './/', ],
            './/.//QName' => [ './/.//q1:name1', ],
            './/QName/.//QName' => [ './/q1:name1/.//q2:name2', ],
        ];
    }
}
