<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

/**
 * Represents the type for a form.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class FormType
{
    /**
     * Required to be qualified with a namespace prefix.
     */
    private const QUALIFIED = 1;
    
    /**
     * Not required to be qualified with a namespace prefix.
     */
    private const UNQUALIFIED = 2;
    
    /**
     * The form.
     * @var int
     */
    private $form;
    
    /**
     * Creates a "qualified" form.
     * 
     * @return  FormType    A new instance of FormType.
     */
    public static function createQualified(): self
    {
        $type = new self();
        $type->form = self::QUALIFIED;
        
        return $type;
    }
    
    /**
     * Creates an "unqualified" form.
     * 
     * @return  FormType    A new instance of FormType.
     */
    public static function createUnqualified(): self
    {
        $type = new self();
        $type->form = self::UNQUALIFIED;
        
        return $type;
    }
    
    /**
     * Private constructor.
     */
    private function __construct()
    {
    }
    
    /**
     * Indicates whether the form is "qualified".
     * 
     * @return  bool    TRUE if the form is "qualified", otherwise FALSE.
     */
    public function isQualified(): bool
    {
        return $this->form == self::QUALIFIED;
    }
    
    /**
     * Indicates whether the form is "unqualified".
     * 
     * @return  bool    TRUE if the form is "unqualified", otherwise FALSE.
     */
    public function isUnqualified(): bool
    {
        return $this->form == self::UNQUALIFIED;
    }
}
