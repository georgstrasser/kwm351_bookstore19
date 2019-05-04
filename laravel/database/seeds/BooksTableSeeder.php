<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $book1 = new \App\Book;
        $book1->title = "Herr der Ringe";
        $book1->isbn = "1111111111";
        $book1->subtitle = "Die Gefährten";
        $book1->rating = 10;
        $book1->description = "Erster Teil der Trilogie";
        $book1->published = new DateTime();
        $book1->price = 19;
        //get the first user
        $user = App\User::all()->first();
        $book1->user()->associate($user);
        $book1->save();
        // test authors - load them and write them to the db using eloquent ORM
        $authors = App\Author::all()->pluck("id");
        $book1->authors()->sync($authors);
        $book1->save();
        // add images to book
        $image1 = new \App\Image;
        $image1->title = "Buchumschlag";
        $image1->url = "https://musicimage.xboxlive.com/catalog/video.movie.8D6KGWZL5P11/image?locale=de-de&mode=crop&purposes=BoxArt&q=90&h=225&w=150&format=jpg";
        $image1->book()->associate($book1);
        $image1->save();
        $image2 = new App\Image;
        $image2->title = "DVD-Cover";
        $image2->url = "https://images-na.ssl-images-amazon.com/images/I/51VKKN0KZEL._SY445_.jpg";
        $image2->book()->associate($book1);
        $image2->save();

        $book2 = new \App\Book;
        $book2->title = "Halo: Die Invasion";
        $book2->isbn = "2222222222";
        $book2->rating = 7;
        $book2->description = "The official story to the video game!";
        $book2->published = new DateTime();
        $book2->price = 14;
        //get the first user
        $user2 = App\User::all()->first();
        $book2->user()->associate($user);
        $book2->save();
        // test authors - load them and write them to the db using eloquent ORM
        $authors = App\Author::all()->last();
        $book2->authors()->sync($authors);
        $book2->save();
        // add images to book
        $image1 = new \App\Image;
        $image1->title = "Master Chief";
        $image1->url = "https://images-na.ssl-images-amazon.com/images/I/51VlxDMfa4L._SX334_BO1,204,203,200_.jpg";
        $image1->book()->associate($book2);
        $image1->save();

        $book3 = new \App\Book;
        $book3->title = "The Bro Code";
        $book3->isbn = "3333333333";
        $book3->rating = 6;
        $book3->description = "How to be awesome";
        $book3->published = new DateTime();
        $book3->price = 12;
        //get the first user
        $user = App\User::all()->first();
        $book3->user()->associate($user);
        $book3->save();
        // test authors - load them and write them to the db using eloquent ORM
        $authors = App\Author::all()->first();
        $book3->authors()->sync($authors);
        $book3->save();
        // add images to book
        $image1 = new \App\Image;
        $image1->title = "Fancy";
        $image1->url = "https://images-na.ssl-images-amazon.com/images/I/512TwQLM%2BjL._SX307_BO1,204,203,200_.jpg";
        $image1->book()->associate($book3);
        $image1->save();

    }
}
