<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\SchemaElement;

/**
 * Represents a trait to assert XML Schema elements.
 * 
 * It must be used in a class that extends the {@see PHPUnit\Framework\TestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait ElementAssertTrait
{
    /**
     * Asserts that the specified "schema" element is empty.
     * 
     * @param   SchemaElement   $sut    The element to test.
     */
    public static function assertSchemaElementEmpty(SchemaElement $sut)
    {
        self::assertFalse($sut->hasAttributeFormDefault());
        self::assertFalse($sut->hasBlockDefault());
        self::assertFalse($sut->hasElementFormDefault());
        self::assertFalse($sut->hasFinalDefault());
        self::assertFalse($sut->hasId());
        self::assertFalse($sut->hasTargetNamespace());
        self::assertFalse($sut->hasVersion());
        self::assertFalse($sut->hasLang());
        self::assertSame([], $sut->getElements());
    }
}
