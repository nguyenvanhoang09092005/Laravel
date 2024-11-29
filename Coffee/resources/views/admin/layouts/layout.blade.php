    <!DOCTYPE html>
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

    <head>
        <meta charset="utf-8">
        <meta name="author" content="themesflat.com">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">


        <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/animate.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/animation.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/bootstrap-select.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_asset/font/fonts.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_asset/icon/style.css') }}">
        <link rel="stylesheet" href="{{ asset('admin_asset/css/bootstrap-icons.min.css') }}">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />

        <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Pacifico&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

        <link rel="shortcut icon" href="{{ asset('admin_asset/images/favicon.ico') }}">
        <link rel="apple-touch-icon-precomposed" href="{{ asset('admin_asset/images/favicon.ico') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/sweetalert.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/custom.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin_asset/css/main.css') }}">

        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css"
            integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLR7jc/2Ji8c5i8Gxs7iI6Vtb2j6bP1g5c4pNTF1+7R9"
            crossorigin="anonymous">


        @livewireStyles
        <title>@yield('admin_page_title')</title>
    </head>

    <body class="body">
        <div id="wrapper">
            <div id="page" class="">
                <div class="layout-wrap">

                    <!-- <div id="preload" class="preload-container">
        <div class="preloading">
            <span></span>
        </div>
    </div> -->

                    <div class="section-menu-left">
                        <div class="box-logo">
                            <a href="#" id="site-logo-inner">
                                <p class="logo">Da Cuoi</p>
                            </a>
                            <div class="button-show-hide">
                                <i class="icon-menu-left"></i>
                            </div>
                        </div>


                        <div class="center">
                            <div class="center-item">
                                <div class="center-heading">Page Admin </div>
                                <ul class="menu-list">
                                    <li class="menu-item {{ request()->routeIs('admin') ? 'active' : '' }}">
                                        <a href="{{ route('admin') }}" class="">
                                            <div class="icon"><i class="icon-grid"></i></div>
                                            <div class="text">Dashboard</div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="center-item">
                                <ul class="menu-list">
                                    <li class="menu-item has-children">
                                        <a href="javascript:void(0);" class="menu-item-button">
                                            <div class="icon"><i class="icon-layers"></i></div>
                                            <div class="text"> Category</div>
                                        </a>
                                        <ul class="sub-menu">
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('category.create') ? 'active' : '' }}">
                                                <a href="{{ route('category.create') }}" class="">
                                                    <div class="text">Create</div>
                                                </a>
                                            </li>
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('category.manage') ? 'active' : '' }}">
                                                <a href="{{ route('category.manage') }}" class="">
                                                    <div class="text">Manager</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item has-children">
                                        <a href="javascript:void(0);" class="menu-item-button">
                                            <div class="icon"><i class="icon-shopping-cart"></i></div>
                                            <div class="text"> Brand</div>
                                        </a>
                                        <ul class="sub-menu">
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('brand.create') ? 'active' : '' }}">
                                                <a href="{{ route('brand.create') }}" class="">
                                                    <div class="text">Create</div>
                                                </a>
                                            </li>
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('brand.manage') ? 'active' : '' }}">
                                                <a href="{{ route('brand.manage') }}" class="">
                                                    <div class="text">Manager</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="menu-item has-children">
                                        <a href="javascript:void(0);" class="menu-item-button">
                                            <div class="icon"><i class="bi bi-shop"></i></div>
                                            <div class="text"> Store</div>
                                        </a>
                                        <ul class="sub-menu">
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('admin.store') ? 'active' : '' }}">
                                                <a href="{{ route('admin.store') }}" class="">
                                                    <div class="text">Create</div>
                                                </a>
                                            </li>
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('admin.store.manage') ? 'active' : '' }}">
                                                <a href="{{ route('admin.store.manage') }}" class="">
                                                    <div class="text">Manager</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="menu-item has-children">
                                        <a href="javascript:void(0);" class="menu-item-button">
                                            <div class="icon"><i class="icon-layers"></i></div>
                                            <div class="text">Product</div>
                                        </a>
                                        <ul class="sub-menu">
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('product.create') ? 'active' : '' }}">
                                                <a href="{{ route('product.create') }}" class="">
                                                    <div class="text">Create</div>
                                                </a>
                                            </li>

                                            <li
                                                class="sub-menu-item {{ request()->routeIs('product.manage') ? 'active' : '' }}">
                                                <a href="{{ route('product.manage') }}" class="">
                                                    <div class="text">Manager</div>
                                                </a>
                                            </li>
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('product.review.manage_product_review') ? 'active' : '' }}">
                                                <a href="{{ route('product.review.manage_product_review') }}"
                                                    class="">
                                                    <div class="text">Product Review</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="menu-item has-children">
                                        <a href="javascript:void(0);" class="menu-item-button">
                                            <div class="icon"><i class="icon-layers"></i></div>
                                            <div class="text">Product Attributes</div>
                                        </a>
                                        <ul class="sub-menu">
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('product_attributes.create') ? 'active' : '' }}">
                                                <a href="{{ route('product_attributes.create') }}" class="">
                                                    <div class="text">Create</div>
                                                </a>
                                            </li>
                                            <li class="sub-menu-item"
                                                {{ request()->routeIs('product_attributes.manage') ? 'active' : '' }}>
                                                <a href="{{ route('product_attributes.manage') }}" class="">
                                                    <div class="text">Manager</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="menu-item has-children">
                                        <a href="javascript:void(0);" class="menu-item-button">
                                            <div class="icon"><i class="icon-shopping-cart"></i></div>
                                            <div class="text">Order</div>
                                        </a>
                                        <ul class="sub-menu">
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('Admin.Order.History') ? 'active' : '' }}">
                                                <a href="{{ route('Admin.Order.History') }}" class="">
                                                    <div class="text">History</div>
                                                </a>
                                            </li>
                                            {{-- <li class="sub-menu-item"
                                                {{ request()->routeIs('Admin.Order.Detail') ? 'active' : '' }}>
                                                <a href="{{ Route('Admin.Order.Detail') }}" class="">
                                                    <div class="text">Order Detail</div>
                                                </a>
                                            </li> --}}
                                        </ul>
                                    </li>

                                    <li class="menu-item"
                                        {{ request()->routeIs('admin.manage.user') ? 'active' : '' }}>
                                        <a href="{{ route('admin.manage.user') }}" class="">
                                            <div class="icon"><i class="icon-user"></i></div>
                                            <div class="text">Manager User</div>
                                        </a>
                                    </li>
                                    {{-- <li class="menu-item has-children">
                                        <a href="javascript:void(0);" class="menu-item-button">
                                            <div class="icon"><i class="bi bi-credit-card"></i></div>
                                            <div class="text">Payment</div>
                                        </a>
                                        <ul class="sub-menu">
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('payment.add') ? 'active' : '' }}">
                                                <a href="{{ route('payment.add') }}" class="">
                                                    <div class="text">Add</div>
                                                </a>
                                            </li>
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('payment.manager') ? 'active' : '' }}">
                                                <a href="{{ route('payment.manage') }}" class="">
                                                    <div class="text">Manager</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li> --}}
                                    <li class="menu-item has-children">
                                        <a href="javascript:void(0);" class="menu-item-button">
                                            <div class="icon"><i class="icon-file-plus"></i></div>
                                            <div class="text">Promotions</div>
                                        </a>
                                        <ul class="sub-menu">
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('promotions.create') ? 'active' : '' }}">
                                                <a href="{{ route('promotions.create') }}" class="">
                                                    <div class="text">Create</div>
                                                </a>
                                            </li>
                                            <li
                                                class="sub-menu-item {{ request()->routeIs('promotions.manage') ? 'active' : '' }}">
                                                <a href="{{ route('promotions.manage') }}" class="">
                                                    <div class="text">Manager</div>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="menu-item" {{ request()->routeIs('admin.user') ? 'active' : '' }}>
                                        <a href="{{ route('admin.user') }}" class="">
                                            <div class="icon"><i class="icon-user"></i></div>
                                            <div class="text">Account Information</div>
                                        </a>
                                    </li>

                                    <li class="menu-item" {{ request()->routeIs('admin.setting') ? 'active' : '' }}>
                                        <a href="{{ route('admin.setting') }}" class="">
                                            <div class="icon"><i class="icon-settings"></i></div>
                                            <div class="text">Settings</div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="section-content-right">

                        <div class="header-dashboard">
                            <div class="wrap">
                                <div class="header-left">

                                    <div class="button-show-hide">
                                        <i class="icon-menu-left"></i>
                                    </div>


                                </div>
                                <div class="header-grid">

                                    {{-- <div class="popup-wrap message type-header">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <span class="header-item">
                                                    <span class="text-tiny">1</span>
                                                    <i class="icon-bell"></i>
                                                </span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end has-content"
                                                aria-labelledby="dropdownMenuButton2">
                                                <li>
                                                    <h6>Notifications</h6>
                                                </li>
                                                <li>
                                                    <div class="message-item item-1">
                                                        <div class="image">
                                                            <i class="icon-noti-1"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-title-2">Discount available</div>
                                                            <div class="text-tiny">Morbi sapien massa, ultricies at
                                                                rhoncus
                                                                at, ullamcorper nec diam</div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="message-item item-2">
                                                        <div class="image">
                                                            <i class="icon-noti-2"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-title-2">Account has been verified</div>
                                                            <div class="text-tiny">Mauris libero ex, iaculis vitae
                                                                rhoncus
                                                                et</div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="message-item item-3">
                                                        <div class="image">
                                                            <i class="icon-noti-3"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-title-2">Order shipped successfully</div>
                                                            <div class="text-tiny">Integer aliquam eros nec
                                                                sollicitudin
                                                                sollicitudin</div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="message-item item-4">
                                                        <div class="image">
                                                            <i class="icon-noti-4"></i>
                                                        </div>
                                                        <div>
                                                            <div class="body-title-2">Order pending: <span>ID
                                                                    305830</span>
                                                            </div>
                                                            <div class="text-tiny">Ultricies at rhoncus at ullamcorper
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><a href="#" class="tf-button w-full">View all</a></li>
                                            </ul>
                                        </div>
                                    </div> --}}




                                    <div class="popup-wrap user type-header">
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton3" data-bs-toggle="dropdown"
                                                aria-expanded="false">
                                                <span class="header-user wg-user" style="margin-right: 2em">
                                                    <span class="image">
                                                        <img src="{{ asset('storage/' . Auth::user()->profile_image) }}"
                                                            alt="User Profile Image">


                                                    </span>
                                                    <span class="flex flex-column">
                                                        <span class="body-title mb-2">{{ Auth::user()->name }}</span>
                                                        <span class="text-tiny">Admin</span>
                                                    </span>
                                                </span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end has-content"
                                                aria-labelledby="dropdownMenuButton3">
                                                <li>
                                                    <a href="{{ route('admin.user') }}" class="user-item">
                                                        <div class="icon">
                                                            <i class="icon-user"></i>
                                                        </div>
                                                        <div class="body-title-2"
                                                            {{ request()->routeIs('admin.user') ? 'active' : '' }}>
                                                            Account</div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="user-item">
                                                        <div class="icon">
                                                            <i class="icon-mail"></i>
                                                        </div>
                                                        <div class="body-title-2">Inbox</div>
                                                        <div class="number">27</div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="user-item">
                                                        <div class="icon">
                                                            <i class="icon-file-text"></i>
                                                        </div>
                                                        <div class="body-title-2">Taskboard</div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/') }}" class="user-item">
                                                        <div class="icon">
                                                            <i class="bi bi-house-door"></i>
                                                        </div>
                                                        <div class="body-title-2">Back Home</div>
                                                    </a>
                                                </li>


                                                <li>
                                                    <form id="logout-form" action="{{ route('logout') }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                    </form>

                                                    <a href="#" class="user-item"
                                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                        <div class="icon">
                                                            <i class="icon-log-out"></i>
                                                        </div>
                                                        <div class="body-title-2">Log out</div>
                                                    </a>

                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="main-content">

                            <div class="main-content-inner">
                                @yield('admin_layout')
                            </div>

                            <div class="bottom-page">
                                <div class="body-text"> &copy; Copyright <strong><span>Coffee Da Cuoi</span></strong>.
                                    All Rights Reserved</div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('admin_asset/js/jquery.min.js') }}"></script>
        <script src="{{ asset('admin_asset/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('admin_asset/js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('admin_asset/js/sweetalert.min.js') }}"></script>
        <script src="{{ asset('admin_asset/js/apexcharts/apexcharts.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script src="{{ asset('admin_asset/js/main.js') }}"></script>
        <script src="{{ asset('admin_asset/js/script.js') }}"></script>
        <script>
            (function($) {

                var tfLineChart = (function() {

                    var chartBar = function() {

                        var options = {
                            series: [{
                                    name: 'Total',
                                    data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00,
                                        0.00, 0.00, 0.00
                                    ]
                                }, {
                                    name: 'Pending',
                                    data: [0.00, 0.00, 0.00, 0.00, 0.00, 273.22, 208.12, 0.00, 0.00,
                                        0.00, 0.00, 0.00
                                    ]
                                },
                                {
                                    name: 'Delivered',
                                    data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00,
                                        0.00, 0.00
                                    ]
                                }, {
                                    name: 'Canceled',
                                    data: [0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00,
                                        0.00, 0.00
                                    ]
                                }
                            ],
                            chart: {
                                type: 'bar',
                                height: 325,
                                toolbar: {
                                    show: false,
                                },
                            },
                            plotOptions: {
                                bar: {
                                    horizontal: false,
                                    columnWidth: '10px',
                                    endingShape: 'rounded'
                                },
                            },
                            dataLabels: {
                                enabled: false
                            },
                            legend: {
                                show: false,
                            },
                            colors: ['#2377FC', '#FFA500', '#078407', '#FF0000'],
                            stroke: {
                                show: false,
                            },
                            xaxis: {
                                labels: {
                                    style: {
                                        colors: '#212529',
                                    },
                                },
                                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                                    'Oct', 'Nov', 'Dec'
                                ],
                            },
                            yaxis: {
                                show: false,
                            },
                            fill: {
                                opacity: 1
                            },
                            tooltip: {
                                y: {
                                    formatter: function(val) {
                                        return "$ " + val + ""
                                    }
                                }
                            }
                        };

                        chart = new ApexCharts(
                            document.querySelector("#line-chart-8"),
                            options
                        );
                        if ($("#line-chart-8").length > 0) {
                            chart.render();
                        }
                    };

                    /* Function ============ */
                    return {
                        init: function() {},

                        load: function() {
                            chartBar();
                        },
                        resize: function() {},
                    };
                })();

                jQuery(document).ready(function() {});

                jQuery(window).on("load", function() {
                    tfLineChart.load();
                });

                jQuery(window).on("resize", function() {});
            })(jQuery);
        </script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
        @livewireScripts
    </body>

    </html>
