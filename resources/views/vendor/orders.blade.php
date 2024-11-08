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
            2 => 'info',
            3 => 'success',
            4 => 'danger',
        
            // null => 'danger'
        ];
        $changeTextColor = [
            0 => '#000000',
            1 => '#ffffff',
            2 => '#ffffff',
            3 => '#ffffff',
            4 => '#ffffff',
        ];
        $changeStatusValue = [
            0 => 'Pending',
            1 => 'Active',
            2 => 'In Process',
            3 => 'Delivered',
            4 => 'Pause',
        ];
        ?>

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
                                                    <span class="badge badge-sm btn-{{ $changeColor[$order->status] }}"
                                                        style="color: {{ $changeTextColor[$order->status] }};">{{ $changeStatusValue[$order->status] ?? 'null' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
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
                            <h6 class="text-white text-capitalize ps-3">Quotation Orders</h6>
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
                                                            style="color: #fff;">Quotation Approved</span>
                                                    @else
                                                        <span
                                                            class="badge badge-sm btn-{{ $changeColor[$qorder->status] ?? 'secondary' }}"
                                                            style="color: {{ $changeTextColor[$qorder->status] ?? '#fff' }};">
                                                            {{ $changeStatusValue[$qorder->status] ?? 'Unknown Status' }}
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
                                                    @if ($qorder->deliver_status === 1)
                                                        <a href="javascript:;" data-billId="{{ $qorder->id }}"
                                                            class="generate-bill" data-bs-toggle="modal"
                                                            data-bs-target="#generate-bill">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem"
                                                                height="1.4rem" viewBox="0 0 24 24">
                                                                <title>Generate Bill</title>
                                                                <g fill="none" fill-rule="evenodd">
                                                                    <path
                                                                        d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                                                                    <path fill="#ff3366"
                                                                        d="M18 3a3 3 0 0 1 2.995 2.824L21 6v14a1 1 0 0 1-1.405.914l-.12-.062l-2.725-1.678l-2.726 1.678a1 1 0 0 1-.938.058l-.11-.058l-2.726-1.678l-2.726 1.678a1 1 0 0 1-1.517-.732L6 20v-6H4a1 1 0 0 1-.993-.883L3 13V5.5a2.5 2.5 0 0 1 2.336-2.495L5.5 3zm-3 9h-4a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2M5.5 5a.5.5 0 0 0-.5.5V12h1V5.5a.5.5 0 0 0-.5-.5M16 8h-5a1 1 0 0 0-.117 1.993L11 10h5a1 1 0 0 0 .117-1.993z" />
                                                                </g>
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

        {{-- Table for Complete ORder  --}}
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
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.4rem"
                                                        height="1.4rem" viewBox="0 0 24 24">
                                                        <path fill="none" stroke="#ff3366" stroke-width="2"
                                                            d="M12 21c-5 0-11-5-11-9s6-9 11-9s11 5 11 9s-6 9-11 9Zm0-14a5 5 0 1 0 0 10a5 5 0 0 0 0-10Z">
                                                        </path>
                                                    </svg>
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
                                                        class="text-secondary text-xs font-weight-bold">{{ $corder->request_date ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $corder->delivery_date ?? 'N/A' }}</span>
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="set-deliver" class="btn btn-success">Set To Deliver</button>
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

        {{-- Modal for Generate Bill  --}}
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
                        <form id="uploadBillForm" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="billFile" class="form-label">Select PDF File</label>
                                <input type="file" class="form-control" id="billFile" name="billFile"
                                    accept="application/pdf" required>
                            </div>
                            <div id="fileName" class="text-secondary mt-2"></div> <!-- Display file name -->
                        </form>
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
        </script>

        {{-- Vendor Footer here  --}}
        @include('vendor.section.vendorfooter')

        {{-- Common Scripts code  --}}
        @include('vendor.common.script')
    </div>
@endsection
