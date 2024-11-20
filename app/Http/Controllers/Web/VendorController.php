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
                foreach ($prices->totalprice as $price) {
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

        // Decode the vendor's asset types from the JSON field in the users table
        $assetTypeIds = !empty($getUserDetails->asset_type)
        ? json_decode($getUserDetails->asset_type, true)
        : [];

        // Fetch procurements where the asset_type_id in procurement_items matches the vendor's asset types
        // $getOrder = Procurement::where('status', 1)
        //     ->where('status', '!=', 4)
        //     ->whereHas('items', function ($query) use ($assetTypeIds) {
        //         $query->whereIn('asset_type_id', $assetTypeIds);
        //     })
        //     ->with(['users', 'role', 'company', 'asset_types', 'brands', 'items'])
        //     ->paginate(5);

        $getOrder = Procurement::where('status', 1)
            ->whereHas('items', function ($query) use ($assetTypeIds) {
                $query->whereIn('asset_type_id', $assetTypeIds);
            })
            ->whereDoesntHave('quotation', function ($query) use ($user) {
                $query->where('vendor_id', $user->id); // Exclude procurements already quoted by this vendor
            })
            ->with(['users', 'role', 'company', 'asset_types', 'brands', 'items'])
            ->paginate(5);

        // Fetch relevant quotations
        // $quotationOrder = Procurement::whereHas('quotation', function ($query) use ($user) {
        //     // Filter quotations where the vendor has submitted
        //     $query->where('vendor_id', $user->id);
        // })
        //     ->whereHas('items', function ($query) use ($assetTypeIds) {
        //         // Ensure items match the vendor's asset types
        //         $query->whereIn('asset_type_id', $assetTypeIds);
        //     })
        //     ->with(['quotation', 'users', 'role', 'company', 'asset_types', 'brands', 'items'])
        //     ->paginate(5)
        //     ->through(function ($item) {
        //         // Map the quotation details into procurement
        //         foreach ($item->quotation as $quotation) {
        //             $item->quotation_status = $quotation->quotation_status;
        //             $item->deliver_status = $quotation->quotation_status;
        //             // dd($item->deliver_status);
        //         }
        //         unset($item->quotation);
        //         return $item;
        //     });

        $quotationOrder = Procurement::whereHas('quotation', function ($query) use ($user) {
            // Filter quotations submitted by the current vendor
            $query->where('vendor_id', $user->id);
        })
            ->whereHas('items', function ($query) use ($assetTypeIds) {
                // Filter items based on vendor's asset types
                $query->whereIn('asset_type_id', $assetTypeIds);
            })
            ->with([
                'quotation' => function ($query) use ($user) {
                    // Optionally filter quotations directly during eager loading
                    $query->where('vendor_id', $user->id);
                },
                'users', 'role', 'company', 'asset_types', 'brands', 'items',
            ])
            ->paginate(5)
            ->through(function ($item) {
                // Extract and map details into procurement for each associated quotation
                if ($item->quotation->isNotEmpty()) {
                    $quotation = $item->quotation->first(); // Use the first quotation as an example
                    $item->quotation_status = $quotation->quotation_status;
                    $item->deliver_status = $quotation->quotation_status;
                }
                unset($item->quotation); // Remove the quotation relationship if not needed
                return $item;
            });

        return view('vendor.orders', [
            'getUserDetails' => $getUserDetails,
            'getOrder' => $getOrder,
            'quotationOrder' => $quotationOrder,
        ]);
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

        // $vendorId = Auth::id();
        // $getQuote = Quotation::where('procurement_id', $id)
        //     ->where('vendor_id', $vendorId)
        //     ->with(['procurement', 'items', 'vendor'])
        //     ->get();

        // if ($getQuote->isEmpty()) {
        //     return response()->json(['error' => 'No quotations found for this procurement.'], 404);
        // }
        // return response()->json([
        //     'quotations' => $getQuote,
        //     'vendor_id' => auth()->id(),
        // ]);
    }

    public function sendquotation($order_id)
    {
        $assetdetails = ProcurementItem::where('procurement_id', $order_id)->with(['brand', 'assettype'])->get();
        return response()->json($assetdetails);
    }

    public function setDeliver($status)
    {
        // Update the Quotation's status
        $vId = auth()->user()->id;
        $setDeliver = Quotation::where('procurement_id', $status)->where('vendor_id', $vId)->update([
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
            $vId = auth()->user()->id;
            $quotation = Quotation::where('procurement_id', $id)->where('vendor_id', $vId)->update([
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

        // Create Quotation Entry for Vendor
        $quotation = Quotation::create([
            'procurement_id' => $request->order_id,
            'vendor_id' => $getUserid->id,
            'items' => $items,
            'total_item_price' => $request->totalcalculateamount,
            'remark' => $request->remark,
            'final_delivery_date' => $request->delivery_date,
            'quotation_status' => 0, // Default status for a new quotation
        ]);

        return response()->json(['message' => 'Quotation Submitted Successfully!'], 200);
    }

}
