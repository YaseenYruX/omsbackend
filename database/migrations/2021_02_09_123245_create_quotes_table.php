<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('firstname',255);
            $table->string('lastname',255);
            $table->string('fullname',255)->virtualAs('concat(firstname," ",lastname)');
            $table->string('email',255);
            $table->string('website',255);
            // $table->string('qoute_number',255)->virtualAs('concat("QA-",id)');
            $table->enum('qoute_status',['Open','CLose']);
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
        Schema::dropIfExists('quotes');
    }
}
