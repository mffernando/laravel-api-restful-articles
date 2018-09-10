<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
         //clear the users table first [truncate]
         User::truncate();

         //hash password
         $password = Hash::make('secret');

         //create admin user
         User::create([
           'name' => 'Administrator',
           'email' => 'admin@admin.com',
           'password' => $password,
         ]);

         $faker = \Faker\Factory::create();

         //create few users in database [50 new fake users]
         for ($i = 0; $i < 50 ; $i++) {
           User::create([
             'name' => $faker->name,
             'email' => $faker->email,
             'password' => $password,
           ]);
         }
     }
 }
