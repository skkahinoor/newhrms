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
        Schema::create('procurements', function (Blueprint $table) {
            $table->id();
            $table->string('procurement_number');
            $table->string('email');
            $table->integer('quantity');
            $table->date('request_date');
            $table->date('delivery_date')->nullable();
            $table->string('purpose')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('asset_type_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('status')->default(0);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('asset_type_id')->references('id')->on('asset_types');
            $table->foreign('brand_id')->references('id')->on('brands');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('procurements');
    }
};
