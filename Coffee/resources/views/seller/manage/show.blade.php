@extends('seller.layouts.layout');
@section('seller_page_title')
    User Details - {{ $user_info->name }}
@endsection

@section('seller_layout')
    <div class="container mt-4">
        <h3 class="mb-4">{{ $user_info->name }}</h3>

        <div class="row">
            <!-- User Image -->
            <div class="col-md-4">
                <div class="user-image mb-3 text-center">
                    @if ($user_info->profile_image)
                        <img src="{{ asset('storage/' . $user_info->profile_image) }}" alt="User Image"
                            class="img-fluid rounded">
                    @else
                        <span class="text-muted">No Image Available</span>
                    @endif
                </div>
            </div>

            <!-- User Info -->
            <div class="col-md-8">
                <div class="user-info">
                    <p><strong>ID:</strong> {{ $user_info->id }}</p>
                    <p><strong>Name:</strong> {{ $user_info->name }}</p>
                    <p><strong>Email:</strong> {{ $user_info->email }}</p>
                    <p><strong>Address:</strong> {{ $user_info->address }}</p>
                    <p><strong>Phone Number:</strong> {{ $user_info->phone_number }}</p>
                    <p><strong>Gender:</strong> {{ ucfirst($user_info->gender) }}</p>
                    <p><strong>Role:</strong> {{ $user_info->role }}</p>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-4">
            <a href="{{ route('admin.manage.user') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Back to
                User
                List</a>
        </div>
    </div>
@endsection
