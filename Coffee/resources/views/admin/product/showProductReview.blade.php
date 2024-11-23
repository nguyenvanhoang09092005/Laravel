{{-- @extends('admin.layouts.layout')
@section('admin_page_title')
    Manager Product Review-Admin
@endsection
@section('admin_layout')
    <div class="container">
        <h1>Chi tiết đánh giá</h1>

        <div class="review-detail">
            <p><strong>Người dùng:</strong> {{ $review->user->name }}</p>
            <p><strong>Đánh giá:</strong> {{ $review->rating }} sao</p>
            <p><strong>Nhận xét:</strong> {{ $review->review }}</p>
        </div>
        @foreach ($products as $product)
            <a href="{{ route('product.review.manage_product_review', $product) }}">Quản lý đánh giá</a>
        @endforeach


    </div>
@endsection --}}
