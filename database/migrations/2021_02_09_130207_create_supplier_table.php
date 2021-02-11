<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('supplier', function (Blueprint $table) {
        //     $table->bigIncrements('id');
        //     $table->string('owner',255);
        //     $table->string('fullname',255);
        //     $table->string('email',255);
        //     $table->string('phone',255);
        //     $table->string('website',255);
        //     $table->enum('gl_account',['Sales-Software','Sales-Hardware','Rental-Home','Interest Income','Sales Software Support','Sales Other','Inteerest Sales','Labor Hardware Service']);
        //     $table->string('category',255);
        //     $table->string('street',255);
        //     $table->string('city',255);
        //     $table->string('state',255);
        //     $table->string('zip_code',255);
        //     $table->string('country',255);
        //     $table->text('description');
        //     $table->string('images');
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier');
    }
}
