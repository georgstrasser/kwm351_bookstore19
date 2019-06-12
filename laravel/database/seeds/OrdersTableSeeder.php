<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $order1 = new \App\Order;
        $order1->order_date = new DateTime();
        $order1->vat = 10;
        $order1->total = (3*20)*1.1;

        $user1 = App\User::all()->first();
        $order1->user()->associate($user1);
        $order1->save();

        $books = App\Book::all()->pluck("id");
        $order1->books()->attach($books, ['quantity' => 2, 'price' => 20]);;
        $order1->save();

        $state1 = new \App\State;
        $state1->state = "Offen";
        $state1->comment = "Bestellung aufgegeben";
        $state1->order()->associate($order1);
        $state1->save();
        $state2 = new \App\State;
        $state2->state = "Bezahlt";
        $state2->comment = "via Kreditkarte";
        $state2->order()->associate($order1);
        $state2->save();



        $order2 = new \App\Order;
        $order2->order_date = new DateTime();
        $order2->vat = 10;
        $order2->total = (33*1.1);

        $user2 = App\User::all()->last();
        $order2->user()->associate($user2);
        $order2->save();

        $book2 = App\Book::all()->first();
        $order2->books()->attach($book2, ['quantity' => 3, 'price' => 33]);
        $order2->save();

        $state3 = new \App\State;
        $state3->state = "Offen";
        $state3->comment = "Bestellung eingegangen";
        $state3->order()->associate($order2);
        $state3->save();



        $order3 = new \App\Order;
        $order3->order_date = new DateTime();
        $order3->vat = 10;
        $order3->total = (10*1.1);

        $user3 = App\User::all()->last();
        $order3->user()->associate($user3);
        $order3->save();

        $book3 = App\Book::all()->last();
        $order3->books()->attach($book3, ['quantity' => 1, 'price' => 10]);
        $order3->save();

        $state4 = new \App\State;
        $state4->state = "Offen";
        $state4->comment = "Bestellung eingegangen";
        $state4->order()->associate($order3);
        $state4->save();
        $state5 = new \App\State;
        $state5->state = "Bezahlt";
        $state5->order()->associate($order3);
        $state5->save();
        $state6 = new \App\State;
        $state6->state = "Versendet";
        $state6->comment = "am 29.04.2019";
        $state6->order()->associate($order3);
        $state6->save();
    }
}
