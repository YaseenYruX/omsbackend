<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class QuotesPurchaserPrice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {Schema::create('quotes_purchaser_price', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('qty');
            $table->float('price',255);
            $table->float('total',255)->virtualAs('qty*price');
            $table->string('supplier_name',255);
            $table->integer('quotes_item_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {Schema::dropIfExists('quotes_purchaser_price');}
}
