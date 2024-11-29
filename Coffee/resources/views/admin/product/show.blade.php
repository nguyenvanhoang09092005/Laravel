@extends('admin.layouts.layout')
@section('admin_page_title')
    Product Details - {{ $product->product_name }}
@endsection
@section('admin_layout')
    <style>
        .product-single__details-tab {
            margin: 0 auto 2.375rem;
            margin-top: 5px;
            max-width: 58.125rem;
        }

        .product-single__details-tab>.nav-tabs {
            justify-content: center;
            text-transform: uppercase;
        }

        @media (max-width: 575.98px) {
            .product-single__details-tab>.nav-tabs {
                flex-direction: column;
            }

            .product-single__details-tab>.nav-tabs .nav-link {
                width: max-content;
            }
        }

        .product-single__details-tab>.tab-content {
            padding: 3.125rem 0;
        }

        .tab-content>.tab-pane {
            display: none;
        }

        .tab-content>.active {
            display: block;
        }

        .product-single__addtional-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #f9f9f9;
            max-width: 500px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .product-single__addtional-info .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .product-single__addtional-info .item:last-child {
            border-bottom: none;
        }

        .product-single__addtional-info .h6 {
            font-size: 14px;
            font-weight: bold;
            color: #333;
            margin: 0;
        }

        .product-single__addtional-info span {
            font-size: 14px;
            color: #555;
        }

        .product-single__addtional-info span sup {
            font-size: 12px;
            color: #777;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 12px;
            color: white;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .bg-success {
            background-color: #28a745;
        }

        .bg-danger {
            background-color: #dc3545;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .product-single__addtional-info {
                max-width: 100%;
                padding: 15px;
            }

            .product-single__addtional-info .item {
                flex-direction: column;
                align-items: flex-start;
            }

            .product-single__addtional-info .h6,
            .product-single__addtional-info span {
                font-size: 13px;
            }
        }

        /* Đặt màu chữ trắng cho các liên kết trong tab */
        .nav-tabs .nav-link {
            color: white;
            background-color: transparent;
            border: none;
            font-weight: bold;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-tabs .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.0);
            color: #f8f9fa;
            border-radius: 5px;
        }

        .nav-tabs .nav-link.active {
            color: rgb(41, 160, 220);
            text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);
            box-shadow: 0px 4px 8px rgba(41, 160, 220, 0.5);
            border-radius: 5px;
            background: rgba(41, 160, 220, 0.1);
            padding: 8px 12px;
            transition: all 0.3s ease-in-out;
        }


        .nav-tabs {
            background-color: #ffffff;
            padding: 10px;
            border-radius: 8px;
        }
    </style>
    <div class="wg-box">
        <div class="container mt-4">

            <div class="row">
                <div class="col-md-4 mt-5">
                    <div class="product-image mb-3 text-center">
                        @if ($product->product_img)
                            <img src="{{ asset('storage/' . $product->product_img) }}  " alt="Product Image"
                                class="img-fluid rounded" style="height: 550px; width: 400px;">
                        @else
                            <span class="text-muted">No Image Available</span>
                        @endif
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="product-single__details-tab">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            <li class="nav-item" role="presentation">
                                <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                                    href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                                    aria-selected="false">Additional Information</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab"
                                    href="#tab-reviews" role="tab" aria-controls="tab-reviews"
                                    aria-selected="false">Reviews
                                    (2)</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-description" role="tabpanel"
                                aria-labelledby="tab-description-tab">

                            </div>
                            <div class="tab-pane fade" id="tab-additional-info" role="tabpanel"
                                aria-labelledby="tab-additional-info-tab">
                                <div class="product-single__addtional-info">
                                    <div class="item">
                                        <label class="h6">ID</label>
                                        <span>{{ $product->id }}</span>
                                    </div>

                                    <div class="item">
                                        <label class="h6">Name</label>
                                        {{ $product->product_name }}
                                    </div>
                                    <div class="item">
                                        <label class="h6">SKU</label>
                                        <span>{{ $product->slug }}</span>
                                    </div>
                                    <div class="item">
                                        <label class="h6">Attribute</label>
                                        <span>{{ $product->attribute ? $product->attribute->attribute_value : 'No Attribute' }}</span>
                                    </div>
                                    <div class="item">
                                        <label class="h6">Regular Price</label>
                                        <span>{{ number_format($product->regular_price, 0, ',', '.') }} <sup>đ</sup></span>
                                    </div>
                                    <div class="item">
                                        <label class="h6">Discounted Price</label>
                                        <span>
                                            @if ($product->discounted_price)
                                                {{ number_format($product->discounted_price, 0, ',', '.') }} <sup>đ</sup>
                                            @else
                                                N/A
                                            @endif
                                        </span>
                                    </div>
                                    <div class="item">
                                        <label class="h6">Stock Quantity</label>
                                        <span
                                            class="badge {{ $product->stock_status == 'In Stock' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $product->stock_status }}
                                        </span>
                                    </div>
                                    <div class="item">
                                        <label class="h6">Description</label>
                                        <span>{{ $product->description }}</span>
                                    </div>

                                </div>
                            </div>
                            <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                                <h2 class="product-single__reviews-title">Reviews</h2>
                                <div class="product-single__reviews-list">
                                    <div class="product-single__reviews-item">
                                        <div class="customer-avatar">
                                            <img loading="lazy" src="assets/images/avatar.jpg" alt="" />
                                        </div>
                                        <div class="customer-review">
                                            <div class="customer-name">
                                                <h6>Janice Miller</h6>
                                                <div class="reviews-group d-flex">
                                                    <svg class="review-star" viewBox="0 0 9 9"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_star" />
                                                    </svg>
                                                    <svg class="review-star" viewBox="0 0 9 9"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_star" />
                                                    </svg>
                                                    <svg class="review-star" viewBox="0 0 9 9"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_star" />
                                                    </svg>
                                                    <svg class="review-star" viewBox="0 0 9 9"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_star" />
                                                    </svg>
                                                    <svg class="review-star" viewBox="0 0 9 9"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_star" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="review-date">April 06, 2023</div>
                                            <div class="review-text">
                                                <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil
                                                    impedit quo
                                                    minus id quod
                                                    maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-single__reviews-item">
                                        <div class="customer-avatar">
                                            <img loading="lazy" src="assets/images/avatar.jpg" alt="" />
                                        </div>
                                        <div class="customer-review">
                                            <div class="customer-name">
                                                <h6>Benjam Porter</h6>
                                                <div class="reviews-group d-flex">
                                                    <svg class="review-star" viewBox="0 0 9 9"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_star" />
                                                    </svg>
                                                    <svg class="review-star" viewBox="0 0 9 9"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_star" />
                                                    </svg>
                                                    <svg class="review-star" viewBox="0 0 9 9"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_star" />
                                                    </svg>
                                                    <svg class="review-star" viewBox="0 0 9 9"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_star" />
                                                    </svg>
                                                    <svg class="review-star" viewBox="0 0 9 9"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <use href="#icon_star" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="review-date">April 06, 2023</div>
                                            <div class="review-text">
                                                <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil
                                                    impedit quo
                                                    minus id quod
                                                    maxime placeat facere possimus, omnis voluptas assumenda est…</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


                <div class="mt-4 d-flex justify-content-end">
                    <a href="{{ route('product.manage') }}" class="btn btn-secondary tf-button style-1 w308 text-end"><i
                            class="bi bi-arrow-left"></i> Back to
                        Product List</a>
                </div>
            </div>
        </div>
    @endsection
