<?php

use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = new \App\Author;
        $author1->firstName = "Max";
        $author1->lastName = "Maier";
        $author1->save();

        $author2 = new \App\Author;
        $author2->firstName = "Susi";
        $author2->lastName = "Musterfrau";
        $author2->save();

        $author3 = new \App\Author;
        $author3->firstName = "Karl";
        $author3->lastName = "Huber";
        $author3->save();
    }
}
