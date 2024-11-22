@extends('vendor.layouts.app')
@section('title', 'Vendor Dashboard')
@section('breadcrumblink', 'Dashboard')
@section('breadcrumbtitle', 'Vendor Dashboard')
{{-- @section('navactivecolor', 'active bg-gradient-primary') --}}
@section('main-content')

    <?php
    $changeColor = [
        0 => 'warning',
        1 => 'success',
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
        1 => 'Delivered',
        2 => 'Rejected',
        3 => 'Unset status',
        4 => 'Pause',
    ];
    ?>

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Today's Money</p>
                            <h4 class="mb-0">₹53k</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than
                            lask week</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Today's Users</p>
                            <h4 class="mb-0">2,300</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than
                            lask month</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Order Complete</p>
                            <h4 class="mb-0">{{ $totalRow }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2%</span> than
                            yesterday</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Sales</p>
                            <h4 class="mb-0">₹{{ $calculateAmount }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than
                            yesterday</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">

            <div class="col-lg-4 col-md-6 mt-4 mb-4">
                <div class="card z-index-2">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0">Daily Sales</h6>
                        <p class="text-sm">(<span class="font-weight-bolder">+15%</span>) increase in today's sales.</p>
                        <hr class="dark horizontal">
                       
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt-4 mb-4">
                <div class="card z-index-2">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="chart-bars" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0">Completed Orders (Monthly)</h6>
                        <p class="text-sm">Current Month Performance</p>
                        <hr class="dark horizontal">
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt-4 mb-4">
                <div class="card z-index-2">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
                        <div class="bg-gradient-info shadow-info border-radius-lg py-3 pe-1">
                            <div class="chart">
                                <canvas id="chart-bars-weekly" class="chart-canvas" height="170"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6 class="mb-0">Completed Orders (Weekly)</h6>
                        <p class="text-sm">Current Week Performance</p>
                        <hr class="dark horizontal">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Complete Orders</h6>
                                <p class="text-sm mb-0">
                                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                                    <span class="font-weight-bold ms-1">{{ $totalRow }}</span> Orders Completed
                                </p>
                            </div>
                            <div class="col-lg-6 col-5 my-auto text-end">
                                <div class="dropdown float-lg-end pe-4">
                                    <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="fa fa-ellipsis-v text-secondary"></i>
                                    </a>
                                    <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                        <li><a class="dropdown-item border-radius-md"
                                                href="{{ route('vendor.orders') }}">View All
                                                Orders</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @if ($completeOrders->isEmpty())
                            <p class="align-middle text-center font-weight-bolder opacity-7 text-secondary">
                                No Complete Orders here
                            </p>
                        @else
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Order No.</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Total Price</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Bill</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($completeOrders as $cOrders)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1" style="cursor: pointer;">
                                                        <div>
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2rem"
                                                                height="1.2rem" viewBox="0 0 48 48">
                                                                <title>Order Number
                                                                    {{ $cOrders->procurement_number ?? 'null' }}</title>
                                                                <g fill="none" stroke-linejoin="round"
                                                                    stroke-width="4">
                                                                    <rect width="30" height="36" x="9" y="8"
                                                                        fill="#2f88ff" stroke="#4c4c4c" rx="2" />
                                                                    <path stroke="#000" stroke-linecap="round"
                                                                        d="M18 4V10" />
                                                                    <path stroke="#000" stroke-linecap="round"
                                                                        d="M30 4V10" />
                                                                    <path stroke="#fff" stroke-linecap="round"
                                                                        d="M16 19L32 19" />
                                                                    <path stroke="#fff" stroke-linecap="round"
                                                                        d="M16 27L28 27" />
                                                                    <path stroke="#fff" stroke-linecap="round"
                                                                        d="M16 35H24" />
                                                                </g>
                                                            </svg>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm text-secondary" id="copyOrder"
                                                                data-procopy="{{ $cOrders->procurement->procurement_number }}"
                                                                title="Click to copy">
                                                                &nbsp;{{ $cOrders->procurement->procurement_number ?? 'Not Set' }}
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-start text-sm">
                                                    <span class="text-xs font-weight-bold">₹
                                                        {{ $cOrders->total_item_price ?? 'Not Set' }} </span>
                                                </td>
                                                <td class="text-center text-sm">
                                                    <span class="text-xs font-weight-bold">
                                                        <a class="text-secondary"
                                                            href="{{ $cOrders->bill_file ? asset('assets/uploads/vendor/bill/' . $cOrders->bill_file) : 'javascript:void(0);' }}"
                                                            {{ $cOrders->bill_file ? 'download' : '' }}>
                                                            {{ $cOrders->bill_file ?? '' }}
                                                        </a>
                                                    </span>

                                                </td>
                                                <td class="text-center">

                                                    <span
                                                        class="badge badge-sm btn-{{ $changeColor[$cOrders->quotation_status] ?? 'secondary' }}"
                                                        style="color: {{ $changeTextColor[$cOrders->quotation_status] ?? '#fff' }};">
                                                        {{ $changeStatusValue[$cOrders->quotation_status] ?? 'Unknown Status' }}
                                                    </span>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="row">{{ $completeOrders->links() }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>Orders overview</h6>
                        <p class="text-sm">
                            <i class="fa fa-arrow-up text-success" aria-hidden="true"></i>
                            <span class="font-weight-bold">24%</span> this month
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="timeline timeline-one-side">
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-success text-gradient">notifications</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, Design changes</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">22 DEC 7:20 PM</p>
                                </div>
                            </div>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-danger text-gradient">code</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">New order #1832412</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 11 PM</p>
                                </div>
                            </div>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-info text-gradient">shopping_cart</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Server payments for April
                                    </h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">21 DEC 9:34 PM</p>
                                </div>
                            </div>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-warning text-gradient">credit_card</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">New card added for order
                                        #4395133</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">20 DEC 2:20 AM</p>
                                </div>
                            </div>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-primary text-gradient">key</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">Unlock packages for
                                        development</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">18 DEC 4:54 AM</p>
                                </div>
                            </div>
                            <div class="timeline-block">
                                <span class="timeline-step">
                                    <i class="material-icons text-dark text-gradient">payments</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">New order #9583120</h6>
                                    <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">17 DEC</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Vendor Footer here  --}}
        @include('vendor.section.vendorfooter')

        {{-- Common Scripts code  --}}
        @include('vendor.common.script')
    </div>
@endsection
