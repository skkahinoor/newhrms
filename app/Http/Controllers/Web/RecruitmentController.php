<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Recruitment;
use Illuminate\Http\Request;

class RecruitmentController extends Controller
{
    public function index()
    {
        return view('recruitment.index');
    }

    public function manageRecruitment()
    {
        $postlist = Recruitment::where('status', 0)->paginate(5);
        return view('admin.recruitment.index', ['postlist' => $postlist]);
    }

    public function addPost(Request $request)
    {
        $validated = $request->validate([
            'postname' => 'required|string|max:255',
            'postexperience' => 'required|numeric|min:0',
            // 'jobtype' => 'required|exists:job_types,id',
            // 'joblocation' => 'required|exists:locations,id',
            'jobtype' => 'required',
            'joblocation' => 'required',
            'postdescription' => 'required|string',
        ]);

        Recruitment::create([
            'postname' => $request->postname,
            'experience' => $request->postexperience,
            'posttypeid' => $request->jobtype,
            'postlocationid' => $request->joblocation,
            'description' => $request->postdescription,
        ]);

        return redirect()->route('admin.recruitment.manageRecruitment')->with('success', 'Requirement added successfully!');
    }

    public function adminPostList()
    {

    }

}
