<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Dom;

/**
 * Represents a trait that provides datasets to unit test "namespaceList" 
 * type.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait NamespaceListTypeProviderTrait
{
    /**
     * Returns a set of valid "namespaceList" values.
     * 
     * @return  array[]
     */
    public function getValidNamespaceListTypeValues(): array
    {
        // [ $value, $any, $other, $targetNamespace, $local, $uris, ]
        return [
            'Empty string' => [
                '', 
                FALSE, 
                FALSE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            'Only white spaces' => [
                '       ', 
                FALSE, 
                FALSE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            '##any' => [
                '##any', 
                TRUE, 
                FALSE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            '##other' => [
                '##other', 
                FALSE, 
                TRUE, 
                FALSE, 
                FALSE, 
                [], 
            ], 
            '##targetNamespace' => [
                '##targetNamespace', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [], 
            ],
            '##targetNamespace surrounded by white spaces' => [
                "  \r \n  ##targetNamespace  \t  ", 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [], 
            ],
            'Duplicated ##targetNamespace' => [
                '##targetNamespace ##targetNamespace', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [], 
            ],
            '##local' => [
                '##local', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [], 
            ], 
            '##local surrounded by white spaces' => [
                "   \t  \n    ##local  \r  ", 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [], 
            ], 
            'Duplicated ##local' => [
                '##local ##local', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [], 
            ], 
            '##targetNamespace and ##local' => [
                '##targetNamespace ##local', 
                FALSE, 
                FALSE, 
                TRUE, 
                TRUE, 
                [], 
            ], 
            '##targetNamespace and 1 anyURI' => [
                '##targetNamespace http://example.org/foo', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [ 
                    'http://example.org/foo', 
                ], 
            ], 
            '##local and 1 anyURI' => [
                '##local http://example.org/foo', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [ 
                    'http://example.org/foo', 
                ], 
            ], 
            '##targetNamespace and 2 anyURI' => [
                'http://example.org/foo ##targetNamespace http://example.org/bar', 
                FALSE, 
                FALSE, 
                TRUE, 
                FALSE, 
                [ 
                    'http://example.org/foo', 
                    'http://example.org/bar', 
                ], 
            ], 
            '##local and 2 anyURI' => [
                'http://example.org/foo ##local http://example.org/bar', 
                FALSE, 
                FALSE, 
                FALSE, 
                TRUE, 
                [ 
                    'http://example.org/foo', 
                    'http://example.org/bar', 
                ], 
            ], 
            '##targetNamespace, ##local and 2 AnyURI' => [
                'http://example.org/foo ##local http://example.org/bar ##targetNamespace', 
                FALSE, 
                FALSE, 
                TRUE, 
                TRUE, 
                [ 
                    'http://example.org/foo', 
                    'http://example.org/bar', 
                ], 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid "namespaceList" values.
     * 
     * @return  array[]
     */
    public function getInvalidNamespaceListTypeValues(): array
    {
        return [
            '##any surrounded by white spaces' => [
                "   \t \r  ##any   \n  ", 
            ], 
            '##other surrounded by white spaces' => [
                "  \r \n  ##other  \t  ", 
            ], 
            '##any and ##other' => [
                '##any ##other', 
            ], 
            '##any and ##targetNamespace' => [
                '##any ##targetNamespace', 
            ], 
            '##any and ##local' => [
                '##any ##local', 
            ], 
            '##other and ##targetNamespace' => [
                '##other ##targetNamespace', 
            ], 
            '##other and ##local' => [
                '##other ##local', 
            ], 
            '##any and 1 anyURI' => [
                '##any http://example.org/foo', 
            ], 
            '##other and 1 anyURI' => [
                '##other http://example.org/foo', 
            ], 
        ];
    }
}
