@extends('admin.layouts.layout')
@section('admin_page_title')
    Manager Product - Admin
@endsection
@section('admin_layout')
    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search" id="search-form" action="{{ route('product.manage') }}" method="GET">
                    <fieldset class="name">
                        <input type="text" id="search-products" placeholder="Search here..." class="" name="name"
                            value="{{ request('name') }}" aria-required="true" required="">

                    </fieldset>
                </form>

            </div>

            <div id="product-results"
                style="position: absolute; max-height: 200px; overflow-y: auto; background-color: white; border: 1px solid #ccc; display: none;">
            </div>

            <a class="tf-button style-1 w208" href="{{ route('product.create') }}"><i class="icon-plus"></i>Add new</a>
        </div>

        <!-- Dropdown to select number of rows per page -->
        <form action="{{ route('product.manage') }}" method="GET" class="form-inline">
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
        <div class="wg-table table-all-user" style="overflow-y: auto; max-height: 500px; ">
            <table class="table table-striped table-bordered" style="text-align: center; width: 100%;">
                <thead>
                    <tr>
                        <th style="width: 100px;">#</th>
                        <th style="width: 100px;">Img</th>
                        <th>Name</th>
                        <th style="width: 100px;">Attributes</th>
                        <th>Regular_price</th>
                        <th>Discounted_price</th>
                        <th>Stock_quantity</th>
                        <th>stock_status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td style="width: 50px;">{{ $product->id }}</td>
                            <td style="width: 50px;">
                                <div class="image"
                                    style="display: flex; justify-content: center; align-items: center; margin: 0 auto; overflow: hidden;">
                                    @if ($product->product_img)
                                        <img src="{{ asset('storage/' . $product->product_img) }}" alt="Product Image"
                                            style="width: 100%; height: 100%; object-fit: contain;">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $product->product_name }}</td>
                            <td style="width: 50px;">
                                {{ $product->attribute ? $product->attribute->attribute_value : 'No Attribute' }}</td>
                            <td>{{ $product->regular_price }}</td>
                            <td>
                                @if ($product->discounted_price)
                                    {{ number_format($product->discounted_price, 0, ',', '.') }} đ
                                @else
                                    N/A
                                @endif
                            </td>

                            <td>{{ $product->stock_quantity }}</td>
                            <td>{{ $product->stock_status }}</td>
                            <td>
                                <div class="list-icon-function"
                                    style="align-items: center;text-align: center; justify-items: center;justify-content: center">
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <div class="item view">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </a>

                                    <a href="{{ route('product.edit', $product->id) }}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>
                                    <form action="{{ route('product.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirmDeleteProduct()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item text-danger delete">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                            <script>
                                function confirmDeleteProduct() {
                                    return confirm('Are you sure you want to delete this Product? This action cannot be undone.');
                                }
                            </script>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination links -->
        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            {{ $products->appends(['per_page' => $perPage])->links() }}
            <div>
                <p>
                    Page {{ $products->currentPage() }} of {{ $products->lastPage() }}
                </p>
            </div>
        </div>
    </div>
@endsection
<script>
    document.getElementById('search-products').addEventListener('keyup', function(event) {
        let query = this.value;

        if (query.length > 2) { // Trigger search after 3 characters
            fetch("{{ route('search.products') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        query: query
                    })
                })
                .then(response => response.json())
                .then(data => {
                    let results = '';

                    // Show suggestions
                    if (data.length > 0) {
                        data.forEach(product => {
                            results += `
                        <div class="suggestion-item">
                            <p>
                                <strong>${product.product_name}</strong> - ${product.regular_price} USD
                            </p>
                        </div>
                    `;
                        });
                    } else {
                        results = '<p>No products found.</p>';
                    }

                    // Display the suggestions in the container
                    document.getElementById('product-results').innerHTML = results;
                    document.getElementById('product-results').style.display = 'block'; // Show results
                });
        } else {
            document.getElementById('product-results').innerHTML =
                ''; // Clear suggestions if less than 3 characters
            document.getElementById('product-results').style.display = 'none'; // Hide results
        }
    });
</script>
