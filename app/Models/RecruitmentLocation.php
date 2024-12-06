<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecruitmentLocation extends Model
{
    use HasFactory;

    protected $table = 'recruitment_locations';

    protected $fillable = [
        'postlocation',
        'status',
        'created_by',
        'updated_by'
    ];

    public function recruitment(){
        return $this->hasMany(Recruitment::class);
    }
}
