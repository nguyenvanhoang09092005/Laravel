@extends('admin.layouts.layout')
@section('admin_page_title')
    Manager Product - Admin
@endsection
@section('admin_layout')
    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search">
                    <fieldset class="name">
                        <input type="text" placeholder="Search here..." class="" name="name" tabindex="2"
                            value="" aria-required="true" required="">
                    </fieldset>
                    <div class="button-submit">
                        <button class="" type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            <a class="tf-button style-1 w208" href="{{ route('product.create') }}"><i class="icon-plus"></i>Add new</a>
        </div>
        <div class="wg-table table-all-user">
            <table class="table table-striped table-bordered" style="text-align: center;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Img</th>
                        <th>Name</th>
                        {{-- <th>Sku</th> --}}
                        {{-- <th>Slug</th> --}}
                        <th>Attributes</th>
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
                            <td>{{ $product->id }}</td>
                            <td class="pname" style="text-align: center; vertical-align: middle;">
                                <div class="image"
                                    style="display: flex; justify-content: center; align-items: center;  margin: 0 auto; overflow: hidden;">
                                    @if ($product->product_img)
                                        <img src="{{ asset('storage/' . $product->product_img) }}" alt="Product Image"
                                            style="width: 100%; height: 100%; object-fit: contain;">
                                    @else
                                        <span style="text-align: center;">No Image</span>
                                    @endif
                                </div>
                            </td>


                            <td>{{ $product->product_name }}</td>
                            {{-- <td>{{ $product->sku }}</td> --}}
                            {{-- <td>{{ $product->slug }}</td> --}}
                            <td>{{ $product->attribute ? $product->attribute->attribute_value : 'No Attribute' }}</td>
                            <td>{{ $product->regular_price }}</td>
                            <td>{{ $product->discounted_price }}</td>
                            <td>{{ $product->stock_quantity }}</td>
                            <td>{{ $product->stock_status }}</td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="{{ route('product.show', $product->id) }}">
                                        <div class="item view">
                                            <i class="icon-eye"></i> <!-- Icon tùy chọn cho nút xem chi tiết -->
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
        <div class="divider"></div>
        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
            {{-- Pagination if needed --}}
        </div>
    </div>
@endsection
