<?php

namespace Tests\Feature;

use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class EnrollmentTest extends BrowserKitTestCase
{
    use DatabaseMigrations;
    //use WithoutMiddleware;
    use DatabaseTransactions;

    public function testAddCourseSuccess(){

        factory(User::class)->create([
            'name' => 'george',
            'title' => 'student',
            'email' => 'george@george.com',
        ]);
        $user = \App\User::find(1);
        $this->actingAs($user)
            ->visit('courses/course')
            ->type('soen341', 'add_course_ids[0]')
            ->type('soen341', 'add_course_ids[0]')
            ->type('soen341', 'add_course_ids[0]')
            ->press('Add Courses')
            ->seeInDatabase('enrollments', ['course_id' => 264, 'user_id'=>$user->id]);

    }

    public function testRemoveCourse(){

    }
}
