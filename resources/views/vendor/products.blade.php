@extends('vendor.layouts.app')
@section('title', 'Vendor Products')
@section('breadcrumblink', 'Products')
@section('breadcrumbtitle', 'Vendor Products')
{{-- @section('navactivecolor', 'active bg-gradient-primary') --}}

@section('main-content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <form class="forms-sample" method="POST" action="{{ route('vendor.productcreate') }}">
                        @csrf
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Add Product</h6>
                            </div>
                        </div>
                        <div class="card-body p-5 px-0 pb-2">
                            <div class="row g-2" style="padding: 20px !important;">
                                <div class="col-md-6">
                                    <div class="form-floating"
                                        style="border: solid #3736362e 1px !important;border-radius: 7px !important;">
                                        <select class="form-select" name="product" required id="floatingSelectGrid"
                                            style="padding-left: 5px !important;">
                                            <option value="">Select option</option>
                                            @if (count($assetType) > 0)
                                                @foreach ($assetType as $product)
                                                    <option value="{{ $product->id }}">
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="">No Product found</option>
                                            @endif
                                        </select>
                                        <label for="floatingSelectGrid">Select Product&nbsp;<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating"
                                        style="border: solid #3736362e 1px !important;border-radius: 7px !important;">
                                        <input type="text" name="brand" class="form-control" id="floatingInputGrid"
                                            placeholder="Enter Product Brand" required
                                            style="padding-left: 7px !important;">
                                        <label for="floatingInputGrid">Enter Product Brand&nbsp;<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating"
                                        style="border: solid #3736362e 1px !important;border-radius: 7px !important;">
                                        <input type="text" name="quantity" class="form-control" id="floatingInputGrid"
                                            placeholder="Enter Product Quantity" required
                                            style="padding-left: 7px !important;">
                                        <label for="floatingInputGrid">Enter Product Quantity&nbsp;<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating"
                                        style="border: solid #3736362e 1px !important;border-radius: 7px !important;">
                                        <input type="text" name="buyprice" class="form-control" id="floatingInputGrid"
                                            placeholder="Enter Product Quantity" required
                                            style="padding-left: 7px !important;">
                                        <label for="floatingInputGrid">Enter Product Buy Price&nbsp;<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating"
                                        style="border: solid #3736362e 1px !important;border-radius: 7px !important;">
                                        <input type="text" name="saleprice" class="form-control" id="floatingInputGrid"
                                            placeholder="Enter Product Quantity" required
                                            style="padding-left: 7px !important;">
                                        <label for="floatingInputGrid">Enter Product Sale Price&nbsp;<span class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating"
                                        style="border: solid #3736362e 1px !important;border-radius: 7px !important;">
                                        <input type="text" name="margin" class="form-control" id="floatingInputGrid"
                                            placeholder="Estimated Margin" readonly
                                            style="padding-left: 7px !important;">
                                        <label for="floatingInputGrid">Your Estimated Margin</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pb-0 p-3">
                            <div class="row">
                                <div class="d-flex text-end" style="flex-direction: row-reverse !important;">
                                    <button class="btn bg-gradient-dark mb-0" type="submit"><i
                                            class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Product</button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Products List</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @if ($getOrder->count() < 0)
                            <br>
                            <p class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">No
                                Active
                                Orders Found ...</p>
                        @else
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                #</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Order Number</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Requirement</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Quantity</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Brand</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Requested Date</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Deliver Date</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getOrder as $key => $order)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $getOrder->firstItem() + $key }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $order->procurement_number ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $order->asset_types->name ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $order->quantity ?? 'N/A' }}&nbsp;Pcs</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $order->brands->name ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $order->request_date }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $order->delivery_date }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="badge badge-sm bg-gradient-info">{{ $order->status == 0 ? 'Active' : 'Error' }}</span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        Make Quotation
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <br>
                            <div class="row">{{ $getOrder->links() }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        {{-- Vendor Footer here  --}}
        @include('vendor.section.vendorfooter')
    </div>
@endsection
