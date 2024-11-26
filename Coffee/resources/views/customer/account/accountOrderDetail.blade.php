@extends('customer.dashboard')
<style>
    .pt-90 {
        padding-top: 90px !important;
    }

    .pr-6px {
        padding-right: 6px;
        text-transform: uppercase;
    }

    .my-account .page-title {
        font-size: 1.5rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 40px;
        border-bottom: 1px solid;
        padding-bottom: 13px;
    }

    .my-account .wg-box {
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        padding: 24px;
        flex-direction: column;
        gap: 24px;
        border-radius: 12px;
        background: var(--White);
        box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
    }

    .bg-success {
        background-color: #40c710 !important;
    }

    .bg-danger {
        background-color: #f44032 !important;
    }

    .bg-warning {
        background-color: #f5d700 !important;
        color: #000;
    }


    .table-transaction>tbody>tr:nth-of-type(odd) {
        --bs-table-accent-bg: #fff !important;

    }

    .table-transaction th,
    .table-transaction td {
        padding: 0.625rem 1.5rem .25rem !important;
        color: #000 !important;
    }

    .table> :not(caption)>tr>th {
        padding: 0.625rem 1.5rem .25rem !important;
        background-color: #6a6e51 !important;
    }

    .table-bordered>:not(caption)>*>* {
        border-width: inherit;
        line-height: 32px;
        font-size: 14px;
        border: 1px solid #e1e1e1;
        vertical-align: middle;
    }

    .table-striped .image {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        flex-shrink: 0;
        border-radius: 10px;
        overflow: hidden;
    }

    .table-striped td:nth-child(1) {
        min-width: 250px;
        padding-bottom: 7px;
    }



    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
        border-width: 1px 1px;
        border-color: #6a6e51;
    }
</style>
@section('customer_content')
    <main class="pt-90" style="padding-top: 0px;">
        <section class="my-account container">
            <h2 class="page-title">Chi Tiết Đơn Hàng</h2>
            <div class="row">
                <div class="col-lg-2">
                    @include('customer.account.account-nav')
                </div>



                <div class="col-lg-10">

                    <div class="wg-box mt-5 mb-5">
                        <div class="row">
                            <div class="col-6">
                                <h5>Chi tiết đơn hàng</h5>
                            </div>
                            <div class="col-6 text-end">
                                <a class="btn btn-sm btn-danger" href="http://localhost:8000/account-orders">Quay lại</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-transaction">
                                <tbody>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <td>{{ $order->order_code }}</td>
                                        <th>Số điện thoại</th>
                                        <td>{{ $order->shippingAddress->phone }}</td>
                                        <th>Mã bưu cục</th>
                                        <td>{{ $order->shippingAddress->zip }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày đặt hàng</th>
                                        <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>

                                        <th>Ngày giao hàng</th>
                                        <td>2024-07-07</td>
                                        <th>Ngày hủy</th>
                                        <td>2024-07-07</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái đơn hàng</th>
                                        <td colspan="5">
                                            <span class="badge bg-danger">Đã hủy</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="wg-box mt-5">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Ảnh</th>
                                        <th class="text-center">Tên</th>
                                        <th class="text-center">Giá</th>
                                        <th class="text-center">Số Lượng</th>
                                        <th class="text-center">Mã Sản Phẩm</th>
                                        <th class="text-center">Danh Mục</th>
                                        <th class="text-center">Thương Hiệu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr>

                                            <td class="text-center">
                                                <div class="image"
                                                    style="display: flex; justify-content: center; align-items: center; margin: 0 auto; overflow: hidden;">
                                                    <img src="{{ asset('storage/' . $item->img) }}"
                                                        alt="{{ $item->name }}" class="image">
                                                </div>
                                            </td>

                                            <td class="text-center">{{ $item->name }}</td>
                                            <td class="text-center">{{ number_format($item->price, 0, ',', '.') }}
                                                <sup>đ</sup>
                                            </td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="text-center">{{ $item->product->sku }}</td>
                                            <td class="text-center">{{ $item->product->category->category_name }}</td>
                                            <td class="text-center">{{ $item->product->brand->brand_name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="divider"></div>
                    <div class="wg-box mt-5">
                        <div class="my-account__address-item col-md-6">
                            <div class="col-6">
                                <h5>Thông tin giao hàng</h5>
                            </div>
                            <div class="my-account__address-item__detail mt-3">
                                <table cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%; ">
                                    <thead>
                                        <tr></tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-start"><strong>Họ tên</strong></td>
                                            <td class="text-start">{{ $order->shippingAddress->name }}</td>
                                        </tr>
                                        <tr>
                                            <td class="text-start"><strong>Địa chỉ</strong></td>
                                            <td class="text-start">
                                                {{ $order->shippingAddress->address }},
                                                {{ $order->shippingAddress->city }},
                                                {{ $order->shippingAddress->state }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start"><strong>Địa chỉ cụ thể</strong></td>
                                            <td class="text-start">
                                                {{ $order->shippingAddress->landmark }},
                                                {{ $order->shippingAddress->locality }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-start"><strong>Số điện thoại</strong></td>
                                            <td class="text-start">{{ $order->shippingAddress->phone }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div class="wg-box mt-5">
                        <h5>Thông Tin Thanh Toán</h5>
                        <div class="table-responsive">
                            <table cellpadding="10" cellspacing="0" style="border-collapse: collapse; width: 100%; t">
                                <thead>
                                    <tr></tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-start"><strong>Tổng tiền</strong></td>
                                        <td class="text-start">
                                            {{ number_format($order->total_price_without_discount, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start"><strong>Mã giảm giá</strong></td>
                                        <td class="text-start">
                                            {{ number_format($order->total_discount, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start"><strong>Tổng cộng</strong></td>
                                        <td class="text-start">
                                            {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-start"><strong>Phương thức thanh toán</strong></td>
                                        <td class="text-start">{{ $order->payment_method }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="wg-box mt-5 text-end">
                        <form action="{{ route('account.orders.cancel', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-danger">Hủy Đơn Hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
