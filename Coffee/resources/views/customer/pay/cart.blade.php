@extends('customer.dashboard')

@section('customer_content')
    <section class="shop-checkout container my-5">
        <h2 class="page-title text-center">Xe đẩy</h2>

        <!-- Checkout Steps -->
        <div class="checkout-steps d-flex justify-content-between my-4">
            <a href="{{ route('Customer.Cart.View') }}" class="checkout-steps__item active">
                <span class="checkout-steps__item-number">01</span>
                <span class="checkout-steps__item-title">
                    <span>Túi mua sắm</span>
                    <em>Quản lý danh sách mục của bạn</em>
                </span>
            </a>
            <a href="{{ route('Customer.Checkout') }}" class="checkout-steps__item">
                <span class="checkout-steps__item-number">02</span>
                <span class="checkout-steps__item-title">
                    <span>Vận chuyển và Thanh toán</span>
                    <em>Kiểm tra danh sách các mặt hàng của bạn</em>
                </span>
            </a>
            <a href="{{ route('Customer.Confirmation') }}" class="checkout-steps__item">
                <span class="checkout-steps__item-number">03</span>
                <span class="checkout-steps__item-title">
                    <span>Xác nhận</span>
                    <em>Xem lại và gửi đơn hàng của bạn</em>
                </span>
            </a>
        </div>

        <!-- Shopping Cart Table -->
        <div class="shopping-cart">
            @if ($cartItems->count() > 0)
                <div class="cart-table__wrapper">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th></th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
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
                                            <h4>{{ $item->name }} </h4>

                                        </div>
                                    </td>
                                    <td>
                                        <span class="shopping-cart__product-price">{{ number_format($item->price, 2) }}
                                            <sup>đ</sup>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="qty-control position-relative">
                                            <input type="number" name="quantity" value="{{ $item->quantity }}"
                                                min="1" class="qty-control__number text-center"
                                                data-id="{{ $item->id }}">
                                            <div class="qty-control__reduce">-</div>
                                            <div class="qty-control__increase">+</div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="shopping-cart__subtotal" id="subtotal-{{ $item->id }}">
                                            {{ number_format($item->price * $item->quantity, 2) }} <sup>đ</sup>
                                        </span>
                                    </td>
                                    <td>
                                        <form action="{{ route('Customer.Cart.Remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="remove-cart">
                                                <!-- Icon -->
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
                        <form action="#" class="position-relative bg-body">
                            <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code">
                            <input class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                                value="APPLY COUPON">
                        </form>
                        <button class="btn btn-light">UPDATE CART</button>
                    </div>
                </div>
                <div class="shopping-cart__totals-wrapper">
                    <div class="sticky-content">
                        <div class="shopping-cart__totals">
                            <h3>Cart Totals</h3>
                            <table class="cart-totals">
                                <tbody>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td>$1300</td>
                                    </tr>
                                    <tr>
                                        <th>Shipping</th>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input form-check-input_fill" type="checkbox"
                                                    value="" id="free_shipping">
                                                <label class="form-check-label" for="free_shipping">Free shipping</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input form-check-input_fill" type="checkbox"
                                                    value="" id="flat_rate">
                                                <label class="form-check-label" for="flat_rate">Flat rate: $49</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input form-check-input_fill" type="checkbox"
                                                    value="" id="local_pickup">
                                                <label class="form-check-label" for="local_pickup">Local pickup:
                                                    $8</label>
                                            </div>
                                            <div>Shipping to AL.</div>
                                            <div>
                                                <a href="#" class="menu-link menu-link_us-s">CHANGE ADDRESS</a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>VAT</th>
                                        <td>$19</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>$1319</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mobile_fixed-btn_wrapper">
                            <div class="button-wrapper container">
                                <a href="{{ Route('Customer.Checkout') }}" class="btn btn-primary btn-checkout">PROCEED TO
                                    CHECKOUT</a>
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
