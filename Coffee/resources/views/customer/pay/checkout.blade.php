@extends('customer.dashboard')

@section('customer_content')
    <style>
        .inputGroup {
            position: relative;
            margin: 10px 0;
        }

        .inputGroup input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            background-color: white;
            transition: border 0.3s ease-in-out, box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(240, 248, 255, 0.9);
        }

        .inputGroup input:focus {
            border: 1px solid #028af9;
            box-shadow: 0 4px 8px rgba(3, 146, 248, 0.3);
            transform: scale(1.03);
            background-color: rgba(240, 248, 255, 0.9);
        }

        .inputGroup label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #888;
            font-size: 14px;
            pointer-events: none;
            transition: 0.2s all ease-in-out;

        }

        .inputGroup input:focus~label,
        .inputGroup input:valid~label {
            top: 0;
            font-size: 12px;
            color: #0048ff;
            background-color: white;
            padding: 0 5px;
            left: 5px;
            box-shadow: 0 2px 4px rgba(104, 152, 236, 0.385);
            background-color: white;
        }

        .inputGroup input:hover {
            border-color: #00a2ff;
            box-shadow: 0 4px 10px rgba(3, 146, 248, 0.2);
            transform: scale(1.01);
        }
    </style>
    <section class="shop-checkout container">
        <div class="section-title" data-aos="fade-up">
            <h2>Vận chuyển và thanh toán</h2>
        </div>
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
        <form name="checkout-form" action="{{ route('Customer.Checkout.store') }}" method="POST" id="checkout-form">
            @csrf
            <div class="checkout-form">
                <div class="billing-info__wrapper">
                    <div class="row">
                        <div class="col-6">
                            <h4>CHI TIẾT VẬN CHUYỂN</h4>
                        </div>
                        <div class="col-6">
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-md-6">
                            <div class="inputGroup">
                                <input type="text" name="name" required="" autocomplete="off">
                                <label for="name">Họ tên *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inputGroup">
                                <input type="text" name="phone" required="">
                                <label for="phone">Số điện thoại *</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="inputGroup">
                                <input type="text" name="zip" required="">
                                <label for="zip">Mã bưu chính *</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="inputGroup">
                                <input type="text" name="state" required="">
                                <label for="state">Tỉnh/Thành phố *</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="inputGroup">
                                <input type="text" name="city" required="">
                                <label for="city">Quận/Huyện *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inputGroup">
                                <input type="text" name="address" required="">
                                <label for="address">Số nhà, Tên tòa nhà *</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="inputGroup">
                                <input type="text" name="locality" required="">
                                <label for="locality">Tên đường, Khu vực, Khu phố *</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="inputGroup">
                                <input type="text" name="landmark" required="">
                                <label for="landmark">Điểm mốc *</label>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="checkout__totals-wrapper">
                    <div class="sticky-content">
                        <div class="checkout__totals">
                            <h3>Đơn hàng của bạn</h3>
                            <table class="checkout-cart-items">
                                <thead>
                                    <tr>
                                        <th>SẢN PHẨM</th>
                                        <th>TẠM TÍNH</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartItems as $item)
                                        <tr>
                                            <td>{{ $item->name }} x {{ $item->quantity }}</td>
                                            <td>{{ number_format($item->price * $item->quantity, 0, 0) }} đ</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <table class="checkout-totals">
                                <tbody>
                                    <tr>
                                        <th>TẠM TÍNH</th>
                                        <td id="total-price">{{ number_format($totalPrice + $totalDiscount, 0, ',', '.') }}
                                            <sup>đ</sup>
                                        </td>
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
                                        <td>{{ number_format($totalPrice, 0, ',', '.') }} <sup>đ</sup></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="checkout__payment-methods">
                            <h3>Phương thức thanh toán</h3>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method"
                                    id="payment_method_bank" value="bank_transfer" checked>
                                <label class="form-check-label" for="payment_method_bank">
                                    Chuyển khoản ngân hàng trực tiếp
                                    <p class="option-detail">
                                        Chuyển khoản trực tiếp vào tài khoản ngân hàng của chúng tôi. Vui lòng sử dụng ID
                                        đơn hàng của bạn làm tham chiếu thanh toán.
                                    </p>
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="payment_method_cod"
                                    value="cod">
                                <label class="form-check-label" for="payment_method_cod">
                                    Thanh toán khi nhận hàng (COD)
                                    <p class="option-detail">
                                        Bạn sẽ thanh toán khi nhận được hàng.
                                    </p>
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method"
                                    id="payment_method_momo" value="momo">
                                <label class="form-check-label" for="payment_method_momo">
                                    Thanh toán qua MoMo
                                    <p class="option-detail">
                                        Thanh toán nhanh qua ví điện tử MoMo.
                                    </p>
                                </label>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method"
                                    id="payment_method_zalopay" value="zalopay">
                                <label class="form-check-label" for="payment_method_zalopay">
                                    Thanh toán qua ZaloPay
                                    <p class="option-detail">
                                        Thanh toán tiện lợi với ZaloPay.
                                    </p>
                                </label>
                            </div>

                            <div class="policy-text mt-3">
                                Dữ liệu cá nhân của bạn sẽ được sử dụng để xử lý đơn hàng, hỗ trợ trải nghiệm của bạn trên
                                trang web và các mục đích khác như được mô tả trong
                                <a href="/terms" target="_blank">chính sách bảo mật</a>.
                            </div>
                        </div>

                        {{-- <div class="mobile_fixed-btn_wrapper">
                            <div class="button-wrapper container">
                                <a href="{{ Route('Customer.Confirmation') }}" class="btn btn-primary btn-checkout">TIẾN
                                    HÀNH
                                    THANH TOÁN</a>
                            </div>
                        </div> --}}

                        <button type="submit" class="btn btn-lg btn-primary mt-4">Đặt hàng</button>


                    </div>
                </div>

            </div>
        </form>
    </section>
@endsection
