<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class CourseTest extends TestCase
{
    use DatabaseMigrations;
    use WithoutMiddleware;
    use DatabaseTransactions;


    public function testUser()
    {
        $this->seed(\userSeed::class);  //creates a user with email bob@bob.com
        $user = \App\User::find(1);
        $this->be($user);

        $this->assertDatabaseHas('users', [
            'email' => 'bob@bob.com'    //checks if there's a user with email bob@bob.com
        ]);
    }

    
}