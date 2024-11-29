@extends('admin.layouts.layout')

@section('admin_page_title')
    User-Admin
@endsection

@section('admin_layout')
    <style>
        #myFile {
            display: none;
        }

        .select-file-btn {
            display: inline-block;
            padding: 10px 30px;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
    <div class="wg-box">
        <h3>Personal information</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                {{-- alert alert-warning alert-dismissible fade show --}}
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <form class="form-edit-profile" method="POST" enctype="multipart/form-data" action="{{ route('user.update') }}">
            @csrf
            @method('PUT')
            <div class="wg-box">

                <div class="row">
                    <!-- Thẻ div chứa ảnh đại diện nằm bên phải -->
                    <div class="col-md-2" style="padding-right:20px ">
                        <fieldset class="profile-image">
                            <div class="upload-image">
                                <div class="item profile-img-preview-container" id="imgpreview"
                                    style="border: 2px dashed #1865e1; padding: 10px; display: inline-block;width: 200px;height: 250px;">
                                    <img id="previewImage"
                                        src="{{ $user->profile_image ? Storage::url($user->profile_image) : 'default-image.jpg' }}"
                                        class="effect8 full-image" alt="Preview Image"
                                        style="width: 100%; height: 100%; object-fit: cover;" />

                                </div>
                            </div>


                            <div class="download-photos tf-button style-1" style="margin-top: 10px">
                                <label for="myFile" class="select-file-btn">Select File</label>

                                <input type="file" id="myFile" name="image" accept="image/*"
                                    onchange="previewFile()">
                            </div>
                        </fieldset>

                    </div>

                    <div class="col-md-10">
                        <fieldset class="name">
                            <div class="body-title mb-10">Full Name <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" name="name" value="{{ auth()->user()->name }}" required>
                        </fieldset>

                        <fieldset class="phone-number">
                            <div class="body-title mb-10">Phone Number <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" name="phone_number"
                                value="{{ auth()->user()->phone_number }}">
                        </fieldset>


                        <!-- Giới tính -->
                        <fieldset class="gender">
                            <div class="body-title mb-10">Gender <span class="tf-color-1">*</span></div>
                            <select name="gender" class="mb-10">
                                <option value="male" {{ auth()->user()->gender == 'male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="female" {{ auth()->user()->gender == 'female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="other" {{ auth()->user()->gender == 'other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </fieldset>

                    </div>
                </div>


                <!-- Email người dùng -->
                <fieldset class="email">
                    <div class="body-title mb-10">Email <span class="tf-color-1">*</span></div>
                    <input class="mb-10" type="email" name="email" value="{{ auth()->user()->email }}" required>
                </fieldset>

                <!-- Địa chỉ -->
                <fieldset class="address">
                    <div class="body-title mb-10">Address <span class="tf-color-1">*</span></div>
                    <input class="mb-10" type="text" name="address" value="{{ auth()->user()->address }}">
                </fieldset>

                <div class="cols gap10">
                    <button class="tf-button w-full tf-button style-1 " type="submit">Update Profile</button>
                </div>
            </div>
        </form>

    </div>
    <div class="wg-box mt-5">
        <h3>Change Password</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                {{-- alert alert-warning alert-dismissible fade show --}}
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        <form action="{{ route('user.change_password') }}" method="POST">
            @csrf
            @method('PUT')
            <fieldset class="form-group">
                <div class="body-title mb-10">Current Password <span class="tf-color-1">*</span></div>
                <input class="form-control mb-10" type="password" placeholder="Enter current password"
                    name="current_password" required>
            </fieldset>

            <fieldset class="form-group mt-3">
                <div class="body-title mb-10">New Password <span class="tf-color-1">*</span></div>
                <input class="form-control mb-10" type="password" placeholder="Enter new password" name="new_password"
                    required>
            </fieldset>

            <fieldset class="form-group mt-3">
                <div class="body-title mb-10">Confirm New Password <span class="tf-color-1">*</span></div>
                <input class="form-control mb-10" type="password" placeholder="Confirm new password" name="confirm_password"
                    required>
            </fieldset>

            <div class="form-group mt-5 d-flex justify-content-end">
                <button type="submit" class="btn btn-primary tf-button style-1 w208">Update Password</button>
            </div>

        </form>
    </div>

    <script>
        function previewFile() {
            const file = document.getElementById('myFile').files[0];
            if (file) {
                console.log('File đã chọn:', file.name);
            }
        }
    </script>
@endsection
