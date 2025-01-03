<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Gratuity;
use App\Models\PayrollGeneralSetting;
use Illuminate\Http\Request;

class PayrollGeneralSettingsController extends Controller
{
    public function index()
    {
        $payrollGeneralSetting = PayrollGeneralSetting::first();
        $gratuityshow = Gratuity::first();
        return view('admin.payrollSetting.generalSettings.index', compact('gratuityshow', 'payrollGeneralSetting'));
    }

    public function payrollGeneralSettingEdit(Request $request)
    {
        // $request->validate([
        //     'lin_number' => 'required',
        //     'esic_number' => 'required',
        //     'lwf_number' => 'required',
        //     'professional_tax' => 'required',
        //     'days_run_in_payroll' => 'required',
        //     'payroll_run_acess_role' => 'required',
        //     'attendence_cycle_start_day' => 'required',
        //     'payable_days_in_month' => 'required',
        //     'salary_pwd' => 'required',
        //     'lop_days' => 'required',
        //     'additional_component_in_ctc' => 'required',
        //     'ytd_start_month' => 'required',
        // ]);

        // PayrollGeneralSetting::create($request->all());

        $generalsetting = PayrollGeneralSetting::firstOrNew();
        $generalsetting->lin_number = $request->lin_number;
        $generalsetting->esic_number = $request->esic_number;
        $generalsetting->lwf_number = $request->lwf_number;
        $generalsetting->professional_tax = $request->professional_tax;
        $generalsetting->days_run_in_payroll = $request->days_run_in_payroll;
        $generalsetting->payroll_run_acess_role = $request->payroll_run_acess_role;
        $generalsetting->attendence_cycle_start_day = $request->attendence_cycle_start_day;
        $generalsetting->payable_days_in_month = $request->payable_days_in_month;
        $generalsetting->salary_pwd = $request->salary_pwd;
        $generalsetting->lop_days = $request->lop_days;
        $generalsetting->additional_component_in_ctc = $request->additional_component_in_ctc;
        $generalsetting->ytd_start_month = $request->ytd_start_month;
        $generalsetting->save();

        return redirect()->route('admin.payroll-general-settings.index')->with('success', 'Payroll general settings saved successfully.');
    }

   

    public function gratuityEdit(Request $request)
    {
        $gratuity = Gratuity::firstOrNew();
        $gratuity->gratuity = $request->gratuity;
        $gratuity->save();
       
       

        return redirect()->route('admin.payroll-general-settings.index')->with('success', 'Gratuity settings saved successfully.');
    }
}
