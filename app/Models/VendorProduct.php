<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProduct extends Model
{
    use HasFactory;
    // protected $table = 'vendor_products';

    protected $fillable = [
        'vendor_id',
        'product_type',
        'product_brand',
        'quantity',
        'buy_price',
        'sale_price',
        'margin'
    ];

    public function asset_types()
    {
        return $this->belongsTo(AssetType::class, 'product_type', 'id');
    }
}
