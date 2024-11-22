<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AssetType;
use App\Models\Procurement;
use App\Models\ProcurementItem;
use App\Models\Quotation;
use App\Models\User;
use Carbon\Carbon;
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

        // Display Complete Orders Based on User's Quotations
        $totalRow = Quotation::where('vendor_id', $user->id)->where('quotation_status', 1)->count();

        $vid = auth()->user()->id;
        $completeOrders = Quotation::where('quotation_status', 1)->where('vendor_id', $vid)->with(['procurement'])->paginate(5);
        // dd($completeOrders);

        // Calculate Amount for the Current User's Accepted Quotations
        $calculateAmount = Quotation::where('vendor_id', $getUserDetails->id)
            ->where('quotation_status', 1)
            ->sum('total_item_price');

        // Pass data to the view
        return view('vendor.dashboard', [
            'getUserDetails' => $getUserDetails,
            'completeOrders' => $completeOrders,
            'totalRow' => $totalRow,
            'calculateAmount' => $calculateAmount,
        ]);
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
                    // dd($item->quotation_status, $item->deliver_status);
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

    public function setDeliver($procurementId)
    {
        $vendorId = auth()->user()->id;

        // Update the current vendor's quotation status to 1
        $setDeliver = Quotation::where('procurement_id', $procurementId)
            ->where('vendor_id', $vendorId)
            ->update(['quotation_status' => 1]);

        // Update other vendors' quotations for the same procurement to status 2
        $updateOthers = Quotation::where('procurement_id', $procurementId)
            ->where('vendor_id', '!=', $vendorId)
            ->update(['quotation_status' => 2]);

        // Update the Procurement's status to 3
        $setDeliverProcurement = Procurement::where('id', $procurementId)
            ->update(['status' => 3]);

        // Check if updates were successful
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

    // Dashboard Chat methods
    // public function getCombinedChartData()
    // {
    //     $vid = auth()->user()->id;

    //     // Line Chart Data - Daily Sales
    //     $dailyData = Quotation::where('vendor_id', $vid)
    //         ->where('quotation_status', 1)
    //         ->selectRaw('DATE(created_at) as date, SUM(total_item_price) as total_sales')
    //         ->groupBy('date')
    //         ->orderBy('date', 'asc')
    //         ->get();

    //     $lineLabels = $dailyData->pluck('date'); // Dates for the X-axis
    //     $lineData = $dailyData->pluck('total_sales'); // Sales totals for the Y-axis

    //     // Monthly Bar Chart Data
    //     $monthlyData = Quotation::where('vendor_id', $vid)
    //         ->where('quotation_status', 1)
    //         ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as total_orders')
    //         ->groupBy('year', 'month')
    //         ->orderBy('year', 'asc')
    //         ->orderBy('month', 'asc')
    //         ->get();

    //     $monthlyLabels = $monthlyData->map(function ($item) {
    //         return Carbon::createFromDate($item->year, $item->month, 1)->format('M'); // Get month abbreviation
    //     });
    //     $monthlyDataValues = $monthlyData->pluck('total_orders'); // Monthly total orders

    //     // Weekly Bar Chart Data
    //     $weeklyData = Quotation::where('vendor_id', $vid)
    //         ->where('quotation_status', 1)
    //         ->selectRaw('WEEK(created_at) as week, YEAR(created_at) as year, COUNT(*) as total_orders')
    //         ->groupBy('year', 'week')
    //         ->orderBy('year', 'asc')
    //         ->orderBy('week', 'asc')
    //         ->get();

    //     $weeklyLabels = $weeklyData->map(function ($item) {
    //         return 'Week ' . $item->week; // Format as Week 1, Week 2, etc.
    //     });
    //     $weeklyDataValues = $weeklyData->pluck('total_orders'); // Weekly total orders

    //     // Return the combined data for both charts
    //     return response()->json([
    //         'line_labels' => $lineLabels, // Daily sales labels (dates)
    //         'line_data' => $lineData, // Daily sales data (total sales)
    //         'monthly_labels' => $monthlyLabels, // Monthly labels (Jan, Feb, Mar)
    //         'monthly_data' => $monthlyDataValues, // Monthly total orders
    //         'weekly_labels' => $weeklyLabels, // Weekly labels (Week 1, Week 2, etc.)
    //         'weekly_data' => $weeklyDataValues, // Weekly total orders
    //     ]);
    // }

    public function getCombinedChartData()
    {
        $vid = auth()->user()->id;

        // Line Chart Data - Daily Sales
        $dailyData = Quotation::where('vendor_id', $vid)
            ->where('quotation_status', 1)
            ->selectRaw('DATE(created_at) as date, SUM(total_item_price) as total_sales')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $lineLabels = $dailyData->pluck('date'); // Dates for the X-axis (line chart)
        $lineData = $dailyData->pluck('total_sales'); // Sales totals for the Y-axis (line chart)

        // Monthly Bar Chart Data
        $monthlyData = Quotation::where('vendor_id', $vid)
            ->where('quotation_status', 1)
            ->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(*) as total_orders')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Prepare Monthly Labels (abbreviated months like Jan, Feb, Mar)
        $monthlyLabels = $monthlyData->map(function ($item) {
            return Carbon::createFromDate($item->year, $item->month, 1)->format('M'); // Format month
        });
        $monthlyDataValues = $monthlyData->pluck('total_orders'); // Monthly total orders (bar chart)

        // Weekly Bar Chart Data
        $weeklyData = Quotation::where('vendor_id', $vid)
            ->where('quotation_status', 1)
            ->selectRaw('WEEK(created_at) as week, YEAR(created_at) as year, COUNT(*) as total_orders')
            ->groupBy('year', 'week')
            ->orderBy('year', 'asc')
            ->orderBy('week', 'asc')
            ->get();

        // Prepare Weekly Labels (e.g., Week 1, Week 2, etc.)
        $weeklyLabels = $weeklyData->map(function ($item) {
            return 'Week ' . $item->week; // Format as Week 1, Week 2, etc.
        });
        $weeklyDataValues = $weeklyData->pluck('total_orders'); // Weekly total orders (bar chart)

        // Return the combined data for both charts
        return response()->json([
            'line_labels' => $lineLabels, // Dates for line chart (daily sales)
            'line_data' => $lineData, // Data for line chart (daily sales)
            'monthly_labels' => $monthlyLabels, // Labels for monthly bar chart (Jan, Feb, etc.)
            'monthly_data' => $monthlyDataValues, // Data for monthly bar chart (total orders)
            'weekly_labels' => $weeklyLabels, // Labels for weekly bar chart (Week 1, Week 2, etc.)
            'weekly_data' => $weeklyDataValues, // Data for weekly bar chart (total orders)
        ]);
    }

}
