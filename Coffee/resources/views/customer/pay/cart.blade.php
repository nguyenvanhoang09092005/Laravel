@extends('customer.dashboard')

@section('customer_content')
    <section class="shop-checkout container my-5">
        <div class="section-title" data-aos="fade-up">
            <h2>Giỏ hàng</h2>
            <h3>Đơn hàng của bạn</h3>
        </div>

        <!-- Các bước thanh toán -->
        <div class="checkout-steps d-flex justify-content-between my-4" data-aos="fade-right" data-aos-delay="100">
            <a href="{{ route('Customer.Cart.View') }}" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                    <span>Giỏ hàng</span>
                    <em>Quản lý danh sách sản phẩm của bạn</em>
                </span>
            </a>
            <a href="{{ route('Customer.Checkout') }}" class="checkout-steps__item">
                <span class="checkout-steps__item-number">02</span>
                <span class="checkout-steps__item-title">
                    <span>Vận chuyển và Thanh toán</span>
                    <em>Kiểm tra các sản phẩm</em>
                </span>
            </a>
            <a href="{{ route('Customer.Confirmation') }}" class="checkout-steps__item">
                <span class="checkout-steps__item-number">03</span>
                <span class="checkout-steps__item-title">
                    <span>Xác nhận</span>
                    <em>Xem lại và gửi đơn hàng</em>
                </span>
            </a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <!-- Bảng giỏ hàng -->
        <div class="shopping-cart">
            @if ($cartItems->count() > 0)
                <div class="cart-table__wrapper">
                    <table class="cart-table">
                        <thead>
                            <tr class="text-center">
                                <th colspan="2">Sản phẩm</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Tạm tính</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td>
                                        <div class="shopping-cart__product-item">
                                            <img loading="lazy" src="{{ asset('storage/' . $item->image) }}"
                                                alt="{{ $item->name }}" width="120" height="120" />
                                        </div>
                                    </td>
                                    <td>
                                        <div class="shopping-cart__product-item__detail">
                                            <h4>{{ $item->name }}</h4>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="shopping-cart__product-price">{{ number_format($item->price, 0, 0) }}
                                            <sup>đ</sup>
                                        </span>
                                    </td>
                                    <td>
                                        <form class="update-cart-form" method="POST"
                                            action="{{ route('Customer.Cart.Update', $item->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="qty-control position-relative">
                                                <div class="qty-control__reduce" data-action="decrease"
                                                    data-id="{{ $item->id }}">-</div>
                                                <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                    min="1" class="qty-control__number text-center"
                                                    data-id="{{ $item->id }}">
                                                <div class="qty-control__increase" data-action="increase"
                                                    data-id="{{ $item->id }}">+</div>
                                            </div>
                                        </form>
                                    </td>

                                    <td>
                                        <span class="shopping-cart__subtotal" id="subtotal-{{ $item->id }}">
                                            {{ number_format($item->price * $item->quantity, 0, 0) }} <sup>đ</sup>
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('Customer.Cart.Remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="remove-cart">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                                    <path
                                                        d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                                </svg>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="cart-table-footer">

                        <form action="{{ route('applyCoupon') }}" method="POST" class="position-relative bg-body">
                            @csrf
                            <input class="form-control" type="text" name="coupon_code" placeholder="Nhập mã giảm giá">
                            <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                                value="ÁP DỤNG MÃ">
                        </form>

                        <button class="btn btn-light">CẬP NHẬT GIỎ HÀNG</button>
                    </div>
                </div>
                <div class="shopping-cart__totals-wrapper">
                    <div class="sticky-content">
                        <div class="shopping-cart__totals">
                            <h3>Tổng giỏ hàng</h3>
                            <table class="cart-totals">
                                <tbody>
                                    <tr>
                                        <th>Tạm tính</th>
                                        <td id="total-price">{{ number_format($totalPrice + $totalDiscount, 0, ',', ',') }}
                                            <sup>đ</sup>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Phí vận chuyển</th>
                                        <td>
                                            <div class="form-check">

                                                <label class="form-check-label" for="free_shipping">Miễn phí vận
                                                    chuyển</label>
                                            </div>

                                        </td>
                                    </tr>
                                    <tr>
                                        <th>MÃ GIẢM GIÁ</th>
                                        <td>{{ number_format($totalDiscount, 0, ',', ',') }} <sup>đ</sup></td>
                                    </tr>
                                    <tr>
                                        <th>Tổng cộng</th>
                                        <td>{{ number_format($totalPrice, 0, ',', ',') }} <sup>đ</sup></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mobile_fixed-btn_wrapper">
                            <div class="button-wrapper container">
                                <a href="{{ Route('Customer.Checkout') }}" class="btn btn-primary btn-checkout">TIẾN HÀNH
                                    THANH TOÁN</a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <p>Giỏ hàng trống. <a href="{{ route('Customer.Shop') }}">Tiếp tục mua sắm</a></p>
            @endif
        </div>
    </section>
@endsection

{{-- <script>
    $(document).ready(function() {
        $('.qty-control__reduce, .qty-control__increase').on('click', function() {
            let action = $(this).data('action'); // Action type (increase/decrease)
            let input = $(this).siblings('.qty-control__number'); // The quantity input field
            let quantity = parseInt(input.val()); // Get the current quantity
            let productId = input.data('id'); // Product ID
            let token = $('meta[name="csrf-token"]').attr('content'); // CSRF token

            // Increase or decrease the quantity
            if (action === 'increase') {
                quantity++;
            } else if (action === 'decrease' && quantity > 1) {
                quantity--;
            }
            input.val(quantity); // Update the quantity input field

            // Send AJAX request to update the quantity in the cart
            $.ajax({
                url: `/customer/cart/update/${productId}`,
                type: 'PUT',
                data: {
                    _token: token,
                    quantity: quantity
                },
                success: function(response) {
                    // Update subtotal for the individual product
                    $(`#subtotal-${productId}`).html(`${response.subtotal} <sup>đ</sup>`);

                    // Update the total price in the cart summary
                    $('#total-price').html(`${response.totalPrice} <sup>đ</sup>`);

                    // If there is a discount, update the discount amount as well
                    $('#total-discount').html(`${response.totalDiscount} <sup>đ</sup>`);
                },
                error: function(xhr) {
                    console.error('Error updating the cart:', xhr.responseText);
                }
            });
        });
    });
</script> --}}
