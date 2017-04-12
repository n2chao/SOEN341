<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\User;

class WizardTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function test_wizard_flow()
    {

      $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    // ->loginAs($user)
                    ->loginAs(User::find(1))
                    ->visit('/wizard/title')
                    ->assertSee('Student')
                    ->press('Next')
                    ->assertPathIs('/wizard/course')
                    ->assertSee('Current Classes')
                    ->clickLink('Next')
                    ->assertPathIs('/wizard/schedule')
                    ->assertSee('Sun')
                    ->check('freetime[]')
                    ->press('Finish')
                    ->assertPathIs('/home');
        });
    }
}
