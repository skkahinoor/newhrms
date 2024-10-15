<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadEnquery extends Model
{
    use HasFactory;

    protected $table = 'lead_enquires';

    protected $fillable = [
        'name',
        'email',
        'number',
        'leadsource',
        'leadcategory',
        'city',
        'state',
        'companyname',
        'country',
        'website',
        'postalcode',
        'address',
        'message',
        'leadstatus',
        'leadagent',
        'created_by',
        'updated_by',
    ];

    public function assignedUser()
    {

        return $this->belongsTo(User::class, 'assign_user');
    }

    public function assignedAgent()
    {
        return $this->belongsTo(LeadAgent::class, 'leadagent');
    }

    // Followup table relationship
    public function followups()
    {
        return $this->hasMany(FollowUp::class, 'leadid', 'id');
    }

    public function status()
    {
        return $this->belongsTo(LeadStatus::class, 'leadstatus');
    }

// In LeadEnquery model
    public function leadSource()
    {
        return $this->belongsTo(LeadSource::class, 'leadsource');
    }

    public function leadCategory()
    {
        return $this->belongsTo(LeadCategory::class, 'leadcategory');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function leadAgent()
    {
        return $this->belongsTo(LeadAgent::class, 'leadagent');
    }
}
