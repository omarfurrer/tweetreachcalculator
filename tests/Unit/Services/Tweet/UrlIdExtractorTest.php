<?php

namespace Tests\Unit\Services\Tweet;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Tweet\UrlIdExtractor;

class UrlIdExtractorTest extends TestCase {

    /**
     * @var UrlIdExtractor 
     */
    protected $urlIdExtractor;

    /**
     * Setting up things.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->urlIdExtractor = app()->make(UrlIdExtractor::class);
    }

    /**
     * Test returns false if string is empty.
     *
     * @return void
     */
    public function testReturnsFalseIfEmpty()
    {
        $this->assertFalse($this->urlIdExtractor->extract(''));
    }

    /**
     * Test returns false if URL is not a string.
     *
     * @return void
     */
    public function testReturnsFalseIfNotString()
    {
        $this->assertFalse($this->urlIdExtractor->extract(12345678));
        $this->assertFalse($this->urlIdExtractor->extract(true));
    }

    /**
     * Test returns false if URL is not of a specific tweet.
     * Preg match test.
     *
     * @return void
     */
    public function testReturnsFalseIfNotTweetUrl()
    {
        $this->assertFalse($this->urlIdExtractor->extract('https://twitter.com/mcuban/statu/1038157769633931265'));
        $this->assertFalse($this->urlIdExtractor->extract('https://twiter.com/mcuban/status/1038157769633931265'));
        $this->assertFalse($this->urlIdExtractor->extract('1038157769633931265'));
    }

    /**
     * Test returns ID of tweet if given correct url.
     *
     * @return void
     */
    public function testReturnsIdOnSuccess()
    {
        $this->assertEquals('1038157769633931265', $this->urlIdExtractor->extract('https://twitter.com/mcuban/status/1038157769633931265'));
        $this->assertEquals('1039208425442369536', $this->urlIdExtractor->extract('https://twitter.com/kevinolearytv/status/1039208425442369536'));
        $this->assertEquals('1039257512644669440', $this->urlIdExtractor->extract('https://twitter.com/BarbaraCorcoran/status/1039257512644669440'));
    }

}
