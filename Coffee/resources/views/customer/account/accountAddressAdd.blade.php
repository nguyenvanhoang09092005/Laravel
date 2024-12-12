@extends('customer.dashboard')
@section('customer_content')
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
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="name" required="">
                                    <label for="name">Họ tên *</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="phone" required="">
                                    <label for="phone">Số điện thoại *</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="zip">
                                    <label for="zip">Mã bưu chính</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating mt-3 mb-3">
                                    <input type="text" class="form-control" name="state" required="">
                                    <label for="state">Tỉnh/Thành phố *</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="city" required="">
                                    <label for="city">Quận/Huyện *</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="address" required="">
                                    <label for="address">Số nhà, Tên tòa nhà *</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="locality" required="">
                                    <label for="locality">Tên đường, Khu vực, Khu phố *</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control" name="landmark" required="">
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
