    @extends('customer.dashboard')
    <link href="{{ asset('admin_asset/css/cart.css') }}" rel="stylesheet">
    <style>
        .card {
            --font-color: #ffffff;
            --font-color-sub: #dddddd;
            --bg-color: #fcfcfe;
            --main-color: #226fff;
            --main-focus: #1582ef;
            max-width: 330px;
            width: 100%;
            max-height: 380px;
            background: var(--bg-color);
            border: 2px solid var(--main-color);
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            padding: 16px;
            gap: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease, filter 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            filter: brightness(1.05);
        }

        .card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            filter: brightness(1.2);
            border-color: var(--main-focus);
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

        /* Giao diện của sidebar */

        .sidebar-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
            color: #333;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.388);
        }

        /* Các card lọc */
        .filter-card {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 12px;
            background-color: #fafafa;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.53);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .filter-card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.452);

        }

        /* Header của các card lọc */
        .filter-header {
            padding: 12px 20px;
            font-size: 18px;
            font-weight: bold;
            background-color: #f1f1f1;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            transition: background-color 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .filter-header:hover {
            background-color: #e0e0e0;
        }


        /* Biểu tượng toggle */
        .toggle-icon {
            font-size: 20px;
            font-weight: bold;
            color: #555;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .filter-header:hover .toggle-icon {
            color: #333;
            transform: rotate(180deg);
        }

        /* Nội dung của các filter */
        .filter-content {
            padding: 15px;
            display: none;
            animation: fadeIn 0.3s ease;
        }

        /* Danh sách thương hiệu */
        .brand-list {
            max-height: 150px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 6px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .category-list {
            max-height: 150px;
            overflow-y: auto;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 6px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Checkbox */
        .form-check {
            margin-bottom: 12px;
            transition: background-color 0.3s ease;
        }

        .form-check:hover {
            background-color: #f9f9f9;
            border-radius: 6px;
        }

        /* Range Slider */
        #priceValue {
            font-weight: bold;
            margin-top: 10px;
            display: block;
            text-align: center;
            color: #333;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
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

        /* Cải thiện giao diện cho Range Slider */
        input[type="range"] {
            width: 100%;
            -webkit-appearance: none;
            appearance: none;
            height: 8px;
            background: linear-gradient(to right, #00bfff 0%, #00bfff 0%, #ddd 0%, #ddd 100%);
            border-radius: 5px;
            outline: none;
            transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
        }

        input[type="range"]:focus {
            background: linear-gradient(to right, #00bfff 0%, #00bfff 100%, #ddd 100%);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.25);
            transform: scale(1.05);
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #00d4ff;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
        }

        input[type="range"]:active::-webkit-slider-thumb {
            background: #00a3cc;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.3);
            transform: scale(1.1);
        }

        input[type="range"]::-moz-range-thumb {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            background: #00d4ff;
            cursor: pointer;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            transition: background 0.3s ease, box-shadow 0.3s ease, transform 0.2s ease;
        }

        input[type="range"]:active::-moz-range-thumb {
            background: #00a3cc;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.3);
            transform: scale(1.1);
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
                <form id="advancedSearchForm" method="POST" action="{{ route('Customer.Filter') }}">
                    @csrf
                    @method('POST')
                    <!-- Danh mục -->
                    <div class="filter-card">
                        <div class="filter-header" onclick="toggleFilter('categoryFilter')">
                            <h4>Danh mục</h4>
                            <span class="toggle-icon">+</span>
                        </div>
                        <div class="filter-content" id="categoryFilter">
                            <div class="category-list">
                                @foreach ($categories as $category)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input category-checkbox"
                                            id="category_{{ $category->id }}" name="category[]" value="{{ $category->id }}"
                                            {{ in_array($category->id, request('category', [])) ? 'checked' : '' }}
                                            onchange="filterProducts()">
                                        <label class="form-check-label" for="category_{{ $category->id }}">
                                            {{ $category->category_name }}
                                        </label>
                                        <span class="text-right float-end">{{ $category->products->count() }}</span>
                                    </div>
                                @endforeach
                            </div>
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
                                            id="brand_{{ $brand->id }}" name="brand[]" value="{{ $brand->id }}"
                                            {{ in_array($brand->id, request('brand', [])) ? 'checked' : '' }}
                                            onchange="filterProducts()">
                                        <label class="form-check-label" for="brand_{{ $brand->id }}">
                                            {{ $brand->brand_name }}
                                        </label>
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
                                step="50" class="form-range" value="{{ request('price', 0) }}"
                                oninput="updatePriceValue()">
                            <span id="priceValue">{{ request('price', 0) }} VND</span>
                        </div>
                    </div>

                </form>
            </div>

            <div id="searchResults">
                <div class="products-grid  row row-cols-2 row-cols-md-3" id="searchResults">
                    @foreach ($products as $product)
                        <div class="col mb-4 d-flex justify-content-center">
                            <div class="card ">
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
                    {{ $products->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </section>
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

        function filterProducts() {
            let selectedBrands = [];
            document.querySelectorAll('.brand-checkbox:checked').forEach((checkbox) => {
                selectedBrands.push(checkbox.value);
            });

            let selectedCategories = [];
            document.querySelectorAll('.category-checkbox:checked').forEach((checkbox) => {
                selectedCategories.push(checkbox.value);
            });

            let selectedPrice = document.getElementById('priceRange').value;

            // Hiển thị loader
            const searchResults = document.getElementById('searchResults');
            searchResults.innerHTML = '<div>Loading...</div>';

            $.ajax({
                type: 'POST',
                url: '{{ route('Customer.Filter') }}',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    brand: selectedBrands,
                    category: selectedCategories,
                    price: selectedPrice,
                },
                success: function(data) {
                    $('#searchResults').html(data);
                },
                error: function(xhr) {
                    console.error('Error:', xhr.responseText);
                }
            });

        }
    </script>
