<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\FollowUpSetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class FollowUpSettingController extends Controller
{
    public function index()
    {
        $this->authorize('followup_setting');
        try {
            $followupsetting = FollowUpSetting::get()->first();
            return view('admin.followupSetting.index', ['followupsetting' => $followupsetting]);
        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }

    public function store(Request $request) {
        try {
            $request->validate([
                'notifyday' => 'required|integer|min:1|max:7',
                'limit' => 'required|integer|min:10',
            ], [
                'notifyday.required' => 'Limit Must be set to Minimum 2 and Maximum 7',
                'limit.required' => 'Limit Must be set to Minimum 10',
            ]);
            $data = FollowUpSetting::firstOrNew();
            $data->notifyday =$request->notifyday;
            $data->limit =$request->limit;

            $data->save();
            return redirect()->back()->with('success', 'Settings updated successfully.');

        } catch (Exception $exception) {
            return redirect()->back()->with('danger', $exception->getMessage());
        }
    }
}
