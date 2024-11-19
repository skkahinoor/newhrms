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
        Schema::table('procurement_items', function (Blueprint $table) {
            // Drop existing foreign keys if they exist
            // $table->dropForeign(['procurement_id']);
            // $table->dropForeign(['asset_type_id']);
            // $table->dropForeign(['brand_id']);

            // Reapply foreign key constraints with cascade
            $table->foreign('procurement_id')->references('id')->on('procurements')->onDelete('cascade');
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
        Schema::table('procurement_items', function (Blueprint $table) {
            $table->dropForeign(['procurement_id']);
            $table->dropForeign(['asset_type_id']);
            $table->dropForeign(['brand_id']);
        });
    }
};
