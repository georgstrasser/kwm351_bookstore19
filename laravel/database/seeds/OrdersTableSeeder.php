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
        $order1->total = (39 + 12 + 14)*1.1;

        $user1 = App\User::all()->first();
        $order1->user()->associate($user1);
        $order1->save();

        $position1 = new \App\Position;
        $book1 = App\Book::where('id', 1)->first();
        $position1->book()->associate($book1);
        $position1->quantity = 2;
        $position1->price = 39;
        $position1->order()->associate($order1);
        $position1->save();

        $position2 = new \App\Position;
        $book2 = App\Book::where('id', 2)->first();
        $position2->book()->associate($book2);
        $position2->quantity = 1;
        $position2->price = 14;
        $position2->order()->associate($order1);
        $position2->save();
        $position3 = new \App\Position;
        $book3 = App\Book::where('id', 3)->first();
        $position3->book()->associate($book3);
        $position3->quantity = 1;
        $position3->price = 12;
        $position3->order()->associate($order1);
        $position3->save();

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
        $order2->total = (19.50*1.1);

        $user2 = App\User::all()->last();
        $order2->user()->associate($user2);
        $order2->save();

        $position4 = new \App\Position();
        $book4 = App\Book::all()->first();
        $position4->book()->associate($book4);
        $position4->quantity = 1;
        $position4->price = 19.5;
        $position4->order()->associate($order2);
        $position4->save();

        $state3 = new \App\State;
        $state3->state = "Offen";
        $state3->comment = "Bestellung eingegangen";
        $state3->order()->associate($order2);
        $state3->save();



        $order3 = new \App\Order;
        $order3->order_date = new DateTime();
        $order3->vat = 10;
        $order3->total = (12*1.1);

        $user3 = App\User::all()->last();
        $order3->user()->associate($user3);
        $order3->save();

        $position5 = new \App\Position();
        $book5 = App\Book::all()->last();
        $position5->book()->associate($book5);
        $position5->quantity = 3;
        $position5->price = 36;
        $position5->order()->associate($order3);
        $position5->save();

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
