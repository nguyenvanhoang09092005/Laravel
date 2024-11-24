@extends('admin.layouts.layout')
@section('admin_page_title')
    Edit Product - Admin
@endsection
@section('admin_layout')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit Product</h3>
            </div>

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

            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
                action="{{ route('product.update', $product->id) }}">
                @csrf
                @method('PUT') <!-- Sử dụng phương thức PUT để cập nhật sản phẩm -->

                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter product name" name="product_name"
                            value="{{ old('product_name', $product->product_name) }}" required>
                    </fieldset>

                    <fieldset class="name">
                        <div class="body-title mb-10">Slug <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Enter product slug" name="slug"
                            value="{{ old('slug', $product->slug) }}" required>
                    </fieldset>

                    <div class="gap22">
                        <livewire:category-brand />
                    </div>

                    <fieldset class="description">
                        <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                        <textarea class="mb-10" name="description" placeholder="Description" required>{{ old('description', $product->description) }}</textarea>
                    </fieldset>
                </div>

                <div class="wg-box">
                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span>
                        </div>
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
                                    <input type="file" id="myFile" name="product_img" accept="image/*"
                                        onchange="previewFile()">

                                </label>
                            </div>
                        </div>
                    </fieldset>


                    <div>
                        <label>Attributes:</label>
                        @foreach ($attributes as $attribute)
                            <label>
                                <input type="radio" name="attribute_id" value="{{ $attribute->id }}"
                                    {{ $product->attribute_id == $attribute->id ? 'checked' : '' }}>
                                {{ $attribute->attribute_value }}
                            </label>
                        @endforeach
                    </div>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Regular Price <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter regular price" name="regular_price"
                                value="{{ old('regular_price', $product->regular_price) }}" required>
                        </fieldset>

                        <fieldset class="name">
                            <div class="body-title mb-10">Sale Price</div>
                            <input class="mb-10" type="text" placeholder="Enter sale price" name="discounted_price"
                                value="{{ old('discounted_price', $product->discounted_price) }}">
                        </fieldset>
                    </div>


                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">SKU <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter SKU" name="sku"
                                value="{{ old('sku', $product->sku) }}" required>
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter quantity" name="stock_quantity"
                                value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                        </fieldset>
                    </div>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Stock</div>
                            <select name="stock_status">
                                <option value="In Stock" {{ $product->stock_status == 'In Stock' ? 'selected' : '' }}>In
                                    Stock</option>
                                <option value="Out of Stock"
                                    {{ $product->stock_status == 'Out of Stock' ? 'selected' : '' }}>Out of Stock</option>
                            </select>
                        </fieldset>
                    </div>

                    <input type="hidden" name="admin_id" value="{{ Auth::id() }}">
                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
