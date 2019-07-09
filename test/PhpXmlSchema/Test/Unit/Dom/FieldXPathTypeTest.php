<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\FieldXPathType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\FieldXPathType} 
 * class.
 * 
 * @group   type
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FieldXPathTypeTest extends TestCase
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
            '.' => [
                '.',
            ],
            'QName' => [
                'q'.$suffix.':name'.$suffix,
            ],
            '*' => [
                '*',
            ],
            'NCName:*' => [
                'n'.$suffix.':*',
            ],
        ];
    }
    
    /**
     * Returns a set of valid "NameTest" values.
     * 
     * @param   string  $suffix
     * @return  array[]
     */
    private static function getValidNameTestValues(string $suffix):array
    {
        return [
            'QName' => [
                'q'.$suffix.':name'.$suffix,
            ],
            '*' => [
                '*',
            ],
            'NCName:*' => [
                'n'.$suffix.':*',
            ],
        ];
    }
    
    /**
     * Returns a set of valid "Path" values.
     * 
     * @param   int $firstSuffix
     * @return  array[]
     */
    private static function getValidPathValues(int $firstSuffix):array
    {
        $datasets = [];
        $steps1 = self::getValidStepValues((string)$firstSuffix);
        
        // 1 Path (with 1 Step).
        foreach ($steps1 as $name1 => $dataset1) {
            $datasets[$name1] = [ $dataset1[0], ];
        }
        
        $nameTests3 = self::getValidNameTestValues((string)($firstSuffix + 2));
        
        // 1 Path (with 1 Step with child axis 'child::').
        foreach ($nameTests3 as $name1 => $dataset1) {
            $datasets['child::'.$name1] = [ 'child::'.$dataset1[0], ];
        }
        
        // 1 Path (with 1 NameTest with attribute axis '@').
        foreach ($nameTests3 as $name1 => $dataset1) {
            $datasets['@'.$name1] = [ '@'.$dataset1[0], ];
        }
        
        // 1 Path (with 1 NameTest with attribute axis 'attribute::').
        foreach ($nameTests3 as $name1 => $dataset1) {
            $datasets['attribute::'.$name1] = [ 'attribute::'.$dataset1[0], ];
        }
        
        $steps2 = self::getValidStepValues((string)($firstSuffix + 1));
        
        // 1 Path (with 2 Steps separated by '/').
        foreach ($steps1 as $name1 => $dataset1) {
            foreach ($steps2 as $name2 => $dataset2) {
                $datasets[$name1.'/'.$name2] = [ $dataset1[0].'/'.$dataset2[0], ];
            }
        }
        
        // 1 Path (with 1 Step and 1 NameTest with attribute axis separated by '/').
        foreach ($steps1 as $name1 => $dataset1) {
            foreach ($nameTests3 as $name3 => $dataset3) {
                $datasets[$name1.'/@'.$name3] = [ $dataset1[0].'/@'.$dataset3[0], ];
            }
        }
        
        // 1 Path (with 2 Steps and 1 NameTest with attribute axis separated by '/') (USELESS TESTS).
        
        return $datasets;
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
        $sut =  new FieldXPathType($expr);
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
            \sprintf('"%s" is an invalid XPath expression for a "field" element.', $expr)
        );
        $sut = new FieldXPathType($expr);
    }
    
    /**
     * Returns a set of valid XPath values.
     * 
     * @return  array[]
     */
    public function getValidValues():array
    {
        $datasets = [];
        
        $paths1 = self::getValidPathValues(1);
        
        // 1 Path.
        foreach ($paths1 as $name1 => $dataset1) {
            $datasets[$name1] = [ $dataset1[0], ];
        }
        
        // 1 Path starts with './/'.
        foreach ($paths1 as $name1 => $dataset1) {
            $datasets['.//'.$name1] = [ './/'.$dataset1[0], ];
        }
        
        $steps4 = self::getValidStepValues('4');
        
        // 1 Path (with 1 Step) and 1 Path separated by '|'.
        foreach ($steps4 as $name4 => $dataset4) {
            foreach ($paths1 as $name1 => $dataset1) {
                $datasets[$name4.'|'.$name1] = [ $dataset4[0].'|'.$dataset1[0], ];
            }
        }
        
        $nameTests5 = self::getValidNameTestValues('5');
        
        // 1 Path (with 1 NameTest with attribute axis) and 1 Path separated by '|'.
        foreach ($nameTests5 as $name5 => $dataset5) {
            foreach ($paths1 as $name1 => $dataset1) {
                $datasets['@'.$name5.'|'.$name1] = [ '@'.$dataset5[0].'|'.$dataset1[0], ];
            }
        }
        
        // 1 Path (with 1 Step) and 1 Path (that starts with './/') separated by '|'.
        foreach ($steps4 as $name4 => $dataset4) {
            foreach ($paths1 as $name1 => $dataset1) {
                $datasets[$name4.'|.//'.$name1] = [ $dataset4[0].'|.//'.$dataset1[0], ];
            }
        }
        
        // 1 Path (with 1 NameTest with attribute axis) and 1 Path (that starts with './/') separated by '|'.
        foreach ($nameTests5 as $name5 => $dataset5) {
            foreach ($paths1 as $name1 => $dataset1) {
                $datasets['@'.$name5.'|.//'.$name1] = [ '@'.$dataset5[0].'|.//'.$dataset1[0], ];
            }
        }
        
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
            '@' => [ '@', ],
            'attribute::' => [ 'attribute::', ],
            './/' => [ './/', ],
            './/.//' => [ './/.//', ],
        ];
    }
}
