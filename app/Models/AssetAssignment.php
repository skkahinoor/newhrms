<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetAssignment extends Model
{
    use HasFactory;

    protected $fillable = [
        'asset_type_id',
        'asset_id',
        'user_id',
        'assign_date',
        'return_date',
        'returned',
        'damaged',
        'cost_of_damage',
        'paid',
        'damage_reason',
        'assign_status',
        'return_status'
    ];

    protected $attributes = [
        'returned' => 0,
        'assign_status' => 1
    ];

    const BOOLEAN_DATA = [
        0 => 'No',
        1 => 'Yes'
    ];
    const RECORDS_PER_PAGE = 20;

    public function users(){
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function assets(){
        return $this->belongsTo(Asset::class,'asset_id','id');
    }

    public function asset_types(){
        return $this->belongsTo(AssetType::class,'asset_type_id','id');
    }  
}
