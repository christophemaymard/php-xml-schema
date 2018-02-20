<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\ImportElement;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\ImportElement} 
 * class.
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class ImportElementTest extends AbstractAnnotatedElementTestCase
{
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new ImportElement();
    }
}
