@extends('admin.layouts.layout')
@section('admin_page_title', 'Order Details - Admin')

@section('admin_layout')
    <style>
        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;
        }
    </style>
    <div class="main-content-wrap">


        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <h5>Order Details</h5>
                </div>
                <a class="tf-button style-1 w208" href="{{ route('Admin.Order.History') }}">Back</a>
            </div>
            <table class="table table-striped table-bordered table-transaction">
                <tbody>
                    <tr>
                        <th>Order Code</th>
                        <td>{{ $order->order_code }}</td>
                        <th>Phone Number</th>
                        <td>{{ $order->shippingAddress->phone }}</td>
                        <th>Post Office Code</th>
                        <td>{{ $order->shippingAddress->zip }}</td>
                    </tr>
                    <tr>
                        <th>Order Date</th>
                        <td>{{ $order->created_at->format('d/m/Y H:i:s') }}</td>

                        <th>Delivery Date</th>
                        <td>2024-07-07</td>
                        <th>Canceled Date</th>
                        <td>2024-07-07</td>
                    </tr>
                    <tr>
                        <th colspan="2">Order Status</th>
                        <td colspan="4">
                            <span class="badge bg-danger">Canceled</span>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

        <div class="wg-box mt-5">
            <h5>Ordered Items</h5>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Img</th>
                            <th>Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center">SKU</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Options</th>
                            <th class="text-center">Return Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $item)
                            <tr>

                                <td class="text-center">
                                    <div class="image"
                                        style="display: flex; justify-content: center; align-items: center; margin: 0 auto; overflow: hidden;">
                                        <img src="{{ asset('storage/' . $item->img) }}" alt="{{ $item->name }}"
                                            class="image">
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
                                <td class="text-center"></td>
                                <td class="text-center">No</td>
                                <td class="text-center">
                                    <div class="list-icon-function view-icon">
                                        <div class="item eye">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{ $orderItems->links() }}
            </div>
        </div>

        <div class="wg-box mt-5">
            <h5>Shipping Address</h5>
            <div class="my-account__address-item col-md-6">
                <div class="my-account__address-item__detail">
                    <table cellpadding="10" cellspacing="0"
                        style="border-collapse: collapse; border: 0; width: 100%;font-size: 15px;">
                        <tr>
                            <th class="text-start" style="border: 0;">Name</th>
                            <td class="text-start" style="border: 0;">{{ $shippingAddress->name }}</td>
                        </tr>
                        <tr>
                            <th class="text-start" style="border: 0;">Address</th>
                            <td class="text-start" style="border: 0;">{{ $shippingAddress->address }},
                                {{ $shippingAddress->city }},
                                {{ $shippingAddress->state }}</td>
                        </tr>
                        <tr>
                            <th class="text-start" style="border: 0;">Zip</th>
                            <td class="text-start" style="border: 0;">{{ $shippingAddress->zip }}</td>
                        </tr>
                        <tr>
                            <th class="text-start" style="border: 0;">Detailed Address</th>
                            <td class="text-start" style="border: 0;">{{ $shippingAddress->landmark }},
                                {{ $shippingAddress->locality }}</td>
                        </tr>
                        <tr>
                            <th class="text-start" style="border: 0;">Phone Number</th>
                            <td class="text-start" style="border: 0;">{{ $shippingAddress->phone }}</td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>

        <div class="wg-box mt-5">
            <h5>Transactions</h5>
            <table class="table table-striped table-bordered table-transaction">
                <tbody>
                    <tr>
                        <th>Total Price</th>
                        <td>{{ number_format($order->total_price_without_discount, 0, ',', '.') }} <sup>đ</sup></td>
                        <th>Discount</th>
                        <td>{{ number_format($order->total_discount, 0, ',', '.') }} <sup>đ</sup></td>
                        <th>Total</th>
                        <td>{{ number_format($order->total_price, 0, ',', '.') }} <sup>đ</sup></td>
                    </tr>
                    <tr>
                        <th>Order Date</th>
                        <td>{{ $order->created_at }}</td>
                        <th>Delivered Date</th>
                        <td>{{ $order->delivered_at ?? 'Not delivered' }}</td>
                        <th>Canceled Date</th>
                        <td>{{ $order->canceled_at ?? 'Not canceled' }}</td>
                    </tr>
                    <tr>
                        <th colspan="3">Payment Mode</th>
                        <td colspan="3">{{ $order->payment_method }}</td>

                    </tr>

                </tbody>
            </table>
        </div>
    </div>

@endsection
