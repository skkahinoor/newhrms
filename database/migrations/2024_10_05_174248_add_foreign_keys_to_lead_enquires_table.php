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
            $table->unsignedBigInteger('leadsource')->change();
            $table->unsignedBigInteger('leadcategory')->change();
            $table->unsignedBigInteger('leadstatus')->change();
            $table->unsignedBigInteger('leadagent')->change();

            $table->foreign('leadsource')
                  ->references('id')->on('lead_sources')
                  ->onDelete('cascade');

            $table->foreign('leadcategory')
                  ->references('id')->on('lead_categories')
                  ->onDelete('cascade');

            $table->foreign('leadstatus')
                  ->references('id')->on('lead_statuses')
                  ->onDelete('cascade');

            $table->foreign('leadagent')
                  ->references('id')->on('lead_agents')
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
        Schema::table('lead_enquires', function (Blueprint $table) {
            $table->dropForeign(['leadsource']);
            $table->dropForeign(['leadcategory']);
            $table->dropForeign(['leadstatus']);
            $table->dropForeign(['leadagent']);
        });
    }
};
