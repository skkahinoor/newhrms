@extends('vendor.layouts.app')
@section('title', 'Vendor Products')
@section('breadcrumblink', 'Products')
@section('breadcrumbtitle', 'Vendor Products')
{{-- @section('navactivecolor', 'active bg-gradient-primary') --}}

@section('main-content')
    <div class="container-fluid py-4">

        {{-- Show Alert Message  --}}
        @include('vendor.common.flashmessage')

        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <form class="forms-sample" method="POST" action="{{ route('vendor.productcreate') }}">
                        @csrf
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white text-capitalize ps-3">Add Product</h6>
                            </div>
                        </div>
                        <div class="card-body p-5 px-0 pb-2">
                            <div class="row g-2" style="padding: 20px !important;">
                                <div class="col-md-6">
                                    <div class="form-floating"
                                        style="border: solid #3736362e 1px !important;border-radius: 7px !important;">
                                        <select class="form-select" name="product" required id="floatingSelectGrid"
                                            style="padding-left: 5px !important;">
                                            <option value="">Select option</option>
                                            @if (count($assetType) > 0)
                                                @foreach ($assetType as $product)
                                                    <option value="{{ $product->id }}"
                                                        {{ $getUserDetails->asset_type == $product->id ? 'selected' : '' }}>
                                                        {{ $product->name }}
                                                    </option>
                                                @endforeach
                                            @else
                                                <option value="">No Product found</option>
                                            @endif
                                        </select>
                                        <label for="floatingSelectGrid">Select Product&nbsp;<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating"
                                        style="border: solid #3736362e 1px !important;border-radius: 7px !important;">
                                        <input type="text" name="brand" class="form-control" id="floatingInputGrid"
                                            placeholder="Enter Product Brand" required style="padding-left: 7px !important;"
                                            value="{{ old('brand') }}">
                                        <label for="floatingInputGrid">Enter Product Brand&nbsp;<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating"
                                        style="border: solid #3736362e 1px !important;border-radius: 7px !important;">
                                        <input type="number" name="quantity" class="form-control" id="floatingInputGrid"
                                            placeholder="Enter Product Quantity" required
                                            style="padding-left: 7px !important;" value="{{ old('quantity') }}">
                                        <label for="floatingInputGrid">Product Available Quantity&nbsp;<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating"
                                        style="border: solid #3736362e 1px !important;border-radius: 7px !important;">
                                        <input type="number" name="buyprice" step="0.01" class="form-control" id="floatingInputGrid"
                                            placeholder="Enter Product Quantity" value="{{ old('buyprice') }}" required
                                            style="padding-left: 7px !important;">
                                        <label for="floatingInputGrid">Enter Product Buy Price&nbsp;<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating"
                                        style="border: solid #3736362e 1px !important;border-radius: 7px !important;">
                                        <input type="number" name="saleprice" step="0.01" class="form-control" id="floatingInputGrid"
                                            placeholder="Enter Product Quantity" value="{{ old('saleprice') }}" required
                                            style="padding-left: 7px !important;">
                                        <label for="floatingInputGrid">Enter Product Sale Price&nbsp;<span
                                                class="text-danger">*</span></label>
                                    </div>
                                </div>
                                <!-- Margin -->
                                <div class="col-md-6">
                                    <div class="form-floating"
                                        style="border: solid #3736362e 1px !important;border-radius: 7px !important;">
                                        <input type="text" name="margin" class="form-control" id="floatingInputGrid"
                                            placeholder="Estimated Margin" value="{{ old('margin') }}" readonly
                                            style="padding-left: 7px !important;">
                                        <label for="floatingInputGrid">Your Estimated Margin in&nbsp;<span
                                                class="text-danger">₹</span></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pb-0 p-3">
                            <div class="row">
                                <div class="d-flex text-end" style="flex-direction: row-reverse !important;">
                                    <button class="btn bg-gradient-dark mb-0" type="submit"><i
                                            class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Product</button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Products List</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        @if ($fetchProduct->isEmpty())
                            <br>
                            <p class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">No
                                Product Found ...</p>
                        @else
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-center text-secondary text-xxs font-weight-bolder opacity-7">
                                                #</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Product</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Product Brand</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Quantity</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Buy Price</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Sale Price</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Margin</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($getOrder as $key => $order)
                                            <tr>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $getOrder->firstItem() + $key }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $order->asset_types->name ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $order->product_brand ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $order->quantity ?? 'N/A' }}&nbsp;Pcs</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">₹{{ $order->buy_price ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">₹{{ $order->sale_price }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">₹{{ $order->margin ?? 'N/A' }}</span>
                                                </td>
                                                <td class="align-middle text-center">

                                                    <div class="row"
                                                        style="display: flex !important;justify-content: center !important;">
                                                        <div class="col-md-3">
                                                            <a class="editProductBtn" data-id="{{ $order->id }}"
                                                                data-brand="{{ $order->product_brand }}"
                                                                data-buyprice="{{ $order->buy_price }}"
                                                                data-saleprice="{{ $order->sale_price }}"
                                                                data-margin="{{ $order->margin }}"
                                                                data-quantity="{{ $order->quantity }}"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#editProductBtnModal"
                                                                style="cursor: pointer;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                    height="1.2rem" viewBox="0 0 24 24">
                                                                    <path fill="#ff4242"
                                                                        d="m7 17.013l4.413-.015l9.632-9.54c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.756-.756-2.075-.752-2.825-.003L7 12.583zM18.045 4.458l1.589 1.583l-1.597 1.582l-1.586-1.585zM9 13.417l6.03-5.973l1.586 1.586l-6.029 5.971L9 15.006z" />
                                                                    <path fill="#ff4242"
                                                                        d="M5 21h14c1.103 0 2-.897 2-2v-8.668l-2 2V19H8.158c-.026 0-.053.01-.079.01c-.033 0-.066-.009-.1-.01H5V5h6.847l2-2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <a class="deleteProduct" data-id="{{ $order->id }}"
                                                                data-bs-toggle="modal" data-target="#deleteProductModal"
                                                                style="cursor: pointer;">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                    height="1.2rem" viewBox="0 0 24 24">
                                                                    <path fill="#ff4242"
                                                                        d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V9c0-1.1-.9-2-2-2H8c-1.1 0-2 .9-2 2zM18 4h-2.5l-.71-.71c-.18-.18-.44-.29-.7-.29H9.91c-.26 0-.52.11-.7.29L8.5 4H6c-.55 0-1 .45-1 1s.45 1 1 1h12c.55 0 1-.45 1-1s-.45-1-1-1" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <br>
                            <div class="row">{{ $getOrder->links() }}</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        {{-- Vendor Footer here  --}}
        @include('vendor.section.vendorfooter')
    </div>


    {{-- Model Code is here  --}}

    {{-- Modal for Update Product  --}}
    <!-- Modal -->
    <div class="modal fade" id="editProductBtnModal" tabindex="-1" aria-labelledby="editProductLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editProductForm" action="{{ route('vendor.productupdate') }}" method="POST">
                        @csrf
                        <input type="hidden" name="order_id" id="order_id">
                        <div class="mb-3">
                            <label for="product_brand" class="form-label">Brand&nbsp;<span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="product_brand" name="product_brand"
                                placeholder="Enter the Product Brand Name" required>
                        </div>
                        <div class="mb-3">
                            <label for="buy_price" class="form-label">Buy Price&nbsp;<span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="buy_price" name="buy_price"
                                placeholder="Enter the Product Buy Price" required>
                        </div>
                        <div class="mb-3">
                            <label for="sale_price" class="form-label">Sale Price&nbsp;<span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="sale_price" name="sale_price"
                                placeholder="Enter the Product Sale Price" required>
                        </div>
                        <div class="mb-3">
                            <label for="sale_price" class="form-label">Margin</label>
                            <input type="number" class="form-control" id="modalmargin" name="modalmargin" readonly
                                placeholder=" Margin Will be Automatic calculated">
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Available Quantity&nbsp;<span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="quantity" name="quantity"
                                placeholder="Enter the Product available stock" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for Delete  --}}
    <!-- Delete Product Modal -->
    <div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteProductModalLabel">Delete Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                    <form id="deleteProductForm" action="{{ route('vendor.productdelete') }}" method="POST">
                        @csrf
                        @method('PUT') 
                        <input type="hidden" name="order_id" id="delete_order_id">
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- Script  --}}
    @include('vendor.common.script')


@endsection
