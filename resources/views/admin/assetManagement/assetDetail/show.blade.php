@extends('layouts.master')

@section('title', 'Show Asset Detail')

@section('action', 'Show Detail')

@section('button')
    <div class="float-md-end">
        <a href="{{ route('admin.assets.index') }}">
            <button class="btn btn-sm btn-primary"><i class="link-icon" data-feather="arrow-left"></i> Back</button>
        </a>
    </div>
@endsection

@section('main-content')

    <section class="content">

        @include('admin.section.flash_message')

        @include('admin.assetManagement.assetDetail.common.breadcrumb')

        <div class="card">
            <h4 class="card-header">Asset Details&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em"
                    viewBox="0 0 24 24">
                    <path fill="none" stroke="#e82e5f" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 5h8m-8 4h5m-5 6h8m-8 4h5M3 5a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1zm0 10a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1z" />
                </svg>
            </h4>
            <div class="card-body">
                <div class="row">

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label for="image" class="form-label d-block ">Asset Image </label>
                            <img id="image-preview" class="rounded p-4"
                                src="{{ asset(\App\Models\Asset::UPLOAD_PATH . $assetDetail->image) }}"
                                style="object-fit: cover; background-color: #e9ecef; height: auto; width:100%;">
                        </div>
                        <div class="col-md-6 mb-4">
                            <br><br><br><br>
                            <div class="col-lg-12 col-md-6 mb-4">
                                <label for="name" class="form-label">Name </label>
                                <input type="text" class="form-control" id="name" value="{{ $assetDetail->name }}"
                                    readonly>
                            </div>

                            <div class="col-lg-12 col-md-6 mb-4">
                                <label for="type" class="form-label">Type</label>
                                <input type="text" class="form-control" id="name"
                                    value="{{ $assetDetail->type->name }}" readonly>
                            </div>

                            <div class="col-lg-12 col-md-6 mb-4">
                                <label for="assetCode" class="form-label">Asset Code </label>
                                <input type="text" class="form-control" id="assetCode"
                                    value="{{ $assetDetail?->asset_code }}" readonly>
                            </div>

                        </div>
                    </div>



                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="assetCode" class="form-label">Asset Serial Number</label>
                        <input type="text" class="form-control" id="assetCode"
                            value="{{ $assetDetail?->asset_serial_no }}" readonly>
                    </div>


                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="is_working" class="form-label">Is Working</label>
                        <input type="text" class="form-control" value="{{ ucfirst($assetDetail->is_working) }}" readonly>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="purchased_date" class="form-label">Purchased Date</label>
                        <input type="date" class="form-control" value="{{ $assetDetail->purchased_date }}" readonly>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="warranty_available" class="form-label">Warranty Available </label>
                        <input type="text" class="form-control" id="warranty_available"
                            value="{{ $assetDetail->is_available ? 'Yes' : 'No' }}" readonly>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="warranty_end_date" class="form-label">Warranty End Date</label>
                        <input type="text" class="form-control" id="warranty_end_date"
                            value="{{ $assetDetail->warranty_end_date }}" readonly>
                    </div>

                    <div class="col-lg-4 col-md-6 mb-4">
                        <label for="is_available" class="form-label">Available For Employee </label>
                        <input type="text" class="form-control" id="is_available"
                            value="{{ $assetDetail->is_available ? 'Yes' : 'No' }}" readonly>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <label for="assigned_to" class="form-label">Asset Assigned Employee </label>
                        <input type="text" class="form-control" id="assignTo"
                            value="{{ ucfirst($assetDetail?->assignedTo?->name) }}" readonly>
                    </div>

                    <div class="col-lg-6 mb-4">
                        <label for="assigned_date" class="form-label">Assigned Date</label>
                        <input type="text" class="form-control" id="assigned_date"
                            value="{{ $assetDetail?->assigned_date }}" readonly>

                    </div>

                    <div class="col-lg-12 mb-4">
                        <label for="note" class="form-label">Description</label>
                        <div class="rounded p-3" style="background-color: #e9ecef">
                            {!! $assetDetail->note !!}
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('admin.assetManagement.assetDetail.common.scripts')
@endsection
