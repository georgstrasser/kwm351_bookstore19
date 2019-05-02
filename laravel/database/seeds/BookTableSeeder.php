<?php

use Illuminate\Database\Seeder;

class BookTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book = new \App\Book;
        $book->title = "Herr der Ringe";
        $book->isbn = "123456789";
        $book->subtitle = "Die Rückkehr des Königs";
        $book->rating = 10;
        $book->description = "Letzter Teil der Trilogie";
        $book->published = new DateTime();

        //get the first user
        $user = App\User::all()->first();
        $book->user()->associate($user);
        $book->save();
        // test authors - load them and write them to the db using eloquent ORM
        $authors = App\Author::all()->pluck("id");
        $book->authors()->sync($authors);
        $book->save();

        // add images to book
        $image1 = new \App\Image;
        $image1->title = "Cover 1";
        $image1->url = "https://images-na.ssl-images-amazon.com/images/I/61h%2BnIJyVFL._SX333_BO1,204,203,200_.jpg";
        $image1->book()->associate($book);
        $image1->save();

        $image2 = new App\Image;
        $image2->title = "Cover 2";
        $image2->url = "https://images-eu.ssl-images-amazon.com/images/I/516KV5tjulL._AC_US327_FMwebp_QL65_.jpg";
        $image2->book()->associate($book);
        $image2->save();
    }
}
