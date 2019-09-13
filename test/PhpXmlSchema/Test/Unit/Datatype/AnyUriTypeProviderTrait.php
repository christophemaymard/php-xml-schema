<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

/**
 * Represents a trait that provides datasets to unit test "anyURI" datatype.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
trait AnyUriTypeProviderTrait
{
    /**
     * Returns a set of valid "anyURI" datatype values.
     * 
     * @return  array[]
     */
    public function getValidAnyUriTypeValues():array
    {
        return [
            'http://example.org' => [ 
                'http://example.org', 
                'http://example.org', 
            ],
        ];
    }
    
    /**
     * Returns a set of valid "anyURI" datatype values (with white spaces).
     * 
     * @return  array[]
     */
    public function getValidAnyUriTypeWSValues():array
    {
        return [
            '  http://example.org  ' => [ 
                '  http://example.org  ', 
                'http://example.org', 
            ],
        ];
    }
    
    /**
     * Returns a set of invalid "anyURI" datatype values.
     * 
     * @return  array[]
     */
    public function getInvalidAnyUriTypeValues():array
    {
        return [
            // Scheme.
            'URI: scheme is empty' => [
                ':', 
                '"" is an invalid scheme.', 
            ],
            'URI: scheme does not start with an alpha' => [
                '1:', 
                '"1" is an invalid scheme.', 
            ],
            'URI: scheme contains invalid character' => [
                'f@:', 
                '"f@" is an invalid scheme.', 
            ],
            // Authority: User info.
            'Relative URI: user info contains invalid character' => [
                '//[@', 
                '"[" is an invalid user information.', 
            ],
            'URI: user info contains invalid character' => [
                'foo://]@', 
                '"]" is an invalid user information.', 
            ],
            // Authority: Host (reg-name).
            'Relative URI: reg-name host contains invalid character' => [
                '//example[.com', 
                '"example[.com" is an invalid host.', 
            ],
            'URI: reg-name host contains invalid character' => [
                'foo://example].com', 
                '"example].com" is an invalid host.', 
            ],
            // Authority: Port.
            'Relative URI: port contains invalid character' => [
                '//example.com:foo', 
                '"foo" is an invalid port.', 
            ],
            'URI: port contains invalid character' => [
                'foo://example.com:bar', 
                '"bar" is an invalid port.', 
            ],
            // Path (path-abempty).
            'Relative URI: path-abempty with 1 segment contains 1 segment with invalid character' => [
                '//example.com/]', 
                '"/]" is an invalid path-abempty path.', 
            ],
            'URI: path-abempty with 1 segment contains 1 segment with invalid character' => [
                'foo://example.com/]', 
                '"/]" is an invalid path-abempty path.', 
            ],
            'Relative URI: path-abempty with 2 segment contains 1 segment with invalid character' => [
                '//example.com/foo/]', 
                '"/foo/]" is an invalid path-abempty path.', 
            ],
            'URI: path-abempty with 2 segment contains 1 segment with invalid character' => [
                'foo://example.com/bar/]', 
                '"/bar/]" is an invalid path-abempty path.', 
            ],
            // Path (path-absolute).
            'Relative URI: path-absolute with 1 segment-nz contains 1 segment-nz with invalid character' => [
                '/foo]', 
                '"/foo]" is an invalid path.', 
            ],
            'URI: path-absolute with 1 segment-nz contains 1 segment-nz with invalid character' => [
                'foo:/bar]', 
                '"/bar]" is an invalid path.', 
            ],
            'Relative URI: path-absolute with 1 segment-nz and 1 segment contains 1 segment with invalid character' => [
                '/foo/bar]', 
                '"/foo/bar]" is an invalid path.', 
            ],
            'URI: path-absolute with 1 segment-nz and 1 segment contains 1 segment with invalid character' => [
                'foo:/bar/baz]', 
                '"/bar/baz]" is an invalid path.', 
            ],
            // Path (path-noscheme).
            'Relative URI: path-noscheme with 1 segment-nz-nc contains 1 segment-nz-nc with invalid character' => [
                'foo]', 
                '"foo]" is an invalid path.', 
            ],
            'Relative URI: path-noscheme with 1 segment-nz-nc and 1 segment contains 1 segment with invalid character' => [
                'foo/bar]', 
                '"foo/bar]" is an invalid path.', 
            ],
            // Path (path-rootless).
            'URI: path-rootless with 1 segment-nz contains 1 segment-nz with invalid character' => [
                'foo:bar]', 
                '"bar]" is an invalid path.', 
            ],
            'URI: path-rootless with 1 segment-nz and 1 segment contains 1 segment with invalid character' => [
                'foo:bar/baz]', 
                '"bar/baz]" is an invalid path.', 
            ],
            // Query.
            'Relative URI: query contains invalid character' => [
                '?[', 
                '"[" is an invalid query.', 
            ],
            'URI: query contains invalid character' => [
                'foo://?]', 
                '"]" is an invalid query.', 
            ],
            // Fragment.
            'Relative URI: fragment contains invalid character' => [
                '##', 
                '"#" is an invalid fragment.', 
            ],
            'URI: fragment contains invalid character' => [
                'foo://##', 
                '"#" is an invalid fragment.', 
            ],
        ];
    }
}
