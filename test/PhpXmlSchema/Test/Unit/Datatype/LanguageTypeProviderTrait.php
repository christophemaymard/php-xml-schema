<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

/**
 * Represents a trait that provides datasets to unit test "language" datatype.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait LanguageTypeProviderTrait
{
    /**
     * Returns a set of valid "language" datatype values.
     * 
     * @return  array[]
     */
    public function getValidLanguageTypeValues(): array
    {
        return [
            'Primary subtag of 1 character' => [
                'f', 
                'f', 
                [], 
            ], 
            'Primary subtag of 8 characters' => [
                'foobarba', 
                'foobarba', 
                [], 
            ], 
            'Subtag of 1 character' => [
                'foo-b', 
                'foo', 
                [ 'b', ], 
            ], 
            'Subtag with number' => [
                'foo-bar1', 
                'foo', 
                [ 'bar1', ], 
            ], 
            'Language with white spaces' => [
                '    foo-bar1-baz2-qux3    ', 
                'foo', 
                [ 'bar1', 'baz2', 'qux3', ], 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid "language" datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidLanguageTypeValues(): array
    {
        return [
            'Empty string' => [
                '', 
                '"" is an invalid primary subtag.', 
            ], 
            'Only white spaces' => [
                '       ', 
                '"" is an invalid primary subtag.', 
            ], 
            'Primary subtag contains number' => [ 
                'foo9', 
                '"foo9" is an invalid primary subtag.', 
            ], 
            'Primary subtag contains invalid character' => [ 
                'foo+', 
                '"foo+" is an invalid primary subtag.', 
            ], 
            'Primary subtag length is greater than 8' => [ 
                'verylongp', 
                '"verylongp" is an invalid primary subtag.', 
            ], 
            'Subtag contains invalid character' => [ 
                'foo-bar1-baz+', 
                '"baz+" is an invalid subtag.', 
            ], 
            'Subtag length is greater than 8' => [ 
                'foo-bar1-verylongs', 
                '"verylongs" is an invalid subtag.', 
            ], 
        ];
    }
}