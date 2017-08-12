<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class StandardTest extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function the_create_form_loads_correctly()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('standards.create'))
                    ->assertSee('Create a standard')
                    ->assertVisible('#submit');
        });
    }

    /** @test */
    public function can_add_expectations_with_button()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('standards.create'))
                    ->assertMissing('.expectation');

            $browser->click('#add-expectation');

            $browser->assertVisible('.expectation');
        });
    }

    /** @test */
    public function can_remove_expectations()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('standards.create'))
                    ->click('#add-expectation')
                    ->waitFor('.expectation');

            $browser->click('.remove-expectation')
                    ->assertMissing('.expectation');
        });
    }

    /** @test */
    public function it_submits_a_valid_form_successfully()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('standards.create'))
                    ->type('#standard-description', 'Description')
                    ->click('#add-expectation')
                    ->type('.expectation', 'Expectation 1')
                    ->click('#submit')
                    ->pause(2000);

            $browser->assertPathIs('/standards');
        });
    }

    /** @test */
    public function it_shows_erros_if_the_form_is_invalid()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(route('standards.create'))
                    ->click('#submit')
                    ->pause(2000);

            $browser->assertSee('The description field is required.');
        });
    }

    /** @test */
    public function a_standard_can_be_edited()
    {   
        $this->browse(function (Browser $browser) {
            
            $standard = factory('App\Standard')->create(['description' => 'Standard 1']);
            factory('App\Expectation')->create(['standard_id' => $standard->id, 'description' => 'Expectation 1']);
            
            $browser->visit(route('standards.edit', $standard->id))
                    ->pause(2000)
                    ->assertInputValue('#standard-description', $standard->description)
                    ->assertVisible('.expectation')
                    ->assertInputValue('.expectation', 'Expectation 1');
                    
            $browser->click('#submit')
                    ->pause(2000);
            
            $browser->assertPathIs('/standards');
        });
    }

    /** @test */
    public function the_standards_list_is_displayed()
    {   
        $this->browse(function (Browser $browser) {
            
            factory('App\Standard')->create(['description' => 'Standard 1']);
            factory('App\Standard')->create(['description' => 'Standard 2']);
            factory('App\Standard')->create(['description' => 'Standard 3']);
            
            $browser->visit(route('standards.index'))
                    ->pause(2000);
                
            $browser->assertSee('Standard 1')
                    ->assertSee('Standard 2')
                    ->assertSee('Standard 3');
        });
    }

    /** @test */
    public function the_standards_index_has_a_link_to_create_a_standard()
    {   
        $this->browse(function (Browser $browser) {
            
            $browser->visit(route('standards.index'))
                    ->clickLink('Create a new standard')
                    ->pause(2000);
                
            $browser->assertRouteIs('standards.create');
        });
    }

    /** @test */
    public function the_standards_list_links_to_the_edit_form()
    {   
        $this->browse(function (Browser $browser) {
            
            $standard = factory('App\Standard')->create(['description' => 'Standard 1']);
            
            $browser->visit(route('standards.index'))
                    ->clickLink('Standard 1')
                    ->pause(2000);
                
            $browser->assertRouteIs('standards.edit', $standard->id);
        });
    }
}
