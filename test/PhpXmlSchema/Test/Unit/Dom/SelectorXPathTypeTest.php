<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2019, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Unit\Dom;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\SelectorXPathType;
use PhpXmlSchema\Exception\InvalidValueException;

/**
 * Represents the unit tests for the {@see PhpXmlSchema\Dom\SelectorXPathType} 
 * class.
 * 
 * @group   type
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
class SelectorXPathTypeTest extends TestCase
{
    /**
     * Tests that __construct() stores the expression when it is valid.
     * 
     * @param   string  $expr   The expression to test.
     * 
     * @dataProvider    getValidValues
     */
    public function test__constructStoresExpressionWhenItIsValid(string $expr)
    {
        $sut =  new SelectorXPathType($expr);
        self::assertSame($expr, $sut->getXPath());
    }
    
    /**
     * Tests that __construct() throws an exception when the specified 
     * expression is invalid.
     * 
     * @param   string  $expr   The expression to test.
     * 
     * @dataProvider    getInvalidValues
     */
    public function test__constructThrowsExceptionWhenExpressionIsInvalid(string $expr)
    {
        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage(
            \sprintf('"%s" is an invalid XPath expression for a "selector" element.', $expr)
        );
        $sut = new SelectorXPathType($expr);
    }
    
    /**
     * Returns a set of valid XPath values.
     * 
     * @return  array[]
     */
    public function getValidValues():array
    {
        return [
            // 1 path (with 1 step).
            '1 path (1 step .)' =>[
                '.', 
            ], 
            '1 path (1 step QName)' =>[
                'q1:name1', 
            ], 
            '1 path (1 step *)' =>[
                '*', 
            ], 
            '1 path (1 step NCName:*)' =>[
                'n1:*', 
            ], 
            '1 path (1 step child::QName)' =>[
                'child::q1:name1', 
            ], 
            '1 path (1 step child::*)' =>[
                'child::*', 
            ], 
            '1 path (1 step child::NCName:*)' =>[
                'child::n1:*', 
            ], 
            // 1 path (with 2 steps separated by /).
            '1 path (1 step . and 1 step . separated by /)' =>[
                './.', 
            ], 
            '1 path (1 step . and 1 step QName separated by /)' =>[
                './q2:name2', 
            ], 
            '1 path (1 step . and 1 step * separated by /)' =>[
                './*', 
            ], 
            '1 path (1 step . and 1 step NCName:* separated by /)' =>[
                './n2:*', 
            ], 
            '1 path (1 step . and 1 step child::QName separated by /)' =>[
                './child::q2:name2', 
            ], 
            '1 path (1 step . and 1 step child::* separated by /)' =>[
                './child::*', 
            ], 
            '1 path (1 step . and 1 step child::NCName:* separated by /)' =>[
                './child::n2:*', 
            ], 
            '1 path (1 step QName and 1 step . separated by /)' =>[
                'q1:name1/.', 
            ], 
            '1 path (1 step QName and 1 step QName separated by /)' =>[
                'q1:name1/q2:name2', 
            ], 
            '1 path (1 step QName and 1 step * separated by /)' =>[
                'q1:name1/*', 
            ], 
            '1 path (1 step QName and 1 step NCName:* separated by /)' =>[
                'q1:name1/n2:*', 
            ], 
            '1 path (1 step QName and 1 step child::QName separated by /)' =>[
                'q1:name1/child::q2:name2', 
            ], 
            '1 path (1 step QName and 1 step child::* separated by /)' =>[
                'q1:name1/child::*', 
            ], 
            '1 path (1 step QName and 1 step child::NCName:* separated by /)' =>[
                'q1:name1/child::n2:*', 
            ], 
            '1 path (1 step * and 1 step . separated by /)' =>[
                '*/.', 
            ], 
            '1 path (1 step * and 1 step QName separated by /)' =>[
                '*/q2:name2', 
            ], 
            '1 path (1 step * and 1 step * separated by /)' =>[
                '*/*', 
            ], 
            '1 path (1 step * and 1 step NCName:* separated by /)' =>[
                '*/n2:*', 
            ], 
            '1 path (1 step * and 1 step child::QName separated by /)' =>[
                '*/child::q2:name2', 
            ], 
            '1 path (1 step * and 1 step child::* separated by /)' =>[
                '*/child::*', 
            ], 
            '1 path (1 step * and 1 step child::NCName:* separated by /)' =>[
                '*/child::n2:*', 
            ], 
            '1 path (1 step NCName:* and 1 step . separated by /)' =>[
                'n1:*/.', 
            ], 
            '1 path (1 step NCName:* and 1 step QName separated by /)' =>[
                'n1:*/q2:name2', 
            ], 
            '1 path (1 step NCName:* and 1 step * separated by /)' =>[
                'n1:*/*', 
            ], 
            '1 path (1 step NCName:* and 1 step NCName:* separated by /)' =>[
                'n1:*/n2:*', 
            ], 
            '1 path (1 step NCName:* and 1 step child::QName separated by /)' =>[
                'n1:*/child::q2:name2', 
            ], 
            '1 path (1 step NCName:* and 1 step child::* separated by /)' =>[
                'n1:*/child::*', 
            ], 
            '1 path (1 step NCName:* and 1 step child::NCName:* separated by /)' =>[
                'n1:*/child::n2:*', 
            ], 
            '1 path (1 step child::QName and 1 step . separated by /)' =>[
                'child::q1:name1/.', 
            ], 
            '1 path (1 step child::QName and 1 step QName separated by /)' =>[
                'child::q1:name1/q2:name2', 
            ], 
            '1 path (1 step child::QName and 1 step * separated by /)' =>[
                'child::q1:name1/*', 
            ], 
            '1 path (1 step child::QName and 1 step NCName:* separated by /)' =>[
                'child::q1:name1/n2:*', 
            ], 
            '1 path (1 step child::QName and 1 step child::QName separated by /)' =>[
                'child::q1:name1/child::q2:name2', 
            ], 
            '1 path (1 step child::QName and 1 step child::* separated by /)' =>[
                'child::q1:name1/child::*', 
            ], 
            '1 path (1 step child::QName and 1 step child::NCName:* separated by /)' =>[
                'child::q1:name1/child::n2:*', 
            ], 
            '1 path (1 step child::* and 1 step . separated by /)' =>[
                'child::*/.', 
            ], 
            '1 path (1 step child::* and 1 step QName separated by /)' =>[
                'child::*/q2:name2', 
            ], 
            '1 path (1 step child::* and 1 step * separated by /)' =>[
                'child::*/*', 
            ], 
            '1 path (1 step child::* and 1 step NCName:* separated by /)' =>[
                'child::*/n2:*', 
            ], 
            '1 path (1 step child::* and 1 step child::QName separated by /)' =>[
                'child::*/child::q2:name2', 
            ], 
            '1 path (1 step child::* and 1 step child::* separated by /)' =>[
                'child::*/child::*', 
            ], 
            '1 path (1 step child::* and 1 step child::NCName:* separated by /)' =>[
                'child::*/child::n2:*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step . separated by /)' =>[
                'child::n1:*/.', 
            ], 
            '1 path (1 step child::NCName:* and 1 step QName separated by /)' =>[
                'child::n1:*/q2:name2', 
            ], 
            '1 path (1 step child::NCName:* and 1 step * separated by /)' =>[
                'child::n1:*/*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step NCName:* separated by /)' =>[
                'child::n1:*/n2:*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step child::QName separated by /)' =>[
                'child::n1:*/child::q2:name2', 
            ], 
            '1 path (1 step child::NCName:* and 1 step child::* separated by /)' =>[
                'child::n1:*/child::*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step child::NCName:* separated by /)' =>[
                'child::n1:*/child::n2:*', 
            ], 
            // 1 path (with 1 step) starts with .//.
            '1 path (1 step .) starts with .//' =>[
                './/.', 
            ], 
            '1 path (1 step QName) starts with .//' =>[
                './/q1:name1', 
            ], 
            '1 path (1 step *) starts with .//' =>[
                './/*', 
            ], 
            '1 path (1 step NCName:*) starts with .//' =>[
                './/n1:*', 
            ], 
            '1 path (1 step child::QName) starts with .//' =>[
                './/child::q1:name1', 
            ], 
            '1 path (1 step child::*) starts with .//' =>[
                './/child::*', 
            ], 
            '1 path (1 step child::NCName:*) starts with .//' =>[
                './/child::n1:*', 
            ], 
            // 1 path (with 2 steps separated by /) starts with .//.
            '1 path (1 step . and 1 step . separated by /) starts with .//' =>[
                './/./.', 
            ], 
            '1 path (1 step . and 1 step QName separated by /) starts with .//' =>[
                './/./q2:name2', 
            ], 
            '1 path (1 step . and 1 step * separated by /) starts with .//' =>[
                './/./*', 
            ], 
            '1 path (1 step . and 1 step NCName:* separated by /) starts with .//' =>[
                './/./n2:*', 
            ], 
            '1 path (1 step . and 1 step child::QName separated by /) starts with .//' =>[
                './/./child::q2:name2', 
            ], 
            '1 path (1 step . and 1 step child::* separated by /) starts with .//' =>[
                './/./child::*', 
            ], 
            '1 path (1 step . and 1 step child::NCName:* separated by /) starts with .//' =>[
                './/./child::n2:*', 
            ], 
            '1 path (1 step QName and 1 step . separated by /) starts with .//' =>[
                './/q1:name1/.', 
            ], 
            '1 path (1 step QName and 1 step QName separated by /) starts with .//' =>[
                './/q1:name1/q2:name2', 
            ], 
            '1 path (1 step QName and 1 step * separated by /) starts with .//' =>[
                './/q1:name1/*', 
            ], 
            '1 path (1 step QName and 1 step NCName:* separated by /) starts with .//' =>[
                './/q1:name1/n2:*', 
            ], 
            '1 path (1 step QName and 1 step child::QName separated by /) starts with .//' =>[
                './/q1:name1/child::q2:name2', 
            ], 
            '1 path (1 step QName and 1 step child::* separated by /) starts with .//' =>[
                './/q1:name1/child::*', 
            ], 
            '1 path (1 step QName and 1 step child::NCName:* separated by /) starts with .//' =>[
                './/q1:name1/child::n2:*', 
            ], 
            '1 path (1 step * and 1 step . separated by /) starts with .//' =>[
                './/*/.', 
            ], 
            '1 path (1 step * and 1 step QName separated by /) starts with .//' =>[
                './/*/q2:name2', 
            ], 
            '1 path (1 step * and 1 step * separated by /) starts with .//' =>[
                './/*/*', 
            ], 
            '1 path (1 step * and 1 step NCName:* separated by /) starts with .//' =>[
                './/*/n2:*', 
            ], 
            '1 path (1 step * and 1 step child::QName separated by /) starts with .//' =>[
                './/*/child::q2:name2', 
            ], 
            '1 path (1 step * and 1 step child::* separated by /) starts with .//' =>[
                './/*/child::*', 
            ], 
            '1 path (1 step * and 1 step child::NCName:* separated by /) starts with .//' =>[
                './/*/child::n2:*', 
            ], 
            '1 path (1 step NCName:* and 1 step . separated by /) starts with .//' =>[
                './/n1:*/.', 
            ], 
            '1 path (1 step NCName:* and 1 step QName separated by /) starts with .//' =>[
                './/n1:*/q2:name2', 
            ], 
            '1 path (1 step NCName:* and 1 step * separated by /) starts with .//' =>[
                './/n1:*/*', 
            ], 
            '1 path (1 step NCName:* and 1 step NCName:* separated by /) starts with .//' =>[
                './/n1:*/n2:*', 
            ], 
            '1 path (1 step NCName:* and 1 step child::QName separated by /) starts with .//' =>[
                './/n1:*/child::q2:name2', 
            ], 
            '1 path (1 step NCName:* and 1 step child::* separated by /) starts with .//' =>[
                './/n1:*/child::*', 
            ], 
            '1 path (1 step NCName:* and 1 step child::NCName:* separated by /) starts with .//' =>[
                './/n1:*/child::n2:*', 
            ], 
            '1 path (1 step child::QName and 1 step . separated by /) starts with .//' =>[
                './/child::q1:name1/.', 
            ], 
            '1 path (1 step child::QName and 1 step QName separated by /) starts with .//' =>[
                './/child::q1:name1/q2:name2', 
            ], 
            '1 path (1 step child::QName and 1 step * separated by /) starts with .//' =>[
                './/child::q1:name1/*', 
            ], 
            '1 path (1 step child::QName and 1 step NCName:* separated by /) starts with .//' =>[
                './/child::q1:name1/n2:*', 
            ], 
            '1 path (1 step child::QName and 1 step child::QName separated by /) starts with .//' =>[
                './/child::q1:name1/child::q2:name2', 
            ], 
            '1 path (1 step child::QName and 1 step child::* separated by /) starts with .//' =>[
                './/child::q1:name1/child::*', 
            ], 
            '1 path (1 step child::QName and 1 step child::NCName:* separated by /) starts with .//' =>[
                './/child::q1:name1/child::n2:*', 
            ], 
            '1 path (1 step child::* and 1 step . separated by /) starts with .//' =>[
                './/child::*/.', 
            ], 
            '1 path (1 step child::* and 1 step QName separated by /) starts with .//' =>[
                './/child::*/q2:name2', 
            ], 
            '1 path (1 step child::* and 1 step * separated by /) starts with .//' =>[
                './/child::*/*', 
            ], 
            '1 path (1 step child::* and 1 step NCName:* separated by /) starts with .//' =>[
                './/child::*/n2:*', 
            ], 
            '1 path (1 step child::* and 1 step child::QName separated by /) starts with .//' =>[
                './/child::*/child::q2:name2', 
            ], 
            '1 path (1 step child::* and 1 step child::* separated by /) starts with .//' =>[
                './/child::*/child::*', 
            ], 
            '1 path (1 step child::* and 1 step child::NCName:* separated by /) starts with .//' =>[
                './/child::*/child::n2:*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step . separated by /) starts with .//' =>[
                './/child::n1:*/.', 
            ], 
            '1 path (1 step child::NCName:* and 1 step QName separated by /) starts with .//' =>[
                './/child::n1:*/q2:name2', 
            ], 
            '1 path (1 step child::NCName:* and 1 step * separated by /) starts with .//' =>[
                './/child::n1:*/*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step NCName:* separated by /) starts with .//' =>[
                './/child::n1:*/n2:*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step child::QName separated by /) starts with .//' =>[
                './/child::n1:*/child::q2:name2', 
            ], 
            '1 path (1 step child::NCName:* and 1 step child::* separated by /) starts with .//' =>[
                './/child::n1:*/child::*', 
            ], 
            '1 path (1 step child::NCName:* and 1 step child::NCName:* separated by /) starts with .//' =>[
                './/child::n1:*/child::n2:*', 
            ], 
            // 1 path (with 1 step) and 1 path (with 1 step) separated by |.
            '1 path (with 1 step .) and 1 path (with 1 step .) separated by |' =>[
                '.|.', 
            ], 
            '1 path (with 1 step .) and 1 path (with 1 step QName) separated by |' =>[
                '.|q2:name2', 
            ], 
            '1 path (with 1 step .) and 1 path (with 1 step *) separated by |' =>[
                '.|*', 
            ], 
            '1 path (with 1 step .) and 1 path (with 1 step NCName:*) separated by |' =>[
                '.|n2:*', 
            ], 
            '1 path (with 1 step .) and 1 path (with 1 step child::QName) separated by |' =>[
                '.|child::q2:name2', 
            ], 
            '1 path (with 1 step .) and 1 path (with 1 step child::*) separated by |' =>[
                '.|child::*', 
            ], 
            '1 path (with 1 step .) and 1 path (with 1 step child::NCName:*) separated by |' =>[
                '.|child::n2:*', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step .) separated by |' =>[
                'q1:name1|.', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step QName) separated by |' =>[
                'q1:name1|q2:name2', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step *) separated by |' =>[
                'q1:name1|*', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step NCName:*) separated by |' =>[
                'q1:name1|n2:*', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step child::QName) separated by |' =>[
                'q1:name1|child::q2:name2', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step child::*) separated by |' =>[
                'q1:name1|child::*', 
            ], 
            '1 path (with 1 step QName) and 1 path (with 1 step child::NCName:*) separated by |' =>[
                'q1:name1|child::n2:*', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step .) separated by |' =>[
                '*|.', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step QName) separated by |' =>[
                '*|q2:name2', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step *) separated by |' =>[
                '*|*', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step NCName:*) separated by |' =>[
                '*|n2:*', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step child::QName) separated by |' =>[
                '*|child::q2:name2', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step child::*) separated by |' =>[
                '*|child::*', 
            ], 
            '1 path (with 1 step *) and 1 path (with 1 step child::NCName:*) separated by |' =>[
                '*|child::n2:*', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step .) separated by |' =>[
                'n1:*|.', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step QName) separated by |' =>[
                'n1:*|q2:name2', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step *) separated by |' =>[
                'n1:*|*', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step NCName:*) separated by |' =>[
                'n1:*|n2:*', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step child::QName) separated by |' =>[
                'n1:*|child::q2:name2', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step child::*) separated by |' =>[
                'n1:*|child::*', 
            ], 
            '1 path (with 1 step NCName:*) and 1 path (with 1 step child::NCName:*) separated by |' =>[
                'n1:*|child::n2:*', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step .) separated by |' =>[
                'child::q1:name1|.', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step QName) separated by |' =>[
                'child::q1:name1|q2:name2', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step *) separated by |' =>[
                'child::q1:name1|*', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step NCName:*) separated by |' =>[
                'child::q1:name1|n2:*', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step child::QName) separated by |' =>[
                'child::q1:name1|child::q2:name2', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step child::*) separated by |' =>[
                'child::q1:name1|child::*', 
            ], 
            '1 path (with 1 step child::QName) and 1 path (with 1 step child::NCName:*) separated by |' =>[
                'child::q1:name1|child::n2:*', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step .) separated by |' =>[
                'child::*|.', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step QName) separated by |' =>[
                'child::*|q2:name2', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step *) separated by |' =>[
                'child::*|*', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step NCName:*) separated by |' =>[
                'child::*|n2:*', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step child::QName) separated by |' =>[
                'child::*|child::q2:name2', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step child::*) separated by |' =>[
                'child::*|child::*', 
            ], 
            '1 path (with 1 step child::*) and 1 path (with 1 step child::NCName:*) separated by |' =>[
                'child::*|child::n2:*', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step .) separated by |' =>[
                'child::n1:*|.', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step QName) separated by |' =>[
                'child::n1:*|q2:name2', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step *) separated by |' =>[
                'child::n1:*|*', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step NCName:*) separated by |' =>[
                'child::n1:*|n2:*', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step child::QName) separated by |' =>[
                'child::n1:*|child::q2:name2', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step child::*) separated by |' =>[
                'child::n1:*|child::*', 
            ], 
            '1 path (with 1 step child::NCName:*) and 1 path (with 1 step child::NCName:*) separated by |' =>[
                'child::n1:*|child::n2:*', 
            ], 
        ];
    }
    
    /**
     * Returns a set of invalid XPath values.
     * 
     * @return  array[]
     */
    public function getInvalidValues():array
    {
        return [
            'Empty string' => [ '', ],
            'child::' => [ 'child::', ],
            'child::.' => [ 'child::.', ],
            './/' => [ './/', ],
            './/.//QName' => [ './/.//q1:name1', ],
            './/QName/.//QName' => [ './/q1:name1/.//q2:name2', ],
        ];
    }
}
