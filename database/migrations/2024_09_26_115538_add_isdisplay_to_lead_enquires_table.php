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
            $table->integer('isdisplay')->default(0)->limit(1)->after('leadagent');
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
            $table->dropColumn('isdisplay');
        });
    }
};
