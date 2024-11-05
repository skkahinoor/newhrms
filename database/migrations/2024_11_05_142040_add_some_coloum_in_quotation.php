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
        Schema::table('quotations', function (Blueprint $table) {
            $table->double('product_per_price')->nullable()->after('procurement_id');
            $table->double('discount_price')->nullable()->after('product_per_price');
            $table->double('total_amount')->nullable()->after('discount_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotations', function (Blueprint $table) {
            $table->dropColumn('product_per_price');
            $table->dropColumn('discount_price');
            $table->dropColumn('total_amount');
        });
    }
};
