<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\AnyUriType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Datatype\AnyUriType} 
 * class.
 * 
 * @group   type
 * @group   datatype
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnyUriTypeTest extends TestCase
{
    const SEGMENT = 'azAZ09-._~%20!*\'()$&+,;=:@';
    const SEGMENT_NZ = 'azAZ09-._~%20!*\'()$&+,;=:@';
    const SEGMENT_NZ_NC = 'azAZ09-._~%20!*\'()$&+,;=@';
    
    /**
     * @var string[]
     */
    private static $schemes = [
        'f09+az-AZ.',
    ];
    
    /**
     * @var string[]
     */
    private static $userInfos = [
        'empty' => '',
        'azAZ09-._~!*\'()$&+,;=:%0a',
    ];
    
    /**
     * @var string[]
     */
    private static $hosts = [
        'empty' => '',
        'reg-name' => 'example.com',
    ];
    
    /**
     * @var string[]
     */
    private static $ports = [
        'empty' => '',
        '0123456789',
    ];
    
    /**
     * @var string[]
     */
    private static $absoluteEmptyPaths = [
        'path-abempty empty' => '',
        'path-abempty with 1 empty segment' => '/',
        'path-abempty with 1 segment' => '/'.self::SEGMENT,
        'path-abempty with 1 segment and 1 empty segment' => '/'.self::SEGMENT.'/',
        'path-abempty with 2 segment' => '/'.self::SEGMENT.'/'.self::SEGMENT,
        'path-abempty with 1 segment, 1 empty segment and 1 segment' => '/'.self::SEGMENT.'//'.self::SEGMENT,
    ];
    
    /**
     * @var string[]
     */
    private static $absolutePaths = [
        'path-absolute with no segment' => '/',
        'path-absolute with 1 segment-nz' => '/'.self::SEGMENT_NZ,
        'path-absolute with 1 segment-nz and 1 empty segment' => '/'.self::SEGMENT_NZ.'/',
        'path-absolute with 1 segment-nz and 1 segment' => '/'.self::SEGMENT_NZ.'/'.self::SEGMENT,
        'path-absolute with 1 segment-nz, 1 empty segment and 1 segment' => '/'.self::SEGMENT_NZ.'//'.self::SEGMENT,
    ];
    
    /**
     * @var string[]
     */
    private static $emptyPaths = [
        '',
    ];
    
    /**
     * @var string[]
     */
    private static $noSchemePaths = [
        'path-noscheme with 1 segment-nz-nc' => self::SEGMENT_NZ_NC,
        'path-noscheme with 1 segment-nz-nc and 1 empty segment' => self::SEGMENT_NZ_NC.'/',
        'path-noscheme with 1 segment-nz-nc and 1 segment' => self::SEGMENT_NZ_NC.'/'.self::SEGMENT,
        'path-noscheme with 1 segment-nz-nc, 1 empty segment and 1 segment' => self::SEGMENT_NZ_NC.'//'.self::SEGMENT,
    ];
    
    /**
     * @var string[]
     */
    private static $rootLessPaths = [
        'path-rootless with 1 segment-nz' => self::SEGMENT_NZ,
        'path-rootless with 1 segment-nz and 1 empty segment' => self::SEGMENT_NZ.'/',
        'path-rootless with 1 segment-nz and 1 segment' => self::SEGMENT_NZ.'/'.self::SEGMENT,
    ];
    
    /**
     * @var string[]
     */
    private static $queries = [
        'empty' => '',
        'azAZ09-._~%20!*\'()$&+,;=:@/?',
    ];
    
    /**
     * @var string[]
     */
    private static $fragments = [
        'empty' => '',
        'azAZ09-._~%20!*\'()$&+,;=:@/?',
    ];
    
    /**
     * Tests that __construct() throws an exception when the specified value 
     * is invalid.
     * 
     * @param   string  $value      The value to test.
     * @param   string  $message    The expected message.
     * 
     * @dataProvider    getInvalidUris
     */
    public function test__constructThrowsExceptionWhenValueIsInvalid(
        string $value, 
        string $message
    ) {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage($message);
        $sut = new AnyUriType($value);
    }
    
    /**
     * Tests that __construct() stores the URI when it is valid.
     * 
     * @param   string  $uri    The URI to test.
     * 
     * @dataProvider    getValidUris
     */
    public function test__constructStoresUriWhenItIsValid(string $uri)
    {
        $sut = new AnyUriType($uri);
        self::assertSame($uri, $sut->getUri());
    }
    
    /**
     * Tests that __construct() parses the value into URI components when it 
     * is valid.
     * 
     * @param   string      $uri        The URI to test
     * @param   string|NULL $scheme     The expected scheme.
     * @param   string|NULL $authority  The expected authority.
     * @param   string|NULL $userInfo   The expected userInfo.
     * @param   string|NULL $host       The expected host.
     * @param   string|NULL $port       The expected port.
     * @param   string|NULL $path       The expected path.
     * @param   string|NULL $query      The expected query.
     * @param   string|NULL $fragment   The expected fragment.
     * 
     * @dataProvider    getValidUriComponents
     */
    public function test__constructParsesUriIntoComponentsWhenItIsValid(
        string $uri, 
        $scheme, 
        $authority, 
        $userInfo, 
        $host, 
        $port, 
        $path, 
        $query, 
        $fragment
    ) {
        $sut = new AnyUriType($uri);
        self::assertSame($scheme, $sut->getScheme(), 'Scheme component.');
        self::assertSame($authority, $sut->getAuthority(), 'Authority component.');
        self::assertSame($userInfo, $sut->getUserInfo(), 'User information subcomponent.');
        self::assertSame($host, $sut->getHost(), 'Host subcomponent.');
        self::assertSame($port, $sut->getPort(), 'Port subcomponent.');
        self::assertSame($path, $sut->getPath(), 'Path component.');
        self::assertSame($query, $sut->getQuery(), 'Query component.');
        self::assertSame($fragment, $sut->getFragment(), 'Fragment component.');
    }
    
    /**
     * Returns a set of datasets of invalid URIs.
     * 
     * A dataset is an indexed array where:
     * - the 1st value is the URI or relative reference to test
     * - the 2nd value is the expected message in the exception
     * 
     * @return  array[]
     */
    public function getInvalidUris():array
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
    
    /**
     * Returns a set of datasets of valid URIs.
     * 
     * A dataset is an indexed array where:
     * - the 1st value is an URI or a relative URI to test
     * 
     * @return  array[]
     */
    public function getValidUris():array
    {
        $datasets = [];
        
        foreach ($this->getValidUriComponents() as $name => $values) {
            $datasets[$name] = [ $values[0], ];
        }
        
        return $datasets;
    }
    
    /**
     * Returns a set of datasets of valid URI components.
     * 
     * @return  array[]
     */
    public function getValidUriComponents():array
    {
        $schemes = \array_merge([ NULL, ], self::$schemes);
        $userInfos = \array_merge([ NULL, ], self::$userInfos);
        $ports = \array_merge([ NULL, ], self::$ports);
        
        return \array_merge(
            // "//" authority path-abempty [ "?" query ] [ "#" fragment ]
            // scheme ":" "//" authority path-abempty [ "?" query ] [ "#" fragment ]
            $this->computeComponentDatasets($schemes, $userInfos, self::$hosts, $ports, self::$absoluteEmptyPaths),
            // path-absolute [ "?" query ] [ "#" fragment ]
            // scheme ":" path-absolute [ "?" query ] [ "#" fragment ]
            $this->computeComponentDatasets($schemes, [NULL], [NULL], [NULL], self::$absolutePaths),
            // path-empty [ "?" query ] [ "#" fragment ]
            // scheme ":" path-empty [ "?" query ] [ "#" fragment ]
            $this->computeComponentDatasets($schemes, [NULL], [NULL], [NULL], self::$emptyPaths),
            // path-noscheme [ "?" query ] [ "#" fragment ]
            $this->computeComponentDatasets([ NULL], [NULL], [NULL], [NULL], self::$noSchemePaths),
            // scheme ":" path-rootless [ "?" query ] [ "#" fragment ]
            $this->computeComponentDatasets(self::$schemes, [NULL], [NULL], [NULL], self::$rootLessPaths)
        );
    }
    
    /**
     * 
     * @param   (string|NULL)[] $schemes
     * @param   (string|NULL)[] $userInfos
     * @param   (string|NULL)[] $hosts
     * @param   (string|NULL)[] $ports
     * @param   string[]        $paths
     * @return  array[]
     */
    private function computeComponentDatasets(
        array $schemes, 
        array $userInfos,
        array $hosts,
        array $ports,
        array $paths
    ):array {
        $datasets =[];
        
        $queries = \array_merge([ NULL, ], self::$queries);
        $fragments = \array_merge([ NULL, ], self::$fragments);
        
        foreach ($ports as $oDesc => $port) {
            foreach ($hosts as $hDesc => $host) {
                foreach ($userInfos as $uDesc => $userInfo) {
                    foreach ($paths as $aDesc => $path) {
                        foreach ($queries as $qDesc => $query) {
                            foreach ($fragments as $fDesc => $fragment) {
                                foreach ($schemes as $scheme) {
                                    $builder = new AnyUriTypeComponentBuilder();
                                    
                                    if ($scheme !== NULL) {
                                        $builder->setScheme($scheme);
                                    }
                                    
                                    if ($userInfo !== NULL) {
                                        $builder->setUserInfo($userInfo);
                                        
                                        if (\is_string($uDesc)) {
                                            $builder->setUserInfoComment($uDesc);
                                        }
                                    }
                                    
                                    if ($host !== NULL) {
                                        $builder->setHost($host);
                                        
                                        if (\is_string($hDesc)) {
                                            $builder->setHostComment($hDesc);
                                        }
                                    }
                                    
                                    if ($port !== NULL) {
                                        $builder->setPort($port);
                                        
                                        if (\is_string($oDesc)) {
                                            $builder->setPortComment($oDesc);
                                        }
                                    }
                                    
                                    $builder->setPath($path);
                                    $builder->setPathComment($aDesc);
                                    
                                    if ($query !== NULL) {
                                        $builder->setQuery($query);
                                        
                                        if (\is_string($qDesc)) {
                                            $builder->setQueryComment($qDesc);
                                        }
                                    }
                                    
                                    if ($fragment !== NULL) {
                                        $builder->setFragment($fragment);
                                        
                                        if (\is_string($fDesc)) {
                                            $builder->setFragmentComment($fDesc);
                                        }
                                    }
                                    
                                    $datasets[$builder->getName()] = $builder->getComponents();
                                }
                            }
                        }
                    }
                }
            }
        }
        
        return $datasets;
    }
}
