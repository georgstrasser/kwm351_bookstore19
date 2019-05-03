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

        $book1 = App\Book::where('id', 2)->pluck("id");
        $order1->books()->sync($book1);
        $order1->save();
        $book2 = App\Book::where('id', 3)->pluck("id");
        $order1->books()->sync($book2);
        $order1->save();

        $state1 = new \App\State;
        $state1->state = "Offen";
        $state1->comment = "Bestellung aufgegeben";
        $state1->order()->associate($order1);
        $state1->save();

    }
}
