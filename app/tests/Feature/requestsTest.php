<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Course;

class requestsTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
    * Test meeting request creation success.
    * NOTE : Test is highly dependent on "db:seed" command, should be refactored.
    */
    public function testCreateMeetingRequestSuccess(){
      $arr = $this->testCreateMeetingRequestHelper();
      $studentA = $arr[0];
      $studentB = $arr[1];
      $course = $arr[2];
      //create a meeting request, note time is expired
      $response = $this->call('POST', 'requests/create', [
          '_token' => csrf_token(),
          "currentWeek" => "1492315200",
          "time" => serialize(array("Sunday 12 AM", $studentB->id)),
          "course_id" => $course->id
      ]);
      //assert request created, and both students are invited
      $this->assertDatabaseHas('requests', [
          'course_id' => $course->id,
          'id' => '1'
        ]);
      $this->assertDatabaseHas('invites', [
          'request_id' => '1',
          'user_id' => $studentA->id,
          'sender' => true
      ]);
      $this->assertDatabaseHas('invites', [
          'request_id' => '1',
          'user_id' => $studentB->id,
          'sender' => false
      ]);
    }

      /**
     * Test meeting request creation failure.
     * NOTE : Test is highly dependent on “db:seed” command, should be refactored.
     */
     public function testCreateMeetingRequestFailure(){
       $arr = $this->testCreateMeetingRequestHelper();
       $studentA = $arr[0];
       $studentB = $arr[1];
       $course = $arr[2];
       //create a meeting request, note time is expired
       $response = $this->call('POST', 'requests/create', [
           "currentWeek" => "1492315200",
          //  "time" => serialize(array("Sunday 12 AM", $studentB->id)),
           "course_id" => $course->id
       ]);
       //if time not present in requset, assert that meetingrequest and invites are not created
       $this->assertTrue(\App\Request::get()->count() == 0);
       $this->assertTrue(\App\Invite::get()->count() == 0);
     }

     /**
     * Test command requests:closeExpired
     * NOTE : Test is highly dependent on “db:seed” command, should be refactored.
     */
     public function testCloseExpiredMeetingRequestsSuccess(){
         $arr = $this->testCreateMeetingRequestHelper();
         $studentA = $arr[0];
         $studentB = $arr[1];
         $course = $arr[2];
         //create a meeting request, note time is expired
         $response = $this->call('POST', 'requests/create', [
             '_token' => csrf_token(),
             "currentWeek" => "1492315200",
             "time" => serialize(array("Sunday 12 AM", $studentB->id)),
             "course_id" => $course->id
         ]);
         $this->assertTrue(\App\Request::get()->count() == 1);
         $this->artisan("requests:closeExpired");
         //assert that meeting and corresponding attendances have been closed
         $this->assertTrue(\App\Request::get()->count() == 0);
         $this->assertTrue(\App\Invite::get()->count() == 0);
     }

     /**
     * NOTE : Test is highly dependent on behaviour of “db:seed” command, should be refactored.
     */
     public function testCreateMeetingRequestHelper(){ 
       $this->artisan("db:seed");
       $course = \App\Course::find(1);
       while($course->users->count() < 2){
         $this->artisan("db:seed");
         $course = \App\Course::find(2);
       }
       $studentA = $course->users->get(0);
       $studentA->title = ('student');
       $studentB = $course->users->get(1);
       $studentB->title = ('student');
       Auth::login($studentA);
       //seeded schedules are random, assign fixed values
       $studentA->schedule->freetime = "111011100010010011001100011111101001111100100010100011010000010110010110001011111010001010010100000001110101111100011011000000111011001010000110100101001001001001101010";
       $studentB->schedule->freetime = "101011100010010011001100011111101001111100100010100011010000010110010110001011111010001010010100000001110101111100011011000000111011001010000110100101001001001001101010";
       return array($studentA, $studentB, $course);
     }

     // print to console during test
     // fwrite(STDERR, print_r(Auth::user()->schedule->freetime, TRUE));

}
