<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementItem extends Model
{
    use HasFactory;

    protected $table = "procurement_items";

    protected $fillable = [
        'procurement_id',
        'asset_type_id',
        'brand_id',
        'quantity',
        'specification',
    ];

    public function procurement()
    {
        return $this->belongsTo(Procurement::class);
    }

    public function assettype()
    {
        return $this->belongsTo(AssetType::class, 'asset_type_id', 'id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
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

}
