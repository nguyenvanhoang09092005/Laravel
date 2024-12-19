@extends('customer.dashboard')

@section('customer_content')
    <section class="product-single container " style="margin-top: 85px">
        <div class="row">
            <div class="col-lg-7">
                <div class="product-single__media" data-media-type="vertical-thumbnail">
                    <div class="product-single__image">
                        <div class="swiper-container">
                            <div class="swiper-wrapper">
                                <img loading="lazy" class="h-auto" src="{{ asset('storage/') }}/{{ $product->product_img }}"
                                    width="674" height="674" alt="" />
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-5">
                <div class="d-flex justify-content-between mb-4 pb-md-2">

                </div>
                <h1 class="product-single__name">{{ $product->product_name }}</h1>
                <div class="product-single__rating">
                    <div class="reviews-group d-flex">
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_star" />
                        </svg>
                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_star" />
                        </svg>
                    </div>
                    <span class="reviews-note text-lowercase text-secondary ms-1">8k+ reviews</span>
                </div>
                <div class="product-single__price">
                    <span class="current-price">
                        @if ($product->discounted_price)
                            <span class="text-muted"><s>{{ number_format($product->regular_price, 0, ',', '.') }}
                                    <sup>đ</sup></s></span>
                            <span class="text-danger">{{ number_format($product->discounted_price, 0, ',', '.') }}
                                <sup>đ</sup></span>
                        @else
                            <span>{{ number_format($product->regular_price, 0, ',', '.') }} <sup>đ</sup></span>
                        @endif

                    </span>
                </div>
                <div class="product-single__short-desc">
                    <p>{{ $product->description }}</p>
                </div>
                <form name="addtocart-form" method="POST" action="{{ route('Customer.Cart', $product->id) }}">
                    @csrf
                    <div class="product-single__addtocart">
                        <div class="qty-control position-relative">
                            <input type="number" name="quantity" value="1" min="1"
                                class="qty-control__number text-center">
                            <div class="qty-control__reduce">-</div>
                            <div class="qty-control__increase">+</div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-addtocart" data-aside="cartDrawer">
                            Thêm vào giỏ hàng
                        </button>
                    </div>
                </form>


            </div>
        </div>
        <div class="product-single__details-tab">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore" id="tab-additional-info-tab" data-bs-toggle="tab"
                        href="#tab-additional-info" role="tab" aria-controls="tab-additional-info"
                        aria-selected="false">Thông tin bổ sung</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore" id="tab-reviews-tab" data-bs-toggle="tab" href="#tab-reviews"
                        role="tab" aria-controls="tab-reviews" aria-selected="false">Đánh giá
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
                            <label class="h6">Mã sản phẩm</label>
                            <span>{{ $product->id }}</span>
                        </div>

                        <div class="item">
                            <label class="h6">Tên sản phẩm</label>
                            {{ $product->product_name }}
                        </div>
                        <div class="item">
                            <label class="h6">Mã SKU</label>
                            <span>{{ $product->slug }}</span>
                        </div>

                        {{-- <div class="item">
                            <label class="h6">Danh mục</label>
                            <span>{{ $product->category->name ?? 'Không tìm thấy danh mục' }}</span>
                        </div>

                        <div class="item">
                            <label class="h6">Thương hiệu</label>
                            <span>{{ $product->brand->name ?? 'Không tìm thấy thương hiệu' }}</span>
                        </div> --}}

                        <div class="item">
                            <label class="h6">Size</label>
                            <span>{{ $product->attribute ? $product->attribute->attribute_value : 'Không có thuộc tính' }}</span>
                        </div>
                        <div class="item">
                            <label class="h6">Giá gốc</label>
                            <span>{{ number_format($product->regular_price, 0, ',', '.') }} <sup>đ</sup></span>
                        </div>
                        <div class="item">
                            <label class="h6">Giá giảm</label>
                            <span>
                                @if ($product->discounted_price)
                                    {{ number_format($product->discounted_price, 0, ',', '.') }} <sup>đ</sup>
                                @else
                                    Không có
                                @endif
                            </span>
                        </div>
                        <div class="item">
                            <label class="h6">Tình trạng</label>
                            <span class="badge {{ $product->stock_status == 'In Stock' ? 'bg-success' : 'bg-danger' }}">
                                {{ $product->stock_status }}
                            </span>
                        </div>
                        <div class="item">
                            <label class="h6">Mô tả</label>
                            <span>{{ $product->description }}</span>
                        </div>
                    </div>

                </div>
                <div class="tab-pane fade" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">

                    <div class="product-single__reviews-list">
                        <div class="product-single__reviews-item">
                            <div class="customer-avatar">
                                <img loading="lazy" src="assets/images/avatar.jpg" alt="" />
                            </div>
                            <div class="customer-review">
                                <div class="customer-name">
                                    <h6>Janice Miller</h6>
                                    <div class="reviews-group d-flex">
                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                        </svg>
                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                        </svg>
                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                        </svg>
                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                        </svg>
                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="review-date">Ngày 06 tháng 4, 2023</div>
                                <div class="review-text">
                                    <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
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
                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                        </svg>
                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                        </svg>
                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                        </svg>
                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                        </svg>
                                        <svg class="review-star" viewBox="0 0 9 9" xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_star" />
                                        </svg>
                                    </div>
                                </div>
                                <div class="review-date">Ngày 06 tháng 4, 2023</div>
                                <div class="review-text">
                                    <p>Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo
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
        </div>
        </div>
    </section>
    {{-- <section class="products-carousel container">
        <h2 class="h3 text-uppercase mb-4 pb-xl-2 mb-xl-4">Related <strong>Products</strong></h2>

        <div id="related_products" class="position-relative">
            <div class="swiper-container js-swiper-slider"
                data-settings='{
                "autoplay": false,
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "effect": "none",
                "loop": true,
                "pagination": {
                  "el": "#related_products .products-pagination",
                  "type": "bullets",
                  "clickable": true
                },
                "navigation": {
                  "nextEl": "#related_products .products-carousel__next",
                  "prevEl": "#related_products .products-carousel__prev"
                },
                "breakpoints": {
                  "320": {
                    "slidesPerView": 2,
                    "slidesPerGroup": 2,
                    "spaceBetween": 14
                  },
                  "768": {
                    "slidesPerView": 3,
                    "slidesPerGroup": 3,
                    "spaceBetween": 24
                  },
                  "992": {
                    "slidesPerView": 4,
                    "slidesPerGroup": 4,
                    "spaceBetween": 30
                  }
                }
              }'>

                <div class="swiper-wrapper">
                    @foreach ($rproducts as $product)
                        <div class="swiper-slide product-card">
                            <div class="col mb-4 d-flex justify-content-center">
                                <div class="card">
                                    <div class="card-img">
                                        <div class="img">
                                            <img src="{{ asset('storage/') }}/{{ $product->product_img }}"
                                                alt="{{ $product->product_name }}" class="img-fluid"
                                                style="border-radius: 5px; width: 100%; height: auto;">
                                        </div>
                                    </div>
                                    <div class="card-title">{{ $product->product_name }}</div>
                                    <div class="card-description">{{ $product->description }}</div>
                                    <hr class="card-divider">
                                    <div class="card-footer">
                                        <div class="card-price">
                                            @if ($product->discounted_price)
                                                <span
                                                    class="">{{ number_format($product->discounted_price, 0, ',', '.') }}
                                                    <sup>đ</sup></span>
                                            @else
                                                <span>{{ number_format($product->regular_price, 0, ',', '.') }}
                                                    <sup>đ</sup></span>
                                            @endif

                                        </div>
                                        <!-- Add to Cart Button -->
                                        <button class="card-btn">
                                            <a href="{{ route('Customer.Details', ['product_slug' => $product->slug]) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                                </svg>
                                            </a>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!-- /.swiper-wrapper -->
            </div><!-- /.swiper-container js-swiper-slider -->

            <div class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                </svg>
            </div><!-- /.products-carousel__prev -->

            <div class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                </svg>
            </div><!-- /.products-carousel__next -->

            <div class="products-pagination mt-4 mb-5 d-flex align-items-center justify-content-center"></div>
            <!-- /.products-pagination -->
        </div>



    </section> --}}
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const swiper = new Swiper('.js-swiper-slider', {
            slidesPerView: 4,
            spaceBetween: 20,
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".products-carousel__next",
                prevEl: ".products-carousel__prev",
            },
            pagination: {
                el: ".products-pagination",
                type: "bullets",
                clickable: true,
            },
            breakpoints: {
                320: {
                    slidesPerView: 2,

                },
                768: {
                    slidesPerView: 3,

                },
                992: {
                    slidesPerView: 4,

                },
            },
        });


    });
</script>
