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
            $table->string('lin_number')->nullable();
            $table->integer('esic_number')->nullable()->default(0);
            $table->integer('lwf_number')->nullable()->default(0);
            $table->integer('professional_tax')->nullable()->default(0);
            $table->integer('days_run_in_payroll')->nullable();
            $table->foreignId('payroll_run_acess_role')->nullable()->constrained('roles');
            $table->integer('attendence_cycle_start_day')->nullable()->default(0);
            $table->integer('payable_days_in_month')->nullable()->default(0);
            $table->string('salary_pwd')->nullable();
            $table->integer('lop_days')->nullable()->default(0);
            $table->foreignId('additional_component_in_ctc')->nullable()->constrained('salary_components');
            $table->string('ytd_start_month')->nullable();
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
