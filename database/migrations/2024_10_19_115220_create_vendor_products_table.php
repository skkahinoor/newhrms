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
        Schema::create('vendor_products', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id'); // Get vendor from paticular asset type
            $table->integer('product_type'); // Fetch data and store from asset type
            $table->string('product_brand');
            $table->integer('quantity');
            $table->float('buy_price');
            $table->float('sale_price');
            $table->float('margin')->nullable()->default(null);
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
        Schema::dropIfExists('vendor_products');
    }
};
