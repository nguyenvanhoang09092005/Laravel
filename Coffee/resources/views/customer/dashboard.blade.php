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


    @include('customer.header')
    <div class="content">
        @yield('customer_content')
    </div>
    @include('customer.footer')

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
