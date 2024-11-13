<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AssetType;
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
            $assetNames = AssetType::whereIn('id', $assetTypeIds)->pluck('name')->toArray();
            $getUserDetails->decoded_asset_types = $assetNames;
        } else {
            $getUserDetails->decoded_asset_types = [];
        }

        // Display Complete Orders
        $totalRow = Procurement::count();
        $completeOrders = Procurement::where('status', 3)->with(['items', 'users', 'role', 'company', 'asset_types', 'brands', 'totalprice'])->paginate(5)
        ->through(function ($prices) {
                // dd($price->totalprice);
                foreach($prices->totalprice as $price) {
                    // dd($price->total_item_price);
                    $prices->total_item_price = $price->total_item_price;
                    $prices->bill_file = $price->bill_file;
                }
                unset($prices->totalprice);
                return $prices;
            })
        ;

        $calculateAmount = Quotation::where('procurement_id', $getUserDetails->id)->where('quotation_status', 1)->sum('total_item_price');
// dd($calculateAmount);
        // dd($completeOrders->toArray());

        return view('vendor.dashboard', ['getUserDetails' => $getUserDetails, 'completeOrders' => $completeOrders, 'totalRow' => $totalRow, 'calculateAmount' => $calculateAmount]);
    }

    public function profile()
    {
        $user = Auth::user();
        $getUserDetails = User::find($user->id);

        // Fetch Asset Name as Array
        if (!empty($getUserDetails->asset_type)) {
            $assetTypeIds = json_decode($getUserDetails->asset_type, true);
            $assetNames = AssetType::whereIn('id', $assetTypeIds)->pluck('name')->toArray();
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
            $assetNames = AssetType::whereIn('id', $assetTypeIds)->pluck('name')->toArray();
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
        $getId = $getUserDetails->id;
        $getquotestatus = Quotation::where('vendor_id', $getUserDetails->id)->first();
        // $deliverystatusvalue = Quotation::where('procurement_id', )
        // Fetch Asset Name as Array
        if (!empty($getUserDetails->asset_type)) {
            $assetTypeIds = json_decode($getUserDetails->asset_type, true);
            $assetNames = AssetType::whereIn('id', $assetTypeIds)->pluck('name')->toArray();
            $getUserDetails->decoded_asset_types = $assetNames;
        } else {
            $getUserDetails->decoded_asset_types = [];
        }

        $getOrder = Procurement::where('status', 1)->where('status', '!=', 4)->with(['users', 'role', 'company', 'asset_types', 'brands', 'items'])->paginate(5);

        // $getOrders = collect();
        // foreach ($procurementOrder as $procurement) {
        //     foreach ($procurement->items as $value) {
        //         $assetTypes = json_decode($getUserDetails->asset_type, true);

        //         foreach ($assetTypes as $assetType) {
        //             if (in_array($value->asset_type_id, $assetType)) {
        //                 $getOrders->push($procurement->toArray());
        //                 break;
        //             }
        //         }
        //     }
        // }

        // dd($getOrders);

        $quotationOrder = Procurement::whereIn('status', [2, 3])->with(['quotation', 'users', 'role', 'company', 'asset_types', 'brands', 'items'])->paginate(5)->through(function ($item) {
            foreach ($item->quotation as $quotation) {
                $item->quotation_status = $quotation->is_approved;
                $item->deliver_status = $quotation->quotation_status;
            }
            unset($item->quotation);
            return $item;
        });

        // $completeOrder = ProcurementItem::where('asset_type_id', $getUserDetails->asset_type)->with(['users', 'role', 'company', 'assetType', 'brand'])->paginate(5);

        return view('vendor.orders', ['getUserDetails' => $getUserDetails, 'getOrder' => $getOrder, 'quotationOrder' => $quotationOrder, 'getquotestatus' => $getquotestatus]);
    }

    public function getAssetDetails($procurement_id)
    {
        $getAsset = ProcurementItem::where('procurement_id', $procurement_id)->with(['brand', 'assettype'])->get();
        return response()->json($getAsset);
    }

    public function getQuotationDetails($id)
    {
        $getQuote = Quotation::where('procurement_id', $id)->with(['procurement'])->get();
        // return response()->json($getQuote);
        if ($getQuote) {
            // return response()->json(['delivery_status' => $getQuote->quotation_status, 'getQuote' => $getQuote]);
            return response()->json($getQuote);
        }

        return response()->json(['error' => 'Quotation not found'], 404);
    }

    public function sendquotation($order_id)
    {
        $assetdetails = ProcurementItem::where('procurement_id', $order_id)->with(['brand', 'assettype'])->get();
        return response()->json($assetdetails);
    }

    public function setDeliver($status)
    {
        // Update the Quotation's status
        $setDeliver = Quotation::where('procurement_id', $status)->update([
            'quotation_status' => 1,
        ]);

        // Update the Procurement's status
        $setDeliverProcurement = Procurement::where('id', $status)->update([
            'status' => 3,
        ]);

        // Check if both updates were successful
        if ($setDeliver && $setDeliverProcurement) {
            return response()->json([
                'success' => true,
                'message' => 'Delivery status updated successfully.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update delivery status.',
            ], 500);
        }
    }

    public function checkBillData($id)
    {

        $quotation = Quotation::where('procurement_id', $id)->get();

        if ($quotation->bill_file != null) {
            return response()->json(['exists' => true]); // Bill data exists
        }

        return response()->json(['exists' => false]); // No bill data
    }

    public function uploadBill(Request $request, $id)
    {
        $request->validate([
            'billFile' => 'required|mimes:pdf|max:2048', // Only PDF files under 2MB
        ]);

        if ($request->hasFile('billFile')) {
            $file = $request->file('billFile');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Unique file name
            $file->move(public_path('assets/uploads/vendor/bill'), $fileName);

            // Assuming you have the quotation ID available; update the relevant quotation
            // Replace with actual logic for setting $quotation
            $quotation = Quotation::where('procurement_id', $id)->update([
                'bill_file' => $fileName,
            ]);
            // dd($quotation);
            // $quotation->bill_file = $fileName;
            // $quotation->save();

            return response()->json(['success' => true, 'fileName' => $fileName, $quotation]);
        }

        return response()->json(['success' => false, 'message' => 'Failed to upload file.']);
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
