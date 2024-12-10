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
            $table->renameColumn('applied', 'selected');
            $table->integer('totalapply')->after('totalvacancy')->default(0);
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
            $table->renameColumn('selected', 'applied');
            $table->dropColumn('totalapply');
        });
    }
};
