@extends('seller.layouts.layout');
@section('seller_page_title')
    User Details - {{ $user_info->name }}
@endsection

@section('seller_layout')
    <style>
        .user-single__details-tab {
            margin: 0 auto 2.375rem;
            margin-top: 5px;
            max-width: 58.125rem;
        }

        .user-single__details-tab>.tab-content {
            padding: 2rem 0;
        }

        .user-single__info {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 20px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            background-color: #f9f9f9;
            max-width: 900px;
            margin: 0 auto;
            font-family: Arial, sans-serif;
        }

        .user-single__info .item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .user-single__info .item:last-child {
            border-bottom: none;
        }

        .user-single__info p {
            margin: 0;
            font-size: 14px;
            color: #333;
        }

        .user-single__info p strong {
            font-weight: bold;
            color: #555;
        }

        .nav-tabs {
            justify-content: center;
            text-transform: uppercase;
            background-color: #fff;
            padding: 10px;
            border-radius: 8px;
        }

        .nav-tabs .nav-link {
            color: #333;
            background-color: transparent;
            border: none;
            font-weight: bold;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-tabs .nav-link:hover {
            background-color: #e9ecef;
            color: #495057;
            border-radius: 5px;
        }

        .nav-tabs .nav-link.active {
            color: #007bff;
            background-color: rgba(0, 123, 255, 0.1);
            border-radius: 5px;
            text-shadow: 0px 1px 3px rgba(0, 0, 0, 0.4);
        }

        @media (max-width: 768px) {
            .user-single__info {
                max-width: 100%;
                padding: 15px;
            }

            .user-single__info .item {
                flex-direction: column;
                align-items: flex-start;
            }

            .user-single__info p {
                font-size: 13px;
            }
        }
    </style>
    <div class="wg-box">
        <div class="container mt-4">

            <div class="row">
                <!-- User Image -->

                <div class="col-md-4 mt-5">
                    <div class="user-image mb-3 text-center">
                        @if ($user_info->profile_image)
                            <img src="{{ asset('storage/' . $user_info->profile_image) }}  " alt="User Image"
                                class="img-fluid rounded"
                                style="height: 410px; width: 450px; image-rendering: auto;
        image-rendering: crisp-edges;
        image-rendering: pixelated;">
                        @else
                            <span class="text-muted">No Image Available</span>
                        @endif
                    </div>
                </div>

                <!-- User Info -->
                <div class="col-md-8">
                    <div class="user-single__details-tab">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-user-info" role="tabpanel"
                                aria-labelledby="tab-user-info-tab">
                                <div class="user-single__info">
                                    <div class="item">
                                        <p><strong>ID:</strong> {{ $user_info->id }}</p>
                                    </div>
                                    <div class="item">
                                        <p><strong>Name:</strong> {{ $user_info->name }}</p>
                                    </div>
                                    <div class="item">
                                        <p><strong>Email:</strong> {{ $user_info->email }}</p>
                                    </div>
                                    <div class="item">
                                        <p><strong>Address:</strong> {{ $user_info->address }}</p>
                                    </div>
                                    <div class="item">
                                        <p><strong>Phone Number:</strong> {{ $user_info->phone_number }}</p>
                                    </div>
                                    <div class="item">
                                        <p><strong>Gender:</strong> {{ ucfirst($user_info->gender) }}</p>
                                    </div>
                                    <div class="item">
                                        <p><strong>Role:</strong>
                                            @if ($user_info->role == 1)
                                                Admin
                                            @elseif ($user_info->role == 2)
                                                Customer
                                            @elseif ($user_info->role == 3)
                                                Seller
                                            @else
                                                Unknown
                                            @endif
                                        </p>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Back Button -->

            <div class="mt-4 d-flex justify-content-end">
                <a href="{{ route('Personnel.Manage.User') }}" class="btn btn-secondary tf-button style-1 w308 text-end"><i
                        class="bi bi-arrow-left"></i> Back to
                    User List</a>
            </div>
        </div>
    </div>
@endsection
