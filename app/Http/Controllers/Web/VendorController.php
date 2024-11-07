<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Procurement;
use App\Models\ProcurementItem;
use App\Models\Quotation;
use App\Models\User;
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
        // $procurement_id = Procurement::where
        $getquotestatus = Quotation::where('vendor_id', $getUserDetails->id)->first();

        // Fetch Asset Name as Array
        if (!empty($getUserDetails->asset_type)) {
            $assetTypeIds = json_decode($getUserDetails->asset_type, true);
            $assetNames = \App\Models\AssetType::whereIn('id', $assetTypeIds)->pluck('name')->toArray();
            $getUserDetails->decoded_asset_types = $assetNames;
        } else {
            $getUserDetails->decoded_asset_types = [];
        }

        $getOrder = Procurement::where('status', 1)->with(['users', 'role', 'company', 'asset_types', 'brands', 'items'])->paginate(5);

        $quotationOrder = Procurement::where('status', 2)->with(['quotation','users', 'role', 'company', 'asset_types', 'brands', 'items'])->paginate(5)->through(function($item){
            foreach($item->quotation as $quotation){
                $item->quotation_status = $quotation->is_approved;
            }
            unset($item->quotation);
            return $item;
        });
        
        $completeOrder = ProcurementItem::where('asset_type_id', $getUserDetails->asset_type)->with(['users', 'role', 'company', 'assetType', 'brand'])->paginate(5);
        return view('vendor.orders', ['getUserDetails' => $getUserDetails, 'getOrder' => $getOrder, 'completeOrder' => $completeOrder, 'quotationOrder' => $quotationOrder, 'getquotestatus' => $getquotestatus]);
    }

    public function getAssetDetails($procurement_id)
    {
        $getAsset = ProcurementItem::where('procurement_id', $procurement_id)->with(['brand', 'assettype'])->get();
        return response()->json($getAsset);
    }

    public function getQuotationDetails($id)
    {
        $getQuote = Quotation::where('procurement_id', $id)->with(['procurement'])->get();
        return response()->json($getQuote);
    }

    public function sendquotation($order_id)
    {
        $assetdetails = ProcurementItem::where('procurement_id', $order_id)->with(['brand', 'assettype'])->get();
        return response()->json($assetdetails);
    }

    public function storeQuotation(Request $request)
    {
        $user = Auth::user();
        $getUserid = User::find($user->id);
        // dd($getUserid->id);

        $request->validate([
            'order_id' => 'required',

            'productType.*' => 'required',
            'productBrand.*' => 'required',
            'productQuantity.*' => 'required',

            'amountperproduct.*' => 'required|numeric|min:0',
            'givediscount.*' => 'nullable|numeric|min:0',
            'finalamount.*' => 'required|numeric|min:0',
            'totalcalculateamount' => 'required|numeric|min:0',
        ]);

        $items = [];
        foreach ($request->amountperproduct as $index => $amountPerProduct) {
            $items[] = [
                'productType' => $request->productType[$index],
                'productBrand' => $request->productBrand[$index],
                'productQuantity' => $request->productQuantity[$index],

                'product_per_price' => $amountPerProduct,
                'discount_price' => $request->givediscount[$index] ?? 0,
                'total_amount' => $request->finalamount[$index],
            ];
        }
        $quotation = Quotation::create([
            'procurement_id' => $request->order_id,
            'vendor_id' => $getUserid->id,
            'items' => $items,
            'total_item_price' => $request->totalcalculateamount,
            'remark' => $request->remark,
            'final_delivery_date' => $request->delivery_date,
            'quotation_status' => 0,
        ]);
        if ($procurement = Procurement::find($request->order_id)) {
            $procurement->status = 2;
            $procurement->save();
        }

        return response()->json(['message' => 'Quotation Sent Successfully!'], 200);
    }

}
