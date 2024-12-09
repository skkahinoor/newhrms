<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ApplyRecruitment;
use App\Models\User;

class JobApplicationController extends Controller
{
    public function index()
    {
        $applycandidates = ApplyRecruitment::with(['jobName'])->paginate(5);
        return view('admin.jobapplication.index', ['applycandidates' => $applycandidates]);
    }

    public function sheduleInterview($applicantId)
    {
        $shedule = ApplyRecruitment::find($applicantId)->update([
            'status' => 1,
        ]);

        return response()->json([$shedule]);
    }

    public function approveEmployee($applicantId)
    {
        $shedule = ApplyRecruitment::find($applicantId)->update([
            'status' => 2,
        ]);
        $futureemployee = ApplyRecruitment::find($applicantId);
        $createemp = User::create([
            'name' => $futureemployee->full_name,
            'email' => $futureemployee->email_address,
            'username' => $futureemployee->email_address,
            'password' => 12345678, // Default Password
            'address' => null,
            'dob' => $futureemployee->dob,
            'gender' => $futureemployee->gender,
            'marital_status' => 'single',
            'phone' => $futureemployee->mobile_number,
            'status' => 'verified',
            'is_active' => 0,
            'avatar' => null,
            'leave_allocated' => null,
            'employment_type' => 'temporary',
            'user_type' => 2,
            'joining_date' => null,
            'workspace_type' => 1,
            'remarks' => null,
            'uuid' => null,
            'fcm_token' => null,
            'device_type' => null,
            'logout_status' => 0,
            'company_id' => null,
            'online_status' => 0,
            'branch_id' => null,
            'department_id' => null,
            'post_id' => null,
            'role_id' => 3,
            'supervisor_id' => null,
            'office_time_id' => null,
            'asset_type' => null,
            'created_by' => null,
            'updated_by' => null,
            'deleted_by' => null,
            'deleted_at' => null,
            // 'created_at',
            // 'updated_at',
            // 'employee_code' => null,
        ]);
        return response()->json([$shedule, $createemp]);
    }

    public function rejectCandidate($applicantId)
    {
        $shedule = ApplyRecruitment::find($applicantId)->update([
            'status' => 3,
        ]);

        return response()->json([$shedule]);
    }
}
