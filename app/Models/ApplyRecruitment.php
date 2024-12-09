<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplyRecruitment extends Model
{
    use HasFactory;
    protected $table = 'apply_recruitments';
    protected $fillable = [
        'jobpostid',
        'full_name',
        'email_address',
        'dob',
        'mobile_number',
        'gender',
        'experience_years',
        'experience_months',
        'current_ctc',
        'expected_ctc',
        'notice_period_days',
        'cv_file_path',
        'status',
    ];

    public function jobName()
    {
        return $this->belongsTo(Recruitment::class, 'jobpostid', 'id');
    }
}
