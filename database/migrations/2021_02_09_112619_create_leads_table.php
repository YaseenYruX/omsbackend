<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('brand_id');
            $table->integer('assigned_id'); // For sales person
            $table->integer('lead_owner');
            $table->integer('user_id');
            $table->string('title',255)->nullable(true);
            $table->string('company',255)->nullable(true);
            $table->string('firstname',255);
            $table->string('lastname',255)->nullable(true);
            $table->string('fullname',255)->virtualAs('concat(firstname," ",lastname)');
            $table->string('email',255);
            $table->string('mobile',255)->nullable(true);
            $table->string('website',255)->nullable(true);
            $table->enum('lead_source',['Advertisement','Cold Call','Employee Referal','External Referal','Online Store','Twitter','Facebook','Google+','Public Relations','Sales Email Alias','Seminar Partner','Internal Seminar','Trade Show','Web Downloads','Web Research','Chat','BrokerBin'])->nullable(true);
            $table->enum('lead_status',['Attempted to Contact','Contacted','Contact in Future','Junk Lead','Lost Lead','Not Contacted','Pre-Qualified','Not Qualified'])->nullable(true);
            $table->enum('Industry',['ASP(Application Service Provider)','Data/Telecom OEM','ERP (Enterprise Resource Planning)','Government/Military','Large Enterprise','ManagementISV','MSP (Management Service Provider)','Network Equipment Enterprise','ReSeller','Integrator','End-User'])->nullable(true);
            $table->integer('total_employees')->nullable(true);
            $table->float('annual_revenue',8,2)->nullable(true);
            $table->enum('ratings',['Accuqired','Active','Market Failed','Project Cancelled','Shut Down'])->nullable(true);
            $table->string('skype_id',255)->nullable(true);
            $table->string('twitter',255)->nullable(true);
            $table->string('secondary_email',255)->nullable(true);
            $table->string('street',255)->nullable(true);
            $table->string('city',255)->nullable(true);
            $table->string('state',255)->nullable(true);
            $table->string('zip_code',10)->nullable(true);
            $table->string('country',255)->nullable(true);
            $table->string('currency',3)->nullable(true);
            $table->text('description')->nullable(true);
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
        Schema::dropIfExists('leads');
    }
}
