<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Coffee Da Cuoi</title>

    <!-- Vendor CSS Files -->
    <link href="{{ asset('admin_asset/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/css/cart.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin_asset/icon/style.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('admin_asset/css/bootstrap-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin_asset/css/plugins/swiper.min.css') }}" type="text/css" />


</head>

<body>

    <style>
        .cart-items-header {
            position: relative;
        }

        #cart-count {
            position: absolute;

            right: 0px;
            padding: 5px;
            border-radius: 50%;
            background-color: red;
            color: white;
            font-size: 12px;
            font-weight: bold;
        }
    </style>

    <header class="d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">
            <!-- Logo -->
            <h1 class="logo">
                <a href="{{ route('dashboard') }}">Da Cuoi</a>
            </h1>

            <!-- Navbar -->
            <nav id="navbar" class="navbar d-flex align-items-center">
                <ul>
                    <li><a class="nav-link scrollto" href="{{ route('dashboard') }}">Home</a></li>

                    <li><a class="nav-link scrollto" href="{{ route('Customer.Shop') }}">Menu</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('Customer.Cart.View') }}">Pay</a></li>
                    <li><a class="nav-link scrollto" href="{{ route('Customer.Promotions') }}">Promotions</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <div class="d-flex align-items-center ms-3 cart-items-header">
                    <a href="{{ route('Customer.Cart.View') }}" class="header-tools__item header-tools__cart">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            class="bi bi-cart3" viewBox="0 0 16 16">
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                        </svg>
                        <span id="cart-count" class="cart-amount d-block position-absolute js-cart-items-count">

                        </span>
                    </a>
                </div>

                <i class="bi bi-list mobile-nav-toggle"></i>

                <!-- Right-side Menu -->
                <div class="icon_account d-flex align-items-center ms-5">
                    <!-- Search Input -->
                    <input type="text" class="form-control search me-5" placeholder="Search"
                        style="max-width: 200px;">

                    <!-- User Dropdown -->
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                                class="bi bi-person" viewBox="0 0 16 16">
                                <path
                                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-start mt-4 custom-center" aria-labelledby="userDropdown">
                            @if (Route::has('login'))
                                <nav class="-mx-3 flex flex-1 justify-end">
                                    @auth
                                        <a href="{{ route('dashboard') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                            Dashboard
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                            Log in
                                        </a>

                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}"
                                                class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                                Register
                                            </a>
                                        @endif
                                    @endauth
                                </nav>
                            @endif
                        </ul>
                    </div>
                </div>

            </nav>
        </div>
    </header>


    <section id="hero">
        <div id="banner" class="d-flex align-items-center">
            <div class="container " data-aos="zoom-out" data-aos-delay="100">
                <h1>Chào mừng đến với <span>Da Cuoi</span></h1>
                <div class="d-flex">
                    <p style="font-size: 1.5rem;">
                        Coffee Đá Cuội nơi bạn thưởng thức ly cà phê đậm
                        đà.
                    </p>
                </div>

            </div>
        </div>
    </section>


    <!-- ======= Footer ======= -->
    <footer id="footer">


        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Da Cuoi</h3>
                        <p>
                            144 Le Tan Trung <br>
                            Tho Quang, Son Tra<br>
                            Da Nang <br><br>
                            <strong>Phone:</strong> +84 356 151 897<br>
                            <strong>Email:</strong> nguyenvanhoang09092005@gmail.com<br>
                        </p>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>


                    <div class="col-lg-6 col-md-6 footer-links">
                        <h4>Our Coffee Culture</h4>
                        <p>Coffee Da Cuoi is a place where coffee lovers come together, offering a relaxing space with
                            aromatic, flavorful coffee. Come and experience the true essence of life in every cup!</p>

                        <div class="social-links mt-3">
                            <h4>Our Social Media</h4>
                            <p>Follow Coffee Da Cuoi on our social media platforms to stay updated with our latest news,
                                promotions, and exciting events. Join us and become a part of our coffee-loving
                                community!
                            </p>

                            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>Coffee Da Cuoi</span></strong>. All Rights Reserved
            </div>
            <div class="credits">

                Designed by <a href="#">Nguyen Van Hoang</a>
            </div>
        </div>
    </footer><!-- End Footer -->



    <!-- Vendor JS Files -->
    <script src="{{ asset('admin_asset/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('admin_asset/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/php-email-form/validate.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/isotope-layout@3.0.6/dist/isotope.pkgd.min.js"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('admin_asset/js/script.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script src="{{ asset('admin_asset/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_asset/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin_asset/js/plugins/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('admin_asset/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('admin_asset/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('admin_asset/js/theme.js') }}"></script>




</body>

</html>
