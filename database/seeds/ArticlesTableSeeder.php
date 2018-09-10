<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear the articles table first [truncate]
        Article::truncate();

        $faker = \Faker\Factory::create();

        //create few articles in database [50 new fake articles]
        for ($i = 0; $i < 50 ; $i++) {
          Article::create([
            'title' => $faker->sentence,
            'body' => $faker->paragraph,
          ]);
        }
    }
}
