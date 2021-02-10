<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQoutePurchaserPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qoute_purchaser_price', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname',255);
            $table->string('lastname',255);
            $table->string('fullname',255)->virtualAs('concat(firstname," ",lastname)');
            $table->string('email',255);
            $table->string('website',255);
            // $table->unsignedBigInteger('item_id');
            // $table->foreign('item_id')->references('id')->on('qoutes_item');
            $table->foreignId('item_id')->constrained('users');
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
        Schema::dropIfExists('qoute_purchaser_price');
    }
}
