@extends('customer.dashboard')
<style>
    .table> :not(caption)>tr>th {
        padding: 0.625rem 1.5rem .625rem !important;
        background-color: #6a6e51 !important;
    }

    .table>tr>td {
        padding: 0.625rem 1.5rem .625rem !important;
    }

    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
        border-width: 1px 1px;
        border-color: #6a6e51;
    }

    .table> :not(caption)>tr>td {
        padding: .8rem 1rem !important;
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
</style>

@section('customer_content')
    <main class="pt-90" style="padding-top: 0px;">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Đơn Hàng</h2>
            <div class="row">
                <div class="col-lg-2">
                    @include('customer.account.account-nav')
                </div>

                <div class="col-lg-10">
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 80px">Mã Đơn Hàng</th>
                                        <th>Họ Tên</th>
                                        <th class="text-center">Số Điện Thoại</th>
                                        <th class="text-center">Tổng Tiền</th>
                                        <th class="text-center">Trạng Thái</th>
                                        <th class="text-center">Ngày Đặt Hàng</th>
                                        <th class="text-center">Số Lượng Sản Phẩm</th>
                                        <th class="text-center">Ngày Giao</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                        <tr>
                                            <td class="text-center">{{ $order->id }}</td>
                                            <td class="text-center">{{ $order->shippingAddress->name }}</td>
                                            <td class="text-center">{{ $order->shippingAddress->phone }}</td>

                                            <td class="text-center">{{ number_format($order->total_price, 0, ',', '.') }}
                                                <sup>đ</sup>
                                            </td>

                                            <td class="text-center">
                                                @if ($order->status == 'canceled')
                                                    <span class="badge bg-danger">Đã Hủy</span>
                                                @elseif($order->status == 'completed')
                                                    <span class="badge bg-success">Hoàn Thành</span>
                                                @else
                                                    <span class="badge bg-warning">Đang Xử Lý</span>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td class="text-center">{{ $order->items_count }}</td>
                                            <td>{{ $order->updated_at ? $order->updated_at->format('Y-m-d') : 'Chưa giao' }}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('account.orders.details', $order->id) }}">
                                                    <div class="list-icon-function view-icon">
                                                        <div class="item eye">
                                                            <i class="icon-eye"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection
