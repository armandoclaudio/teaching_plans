<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_edit_their_profile()
    {
        $this->disableExceptionHandling();

        $user = factory(\App\User::class)->create();

        $response = $this->actingAs($user)->get(route('profile.edit'));

        $response->assertStatus(200)
            ->assertSee($user->name)
            ->assertSee($user->email)
            ->assertSee($user->class);
    }

    /** @test */
    public function a_user_can_update_their_profile()
    {
        $user = factory(\App\User::class)->create();

        $this->actingAs($user)->patch(route('profile.update'), [
            'name' => 'Armando Claudio',
            'email' => 'armando@example.com',
            'class' => 'Math'
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'Armando Claudio',
            'email' => 'armando@example.com',
            'class' => 'Math'
        ]);
    }

    /** @test */
    public function an_email_must_be_unique_when_updating_a_profile()
    {
        factory(\App\User::class)->create(['email' => 'armando@example.com']);
        $user = factory(\App\User::class)->create();

        $this->actingAs($user)->patch(route('profile.update'), [
            'name' => $user->name,
            'email' => 'armando@example.com',
            'class' => $user->class
        ]);

        $this->assertDatabaseMissing('users', [
            'id' => $user->id,
            'email' => 'armando@example.com'
        ]);
    }
}
