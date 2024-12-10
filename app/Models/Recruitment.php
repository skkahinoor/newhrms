<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitment extends Model
{
    use HasFactory;

    protected $table = 'recruitment_posts';

    protected $fillable = [
        'postname',
        'description',
        'experience',
        'totalvacancy',
        'totalapply',
        'selected',
        'salaryrange',
        'posttypeid',
        'postlocationid',
        'created_by',
        'updated_by'
    ];

    public function location()
    {
        return $this->belongsTo(RecruitmentLocation::class, 'postlocationid', 'id');
    }

    public function type()
    {
        return $this->belongsTo(RecruitmentType::class, 'posttypeid', 'id');
    }
}
