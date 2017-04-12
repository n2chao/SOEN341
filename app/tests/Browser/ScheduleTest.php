<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\User;

class ScheduleTest extends DuskTestCase
{

  /**
   *  User can view their availability
   *
   * @return void
   */
  public function test_schedule()
  {
      $this->browse(function(Browser $browser){
          $browser->visit('/login')
                  ->loginAs(User::find(1))
                  ->visit('/schedule')
                  ->assertSee('Here are your availabilities');
      });
  }

    /**
     *  User can select their availability
     *
     * @return void
     */
    public function test_schedule_add()
    {

      $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    // ->loginAs($user)
                    ->loginAs(User::find(1))
                    ->visit('/schedule/edit')
                    ->assertSee('Sun')
                    ->check('freetime[]')
                    ->press('Save')
                    ->assertPathIs('/schedule');
        });
    }

    /**
     *  User can unselect their availability
     *
     * @return void
     */
    public function test_schedule_remove()
    {

      $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    // ->loginAs($user)
                    ->loginAs(User::find(1))
                    ->visit('/schedule/edit')
                    ->assertSee('Sun')
                    ->uncheck('freetime[]')
                    ->press('Save')
                    ->assertPathIs('/schedule');
        });
    }


}
