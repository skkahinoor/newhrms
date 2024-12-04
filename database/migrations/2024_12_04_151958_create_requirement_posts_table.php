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
        Schema::create('recruitment_posts', function (Blueprint $table) {
            $table->id();
            $table->string('postname');
            $table->text('description');
            $table->integer('experience');
            $table->bigInteger('posttypeid')->nullable();
            $table->bigInteger('postlocationid')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruitment_posts');
    }
};
