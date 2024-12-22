<ul class="account-nav">
    <li><a href="{{ route('Customer.Account.Detail') }}" class="menu-link">Trang cá nhân</a></li>
    {{-- <li><a href="{{ route('Customer.Account.Address.Manage') }}" class="menu-link">Địa chỉ</a></li> --}}
    <li><a href="{{ route('Customer.Account.Order') }}" class="menu-link">Đơn hàng</a></li>
    <li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <a class="menu-link logout-link" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Đăng xuất
            </a>
        </form>
    </li>
</ul>

<style>
    /* Định dạng chung cho thanh điều hướng */
    .account-nav {
        list-style: none;
        padding: 0;
        margin: 0;
        background: linear-gradient(145deg, #f3f4f6, #ffffff);
        border-radius: 12px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
    }

    .account-nav li {
        margin: 0;
    }

    /* Định dạng cho các liên kết trong menu */
    .account-nav .menu-link {
        display: block;
        padding: 14px 22px;
        font-size: 16px;
        color: #4a4a4a;
        text-decoration: none;
        font-weight: 600;
        background: linear-gradient(145deg, #ffffff, #e9e9e9);
        border-radius: 8px;
        margin: 8px 10px;
        transition: all 0.3s ease, box-shadow 0.2s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Hiệu ứng khi hover */
    .account-nav .menu-link:hover {
        background: linear-gradient(145deg, #007bff, #0056b3);
        color: #ffffff;
        box-shadow: 0 8px 15px rgba(0, 123, 255, 0.3);
        transform: translateY(-3px);
    }

    /* Hiệu ứng khi nhấn (active state) */
    .account-nav .menu-link:active {
        background: linear-gradient(145deg, #0056b3, #003f80);
        color: #ffffff;
        box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.2), 0 4px 6px rgba(0, 0, 0, 0.1);
        transform: translateY(2px) scale(0.98);
    }

    /* Định dạng cho liên kết đang active */
    .account-nav .menu-link.active {
        background: linear-gradient(145deg, #007bff, #0056b3);
        color: #ffffff;
        font-weight: bold;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        box-shadow: 0 8px 15px rgba(0, 190, 243, 0.4);
        transform: scale(1.02);
    }

    /* Định dạng riêng cho liên kết đăng xuất */
    .account-nav .logout-link {
        color: #018dffd2;
        font-weight: bold;
        text-align: center;
        background: linear-gradient(145deg, #ffffff, #ffe2e4);
        /* Màu nền sáng hơn */
        border-radius: 8px;
        margin: 8px 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Tạo bóng nhẹ */
        transition: all 0.4s ease;
    }

    .account-nav .logout-link:hover {
        background: linear-gradient(145deg, #00a6ff, #0d6eff);
        /* Màu đỏ sáng hơn khi hover */
        color: #ffffff;
        box-shadow: 0 8px 16px rgba(10, 210, 255, 0.6);
        /* Bóng sáng hơn và rõ nét */
        transform: translateY(-3px) scale(1.02);
        /* Hiệu ứng nổi bật hơn */
    }

    .account-nav .logout-link:active {
        background: linear-gradient(145deg, #00a6ff, #0d6eff);
        /* Màu tối hơn khi nhấn */
        color: #ffffff;
        box-shadow: inset 0 4px 8px rgba(0, 0, 0, 0.2), 0 6px 12px rgba(0, 153, 255, 0.5);
        /* Bóng trong và ngoài */
        transform: translateY(2px) scale(0.98);
        /* Hiệu ứng nhấn */
    }


    @media (max-width: 768px) {
        .account-nav .menu-link {
            font-size: 14px;
            padding: 10px 18px;
        }

        .account-nav .logout-link {
            font-size: 14px;
            padding: 10px 18px;
        }
    }
</style>
