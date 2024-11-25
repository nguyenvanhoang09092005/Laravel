@extends('admin.layouts.layout')

@section('admin_page_title')
    Edit Promotions-Admin
@endsection

@section('admin_layout')
    <!-- main-content-wrap -->
    <div class="main-content-inner">
        <div class="main-content-wrap">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- form-edit-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
                action="{{ route('promotions.update', $promotion->id) }}">
                @csrf
                @method('PUT')

                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Discount Type <span class="tf-color-1">*</span></div>
                        <div class="select mb-10">
                            <select name="type" class="">
                                <option value="percentage"
                                    {{ old('type', $promotion->type) == 'percentage' ? 'selected' : '' }}>Percentage
                                </option>
                                <option value="fixed" {{ old('type', $promotion->type) == 'fixed' ? 'selected' : '' }}>
                                    Fixed Amount
                                </option>
                            </select>
                        </div>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title mb-5">Discount Value <span class="tf-color-1">*</span></div>
                        <div class="input-group mb-8">
                            <input type="number" step="0.01" class="mb-10" placeholder="Enter discount value"
                                name="discount" value="{{ old('discount', $promotion->discount) }}" required>
                        </div>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title mb-10">Sku<span class="tf-color-1">*</span></div>
                        <input list="sku-suggestions" class="mb-10" type="text" id="product_sku"
                            placeholder="Enter product SKU(s)" name="sku" value="{{ old('sku', $promotion->sku) }}">
                        <datalist id="sku-suggestions"></datalist>
                    </fieldset>

                    <div class="gap22">
                        <livewire:CategoryLivewire selectedCategory="{{ old('category_id', $promotion->category_id) }}" />
                    </div>

                </div>

                <div class="wg-box">
                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" style="display:none">
                                <img id="previewImage" src="#" class="effect8 full-image" alt="">
                            </div>

                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon">
                                        <i class="icon-upload-cloud"></i>
                                    </span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to
                                            browse</span></span>
                                    <input type="file" id="myFile" name="promotion_img" accept="image/*"
                                        onchange="previewFile()">
                                </label>
                            </div>

                            @if ($promotion->promotion_img)
                                <div class="item">
                                    <img src="{{ Storage::url($promotion->promotion_img) }}" alt="Promotion Image"
                                        class="img-thumbnail" width="150">
                                    <span>Current Image</span>
                                </div>
                            @endif
                        </div>
                    </fieldset>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Stock</div>
                            <div class="select mb-10">
                                <select name="status">
                                    <option value="In Stock"
                                        {{ old('status', $promotion->status) == 'In Stock' ? 'selected' : '' }}>In Stock
                                    </option>
                                    <option value="Out of Stock"
                                        {{ old('status', $promotion->status) == 'Out of Stock' ? 'selected' : '' }}>Out of
                                        Stock</option>
                                </select>
                            </div>
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Expiry Date<span class="tf-color-1">*</span></div>
                            <div class="select mb-10">
                                <input type="date" name="expiry_date" id="expiry_date" class="form-control"
                                    value="{{ old('expiry_date', $promotion->expiry_date ? \Carbon\Carbon::parse($promotion->expiry_date)->format('Y-m-d') : '') }}">
                            </div>
                        </fieldset>

                    </div>

                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Update Promotion</button>
                    </div>
                </div>
            </form>
            <!-- /form-edit-product -->
        </div>
    </div>
@endsection
