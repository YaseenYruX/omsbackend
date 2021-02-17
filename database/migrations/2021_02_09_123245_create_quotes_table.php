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
            $table->integer('lead_id');
            $table->string('company',255)->nullable(true);
            $table->string('firstname',255);
            $table->string('lastname',255)->nullable(true);
            $table->string('fullname',255)->virtualAs('concat(firstname," ",lastname)');
            $table->string('email',255);
            $table->string('mobile',255)->nullable(true);
            $table->string('street',255)->nullable(true);
            $table->string('city',255)->nullable(true);
            $table->string('state',255)->nullable(true);
            $table->string('zip_code',10)->nullable(true);
            $table->string('country',255)->nullable(true);
            $table->string('currency',3)->nullable(true);
            $table->string('owner',255);
            $table->foreignId('term_id')->constrained('m_flag')->nullable(true);
            $table->string('lead_time',255)->nullable(true);
            $table->float('shipping',10,2)->nullable(true);
            $table->float('vat',10,2)->nullable(true);
            $table->text('description')->nullable(true);
            $table->integer('quote_status');
            $table->string('image',255)->nullable(true);
            
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
