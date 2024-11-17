<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coffee Da Cuoi</title>

    <!-- Vendor CSS Files -->
    <link href="{{ asset('admin_asset/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_asset/css/main.css') }}" rel="stylesheet">

</head>

<body>
    @include('partials.header')
    <div class="content">
        @include('pages.banner')
        @include('pages.about')
    </div>
    @include('partials.footer')

    <!-- Vendor JS Files -->
    <script src="{{ asset('admin_asset/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('admin_asset/vendor/php-email-form/validate.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="{{ asset('admin_asset/js/script.js') }}"></script>
</body>

</html>
