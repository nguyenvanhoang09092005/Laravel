<div id="searchResults">
    <div class="products-grid  row row-cols-2 row-cols-md-3" id="searchResults">
        @foreach ($products as $product)
            <div class="col  mb-4 d-flex justify-content-center">
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
        {{-- {{ $products->appends(request()->except('page'))->links('pagination::bootstrap-5') }} --}}
    </div>
</div>
