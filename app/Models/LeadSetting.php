<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadSetting extends Model
{
    use HasFactory;
    protected $table = 'lead_settings';

    protected $fillable = [
        'leadid',
        'datanum',
        'leadformtitle',
        'leadformlink',
        'created_at',
        'updated_at'
    ];
}
