<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FollowUp extends Model
{
    use HasFactory;
    protected $table = 'follow_ups';

    protected $fillable = [
        'leadid',
        'followupdate',
        'followuptime',
        'remark',
        'created_at',
        'updated_at',
    ];

    public function leadEnquery()
    {
        return $this->belongsTo(LeadEnquery::class, 'leadid', 'id');
    }

    public function leadEnqueryforDashboard()
    {
        return $this->belongsTo(LeadEnquery::class, 'leadid', 'id');
    }
}
