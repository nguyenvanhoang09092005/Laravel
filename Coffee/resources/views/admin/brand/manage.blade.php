@extends('admin.layouts.layout')
@section('admin_page_title')
    Manager Category - Admin
@endsection
@section('admin_layout')
    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search">
                    <fieldset class="name">
                        <input type="text" placeholder="Search here..." class="" name="name" id="search-input"
                            tabindex="2" value="" aria-required="true" required="">
                    </fieldset>
                    <div class="button-submit">
                        <button class="" type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>
            <a class="tf-button style-1 w208" href="{{ route('brand.create') }}"><i class="icon-plus"></i>Add new</a>
        </div>
        <div class="wg-table table-all-user">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Img</th>
                        <th>Name</th>
                        <th>Describe</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td class="pname" style="text-align: center; vertical-align: middle;">
                                <div class="image"
                                    style="display: flex; justify-content: center; align-items: center;  margin: 0 auto; overflow: hidden;">
                                    @if ($brand->brand_logo)
                                        <img src="{{ asset('storage/' . $brand->brand_logo) }}" alt="Brand Image"
                                            style="width: 100%; height: 100%; object-fit: contain;">
                                    @else
                                        <span style="text-align: center;">No Image</span>
                                    @endif
                                </div>
                            </td>


                            <td>{{ $brand->brand_name }}</td>
                            <td>{{ $brand->describe }}</td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="{{ route('show.brand', $brand->id) }}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>
                                    <form action="{{ route('brand.destroy', $brand->id) }}" method="POST"
                                        onsubmit="return confirmDelete2()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item text-danger delete">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>

                            <script>
                                function confirmDelete2() {
                                    return confirm('Are you sure you want to delete this brand? This action cannot be undone.');
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
