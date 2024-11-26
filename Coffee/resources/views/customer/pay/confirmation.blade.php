@extends('customer.dashboard')

@section('customer_content')
    <section class="shop-checkout container">
        <h2 class="page-title">Đơn hàng đã được nhận</h2>
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

        <div class="order-complete">
            <div class="order-complete__message">
                <svg width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="40" cy="40" r="40" fill="#B9A16B" />
                    <path
                        d="M52.9743 35.7612C52.9743 35.3426 52.8069 34.9241 52.5056 34.6228L50.2288 32.346C49.9275 32.0446 49.5089 31.8772 49.0904 31.8772C48.6719 31.8772 48.2533 32.0446 47.952 32.346L36.9699 43.3449L32.048 38.4062C31.7467 38.1049 31.3281 37.9375 30.9096 37.9375C30.4911 37.9375 30.0725 38.1049 29.7712 38.4062L27.4944 40.683C27.1931 40.9844 27.0257 41.4029 27.0257 41.8214C27.0257 42.24 27.1931 42.6585 27.4944 42.9598L33.5547 49.0201L35.8315 51.2969C36.1328 51.5982 36.5513 51.7656 36.9699 51.7656C37.3884 51.7656 37.8069 51.5982 38.1083 51.2969L40.385 49.0201L52.5056 36.8996C52.8069 36.5982 52.9743 36.1797 52.9743 35.7612Z"
                        fill="white" />
                </svg>
                <h3>Đơn hàng của bạn đã được hoàn tất!</h3>
                <p>Cảm ơn bạn. Đơn hàng của bạn đã được nhận.</p>
            </div>

            <div class="order-info">
                <div class="order-info__item">
                    <label>Mã đơn hàng</label>
                    <span>{{ $order->order_code ?? 'Không có mã đơn hàng' }}</span>
                </div>
                <div class="order-info__item">
                    <label>Ngày</label>
                    <span>{{ $order->created_at->format('d/m/Y') ?? 'Không có ngày' }}</span>
                </div>
                <div class="order-info__item">
                    <label>Tổng tiền</label>
                    <span>{{ number_format($order->total_price, 2) ?? 'Không có tổng tiền' }}</span>
                </div>
                <div class="order-info__item">
                    <label>Phương thức thanh toán</label>
                    <span>{{ $order->payment_method ?? 'Chuyển khoản ngân hàng' }}</span>
                </div>
            </div>

            <div class="checkout__totals-wrapper">
                <div class="checkout__totals">
                    <h3>Chi tiết đơn hàng</h3>
                    <table class="checkout-cart-items">
                        <thead>
                            <tr>
                                <th>SẢN PHẨM</th>
                                <th>TỔNG</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderItems as $item)
                                <tr>
                                    <td>{{ $item->product ? $item->product->product_name : 'Không có tên sản phẩm' }} x
                                        {{ $item->quantity }}</td>
                                    <td>{{ number_format($item->price * $item->quantity, 0, ',', '.') }} đ</td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <table class="checkout-totals">
                        <tbody>
                            <tr>
                                <th>TỔNG CỘNG</th>
                                <td>{{ number_format($totalAfterDiscount, 0, ',', '.') }} <sup>đ</sup></td>-
                            </tr>
                            <tr>
                                <th>VẬN CHUYỂN</th>
                                <td>Miễn phí vận chuyển</td>
                            </tr>
                            <tr>
                                <th>MÃ GIẢM GIÁ</th>
                                <td>{{ number_format($totalDiscount, 0, ',', '.') }} <sup>đ</sup></td>
                            </tr>
                            <tr>
                                <th>TỔNG CỘNG</th>
                                <td>{{ number_format($order->total_price, 0, ',', '.') }} <sup>đ</sup></td>
                            </tr>
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
