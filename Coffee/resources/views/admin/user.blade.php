@extends('admin.layouts.layout')
@section('admin_page_title')
    User-Admin
@endsection
@section('admin_layout')
    <section class="pages my-account-page section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white text-center">
                            <h3><strong>Tài khoản của tôi</strong></h3>
                        </div>
                        <div class="accordion" id="accountAccordion">
                            <!-- Thông tin cá nhân -->
                            <div class="card">
                                <div class="card-header" id="personalInfoHeader">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link text-primary" type="button" data-toggle="collapse"
                                            data-target="#personalInfo" aria-expanded="true" aria-controls="personalInfo">
                                            Thông tin cá nhân
                                        </button>
                                    </h5>
                                </div>

                                <div id="personalInfo" class="collapse show" aria-labelledby="personalInfoHeader"
                                    data-parent="#accountAccordion">
                                    <div class="card-body">
                                        <form action="{{ route('user.update') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="name">Tên</label>
                                                <input type="text" class="form-control" id="name" name="name"
                                                    placeholder="Tên đầy đủ" required
                                                    value="{{ old('name', $user->name) }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="gender">Giới tính</label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option {{ $user->gender == 'Male' ? 'selected' : '' }} value="Male">
                                                        Nam</option>
                                                    <option {{ $user->gender == 'Female' ? 'selected' : '' }}
                                                        value="Female">Nữ</option>
                                                    <option {{ $user->gender == 'Other' ? 'selected' : '' }} value="Other">
                                                        Khác</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Địa chỉ Email" required
                                                    value="{{ old('email', $user->email) }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="phone_number">Số điện thoại</label>
                                                <input type="text" class="form-control" id="phone_number"
                                                    name="phone_number" placeholder="Số điện thoại" required
                                                    pattern="[0-9]+" minlength="10"
                                                    value="{{ old('phone_number', $user->phone_number) }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="address">Địa chỉ</label>
                                                <input type="text" class="form-control" id="address" name="address"
                                                    placeholder="Địa chỉ" required
                                                    value="{{ old('address', $user->address) }}">
                                            </div>

                                            <div class="form-group">
                                                <label for="image">Ảnh đại diện</label>
                                                <input type="file" class="form-control-file" id="image"
                                                    name="image">
                                            </div>

                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-primary">Lưu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Đổi mật khẩu -->
                            <div class="card mt-3">
                                <div class="card-header" id="changePasswordHeader">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link text-primary collapsed" type="button"
                                            data-toggle="collapse" data-target="#changePassword" aria-expanded="false"
                                            aria-controls="changePassword">
                                            Đổi mật khẩu
                                        </button>
                                    </h5>
                                </div>
                                <div id="changePassword" class="collapse" aria-labelledby="changePasswordHeader"
                                    data-parent="#accountAccordion">
                                    <div class="card-body">
                                        <form action="{{ route('user.change_password') }}" method="post">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="current_password">Mật khẩu hiện tại</label>
                                                <input type="password" class="form-control" id="current_password"
                                                    name="current_password" placeholder="Mật khẩu hiện tại" minlength="6"
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="new_password">Mật khẩu mới</label>
                                                <input type="password" class="form-control" id="new_password"
                                                    name="new_password" placeholder="Mật khẩu mới">
                                            </div>
                                            <div class="form-group">
                                                <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                                                <input type="password" class="form-control"
                                                    id="new_password_confirmation" name="new_password_confirmation"
                                                    placeholder="Xác nhận mật khẩu mới">
                                            </div>
                                            <div class="form-group text-center">
                                                <button type="submit" class="btn btn-primary">Lưu</button>
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
    </section>
@endsection
