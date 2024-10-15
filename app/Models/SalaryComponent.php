<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;

class SalaryComponent extends Model
{
    use HasFactory;

    const COMPONENT_TYPE = [
        'earning' => 'Earning',
        'deductions' => 'Deduction'
    ];

    const VALUE_TYPE = [
        'fixed' => 'Fixed',
        'ctc' => 'CTC Percent',
        'basic' => 'Basic Percent'
    ];

    const STATUS = [];

    protected $table = 'salary_components';

    protected $fillable = [
        'name',
        'component_type',
        'value_type',
        'component_value_monthly',
        'status',
        'created_by',
        'updated_by'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = Auth::user()->id;
        });

        static::updating(function ($model) {
            $model->updated_by = Auth::user()->id;
        });
    }

    public function salaryGroups(): BelongsToMany
    {
        return $this->belongsToMany(SalaryGroup::class,'salary_group_component',
            'salary_component_id',
            'salary_group_id');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', true);
    }
}