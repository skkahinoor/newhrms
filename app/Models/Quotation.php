<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quotation extends Model
{
    use HasFactory;

    protected $table = "quotations";

    protected $fillable = [
        'procurement_id',
        'vendor_id',
        // 'product_per_price',
        // 'discount_price',
        // 'total_amount',
        'items',
        'total_item_price',
        'remark',
        'final_delivery_date',
        'is_approved',
        'quotation_status',
    ];

    protected $casts = [
        'items' => 'array',
    ];
    
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }
}
