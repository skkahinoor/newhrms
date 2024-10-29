@extends('layouts.master')

@section('title', 'Show Procurement Detail')

@section('action', 'Show Procurement Detail')

@section('button')
    <div class="float-md-end">
        <a href="{{ route('admin.procurement.index') }}">
            <button class="btn btn-sm btn-primary"><i class="link-icon" data-feather="arrow-left"></i> Back</button>
        </a>
    </div>
@endsection

@section('main-content')

    <section class="content">

        @include('admin.section.flash_message')

        @include('admin.procurement.breadCrumb')

        <div class="card">
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
                1 => 'Approved',
                2 => 'In Process',
                3 => 'Delivered',
                4 => 'Pause',
            ];
            ?>
            <h4 class="card-header">Procurement Details&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="1.2em"
                    height="1.2em" viewBox="0 0 24 24">
                    <path fill="none" stroke="#e82e5f" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 5h8m-8 4h5m-5 6h8m-8 4h5M3 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1zm0 10a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1z" />
                </svg>&nbsp;<span
                    style="font-size: 11px; padding: 7px; color:{{ $changeTextColor[$procurementDetails->status] }}; border-radius:5px;"
                    class="btn-{{ $changeColor[$procurementDetails->status] }}">
                    {{ $changeStatusValue[$procurementDetails->status] ?? 'null' }}</span>
            </h4>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="name" class="form-label">Request Number </label>
                        <input type="text" class="form-control" id="name"
                            value="{{ $procurementDetails->procurement_number ?? 'null' }}" readonly>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="type" class="form-label">Uploaded By</label>
                        <input type="text" class="form-control" id="name"
                            value="{{ $procurementDetails->users->name ?? 'null' }}" readonly>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="type" class="form-label">Email</label>
                        <input type="text" class="form-control" id="name"
                            value="{{ $procurementDetails->email ?? 'null' }}" readonly>
                    </div>

                    {{-- <div class="col-lg-4 col-md-6 mb-4">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="name"
                            value="{{ $procurementDetails->asset_types->name ?? 'null' }}" readonly>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="assetCode" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="assetCode"
                            value="{{ $procurementDetails?->brands->name ?? 'null' }}" readonly>
                    </div>


                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="is_working" class="form-label">Quantity</label>
                        <input type="text" class="form-control" value="{{ $procurementDetails?->quantity ?? 'null' }}"
                            readonly>
                    </div> --}}

                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="purchased_date" class="form-label">Requested Date</label>
                        <input type="date" class="form-control" value="{{ $procurementDetails->request_date ?? 'null' }}"
                            readonly>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="purchased_date" class="form-label">Deliver Date</label>
                        <input type="date" class="form-control"
                            value="{{ $procurementDetails->delivery_date ?? 'null' }}" readonly>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="warranty_available" class="form-label">Purpose </label>
                        <textarea name="purpose" class="form-control" id="purpose" cols="10" rows="1" readonly>{{ $procurementDetails->purpose ?? 'Not Set' }}</textarea>
                    </div>


                    <h4 class="card-header">Requested Assets Details&nbsp;<svg xmlns="http://www.w3.org/2000/svg"
                            width="1.2rem" height="1.2rem" viewBox="0 0 2048 2048">
                            <path fill="#ff4242"
                                d="m1344 2l704 352v785l-128-64V497l-512 256v258l-128 64V753L768 497v227l-128-64V354zm0 640l177-89l-463-265l-211 106zm315-157l182-91l-497-249l-149 75zm-507 654l-128 64v-1l-384 192v455l384-193v144l-448 224L0 1735v-676l576-288l576 288zm-640 710v-455l-384-192v454zm64-566l369-184l-369-185l-369 185zm576-1l448-224l448 224v527l-448 224l-448-224zm384 576v-305l-256-128v305zm384-128v-305l-256 128v305zm-320-288l241-121l-241-120l-241 120z" />
                        </svg>
                    </h4>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <table class="table table-bordered mt-3" id="added-items">
                                <thead>
                                    <tr class="bg-danger bg-gradient text-center">
                                        <th style="color: white !important; font-weight:bold;">#</th>
                                        <th style="color: white !important; font-weight:bold;">Type</th>
                                        <th style="color: white !important; font-weight:bold;">Brand</th>
                                        <th style="color: white !important; font-weight:bold;">Quantity</th>
                                        <th style="color: white !important; font-weight:bold;">Specification</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($requestAsset as $key => $list)
                                        <tr class='text-center'>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $list->assetType->name ?? 'Null' }}</td>
                                            <td>{{ $list->brand->name ?? 'Null' }}</td>
                                            <td>{{ $list->quantity ?? 'Null' }}&nbsp;Pcs</td>
                                            <td>{{ $list->specification ?? 'Null' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('admin.procurement.script')
@endsection
