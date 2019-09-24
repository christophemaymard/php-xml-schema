<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom\SchemaElementBuilder;

use PhpXmlSchema\Dom\SchemaElement;
use PhpXmlSchema\Dom\SchemaElementBuilder;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SchemaElementBuilder} 
 * class when the current element is the "sequence" element 
 * (simpleExplicitGroup).
 * 
 * @group   element
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleSequenceSchemaElementBuilderTest extends AbstractSequenceSchemaElementBuilderTestCase
{
    use BuildMaxOccursAttributeDoesNotCreateAttributeTestTrait;
    use BuildMinOccursAttributeDoesNotCreateAttributeTestTrait;
    
    /**
     * {@inheritDoc}
     */
    public static function assertAncestorsNotChanged(SchemaElement $sch)
    {
        self::assertElementNamespaceDeclarations([], $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $grp = $sch->getGroupElements()[0];
        self::assertElementNamespaceDeclarations([], $grp);
        self::assertGroupElementHasNoAttribute($grp);
        self::assertCount(1, $grp->getElements());
        self::assertNotNull($grp->getModelGroupElement());
    }
    
    /**
     * {@inheritDoc}
     */
    protected static function getCurrentElement(SchemaElement $sch)
    {
        return $sch->getGroupElements()[0]
            ->getModelGroupElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        $this->sut = new SchemaElementBuilder();
        $this->sut->buildGroupElement();
        $this->sut->buildSequenceElement();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        $this->sut = NULL;
    }
}
