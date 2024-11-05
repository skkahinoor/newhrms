<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    protected $table = "quotations";

    protected $fillable = [
        'procurement_id',
        // 'product_per_price',
        // 'discount_price',
        // 'total_amount',
        'items',
        'remark',
        'final_delivery_date',
        'quotation_status',
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
