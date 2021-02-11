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
            $table->foreignId('condition_id')->constrained('m_flag');
            $table->string('item',255);
            $table->integer('qty');
            $table->string('sku',255);
            $table->float('price',255);
            $table->float('amount',255)->virtualAs('qty*price');
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
