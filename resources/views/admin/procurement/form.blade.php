<div class="row">
    <input type="hidden" name="procurement_items" id="procurement_items">

    <div class="row mb-3">
        <h3 class="card-header text-danger" style="margin-bottom: 30px !important;">Create Procurement&nbsp;<svg
                xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem" viewBox="0 0 512 512">
                <path fill="#ff3366"
                    d="M459.94 53.25a16.06 16.06 0 0 0-23.22-.56L424.35 65a8 8 0 0 0 0 11.31l11.34 11.32a8 8 0 0 0 11.34 0l12.06-12c6.1-6.09 6.67-16.01.85-22.38M399.34 90L218.82 270.2a9 9 0 0 0-2.31 3.93L208.16 299a3.91 3.91 0 0 0 4.86 4.86l24.85-8.35a9 9 0 0 0 3.93-2.31L422 112.66a9 9 0 0 0 0-12.66l-9.95-10a9 9 0 0 0-12.71 0" />
                <path fill="#ff3366"
                    d="M386.34 193.66L264.45 315.79A41.1 41.1 0 0 1 247.58 326l-25.9 8.67a35.92 35.92 0 0 1-44.33-44.33l8.67-25.9a41.1 41.1 0 0 1 10.19-16.87l122.13-121.91a8 8 0 0 0-5.65-13.66H104a56 56 0 0 0-56 56v240a56 56 0 0 0 56 56h240a56 56 0 0 0 56-56V199.31a8 8 0 0 0-13.66-5.65" />
            </svg></h3>
        <br>
        <div class="col-md-4">
            <label for="procurement_number" class="form-label">Request Number <span style="color: red">*</span></label>
            <input type="text" readonly class="form-control"
                value="{{ isset($procurement_number) ? $procurement_number : $procurementDetail->procurement_number }}"
                id="pnumber" name="procurement_number" required autocomplete="off" placeholder="Number">
        </div>

        <div class="col-md-4">
            <label for="email" class="form-label">Email <span style="color: red">*</span></label>
            <input type="text" value="{{ isset($procurementDetail) ? $procurementDetail->email : null }}"
                class="form-control" id="mail" name="email" required autocomplete="off" placeholder="Email">
        </div>

        <div class="col-md-4">
            <label for="request_date" class="form-label">Request Date <span style="color: red">*</span></label>
            <input type="date" class="form-control" id="request_date" name="request_date"
                value="{{ isset($procurementDetail) ? $procurementDetail->request_date : old('request_date') }}"
                required autocomplete="off">
        </div>

    </div>

    <div class="row mb-3 mt-4">
        <div class="col-md-6">
            <label for="delivery_date" class="form-label">Delivery Date <span style="color: red">*</span></label>
            <input type="date" class="form-control" id="delivery_date" name="delivery_date"
                value="{{ isset($procurementDetail) ? $procurementDetail->delivery_date : old('delivery_date') }}"
                required autocomplete="off">
        </div>
        <div class="col-md-6">
            <label for="purpose" class="form-label">Purpose</label>
            <textarea class="form-control" name="purpose" id="ckeditor" rows="2">{{ isset($procurementDetail) ? $procurementDetail->purpose : old('note') }}</textarea>
        </div>
    </div>


    {{-- Jquery will run and store multiple data  --}}
    <div class="row mb-3">
        <h3 class="card-header text-danger" style="margin-bottom: 30px !important;">Add Asset&nbsp;<svg
                xmlns="http://www.w3.org/2000/svg" width="1.4rem" height="1.4rem" viewBox="0 0 2048 2048">
                <path fill="#ff3366"
                    d="M896 1537V936L256 616v880l544 273l-31 127l-641-320V472L960 57l832 415v270q-70 11-128 45V616l-640 320v473zM754 302l584 334l247-124l-625-313zm206 523l240-120l-584-334l-281 141zm888 71q42 0 78 15t64 41t42 63t16 79q0 39-15 76t-43 65l-717 717l-377 94l94-377l717-716q29-29 65-43t76-14m51 249q21-21 21-51q0-31-20-50t-52-20q-14 0-27 4t-23 15l-692 692l-34 135l135-34z" />
            </svg></h3>
        <br>
        <div class="col-md-3">
            <label for="asset_type_id" class="form-label">Type&nbsp;<span class="text-danger">*</span></label>
            <select class="form-select" id="type" name="asset_type_id">
                <option value="" {{ isset($procurementDetail) ? '' : 'selected' }} disabled>Select Type</option>
                @if (count($assetType) > 0)
                    @foreach ($assetType as $value)
                        <option value="{{ $value->id }}"
                            {{ (isset($procurementDetail) && $procurementDetail->asset_type_id == $value->id) || old('type_id') == $value->id ? 'selected' : '' }}>
                            {{ ucfirst($value->name) }}
                        </option>
                    @endforeach
                @else
                    <option value="">No Asset Type found</option>
                @endif
            </select>
        </div>
        <div class="col-md-3">
            <label for="brand_id" class="form-label">Brand&nbsp;<span class="text-danger">*</span></label>
            <select class="form-select" id="brand" name="brand_id">
                <option value="" {{ isset($procurementDetail) ? '' : 'selected' }} disabled>Select Type</option>
                @foreach ($brands as $key => $value)
                    <option value="{{ $value->id }}"
                        {{ (isset($procurementDetail) && $procurementDetail->brand_id == $value->id) || old('brand_id') == $value->id ? 'selected' : '' }}>
                        {{ ucfirst($value->name) }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3"> <label for="quantity" class="form-label">Quantity&nbsp;<span
                    class="text-danger">*</span></label>
            <input type="number" value="{{ isset($procurementDetail) ? $procurementDetail->quantity : null }}"
                min="1" class="form-control" id="procurement_quantity" name="quantity" autocomplete="off"
                placeholder="Enter Amount">
        </div>
        <div class="col-md-3">
            <label for="quantity" class="form-label">Specification&nbsp;<span class="text-danger">*</span></label>
            <textarea name="specification" class="form-control" id="specification" cols="15" rows="2">{{ isset($procurementDetail) ? $procurementDetail->specification : null }}</textarea>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12 text-end">
            <button type="add" class="btn btn-primary text-light">Add to List</button>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-12">
            <table class="table table-bordered mt-3" id="added-items">
                <thead>
                    <tr class="bg-danger bg-gradient text-center">
                        <th style="color: white !important; font-weight:bold;">Type</th>
                        <th style="color: white !important; font-weight:bold;">Brand</th>
                        <th style="color: white !important; font-weight:bold;">Quantity</th>
                        <th style="color: white !important; font-weight:bold;">Specification</th>
                        <th style="color: white !important; font-weight:bold;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Added rows will appear here -->
                </tbody>
            </table>
        </div>
    </div>

    @canany(['edit_assets', 'create_assets'])
        <div class="row mb-3" style="margin-top: 100px !important;">
            <div class="col-md-12 text-end">
                <button type="submit" class="btn btn-success">
                    <i class="link-icon" data-feather="plus"></i>
                    {{ isset($procurementDetail) ? 'Update' : 'Create' }}
                </button>
            </div>
        </div>
    @endcanany
</div>
