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

    public function assetType()
    {
        return $this->belongsTo(AssetType::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

}
