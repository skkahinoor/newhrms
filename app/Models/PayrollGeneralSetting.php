<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollGeneralSetting extends Model
{
    use HasFactory;

    protected $table = 'payroll_general_settings';

    protected $fillable = [
        'lin-number',
        'esic-number',
        'lwf-number',
        'professional-tax',
        'days-run-in-payroll',
        'payroll-run-acess-role',
        'attendence-cycle-start-day',
        'payable-days-in-month',
        'salary-pwd',
        'lop-days',
        'additional-component-in-ctc',
        'ytd-start-month',
    ];

    // Role relationship
    public function payrollRunAccessRole()
    {
        return $this->belongsTo(Role::class, 'payroll-run-acess-role');
    }

    // Additional salary component relationship
    public function additionalComponentInCtc()
    {
        return $this->belongsTo(SalaryComponent::class, 'additional-component-in-ctc');
    }
}
