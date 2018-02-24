<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\AttributeGroupElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\AttributeGroupElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class AttributeGroupElementTest extends AbstractAttributeNamingElementTestCase
{
    use NameAttributeTestCaseTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new AttributeGroupElement();
    }
}
