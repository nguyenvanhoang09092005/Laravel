<ul class="account-nav">
    <li><a href="{{ route('Customer.Account.Detail') }}" class="menu-link menu-link_us-s ">Dashboard</a>
    </li>
    <li><a href="{{ route('Customer.Account.Address.Manage') }}" class="menu-link menu-link_us-s ">Addresses</a></li>
    <li><a href="{{ route('Customer.Account.Order') }}" class="menu-link menu-link_us-s ">Order</a></li>
    <li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
            <a class="dropdown-item px-4 py-2 hover:bg-gray-100" href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>
        </form>
</ul>
