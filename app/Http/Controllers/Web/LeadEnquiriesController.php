<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Imports\LeadEnqueryImport;
use App\Models\Branch;
use App\Models\Department;
use App\Models\FollowUp;
use App\Models\LeadAgent;
use App\Models\LeadCategory;
use App\Models\LeadEnquery;
use App\Models\LeadForms;
use App\Models\LeadSetting;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use App\Models\Role;
use App\Models\User;
use Exception;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LeadEnquiriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leadcategory = LeadCategory::all();
        $leadsource = LeadSource::all();
        $setting = LeadSetting::first();
        $leadform = LeadForms::first();
        return view('leadenquiry.create', ['leadcategory' => $leadcategory, 'leadsource' => $leadsource, 'setting' => $setting, 'leadform' => $leadform]);
    }

    public function list(Request $request)
    {
        $this->authorize('view_leadsenquiries_list');
        try {
            $role = Role::all();
            $admin = User::where('role_id', $role);
            $user = Auth::user();
            $leadstatuses = LeadStatus::all();
            $leadagents = LeadAgent::all();
            $leadStatuses = LeadStatus::where('id', '!=', 1)->get();
            $leadform = LeadForms::first();
            $leadcategory = LeadCategory::all();
            $leadsource = LeadSource::all();

            // Fetch lead settings data
            $leadSetting = LeadSetting::first();
            $datanum = $leadSetting ? $leadSetting->datanum : 5;
            $leadformlink = $leadSetting ? $leadSetting->leadformlink : null;

            // Prepare filter parameters
            $filterParameters = [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'leadstatus' => $request->input('leadstatus'),
                'leadagent' => $request->input('leadagent'),
            ];

            if (auth()->user()->role_id == $user->id) { // For Admin
                $query = LeadEnquery::with('status', 'leadCategory');
                $isAdmin = true;

                // Apply filters
                if ($filterParameters['name']) {
                    $query->where('name', 'like', '%' . $filterParameters['name'] . '%');
                }
                if ($filterParameters['email']) {
                    $query->where('email', 'like', '%' . $filterParameters['email'] . '%');
                }
                if ($filterParameters['leadstatus']) {
                    $query->where('leadstatus', $filterParameters['leadstatus']);
                }
                if ($filterParameters['leadagent']) {
                    $query->where('leadagent', $filterParameters['leadagent']);
                }
                $leadenquiry = $query->paginate($datanum);
            } else {
                $isAdmin = false;
                $leadAgent = LeadAgent::where('userid', $user->id)->first();

                if ($leadAgent) {
                    $query = LeadEnquery::where('leadagent', $leadAgent->id)->with('status', 'leadCategory');
                    // Apply filters for non-admin
                    if ($filterParameters['name']) {
                        $query->where('name', 'like', '%' . $filterParameters['name'] . '%');
                    }
                    if ($filterParameters['email']) {
                        $query->where('email', 'like', '%' . $filterParameters['email'] . '%');
                    }
                    if ($filterParameters['leadstatus']) {
                        $query->where('leadstatus', $filterParameters['leadstatus']);
                    }
                    $leadenquiry = $query->paginate($datanum);
                } else {
                    $leadenquiry = collect();
                }
            }

            return view('admin.leadenquiry.index', ['leadenquiry' => $leadenquiry, 'isAdmin' => $isAdmin, 'leadstatuses' => $leadstatuses, 'leadformlink' => $leadformlink, 'leadagents' => $leadagents, 'leadStatuses' => $leadStatuses, 'leadform' => $leadform, 'leadcategory' => $leadcategory, 'filterParameters' => $filterParameters, 'leadsource' => $leadsource]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    // Add Lead and store it through Modal
    public function addleadstore(Request $requestlead)
    {
        // Validate the request
        $requestlead->validate([
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required|max:10|min:10|unique:lead_enquires',
            'leadsource' => 'required|not_in:0',
            'leadcategory' => 'required',
        ]);

        // Fetch the default lead status
        $defaultLeadStatusa = DB::table('lead_statuses')->where('is_default', 1)->first();

        // Check if default lead status exists
        if (!$defaultLeadStatusa) {
            return response()->json(['message' => 'Default lead status not found.', 'status' => false], 404);
        }

        // Create a new lead source
        LeadEnquery::create([
            'name' => $requestlead->input('name'),
            'email' => $requestlead->input('email'),
            'number' => $requestlead->input('number'),
            'leadsource' => $requestlead->input('leadsource'),
            'leadcategory' => $requestlead->input('leadcategory'),
            'city' => $requestlead->input('city'),
            'state' => $requestlead->input('state'),
            'companyname' => $requestlead->input('companyname'),
            'country' => $requestlead->input('country'),
            'website' => $requestlead->input('website'),
            'postalcode' => $requestlead->input('postalcode'),
            'address' => $requestlead->input('address'),
            'message' => $requestlead->input('message'),
            'leadstatus' => $defaultLeadStatusa->id,
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Lead Source added successfully!');
    }

    // Import Excel Data
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv,txt',
        ]);

        Excel::import(new LeadEnqueryImport, $request->file('file'));

        return back()->with('success', 'Lead Enqueries imported successfully.');

        // dd($request->file('file'));
    }

    // AFter assign Agents from dropdown
    public function updateLAgents(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'lead_id' => 'required|exists:lead_enquires,id',
            'agent_id' => 'required|exists:lead_agents,id',
        ]);

        // Find the lead enquiry
        $leadEnquiry = LeadEnquery::find($request->lead_id);

        // Update the assigned agent
        $leadEnquiry->leadagent = $request->agent_id; // Update using leadagent column
        $leadEnquiry->save();

        // Return a success response
        return response()->json(['success' => true, 'message' => 'Agent assigned successfully!']);
    }

    public function updateLStatus(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'lead_id' => 'required|exists:lead_enquires,id',
            'status_id' => 'required|exists:lead_statuses,id',
        ]);

        // Find the lead enquiry
        $leadEnquiry = LeadEnquery::find($request->lead_id);

        // Update the status
        $leadEnquiry->leadstatus = $request->status_id; // Update using leadstatus column
        $leadEnquiry->save();

        // Return a success response
        return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
    }

    public function updateStatus(Request $request)
    {
        $lead = LeadEnquery::find($request->lead_id);
        $lead->leadstatus = $request->status_id;
        $lead->save();

        return response()->json(['message' => 'Status updated successfully']);
    }

    public function updateAgents(Request $request)
    {
        $lead = LeadEnquery::find($request->lead_id);
        $lead->leadagent = $request->agent_id;
        $lead->save();

        return response()->json(['message' => 'Agent Assign successfully']);
    }

    public function getLeadStatuses()
    {
        $leadStatuses = LeadStatus::all(); // Fetch all lead statuses
        return response()->json(['data' => $leadStatuses]);
    }

    public function getLeadAgents()
    {
        $leadAgents = LeadAgent::all(); // Fetch all lead Agents
        return response()->json(['data' => $leadAgents]);
    }

    public function updateLeadStatus(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'lead_ids' => 'required|array', // Ensure lead_ids is an array
            'lead_ids.*' => 'exists:lead_enquires,id', // Validate each lead ID exists
            'status_id' => 'required|exists:lead_statuses,id', // Validate the status ID
        ]);

        // Update the status for each selected lead
        foreach ($request->lead_ids as $leadId) {
            $lead = LeadEnquery::find($leadId);
            if ($lead) {
                $lead->leadstatus = $request->status_id;
                $lead->save();
            }
        }

        return response()->json(['message' => 'Status updated successfully for selected leads!']);
    }

    public function updateLeadAgent(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'lead_ids' => 'required|array', // Ensure lead_ids is an array
            'lead_ids.*' => 'exists:lead_enquires,id', // Validate each lead ID exists
            'agent_id' => 'required|exists:lead_agents,id', // Validate the agent ID
        ]);

        // Update the agent for each selected lead
        foreach ($request->lead_ids as $leadId) {
            $lead = LeadEnquery::find($leadId);
            if ($lead) {
                $lead->leadagent = $request->agent_id;
                $lead->save();
            }
        }

        return response()->json(['message' => 'Agent updated successfully for selected leads!']);
    }

    public function deleteLeads(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'lead_ids' => 'required|array',
            'lead_ids.*' => 'exists:lead_enquires,id', // Validate each lead ID exists
        ]);

        // Delete each selected lead
        LeadEnquery::destroy($request->lead_ids); // This will delete all specified IDs

        return response()->json(['message' => 'Leads deleted successfully!']);
    }

    // Add Follow Up Store method is here
    public function addfollowup_store(Request $request)
    {
        // dd($request->all());
        // Validate the request
        $request->validate([
            'followupdate' => 'required',
            'followuptime' => 'required',
            'remark' => 'required',
            'lead_id' => 'required',
        ]);

        FollowUp::create([
            'followupdate' => $request->input('followupdate'),
            'followuptime' => $request->input('followuptime'),
            'remark' => $request->input('remark'),
            'leadid' => $request->input('lead_id'),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Follow Up Created successfully!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $leadcategory = LeadCategory::all();
        return view('leadenquiry.create');
    }

    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate only the required fields
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required|max:10|min:10|unique:lead_enquires',
            'leadsource' => 'required|not_in:0',
            'leadcategory' => 'required',
        ]);

        // Fetch the default lead status
        $defaultLeadStatus = DB::table('lead_statuses')->where('is_default', 1)->first();

        // Check if default lead status exists
        if (!$defaultLeadStatus) {
            return response()->json(['message' => 'Default lead status not found.', 'status' => false], 404);
        }

        // Merge validated data with non-validated fields
        $data = array_merge($validated, [
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'companyname' => $request->input('companyname'),
            'country' => $request->input('country'),
            'website' => $request->input('website'),
            'postalcode' => $request->input('postalcode'),
            'address' => $request->input('address'),
            'message' => $request->input('message'),
            'leadstatus' => $defaultLeadStatus->id,
        ]);

        // Create the lead enquiry
        if (LeadEnquery::create($data)) {
            return response()->json(['message' => 'Lead Enquiry created successfully!', 'status' => true]);
        } else {
            return response()->json(['message' => 'Error creating Lead Enquiry.', 'status' => false]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $enquire = LeadEnquery::with(['leadSource', 'leadCategory', 'status', 'followups', 'assignedAgent'])->findOrFail($id);

        // Prepare follow-up data as an array
        $followups = $enquire->followups->sortByDesc('followupdate')->map(function ($followup) {
            return [
                'date' => $followup->followupdate,
                'time' => $followup->followuptime,
                'remark' => $followup->remark,
            ];
        })->values()->toArray();

        if (!$enquire) {
            return response()->json(['error' => 'Enquire not found'], 404);
        }
        return response()->json([
            'name' => $enquire->name ?? 'Not Set',
            'city' => $enquire->city ?? 'Not Set',
            'email' => $enquire->email ?? 'Not Set',
            'state' => $enquire->state ?? 'Not Set',
            'companyname' => $enquire->companyname ?? 'Not Set',
            'country' => $enquire->country ?? 'Not Set',
            'website' => $enquire->website ?? 'Not Set',
            'postalcode' => $enquire->postalcode ?? 'Not Set',
            'address' => $enquire->address ?? 'Not Set',
            'number' => $enquire->number ?? 'Not Set',
            'message' => $enquire->message ?? 'Not Set',
            // 'leadsource' => $enquire->leadSource ? $enquire->leadSource->name : null,
            // 'leadcategory' => $enquire->leadCategory ? $enquire->leadCategory->name : null,
            'leadsource' => $enquire->leadSource->name ?? 'Not Set',
            'leadcategory' => $enquire->leadCategory->name ?? 'Not Set',
            'leadagents' => $enquire->assignedAgent->username ?? 'Not Set',
            'leadstatus' => $enquire->status->name ?? 'Not Set',
            'leadstatuscolor' => $enquire->status->color ?? ' ',

            // 'followups' => $followups->isNotEmpty() ? $followups : 'Not Set',
            'followups' => !empty($followups) ? $followups : [],

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit_crm($id)
    {
        try {
            $leadenquiry = LeadEnquery::with('status')->find($id);
            $leadstatuses = LeadStatus::all();
            $leadagents = LeadAgent::all();
            $leadsources = LeadSource::all();
            $leadcategory = LeadCategory::all();
            $leadStatuses = LeadStatus::all();
            $branch = Branch::all();
            $departments = Department::all();
            $users = User::all();
            return view('admin.leadenquiry.edit', ['leadenquiry' => $leadenquiry, 'users' => $users, 'branch' => $branch, 'departments' => $departments, 'leadstatuses' => $leadstatuses, 'leadsources' => $leadsources, 'leadcategory' => $leadcategory, 'leadagents' => $leadagents, 'leadStatuses' => $leadStatuses]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', $th->getMessage());
        }
    }

    public function getUsersByDepartment($departmentId)
    {
        $users = User::where('department_id', $departmentId)->get();
        return response()->json($users);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request)
    {
        // Use validator
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'number' => 'required | max:10 | min:10',
            'leadsource' => 'required|not_in:0',
            'leadcategory' => 'required',
            // 'assign_user' => 'required',
            'leadstatus' => 'required',
        ], [
            'name.required' => 'Please enter a name',
            'email.required' => 'Please enter an email address',
            'email.email' => 'Please enter a valid email address',
            // 'assign_user.required' => 'Please select department, then choose the Agent',
        ]);

        $leadenquiry = LeadEnquery::find($id);
        $assignUserId = $request->input('assign_user');
        $leadenquiry->name = $request->name;
        $leadenquiry->city = $request->city;
        $leadenquiry->email = $request->email;
        $leadenquiry->state = $request->state;
        $leadenquiry->companyname = $request->companyname;
        $leadenquiry->country = $request->country;
        $leadenquiry->website = $request->website;
        $leadenquiry->postalcode = $request->postalcode;
        $leadenquiry->address = $request->address;
        $leadenquiry->number = $request->number;
        $leadenquiry->message = $request->message;
        $leadenquiry->leadsource = $request->input('leadsource');
        $leadenquiry->leadcategory = $request->input('leadcategory');
        // $leadenquiry->assign_user = $assignUserId; leadagents
        $leadenquiry->leadagent = $request->input('leadagents');

        $leadenquiry->leadstatus = $request->input('leadstatus');
        $leadenquiry->save();
        return redirect()->route('admin.leadenquiry.index')->with('success', 'Lead Enquiries updated/Assign successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the lead source by ID
        $leadenquiry = LeadEnquery::findOrFail($id);

        // Delete the lead source
        $leadenquiry->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Lead Enquery deleted successfully!');
    }

}
