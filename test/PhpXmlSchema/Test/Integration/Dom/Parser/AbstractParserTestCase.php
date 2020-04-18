<?php
/**
 * This file is part of the PhpXmlSchema library.
 * 
 * @copyright   2018-2020, Christophe Maymard <christophe.maymard@hotmail.com>
 * @license     http://opensource.org/licenses/MIT  MIT
 */
namespace PhpXmlSchema\Test\Integration\Dom\Parser;

use PHPUnit\Framework\TestCase;
use PhpXmlSchema\Dom\Parser;
use PhpXmlSchema\Test\Dom\XmlAssertTrait;
use PhpXmlSchema\Test\Unit\Dom\ElementAssertTrait;

/**
 * Represents the base class to unit test the {@see PhpXmlSchema\Dom\Parser} 
 * class in a specific context.
 * 
 * @group   parsing
 * @group   dom
 * 
 * @author  Christophe Maymard  <christophe.maymard@hotmail.com>
 */
abstract class AbstractParserTestCase extends TestCase
{
    use ElementAssertTrait;
    use XmlAssertTrait;
    
    const RES_PATH = __DIR__.'/../../../../../../res/test/integration/parser/xs10/';
    
    /**
     * The system under test.
     * @var Parser
     */
    protected $sut;
    
    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $this->sut = new Parser();
    }
    
    /**
     * {@inheritDoc}
     */
    protected function tearDown(): void
    {
        $this->sut = NULL;
    }
    
    /**
     * Creates a set of tests with the specified group.
     * 
     * @param   string  $group
     * @return  array[]
     */
    protected function createDataSets(string $group): array
    {
        $sxe = \simplexml_load_file(
            self::RES_PATH.$this->getContextName().'.xml'
        );
        
        $datasets = [];
        
        foreach($sxe->children() as $test) {
            if ($test['group'] != $group) {
                continue;
            }
            
            $datasets[(string)$test['name']] = [ 
                (string)$test->schema['fileName'], 
                (string)$test->schema->exception, 
                (string)$test->schema->message, 
            ];
        }
        
        return $datasets;
    }
    
    /**
     * Returns the content of the specified filename.
     * 
     * @param   string  $fileName   The name of the file.
     * @return  string
     */
    protected function getXs(string $fileName): string
    {
        return \file_get_contents(
            self::RES_PATH.$this->getContextName().'/'.$fileName
        );
    }

    /**
     * Returns the name of the current context.
     * 
     * @return  string
     */
    abstract protected function getContextName(): string;
}
