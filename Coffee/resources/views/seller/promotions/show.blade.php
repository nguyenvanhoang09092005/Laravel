@extends('seller.layouts.layout');
@section('seller_page_title')
    Promotion Details - Seller
@endsection

@section('seller_layout')
    <div class="main-content-inner">
        <div class="main-content-wrap">

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="wg-box">
                <div class="promotion-details">
                    <h3>Promotion Code: {{ $promotion->code ?? 'N/A' }}</h3>
                    <p><strong>Discount Type:</strong> {{ ucfirst($promotion->type) }}</p>
                    <p><strong>Discount Value:</strong> {{ $promotion->discount }}
                        {{ $promotion->type == 'percentage' ? '%' : '$' }}</p>
                    <p><strong>SKU:</strong> {{ $promotion->sku ?? 'N/A' }}</p>
                    <p><strong>Category:</strong> {{ $promotion->category->name ?? 'N/A' }}</p>
                    <p><strong>Status:</strong> {{ $promotion->status }}</p>
                    <p><strong>Expiry Date:</strong>{{ $promotion->expiry_date }}</p>

                    @if ($promotion->promotion_img)
                        <p><strong>Promotion Image:</strong></p>
                        <img src="{{ Storage::url($promotion->promotion_img) }}" alt="Promotion Image" class="img-fluid">
                    @else
                        <p>No image available for this promotion.</p>
                    @endif

                    <div class="actions">
                        <a href="{{ route('promotions.manage') }}" class="btn btn-secondary"><i
                                class="bi bi-arrow-left"></i> Back to
                            Promotions List</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
