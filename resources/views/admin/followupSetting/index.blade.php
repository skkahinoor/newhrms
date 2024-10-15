@extends('layouts.master')

@section('title', 'Follow-Up Setting ')

@section('action', 'Setting')


@section('main-content')

    <section class="content">

        @include('admin.section.flash_message')

        @include('admin.followupSetting.common.breadcrumb')

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <form action="{{ route('admin.followupSetting.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6 mb-4">
                                <h4>Set the Limit Of Follow Up List&nbsp;<svg xmlns="http://www.w3.org/2000/svg"
                                        width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                        <g fill="none" stroke="#e82e5f" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="1.75" color="#e82e5f">
                                            <path
                                                d="M8 20c-.514.697-.723.94-1.145.993s-.715-.19-1.3-.673C3.381 18.52 2 15.825 2 12.815C2 7.395 6.477 3 12 3s10 4.394 10 9.815c0 3.01-1.381 5.704-3.555 7.505c-.585.484-.877.726-1.3.673c-.422-.053-.631-.296-1.145-.993m-2.5-9.5L18 5" />
                                            <circle cx="12" cy="12" r="1.5" />
                                        </g>
                                    </svg></h4>
                                <br>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="floatingInput" name="limit"
                                        placeholder="" value="{{ $followupsetting->limit }}" required>
                                    <label for="floatingInput" class="text-secondary">Default Limit is 10&nbsp;(optional)</label>
                                </div>
                                @if ($errors->any())
                                    <div>
                                        <strong class="text-danger">Errors:</strong>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col-lg-6 col-md-6 mb-4">
                                <h4>Set the Follow Up Reminder Day&nbsp;<svg xmlns="http://www.w3.org/2000/svg"
                                        width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                        <g fill="none" fill-rule="evenodd">
                                            <path
                                                d="m12.594 23.258l-.012.002l-.071.035l-.02.004l-.014-.004l-.071-.036q-.016-.004-.024.006l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.016-.018m.264-.113l-.014.002l-.184.093l-.01.01l-.003.011l.018.43l.005.012l.008.008l.201.092q.019.005.029-.008l.004-.014l-.034-.614q-.005-.019-.02-.022m-.715.002a.02.02 0 0 0-.027.006l-.006.014l-.034.614q.001.018.017.024l.015-.002l.201-.093l.01-.008l.003-.011l.018-.43l-.003-.012l-.01-.01z" />
                                            <path fill="#e82e5f"
                                                d="M11 2a5 5 0 1 0 0 10a5 5 0 0 0 0-10m0 11c-2.395 0-4.575.694-6.178 1.672c-.8.488-1.484 1.064-1.978 1.69C2.358 16.976 2 17.713 2 18.5c0 .845.411 1.511 1.003 1.986c.56.45 1.299.748 2.084.956C6.665 21.859 8.771 22 11 22q.346 0 .685-.005a1 1 0 0 0 .89-1.428A6 6 0 0 1 12 18c0-1.252.383-2.412 1.037-3.373a1 1 0 0 0-.72-1.557Q11.671 13 11 13m10.708 3.068a1 1 0 0 0-1.414-1.414l-3.182 3.182l-1.414-1.414a1 1 0 0 0-1.414 1.414l2.05 2.05a1.1 1.1 0 0 0 1.556 0z" />
                                        </g>
                                    </svg></h4>
                                <br>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="floatingInput" name="notifyday"
                                        placeholder="Set the Reminder date" value="{{ $followupsetting->notifyday }}"
                                        required>
                                    <label for="floatingInput">Notify Days&nbsp;<span
                                            class="text-danger">*</span>&nbsp;(Min:1 &
                                        Max:7)</label>
                                </div>
                                @if ($errors->any())
                                    <div>
                                        <strong class="text-danger">Errors:</strong>
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>



                    <div class="col-md-12">
                        <br><br>
                        <h4>Do you want to clear the LocalStorage ?&nbsp;<svg style="cursor: pointer;"
                                data-bs-toggle="popover" data-bs-title="About LocalStorage!"
                                data-bs-content="The localStorage object stores data with no expiration date.The data is not deleted when the browser is closed, and are available for future sessions."
                                xmlns="http://www.w3.org/2000/svg" width="1.2rem" height="1.2rem" viewBox="0 0 20 20">
                                <path fill="#E82E5F"
                                    d="M10 .4C4.697.4.399 4.698.399 10A9.6 9.6 0 0 0 10 19.601c5.301 0 9.6-4.298 9.6-9.601c0-5.302-4.299-9.6-9.6-9.6m.896 3.466c.936 0 1.211.543 1.211 1.164c0 .775-.62 1.492-1.679 1.492c-.886 0-1.308-.445-1.282-1.182c0-.621.519-1.474 1.75-1.474M8.498 15.75c-.64 0-1.107-.389-.66-2.094l.733-3.025c.127-.484.148-.678 0-.678c-.191 0-1.022.334-1.512.664l-.319-.523c1.555-1.299 3.343-2.061 4.108-2.061c.64 0 .746.756.427 1.92l-.84 3.18c-.149.562-.085.756.064.756c.192 0 .82-.232 1.438-.719l.362.486c-1.513 1.512-3.162 2.094-3.801 2.094" />
                            </svg></h4>
                        <p class="text-secondary" style="font-size: 11px !important;">~ Click the (i) button to get more
                            details about LocalStorage</p>
                        <br>
                        <div class="col-md-6">
                            <button class="btn btn-primary" type="submit" id="lclear">Clear Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('scripts')
    @include('admin.followupSetting.common.scripts')
@endsection
