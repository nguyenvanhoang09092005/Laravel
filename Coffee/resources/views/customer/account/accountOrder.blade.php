@extends('customer.dashboard')
<style>
    .table-all-user {
        box-shadow: 0 4px 6px rgba(2, 139, 243, 0.59);
        border-radius: 8px;
        overflow: hidden;
    }

    .table th,
    .table td {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        box-shadow: 0 4px 6px rgba(2, 139, 243, 0.59);
        transform: scale(1.01);

    }

    .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 5px;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .status.canceled {
        background-color: #DC3545;
        /* Đỏ nhạt */
        color: white;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .status.delivered {
        background-color: #20C997;
        /* Xanh lá tươi */
        color: white;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .status.shipping {
        background-color: #007BFF;
        /* Cam nhạt */
        color: white;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .status.processing {
        background-color: #FFC107;
        /* Xanh dương nhạt */
        color: white;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .status.confirmed {
        background-color: #17A2B8;
        /* Tím nhẹ */
        color: white;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Thêm hiệu ứng khi hover */
    .status:hover {
        transform: translateY(-2px);
        box-shadow: 0px 8px 12px rgba(0, 0, 0, 0.2);
    }
</style>

@section('customer_content')
    <section class="my-account container">
        <div class="section-title text-center">
            <h2>Đơn hàng</h2>
        </div>
        <div class="row mt-3">
            <div class="col-lg-2">
                @include('customer.account.account-nav')
            </div>

            <div class="col-lg-10">
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                                <tr>
                                    <th style="width: 80px">Mã Đơn Hàng</th>
                                    <th>Họ Tên</th>
                                    <th class="text-center">Số Điện Thoại</th>
                                    <th class="text-center">Tổng Tiền</th>
                                    <th class="text-center">Trạng Thái</th>
                                    <th class="text-center">Ngày Đặt Hàng</th>
                                    <th class="text-center">Số Lượng Sản Phẩm</th>
                                    {{-- <th class="text-center">Ngày Giao</th> --}}
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="table-tbody">
                                        <td class="text-center">{{ $order->id }}</td>
                                        <td class="text-center">{{ $order->shippingAddress->name }}</td>
                                        <td class="text-center">{{ $order->shippingAddress->phone }}</td>

                                        <td class="text-center">{{ number_format($order->total_price, 0, ',', '.') }}
                                            <sup>đ</sup>
                                        </td>

                                        <td class="text-center">
                                            @switch($order->status)
                                                @case('canceled')
                                                    <span class="status canceled">Đã Hủy</span>
                                                @break

                                                @case('delivered')
                                                    <span class="status delivered">Đã giao hàng</span>
                                                @break

                                                @case('shipping')
                                                    <span class="status shipping">Đang giao hàng</span>
                                                @break

                                                @case('confirmed')
                                                    <span class="status confirmed">Hoàn tất</span>
                                                @break

                                                @case('pending')
                                                    <span class="status processing">Đang chờ xử lý</span>
                                                @break

                                                @default
                                                    <span class="status unknown">Không xác định</span>
                                            @endswitch
                                        </td>


                                        <td class="text-center">{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td class="text-center">{{ $order->items_count }}</td>
                                        {{-- <td>{{ $order->updated_at ? $order->updated_at->format('Y-m-d') : 'Chưa giao' }}
                                        </td> --}}
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
@endsection
