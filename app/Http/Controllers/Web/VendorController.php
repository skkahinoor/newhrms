<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\AssetType;
use App\Models\Procurement;
use App\Models\Quotation;
use App\Models\User;
use App\Models\VendorProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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

        return view('vendor.profile', ['getUserDetails' => $getUserDetails]);
    }

    public function billing()
    {
        $user = Auth::user();
        $getUserDetails = User::find($user->id);
        // dd('hi');

        return view('vendor.billing', ['getUserDetails' => $getUserDetails]);
    }

    public function orders(Request $request)
    {
        $user = Auth::user();
        $getUserDetails = User::find($user->id);
       
        $getOrder = Procurement::where('asset_type_id', $getUserDetails->asset_type)->where('status', 1)->with(['users', 'role', 'company', 'asset_types', 'brands'])->paginate(5);

        $completeOrder = Procurement::where('asset_type_id', $getUserDetails->asset_type)->where('status', 3)->with(['users', 'role', 'company', 'asset_types', 'brands'])->paginate(5);
        return view('vendor.orders', ['getUserDetails' => $getUserDetails, 'getOrder' => $getOrder, 'completeOrder' => $completeOrder]);
    }

    public function storeQuotation(Request $request)
    {
        $request->validate([
            'order_id' => 'required|unique:procurement_id, quotations',
            'amount' => 'required|numeric',
        ]);
        Quotation::create([
            'procurement_id' => $request->order_id,
            'calculated_amount' => $request->amount,
            'remark' => $request->remark,
            'quotation_status' => 0,
        ]);

        return response()->json(['message', 'Quotation Sent Successfully!'], 200);
    }

    public function products()
    {
        $user = Auth::user();
        $getUserDetails = User::find($user->id);
        $assetType = AssetType::all();
        $fetchProduct = VendorProduct::all();
        $fetchOrder = VendorProduct::where('vendor_id', $getUserDetails->id)->with(['asset_types']);
        $getOrder = $fetchOrder->paginate(5);
        return view('vendor.products', ['getUserDetails' => $getUserDetails, 'getOrder' => $getOrder, 'assetType' => $assetType, 'fetchProduct' => $fetchProduct]);
    }

    public function productCreate(Request $request)
    {
        $getUser = Auth::user();
        $validator = Validator($request->all(), [
            'product' => 'required',
            'brand' => 'required|string|unique:vendor_products,product_brand',
            'quantity' => 'required|integer',
            'buyprice' => 'required|numeric',
            'saleprice' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        VendorProduct::create([
            'vendor_id' => $getUser->id,
            'product_type' => $request->input('product'),
            'product_brand' => $request->input('brand'),
            'quantity' => $request->input('quantity'),
            'buy_price' => $request->input('buyprice'),
            'sale_price' => $request->input('saleprice'),
            'margin' => $request->input('margin'),
        ]);

        return redirect()->back()->with('success', 'Product added successfully!');
    }

    public function productUpdate(Request $request)
    {
        $order = VendorProduct::find($request->order_id);
        $order->product_brand = $request->input('product_brand');
        $order->buy_price = $request->input('buy_price');
        $order->sale_price = $request->input('sale_price');
        $order->margin = $request->input('modalmargin');
        $order->quantity = $request->input('quantity');
        $order->save();

        return redirect()->back()->with('success', 'Product updated successfully.');
    }
    public function productDelete(Request $request)
    {
        $orderId = $request->input('order_id');
        $product = VendorProduct::find($orderId);
        if ($product) {
            $product->delete();
            return redirect()->back()->with('success', 'Product deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Product not found.');
        }
    }

}
