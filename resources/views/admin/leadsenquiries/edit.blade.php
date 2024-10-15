
@extends('layouts.master')

@section('title','Edit Lead Enquiries ')

@section('action','Edit Lead Enquiries')

@section('button')
    <a href="{{route('admin.leadsenquiries.index')}}" >
        <button class="btn btn-sm btn-primary" ><i class="link-icon" data-feather="arrow-left"></i> Back</button>
    </a>
@endsection

@section('main-content')

    <section class="content">

        @include('admin.section.flash_message')

        @include('admin.leadsenquiries.common.breadcrumb')

        <div class="card">
            <div class="card-body pb-0">
                <form id="clientEdit" class="forms-sample" action="{{route('admin.leadsenquiries.update',$leadsenquiries->id)}}"   method="post">
                    @method('PUT')
                    @csrf
                    @include('admin.leadsenquiries.common.form')
                </form>
            </div>
        </div>

       

    </section>
@endsection

@section('scripts')
    @include('admin.leadsenquiries.common.scripts')
    {{-- @include('admin.users.common.scripts') --}}
@endsection

