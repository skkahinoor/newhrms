<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayrollGeneralSetting extends Model
{
    use HasFactory;

    protected $table = 'payroll_general_settings';

    protected $fillable = [
        'lin_number',
        'esic_number',
        'lwf_number',
        'professional_tax',
        'days_run_in_payroll',
        'payroll_run_acess_role',
        'attendence_cycle_start_day',
        'payable_days_in_month',
        'salary_pwd',
        'lop_days',
        'additional_component_in_ctc',
        'ytd_start_month',
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
