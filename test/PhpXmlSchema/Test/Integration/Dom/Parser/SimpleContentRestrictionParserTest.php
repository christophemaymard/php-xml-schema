<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom\Parser;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\Parser} class 
 * when the context is {@see PhpXmlSchema\Dom\ContextId::ELT_SIMPLECONTENT_RESTRICTION}.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SimpleContentRestrictionParserTest extends AbstractParserTestCase
{
    use ParseThrowsExceptionWhenAttributeValueIsInvalidTrait;
    use ParseThrowsExceptionWhenContentIsInvalidTrait;
    
    /**
     * {@inheritDoc}
     */
    protected function getContextName(): string
    {
        return 'sc_restriction';
    }
    
    /**
     * Tests that parse() processes all the namespace declarations.
     * 
     * @group   namespace
     * @group   xml
     */
    public function testParseProcessNamespaceDeclarations(): void
    {
        $sch = $this->sut->parse($this->getXs('restriction_0006.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations(
            [
                '' => 'http://example.org', 
                'foo' => 'http://example.org/foo', 
            ], 
            $res
        );
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that parse() processes "base" attribute when the prefix is 
     * absent and there is no default namespace.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @dataProvider    getValidNoNamespaceBaseAttributes
     */
    public function testParseProcessBaseAttributeWhenPrefixAbsentAndNoDefaultNamespace(
        string $fileName, 
        string $localPart
    ): void
    {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasOnlyBaseAttribute($res);
        self::assertFalse($res->getBase()->hasNamespace());
        self::assertSame($localPart, $res->getBase()->getLocalPart()->getNCName());
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that parse() processes "base" attribute.
     * 
     * @param   string      $fileName   The name of the file used for the test.
     * @param   string[]    $decls      The expected value for the namespace declarations.
     * @param   string      $namespace  The expected value for the namespace.
     * @param   string      $localPart  The expected value for the local part.
     * 
     * @group           attribute
     * @dataProvider    getValidBaseAttributes
     */
    public function testParseProcessBaseAttribute(
        string $fileName, 
        array $decls, 
        string $namespace, 
        string $localPart
    ): void
    {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations($decls, $sch);
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasOnlyBaseAttribute($res);
        self::assertSame($namespace, $res->getBase()->getNamespace()->getAnyUri());
        self::assertSame($localPart, $res->getBase()->getLocalPart()->getNCName());
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that parse() processes "id" attribute.
     * 
     * @param   string  $fileName   The name of the file used for the test.
     * @param   string  $id         The expected value for the ID.
     * 
     * @group           attribute
     * @dataProvider    getValidIdAttributes
     */
    public function testParseProcessIdAttribute(string $fileName, string $id): void
    {
        $sch = $this->sut->parse($this->getXs($fileName));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasOnlyIdAttribute($res);
        self::assertSame($id, $res->getId()->getId());
        self::assertSame([], $res->getElements());
    }
    
    /**
     * Tests that parse() processes "annotation" element.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAnnotationElement(): void
    {
        $sch = $this->sut->parse($this->getXs('annotation_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $ann = $res->getAnnotationElement();
        self::assertElementNamespaceDeclarations([], $ann);
        self::assertAnnotationElementHasNoAttribute($ann);
        self::assertSame([], $ann->getElements());
    }
    
    /**
     * Tests that parse() processes "simpleType" element (localSimpleType).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessSimpleTypeElement(): void
    {
        $sch = $this->sut->parse($this->getXs('simpleType_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res1 = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res1);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res1);
        self::assertCount(1, $res1->getElements());
        
        $st = $res1->getSimpleTypeElement();
        self::assertElementNamespaceDeclarations([], $st);
        self::assertSimpleTypeElementHasNoAttribute($st);
        self::assertCount(1, $st->getElements());
        
        $res2 = $st->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res2);
        self::assertSimpleTypeRestrictionElementHasNoAttribute($res2);
        self::assertSame([], $res2->getElements());
    }
    
    /**
     * Tests that parse() processes "minExclusive" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessMinExclusiveElement(): void
    {
        $sch = $this->sut->parse($this->getXs('minExclusive_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $minexcs = $res->getMinExclusiveElements();
        
        self::assertElementNamespaceDeclarations([], $minexcs[0]);
        self::assertMinExclusiveElementHasNoAttribute($minexcs[0]);
        self::assertSame([], $minexcs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $minexcs[1]);
        self::assertMinExclusiveElementHasNoAttribute($minexcs[1]);
        self::assertSame([], $minexcs[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "minInclusive" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessMinInclusiveElement(): void
    {
        $sch = $this->sut->parse($this->getXs('minInclusive_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $minincs = $res->getMinInclusiveElements();
        
        self::assertElementNamespaceDeclarations([], $minincs[0]);
        self::assertMinInclusiveElementHasNoAttribute($minincs[0]);
        self::assertSame([], $minincs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $minincs[1]);
        self::assertMinInclusiveElementHasNoAttribute($minincs[1]);
        self::assertSame([], $minincs[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "maxExclusive" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessMaxExclusiveElement(): void
    {
        $sch = $this->sut->parse($this->getXs('maxExclusive_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $maxexcs = $res->getMaxExclusiveElements();
        
        self::assertElementNamespaceDeclarations([], $maxexcs[0]);
        self::assertMaxExclusiveElementHasNoAttribute($maxexcs[0]);
        self::assertSame([], $maxexcs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $maxexcs[1]);
        self::assertMaxExclusiveElementHasNoAttribute($maxexcs[1]);
        self::assertSame([], $maxexcs[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "maxInclusive" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessMaxInclusiveElement(): void
    {
        $sch = $this->sut->parse($this->getXs('maxInclusive_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $maxincs = $res->getMaxInclusiveElements();
        
        self::assertElementNamespaceDeclarations([], $maxincs[0]);
        self::assertMaxInclusiveElementHasNoAttribute($maxincs[0]);
        self::assertSame([], $maxincs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $maxincs[1]);
        self::assertMaxInclusiveElementHasNoAttribute($maxincs[1]);
        self::assertSame([], $maxincs[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "totalDigits" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessTotalDigitsElement(): void
    {
        $sch = $this->sut->parse($this->getXs('totalDigits_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $tds = $res->getTotalDigitsElements();
        
        self::assertElementNamespaceDeclarations([], $tds[0]);
        self::assertTotalDigitsElementHasNoAttribute($tds[0]);
        self::assertSame([], $tds[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $tds[1]);
        self::assertTotalDigitsElementHasNoAttribute($tds[1]);
        self::assertSame([], $tds[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "fractionDigits" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessFractionDigitsElement(): void
    {
        $sch = $this->sut->parse($this->getXs('fractionDigits_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $fds = $res->getFractionDigitsElements();
        
        self::assertElementNamespaceDeclarations([], $fds[0]);
        self::assertFractionDigitsElementHasNoAttribute($fds[0]);
        self::assertSame([], $fds[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $fds[1]);
        self::assertFractionDigitsElementHasNoAttribute($fds[1]);
        self::assertSame([], $fds[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "length" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessLengthElement(): void
    {
        $sch = $this->sut->parse($this->getXs('length_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $lengths = $res->getLengthElements();
        
        self::assertElementNamespaceDeclarations([], $lengths[0]);
        self::assertLengthElementHasNoAttribute($lengths[0]);
        self::assertSame([], $lengths[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $lengths[1]);
        self::assertLengthElementHasNoAttribute($lengths[1]);
        self::assertSame([], $lengths[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "minLength" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessMinLengthElement(): void
    {
        $sch = $this->sut->parse($this->getXs('minLength_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $minls = $res->getMinLengthElements();
        
        self::assertElementNamespaceDeclarations([], $minls[0]);
        self::assertMinLengthElementHasNoAttribute($minls[0]);
        self::assertSame([], $minls[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $minls[1]);
        self::assertMinLengthElementHasNoAttribute($minls[1]);
        self::assertSame([], $minls[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "maxLength" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessMaxLengthElement(): void
    {
        $sch = $this->sut->parse($this->getXs('maxLength_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $maxls = $res->getMaxLengthElements();
        
        self::assertElementNamespaceDeclarations([], $maxls[0]);
        self::assertMaxLengthElementHasNoAttribute($maxls[0]);
        self::assertSame([], $maxls[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $maxls[1]);
        self::assertMaxLengthElementHasNoAttribute($maxls[1]);
        self::assertSame([], $maxls[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "enumeration" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessEnumerationElement(): void
    {
        $sch = $this->sut->parse($this->getXs('enumeration_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $enums = $res->getEnumerationElements();
        
        self::assertElementNamespaceDeclarations([], $enums[0]);
        self::assertEnumerationElementHasNoAttribute($enums[0]);
        self::assertSame([], $enums[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $enums[1]);
        self::assertEnumerationElementHasNoAttribute($enums[1]);
        self::assertSame([], $enums[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "whiteSpace" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessWhiteSpaceElement(): void
    {
        $sch = $this->sut->parse($this->getXs('whiteSpace_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $wps = $res->getWhiteSpaceElements();
        
        self::assertElementNamespaceDeclarations([], $wps[0]);
        self::assertWhiteSpaceElementHasNoAttribute($wps[0]);
        self::assertSame([], $wps[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $wps[1]);
        self::assertWhiteSpaceElementHasNoAttribute($wps[1]);
        self::assertSame([], $wps[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "pattern" elements.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessPatternElement(): void
    {
        $sch = $this->sut->parse($this->getXs('pattern_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $pats = $res->getPatternElements();
        
        self::assertElementNamespaceDeclarations([], $pats[0]);
        self::assertPatternElementHasNoAttribute($pats[0]);
        self::assertSame([], $pats[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $pats[1]);
        self::assertPatternElementHasNoAttribute($pats[1]);
        self::assertSame([], $pats[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "attribute" elements (attribute).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAttributeElement(): void
    {
        $sch = $this->sut->parse($this->getXs('attribute_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $attrs = $res->getAttributeElements();
        
        self::assertElementNamespaceDeclarations([], $attrs[0]);
        self::assertAttributeElementHasNoAttribute($attrs[0]);
        self::assertSame([], $attrs[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $attrs[1]);
        self::assertAttributeElementHasNoAttribute($attrs[1]);
        self::assertSame([], $attrs[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "attributeGroup" elements 
     * (attributeGroupRef).
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAttributeGroupElement(): void
    {
        $sch = $this->sut->parse($this->getXs('attributeGroup_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(2, $res->getElements());
        
        $ags = $res->getAttributeGroupElements();
        
        self::assertElementNamespaceDeclarations([], $ags[0]);
        self::assertAttributeGroupElementHasNoAttribute($ags[0]);
        self::assertSame([], $ags[0]->getElements());
        
        self::assertElementNamespaceDeclarations([], $ags[1]);
        self::assertAttributeGroupElementHasNoAttribute($ags[1]);
        self::assertSame([], $ags[1]->getElements());
    }
    
    /**
     * Tests that parse() processes "anyAttribute" element.
     * 
     * @group   content
     * @group   element
     */
    public function testParseProcessAnyAttributeElement(): void
    {
        $sch = $this->sut->parse($this->getXs('anyAttribute_0002.xsd'));
        
        self::assertElementNamespaceDeclarations(
            [
                'xs' => 'http://www.w3.org/2001/XMLSchema', 
            ], 
            $sch
        );
        self::assertSchemaElementHasNoAttribute($sch);
        self::assertCount(1, $sch->getElements());
        
        $ct = $sch->getComplexTypeElements()[0];
        self::assertElementNamespaceDeclarations([], $ct);
        self::assertComplexTypeElementHasNoAttribute($ct);
        self::assertCount(1, $ct->getElements());
        
        $sc = $ct->getContentElement();
        self::assertElementNamespaceDeclarations([], $sc);
        self::assertSimpleContentElementHasNoAttribute($sc);
        self::assertCount(1, $sc->getElements());
        
        $res = $sc->getDerivationElement();
        self::assertElementNamespaceDeclarations([], $res);
        self::assertSimpleContentRestrictionElementHasNoAttribute($res);
        self::assertCount(1, $res->getElements());
        
        $anyAttr = $res->getAnyAttributeElement();
        self::assertElementNamespaceDeclarations([], $anyAttr);
        self::assertAnyAttributeElementHasNoAttribute($anyAttr);
        self::assertSame([], $anyAttr->getElements());
    }
    
    /**
     * Returns a set of valid "base" attributes with no prefix and no default 
     * namespace.
     * 
     * @return  array[]
     */
    public function getValidNoNamespaceBaseAttributes(): array
    {
        return [
            'Local part starts with _' => [
                'restriction_base_0001.xsd', 
                '_foo', 
            ], 
            'Local part starts with letter' => [
                'restriction_base_0002.xsd', 
                'f', 
            ], 
            'Local part contains letter' => [
                'restriction_base_0003.xsd', 
                'foo', 
            ], 
            'Local part contains digit' => [
                'restriction_base_0004.xsd', 
                'f00', 
            ], 
            'Local part contains .' => [
                'restriction_base_0005.xsd', 
                'f.bar', 
            ], 
            'Local part contains -' => [
                'restriction_base_0006.xsd', 
                'f-bar', 
            ], 
            'Local part contains _' => [
                'restriction_base_0007.xsd', 
                'f_bar', 
            ], 
            'Local part surrounded by white spaces' => [
                'restriction_base_0008.xsd', 
                'foo_bar', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "base" attributes.
     * 
     * @return  array[]
     */
    public function getValidBaseAttributes(): array
    {
        return [
            'Prefix (absent) and bound to default namespace' => [
                'restriction_base_0009.xsd', 
                [
                    '' => 'http://example.org', 
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                ], 
                'http://example.org', 
                'foo', 
            ], 
            'Prefix and local part (starts with _)' => [
                'restriction_base_0010.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                '_foo', 
            ], 
            'Prefix and local part (starts with letter)' => [
                'restriction_base_0011.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f', 
            ], 
            'Prefix and local part (contains letter)' => [
                'restriction_base_0012.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'foo', 
            ], 
            'Prefix and local part (contains digit)' => [
                'restriction_base_0013.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f00', 
            ], 
            'Prefix and local part (contains .)' => [
                'restriction_base_0014.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f.bar', 
            ], 
            'Prefix and local part (contains -)' => [
                'restriction_base_0015.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f-bar', 
            ], 
            'Prefix and local part (contains _)' => [
                'restriction_base_0016.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'baz' => 'http://example.org/baz', 
                ], 
                'http://example.org/baz', 
                'f_bar', 
            ], 
            'Prefix (starts with _) and local part' => [
                'restriction_base_0017.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    '_foo' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (starts with letter) and local part' => [
                'restriction_base_0018.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains letter) and local part' => [
                'restriction_base_0019.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'foo' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains digit) and local part' => [
                'restriction_base_0020.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f00' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains .) and local part' => [
                'restriction_base_0021.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f.bar' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains -) and local part' => [
                'restriction_base_0022.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f-bar' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
            'Prefix (contains _) and local part' => [
                'restriction_base_0023.xsd', 
                [
                    'xs' => 'http://www.w3.org/2001/XMLSchema', 
                    'f_bar' => 'http://example.org', 
                ], 
                'http://example.org', 
                'baz', 
            ], 
        ];
    }
    
    /**
     * Returns a set of valid "id" attributes.
     * 
     * @return  array[]
     */
    public function getValidIdAttributes(): array
    {
        return [
            'Starts with _' => [
                'restriction_id_0001.xsd', '_foo', 
            ], 
            'Starts with letter' => [
                'restriction_id_0002.xsd', 'f', 
            ], 
            'Contains letter' => [
                'restriction_id_0003.xsd', 'foo', 
            ], 
            'Contains digit' => [
                'restriction_id_0004.xsd', 'f00', 
            ], 
            'Contains .' => [
                'restriction_id_0005.xsd', 'f.bar', 
            ], 
            'Contains -' => [
                'restriction_id_0006.xsd', 'f-bar', 
            ], 
            'Contains _' => [
                'restriction_id_0007.xsd', 'f_bar', 
            ], 
            'Surrounded by whitespaces' => [
                'restriction_id_0008.xsd', 'foo_bar', 
            ], 
        ];
    }
}
