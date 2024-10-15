<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadStatus extends Model
{
    use HasFactory;

    protected $table = 'lead_statuses';

    protected $fillable = [
        'color',
        'name',
        'is_default',
        'is_deleted',
        'created_at',
        'updated_at'
    ];
}
