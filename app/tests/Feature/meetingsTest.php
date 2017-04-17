<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Course;

class meetingsTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
    * Test meeting creation success.
    * NOTE : Test is highly dependent on "db:seed" command, should be refactored.
    */
    public function testCreateMeetingSuccess(){
      $arr = $this->testCreateMeetingHelper();
      $student = $arr[0];
      $teacher = $arr[1];
        //meeting time will occur in the past
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
        $this->assertDatabaseHas('attendances', [
            'meeting_id' => '1',
            'user_id' => $student->id
        ]);
        $this->assertDatabaseHas('attendances', [
            'meeting_id' => '1',
            'user_id' => $teacher->id
        ]);
      }

      /**
     * Test meeting creation failure.
     * NOTE : Test is highly dependent on “db:seed” command, should be refactored.
     */
     public function testCreateMeetingFailure(){
         $arr = $this->testCreateMeetingHelper();
         $student = $arr[0];
         $teacher = $arr[1];
         $response = $this->call('POST', '/instructorMeeting', [
             "currentWeek" => "1492315200",
             "instructor" => $teacher->id,
             "instructor-names-next" => null
         ]);
         //if start_time not present in request, assert that meeting is not be created
       $this->assertTrue(\App\Meeting::get()->count() == 0);
       $this->assertTrue(\App\Attendance::get()->count() == 0);
     }

     /**
     * Test command meetings:closeExpired
     * NOTE : Test is highly dependent on “db:seed” command, should be refactored.
     */
     public function testCloseExpiredMeetingsSuccess(){
       $arr = $this->testCreateMeetingHelper();
       $student = $arr[0];
       $teacher = $arr[1];
       //create a meeting with an expired date
       $response = $this->call('POST', '/instructorMeeting', [
           '_token' => csrf_token(),
           "currentWeek" => "1492315200",
           "instructor" => $teacher->id,
           "start_time" => "Sunday 12 AM",
           "instructor-names-next" => null
       ]);
       $this->assertTrue(\App\Meeting::get()->count() == 1);
       $this->artisan("meetings:closeExpired");
       //assert that meeting and corresponding attendances have been closed
       $this->assertTrue(\App\Meeting::get()->count() == 0);
       $this->assertTrue(\App\Attendance::get()->count() == 0);
     }

     /**
     * NOTE : Test is highly dependent on behaviour of “db:seed” command, should be refactored.
     */
     public function testCreateMeetingHelper(){
       $this->artisan("db:seed");
       $course = \App\Course::find(1);
       while($course->users->count() < 2){
         $this->artisan("db:seed");
         $course = \App\Course::find(2);
       }
       $student = $course->users->get(0);
       $student->title = ('student');
       $teacher = $course->users->get(1);
       $teacher->title = ('teacher');
       Auth::login($student);
       //seeded schedules are random, assign fixed values
       $student->schedule->freetime = "111011100010010011001100011111101001111100100010100011010000010110010110001011111010001010010100000001110101111100011011000000111011001010000110100101001001001001101010";
       $teacher->schedule->freetime = "101011100010010011001100011111101001111100100010100011010000010110010110001011111010001010010100000001110101111100011011000000111011001010000110100101001001001001101010";
       return array($student, $teacher);
     }

     // print to console during test
     // fwrite(STDERR, print_r(Auth::user()->schedule->freetime, TRUE));

}
