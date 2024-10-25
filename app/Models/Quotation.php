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
        'vendor_product_id',
        'calculated_amount',
        'discounted_amount',
        'final_amount',
        'remark',
        'final_delivery_date',
        'quotation_status',
    ];
}
