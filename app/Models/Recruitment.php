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
        'posttypeid',
        'postlocationid',
        'created_by',
        'updated_by'
    ];
}
