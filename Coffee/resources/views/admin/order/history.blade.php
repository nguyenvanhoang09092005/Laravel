    @extends('admin.layouts.layout')
    @section('admin_page_title')
        Order History-Admin
    @endsection

    @section('admin_layout')
        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <form class="form-search" id="search-form" action="{{ route('Admin.Order.History') }}" method="GET">
                        <fieldset class="name">
                            <input type="text" id="search-orders" placeholder="Search orders..." name="name"
                                value="{{ request('name') }}" required>
                        </fieldset>
                        <div class="button-submit">
                            <button type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>

                </div>

                <div id="product-results"
                    style="position: absolute; max-height: 200px; overflow-y: auto; background-color: white; border: 1px solid #ccc; display: none;">
                </div>
            </div>
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Dropdown to select number of rows per page -->
            <form action="{{ route('Admin.Order.History') }}" method="GET" class="form-inline">
                <label for="per_page" style="font-size: 2em; margin: 5px 10px;">Show</label>
                <select name="per_page" id="per_page" class="body-title mb-10" style="width: auto; display: inline-block;"
                    onchange="this.form.submit()">
                    <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>


            <!-- Scrollable table container -->
            <div class="wg-table table-all-order" style="overflow-y: auto; max-height: 500px;">
                <table class="table table-striped table-bordered" style="text-align: center; width: 100%;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Subtotal</th>
                            <th>Discount</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Order Date</th>
                            <th>Total Items</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name ?? 'N/A' }}</td>
                                <td>{{ $order->shippingAddress->phone ?? 'N/A' }}</td>
                                <td>{{ number_format($order->total_price_without_discount, 0, ',', '.') }}</td>
                                <td>{{ number_format($order->total_discount, 0, ',', '.') }}</td>
                                <td>{{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td>
                                    <span class="status-label {{ strtolower($order->status) }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td>{{ $order->created_at->format('Y-m-d') }}</td>
                                <td>{{ $order->items_count ?? '0' }}</td>
                                <td>
                                    <div class="list-icon-function" style=" justify-content: center; align-items: center;">
                                        <a href="{{ route('Admin.Order.Detail', $order->id) }}">
                                            <i class="icon-eye"></i>
                                        </a>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{ $orders->appends(['per_page' => $perPage])->links() }}
                <div>
                    <p>Page {{ $orders->currentPage() }} of {{ $orders->lastPage() }}</p>
                </div>
            </div>



        </div>
    @endsection
