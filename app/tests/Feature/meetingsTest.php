<?php

namespace Tests\Feature;

use Tests\TestCase;
// use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Course;

class meetingsTest extends TestCase
{
    use DatabaseMigrations;
    //use WithoutMiddleware;
    use DatabaseTransactions;

    public function testCreateMeetingSuccess(){
        // $this->artisan("migrate:refresh");
        // $this->artisan("db:seed");
        // $course = \App\Course::find(1);
        //get student and teacher enrolled in course
        // $student = $course->users->where('title', '=', 'student')->values()->get(0);
        // $teacher = $course->users->where('title', '=', 'teacher')->values()->get(0);
        // Auth::login($student);
        //
        factory(User::class)->create([
            'name' => 'bob',
            'title' => 'student',
            'email' => 'bob@bob.com',
        ]);
        factory(User::class)->create([
            'name' => 'tom',
            'title' => 'teacher',
            'email' => 'tom@tom.com',
        ]);
        factory(Course::class)->create([
            'code' => 'SOEN341',
            'name' => 'Software Processes',
        ]);
        factory(Enrollment::class)->create([
            'course_id' => '1',
            'user_id' => '1',
        ]);
        factory(Enrollment::class)->create([
            'course_id' => '1',
            'user_id' => '2',
        ]);
        $student = User::where('name','=','bob');
        $teacher = User::where('name','=','tom');
        //seeded schedules are random, assign fixed values
        $student->schedule->freetime = "111011100010010011001100011111101001111100100010100011010000010110010110001011111010001010010100000001110101111100011011000000111011001010000110100101001001001001101010";
        $teacher->schedule->freetime = "101011100010010011001100011111101001111100100010100011010000010110010110001011111010001010010100000001110101111100011011000000111011001010000110100101001001001001101010";
        // fwrite(STDERR, print_r($student->schedule->freetime, TRUE));
        // fwrite(STDERR, print_r($teacher->schedule->freetime, TRUE));
        // fwrite(STDERR, print_r(Auth::user()->schedule->freetime, TRUE));
        //meeting time will occur in the past?
        $response = $this->call('POST', '/instructorMeeting', [
            '_token' => csrf_token(),
            "currentWeek" => "1492315200",
            "instructor" => $teacher->id,
            "start_time" => "Sunday 12 AM",
            "instructor-names-next" => null
        ]);
        //assert meeting created, and both student and teacher are attending
        $this->assertDatabaseHas('meetings', [
            'course_id' => '1',
            'id' => '1',
            'instructorMeeting' => true
        ]);
        // $this->seeInDatabase('attendances', [
        //     'meeting_id' => '1',
        //     'user_id' => $student->id
        // ]);
        // $this->seeInDatabase('attendances', [
        //     'meeting_id' => '1',
        //     'user_id' => $teacher->id
        // ]);
    }

    // public function testDeclineMeetingSuccess(){
    //
    // }
}
