<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PhpXmlSchema\Dom\AnnotationElement;
use PhpXmlSchema\Dom\AppInfoElement;
use PhpXmlSchema\Dom\DocumentationElement;
use PhpXmlSchema\Dom\ImportElement;
use PhpXmlSchema\Dom\IncludeElement;
use PhpXmlSchema\Dom\RedefineElement;
use Prophecy\Prophecy\ProphecySubjectInterface;

/**
 * Represents the base class for all the composite element test cases.
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractCompositeElementTestCase extends AbstractElementTestCase
{
    /**
     * Tests that getElements() returns an empty array when no element has 
     * been added.
     * 
     * @group   elt-content
     */
    public function testGetElementsReturnsEmptyArrayWhenNoElementHasBeenAdded()
    {
        self::assertSame([], $this->sut->getElements(), 'No element has been added.');
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\AnnotationElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAnnotationElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(AnnotationElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\AppInfoElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createAppInfoElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(AppInfoElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\DocumentationElement} 
     * class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createDocumentationElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(DocumentationElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\ImportElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createImportElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(ImportElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\IncludeElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createIncludeElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(IncludeElement::class)->reveal();
    }
    
    /**
     * Creates a dummy for the {@see PhpXmlSchema\Dom\RedefineElement} class.
     * 
     * @return  ProphecySubjectInterface
     */
    protected function createRedefineElementDummy():ProphecySubjectInterface
    {
        return $this->prophesize(RedefineElement::class)->reveal();
    }
}
