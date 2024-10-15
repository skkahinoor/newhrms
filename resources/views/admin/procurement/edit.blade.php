@extends('layouts.master')

@section('title','Update Procurement')

@section('action','Procurement Edit')

@section('main-content')
<section class="content">
    @include('admin.section.flash_message')
    @include('admin.procurement.breadCrumb')
    <div class="card">
        <div class="card-body">
            <form id="" class="forms-sample" action="{{route('admin.procurement.update',$procurementDetail->id)}}" enctype="multipart/form-data" method="post">
                @method('PUT')
                @csrf
                @include('admin.procurement.form')
            </form>
        </div>
    </div>
</section>
@endsection

@section('scripts')
@include('admin.assetManagement.assetDetail.common.scripts')
@endsection