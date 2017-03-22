<?php

namespace Tests\Feature;

use Tests\BrowserKitTestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;

class authTest extends BrowserKitTestCase
{
    use DatabaseMigrations;
    //use WithoutMiddleware;
    use DatabaseTransactions;

    /**
     * Test the case where a user registers successfully
     * Confirms that the user is redirected to /home AND the user exists in the database
     */
    public function testRegistrationSuccess(){
        $this->visit('/register')
            ->type('Bilbo', 'name')
            ->type('bilbo@baggins.com', 'email')
            ->type('bilbo123', 'password')
            ->type('bilbo123', 'password_confirmation')
            ->press('Register')
            ->seePageIs('http://localhost/home')
            ->seeInDatabase('users', [
                'email' => 'bilbo@baggins.com'
            ]);
    }

    /**
     * Test the case where a user fails to registers
     * Confirms that the user stays on /register when some fields are empty
     */
    public function testRegistrationFailure(){
        $this->visit('/register')
            //->type('Bilbo', 'name')   //user does not enter a name
            ->type('bilbo@baggins.com', 'email')
            ->type('bilbo123', 'password')
            ->type('bilbo123', 'password_confirmation')
            ->press('Register')
            ->seePageIs('http://localhostregister');
    }

    /**
     * Test the case where a user logs in successfully
     * Confirms that the user is redirected to /home
     */
    public function testLoginSuccess(){
        //create a user
        factory(User::class)->create([
            'name' => 'bill',
            'title' => 'student',
            'email' => 'bill@bill.com',
        ]);
        $this->visit('/login')
            ->type('bill@bill.com', 'email')
            ->type('secret', 'password')
            ->press('Login')
            ->seePageIs('http://localhost/home');
    }

    /**
     * Test the case where the user enters a wrong password
     * Confirms that the user stays on /login
     */
    public function testLoginFailure(){
        //create a user
        factory(User::class)->create([
            'name' => 'bob',
            'title' => 'student',
            'email' => 'bob@bob.com',
        ]);
        $this->visit('/login')
            ->type('bob@bob.com', 'email')
            ->type('asdasd', 'password') //enter a wrong password
            ->press('Login')
            ->seePageIs('http://localhostlogin');
    }

}
