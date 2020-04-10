<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Dom;

use PhpXmlSchema\Exception\InvalidValueException;

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
    const QUALIFIED = 1;
    
    /**
     * Not required to be qualified with a namespace prefix.
     */
    const UNQUALIFIED = 2;
    
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
    public static function createQualified():self
    {
        return new self(self::QUALIFIED);
    }
    
    /**
     * Creates an "unqualified" form.
     * 
     * @return  FormType    A new instance of FormType.
     */
    public static function createUnqualified():self
    {
        return new self(self::UNQUALIFIED);
    }
    
    /**
     * Constructor.
     * 
     * @param   int $form   The form to set.
     */
    public function __construct(int $form)
    {
        $this->setForm($form);
    }
    
    /**
     * Sets the form.
     * 
     * @param   int $form   The form to set.
     * 
     * @throws  InvalidValueException   When the form is an invalid value.
     */
    private function setForm(int $form)
    {
        if ($form != self::QUALIFIED && $form != self::UNQUALIFIED) {
            throw new InvalidValueException(\sprintf('"%s" is an invalid form.', $form));
        }
        
        $this->form = $form;
    }
    
    /**
     * Indicates whether the form is "qualified".
     * 
     * @return  bool    TRUE if the form is "qualified", otherwise FALSE.
     */
    public function isQualified():bool
    {
        return $this->form == self::QUALIFIED;
    }
    
    /**
     * Indicates whether the form is "unqualified".
     * 
     * @return  bool    TRUE if the form is "unqualified", otherwise FALSE.
     */
    public function isUnqualified():bool
    {
        return $this->form == self::UNQUALIFIED;
    }
}
