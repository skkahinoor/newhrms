@extends('vendor.layouts.app')
@section('title', 'Vendor Orders')
@section('breadcrumblink', 'Orders')
@section('breadcrumbtitle', 'Vendor Orders')
{{-- @section('navactivecolor', 'active bg-gradient-primary') --}}

@section('main-content')
    <div class="container-fluid py-4">

        {{-- Show Alert Message  --}}
        @include('vendor.common.flashmessage')

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Active Orders</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @if ($getOrder->isEmpty())
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
                                                        class="badge badge-sm bg-gradient-info">{{ $order->status == 1 ? 'Active' : 'Error' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="javascript:void(0);"
                                                        class="text-secondary font-weight-bold text-xs make-quotation-btn"
                                                        data-id="{{ $order->id }}" data-toggle="tooltip"
                                                        data-original-title="Make Quotation">
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
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Completed Orders</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @if ($completeOrder->isEmpty())
                            <br>
                            <p class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">No
                                Complete
                                Orders found ...</p>
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
                                                Delivery Date</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>

                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($completeOrder as $key => $corder)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $completeOrder->firstItem() + $key }}</span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $corder->procurement_number ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $corder->asset_types->name ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $corder->quantity ?? 'N/A' }}&nbsp;Pcs</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $corder->brands->name ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $corder->request_date }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $corder->delivery_date }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span
                                                        class="badge badge-sm bg-gradient-success">{{ $corder->status == 3 ? 'Delivered' : 'Error' }}</span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                        data-toggle="tooltip" data-original-title="Edit user">
                                                        View Quotation
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="row">{{ $completeOrder->links() }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>




        {{-- Modal Code is here  --}}
        <div class="modal fade" id="quotationModal" tabindex="-1" role="dialog" aria-labelledby="quotationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quotationModalLabel">Create Quotation</h5>
                    </div>
                    <div class="modal-body">
                        <form id="quotationForm">
                            @csrf
                            <input type="hidden" name="order_id" id="order_id" value="">

                            <h6 class="text-secondary">Order Request For <span class="text-primary"
                                    style="font-size: 15px;">{{ $makeQuotation->procurement_number ?? 'Null' }}</span>
                            </h6>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="producttype" class="text-primary"
                                        style="font-size: 11px;font-weight:bold;">Requested Product</label>
                                    <input type="text" class="form-control"
                                        style="border: 1px solid #d2d6da !important; padding-left: 5px !important;"
                                        id="producttype" name="producttype"
                                        value="{{ $makeQuotation->asset_types->name ?? 'Null' }}" readonly required>
                                </div>
                                <div class="col-md-3">
                                    <label for="quantity" class="text-primary"
                                        style="font-size: 11px;font-weight:bold;">Quantity</label>
                                    <input type="number" class="form-control"
                                        style="border: 1px solid #d2d6da !important; padding-left: 5px !important;"
                                        id="producttype" name="quantity" readonly
                                        value="{{ $makeQuotation->quantity ?? 'Null' }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="brand" class="text-primary"
                                        style="font-size: 11px;font-weight:bold;">Requested
                                        Brand</label>
                                    <input type="text" class="form-control"
                                        style="border: 1px solid #d2d6da !important; padding-left: 5px !important;"
                                        id="producttype" name="brand" readonly
                                        value="{{ $makeQuotation->brands->name ?? 'Null' }}" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="deliverydate" class="text-primary"
                                        style="font-size: 11px;font-weight:bold;">Delivery
                                        Date</label>
                                    <input type="date" class="form-control"
                                        style="border: 1px solid #d2d6da !important; padding-left: 5px !important;"
                                        id="producttype" name="deliverydate" readonly
                                        value="{{ $makeQuotation->delivery_date ?? 'Null' }}" required>
                                </div>
                            </div>


                            <br>
                            <h6 class="text-secondary">Your Quotation Request</h6>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="amount" class="text-primary"
                                        style="font-size: 11px;font-weight:bold;">Amount&nbsp;<span
                                            class="text-danger">*</span></label>
                                    <input type="number" step="0.01" class="form-control"
                                        style="border: 1px solid #d2d6da !important; padding-left: 5px !important;"
                                        id="amount" name="amount" placeholder="Enter Amount" required>
                                </div>
                                <div class="col-md-3">
                                    <label for="remark" class="text-primary"
                                        style="font-size: 11px;font-weight:bold;">Quotation</label>
                                    <textarea class="form-control" style="border: 1px solid #d2d6da !important;" name="remark" id="remark"
                                        cols="23" rows="1"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="promise" class="text-primary"
                                        style="font-size: 13px; font-weight: bold;">Promise</label>
                                    <p style="font-size: 10px; font-weight: bold;">Will you be able to deliver the product
                                        on the requested date?</p>
                                    <input type="radio" style="font-size: 11px;" name="promise" id="promise_yes"
                                        value="yes" onclick="toggleDeliveryDate()" required>
                                    <label for="promise_yes" style="font-size: 11px;">Yes</label>
                                    <input type="radio" style="font-size: 11px;" name="promise" id="promise_no"
                                        value="no" onclick="toggleDeliveryDate()" required>
                                    <label for="promise_no" style="font-size: 11px;">No</label>
                                </div>

                                <div class="col-md-4" id="delivery_date_section" style="display: none;">
                                    <label for="delivery_date" class="text-primary"
                                        style="font-size: 13px; font-weight: bold;">Final Delivery
                                        Date</label>
                                    <input type="date" class="form-control"
                                        style="border: 1px solid #d2d6da !important; padding-left: 5px !important;"
                                        id="delivery_date" name="delivery_date" required>
                                </div>

                                <div class="col-md-4">
                                    <label for="remark" class="text-primary"
                                        style="font-size: 13px; font-weight: bold;">Quotation Message
                                    </label>
                                    <textarea class="form-control" style="border: 1px solid #d2d6da !important;" name="remark" id="remark"
                                        cols="23" rows="1"></textarea>
                                </div>
                            </div>
                            <br><br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Send Quotation</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <script>
            function toggleDeliveryDate() {
                const promiseYes = document.getElementById('promise_yes');
                const deliveryDateSection = document.getElementById('delivery_date_section');
                const deliveryDateInput = document.getElementById('delivery_date');

                if (promiseYes.checked) {
                    // If 'Yes' is checked, hide the Final Delivery Date section
                    deliveryDateSection.style.display = 'none';
                    deliveryDateInput.value = '';
                } else {
                    // If 'No' is checked, show the Final Delivery Date section
                    deliveryDateSection.style.display = 'block';
                }
            }
        </script>

        {{-- Vendor Footer here  --}}
        @include('vendor.section.vendorfooter')

        {{-- Common Scripts code  --}}
        @include('vendor.common.script')
    </div>
@endsection
