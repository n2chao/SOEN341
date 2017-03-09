<?php

use Illuminate\Database\Seeder;

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

    DB::table('courses')->insert([
        'code' => 'SOEN341',
        'name' => 'SOEN341',
    ]);
    DB::table('courses')->insert([
        'code' => 'ENGR371',
        'name' => 'ENGR371',
    ]);

      factory(App\Enrollment::class, 10) -> create();
      //alternative once restriction on duplicate (course_id, user_id) gets created

      /*$enrollments = factory(App\Enrollment::class, 10)->make();

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
      }
      */

      //when this code is refactored, it should reference other seeders
      //to keep each seeder file short. to be done using below command
      // $this->call(UsersTableSeeder::class);
    }
}
