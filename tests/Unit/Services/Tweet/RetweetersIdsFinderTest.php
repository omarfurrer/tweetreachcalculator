<?php

namespace Tests\Unit\Services\Tweet;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Tweet\RetweetersIdsFinder;

class RetweetersIdsFinderTest extends TestCase {

    /**
     * @var RetweetersIdsFinder 
     */
    protected $retweetersIdsFinder;

    /**
     * Setting up things.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->retweetersIdsFinder = app()->make(RetweetersIdsFinder::class);
    }

    /**
     * Test returns false if string is empty.
     *
     * @return void
     */
    public function testReturnsFalseIfEmpty()
    {
        $this->assertFalse($this->retweetersIdsFinder->find(''));
    }

    /**
     * Test function returns array on success.
     * 
     * @return void
     */
    public function testReturnsArrayOnSuccess()
    {
        $this->assertTrue(is_array($this->retweetersIdsFinder->find('1038442054945259520')));
    }

}
