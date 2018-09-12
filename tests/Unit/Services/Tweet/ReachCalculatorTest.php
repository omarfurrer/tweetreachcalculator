<?php

namespace Tests\Unit\Services\Tweet;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\Tweet\ReachCalculator;
use Illuminate\Support\Facades\Cache;

class ReachCalculatorTest extends TestCase {

    /**
     * @var ReachCalculator 
     */
    protected $reachCalculator;

    /**
     * Setting up things.
     */
    protected function setUp()
    {
        parent::setUp();
        $this->reachCalculator = app()->make(ReachCalculator::class);
    }

    /**
     * Test function returns integer on success.
     * 
     * @return void
     */
    public function testReturnsIntegerOnSuccess()
    {
        $this->assertTrue(is_integer($this->reachCalculator->calculate('https://twitter.com/marissa/status/1030100101665054720')));
    }

    /**
     * Test function returns correct value on success.
     * 
     * @return void
     */
    public function testReturnsCorrectValueOnSuccess()
    {
        $this->assertEquals(5580, $this->reachCalculator->calculate('https://twitter.com/marissa/status/1030100101665054720'));
    }

    /**
     * Test cache has key and value on success.
     * 
     * @return void
     */
    public function testCacheHasKeyAndValueOnSuccess()
    {
        $this->reachCalculator->calculate('https://twitter.com/marissa/status/1030100101665054720');
        $this->assertTrue(Cache::has('1030100101665054720'));
        $this->assertEquals(5580,Cache::get('1030100101665054720'));
    }

}
