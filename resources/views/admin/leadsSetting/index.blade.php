@extends('layouts.master')

@section('title', 'Leads Setting ')

@section('action', 'Leads Setting')


@section('main-content')

    <section class="content">

        @include('admin.section.flash_message')

        @include('admin.leadsSetting.common.breadcrumb')

        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                            type="button" role="tab" aria-controls="pills-home" aria-selected="true">Lead
                            Source</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                            aria-selected="false">Lead Status</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                            aria-selected="false">Lead Agent</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-category-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-category" type="button" role="tab" aria-controls="pills-category"
                            aria-selected="false">Lead Category</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-setting-tab" data-bs-toggle="pill"
                            data-bs-target="#pills-setting" type="button" role="tab" aria-controls="pills-setting"
                            aria-selected="false">Other Settings</button>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                        tabindex="0">
                        {{-- Lead Source  --}}
                        @include('admin.leadsSetting.leadSource.index')
                        {{-- End Lead Source  --}}
                    </div>
                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                        tabindex="0">
                        {{-- Lead Status  --}}
                        @include('admin.leadsSetting.leadStatus.index')
                        {{-- End Lead Status  --}}
                    </div>
                    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                        tabindex="0">
                        {{-- Lead Agent  --}}
                        @include('admin.leadsSetting.leadAgent.index')
                        {{-- End Lead Agent  --}}
                    </div>
                    <div class="tab-pane fade" id="pills-category" role="tabpanel" aria-labelledby="pills-category-tab"
                        tabindex="0">
                        {{-- Lead Category  --}}
                        @include('admin.leadsSetting.leadCategory.index')
                        {{-- End Lead Category  --}}
                    </div>
                    <div class="tab-pane fade" id="pills-setting" role="tabpanel" aria-labelledby="pills-setting-tab"
                    tabindex="0">
                    {{-- Lead Setting  --}}
                    @include('admin.leadsSetting.otherSetting.index')
                    {{-- End Lead Setting  --}}
                </div>
                </div>
            </div>
        </div>
    </section>

    {{-- new modal  --}}
    @include('admin.leadsSetting.leadAgent.modal')
    @include('admin.leadsSetting.leadCategory.modal')
    @include('admin.leadsSetting.leadSource.modal')
    @include('admin.leadsSetting.leadStatus.modal')
    {{-- End Modal  --}}


@endsection

@section('scripts')
    @include('admin.leadsSetting.common.scripts')
@endsection
