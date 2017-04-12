<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class WizardTest extends TestCase
{

    use DatabaseMigrations;

    //commandline: .vendor/bin/phpunit

    /**
     * Force user to go through setup when setup is incomplete
     *
     * @return void
     */
    public function test_incomplete_setup()
    {
      $user = factory(User::class)->make();
      $response = $this ->actingAs($user)
                        ->get('/home')
                        ->assertRedirect('/wizard');
    }

    /**
     * User is free to roam around when setup is completed
     *
     * @return void
     */
    public function test_complete_setup()
    {
      $user = factory(User::class)->make( [ 'setup' => true ] );
      $response = $this ->actingAs($user)
                        ->get('/home')
                        ->assertStatus(200);
    }

    // public function test_setup_flow()
    // {
    //   $user = factory(User::class)->create( [ 'setup' => false ] );
    //   $response = $this ->actingAs($user)
    //                     ->get('/wizard/title')
    //                     ->assertSee('role')
    //                     ->submit
    //                     ->seePageIs('/wizard/course');
    // }

}
