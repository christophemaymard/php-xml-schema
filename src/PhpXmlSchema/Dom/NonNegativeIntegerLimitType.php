<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Datatype\NonNegativeIntegerType;

/**
 * Represents the type for a non-negative integer limit.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class NonNegativeIntegerLimitType
{
    /**
     * The limit.
     * @var NonNegativeIntegerType|NULL
     */
    private $limit;
    
    /**
     * Constructor.
     * 
     * @param   NonNegativeIntegerType  $limit  The limit to set (optional)(default to NULL).
     */
    public function __construct(NonNegativeIntegerType $limit = NULL)
    {
        $this->limit = $limit;
    }
    
    /**
     * Returns the limit.
     * 
     * @return  NonNegativeIntegerType|NULL The instance of the limit if it has been set, otherwise NULL.
     */
    public function getLimit()
    {
        return $this->limit;
    }
    
    /**
     * Indicates whether the limit is unlimited.
     * 
     * @return  bool    TRUE if the limit is unlimited, otherwise FALSE.
     */
    public function isUnlimited():bool
    {
        return $this->limit === NULL;
    }
}