<?php


use Illuminate\Http\Request;
use Illuminate\Database\Seeder;
use Illuminate\Validation\Rule;         //required for request validation
use Illuminate\Support\Facades\Validator;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    factory(App\User::class, 10) -> create();
    factory(App\Schedule::class, 10) -> create();

      //factory(App\Enrollment::class, 10) -> create();
      //alternative once restriction on duplicate (course_id, user_id) gets created

    factory(App\Enrollment::class, 10)->create();
    


/*
      foreach ($enrollments as $enrollment) {
          $repeat = true;
          while($repeat){
            try {
                $enrollment->save();
                $repeat = false;
            } catch (\Illuminate\Database\QueryException $e) {
                $enrollment = factory(App\Enrollment::class)->make();
                $repeat = true;
            }
          }
      }*/


      //when this code is refactored, it should reference other seeders
      //to keep each seeder file short. to be done using below command
      // $this->call(UsersTableSeeder::class);
    }
}
