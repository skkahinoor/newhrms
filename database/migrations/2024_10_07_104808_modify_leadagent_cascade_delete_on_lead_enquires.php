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
        Schema::table('lead_enquires', function (Blueprint $table) {
            // Drop the existing foreign key constraint for leadagent
            $table->dropForeign(['leadagent']);
            $table->dropForeign(['leadsource']);
            $table->dropForeign(['leadstatus']);
            $table->dropForeign(['leadcategory']);

            // Recreate the foreign key with cascade on delete for leadagent
            $table->foreign('leadagent')
                ->references('id')->on('lead_agents')
                ->onDelete('cascade');

            // Recreate agin these without cascade delete
            $table->foreign('leadsource')
                ->references('id')->on('lead_sources');

            $table->foreign('leadstatus')
                ->references('id')->on('lead_statuses');

            $table->foreign('leadcategory')
                ->references('id')->on('lead_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lead_enquires', function (Blueprint $table) {
            // Drop the foreign key with cascade on delete
            $table->dropForeign(['leadsource']);
            $table->dropForeign(['leadstatus']);
            $table->dropForeign(['leadcategory']);
        });
    }
};
