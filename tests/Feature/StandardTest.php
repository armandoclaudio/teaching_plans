<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StandardTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_standard_can_be_created()
    {
        $this->disableExceptionHandling();

        $response = $this->post(route('standards.store'), [
            'description' => 'Standard 1',
            'expectations' => [
                'Expectation 1',
                'Expectation 2'
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('standards', ['description' => 'Standard 1']);
        $this->assertDatabaseHas('expectations', ['description' => 'Expectation 1']);
        $this->assertDatabaseHas('expectations', ['description' => 'Expectation 2']);
    }

    /** @test */
    public function a_standard_can_be_updated()
    {
        $standard = factory('App\Standard')->create(['description' => 'Standard 1']);
        factory('App\Expectation')->create([
            'standard_id' => $standard->id, 
            'description' => 'Expectation 1'
        ]);

        $response = $this->post(route('standards.update', $standard->id), [
            'description' => 'Standard 2',
            'expectations' => [
                'Expectation 2'
            ]
        ]);

        $this->assertEquals(200, $response->getStatusCode());
        $this->assertDatabaseHas('standards', ['description' => 'Standard 2']);
        $this->assertDatabaseMissing('standards', ['description' => 'Standard 1']);
        $this->assertDatabaseHas('expectations', [
            'standard_id' => $standard->id,
            'description' => 'Expectation 2'
        ]);
        $this->assertDatabaseMissing('expectations', [
            'standard_id' => $standard->id,
            'description' => 'Expectation 1'
        ]);
    }
}
