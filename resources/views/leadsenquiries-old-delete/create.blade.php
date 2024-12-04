<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.5.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">
    <title>{{ $setting->leadformtitle }}</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    <style>
        body {
            background-color: #fff;
            color: #333;
        }

        .form-label {
            font-weight: bold;

            font-size: 0.9rem;
            /* Decreased font size */
        }

        .form-control {
            border: 1px solid #e0e0e0;
            font-size: 0.9rem;
            /* Decreased font size */
        }

        .form-control:focus {
            border-color: #dc3545;
            /* Theme color */
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
            /* Theme color */
        }

        .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
        }

        .btn-primary:hover {
            background-color: #000;
            border-color: #000;
            color: #fff;
        }

        .btn-secondary {
            background-color: #000;
            border-color: #000;
            color: #fff;
        }

        .btn-secondary:hover {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .card {
            padding: 20px;
            margin: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .card-header {
            background-color: #dc3545;
            color: #fff;
            font-weight: bold;
            text-align: center;
            border-radius: 10px 10px 0 0;
            font-size: 1.5rem;
            /* Increased font size */
        }

        .select2-container--default .select2-selection--single {
            height: 38px;
            padding: 6px 12px;
            font-size: 0.9rem;
            /* Decreased font size */
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 24px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px;
        }

        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #dc3545;
            /* Theme color */
            color: white;
        }

        @media (max-width: 576px) {
            .select2-container {
                width: 100% !important;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                {{ $setting->leadformtitle }}
            </div>
            <div class="card-body">
                <form id="leadAdd" class="forms-sample" action="{{ route('leadsenquiries.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        @if ($leadform->name == 1)
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-validate @enderror"
                                    placeholder="Please enter your name" required="required"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                        @if ($leadform->city == 1)
                            <div class="col-md-6">
                                <label for="city" class="form-label">City</label>
                                <input type="text" id="city" name="city"
                                    class="form-control @error('city') is-validate @enderror"
                                    placeholder="Please enter your City" value="{{ old('city') }}">
                                @error('city')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                        @if ($leadform->email == 1)
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email <span
                                        class="text-danger">*</span></label>
                                <input type="email" id="email" name="email"
                                    class="form-control @error('email') is-validate @enderror"
                                    placeholder="Enter Your Email" required="required" value="{{ old('email') }}">
                                @error('email')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                        @if ($leadform->state == 1)
                            <div class="col-md-6">
                                <label for="state" class="form-label">State</label>
                                <input type="text" id="state" name="state"
                                    class="form-control @error('state') is-validate @enderror"
                                    placeholder="Enter Your State" value="{{ old('state') }}">
                                @error('state')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif


                        @if ($leadform->companyname == 1)
                            <div class="col-md-6">
                                <label for="company" class="form-label">Company Name</label>
                                <input type="text" id="company" name="companyname"
                                    class="form-control @error('companyname') is-validate @enderror"
                                    placeholder="Enter Your Company Name" value="{{ old('companyname') }}">
                                @error('companyname')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                        @if ($leadform->country == 1)
                            <div class="col-md-6">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select @error('country') is-validate @enderror" name="country"
                                    id="country">
                                    <option selected disabled>Select Country</option>
                                </select>
                                @error('country')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif


                        @if ($leadform->website == 1)
                            <div class="col-md-6">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" id="website" name="website"
                                    class="form-control @error('website') is-validate @enderror"
                                    placeholder="Enter Your Website Name" value="{{ old('website') }}">
                                @error('website')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                        @if ($leadform->postalcode == 1)
                            <div class="col-md-6">
                                <label for="postalcode" class="form-label">Postal Code</label>
                                <input type="text" id="postalcode" name="postalcode"
                                    class="form-control @error('postalcode') is-validate @enderror"
                                    placeholder="Enter Your Postal Code" value="{{ old('postalcode') }}">
                                @error('postalcode')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif


                        @if ($leadform->address == 1)
                            <div class="col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" id="address" name="address"
                                    class="form-control  @error('address') is-validate @enderror"
                                    value="{{ old('address') }}" placeholder="Enter Contact Number">
                                @error('address')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                        @if ($leadform->number == 1)
                            <div class="col-md-6">
                                <label for="mobile" class="form-label">Number <span
                                        class="text-danger">*</span></label>
                                <input type="number" id="mobile" name="number"
                                    class="form-control  @error('number') is-validate @enderror"
                                    value="{{ old('number') }}" placeholder="Enter Contact Number"
                                    required="required">
                                @error('number')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif


                        @if ($leadform->message == 1)
                            <div class="col-md-6">
                                <label for="message" class="form-label">Message</label>
                                <textarea id="message" rows="3" name="message" class="form-control @error('message') is-validate @enderror"
                                    placeholder="Write your message here"></textarea>
                                @error('message')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                        @if ($leadform->leadsource == 1)
                            <div class="col-md-6">
                                <label for="leadsource" class="form-label">Lead Source <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('leadsource') is-validate @enderror"
                                    id="leadsource" name="leadsource" required="required">
                                    <option value="">Select Source</option>
                                    @if (isset($leadsource) && count($leadsource) > 0)
                                        @foreach ($leadsource as $source)
                                            <option value="{{ $source->id }}">{{ $source->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Source found</option>
                                    @endif
                                </select>
                                @error('source')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif


                        @if ($leadform->leadcategory == 1)
                            <div class="col-md-6">
                                <label for="product" class="form-label">Lead Category <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" id="leadcategory" name="leadcategory"
                                    required="required">
                                    <option value="">Select Category</option>
                                    @if (isset($leadcategory) && count($leadcategory) > 0)
                                        @foreach ($leadcategory as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    @else
                                        <option value="">No Category found</option>
                                    @endif
                                </select>
                                @error('leadcategory')
                                    <p>{{ $message }}</p>
                                @enderror
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i>
                                Submit</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </div>
                    @if (session('success'))
                        <script>
                            Swal.fire({
                                title: 'Success!',
                                text: '{{ session('success') }}',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });
                        </script>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#country').select2({
                placeholder: 'Select a country',
                ajax: {
                    url: 'https://restcountries.com/v3.1/all',
                    dataType: 'json',
                    processResults: function(data) {
                        // Sort the data alphabetically by country name
                        data.sort(function(a, b) {
                            return a.name.common.localeCompare(b.name.common);
                        });
                        return {
                            results: data.map(function(country) {
                                return {
                                    id: country.name.common,
                                    text: country.name.common
                                };
                            })
                        };
                    }
                }
            });


            $('form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('leadsenquiries.store') }}",
                    method: 'post',
                    data: $('form').serialize(),
                    success: function(response) {
                        if (response.status) {
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'Alright'
                            });
                            $('#leadAdd')[0].reset();
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'Alright'
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON.message,
                            icon: 'error',
                            confirmButtonText: 'Alright'
                        });
                    }
                });
            });


        });
    </script>
</body>

</html>
