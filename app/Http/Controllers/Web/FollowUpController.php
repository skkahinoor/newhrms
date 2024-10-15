<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\FollowUp;
use App\Models\FollowUpSetting;
use App\Models\LeadAgent;
use App\Models\LeadStatus;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowUpController extends Controller
{
    public function index(Request $request)
    {
        try {
            $role = Role::all();
            $admin = User::where('role_id', $role);
            $user = Auth::user();
            $leadstatuses = LeadStatus::all();
            $leadagents = LeadAgent::all();
            $currentDate = Carbon::now();
            $followupsetting = FollowUpSetting::first();
            $limit = $followupsetting ? $followupsetting->limit : 10;


            if (auth()->user()->role_id == $user->id) {
                $isAdmin = true;
                $followuplist = FollowUp::orderBy('followupdate')->paginate($limit);
            } else {
                $isAdmin = false;
                $leadAgent = LeadAgent::where('userid', $user->id)->first();

                if ($leadAgent) {
                    $followuplist = FollowUp::whereHas('leadEnquery.leadAgent', function ($query) use ($leadAgent) {
                        $query->where('id', $leadAgent->id);
                    })
                        ->with('leadEnquery')
                        ->orderBy('followupdate', 'asc')
                        ->paginate($limit);
                } else {
                    $followuplist = collect();
                }
            }

            return view('admin.followup.index', ['followuplist' => $followuplist, 'currentDate' => $currentDate, 'isAdmin' => $isAdmin, 'leadstatuses' => $leadstatuses, 'leadagents' => $leadagents]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function getFollowUpRemark($id)
    {
        $followup = FollowUp::find($id);
        if ($followup) {
            return response()->json([
                'success' => true,
                'remark' => $followup->remark ?? 'No Remark Available',
                'lead' => $followup->leadEnquery->name ?? 'Not Set',
                'followupDate' => $followup->followupdate ?? 'Not Set',
                'followupTime' => $followup->followuptime ?? 'Not Set',
            ]);
        }
        return response()->json([
            'success' => false,
            'message' => 'FollowUp not found',
        ]);
    }

    public function update(Request $request, $id) // lead source update
    {

        // Validate the request
        $request->validate([
            'followupdate' => 'required',
            'followuptime' => 'required',
            'remark' => 'required'
        ]);

        // Find the lead source and update its name
        $editfollowuplist = FollowUp::findOrFail($id);
        $editfollowuplist->followupdate = $request->input('followupdate');
        $editfollowuplist->followuptime = $request->input('followuptime');
        $editfollowuplist->remark = $request->input('remark');
        $editfollowuplist->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Follow Up Data updated successfully!');

    }

    public function followup_destroy($id)
    {
        // Find the lead source by ID
        $deletefollowup = FollowUp::findOrFail($id);

        // Delete the lead source
        $deletefollowup->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Follow Up deleted successfully!');
    }

}
