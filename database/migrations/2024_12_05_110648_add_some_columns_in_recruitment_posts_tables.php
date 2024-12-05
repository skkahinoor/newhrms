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
        Schema::table('recruitment_posts', function (Blueprint $table) {
            $table->integer('totalvacancy')->after('experience');
            $table->integer('applied')->after('totalvacancy');
            $table->text('salaryrange')->after('applied');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recruitment_posts', function (Blueprint $table) {
            $table->dropColumn('totalvacancy');
            $table->dropColumn('applied');
            $table->dropColumn('salaryrange');
        });
    }
};
