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

    @media (max-width: 991px) {
        .icon_account {
            display: none !important;
        }

    }

    .mobile-only {
        display: none;
    }

    @media (max-width: 991px) {
        .mobile-only {
            display: block;
        }
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
                <li><a class="nav-link scrollto" href="{{ route('Customer.Contact') }}">Contact</a></li>

                @auth
                    <li class="mobile-only"><a href="{{ route('Customer.Account.Order') }}">Trang cá nhân</a></li>
                    <li class="mobile-only">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="mobile-only"><a href="{{ route('login') }}">Login</a></li>
                    @if (Route::has('register'))
                        <li class="mobile-only"><a href="{{ route('register') }}">Register</a></li>
                    @endif
                @endauth

            </ul>
            <div class="d-flex align-items-center ms-3 cart-items-header">
                <a href="{{ route('Customer.Cart.View') }}" class="header-tools__item header-tools__cart">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        class="bi bi-cart3" viewBox="0 0 16 16">
                        <path
                            d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                    </svg>
                    <span id="cart-count" class="cart-amount d-block position-absolute js-cart-items-count">
                        0
                    </span>

                </a>
            </div>

            <i class="bi bi-list mobile-nav-toggle"></i>

            <!-- Right-side Menu -->
            <div class="icon_account d-flex align-items-center ms-5">
                <!-- Search Input -->
                <form action="{{ route('Customer.products.search') }}" method="GET">
                    <input type="text" class="form-control search mt-2 me-5" placeholder="Search" name="query"
                        style="max-width: 200px;">
                    <button type="submit" style="display: none;"></button>
                </form>

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
                        @auth
                            <li><span class="dropdown-item-text px-4 py-2"
                                    style="font-size: 12px; font-weight: bold; color: #333;"><b>Welcome,
                                        {{ Auth::user()->name }}</b></span>
                            </li>


                            <li><a class="dropdown-item px-4 py-2 hover:bg-gray-100"
                                    href="{{ route('Customer.Account.Order') }}">Trang
                                    cá nhân</a></li>


                            <li>
                                <a class="dropdown-item px-4 py-2 hover:bg-gray-100" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @else
                            <li><a class="dropdown-item px-4 py-2 hover:bg-gray-100" href="{{ route('login') }}">Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li><a class="dropdown-item px-4 py-2 hover:bg-gray-100"
                                        href="{{ route('register') }}">Register</a></li>
                            @endif
                        @endauth
                    </ul>
                </div>
            </div>

        </nav>
    </div>
</header>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch("{{ route('Customer.cart.count') }}")
            .then(response => response.json())
            .then(data => {
                document.getElementById("cart-count").textContent = data.count;
            })
            .catch(error => console.error('Error fetching cart count:', error));
    });

    document.querySelector('.mobile-nav-toggle').addEventListener('click', function() {
        const navbar = document.querySelector('.navbar-mobile');
        navbar.classList.toggle('open');
    });
</script>
