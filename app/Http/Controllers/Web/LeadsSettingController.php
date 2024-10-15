<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\LeadAgent;
use App\Models\LeadCategory;
use App\Models\LeadForms;
use App\Models\LeadSetting;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class LeadsSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->authorize('leads_setting');
        try {
            // Lead Sources
            $leadSources = LeadSource::paginate(10);

            // Lead Status
            $leadStatus = LeadStatus::paginate(10);

            // Lead Agent
            $leadAgent = LeadAgent::paginate(10);

            // Lead Category
            $leadCategory = LeadCategory::paginate(10);

            $users = User::whereNotIn('id', LeadAgent::pluck('userid'))->get();

            $setting = LeadSetting::first();

            $leadform = LeadForms::first();

            return view('admin.leadsSetting.index', compact('leadSources', 'leadStatus', 'leadAgent', 'leadCategory', 'users', 'setting', 'leadform'));
        } catch (Exception $exception) {
            //throw $exception;
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function setting(Request $request)
    {
        // Validation for 1st Setting
        $request->validate([
            'limit' => 'required|integer|min:5|max:50',
            'leadformlink' => 'required|url',
        ], [
            'datanum.required' => 'Limit Must be set to Minimum 5',
        ]);

        // Get the first record or create a new one if none exists
        $leadSetting1 = LeadSetting::firstOrNew();

        // Update the data
        $leadSetting1->datanum = $request->limit;
        $leadSetting1->leadformlink = $request->leadformlink;

        // Save the data
        $leadSetting1->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function setting2(Request $request2)
    {
        // Validation for 2nd setting
        $request2->validate([
            'leadformtitle' => 'required|max:15',
        ], [
            'leadformtitle.required' => 'Form Title Maximum 15 Words Allowed !',
        ]);

        // Get the first record or create a new one if none exists

        $leadSetting2 = LeadSetting::firstOrNew();

        // Update the data
        $leadSetting2->leadformtitle = $request2->leadformtitle;

        // Save the data
        $leadSetting2->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function displayfield(Request $request)
    {
        $column = $request->input('column');
        $value = $request->input('value');
        LeadForms::first()->update([$column => $value]);
        return response()->json(['success' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function leadagent_create()
    {
        // $users = User::all();
        $users = User::whereNotIn('id', LeadAgent::pluck('userid'))->get();
        return view('admin.leadsSetting.leadAgent.modal', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  Lead Source
    public function leadSourceList()
    {
        // $leadSources = LeadSource::all();
        // $leadSources = LeadSource::paginate(10);
        // // return view('admin.leadsSetting.index', ['leadSources'=>$leadSources]);
        // return view('admin.leadsSetting.index', compact('leadSources'));
    }

    public function store(Request $request) // Store Lead Source
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255|unique:lead_sources',
        ]);

        // Create a new lead source
        LeadSource::create([
            'name' => $request->input('name'),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Lead Source added successfully!');

    }

    public function leadstatus_store(Request $request) // Store Lead Status
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255|unique:lead_statuses',
            'color' => 'required|string|max:255|unique:lead_statuses',
        ]);

        // Create a new lead source
        LeadStatus::create([
            'name' => $request->input('name'),
            'color' => $request->input('color'),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Lead Status added successfully!');

    }

    public function leadagent_store(Request $request) // Store Lead Status
    {
        // Validate the request
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        // Get the selected user's ID and name
        $userId = $request->input('username');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'User not found!');
        }

        // Create a new lead source
        LeadAgent::create([
            'userid' => $userId,
            'username' => $user->name,
            
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Lead Agent Assign successfully!');

    }

    public function leadcategory_store(Request $request) // Store Lead Category
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255|unique:lead_categories',
        ]);

        // Create a new lead source
        LeadCategory::create([
            'name' => $request->input('name'),
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Lead Category added successfully!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) // lead source update
    {

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Find the lead source and update its name
        $leadSource = LeadSource::findOrFail($id);
        $leadSource->name = $request->input('name');
        $leadSource->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Lead Source updated successfully!');

    }

    public function leadstatus_update(Request $request, $id) // lead source update
    {

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'color' => 'required|string|max:255',
        ]);

        // Find the lead source and update its name
        $leadStatus = LeadStatus::findOrFail($id);
        $leadStatus->name = $request->input('name');
        $leadStatus->color = $request->input('color');
        $leadStatus->save();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Lead Status updated successfully!');

    }

    public function updateDefaultStatus(Request $request)
    {
        $id = $request->input('id');

        // Set all statuses to not default
        LeadStatus::query()->update(['is_default' => 0]);

        // Set the selected status as default
        $leadStatus = LeadStatus::findOrFail($id);
        $leadStatus->is_default = 1;
        $leadStatus->save();

        return response()->json(['success' => true]);
    }

    public function leadcategory_update(Request $request, $id) // lead source update
    {

        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Find the lead source and update its name
        $leadCategory = LeadCategory::findOrFail($id);
        $leadCategory->update($request->all());

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Lead Category updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) // Delete Lead Source
    {
        // Find the lead source by ID
        $leadSource = LeadSource::findOrFail($id);

        // Delete the lead source
        $leadSource->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Lead Source deleted successfully!');
    }

    // Delete Lead Status
    public function leadstatus_destroy($id) // Delete Lead Source
    {
        // Find the lead source by ID
        $leadStatus = LeadStatus::findOrFail($id);

        // Delete the lead source
        $leadStatus->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Lead Status deleted successfully!');
    }

    // Delete Lead Agent
    public function leadAgentDelete(Request $request, $id)
    {
        // Find the lead agent by ID
        $leadAgent = LeadAgent::findOrFail($id);
        $leadAgent->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Lead Agent deleted successfully!');
    }

    // Delete Lead Category
    public function leadcategory_destroy($id) // Delete Lead Source
    {
        // Find the lead source by ID
        $leadCategory = LeadCategory::findOrFail($id);

        // Delete the lead source
        $leadCategory->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Lead Source deleted successfully!');
    }

}
