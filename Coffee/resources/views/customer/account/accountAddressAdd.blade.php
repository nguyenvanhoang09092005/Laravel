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
    <main class="pt-90">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <div class="section-title text-center" style="margin-top: 4%">
                <h2 style="margin-left: 20%">Địa chỉ giao hàng</h2>
            </div>
            <div class="row ">
                <div class="col-lg-2">
                    @include('customer.account.account-nav')
                </div>
                <div class="col-lg-10">
                    <div class="billing-info__wrapper">

                        <div class="row ">
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
                </div>
            </div>
        </section>
    </main>
@endsection
