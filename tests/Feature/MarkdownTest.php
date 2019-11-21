<?php 

namespace Press\Tests;

use Press\MarkdownParser;
use Orchestra\Testbench\TestCase;

class MarkdownTest extends TestCase
{
    /** @test */
    public function simpleMarkdownIsParsed() {

        $this->assertEquals("<h1>Heading</h1>", MarkdownParser::parse('# Heading'));
    }
}