<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StandardTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_has_many_expectations()
    {
        $standard = factory('App\Standard')->create();
        $expectation1 = factory('App\Expectation')->create(['standard_id' => $standard->id]);
        $expectation2 = factory('App\Expectation')->create(['standard_id' => $standard->id]);

        $expectations = $standard->expectations;

        $this->assertEquals(2, $expectations->count());
        $this->assertEquals($expectation1->id, $expectations->first()->id);
        $this->assertEquals($expectation2->id, $expectations->last()->id);
    }
}
