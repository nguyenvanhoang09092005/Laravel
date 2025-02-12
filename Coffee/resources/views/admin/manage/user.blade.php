@extends('admin.layouts.layout')

@section('admin_page_title')
    Manager User - Admin
@endsection

@section('admin_layout')
    <div class="wg-box">
        <div class="flex items-center justify-between gap10 flex-wrap">
            <div class="wg-filter flex-grow">
                <form class="form-search" id="search-form" action="{{ route('admin.manage.user') }}" method="GET">
                    <fieldset class="name">
                        <input type="text" id="search-users" placeholder="Search users..." name="name"
                            value="{{ request('name') }}" required>
                    </fieldset>
                    <div class="button-submit">
                        <button type="submit"><i class="icon-search"></i></button>
                    </div>
                </form>

            </div>

            <div id="user-results"
                style="position: absolute; max-height: 200px; overflow-y: auto; background-color: white; border: 1px solid #ccc; display: none;">
            </div>
            <a class="tf-button style-1 w208" href="{{ route('admin.manage.create') }}">
                <i class="icon-plus"></i>Add new
            </a>
        </div>
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Dropdown to select number of rows per page -->
        <form action="{{ route('admin.manage.user') }}" method="GET" class="form-inline">
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
                        <th>#</th>
                        <th style="width: 100px;">Img</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Gender</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td style="width: 50px;">
                                <div class="image"
                                    style="display: flex; justify-content: center; align-items: center; margin: 0 auto; overflow: hidden;">
                                    @if ($user->profile_image)
                                        <img src="{{ asset('storage/' . $user->profile_image) }}" alt="User Image"
                                            style="width: 100%; height: 100%; object-fit: contain;">
                                    @else
                                        <span>No Image</span>
                                    @endif
                                </div>
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>
                                @if ($user->role == 1)
                                    Admin
                                @elseif ($user->role == 2)
                                    Customer
                                @elseif ($user->role == 3)
                                    Seller
                                @else
                                    Unknown
                                @endif
                            </td>

                            <td>
                                <div class="list-icon-function"
                                    style="align-items: center;text-align: center; justify-items: center;justify-content: center">
                                    <a href="{{ route('manage.show', $user->id) }}">
                                        <div class="item view">
                                            <i class="icon-eye"></i>
                                        </div>
                                    </a>
                                    {{-- <a href="{{ route('admin.manage.edit', $user->id) }}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a> --}}
                                    <form action="{{ route('manage.destroy', $user->id) }}" method="POST"
                                        onsubmit="return confirmDeleteUser()">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="item text-danger delete">
                                            <i class="icon-trash-2"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                            <script>
                                function confirmDeleteUser() {
                                    return confirm('Are you sure you want to delete this User? This action cannot be undone.');
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
            <!-- Display pagination links -->
            {{ $users->appends(['per_page' => $perPage])->links() }}

            <!-- Display current page and total pages -->
            <div>
                <p>
                    Page {{ $users->currentPage() }} of {{ $users->lastPage() }}
                </p>
            </div>
        </div>

    </div>
@endsection
