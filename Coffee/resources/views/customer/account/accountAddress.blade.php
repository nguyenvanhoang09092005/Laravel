@extends('customer.dashboard')
@section('customer_content')
    <style>
        .my-account .wg-box {
            display: flex;
            flex-direction: column;
            padding: 24px;
            gap: 24px;
            border-radius: 12px;
            background: var(--White);
            box-shadow: 0px 4px 24px 2px rgba(107, 108, 110, 0.237);
            transition: all 0.3s ease;
            background: linear-gradient(145deg, #ffffff, #f7f7f7);
        }

        .wg-box:hover {
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            transform: translateY(-5px);
        }

        .my-account__address-list {
            margin-top: 20px;
        }

        .my-account__address-item {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 16px;
            margin-bottom: 16px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .my-account__address-item:hover {
            transform: translateY(-3px);
            box-shadow: 0px 6px 18px rgba(0, 0, 0, 0.1);
        }

        .my-account__address-item__title h5 {
            font-size: 1.1rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
        }

        .my-account__address-item__title a {
            font-size: 0.9rem;
            color: #007bff;
            text-decoration: none;
            margin-left: 10px;
        }

        .my-account__address-item__title a:hover {
            text-decoration: underline;
        }

        .my-account__address-item__detail p {
            margin: 6px 0;
            font-size: 0.95rem;
            color: #555;
        }

        .my-account__address-item__detail p strong {
            color: #333;
        }

        .btn-info {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
            font-size: 0.9rem;
        }

        .btn-info:hover {
            background-color: #0056b3;
        }

        .notice {
            color: #555;
            font-size: 1rem;
        }

        .page-title {
            font-size: 1.8rem;
            font-weight: bold;
            color: #333;
        }
    </style>

    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <div class="section-title text-center" style="margin-top: 4%">
                <h2>Địa chỉ giao hàng</h2>
            </div>
            <div class="row mt-3">
                <div class="col-lg-2">
                    @include('customer.account.account-nav')
                </div>
                <div class="col-lg-10">
                    <div class="page-content my-account__address wg-box">
                        <div class="row">
                            <div class="col-10">
                                <p class="notice">Các địa chỉ dưới đây sẽ được sử dụng mặc định trong trang thanh toán.</p>
                            </div>
                            <div class="col-2 text-right">
                                <a href="{{ route('Customer.Account.Address.Create') }}" class="btn btn-sm btn-info">Thêm
                                    Mới</a>
                            </div>
                        </div>
                        <div class="my-account__address-list row">
                            <h5>Địa chỉ giao hàng</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
