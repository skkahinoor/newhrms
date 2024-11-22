@extends('vendor.layouts.app')
@section('title', 'Vendor Orders')
@section('breadcrumblink', 'Orders')
@section('breadcrumbtitle', 'Vendor Orders')
{{-- @section('navactivecolor', 'active bg-gradient-primary') --}}

@section('main-content')
    <div class="container-fluid py-4">

        {{-- Show Alert Message  --}}
        @include('vendor.common.flashmessage')

        <?php
        $changeColor = [
            0 => 'warning',
            1 => 'primary',
            2 => 'danger',
            3 => 'success',
            4 => 'danger',
            5 => 'danger',
        
            // null => 'danger'
        ];
        $changeTextColor = [
            0 => '#000000',
            1 => '#ffffff',
            2 => '#ffffff',
            3 => '#ffffff',
            4 => '#ffffff',
            5 => '#ffffff',
        ];
        $changeStatusValue = [
            0 => 'Pending',
            1 => 'Active',
            2 => 'Rejected',
            3 => 'Delivered',
            4 => 'Pause',
            5 => 'Rejected',
        ];
        ?>

        {{-- Active orders  --}}
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Orders</h6>
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
                                                Procurement Item</th>
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
                                                    <a href="javascript:void(0);"
                                                        class="text-secondary text-xs font-weight-bold view-asset"
                                                        data-bs-toggle="modal" data-id="{{ $order->id }}"
                                                        data-bs-target="#assetModal">View
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem"
                                                            height="1.4rem" viewBox="0 0 24 24">
                                                            <g fill="none">
                                                                <path fill="#ff3366" fill-opacity="0.25" fill-rule="evenodd"
                                                                    d="M2.455 11.116C3.531 9.234 6.555 5 12 5c5.444 0 8.469 4.234 9.544 6.116c.221.386.331.58.32.868c-.013.288-.143.476-.402.852C20.182 14.694 16.706 19 12 19s-8.182-4.306-9.462-6.164c-.26-.376-.39-.564-.401-.852c-.013-.288.098-.482.318-.868M12 15a3 3 0 1 0 0-6a3 3 0 0 0 0 6"
                                                                    clip-rule="evenodd" />
                                                                <path stroke="#ff3366" stroke-width="1.2"
                                                                    d="M12 5c-5.444 0-8.469 4.234-9.544 6.116c-.221.386-.331.58-.32.868c.013.288.143.476.402.852C3.818 14.694 7.294 19 12 19s8.182-4.306 9.462-6.164c.26-.376.39-.564.401-.852s-.098-.482-.319-.868C20.47 9.234 17.444 5 12 5Z" />
                                                                <circle cx="12" cy="12" r="3" stroke="#ff3366"
                                                                    stroke-width="1.2" />
                                                            </g>
                                                        </svg>
                                                    </a>
                                                </td>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $order->request_date ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $order->delivery_date ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @if ($order->quotation_status === 1)
                                                        <span class="badge badge-sm btn-success"
                                                            style="color: #fff;">Quotation Approved</span>
                                                    @else
                                                        <span
                                                            class="badge badge-sm btn-{{ $changeColor[$order->status] ?? 'secondary' }}"
                                                            style="color: {{ $changeTextColor[$order->status] ?? '#fff' }};">
                                                            {{ $changeStatusValue[$order->status] ?? 'Unknown Status' }}
                                                        </span>
                                                    @endif

                                                </td>
                                                <td class="align-middle text-center" id="checkQuotations"
                                                    data-proqID="{{ $order->id }}">
                                                    <a href="javascript:void(0);"
                                                        class="text-light p-2 btn-info font-weight-bold text-xs make-quotation-btn"
                                                        style="border-radius: 7px;" data-id="{{ $order->id }}"
                                                        data-quantity="{{ $order->quantity }}" data-toggle="tooltip"
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
                            <h6 class="text-white text-capitalize ps-3">Approve Quotation Orders</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @if ($quotationOrder->isEmpty())
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
                                                Procurement Item</th>
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
                                        @foreach ($quotationOrder as $key => $qorder)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $quotationOrder->firstItem() + $key }}</span>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $qorder->procurement_number ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="javascript:void(0);"
                                                        class="text-secondary text-xs font-weight-bold view-asset"
                                                        data-bs-toggle="modal" data-id="{{ $qorder->id }}"
                                                        data-bs-target="#assetModal">View
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem"
                                                            height="1.4rem" viewBox="0 0 24 24">
                                                            <title>View Assets</title>
                                                            <g fill="none">
                                                                <path fill="#ff3366" fill-rule="evenodd"
                                                                    d="M12 5C7.336 5 3.6 7.903 2 12c1.6 4.097 5.336 7 10 7s8.4-2.903 10-7c-1.6-4.097-5.336-7-10-7m0 10a3 3 0 1 0 0-6a3 3 0 0 0 0 6"
                                                                    clip-rule="evenodd" opacity="0.16" />
                                                                <path stroke="#ff3366" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M15 12a3 3 0 1 1-6 0a3 3 0 0 1 6 0" />
                                                                <path stroke="#ff3366" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M2 12c1.6-4.097 5.336-7 10-7s8.4 2.903 10 7c-1.6 4.097-5.336 7-10 7s-8.4-2.903-10-7" />
                                                            </g>
                                                        </svg>
                                                    </a>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $qorder->request_date ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $qorder->delivery_date ?? 'N/A' }}</span>
                                                </td>

                                                <td class="align-middle text-center text-sm">
                                                    @if ($qorder->quotation_status === 1)
                                                        <span class="badge badge-sm btn-success"
                                                            style="color: #fff;">Delivered</span>
                                                    @else
                                                        <span
                                                            class="badge badge-sm btn-{{ $changeColor[$qorder->quotation_status] ?? 'secondary' }}"
                                                            style="color: {{ $changeTextColor[$qorder->quotation_status] ?? '#fff' }};">
                                                            {{ $changeStatusValue[$qorder->quotation_status] ?? 'Unknown Status' }}
                                                        </span>
                                                    @endif
                                                </td>

                                                <td class="align-middle text-center">
                                                    <a href="javascript:;" data-id="{{ $qorder->id }}"
                                                        class="text-secondary font-weight-bold text-xs viewQuotation"
                                                        data-bs-toggle="modal" data-bs-target="#viewQuotation"
                                                        data-original-title="View Quotation">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem"
                                                            height="1.4rem" viewBox="0 0 24 24">
                                                            <title>View Quotation</title>
                                                            <g fill="none">
                                                                <path fill="#ff3366" fill-rule="evenodd"
                                                                    d="M12 5C7.336 5 3.6 7.903 2 12c1.6 4.097 5.336 7 10 7s8.4-2.903 10-7c-1.6-4.097-5.336-7-10-7m0 10a3 3 0 1 0 0-6a3 3 0 0 0 0 6"
                                                                    clip-rule="evenodd" opacity="0.16" />
                                                                <path stroke="#ff3366" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M15 12a3 3 0 1 1-6 0a3 3 0 0 1 6 0" />
                                                                <path stroke="#ff3366" stroke-linecap="round"
                                                                    stroke-linejoin="round" stroke-width="2"
                                                                    d="M2 12c1.6-4.097 5.336-7 10-7s8.4 2.903 10 7c-1.6 4.097-5.336 7-10 7s-8.4-2.903-10-7" />
                                                            </g>
                                                        </svg>
                                                    </a>
                                                    @if ($qorder->quotation_status === 1)
                                                        <a href="javascript:;" data-bill="{{ $qorder->id }}"
                                                            class="generate-bill" data-bs-toggle="modal"
                                                            data-bs-target="#generate-bill">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem"
                                                                height="1.4rem" viewBox="0 0 24 24">
                                                                <title>Upload Bill</title>
                                                                <path fill="#ff3366"
                                                                    d="M19.35 10.04A7.49 7.49 0 0 0 12 4C9.11 4 6.6 5.64 5.35 8.04A5.994 5.994 0 0 0 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5c0-2.64-2.05-4.78-4.65-4.96M14 13v4h-4v-4H7l5-5l5 5z" />
                                                            </svg>
                                                        </a>
                                                    @else
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="row">{{ $quotationOrder->links() }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>





        {{-- All Modals are here  --}}

        {{-- Create Quotation Modal Code is here  --}}
        <div class="modal fade" id="quotationModal" tabindex="-1" role="dialog" aria-labelledby="quotationModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-wide" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quotationModalLabel">Create Quotation</h5>
                    </div>
                    <div class="modal-body">
                        <form id="quotationForm">
                            @csrf
                            <input type="hidden" name="order_id" id="order_id" value="">
                            <h6 class="text-secondary">Your Quotation Request</h6>
                            <div class="row" id="append-asset"
                                style="height: 230px !important;overflow: auto;border: solid 2px #0000001f;padding: 10px;border-radius: 5px;">
                                {{-- Append Data will here  --}}
                            </div>
                            <br>
                            <div class="row"
                                style="display: flex;flex-direction: column;align-content: center;justify-content: center;">
                                <div class="col-md-6 text-center">
                                    <label for="finalamount" class="text-primary fs-10">Total Calculated Amount</label>
                                    <input type="number" step="0.01" class="form-control text-center p-1"
                                        id="totalcalculateamount" name="totalcalculateamount" readonly
                                        placeholder="Total calculate amount">
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
                                        id="delivery_date" name="delivery_date">
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

        <!-- Modal for View Quotation -->
        <div class="modal fade" id="viewQuotation" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-6" id="exampleModalLabel">View Quotation For <span class="text-primary"
                                id="show-no"></span></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card mt-3">
                            <div style="padding: 15px !important;">
                                <h5 class="text-primary" style="border-bottom: solid #e3e3e3 2px;padding: 2px;">Quotation
                                    Details</h5>
                            </div>
                            <div class="card-body" id="quotation-view">
                                {{-- data will append here  --}}
                            </div>
                        </div>
                        <div class="modal-header text-dark">
                            <h6 class="modal-title text-primary">Your Quotation Items</h6>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr class="bg-primary bg-gradient text-center ">
                                            <th class="text-uppercase text-center text-light text-xs font-weight-bolder">
                                                #</th>
                                            <th class="text-center text-uppercase text-light text-xs font-weight-bolder">
                                                Product Type</th>
                                            <th class="text-center text-uppercase text-light text-xs font-weight-bolder">
                                                Product Brand</th>
                                            <th class="text-center text-uppercase text-light text-xs font-weight-bolder">
                                                Quantity</th>
                                            <th class="text-center text-uppercase text-light text-xs font-weight-bolder">
                                                Product Per Price</th>
                                            <th class="text-center text-uppercase text-light text-xs font-weight-bolder">
                                                Discount Price</th>
                                            <th class="text-center text-uppercase text-light text-xs font-weight-bolder">
                                                Total amount</th>
                                        </tr>
                                    </thead>
                                    <tbody id="show-loop-items">
                                        {{-- table append data  --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="setdeliverybutton">
                        {{-- Append close and Deliver button here  --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Asset view -->
        <div class="modal fade" id="assetModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-6" id="exampleModalLabel">Requirement</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr class="bg-primary bg-gradient text-center ">
                                        <th class="text-uppercase text-center text-light text-xs font-weight-bolder">
                                            #</th>
                                        <th class="text-center text-uppercase text-light text-xs font-weight-bolder">
                                            Type</th>
                                        <th class="text-center text-uppercase text-light text-xs font-weight-bolder">
                                            Brand</th>
                                        <th class="text-center text-uppercase text-light text-xs font-weight-bolder">
                                            Quantity</th>
                                        <th class="text-center text-uppercase text-light text-xs font-weight-bolder">
                                            Specification</th>
                                    </tr>
                                </thead>
                                <tbody id="asset-details-table">
                                    {{-- table alter data  --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal for Generate Bill --}}
        <div class="modal fade" id="generate-bill" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-6" id="exampleModalLabel">Generate Bill</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row py-4">
                            <div class="col-lg-6 mx-auto">
                                <form id="uploadBillForm" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Upload image input-->
                                    <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm">
                                        <input id="billFile" type="file" name="billFile" onchange="readURL(this);"
                                            class="form-control border-0" accept="application/pdf" required>

                                        <div class="input-group-append">
                                            <label for="upload" class="btn btn-light m-0 rounded-pill px-4"> <i
                                                    class="fa fa-cloud-upload mr-2 text-muted"></i><small
                                                    class="text-uppercase font-weight-bold text-muted">Choose
                                                    file</small></label>
                                        </div>
                                    </div>

                                    <!-- Uploaded image area-->
                                    <div class="image-area mt-4"><img id="imageResult" src="#" alt=""
                                            class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                                </form>
                            </div>
                        </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="uploadButton" class="btn btn-primary">Upload Bill</button>
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

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#imageResult')
                            .attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(function() {
                $('#upload').on('change', function() {
                    readURL(input);
                });
            });

            /*  ==========================================
                SHOW UPLOADED IMAGE NAME
            * ========================================== */
            var input = document.getElementById('upload');
            var infoArea = document.getElementById('upload-label');

            input.addEventListener('change', showFileName);

            function showFileName(event) {
                var input = event.srcElement;
                var fileName = input.files[0].name;
                infoArea.textContent = 'File name: ' + fileName;
            }
        </script>

        {{-- Vendor Footer here  --}}
        @include('vendor.section.vendorfooter')

        {{-- Common Scripts code  --}}
        @include('vendor.common.script')
    </div>
@endsection
