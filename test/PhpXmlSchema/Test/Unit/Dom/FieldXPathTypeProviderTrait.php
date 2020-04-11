<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

/**
 * Represents a trait that provides datasets to unit test "field" XPath 
 * expression.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait FieldXPathTypeProviderTrait
{
    /**
     * Returns a set of valid FieldXPathType type values.
     * 
     * @return  array[]
     */
    public function getValidFieldXPathTypeValues(): array
    {
        $datasets = [];
        
        $paths1 = $this->getValidPathValues(1);
        
        // 1 Path.
        foreach ($paths1 as $name1 => $dataset1) {
            $datasets[$name1] = [ $dataset1[0], ];
        }
        
        // 1 Path starts with './/'.
        foreach ($paths1 as $name1 => $dataset1) {
            $datasets['.//'.$name1] = [ './/'.$dataset1[0], ];
        }
        
        $steps4 = $this->getValidStepValues('4');
        
        // 1 Path (with 1 Step) and 1 Path separated by '|'.
        foreach ($steps4 as $name4 => $dataset4) {
            foreach ($paths1 as $name1 => $dataset1) {
                $datasets[$name4.'|'.$name1] = [ $dataset4[0].'|'.$dataset1[0], ];
            }
        }
        
        $nameTests5 = $this->getValidNameTestValues('5');
        
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
     * Returns a set of valid "Path" values.
     * 
     * @param   int $firstSuffix
     * @return  array[]
     */
    private function getValidPathValues(int $firstSuffix): array
    {
        $datasets = [];
        $steps1 = $this->getValidStepValues((string)$firstSuffix);
        
        // 1 Path (with 1 Step).
        foreach ($steps1 as $name1 => $dataset1) {
            $datasets[$name1] = [ $dataset1[0], ];
        }
        
        $nameTests3 = $this->getValidNameTestValues((string)($firstSuffix + 2));
        
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
        
        $steps2 = $this->getValidStepValues((string)($firstSuffix + 1));
        
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
     * Returns a set of valid "Step" values.
     * 
     * @param   string  $suffix
     * @return  array[]
     */
    private function getValidStepValues(string $suffix): array
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
    private function getValidNameTestValues(string $suffix): array
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
     * Returns a set of invalid FieldXPathType type values.
     * 
     * @return  array[]
     */
    public function getInvalidFieldXPathTypeValues(): array
    {
        return [
            'Empty string' => [
                '', 
            ],
            'child::' => [
                'child::', 
            ],
            'child::.' => [
                'child::.', 
            ],
            '@' => [ 
                '@', 
            ],
            'attribute::' => [ 
                'attribute::', 
            ],
            './/' => [ 
                './/', 
                ],
            './/.//' => [ 
                './/.//', 
            ],
        ];
    }
}
