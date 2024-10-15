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
