@extends('customer.dashboard')

@section('customer_content')
    <section class="shop-checkout container my-5">
        <h2 class="page-title text-center">Xe đẩy</h2>

        <!-- Checkout Steps -->
        <div class="checkout-steps d-flex justify-content-between my-4">
            <a href="{{ route('Customer.Payment') }}" class="checkout-steps__item active">
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
            <div class="cart-table__wrapper">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Sản phẩm</font>
                                </font>
                            </th>
                            <th></th>
                            <th>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Giá</font>
                                </font>
                            </th>
                            <th>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Số lượng</font>
                                </font>
                            </th>
                            <th>
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">Tổng cộng</font>
                                </font>
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="shopping-cart__product-item">
                                    <img loading="lazy" src="assets/images/cart-item-1.jpg" width="120" height="120"
                                        alt="">
                                </div>
                            </td>
                            <td>
                                <div class="shopping-cart__product-item__detail">
                                    <h4>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Váy Zessi</font>
                                        </font>
                                    </h4>

                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__product-price">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">99 đô la</font>
                                    </font>
                                </span>
                            </td>
                            <td>
                                <div class="qty-control position-relative qty-initialized">
                                    <input type="number" name="quantity" value="3" min="1"
                                        class="qty-control__number text-center">
                                    <div class="qty-control__reduce">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">-</font>
                                        </font>
                                    </div>
                                    <div class="qty-control__increase">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">+</font>
                                        </font>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__subtotal">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">297 đô la</font>
                                    </font>
                                </span>
                            </td>
                            <td>
                                <a href="#" class="remove-cart">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z">
                                        </path>
                                        <path
                                            d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z">
                                        </path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="shopping-cart__product-item">
                                    <img loading="lazy" src="assets/images/cart-item-2.jpg" width="120" height="120"
                                        alt="">
                                </div>
                            </td>
                            <td>
                                <div class="shopping-cart__product-item__detail">
                                    <h4>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Áo phông Kirby</font>
                                        </font>
                                    </h4>

                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__product-price">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">99 đô la</font>
                                    </font>
                                </span>
                            </td>
                            <td>
                                <div class="qty-control position-relative qty-initialized">
                                    <input type="number" name="quantity" value="3" min="1"
                                        class="qty-control__number text-center">
                                    <div class="qty-control__reduce">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">-</font>
                                        </font>
                                    </div>
                                    <div class="qty-control__increase">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">+</font>
                                        </font>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__subtotal">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">297 đô la</font>
                                    </font>
                                </span>
                            </td>
                            <td>
                                <a href="#" class="remove-cart">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z">
                                        </path>
                                        <path
                                            d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z">
                                        </path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="shopping-cart__product-item">
                                    <img loading="lazy" src="assets/images/cart-item-3.jpg" width="120" height="120"
                                        alt="">
                                </div>
                            </td>
                            <td>
                                <div class="shopping-cart__product-item__detail">
                                    <h4>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Khăn choàng Cobleknit</font>
                                        </font>
                                    </h4>

                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__product-price">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">99 đô la</font>
                                    </font>
                                </span>
                            </td>
                            <td>
                                <div class="qty-control position-relative qty-initialized">
                                    <input type="number" name="quantity" value="3" min="1"
                                        class="qty-control__number text-center">
                                    <div class="qty-control__reduce">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">-</font>
                                        </font>
                                    </div>
                                    <div class="qty-control__increase">
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">+</font>
                                        </font>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="shopping-cart__subtotal">
                                    <font style="vertical-align: inherit;">
                                        <font style="vertical-align: inherit;">297 đô la</font>
                                    </font>
                                </span>
                            </td>
                            <td>
                                <a href="#" class="remove-cart">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z">
                                        </path>
                                        <path
                                            d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z">
                                        </path>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="cart-table-footer">
                    <form action="#" class="position-relative bg-body">
                        <input class="form-control" type="text" name="coupon_code" placeholder="Mã giảm giá">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;"><input
                                    class="btn-link fw-medium position-absolute top-0 end-0 h-100 px-4" type="submit"
                                    value="ÁP DỤNG COUPON"></font>
                        </font>
                    </form>
                    <button class="btn btn-light">
                        <font style="vertical-align: inherit;">
                            <font style="vertical-align: inherit;">CẬP NHẬT GIỎ HÀNG</font>
                        </font>
                    </button>
                </div>
            </div>


            <div class="shopping-cart__totals-wrapper">
                <div class="sticky-content">
                    <div class="shopping-cart__totals">
                        <h3>
                            <font style="vertical-align: inherit;">
                                <font style="vertical-align: inherit;">Tổng số giỏ hàng</font>
                            </font>
                        </h3>
                        <table class="cart-totals">
                            <tbody>
                                <tr>
                                    <th>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Tổng cộng</font>
                                        </font>
                                    </th>
                                    <td>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">1300 đô la</font>
                                        </font>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Vận chuyển</font>
                                        </font>
                                    </th>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input_fill" type="checkbox"
                                                value="" id="free_shipping">
                                            <label class="form-check-label" for="free_shipping">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Miễn phí vận chuyển</font>
                                                </font>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input_fill" type="checkbox"
                                                value="" id="flat_rate">
                                            <label class="form-check-label" for="flat_rate">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Giá cố định: $49</font>
                                                </font>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input form-check-input_fill" type="checkbox"
                                                value="" id="local_pickup">
                                            <label class="form-check-label" for="local_pickup">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">Nhận hàng tại địa phương: $8
                                                    </font>
                                                </font>
                                            </label>
                                        </div>
                                        <div>
                                            <font style="vertical-align: inherit;">
                                                <font style="vertical-align: inherit;">Vận chuyển đến AL.</font>
                                            </font>
                                        </div>
                                        <div>
                                            <a href="#" class="menu-link menu-link_us-s">
                                                <font style="vertical-align: inherit;">
                                                    <font style="vertical-align: inherit;">THAY ĐỔI ĐỊA CHỈ</font>
                                                </font>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Thuế GTGT</font>
                                        </font>
                                    </th>
                                    <td>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">19 đô la</font>
                                        </font>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">Tổng cộng</font>
                                        </font>
                                    </th>
                                    <td>
                                        <font style="vertical-align: inherit;">
                                            <font style="vertical-align: inherit;">1319 đô la</font>
                                        </font>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mobile_fixed-btn_wrapper">
                        <div class="button-wrapper container">
                            <a href="checkout.html" class="btn btn-primary btn-checkout">
                                <font style="vertical-align: inherit;">
                                    <font style="vertical-align: inherit;">TIẾN HÀNH THANH TOÁN</font>
                                </font>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
<script>
    document.getElementById('popup-items').addEventListener('click', function(event) {
        const button = event.target;
        const row = button.closest('tr');
        const quantityElement = row.querySelector('.plus-minus-box');
        const totalPriceElement = row.querySelector('td strong');
        const price = parseFloat(row.querySelector('td:nth-child(2)').innerText.replace(/[^0-9]/g, ''));
        let quantity = parseInt(quantityElement.innerText);

        if (button.classList.contains('inc')) {
            quantity++;
        } else if (button.classList.contains('dec') && quantity > 1) {
            quantity--;
        }

        quantityElement.innerText = quantity;
        totalPriceElement.innerText = (price * quantity).toLocaleString() + ' VNĐ';
    });

    // Xóa sản phẩm trong giỏ hàng
    document.getElementById('popup-items').addEventListener('click', function(event) {
        if (event.target.closest('.remove-item')) {
            const row = event.target.closest('tr');
            row.remove();

            // Giảm số lượng giỏ hàng khi xóa sản phẩm
            cartCount--;
            document.getElementById('cart-count').innerText = cartCount;
        }
    });
</script>
