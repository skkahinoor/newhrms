<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ApplyRecruitment;
use App\Models\Recruitment;
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
    // Find the applicant details
    $applicant = ApplyRecruitment::findOrFail($applicantId);

    // Update the status of the applicant
    $applicant->update([
        'status' => 2,
    ]);

    // Update the selected count for the recruitment job post
    if ($applicant->jobpostid) {
        Recruitment::where('id', $applicant->jobpostid)->increment('selected');
    }

    // Create the employee (User record)
    $newEmployee = User::create([
        'name' => $applicant->full_name,
        'email' => $applicant->email_address,
        'username' => $applicant->email_address,
        'password' => bcrypt('12345678'), // Use bcrypt for secure hashing
        'phone' => $applicant->mobile_number,
        'gender' => $applicant->gender,
        'dob' => $applicant->dob,
        'status' => 'verified',
        'is_active' => 0,
        'employment_type' => 'temporary',
        'user_type' => 2,
        'role_id' => 3,
    ]);

    return response()->json([
        'message' => 'Applicant approved and employee created successfully.',
        'applicant_status' => $applicant,
        'new_employee' => $newEmployee,
    ]);
}


    public function rejectCandidate($applicantId)
    {
        $shedule = ApplyRecruitment::find($applicantId)->update([
            'status' => 3,
        ]);

        return response()->json([$shedule]);
    }
}
