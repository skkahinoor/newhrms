<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Procurement;
use App\Models\ProcurementItem;
use App\Models\Quotation;
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

        // Fetch Asset Name as Array
        if (!empty($getUserDetails->asset_type)) {
            $assetTypeIds = json_decode($getUserDetails->asset_type, true);
            $assetNames = \App\Models\AssetType::whereIn('id', $assetTypeIds)->pluck('name')->toArray();
            $getUserDetails->decoded_asset_types = $assetNames;
        } else {
            $getUserDetails->decoded_asset_types = [];
        }

        return view('vendor.dashboard', ['getUserDetails' => $getUserDetails]);
    }

    public function profile()
    {
        $user = Auth::user();
        $getUserDetails = User::find($user->id);

        // Fetch Asset Name as Array
        if (!empty($getUserDetails->asset_type)) {
            $assetTypeIds = json_decode($getUserDetails->asset_type, true);
            $assetNames = \App\Models\AssetType::whereIn('id', $assetTypeIds)->pluck('name')->toArray();
            $getUserDetails->decoded_asset_types = $assetNames;
        } else {
            $getUserDetails->decoded_asset_types = [];
        }

        return view('vendor.profile', ['getUserDetails' => $getUserDetails]);
    }

    public function billing()
    {
        $user = Auth::user();
        $getUserDetails = User::find($user->id);

        // Fetch Asset Name as Array
        if (!empty($getUserDetails->asset_type)) {
            $assetTypeIds = json_decode($getUserDetails->asset_type, true);
            $assetNames = \App\Models\AssetType::whereIn('id', $assetTypeIds)->pluck('name')->toArray();
            $getUserDetails->decoded_asset_types = $assetNames;
        } else {
            $getUserDetails->decoded_asset_types = [];
        }

        return view('vendor.billing', ['getUserDetails' => $getUserDetails]);
    }

    public function orders(Request $request)
    {
        $user = Auth::user();
        $getUserDetails = User::find($user->id);
        // dd($request->input('order_id'));

        // Fetch Asset Name as Array
        if (!empty($getUserDetails->asset_type)) {
            $assetTypeIds = json_decode($getUserDetails->asset_type, true);
            $assetNames = \App\Models\AssetType::whereIn('id', $assetTypeIds)->pluck('name')->toArray();
            $getUserDetails->decoded_asset_types = $assetNames;
        } else {
            $getUserDetails->decoded_asset_types = [];
        }

        $getOrder = Procurement::where('status', 1)->with(['users', 'role', 'company', 'asset_types', 'brands', 'items'])->paginate(5);

        // $getAsset = ProcurementItem::find($getOrder->id);
        // dd($getAsset);

        $quotationOrder = ProcurementItem::where('asset_type_id', $getUserDetails->asset_type)->with(['users', 'role', 'company', 'assetType', 'brand'])->paginate(5);

        $completeOrder = ProcurementItem::where('asset_type_id', $getUserDetails->asset_type)->with(['users', 'role', 'company', 'assetType', 'brand'])->paginate(5);
        return view('vendor.orders', ['getUserDetails' => $getUserDetails, 'getOrder' => $getOrder, 'completeOrder' => $completeOrder, 'quotationOrder' => $quotationOrder]);
    }

    public function getAssetDetails($procurement_id)
    {
        $getAsset = ProcurementItem::where('procurement_id', $procurement_id)->get();
        return response()->json($getAsset);
    }

    public function storeQuotation(Request $request)
    {
        $request->validate([
            'order_id' => 'required',
            'vendorproduct' => 'required',
            'calculatedamount' => 'required|numeric',
            'givediscountamount' => 'required|numeric',
            'finalamount' => 'required|numeric',
        ]);
        Quotation::create([
            'procurement_id' => $request->order_id,
            'vendor_product_id' => $request->vendorproduct,
            'calculated_amount' => $request->calculatedamount,
            'discounted_amount' => $request->givediscountamount,
            'final_amount' => $request->finalamount,
            'remark' => $request->remark,
            'final_delivery_date' => $request->delivery_date,
            'quotation_status' => 0,
        ]);
        $procurement = Procurement::find($request->order_id);
        if ($procurement) {
            $procurement->status = 2;
            $procurement->save();
        }

        return response()->json(['message', 'Quotation Sent Successfully!'], 200);
    }

}
