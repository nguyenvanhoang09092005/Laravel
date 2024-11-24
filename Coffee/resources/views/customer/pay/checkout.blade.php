@extends('customer.dashboard')

@section('customer_content')
    <section class="shop-checkout container">
        <h2 class="page-title">Shipping and Checkout</h2>
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
        <form action="{{ route('Customer.OrderComplete') }}" method="POST">
            @csrf
            <div class="checkout-form">
                <div class="billing-info__wrapper">
                    <h4>Thông tin giao hàng</h4>
                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="name" required>
                                <label for="name">Họ tên *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="phone" required>
                                <label for="phone">Số điện thoại *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="address" required>
                                <label for="address">Địa chỉ *</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="checkout__totals-wrapper">
                    <h3>Đơn hàng của bạn</h3>
                    <table class="checkout-cart-items">
                        <thead>
                            <tr>
                                <th>SẢN PHẨM</th>
                                <th align="right">TẠM TÍNH</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartItems as $item)
                                <tr>
                                    <td>{{ $item->product->name }} x {{ $item->quantity }}</td>
                                    <td align="right">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="checkout-totals">
                        <tbody>
                            <tr>
                                <th>THÀNH TIỀN</th>
                                <td align="right">{{ number_format($totalPrice, 0, ',', '.') }} đ</td>
                            </tr>
                            <tr>
                                <th>SHIPPING</th>
                                <td align="right">Miễn phí</td>
                            </tr>
                            <tr>
                                <th>TỔNG</th>
                                <td align="right">{{ number_format($totalPrice, 0, ',', '.') }} đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button class="btn btn-primary btn-checkout" type="submit">Đặt hàng</button>
            </div>
        </form>
    </section>
@endsection
