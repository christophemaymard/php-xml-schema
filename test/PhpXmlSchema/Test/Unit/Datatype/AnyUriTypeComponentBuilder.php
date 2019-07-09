<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Datatype;

/**
 * Represents a builder of URI components.
 */
class AnyUriTypeComponentBuilder
{
    /**
     * The scheme component.
     * @var string|NULL
     */
    private $scheme;
    
    /**
     * The user information subcomponent.
     * @var string|NULL
     */
    private $userInfo;
    
    /**
     * The comment of the user information subcomponent.
     * @var string|NULL
     */
    private $userInfoComment;
    
    /**
     * The host subcomponent.
     * @var string|NULL
     */
    private $host;
    
    /**
     * The comment of the host subcomponent.
     * @var string|NULL
     */
    private $hostComment;
    
    /**
     * The port subcomponent.
     * @var string|NULL
     */
    private $port;
    
    /**
     * The comment of the port subcomponent.
     * @var string|NULL
     */
    private $portComment;
    
    /**
     * The path component.
     * @var string|NULL
     */
    private $path;
    
    /**
     * The comment of the path component.
     * @var string|NULL
     */
    private $pathComment;
    
    /**
     * The query component.
     * @var string|NULL
     */
    private $query;
    
    /**
     * The comment of the query component.
     * @var string|NULL
     */
    private $queryComment;
    
    /**
     * The fragment component.
     * @var string|NULL
     */
    private $fragment;
    
    /**
     * The comment of the fragment component.
     * @var string|NULL
     */
    private $fragmentComment;
    
    /**
     * Sets the scheme component.
     * 
     * @param   string  $scheme The scheme to set.
     */
    public function setScheme(string $scheme)
    {
        $this->scheme = $scheme;
    }
    
    /**
     * Sets the user-information subcomponent.
     * 
     * @param   string  $userInfo   The user-information to set.
     */
    public function setUserInfo(string $userInfo)
    {
        $this->userInfo = $userInfo;
    }
    
    /**
     * Sets the comment of the user-information subcomponent.
     * 
     * @param   string  $comment    The comment to set.
     */
    public function setUserInfoComment(string $comment)
    {
        $this->userInfoComment = $comment;
    }
    
    /**
     * Sets the host subcomponent.
     * 
     * @param   string  $host   The host to set.
     */
    public function setHost(string $host)
    {
        $this->host = $host;
    }
    
    /**
     * Sets the comment of the host subcomponent.
     * 
     * @param   string  $comment    The comment to set.
     */
    public function setHostComment(string $comment)
    {
        $this->hostComment = $comment;
    }
    
    /**
     * Sets the port subcomponent.
     * 
     * @param   string  $port   The port to set.
     */
    public function setPort(string $port)
    {
        $this->port = $port;
    }
    
    /**
     * Sets the comment of the port subcomponent.
     * 
     * @param   string  $comment    The comment to set.
     */
    public function setPortComment(string $comment)
    {
        $this->portComment = $comment;
    }
    
    /**
     * Sets the path component.
     * 
     * @param   string  $path   The path to set.
     */
    public function setPath(string $path)
    {
        $this->path = $path;
    }
    
    /**
     * Sets the comment of the path component.
     * 
     * @param   string  $comment    The comment to set.
     */
    public function setPathComment(string $comment)
    {
        $this->pathComment = $comment;
    }
    
    /**
     * Sets the query component.
     * 
     * @param   string  $query  The query to set.
     */
    public function setQuery(string $query)
    {
        $this->query = $query;
    }
    
    /**
     * Sets the comment of the query component.
     * 
     * @param   string  $comment    The comment to set.
     */
    public function setQueryComment(string $comment)
    {
        $this->queryComment = $comment;
    }
    
    /**
     * Sets the fragment component.
     * 
     * @param   string  $fragment   The fragment to set.
     */
    public function setFragment(string $fragment)
    {
        $this->fragment = $fragment;
    }
    
    /**
     * Sets the comment of the fragment component.
     * 
     * @param   string  $comment    The comment to set.
     */
    public function setFragmentComment(string $comment)
    {
        $this->fragmentComment = $comment;
    }
    
    /**
     * Returns the URI components.
     * 
     * @return  array
     */
    public function getComponents():array
    {
        return [
            $this->getUri(),
            $this->scheme,
            $this->getAuthority(),
            $this->userInfo,
            $this->host,
            $this->port,
            $this->path,
            $this->query,
            $this->fragment,
        ];
    }
    
    /**
     * Returns the name of the dataset.
     * 
     * @return  string
     */
    public function getName():string
    {
        $name = ($this->scheme === NULL) ? 'Relative URI' : 'URI';
        $name .= ': ';
        
        $comments = [];
        
        if ($this->scheme !== NULL) {
            $comments[] = 'a scheme';
        }
        
        if ($this->userInfo !== NULL || $this->host !== NULL || $this->port !== NULL) {
            if ($this->userInfo !== NULL) {
                $userInfoComment = 'an user info';
                
                if ($this->userInfoComment !== NULL) {
                    $userInfoComment .= \sprintf(' (%s)', $this->userInfoComment);
                }
                
                $comments[] = $userInfoComment;
            }
            
            if ($this->host !== NULL) {
                $hostComment = 'a host';
                
                if ($this->hostComment !== NULL) {
                    $hostComment .= \sprintf(' (%s)', $this->hostComment);
                }
                
                $comments[] = $hostComment;
            }
            
            if ($this->port !== NULL) {
                $portComment = 'a port';
                
                if ($this->portComment !== NULL) {
                    $portComment .= \sprintf(' (%s)', $this->portComment);
                }
                
                $comments[] = $portComment;
            }
        }
        
        if ($this->path !== NULL) {
            $pathComment = 'a path';
            
            if ($this->pathComment !== NULL) {
                $pathComment .= \sprintf(' (%s)', $this->pathComment);
            }
            
            $comments[] = $pathComment;
        }
        
        if ($this->query !== NULL) {
            $queryComment = 'a query';
            
            if ($this->queryComment !== NULL) {
                $queryComment .= \sprintf(' (%s)', $this->queryComment);
            }
            
            $comments[] = $queryComment;
        }
        
        if ($this->fragment !== NULL) {
            $fragmentComment = 'a fragment';
            
            if ($this->fragmentComment !== NULL) {
                $fragmentComment .= \sprintf(' (%s)', $this->fragmentComment);
            }
            
            $comments[] = $fragmentComment;
        }
        
        $name .= \implode(', ', $comments);
        
        return $name;
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
        
        if ($this->path !== NULL) {
            $uri .= $this->path;
        }
        
        if ($this->query !== NULL) {
            $uri .= '?'. $this->query;
        }
        
        if ($this->fragment !== NULL) {
            $uri .= '#'. $this->fragment;
        }
        
        return $uri;
    }
    
    /**
     * Returns the authority component.
     * 
     * @return  string|NULL
     */
    private function getAuthority()
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
}