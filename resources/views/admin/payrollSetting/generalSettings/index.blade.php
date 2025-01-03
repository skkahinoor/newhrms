@extends('layouts.master')
@section('title', 'General Settings')
@section('sub_page', 'Lists')
@section('page')
    <a href="{{ route('admin.payroll-general-settings.index') }}">
        General Settings
    </a>
@endsection

@section('main-content')
    <section class="content">
        @include('admin.section.flash_message')

        @include('admin.payrollSetting.common.breadcrumb')

        <div class="row">
            <div class="col-lg-2 mb-4">
                @include('admin.payrollSetting.common.setting_menu')
            </div>
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header">
                        <h5>General Settings</h5>
                    </div>
                    <div class="card-body">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Payroll General Settings
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form
                                            action="{{ route('admin.payroll-general-settings.payrollGeneralSettingEdit') }}"
                                            method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="lin_number">LIN Number</label>
                                                        <input type="text" name="lin_number" id="lin_number"
                                                            class="form-control"
                                                            value="{{ isset($payrollGeneralSetting->lin_number) ? $payrollGeneralSetting->lin_number : '' }}">
                                                        <br>
                                                        <label for="esic_number">ESIC Number</label>
                                                        <input type="text" name="esic_number" id="esic_number"
                                                            class="form-control"
                                                            value="{{ isset($payrollGeneralSetting->esic_number) ? $payrollGeneralSetting->esic_number : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Gratuity
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <form action="{{ route('admin.payroll-general-settings.gratuityEdit') }}"
                                            method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="gratuity_yes">Is your company eligible for
                                                            Gratuity?</label><br>
                                                        <label>
                                                            <input type="radio" name="gratuity" id="gratuity_yes"
                                                                value="1" style="cursor: pointer;"
                                                                {{ isset($gratuityshow->gratuity) && $gratuityshow->gratuity == 1 ? 'checked' : '' }}>
                                                            Yes
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="gratuity" id="gratuity_no"
                                                                value="0" style="cursor: pointer;"
                                                                {{ isset($gratuityshow->gratuity) && $gratuityshow->gratuity == 0 ? 'checked' : '' }}>
                                                            No
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.toggleStatus').change(function(event) {
                event.preventDefault();
                var status = $(this).prop('checked') === true ? 1 : 0;
                var href = $(this).attr('href');
                Swal.fire({
                    title: 'Are you sure you want to change status ?',
                    showDenyButton: true,
                    confirmButtonText: `Yes`,
                    denyButtonText: `No`,
                    padding: '10px 50px 10px 50px',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    } else if (result.isDenied) {
                        (status === 0) ? $(this).prop('checked', true): $(this).prop('checked',
                            false)
                    }
                })
            })

            $('.delete').click(function(event) {
                event.preventDefault();
                let href = $(this).data('href');
                Swal.fire({
                    title: 'Are you sure you want to Delete ?',
                    showDenyButton: true,
                    confirmButtonText: `Yes`,
                    denyButtonText: `No`,
                    padding: '10px 50px 10px 50px',
                    allowOutsideClick: false
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                })
            })
        });
    </script>
@endsection
