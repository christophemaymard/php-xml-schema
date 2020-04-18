<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Datatype\AnyUriType;
use PhpXmlSchema\Exception\InvalidValueException;
use PhpXmlSchema\Test\Datatype\AnyUriTypeComponentBuilder;
use PhpXmlSchema\Test\Datatype\AnyUriTypeProviderTrait;

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
    use AnyUriTypeProviderTrait;
    
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
     * @dataProvider    getInvalidAnyUriTypeValues
     */
    public function test__constructThrowsExceptionWhenValueIsInvalid(
        string $value, 
        string $message
    ): void
    {
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
    public function test__constructStoresUriWhenItIsValid(string $uri): void
    {
        $sut = new AnyUriType($uri);
        self::assertSame($uri, $sut->getAnyUri());
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
    ): void
    {
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
     * Returns a set of datasets of valid URIs.
     * 
     * A dataset is an indexed array where:
     * - the 1st value is an URI or a relative URI to test
     * 
     * @return  array[]
     */
    public function getValidUris(): array
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
    public function getValidUriComponents(): array
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
    ): array
    {
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
