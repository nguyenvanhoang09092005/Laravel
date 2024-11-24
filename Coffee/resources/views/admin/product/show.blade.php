@extends('admin.layouts.layout')
@section('admin_page_title')
    Product Details - {{ $product->product_name }}
@endsection
@section('admin_layout')
    <div class="container mt-4">
        <h3 class="mb-4">{{ $product->product_name }}</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="product-image mb-3 text-center">
                    @if ($product->product_img)
                        <img src="{{ asset('storage/' . $product->product_img) }}" alt="Product Image"
                            class="img-fluid rounded">
                    @else
                        <span class="text-muted">No Image Available</span>
                    @endif
                </div>
            </div>
            <div class="col-md-8">
                <div class="product-info">
                    <p><strong>ID:</strong> {{ $product->id }}</p>
                    <p><strong>Name:</strong> {{ $product->product_name }}</p>
                    <p><strong>SKU:</strong> {{ $product->sku }}</p>
                    <p><strong>Slug:</strong> {{ $product->slug }}</p>
                    <p><strong>Attribute:</strong>
                        {{ $product->attribute ? $product->attribute->attribute_value : 'No Attribute' }}</p>
                    <p><strong>Regular Price:</strong> ${{ number_format($product->regular_price, 2) }}</p>
                    <p><strong>Discounted Price:</strong>
                        @if ($product->discounted_price)
                            ${{ number_format($product->discounted_price, 2) }}
                        @else
                            N/A
                        @endif
                    </p>


                    <p><strong>Stock Quantity:</strong> {{ $product->stock_quantity }}</p>
                    <p><strong>Stock Status:</strong>
                        <span class="badge {{ $product->stock_status == 'In Stock' ? 'bg-success' : 'bg-danger' }}">
                            {{ $product->stock_status }}
                        </span>
                    </p>
                    <p><strong>Description:</strong> {{ $product->description }}</p>
                </div>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('product.manage') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to
                Product List</a>
        </div>
    </div>
@endsection
