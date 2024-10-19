<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AssetType;
use App\Models\Procurement;
use App\Models\User;
use App\Models\VendorProduct;
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

    public function orders()
    {
        $user = Auth::user();
        $getUserDetails = User::find($user->id);
        $getOrder = Procurement::where('asset_type_id', $getUserDetails->asset_type)->where('status', 0)->with(['users', 'role', 'company'])->paginate(5);
        // dd($getOrder);
        $completeOrder = Procurement::where('asset_type_id', $getUserDetails->asset_type)->where('status', 1)->with(['users', 'role', 'company'])->paginate(5);
        return view('vendor.orders', ['getUserDetails' => $getUserDetails, 'getOrder' => $getOrder, 'completeOrder' => $completeOrder]);
    }

    public function products()
    {
        $user = Auth::user();
        $getUserDetails = User::find($user->id);
        $assetType = AssetType::all();
        $getOrder = Procurement::where('asset_type_id', $getUserDetails->asset_type)->where('status', 0)->with(['users', 'role', 'company'])->paginate(5);
        $completeOrder = Procurement::where('asset_type_id', $getUserDetails->asset_type)->where('status', 1)->with(['users', 'role', 'company'])->paginate(5);
        return view('vendor.products', ['getUserDetails' => $getUserDetails, 'getOrder' => $getOrder, 'completeOrder' => $completeOrder, 'assetType' => $assetType]);
    }

    public function productCreate(Request $request)
    {
        $getUser = Auth::user();
    
        $request->validate([
            'product' => 'required',
            'brand' => 'required|string',
            'quantity' => 'required|integer',
            'buyprice' => 'required|numeric',
            'saleprice' => 'required|numeric',
            'margin' => 'required|numeric',
        ], [
            'brand.string' => 'Brand name must be a string.',
            'quantity.integer' => 'Quantity must be an integer.',
            'buyprice.numeric' => 'Buy price must be a number.',
            'saleprice.numeric' => 'Sale price must be a number.',
            'margin.numeric' => 'Margin must be a number.',
        ]);
    
        VendorProduct::create([
            'vendor_id' => $getUser->id, // Use user ID
            'product_type' => $request->input('product'),
            'product_brand' => $request->input('brand'),
            'quantity' => $request->input('quantity'),
            'buyprice' => $request->input('buyprice'),
            'saleprice' => $request->input('saleprice'),
            'margin' => $request->input('margin'), // Correctly get the margin
        ]);
    
        return redirect()->back()->with('success', 'Product added successfully!');
    }
    

}
