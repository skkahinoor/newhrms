<div class="row">

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="procurement_number" class="form-label">Request Number <span style="color: red">*</span></label>
        <input type="text" readonly class="form-control"
            value="{{ isset($procurement_number) ? $procurement_number : $procurementDetail->procurement_number }}"
            id="pnumber" name="procurement_number" required autocomplete="off" placeholder="Number">
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="user_id" class="form-label">Name</label>
        <select class="form-select" id="user_id" name="user_id">
            <option value="" {{ isset($procurementDetail) || old('assigned_to') ? '' : 'selected' }}>Select
                Employee</option>
            @foreach ($employees as $key => $value)
                <option value="{{ $value->id }}"
                    {{ (isset($procurementDetail) && $procurementDetail->user_id == $value->id) || old('user_id') == $value->id ? 'selected' : old('user_id') }}>
                    {{ ucfirst($value->name) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="email" class="form-label">Email <span style="color: red">*</span></label>
        <input type="text" value="{{ isset($procurementDetail) ? $procurementDetail->email : null }}"
            class="form-control" id="mail" name="email" required autocomplete="off" placeholder="Email">
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="asset_type_id" class="form-label">Type <span style="color: red">*</span></label>
        <select class="form-select" id="type" name="asset_type_id" required>
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

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="brand_id" class="form-label">Brand <span style="color: red">*</span></label>
        <select class="form-select" id="brand" name="brand_id" required>
            <option value="" {{ isset($procurementDetail) ? '' : 'selected' }} disabled>Select Type</option>
            @foreach ($brands as $key => $value)
                <option value="{{ $value->id }}"
                    {{ (isset($procurementDetail) && $procurementDetail->brand_id == $value->id) || old('brand_id') == $value->id ? 'selected' : '' }}>
                    {{ ucfirst($value->name) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="quantity" class="form-label">Quantity<span style="color: red">*</span></label>
        <input type="number" value="{{ isset($procurementDetail) ? $procurementDetail->quantity : null }}"
            min="1" class="form-control" id="procurement_quantity" name="quantity" required autocomplete="off"
            placeholder="Enter Amount">
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="request_date" class="form-label">Request Date <span style="color: red">*</span></label>
        <input type="date" class="form-control" id="request_date" name="request_date"
            value="{{ isset($procurementDetail) ? $procurementDetail->request_date : old('request_date') }}"
            required autocomplete="off">
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="delivery_date" class="form-label">Delivery Date <span style="color: red">*</span></label>
        <input type="date" class="form-control" id="delivery_date" name="delivery_date"
            value="{{ isset($procurementDetail) ? $procurementDetail->delivery_date : old('delivery_date') }}"
            required autocomplete="off">
    </div>

    <div class="col-lg-4 col-md-6 mb-4">
        <label for="purpose" class="form-label">Purpose</label>
        <textarea class="form-control" name="purpose" id="ckeditor" rows="2">{{ isset($procurementDetail) ? $procurementDetail->purpose : old('note') }}</textarea>
    </div>

    @canany(['edit_assets', 'create_assets'])
        <div class="text-start">
            <button type="submit" class="btn btn-primary">
                <i class="link-icon" data-feather="plus"></i>
                {{ isset($procurementDetail) ? 'Update' : 'Create' }}
            </button>
        </div>
    @endcanany
</div>
