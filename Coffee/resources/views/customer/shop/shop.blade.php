@extends('customer.dashboard')
<style>
    .card {
        --font-color: #323232;
        --font-color-sub: #666;
        --bg-color: #fff;
        --main-color: #323232;
        --main-focus: #2d8cf0;
        max-width: 330px;
        width: auto;
        max-height: 380px;
        height: auto;
        background: var(--bg-color);
        border: 5px solid var(--main-color);
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        padding: 10px;
        gap: 8px;
    }

    .card-img {
        width: 100%;
        text-align: center;
        margin-bottom: 0px;
        overflow: hidden;
    }

    .card-img .img {
        max-width: 100%;
        max-height: 150px;
        height: auto;
        border-radius: 5px;
    }

    .card-title {
        font-size: 16px;
        font-weight: 600;
        color: var(--font-color);
        text-align: center;
        margin-top: -2em
    }

    .card-description {
        font-size: 14px;
        font-weight: 400;
        color: var(--font-color-sub);
        text-align: center;
    }

    .card-divider {
        width: 100%;
        border: 1px solid var(--main-color);
        margin: 8px 0;
    }

    .card-footer {
        width: 100%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-price {
        font-size: 16px;
        font-weight: 600;
        color: var(--font-color);
    }

    .card-btn {
        height: 30px;
        background: var(--bg-color);
        border: 1px solid var(--main-color);
        border-radius: 5px;
        padding: 4px 10px;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 12px;
    }

    .card-btn:hover {
        background: var(--main-focus);
        color: #fff;
    }

    .card-btn svg {
        width: 16px;
        height: 16px;
        fill: var(--main-color);
    }

    .card-btn:hover svg {
        fill: #fff;
    }
</style>
@section('customer_content')
    <section class="shop-main container d-flex pt-4 pt-xl-5" style="margin-top: 25px">
        <div class="shop-sidebar side-sticky bg-body" id="shopFilter">
            <div class="aside-header d-flex d-lg-none align-items-center">
                <h3 class="text-uppercase fs-6 mb-0">Filter By</h3>
                <button class="btn-close-lg js-close-aside btn-close-aside ms-auto"></button>
            </div>

            <div class="pt-4 pt-lg-0"></div>

            <div class="accordion" id="categories-list">
                <div class="accordion-item mb-4 pb-3">
                    <h5 class="accordion-header" id="accordion-heading-1">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-1" aria-expanded="true"
                            aria-controls="accordion-filter-1">
                            Product Categories
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-1" class="accordion-collapse collapse show border-0"
                        aria-labelledby="accordion-heading-1" data-bs-parent="#categories-list">
                        <div class="accordion-body px-0 pb-0 pt-3">
                            <ul class="list list-inline mb-0">
                                @foreach ($categories as $category)
                                    <li class="list-item">
                                        <a href="{{ url('category/' . $category->id) }}"
                                            class="menu-link py-1">{{ $category->category_name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                </div>
            </div>




            <div class="accordion" id="brand-filters">
                <div class="accordion-item mb-4 pb-3">
                    <h5 class="accordion-header" id="accordion-heading-brand">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-brand" aria-expanded="true"
                            aria-controls="accordion-filter-brand">
                            Brands
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-brand" class="accordion-collapse collapse show border-0"
                        aria-labelledby="accordion-heading-brand" data-bs-parent="#brand-filters">
                        <div class="search-field multi-select accordion-body px-0 pb-0">
                            <select class="d-none" multiple name="total-numbers-list">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                @endforeach
                            </select>


                            <ul class="multi-select__list list-unstyled">
                                @foreach ($brands as $brand)
                                    <li
                                        class="search-suggestion__item multi-select__item text-primary js-search-select js-multi-select">
                                        <span class="me-auto">{{ $brand->brand_name }}</span>
                                        <span class="text-secondary">{{ rand(1, 100) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>


            <div class="accordion" id="price-filters">
                <div class="accordion-item mb-4">
                    <h5 class="accordion-header mb-2" id="accordion-heading-price">
                        <button class="accordion-button p-0 border-0 fs-5 text-uppercase" type="button"
                            data-bs-toggle="collapse" data-bs-target="#accordion-filter-price" aria-expanded="true"
                            aria-controls="accordion-filter-price">
                            Price
                            <svg class="accordion-button__icon type2" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                <g aria-hidden="true" stroke="none" fill-rule="evenodd">
                                    <path
                                        d="M5.35668 0.159286C5.16235 -0.053094 4.83769 -0.0530941 4.64287 0.159286L0.147611 5.05963C-0.0492049 5.27473 -0.049205 5.62357 0.147611 5.83813C0.344427 6.05323 0.664108 6.05323 0.860924 5.83813L5 1.32706L9.13858 5.83867C9.33589 6.05378 9.65507 6.05378 9.85239 5.83867C10.0492 5.62357 10.0492 5.27473 9.85239 5.06018L5.35668 0.159286Z" />
                                </g>
                            </svg>
                        </button>
                    </h5>
                    <div id="accordion-filter-price" class="accordion-collapse collapse show border-0"
                        aria-labelledby="accordion-heading-price" data-bs-parent="#price-filters">
                        <input class="price-range-slider" type="text" name="price_range" value=""
                            data-slider-min="10" data-slider-max="1000" data-slider-step="5" data-slider-value="[250,450]"
                            data-currency="$" />
                        <div class="price-range__info d-flex align-items-center mt-2">
                            <div class="me-auto">
                                <span class="text-secondary">Min Price: </span>
                                <span class="price-range__min">$250</span>
                            </div>
                            <div>
                                <span class="text-secondary">Max Price: </span>
                                <span class="price-range__max">$450</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="d-flex justify-content-between mb-4 pb-md-2">


            <div class="shop-acs d-flex align-items-center justify-content-between justify-content-md-end flex-grow-1">
                <select class="shop-acs__select form-select w-auto border-0 py-0 order-1 order-md-0"
                    aria-label="Sort Items" name="total-number">
                    <option selected>Default Sorting</option>
                    <option value="1">Featured</option>
                    <option value="2">Best selling</option>
                    <option value="3">Alphabetically, A-Z</option>
                    <option value="3">Alphabetically, Z-A</option>
                    <option value="3">Price, low to high</option>
                    <option value="3">Price, high to low</option>
                    <option value="3">Date, old to new</option>
                    <option value="3">Date, new to old</option>
                </select>

                <div class="shop-filter d-flex align-items-center order-0 order-md-3 d-lg-none">
                    <button class="btn-link btn-link_f d-flex align-items-center ps-0 js-open-aside"
                        data-aside="shopFilter">
                        <svg class="d-inline-block align-middle me-2" width="14" height="10" viewBox="0 0 14 10"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_filter" />
                        </svg>
                        <span class="text-uppercase fw-medium d-inline-block align-middle">Filter</span>
                    </button>
                </div>
            </div>
        </div> --}}



        <div class="products-grid row row-cols-2 row-cols-md-3" id="products-grid">
            @foreach ($products as $product)
                <div class="col mb-4 d-flex justify-content-center">
                    <div class="card">
                        <div class="card-img">
                            <div class="img">
                                <img src="{{ asset('storage/') }}/{{ $product->product_img }}"
                                    alt="{{ $product->product_name }}" class="img-fluid"
                                    style="border-radius: 5px; max-width: 100%;">
                            </div>
                        </div>

                        <div class="card-title">{{ $product->product_name }}</div>

                        <div class="card-description">{{ $product->description }}</div>
                        <hr class="card-divider">

                        <div class="card-footer">

                            <div class="card-price">
                                @if ($product->discounted_price)
                                    <span>{{ number_format($product->discounted_price, 0, ',', '.') }}
                                        <sup>đ</sup></span>
                                @else
                                    <span>{{ number_format($product->regular_price, 0, ',', '.') }} <sup>đ</sup></span>
                                @endif



                            </div>
                            <!-- Add to Cart Button -->
                            <button class="card-btn">
                                <a href="{{ route('Customer.Details', ['product_slug' => $product->slug]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
                                        <path
                                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                    </svg></a>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
        </div>
    </section>
@endsection
