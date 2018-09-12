<?php

namespace Tests\Unit\Services\API;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\API\TwitterClient;

class TwitterClientTest extends TestCase {

    /**
     * @var TwitterClient
     */
    protected $twitterClient;

    /**
     * Setting up things.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->twitterClient = app()->make(TwitterClient::class);
    }

    /**
     * Test getRetweetersIds function returns false if string is empty.
     *
     * @return void
     */
    public function testGetRetweetersIdsReturnsFalseIfIdEmpty()
    {
        $this->assertFalse($this->twitterClient->getRetweetersIds(""));
    }

    /**
     * Test getRetweetersIds function returns object on success.
     *
     * @return void
     */
    public function testGetRetweetersIdsReturnsObjectOnSuccess()
    {
        $this->assertTrue(is_object($this->twitterClient->getRetweetersIds('1038442054945259520')));
    }

    /**
     * Test getFollowersIds function returns false if string is empty.
     *
     * @return void
     */
    public function testGetFollowersIdsReturnsFalseIfIdEmpty()
    {
        $this->assertFalse($this->twitterClient->getFollowersIds(""));
    }

    /**
     * Test getFollowersIds function returns object on success.
     *
     * @return void
     */
    public function testGetFollowersIdsReturnsObjectOnSuccess()
    {
        $this->assertTrue(is_object($this->twitterClient->getFollowersIds('305642654')));
    }

}
