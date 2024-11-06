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
            // if (Schema::hasColumn('quotations', 'procurement_id')) {
            //     $table->dropColumn('procurement_id');
            // }

            // Re-add the procurement_id column with cascade delete on foreign key
            $table->foreignId('procurement_id')
                ->after('id')
                ->constrained('procurements')
                ->onDelete('cascade');
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
            $table->dropForeign(['procurement_id']);
            
            // Optionally, drop the column (if needed for a rollback)
            $table->dropColumn('procurement_id');
            
            // Or re-add without the cascade for rollback purposes
            $table->unsignedBigInteger('procurement_id');
            $table->foreign('procurement_id')
                ->references('id')
                ->on('procurements');

        });
    }
};
