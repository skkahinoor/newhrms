<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadForms extends Model
{
    use HasFactory;

    protected $table = 'lead_forms';

    protected $fillable = [
        'name',    
        'city',    
        'email',    
        'state',    
        'companyname',   
        'country',    
        'website',    
        'postalcode',    
        'address',    
        'number',    
        'message',    
        'leadsourceid',
        'leadcategoryid',
    ];
}
