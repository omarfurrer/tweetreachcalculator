<?php

namespace Tests\Unit\Services\Tweet;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Services\Tweet\FollowersIdsFinder;

class FollowersIdsFinderTest extends TestCase {

    /**
     * @var FollowersIdsFinder 
     */
    protected $followersIdsFinder;

    /**
     * Setting up things.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->followersIdsFinder = app()->make(FollowersIdsFinder::class);
    }

    /**
     * Test returns false if string is empty.
     *
     * @return void
     */
    public function testReturnsFalseIfEmpty()
    {
        $this->assertFalse($this->followersIdsFinder->find(''));
    }

    /**
     * Test function returns array on success.
     * 
     * @return void
     */
    public function testReturnsArrayOnSuccess()
    {
        $this->assertTrue(is_array($this->followersIdsFinder->find('305642654')));
    }

}
