@extends('admin.layouts.layout')

@section('admin_page_title')
    Manager Promotions - Admin
@endsection

@section('admin_layout')
    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search" method="GET" action="{{ route('promotions.manage') }}">


                    <fieldset class="status">
                        <select name="status" aria-required="true">
                            <option value="">Select Status</option>
                            <option value="In Stock" {{ request('status') == 'In Stock' ? 'selected' : '' }}>In Stock
                            </option>
                            <option value="Out of Stock" {{ request('status') == 'Out of Stock' ? 'selected' : '' }}>Out of
                                Stock</option>
                        </select>
                    </fieldset>

                    <div class="button-submit">
                        <button type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>

            <a class="tf-button style-1 w208" href="{{ route('promotions.create') }}">
                <i class="icon-plus"></i>Add new
            </a>
        </div>
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form action="{{ route('promotions.manage') }}" method="GET" class="form-inline">
            <label for="per_page" style="font-size: 2em; margin: 5px 10px;">Show</label>
            <select name="per_page" id="per_page" class="body-title mb-10" style="width: auto; display: inline-block;"
                onchange="this.form.submit()">
                <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
            </select>
        </form>


        <!-- Table to display the promotions -->
        <div class="wg-table table-all-user" style="overflow-y: auto; max-height: 500px;">
            <table class="table table-striped table-bordered" style="text-align: center; width: 100%;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 100px;">Img</th>
                        <th>Code</th>
                        <th>Discount</th>
                        {{-- <th>SKU</th>
                        <th>Category</th> --}}
                        <th>Status</th>
                        <th>Expiry Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($promotions as $promotion)
                        <tr>
                            <td>{{ $promotion->id }}</td>
                            <td style="width: 50px;">
                                <div class="image"
                                    style="display: flex; justify-content: center; align-items: center; margin: 0 auto; overflow: hidden;">
                                    @if ($promotion->promotion_img)
                                        <img src="{{ asset('storage/' . $promotion->promotion_img) }}" alt="Product Image"
                                            style="width: 100%; height: 100%; object-fit: contain;">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $promotion->code }}</td>
                            <td>
                                {{ $promotion->discount }}
                                @if ($promotion->type == 'percentage')
                                    %
                                @elseif ($promotion->type == 'fixed')
                                    $
                                @endif
                            </td>

                            {{-- <td>{{ $promotion->sku }}</td>
                            <td>{{ $promotion->category_id ?? 'N/A' }}</td> --}}
                            <td>{{ $promotion->status }}</td>
                            <td>{{ $promotion->expiry_date }}</td>


                            <td>
                                <div class="list-icon-function"
                                    style="align-items: center;text-align: center; justify-items: center;justify-content: center">
                                    <a href="{{ route('promotions.show', $promotion->id) }}">
                                        <div class="item view">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </a>

                                    <a href="{{ route('promotions.edit', $promotion->id) }}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>
                                    <form action="{{ route('promotions.destroy', $promotion->id) }}" method="POST"
                                        onsubmit="return confirmDeletePromotions()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item text-danger delete">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>
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
            <!-- Display pagination links -->
            {{ $promotions->appends(request()->query())->links() }}

            <!-- Display current page and total pages -->
            <div>
                <p>
                    Page {{ $promotions->currentPage() }} of {{ $promotions->lastPage() }}
                </p>
            </div>
        </div>
    </div>
@endsection
<script>
    function confirmDeletePromotions() {
        return confirm('Are you sure you want to delete this Promotions? This action cannot be undone.');
    }
</script>
