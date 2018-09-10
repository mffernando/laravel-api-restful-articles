<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\User;

class LoginTest extends TestCase
{
    public function testRequiresEmailAndLogin()
    {
        $this->json('POST', 'api/login')
             ->assertStatus(422)
             ->assertJson([
               'email' => ['The email field is required.'],
               'password' => ['The password field is required'],
             ]);
    }

    public function testUserLoginsSuccessfully(){
      $user = factory(User::class)->create([
        'email' => 'testlogin@system.com',
        'password' => bcrypt('mypassword'),
      ]);

      $payload = ['email' => 'testlogin@system.com', 'password' => 'mypassword'];

      $this->json('POST', 'api/login', $payload)
           ->assertStatus(200)
           ->assertJsonStructure([
             'data' => [
                  'id',
                  'name',
                  'email',
                  'created_at',
                  'updated_at',
                  'api_token',
             ],
           ]);
    }
}
