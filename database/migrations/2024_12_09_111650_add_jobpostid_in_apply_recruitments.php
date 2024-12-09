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
        Schema::table('apply_recruitments', function (Blueprint $table) {
            $table->foreignId('jobpostid')
            ->after('id')
            ->nullable()
            ->constrained('recruitment_posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apply_recruitments', function (Blueprint $table) {
            $table->dropColumn('apply_recruitments');
        });
    }
};