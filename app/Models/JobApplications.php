<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplications extends Model
{
    use HasFactory;
    protected $table = 'job_applications';
    protected $fillable = [
        'full_name',
        'email_address',
        'mobile_number',
        'experience_years',
        'experience_months',
        'current_ctc',
        'expected_ctc',
        'notice_period_days',
        'cv_file_path',
    ];
}
