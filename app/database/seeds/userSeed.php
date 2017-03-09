<?php

use Illuminate\Database\Seeder;

class userSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\User::create(['name'=>'Bob',
                    'email'=>'bob@bob.com',
                    'password'=>bcrypt('bob123')]);
    }
}
