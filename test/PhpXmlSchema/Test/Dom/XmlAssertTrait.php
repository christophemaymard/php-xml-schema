<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Dom;

/**
 * Represents a trait to assert concepts related to XML.
 * 
 * It must be used in a class that extends the {@see PHPUnit\Framework\TestCase} 
 * class.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait XmlAssertTrait
{
    /**
     * Asserts the specified namespace declarations.
     * 
     * @param   string[]    $expected   The expected declarations (an associative array where the key is the prefix and the value is the namespace).
     * @param   array       $decls      The declarations to assert.
     */
    public static function assertNamespaceDeclarations(array $expected, array $decls): void
    {
        self::assertCount(\count($expected), $decls);
        
        foreach ($expected as $prefix => $ns) {
            self::assertTrue(\array_key_exists($prefix, $decls));
            self::assertSame($ns, $decls[$prefix]);
        }
    }
}
