@extends('layouts.master')

@section('title','Add Procurement')

@section('action','Procurement Request')

@section('main-content')

<section class="content">

    @include('admin.section.flash_message')

    @include('admin.procurement.breadCrumb')

    <div class="card">
        <div class="card-body">
            <form id="" class="forms-sample" action="{{route('admin.procurement.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                @include('admin.procurement.form')
            </form>
        </div>
    </div>

</section>
@endsection

@section('scripts')
@include('admin.assetManagement.assetAssignment.scripts')
@endsection