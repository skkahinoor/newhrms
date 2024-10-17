<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VendorTheme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $getUserDetails = User::find($user->id);
        // dd($getuserDetails);
        return view('vendor.dashboard', ['getUserDetails' => $getUserDetails]);
    }

    public function profile()
    {
        $user = Auth::user();
        $getUserDetails = User::find($user->id);
        // dd('hi');
        return view('vendor.profile', ['getUserDetails' => $getUserDetails]);
    }

    public function billing()
    {
        $user = Auth::user();
        $getUserDetails = User::find($user->id);
        // dd('hi');

        return view('vendor.billing', ['getUserDetails' => $getUserDetails]);
    }

    public function updateDarkMode(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'dark_mode' => 'required|boolean',
        ]);

        // Fetch the first VendorTheme record (consider adjusting this logic if necessary)
        $vendorTheme = VendorTheme::first();

        // Check if the record exists
        if (!$vendorTheme) {
            return response()->json(['success' => false, 'message' => 'VendorTheme not found'], 404);
        }

        // Update the dark_mode field
        $vendorTheme->dark_mode = $request->dark_mode;
        $vendorTheme->save();

        // Return a successful response
        return response()->json(['success' => true]);
    }

}
