<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentType extends Model
{
    use HasFactory;

    protected $table = 'recruitment_types';

    protected $fillable = [
        'posttype',
        'status',
        'created_by',
        'updated_by'
    ];
}
