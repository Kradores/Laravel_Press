<?php 

namespace Press\Tests;

use Carbon\Carbon;
use Press\PressFileParser;

class PressFileParserTest extends TestCase
{
    /** @test */
    public function theHeadAndBodyGetsSplit() {

        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getRawData();

        $this->assertStringContainsString('title: My Title', $data[1]);
        $this->assertStringContainsString('description: Description here', $data[1]);
        $this->assertStringContainsString('Blog post body here', $data[2]);
    }

    /** @test */
    public function stringCanAlsoBeUsed() {

        $pressFileParser = (new PressFileParser("---\r\ntitle: My Title\r\n---\r\nBlog post body here"));

        $data = $pressFileParser->getRawData();

        $this->assertStringContainsString('title: My Title', $data[1]);
        $this->assertStringContainsString('Blog post body here', $data[2]);
    }

    /** @test */
    public function eachHeadFieldGetsSeparated() {
        
        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertEquals('My Title', $data['title']);
        $this->assertEquals('Description here', $data['description']);
    }

    /** @test */
    public function theBodyGetsSavedAndTrimmed() {
        
        $pressFileParser = (new PressFileParser(__DIR__.'/../blogs/MarkFile1.md'));

        $data = $pressFileParser->getData();

        $this->assertEquals("<h1>Heading</h1>\n<p>Blog post body here</p>", $data['body']);
    }

    /** @test */
    public function dateFieldGetsParsed() {
        
        $pressFileParser = (new PressFileParser("---\r\ndate: May 14, 1988\r\n---\r\n"));

        $data = $pressFileParser->getData();

        $this->assertInstanceOf(Carbon::class, $data['date']);
        $this->assertEquals('05/14/1988', $data['date']->format('m/d/Y'));
    }

    /** @test */
    public function extraFieldGetsSaved() {
        
        $pressFileParser = (new PressFileParser("---\r\nauthor: John Doe\r\n---\r\n"));

        $data = $pressFileParser->getData();

        $this->assertEquals(json_encode(['author' => 'John Doe']), $data['extra']);
    }

    /** @test */
    public function twoAdditionalFieldsIntoExtra() {
        
        $pressFileParser = (new PressFileParser("---\r\nauthor: John Doe\r\nimage: some/image.jpg\r\n---\r\n"));

        $data = $pressFileParser->getData();

        $this->assertEquals(json_encode(['author' => 'John Doe', 'image' => 'some/image.jpg']), $data['extra']);
    }
}