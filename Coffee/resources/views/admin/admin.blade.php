@extends('admin.layouts.layout')

@section('admin_page_title')
    Dashboard-Admin
@endsection
@section('admin_layout')
    <div class="main-content-wrap">
        <div class="tf-section-2 mb-30">
            <div class="flex gap20 flex-wrap-mobile">
                <div class="w-half">

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Total Orders</div>
                                    <h4>{{ $orderCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="bi bi-truck"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Order being delivered</div>
                                    <h4>{{ $shippingOrdersCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Người dùng -->
                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-user"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Users</div>
                                    <h4>{{ $usersCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Revenue</div>
                                    <h4>{{ number_format($revenueMonth, 0, ',', '.') }} <sup>vnđ</sup></h4>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="w-half">

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-shopping-bag"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Pending Orders</div>
                                    <h4>{{ $pendingOrdersCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="bi bi-x-diamond"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Completed Orders</div>
                                    <h4>{{ $confirmedOrdersCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-layers"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Product</div>
                                    <h4>{{ $productsCount }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Expense</div>
                                    <h4>420.000 <sup>vnđ</sup> </h4>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="wg-box d-flex justify-content-center align-items-center" style="height: auto;">
                <canvas id="userChart"
                    style="max-width: 550px !important; max-height: 500px !important; width: 100%; height: 100%;">
                    <span id="adminCount" style="display:none">{{ $adminCount }}</span>
                    <span id="customerCount" style="display:none">{{ $customerCount }}</span>
                    <span id="personnelCount" style="display:none">{{ $personnelCount }}</span>
                </canvas>
            </div>


        </div>
        <div class="tf-section mb-30">
            <div class="row g-3">
                <div class="wg-box">
                    <div style="width: 100%;height: 100%;">
                        <canvas id="trafficChart" style=" width: 100%; 
                         height: 100%;"></canvas>
                        <span id="chart-dates" style="display: none;">{{ json_encode($trafficData['dates']) }}</span>
                        <span id="chart-traffic" style="display: none;">{{ json_encode($trafficData['traffic']) }}</span>
                        <span id="chart-users" style="display: none;">{{ json_encode($trafficData['users']) }}</span>
                        <span id="chart-revenue" style="display: none;">{{ json_encode($trafficData['revenue']) }}</span>
                        <span id="chart-orders" style="display: none;">{{ json_encode($trafficData['orders']) }}</span>
                    </div>

                </div>
            </div>
        </div>



        <div class="tf-section mb-30">
            <div class="row g-4"> <!-- g-3 đã tạo khoảng cách giữa các thẻ con -->

                {{-- <div class="col-12 col-md-12 col-xxl-6 d-flex order-3 order-xxl-2 mb-2">
                    <div class="wg-box flex-fill">
                        <div class="wg-box-header">
                            <h5 class="wg-box-title mb-0">Nhân Viên</h5>
                        </div>
                        <div class="wg-box-body">
                            <div class="d-flex justify-content-between">
                                <span>Số Nhân Viên Đang Làm Việc</span>
                                <h3>5</h3>
                            </div>
                        </div>
                    </div>
                </div> --}}


                <!-- Real-Time Map Card -->
                <div class="col-12 ">
                    <!-- mb-3 thêm khoảng cách dưới -->
                    <div class="wg-box flex-fill w-100">
                        <div class="wg-box-header">
                            <h5 class="wg-box-title text-center mb-0">Map</h5>
                        </div>
                        <div class="wg-box-body px-4">
                            <div id="world_map" style="height:350px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        {{-- <div class="tf-section mb-30">

            <div class="wg-box">
                <div class="flex items-center justify-between">
                    <h5>Recent orders</h5>
                    <div class="dropdown default">
                        <a class="btn btn-secondary dropdown-toggle" href="#">
                            <span class="view-all">View all</span>
                        </a>
                    </div>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 80px">OrderNo</th>
                                    <th>Name</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Tax</th>
                                    <th class="text-center">Total</th>

                                    <th class="text-center">Status</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Total Items</th>
                                    <th class="text-center">Delivered On</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">1</td>
                                    <td class="text-center">Divyansh Kumar</td>
                                    <td class="text-center">1234567891</td>
                                    <td class="text-center">$172.00</td>
                                    <td class="text-center">$36.12</td>
                                    <td class="text-center">$208.12</td>

                                    <td class="text-center">ordered</td>
                                    <td class="text-center">2024-07-11 00:54:14</td>
                                    <td class="text-center">2</td>
                                    <td></td>
                                    <td class="text-center">
                                        <a href="#">
                                            <div class="list-icon-function view-icon">
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div> --}}

    </div>
@endsection
