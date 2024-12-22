@extends('seller.layouts.layout');
@section('seller_page_title')
    Dashboard
@endsection
@section('seller_layout')
    <style>
        .clock {
            position: relative;
            width: 200px;
            height: 200px;
            border: 10px solid #333;
            border-radius: 50%;
            background-color: #fff;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .hand {
            position: absolute;
            bottom: 50%;
            left: 50%;
            transform-origin: bottom;
            transition-timing-function: steps(1);
            transition: transform 0.5s ease-in-out;
            background-color: #333;
            border-radius: 50%;
        }

        .second-hand {
            width: 1px;
            height: 90px;
            background-color: red;
        }

        .minute-hand {
            width: 3px;
            height: 70px;
            background-color: #333;
        }

        .hour-hand {
            width: 6px;
            height: 50px;
            background-color: #333;
        }

        .center-dot {
            position: absolute;
            width: 12px;
            height: 12px;
            background-color: #333;
            border-radius: 50%;
            z-index: 10;
        }

        .clock-number {
            position: absolute;
            color: #333;
            font-size: 18px;
            font-weight: bold;
        }

        #number-12 {
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        #number-3 {
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
        }

        #number-6 {
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        #number-9 {
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
        }
    </style>

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

                    <div class="wg-chart-default mb-20">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-dollar-sign"></i>
                                </div>
                                <div>
                                    <div class="body-text mb-2">Salary</div>
                                    <h4>34</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wg-chart-default">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap14">
                                <div class="image ic-bg">
                                    <i class="icon-calendar"></i> <!-- Thay biểu tượng dollar thành biểu tượng lịch -->
                                </div>
                                <div>
                                    <div class="body-text mb-2">Total working daysTotal working days</div>
                                    <h4>34</h4>
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
                        <div class="clock">
                            <div class="hand hour-hand" id="hour-hand"></div>
                            <div class="hand minute-hand" id="minute-hand"></div>
                            <div class="hand second-hand" id="second-hand"></div>
                            <div class="center-dot"></div>

                            <div class="clock-number" id="number-12">12</div>
                            <div class="clock-number" id="number-3">3</div>
                            <div class="clock-number" id="number-6">6</div>
                            <div class="clock-number" id="number-9">9</div>

                        </div>
                    </div>

                </div>

            </div>

            <div class="wg-box d-flex justify-content-center align-items-center" style="height: auto;">
                <canvas id="workingHoursChart"></canvas>
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var ctx = document.getElementById('workingHoursChart').getContext('2d');
        var workingHoursChart = new Chart(ctx, {
            type: 'polarArea',
            data: {
                labels: ['Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6', 'Thứ 7', 'Chủ Nhật'],
                datasets: [{
                    label: 'Thời gian làm việc',
                    data: @json($workingHours),
                    backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#FF33A1', '#FF8C33', '#33FFF1',
                        '#8C33FF'
                    ],

                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true, // Giữ tỷ lệ
                aspectRatio: 1, // Tỷ lệ khung hình (1:1)
            }
        });




        function updateClock() {
            var now = new Date();

            // Lấy giờ, phút, giây
            var hours = now.getHours();
            var minutes = now.getMinutes();
            var seconds = now.getSeconds();

            // Tính toán góc cho các kim
            var secondDegree = (seconds / 60) * 360;
            var minuteDegree = (minutes / 60) * 360 + (seconds / 60) * 6;
            var hourDegree = (hours % 12 / 12) * 360 + (minutes / 60) * 30;

            // Cập nhật vị trí kim đồng hồ
            document.getElementById('second-hand').style.transform = 'rotate(' + secondDegree + 'deg)';
            document.getElementById('minute-hand').style.transform = 'rotate(' + minuteDegree + 'deg)';
            document.getElementById('hour-hand').style.transform = 'rotate(' + hourDegree + 'deg)';
        }

        // Cập nhật đồng hồ mỗi giây
        setInterval(updateClock, 1000);

        // Gọi hàm updateClock khi trang được tải
        window.onload = updateClock;
    </script>
    </script>
@endsection
