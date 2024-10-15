<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_enquires', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('city')->nullable();
            $table->string('email');
            $table->string('state')->nullable();
            $table->string('companyname')->nullable();
            $table->string('country')->nullable();
            $table->string('website')->nullable();
            $table->string('postalcode')->nullable();
            $table->string('number');
            $table->string('address')->nullable();
            $table->text('message')->nullable();
            $table->integer('leadsource');
            $table->integer('leadcategory');
            $table->integer('leadstatus');
            $table->integer('leadagent');
            $table->integer('isdisplay');
            $table->rememberToken();
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
        //
    }
};
