<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Recruitment;
use App\Models\RecruitmentLocation;
use App\Models\RecruitmentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RecruitmentController extends Controller
{
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

    public function manageRecruitment()
    {
        $postlist = Recruitment::where('status', 0)->orderBy('id', 'desc')->paginate(5);
        $posttype = RecruitmentType::where('status', 0)->paginate(5);
        $postlocation = RecruitmentLocation::where('status', 0)->paginate(5);

        // Apply Post Section
        $applyposttype = RecruitmentType::where('status', 0)->get();
        $applypostlocation = RecruitmentLocation::where('status', 0)->get();
        return view('admin.recruitment.index', ['postlist' => $postlist, 'posttype' => $posttype, 'postlocation' => $postlocation, 'applyposttype' => $applyposttype, 'applypostlocation' => $applypostlocation]);
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
            'postdescription' => 'required|string|min:20|max:30',
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
