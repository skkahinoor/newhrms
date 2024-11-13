<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Procurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'procurement_number',
        'user_id',
        'email',
        'request_date',
        'delivery_date',
        'purpose',
        'status',
    ];

    public function brands()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function asset_types()
    {
        return $this->belongsTo(AssetType::class, 'asset_type_id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'user_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id')->withDefault();
    }
    public function items()
    {
        return $this->hasMany(ProcurementItem::class);
    }
    public function quotation()
    {
        return $this->hasMany(Quotation::class);
    }

    public function totalprice()
    {
        return $this->hasMany(Quotation::class);
    }

    
}
