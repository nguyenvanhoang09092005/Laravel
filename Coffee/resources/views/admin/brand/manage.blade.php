@extends('admin.layouts.layout')
@section('admin_page_title')
    Manager Category - Admin
@endsection

@section('admin_layout')
    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search" id="search-form" action="{{ route('brand.manage') }}" method="GET">
                    <fieldset class="name">
                        <input type="text" id="search-brands" placeholder="Search here..." name="name"
                            value="{{ request('name') }}" aria-required="true" required="">
                    </fieldset>
                    <div class="button-submit">
                        <button class="" type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>
            </div>

            <div id="brand-results"
                style="position: absolute; max-height: 200px; overflow-y: auto; background-color: white; border: 1px solid #ccc; display: none;">
            </div>

            <a class="tf-button style-1 w208" href="{{ route('brand.create') }}"><i class="icon-plus"></i>Add new</a>
        </div>

        <div class="wg-table table-all-user">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th style="width: 100px;">Img</th>
                        <th>Name</th>
                        <th>Describe</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td style="width: 50px;">
                                <div class="image"
                                    style="display: flex; justify-content: center; align-items: center; margin: 0 auto; overflow: hidden;">
                                    @if ($brand->brand_logo)
                                        <img src="{{ asset('storage/' . $brand->brand_logo) }}" alt="Brand Image"
                                            style="width: 100%; height: 100%; object-fit: contain;">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </div>
                            </td>

                            <td>{{ $brand->brand_name }}</td>
                            <td>{{ $brand->describe }}</td>
                            <td>
                                <div class="list-icon-function"
                                    style="align-items: center;text-align: center; justify-items: center;justify-content: center">
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
