<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\LanguageType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Datatype\LanguageType} 
 * class.
 * 
 * @group   type
 * @group   datatype
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class LanguageTypeTest extends TestCase
{
    /**
     * Tests that __construct() stores the primary subtag when it is valid 
     * and an empty array for the subtags.
     */
    public function test__constructStoresPrimarySubtagAndEmptySubtagsWhenValid(): void
    {
        $sut = new LanguageType('foo');
        self::assertSame('foo', $sut->getPrimarySubtag());
        self::assertSame([], $sut->getSubtags());
    }
    
    /**
     * Tests that __construct() stores the primary subtag and the subtags 
     * when they are valid.
     */
    public function test__constructStoresPrimarySubtagAndSubtagsWhenValid(): void
    {
        $subtags = ['bar0', 'baz9'];
        $sut = new LanguageType('foo', $subtags);
        self::assertSame('foo', $sut->getPrimarySubtag());
        self::assertSame($subtags, $sut->getSubtags());
    }
    
    /**
     * Tests that __construct() throws an exception when the specified primary 
     * subtag is invalid.
     * 
     * @param   string  $primary    The primary subtag to test.
     * 
     * @dataProvider    getInvalidPrimarySubtags
     */
    public function test__constructThrowsExceptionWhenPrimarySubtagIsInvalid(string $primary): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid primary subtag.', $primary));
        
        $sut = new LanguageType($primary);
    }
    
    /**
     * Tests that __construct() throws an exception when one of the specified  
     * subtags is invalid.
     * 
     * @param   string[]    $subtags        The subtags to test.
     * @param   string      $invalidSubtag  The invalid subtag.
     * 
     * @dataProvider    getInvalidSubtags
     */
    public function test__constructThrowsExceptionWhenOneSubtagIsInvalid(array $subtags, string $invalidSubtag): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(\sprintf('"%s" is an invalid subtag.', $invalidSubtag));
        
        $sut = new LanguageType('foo', $subtags);
    }
    
    /**
     * Tests that __construct() throws primary subtag exception first when 
     * the specified primary subtag and one of the specified subtags are 
     * invalid.
     */
    public function test__constructThrowsExceptionWhenPrimarySubtagAndSubtagInvalid(): void
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('"foo9" is an invalid primary subtag.');
        
        $sut = new LanguageType('foo9', [ 'foobarbaz' ]);
    }
    
    /**
     * Returns a set of invalid primary subtags.
     * 
     * @return  array[]
     */
    public function getInvalidPrimarySubtags(): array
    {
        return [
            'Empty string' => [ '' ],
            'Contain invalid character (number)' => [ 'foo9' ],
            'Too long' => [ 'foobarbaz' ],
        ];
    }
    
    /**
     * Returns a set of invalid subtags.
     * 
     * @return  array[]
     */
    public function getInvalidSubtags(): array
    {
        return [
            'Empty string' => [ [ '' ], '' ],
            'Contain invalid character' => [ [ 'foo_' ], 'foo_' ],
            'Too long' => [ [ 'foobarbaz' ], 'foobarbaz' ],
            'Last subtag contains invalid character' => [ [ 'foo', 'bar', 'baz_' ], 'baz_' ],
        ];
    }
}