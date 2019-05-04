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
        $order1->total = 20;

        $user = App\User::all()->first();
        $order1->user()->associate($user);
        $order1->save();

        $book1 = App\Book::all()->pluck("id");
        $order1->books()->sync($book1);
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

    }
}
