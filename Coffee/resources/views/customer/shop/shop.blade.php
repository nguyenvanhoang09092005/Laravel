    @extends('customer.dashboard')
    <link href="{{ asset('admin_asset/css/cart.css') }}" rel="stylesheet">
    <style>
        .card {
            --font-color: #0967d2;
            --font-color-sub: #000000;
            --bg-color: #fff;
            --main-color: #0894ff;
            --main-focus: #2d8cf0;
            max-width: 330px;
            width: 100%;
            max-height: 380px;
            background: var(--bg-color);
            border: 2px solid var(--main-color);
            border-radius: 12px;
            /* Tăng độ bo tròn cho góc */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding: 16px;
            gap: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease, filter 0.3s ease;
            /* Thêm transition cho hiệu ứng mượt mà */
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            /* Đặt bóng mờ nhẹ cho card */
            filter: brightness(1.05);
            /* Làm sáng nhẹ */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
            /* Bóng đổ sâu hơn khi hover */
            filter: brightness(1.1) saturate(1.1);
            /* Tăng độ sáng và bão hòa màu khi hover */
        }

        .card-img {
            width: 100%;
            text-align: center;
            margin-bottom: 0px;
            overflow: hidden;
            border-radius: 8px;
            /* Tăng độ bo góc cho ảnh */
            padding: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            /* Thêm bóng cho ảnh */
        }

        .card-img .img {
            width: 100%;
            max-width: 100%;
            max-height: 150px;
            height: auto;
            border-radius: 5px;
            object-fit: cover;
            /* Đảm bảo ảnh luôn bao phủ khu vực */
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--font-color);
            text-align: center;
            margin-top: -1em;
            line-height: 1.2;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
            /* Thêm bóng chữ nhẹ */
        }

        .card-description {
            font-size: 14px;
            font-weight: 400;
            color: var(--font-color-sub);
            text-align: center;
            margin-bottom: 0;
            padding: 0 8px;
            line-height: 1.5;
        }

        .card-divider {
            width: 100%;
            border: 1px solid var(--main-color);
            margin: 8px 0;
            opacity: 0.2;
            /* Làm mờ đường chia */
        }

        .card-footer {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 8px;
        }

        .card-price {
            font-size: 18px;
            font-weight: 700;
            color: var(--font-color);
        }

        .card-btn {
            height: 35px;
            background: var(--bg-color);
            border: 2px solid var(--main-color);
            border-radius: 5px;
            padding: 6px 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Thêm bóng cho nút */
        }

        .card-btn:hover {
            background: var(--main-focus);
            color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
            /* Bóng mờ khi hover */
        }

        .card-btn svg {
            width: 18px;
            height: 18px;
            fill: var(--main-color);
            transition: fill 0.3s ease;
            /* Thêm hiệu ứng chuyển màu cho icon */
        }

        .card-btn:hover svg {
            fill: #fff;
        }


        /* From Uiverse.io by amikambs */
        .rating:not(:checked)>input {
            position: absolute;
            appearance: none;
        }

        .rating:not(:checked)>label {
            float: right;
            cursor: pointer;
            font-size: 30px;
            fill: #666;
        }

        .rating:not(:checked)>label>svg {
            fill: #666;
            /* Set default color for SVG */
            transition: fill 0.3s ease;
            /* Add a transition effect */
        }

        .rating>input:checked+label:hover,
        .rating>input:checked+label:hover~label,
        .rating>input:checked~label:hover,
        .rating>input:checked~label:hover~label,
        .rating>label:hover~input:checked~label {
            fill: #e58e09;
        }

        .rating:not(:checked)>label:hover,
        .rating:not(:checked)>label:hover~label {
            fill: #ff9e0b;
        }

        .rating>input:checked~label>svg {
            fill: #ffa723;
            /* Set color for selected stars */
        }

        /* Container Styles */
        .shop-sidebar {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
        }

        .sidebar-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Filter Card Styles */
        .filter-card {
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .filter-header {
            padding: 10px 15px;
            font-size: 16px;
            font-weight: bold;
            background-color: #f1f1f1;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .filter-header:hover {
            background-color: #e6e6e6;
        }

        .toggle-icon {
            font-size: 18px;
            font-weight: bold;
            color: #555;
            transition: transform 0.3s ease;
        }

        .filter-content {
            padding: 15px;
            display: none;
            animation: fadeIn 0.3s ease;
        }

        .brand-list {
            max-height: 150px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
            background: #fff;
        }

        .form-check {
            margin-bottom: 10px;
        }

        /* Range Slider */
        #priceValue {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            text-align: center;
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
    @section('customer_content')
        <div class="section-title" data-aos="fade-up">
            <h2>Menu</h2>
            <h3>Nơi mà bạn thỏa sức lựa chọn</h3>
        </div>
        <section class="shop-main container d-flex pt-4 pt-xl-5">
            <div class="shop-sidebar side-sticky bg-body" id="shopFilter">
                <h3 class="sidebar-title">Tìm kiếm nâng cao</h3>
                <form id="advancedSearchForm" method="GET" action="{{ route('Customer.Shop') }}">
                    <!-- Danh mục -->
                    <div class="filter-card">
                        <div class="filter-header" onclick="toggleFilter('categoryFilter')">
                            <h4>Danh mục</h4>
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="filter-content" id="categoryFilter">
                            <select id="category" name="category" class="form-control">
                                <option value="">Chọn danh mục</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Thương hiệu -->
                    <div class="filter-card">
                        <div class="filter-header" onclick="toggleFilter('brandFilter')">
                            <h4>Thương hiệu</h4>
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="filter-content" id="brandFilter">
                            <div class="brand-list">
                                @foreach ($brands as $brand)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input brand-checkbox"
                                            id="brand_{{ $brand->id }}" name="brand[]" value="{{ $brand->id }}">

                                        <label class="form-check-label"
                                            for="brand_{{ $brand->id }}">{{ $brand->brand_name }}</label>
                                        <span class="text-right float-end">{{ $brand->products->count() }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- Giá -->
                    <div class="filter-card">
                        <div class="filter-header" onclick="toggleFilter('priceFilter')">
                            <h4>Giá</h4>
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="filter-content" id="priceFilter">
                            <input type="range" id="priceRange" name="price" min="0" max="1000"
                                step="50" class="form-range">
                            <span id="priceValue">0 VND</span>
                        </div>
                    </div>

                </form>

            </div>

            <div id="searchResults">
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
                                            </svg></a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>



            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
            </div>
        </section>

        <div id="frmfilter" method="GET" action="{{ route('Customer.Shop') }}">
            <input type="hidden" name="brands" id="hdnBrands">
        </div>
    @endsection
    <script>
        function toggleFilter(filterId) {
            const filterContent = document.getElementById(filterId);
            const toggleIcon = filterContent.previousElementSibling.querySelector('.toggle-icon');

            if (filterContent.style.display === 'block') {
                filterContent.style.display = 'none';
                toggleIcon.textContent = '+';
            } else {
                filterContent.style.display = 'block';
                toggleIcon.textContent = '−';
            }
        }
    </script>
