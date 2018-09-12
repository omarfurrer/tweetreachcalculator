<?php

namespace Tests\Unit\Services\Tweet;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Tweet\MultiFollowersIdsFinder;

class MultiFollowersIdsFinderTest extends TestCase {

    /**
     * @var MultiFollowersIdsFinder 
     */
    protected $multiFollowersIdsFinder;

    /**
     * Setting up things.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->multiFollowersIdsFinder = app()->make(MultiFollowersIdsFinder::class);
    }

    /**
     * Test returns false if array is empty.
     *
     * @return void
     */
    public function testReturnsFalseIfEmpty()
    {
        $this->assertFalse($this->multiFollowersIdsFinder->find([]));
    }

    /**
     * Test returns false if not array.
     *
     * @return void
     */
    public function testReturnsFalseIfNotArray()
    {
        $this->assertFalse($this->multiFollowersIdsFinder->find(123456));
    }

    /**
     * Test function returns array on success.
     * 
     * @return void
     */
    public function testReturnsArrayOnSuccess()
    {
        $this->assertTrue(is_array($this->multiFollowersIdsFinder->find([305642654, 718086985])));
    }

}
