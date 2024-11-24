@extends('customer.dashboard')

@section('customer_content')
    <section class="shop-checkout container">
        <h2 class="page-title">Vận chuyển và Thanh toán</h2>
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
        <form name="checkout-form" action="https://uomo-html.flexkitux.com/Demo3/shop_order_complete.html">
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
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="name" required="">
                                <label for="name">Họ và tên *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="phone" required="">
                                <label for="phone">Số điện thoại *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="zip" required="">
                                <label for="zip">Mã bưu chính *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating mt-3 mb-3">
                                <input type="text" class="form-control" name="state" required="">
                                <label for="state">Tỉnh/Thành phố *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="city" required="">
                                <label for="city">Quận/Huyện *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="address" required="">
                                <label for="address">Số nhà, Tên tòa nhà *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="locality" required="">
                                <label for="locality">Tên đường, Khu vực, Khu phố *</label>
                                <span class="text-danger"></span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-floating my-3">
                                <input type="text" class="form-control" name="landmark" required="">
                                <label for="landmark">Điểm mốc *</label>
                                <span class="text-danger"></span>
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
                                    <tr>
                                        <td>
                                            Váy Zessi x 2
                                        </td>
                                        <td>
                                            $32.50
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Áo phông Kirby
                                        </td>
                                        <td>
                                            $29.90
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="checkout-totals">
                                <tbody>
                                    <tr>
                                        <th>TẠM TÍNH</th>
                                        <td>$62.40</td>
                                    </tr>
                                    <tr>
                                        <th>VẬN CHUYỂN</th>
                                        <td>Miễn phí vận chuyển</td>
                                    </tr>
                                    <tr>
                                        <th>VAT</th>
                                        <td>$19</td>
                                    </tr>
                                    <tr>
                                        <th>TỔNG CỘNG</th>
                                        <td>$81.40</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="checkout__payment-methods">
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_1" checked>
                                <label class="form-check-label" for="checkout_payment_method_1">
                                    Chuyển khoản ngân hàng trực tiếp
                                    <p class="option-detail">
                                        Chuyển khoản trực tiếp vào tài khoản ngân hàng của chúng tôi. Vui lòng sử dụng ID
                                        đơn hàng của bạn làm tham chiếu thanh toán. Đơn hàng của bạn sẽ không được vận
                                        chuyển cho đến khi tiền đã được xác nhận trong tài khoản của chúng tôi.
                                    </p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_2">
                                <label class="form-check-label" for="checkout_payment_method_2">
                                    Thanh toán bằng séc
                                    <p class="option-detail">
                                        Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec
                                        dui. Aenean
                                        aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc,
                                        ut aliquet
                                        magna posuere eget.
                                    </p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_3">
                                <label class="form-check-label" for="checkout_payment_method_3">
                                    Thanh toán khi nhận hàng
                                    <p class="option-detail">
                                        Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec
                                        dui. Aenean
                                        aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc,
                                        ut aliquet
                                        magna posuere eget.
                                    </p>
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input_fill" type="radio"
                                    name="checkout_payment_method" id="checkout_payment_method_4">
                                <label class="form-check-label" for="checkout_payment_method_4">
                                    Paypal
                                    <p class="option-detail">
                                        Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec
                                        dui. Aenean
                                        aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc,
                                        ut aliquet
                                        magna posuere eget.
                                    </p>
                                </label>
                            </div>
                            <div class="policy-text">
                                Dữ liệu cá nhân của bạn sẽ được sử dụng để xử lý đơn hàng của bạn, hỗ trợ trải nghiệm của
                                bạn trên toàn bộ trang web này, và cho các mục đích khác như được mô tả trong <a
                                    href="terms.html" target="_blank">chính sách bảo mật</a>.
                            </div>
                        </div>
                        <button class="btn btn-primary btn-checkout">ĐẶT HÀNG</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
