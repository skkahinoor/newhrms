<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>CRM Enquery Form</title>
</head>
<body>
    <div class="container">
        <div class=" text-center mt-5 ">
    
            <h1 >CRM Enqueryhhhhh Form</h1>
                
            
        </div>
    
    
    <div class="row ">
      <div class="col-lg-7 mx-auto">
        <div class="card mt-2 mx-auto p-4 bg-light">
            <div class="card-body bg-light">
       
            <div class = "container">
                <form id="clientAdd" class="forms-sample" action="{{route('leadsenquiries.store')}}" method="POST">
                    @csrf
            <div class="controls">
    
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_name">Name *</label>
                            <input id="form_name" type="text" name="name" class="form-control @error('name') is-validate @enderror" placeholder="Please enter your name *" required="required" value="{{ old('name') }}">
                            @error('name')
                   <p>{{ $message }}</p>
               @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_lastname">Email *</label>
                            <input id="form_lastname" type="text" name="email" class="form-control @error('email') is-validate @enderror" placeholder="Enter Client Email" required="required" value="{{  old('email') }}">
                            @error('email')
                   <p>{{ $message }}</p>
               @enderror
                                                            </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_email">Number *</label>
                            <input id="form_email" type="number" name="number" class="form-control  @error('number') is-validate @enderror" value="{{ old('number') }}" placeholder="Enter Contact Number" required="required" >
                            @error('number')
               <p>{{ $message }}</p>
           @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="form_email">Address *</label>
                            <input id="form_email" type="text" name="address" class="form-control  @error('address') is-validate @enderror" value="{{ old('address') }}" placeholder="Enter Contact Number" required="required" >
                            @error('address')
               <p>{{ $message }}</p>
           @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="form_message">Message *</label>
                            <textarea id="form_message" name="message" class="form-control @error('message') is-validate @enderror" placeholder="Write your message here." rows="4" required="required">{{ old('message') }}</textarea
                                >
                                @error('message')
               <p>{{ $message }}</p>
           @enderror
                            </div>
    
                        </div>
                        <br>
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-success btn-send  pt-2 btn-block
                            ">Submit</button>
                    
                </div>
          
                </div>
    
    
        </div>
         </form>
        </div>
            </div>
    
    
    </div>
        <!-- /.8 -->
    
    </div>
    <!-- /.row-->
    </div>
    </div>
</body>
</html>





    {{-- <section class="content">

        @include('admin.section.flash_message')

        @include('leadsenquiries.common.breadcrumb')

        <div class="card">
            
            <div class="card-body pb-0">
                <form id="clientAdd" class="forms-sample" action="{{route('leadsenquiries.store')}}" method="POST">
                    @csrf
                    @include('leadsenquiries.common.form')
                </form>
            </div>
        </div>

    </section> --}}


{{-- @section('scripts')

    @include('admin.client.common.scripts')

@endsection --}}
