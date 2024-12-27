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
        Schema::create('payroll_general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('lin-number')->nullable();
            $table->integer('esic-number')->nullable()->default(0);
            $table->integer('lwf-number')->nullable()->default(0);
            $table->integer('professional-tax')->nullable()->default(0);
            $table->integer('days-run-in-payroll')->nullable();
            $table->foreignId('payroll-run-acess-role')->nullable()->constrained('roles');
            $table->integer('attendence-cycle-start-day')->nullable()->default(0);
            $table->integer('payable-days-in-month')->nullable()->default(0);
            $table->string('salary-pwd')->nullable();
            $table->integer('lop-days')->nullable()->default(0);
            $table->foreignId('additional-component-in-ctc')->nullable()->constrained('salary_components');
            $table->string('ytd-start-month')->nullable();
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
        Schema::dropIfExists('payroll_general_settings');
    }
};
