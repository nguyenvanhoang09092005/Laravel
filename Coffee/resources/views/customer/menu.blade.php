<style>
    .popup-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .popup-container.show {
        display: flex;
        opacity: 1;
    }

    .popup-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
        width: 80%;
        position: relative;
        max-width: 800px;

    }

    .btn-close {
        margin: 5px 5px;
    }

    .btn-close:hover {
        color: red;
        transition: color 0.3s ease;
    }





    table {
        width: 100%;
        border-collapse: collapse;
    }

    table,
    th,
    td {
        border: 1px solid #ddd;
    }

    th,
    td {
        padding: 10px;
        text-align: center;
    }
</style>
<?php
// Kiểm tra nếu sản phẩm được thêm vào giỏ
if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product = getProductDetails($product_id); // Hàm này sẽ lấy thông tin sản phẩm từ database
    $_SESSION['cart'][] = $product;
}
?>

<div id = "menu" class="container mt-5">
    <h2 class="text-center mb-4">Thực Đơn Quán Cà Phê</h2>
    <div class="menu-container">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($products as $product)
                    <div class=" swiper-slide menu-item col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="card">
                            <div class="card-img">
                                <img src="{{ $product->product_img ? asset('storage/' . $product->product_img) : 'https://via.placeholder.com/300x200' }}"
                                    class="card-img-top" alt="{{ $product->product_name }}">
                            </div>
                            <div class="card-title">{{ $product->product_name }}</div>
                            <div class="card-subtitle">{{ $product->description }} </div>
                            @if ($product->attribute)
                                <div class="card-attribute">
                                    {{ $product->attribute->name }}
                                </div>
                            @endif

                            {{-- <hr class="card-divider"> --}}
                            <div class="card-footer">
                                <div class="card-price">
                                    <span>{{ number_format($product->regular_price, 0, ',', '.') }} VNĐ</span>
                                </div>
                                <button class="card-btn"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                        height="16" fill="currentColor" class="bi bi-cart2" viewBox="0 0 16 16">
                                        <path
                                            d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                                    </svg></button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
        </div>


        <div id="popup" class="popup-container">
            <div class="popup-content">

                <h3>Thêm vào giỏ hàng</h3>
                <button type="button" class="btn-close position-absolute top-0 end-0" onclick="closePopup()"
                    aria-label="Close"></button>
                <table class="wishlist-table text-center" id="wishlist-table">
                    <thead>
                        <tr>
                            <th>Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody id="popup-items"></tbody>
                </table>
                <div class="text-end mt-3">
                    <button class="btn btn-primary btn-hover btn-active" onclick="addToCart()">Thêm vào giỏ
                        hàng</button>
                </div>

            </div>
        </div>


    </div>
</div>

<!-- Swiper JS -->
<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<script>
    // Khởi tạo Swiper
    const swiper = new Swiper('.swiper-container', {
        slidesPerView: 5,
        spaceBetween: 20,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev'
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
    });

    // Lắng nghe sự kiện click nút thêm vào giỏ

    let cartCount = 0;


    document.querySelectorAll('.card-btn').forEach(button => {
        button.addEventListener('click', function(event) {
            const card = event.target.closest('.menu-item');
            const productName = card.querySelector('.card-title').innerText;
            const productPrice = card.querySelector('.card-price span').innerText;
            const productImg = card.querySelector('.card-img img').src;

            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td class="td-img text-left">
                    <img src="${productImg}" alt="${productName}" />
                    <div class="items-dsc">
                        <h5>${productName}</h5>
                    </div>
                </td>
                <td>${productPrice}</td>
                <td>
                    <div class="plus-minus">
                        <a href="#" class="dec qtybutton">-</a>
                        <b class="plus-minus-box">1</b>
                        <a href="#" class="inc qtybutton">+</a>
                    </div>
                </td>
                <td><strong>${productPrice}</strong></td>
                <td><a href="#" class="remove-item"><i class="mdi mdi-close"></i></a></td>
            `;
            document.getElementById('popup-items').appendChild(newRow);
            document.getElementById('popup').classList.add('show');

            cartCount++;
            document.getElementById('cart-count').innerText = cartCount;
        });
    });

    function closePopup() {
        document.getElementById('popup-items').innerHTML = '';
        document.getElementById('popup').classList.remove('show');
    }


    // Đóng popup khi nhấn vào ngoài popup
    document.getElementById('popup').addEventListener('click', function(event) {
        if (event.target === document.getElementById('popup')) {
            closePopup();
        }
    });

    document.getElementById('popup-items').addEventListener('click', function(event) {
        if (event.target.closest('.remove-item')) {
            const row = event.target.closest('tr');
            row.remove();
        }
    });

    // Tăng/giảm số lượng sản phẩm trong giỏ hàng
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
