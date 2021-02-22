<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PurchaserQuote extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('purchaser_quote', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('quote_id')->constrained('quotes');
            $table->foreignId('purchaser_id')->constrained('users');
            $table->string('lead_time',255);
            $table->float('shipping',10,2);
            $table->text('additional_details');
            $table->integer('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('purchaser_quote');
    }
}
