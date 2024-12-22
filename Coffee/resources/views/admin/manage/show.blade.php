@extends('admin.layouts.layout')

@section('admin_page_title')
    User Details - {{ $user_info->name }}
@endsection

@section('admin_layout')
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

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fff;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: left;
            position: relative;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .modal-header .modal-title {
            font-size: 18px;
            font-weight: bold;
            margin: 0;
            color: #333;
        }

        .modal-header .close {
            color: #aaa;
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            background: none;
            border: none;
            padding: 0;
        }

        .modal-header .close:hover {
            color: #000;
        }

        .modal-body {
            margin-bottom: 20px;
        }

        .modal-body label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .modal-body select {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .modal-footer {
            text-align: right;
            padding-top: 10px;
            border-top: 1px solid #ddd;
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
                                        <button class="edit-btn btn btn-secondary tf-button style-1 text-end"
                                            onclick="openModal()">Sửa</button>

                                    </div>
                                    <!-- Modal -->
                                    <div id="editRoleModal" class="modal">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title">Sửa Vai Trò</h3>
                                                <span class="close" onclick="closeModal()">&times;</span>
                                            </div>
                                            <form id="editRoleForm" action="{{ route('admin.update.role') }}"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ $user_info->id }}">
                                                <div class="modal-body">
                                                    <label for="role">Chọn vai trò:</label>
                                                    <select name="role" id="role">
                                                        <option value="1"
                                                            {{ $user_info->role == 1 ? 'selected' : '' }}>Admin</option>
                                                        <option value="2"
                                                            {{ $user_info->role == 2 ? 'selected' : '' }}>Customer</option>
                                                        <option value="3"
                                                            {{ $user_info->role == 3 ? 'selected' : '' }}>Seller</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit"
                                                        class="btn btn-primary tf-button style-1 text-end">Cập nhật</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Back Button -->

            <div class="mt-4 d-flex justify-content-end">
                <a href="{{ route('admin.manage.user') }}" class="btn btn-secondary tf-button style-1 w308 text-end"><i
                        class="bi bi-arrow-left"></i> Back to
                    User List</a>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function openModal() {
                document.getElementById("editRoleModal").style.display = "flex";
            }

            function closeModal() {
                document.getElementById("editRoleModal").style.display = "none";
            }

            document.querySelector(".edit-btn").addEventListener("click", openModal);

            document
                .querySelector(".modal .close")
                .addEventListener("click", closeModal);

            window.onclick = function(event) {
                const modal = document.getElementById("editRoleModal");
                if (event.target == modal) {
                    closeModal();
                }
            };

            window.closeModal = closeModal;
        });
    </script>
@endsection
