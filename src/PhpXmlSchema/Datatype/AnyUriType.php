<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Datatype;

use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the "anyURI" datatype.
 * 
 * @link    https://www.ietf.org/rfc/rfc3986.txt    RFC3986 Uniform Resource Identifier (URI): Generic Syntax (2005)
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AnyUriType
{
    /**
     * The "path-abempty" pattern.
     * 
     * path-abempty = *( "/" segment )
     */
    const PATH_ABEMPTY = '((/'.self::SEGMENT.')*)';
    
    /**
     * The "path-absolute" pattern.
     * 
     * path-absolute = "/" [ segment-nz *( "/" segment ) ]
     */
    const PATH_ABSOLUTE = '(/('.self::SEGMENT_NZ.'(/'.self::SEGMENT.')*)?)';
    
    /**
     * The "path-noscheme" pattern.
     * 
     * path-noscheme = segment-nz-nc *( "/" segment )
     */
    const PATH_NOSCHEME = '('.self::SEGMENT_NZ_NC.'(/'.self::SEGMENT.')*)';
    
    /**
     * The "path-rootless" pattern.
     * 
     * path-rootless = segment-nz *( "/" segment )
     */
    const PATH_ROOTLESS = '('.self::SEGMENT_NZ.'(/'.self::SEGMENT.')*)';
    
    /**
     * The "segment" pattern.
     * 
     * segment = *pchar
     */
    const SEGMENT = '('.self::PCHAR.'*)';
    
    /**
     * The "segment-nz" pattern.
     * 
     * segment-nz = 1*pchar
     */
    const SEGMENT_NZ = '('.self::PCHAR.'+)';
    
    /**
     * The "segment-nz-nc" pattern.
     * 
     * segment-nz-nc = 1*( unreserved / pct-encoded / sub-delims / "@" )
     */
    const SEGMENT_NZ_NC = '((['.self::UNRESERVED.self::SUB_DELIMS.'@]|'.self::PCT_ENC.')+)';
    
    /**
     * The "pchar" pattern.
     * 
     * pchar = unreserved / pct-encoded / sub-delims / ":" / "@"
     */
    const PCHAR = '(['.self::UNRESERVED.self::SUB_DELIMS.':@]|'.self::PCT_ENC.')';
    
    /**
     * The "pct-encoded" pattern.
     * 
     * pct-encoded = "%" HEXDIG HEXDIG
     */
    const PCT_ENC = '(%['.self::HEXDIG.']{2})';
    
    /**
     * The "unreserved" character class.
     * 
     * unreserved = ALPHA / DIGIT / "-" / "." / "_" / "~"
     */
    const UNRESERVED = self::ALPHA.self::DIGIT.'\\-\\._~';
    
    /**
     * The "sub-delims" character class.
     * 
     * sub-delims = "!" / "$" / "&" / "'" / "(" / ")" / "*" / "+" / "," / ";" / "="
     */
    const SUB_DELIMS = '!$&\'\\(\\)*+,;=';
    
    /**
     * The "alpha" character class.
     */
    const ALPHA = 'a-zA-Z';
    
    /**
     * The "alpha" character class.
     */
    const DIGIT = '0-9';
    
    /**
     * The "HEXDIG" character class.
     */
    const HEXDIG = '0-9a-fA-F';
    
    /**
     * The scheme component of the URI.
     * @var string|NULL
     */
    private $scheme;
    
    /**
     * The user information subcomponent of the URI.
     * @var string|NULL
     */
    private $userInfo;
    
    /**
     * The host subcomponent of the URI.
     * @var string|NULL
     */
    private $host;
    
    /**
     * The port subcomponent of the URI.
     * @var string|NULL
     */
    private $port;
    
    /**
     * The path component of the URI.
     * @var string
     */
    private $path;
    
    /**
     * The query component of the URI.
     * @var string|NULL
     */
    private $query;
    
    /**
     * The fragment component of the URI.
     * @var string|NULL
     */
    private $fragment;
    
    /**
     * Constructor.
     * 
     * @param   string  $uri    The URI to set.
     */
    public function __construct(string $uri)
    {
        $this->setUri($uri);
    }
    
    /**
     * Sets the URI.
     * 
     * @param   string  $uri    The URI to set.
     * 
     * @throws  InvalidValueException   When the value is an invalid anyURI.
     * @throws  InvalidValueException   When the path is an invalid path-abempty path.
     * @throws  InvalidValueException   When the path is invalid.
     */
    private function setUri(string $uri)
    {
        //                  12        2 1 3  4       43 5      56  7     76 8 9  98 
        if (!\preg_match('`^(([^:/?#]*):)?(//([^/?#]*))?([^?#]*)(\?([^#]*))?(#(.*))?$`', $uri, $matches)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid URI.', $uri));
        }
        
        // Scheme component.
        if ($matches[1] !== '') {
            $this->setScheme($matches[2]);
        }
        
        $path = $matches[5];
        
        if ($matches[3] !== '') {
            // Auhtority component.
            $this->setAuthority($matches[4]);
            
            // Validates the path.
            if (!\preg_match('`^'.self::PATH_ABEMPTY.'$`', $path)) {
                throw new InvalidValueException(\sprintf('"%s" is an invalid path-abempty path.', $path));
            }
        } else {
            // Validates the path.
            if (!(
                // Is it a "path-absolute" path?
                \preg_match('`^'.self::PATH_ABSOLUTE.'$`', $path) ||
                // Is it a "path-noscheme" path?
                $this->isRelative() && \preg_match('`^'.self::PATH_NOSCHEME.'$`', $path) ||
                // Is it a "path-rootless" path?
                !$this->isRelative() && \preg_match('`^'.self::PATH_ROOTLESS.'$`', $path) ||
                // Is it a "path-empty" path?
                $path === ''
            )) {
                throw new InvalidValueException(\sprintf('"%s" is an invalid path.', $path));
            }
        }
        
        // Stores the path.
        $this->path = $path;
        
        // Query component.
        if (\array_key_exists(6, $matches) && $matches[6] !== '') {
            $this->setQuery($matches[7]);
        }
        
        // Fragment component.
        if (\array_key_exists(8, $matches)) {
            $this->setFragment($matches[9]);
        }
    }
    
    /**
     * Indicates whether the URI is relative.
     * 
     * @return  bool    TRUE if the URI is relative, otherwise FALSE.
     */
    public function isRelative():bool
    {
        return $this->scheme === NULL;
    }
    
    /**
     * Returns the scheme component of the URI.
     * 
     * @return  string|NULL
     */
    public function getScheme()
    {
        return $this->scheme;
    }
    
    /**
     * Sets the scheme component of the URI.
     * 
     * @param   string  $scheme The scheme to set.
     * 
     * @throws  InvalidValueException   When the scheme is invalid.
     */
    private function setScheme(string $scheme)
    {
        if (!\preg_match('`^['.self::ALPHA.'](['.self::ALPHA.self::DIGIT.'+\\-\\.])*$`', $scheme)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid scheme.', $scheme));
        }
        
        $this->scheme = $scheme;
    }
    
    /**
     * Returns the authority component of the URI.
     * 
     * @return  string|NULL
     */
    public function getAuthority()
    {
        $authority = NULL;
        
        if ($this->userInfo !== NULL || $this->host !== NULL || $this->port !== NULL) {
            $authority = '';
            
            if ($this->userInfo !== NULL) {
                $authority .= $this->userInfo.'@';
            }
            
            if ($this->host !== NULL) {
                $authority .= $this->host;
            }
            
            if ($this->port !== NULL) {
                $authority .= ':'.$this->port;
            }
        }
        
        return $authority;
    }
    
    /**
     * Sets the authority component of the URI.
     * 
     * @param   string  $authority  The authority to set.
     * 
     * @throws  InvalidValueException   When the authority is invalid.
     */
    private function setAuthority(string $authority)
    {
        if (FALSE !== $aPos = strpos($authority, '@')) {
            $this->setUserInfo(substr($authority, 0, $aPos));
            
            $authority = substr($authority, $aPos + 1);
        }
        
        if (FALSE !== $cPos = strrpos($authority, ':')) {
            $this->setPort(substr($authority, $cPos + 1));
            
            $authority = substr($authority, 0, $cPos);
        }
        
        $this->setHost($authority);
    }
    
    /**
     * Returns the user information subcomponent of the URI.
     * 
     * @return  string|NULL
     */
    public function getUserInfo()
    {
        return $this->userInfo;
    }
    
    /**
     * Sets the user information subcomponent of the URI.
     * 
     * @param   string  $userInfo   The user information to set.
     * 
     * @throws  InvalidValueException   When the user information is invalid.
     */
    private function setUserInfo(string $userInfo)
    {
        if (!\preg_match('`^(['.self::UNRESERVED.self::SUB_DELIMS.':]|'.self::PCT_ENC.')*$`', $userInfo)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid user information.', $userInfo));
        }
        
        $this->userInfo = $userInfo;
    }
    
    /**
     * Returns the host subcomponent of the URI.
     * 
     * @return  string|NULL
     */
    public function getHost()
    {
        return $this->host;
    }
    
    /**
     * Sets the host subcomponent of the URI.
     * 
     * @param   string  $host   The host to set.
     * 
     * @throws  InvalidValueException   When the host is invalid.
     */
    private function setHost(string $host)
    {
        if (!\preg_match('`^(['.self::UNRESERVED.self::SUB_DELIMS.']|'.self::PCT_ENC.')*$`', $host)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid host.', $host));
        }
        
        $this->host = $host;
    }
    
    /**
     * Returns the port subcomponent of the URI.
     * 
     * @return  string|NULL
     */
    public function getPort()
    {
        return $this->port;
    }
    
    /**
     * Sets the port subcomponent of the URI.
     * 
     * @param   string  $port   The port to set.
     * 
     * @throws  InvalidValueException   When the port is invalid.
     */
    private function setPort(string $port)
    {
        if (!\preg_match('`^['.self::DIGIT.']*$`', $port)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid port.', $port));
        }
        
        $this->port = $port;
    }
    
    /**
     * Returns the path component of the URI.
     * 
     * @return  string
     */
    public function getPath():string
    {
        return $this->path;
    }
    
    /**
     * Returns the query component of the URI.
     * 
     * @return  string|NULL
     */
    public function getQuery()
    {
        return $this->query;
    }
    
    /**
     * Sets the query component of the URI.
     * 
     * @param   string  $query  The query to set.
     * 
     * @throws  InvalidValueException   When the query is invalid.
     */
    private function setQuery(string $query)
    {
        if (!\preg_match('`^('.self::PCHAR.'|[/\\?])*$`', $query)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid query.', $query));
        }
        
        $this->query = $query;
    }
    
    /**
     * Returns the fragment component of the URI.
     * 
     * @return  string|NULL
     */
    public function getFragment()
    {
        return $this->fragment;
    }
    
    /**
     * Sets the fragment component of the URI.
     * 
     * @param   string  $fragment   The fragment to set.
     * 
     * @throws  InvalidValueException   When the fragment is invalid.
     */
    private function setFragment(string $fragment)
    {
        if (!\preg_match('`^('.self::PCHAR.'|[/\\?])*$`', $fragment)) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid fragment.', $fragment));
        }
        
        $this->fragment = $fragment;
    }
    
    /**
     * Returns the URI.
     * 
     * @return  string
     */
    public function getUri():string
    {
        $uri = '';
        
        if ($this->scheme !== NULL) {
            $uri .= $this->scheme.':';
        }
        
        if (NULL !== $authority = $this->getAuthority()) {
            $uri .= '//'.$authority;
        }
        
        // Path is always present.
        $uri .= $this->path;
        
        if ($this->query !== NULL) {
            $uri .= '?'.$this->query;
        }
        
        if ($this->fragment !== NULL) {
            $uri .= '#'.$this->fragment;
        }
        
        return $uri;
    }
}
