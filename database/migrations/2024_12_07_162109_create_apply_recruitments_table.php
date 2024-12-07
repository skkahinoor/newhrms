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
        Schema::create('apply_recruitments', function (Blueprint $table) {
            $table->id();
            $table->string('full_name'); // Full Name
            $table->string('email_address')->unique(); // Email Address
            $table->string('mobile_number', 10); // Mobile Number
            $table->integer('experience_years')->default(0); // Experience (Years)
            $table->integer('experience_months')->default(0); // Experience (Months)
            $table->decimal('current_ctc', 8, 2)->nullable(); // Current CTC (Lakhs)
            $table->decimal('expected_ctc', 8, 2)->nullable(); // Expected CTC (Lakhs)
            $table->integer('notice_period_days')->default(0); // Notice Period (Days)
            $table->string('cv_file_path'); // CV File Path (For storing PDF)
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
        Schema::dropIfExists('apply_recruitments');
    }
};
