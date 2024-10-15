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
        Schema::create('lead_forms', function (Blueprint $table) {
            $table->id();
            $table->integer('name')->default(0);          // Name
            $table->integer('city')->default(0);          // City
            $table->integer('email')->default(0);         // Email
            $table->integer('state')->default(0);         // State
            $table->integer('companyname')->default(0);  // Company Name
            $table->integer('country')->default(0);       // Country
            $table->integer('website')->default(0);       // Website
            $table->integer('postalcode')->default(0);   // Postal Code
            $table->integer('address')->default(0);       // Address
            $table->integer('number')->default(0);        // Number
            $table->integer('message')->default(0);       // Message
            $table->integer('leadsource')->default(0); // Lead Source
            $table->integer('leadcategory')->default(0);
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
        Schema::dropIfExists('lead_forms', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('city');
            $table->dropColumn('email');
            $table->dropColumn('state');
            $table->dropColumn('company_name');
            $table->dropColumn('country');
            $table->dropColumn('website');
            $table->dropColumn('postal_code');
            $table->dropColumn('address');
            $table->dropColumn('number');
            $table->dropColumn('message');
            $table->dropColumn('leadsource');
            $table->dropColumn('leadcategory');
        });

    }
};
