<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\ApplyRecruitment;
use App\Models\Company;
use App\Models\Recruitment;
use App\Models\RecruitmentLocation;
use App\Models\RecruitmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RecruitmentController extends Controller
{
    // Frontend Part Start
    public function index()
    {
        $activejobcount = Recruitment::where('status', 0)->count();
        if ($activejobcount > 11) {
            $activejobcount = ($activejobcount - 1) . '+';
        }
        $applypage = Recruitment::where('status', 0)->with(['location'])->get();
        // dd($applypage);
        $applybylocation = RecruitmentLocation::where('status', 0)->limit(5)->get();
        return view('recruitment.index', ['applypage' => $applypage, 'applybylocation' => $applybylocation, 'activejobcount' => $activejobcount]);
    }

    public function viewJob(Request $request)
    {
        $id = $request->input('id'); // Retrieve the ID from the request body
        $viewcurrentjob = Recruitment::findOrFail($id);
        $applybylocation = RecruitmentLocation::where('status', 0)->limit(5)->get();
        $activejobcount = Recruitment::where('status', 0)->count();
        return view('recruitment.view', ['viewcurrentjob' => $viewcurrentjob, 'applybylocation' => $applybylocation, 'activejobcount' => $activejobcount]);
    }

    public function apply(Request $request)
    {
        $activejobcount = Recruitment::where('status', 0)->count();
        $applypage = Recruitment::where('status', 0)->with(['location'])->get();
        // dd($applypage);
        $applybylocation = RecruitmentLocation::where('status', 0)->limit(5)->get();
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|min:10|max:10',
            'experience_years' => 'required|integer|min:0',
            'experience_months' => 'required|integer|min:0|max:11',
            'current_ctc' => 'required|numeric|min:0',
            'expected_ctc' => 'required|numeric|min:0',
            'notice_period' => 'required|integer|min:0',
            'cv' => 'required|mimes:pdf|max:5048', // Max size 5MB
        ]);

        // Handle file upload
        $cvPath = null;
        if ($request->hasFile('cv')) {
            // Get the original filename
            $filename = time() . '_' . $request->file('cv')->getClientOriginalName();

            // Move the file to the "resume" directory under "public"
            $request->file('cv')->move(public_path('uploads/resume'), $filename);

            // Save the relative file path
            $cvPath = $filename;
        }

        // Save application to the database
        ApplyRecruitment::create([
            'jobpostid' => $request->jobpostid,
            'full_name' => $request->full_name,
            'email_address' => $request->email,
            'dob' => $request->dob,
            'mobile_number' => $request->mobile,
            'gender' => $request->gender,
            'experience_years' => $request->experience_years,
            'experience_months' => $request->experience_months,
            'current_ctc' => $request->current_ctc,
            'expected_ctc' => $request->expected_ctc,
            'notice_period_days' => $request->notice_period,
            'cv_file_path' => $cvPath,
        ]);

        Recruitment::where('id', $request->jobpostid)->increment('totalapply');

        return view('recruitment.index', ['activejobcount' => $activejobcount, 'applybylocation' => $applybylocation, 'activejobcount' => $activejobcount, 'applypage' => $applypage])->with('success', 'Your application has been submitted successfully!');
    }

    // Admin part start

    public function manageRecruitment()
    {
        $companyname = Company::first();
        // dd($companyname);
        $postlist = Recruitment::where('status', 0)->orderBy('id', 'desc')->paginate(5);
        $posttype = RecruitmentType::where('status', 0)->paginate(5);
        $postlocation = RecruitmentLocation::where('status', 0)->paginate(5);

        // Apply Post Section
        $applyposttype = RecruitmentType::where('status', 0)->get();
        $applypostlocation = RecruitmentLocation::where('status', 0)->get();
        return view('admin.recruitment.index', ['postlist' => $postlist, 'posttype' => $posttype, 'postlocation' => $postlocation, 'applyposttype' => $applyposttype, 'applypostlocation' => $applypostlocation, 'companyname' => $companyname]);
    }

    public function view($id)
    {
        $viewjob = Recruitment::find($id);
        return view('admin.recruitment.view', ['viewjob' => $viewjob]);
    }

    public function addPost(Request $request)
    {
        $request->validate([
            'postname' => 'required|string|max:50',
            'postexperience' => 'required|numeric|min:0',
            'totalvacancy' => 'required',
            'salaryrange' => 'required',
            'jobtype' => 'required',
            'joblocation' => 'required',
            'postdescription' => 'required|string',
        ]);

        Recruitment::create([
            'postname' => $request->postname,
            'experience' => $request->postexperience,
            'totalvacancy' => $request->totalvacancy,
            'salaryrange' => $request->salaryrange,
            'posttypeid' => $request->jobtype,
            'postlocationid' => $request->joblocation,
            'description' => $request->postdescription,
        ]);

        return redirect()->route('admin.recruitment.manageRecruitment')->with('success', 'Requirement added successfully!');
    }

    public function updatePost(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:recruitment_posts,id',
            'postname' => 'required|string|max:255',
            'postexperience' => 'required|numeric|min:0',
            'totalvacancy' => 'required|integer|min:1',
            'salaryrange' => 'required|string|max:255',
            'jobtype' => 'required|integer|exists:recruitment_types,id',
            'joblocation' => 'required|integer|exists:recruitment_locations,id',
            'postdescription' => 'required|string',
        ]);

        Recruitment::find($request->post_id)->update([
            'postname' => $request->postname,
            'experience' => $request->postexperience,
            'totalvacancy' => $request->totalvacancy,
            'salaryrange' => $request->salaryrange,
            'posttypeid' => $request->jobtype,
            'postlocationid' => $request->joblocation,
            'description' => $request->postdescription,
        ]);

        return redirect()->back()->with('success', 'Post updated successfully!');
    }

    public function deletePost($deletejob)
    {
        $deletejob = Recruitment::find($deletejob)->delete();

        return response()->json([$deletejob]);
    }

    public function addPostType(Request $request)
    {
        $request->validate([
            'posttype' => 'required|string|max:20',
        ],
            [
                'posttype' => 'Post Type Maximum Limit is 20 words',
            ]);

        RecruitmentType::create([
            'posttype' => $request->posttype,
        ]);
        return redirect()->route('admin.recruitment.manageRecruitment')->with('success', 'Requirement Type added successfully!');
    }

    public function updatePostType(Request $request, $id)
    {
        $request->validate([
            'editposttype' => 'required|string|max:20',
        ],
            [
                'editposttype' => 'Post Type Maximum Limit is 20 words',
            ]);

        $editposttype = RecruitmentType::find($id)->update([
            'posttype' => $request->editposttype,
        ]);

        return redirect()->back()->with('success', 'Post Type updated successfully!');
    }

    public function deletePostType($id)
    {
        RecruitmentType::find($id)->delete();
        return redirect()->back()->with('success', 'Post Type deleted successfully!');
    }

    public function addPostLocation(Request $request)
    {
        $request->validate([
            'postlocation' => 'required|string|min:1|max:100',
        ],
            [
                'postlocation' => 'Post Location Minimum words Limit is 1 & Maximum words Limit is 100 words',
            ]);

        RecruitmentLocation::create([
            'postlocation' => $request->postlocation,
        ]);
        return redirect()->route('admin.recruitment.manageRecruitment')->with('success', 'Requirement Location added successfully!');
    }

    public function updatePostLocation(Request $request, $id)
    {
        $request->validate([
            'editpostlocation' => 'required|string|max:20',
        ],
            [
                'editpostlocation' => 'Post Type Maximum Limit is 20 words',
            ]);

        $editpostlocation = RecruitmentLocation::find($id)->update([
            'postlocation' => $request->editpostlocation,
        ]);

        return redirect()->back()->with('success', 'Post Location updated successfully!');
    }

    public function deletePostLocation($id)
    {
        RecruitmentLocation::find($id)->delete();
        return redirect()->back()->with('success', 'Post Location deleted successfully!');
    }

}
