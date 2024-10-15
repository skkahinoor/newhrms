<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadAgent extends Model
{
    use HasFactory;

    protected $table = 'lead_agents';

    protected $fillable = [
        'userid',
        'username',
        'is_deleted',
        'created_at',
        'updated_at'
    ];
}
