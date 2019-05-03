<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('state', ['Offen','Bezahlt','Versendet','Storniert']);
            $table->date('state_date')->default(date("Y-m-d H:i:s"));
            $table->string('comment')->nullable();

            // fk fields for relations - model name lowercase + "_id"
            $table->integer('order_id')->unsigned();
            // create constraint in DB
            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
