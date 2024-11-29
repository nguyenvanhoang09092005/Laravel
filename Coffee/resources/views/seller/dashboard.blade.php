@extends('seller.layouts.layout');
@section('seller_page_title')
    Dashboard
@endsection
@section('seller_layout')
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
                                    <div class="body-text mb-2">Delivered Orders</div>
                                    <h4>0</h4>
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
                                    <h4>481.34</h4>
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
                                    <h4>0</h4>
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
                                    <h4>0.00</h4>
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
            <div class="row g-4">
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

    </div>
@endsection
