<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUpSetting extends Model
{
    use HasFactory;

    protected $table = 'follow_up_settings';

    protected $fillable = [
        'notifyday',
        'created_at',
        'updated_at'
    ];
}
