<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuoteIdToQuotesItem extends Migration
{
    public function up()
    {
        Schema::table('quotes_item', function (Blueprint $table) {
            $table->integer('quotes_id');
        });
    }
    public function down()
    {
        Schema::table('quotes_item', function (Blueprint $table) {
        });
    }
}