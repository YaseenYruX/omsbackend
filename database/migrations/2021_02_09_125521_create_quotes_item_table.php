<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item',255);
            $table->float('qty',255);
            $table->string('sku',255);
            $table->float('price',255);
            $table->float('total',255);
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
        Schema::dropIfExists('quotes_item');
    }
}
