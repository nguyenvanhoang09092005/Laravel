@extends('customer.dashboard')

@section('customer_content')
    <style>
        #myFile {
            display: none;
        }

        .select-file-btn {
            display: inline-block;
            padding: 5px 10px;
            width: 135px;
            font-size: 16px;
            color: #fff;
            background: linear-gradient(45deg, #0943f1, #0051ff);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 8px 15px rgba(0, 119, 255, 0.8), 0 4px 10px rgba(255, 255, 255, 0.6), inset 0 0 10px rgba(255, 255, 255, 0.5);
        }

        .select-file-btn:hover {
            background: linear-gradient(45deg, #0346ff, #0078ff);
            box-shadow: 0 12px 25px rgb(13, 78, 209), 0 6px 15px rgba(255, 255, 255, 0.8), inset 0 0 15px rgba(255, 255, 255, 0.7);
            transform: translateY(-3px);
        }

        .select-file-btn:active {
            transform: translateY(2px);
            box-shadow: 0 6px 10px rgba(0, 123, 255, 0.7), 0 3px 6px rgba(255, 255, 255, 0.5), inset 0 0 8px rgba(255, 255, 255, 0.4);
        }

        .custom-btn {
            background: linear-gradient(45deg, #1904ff, #0925fe);
            color: white;
            border: none;
            box-shadow: 0 5px 10px rgba(0, 119, 255, 0.8), 0 4px 10px rgba(255, 255, 255, 0.6), inset 0 0 10px rgba(255, 255, 255, 0.5);
            transition: all 0.3s ease;
            padding: 10px 15px;
            font-size: 16px;
            border-radius: 8px;
        }

        .custom-btn:hover {
            background: linear-gradient(45deg, #0055ff, #00b4d8);

            box-shadow: 0 20px 40px rgba(0, 123, 255, 0.3), 0 10px 20px rgba(0, 0, 0, 0.2);

            transform: translateY(-5px);
        }

        .custom-btn:active {
            background: #0096c7;
            box-shadow: inset 0 10px 20px rgba(46, 131, 242, 0.3);
            transform: translateY(2px);
        }


        .inputGroup {
            position: relative;
            margin: 10px 0;
        }

        .inputGroup input {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            background-color: white;
            transition: border 0.3s ease-in-out, box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(240, 248, 255, 0.9);
        }

        .inputGroup input:focus {
            border: 1px solid #028af9;
            box-shadow: 0 4px 8px rgba(3, 146, 248, 0.3);
            transform: scale(1.03);
            background-color: rgba(240, 248, 255, 0.9);
        }

        .inputGroup select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            background-color: white;
            transition: border 0.3s ease-in-out, box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(240, 248, 255, 0.9);
            appearance: none;
            /* Loại bỏ kiểu mặc định của trình duyệt */
        }

        .inputGroup select:focus {
            border: 1px solid #028af9;
            box-shadow: 0 4px 8px rgba(3, 146, 248, 0.3);
            transform: scale(1.03);
            background-color: rgba(240, 248, 255, 0.9);
        }

        .inputGroup select:hover {
            border-color: #00a2ff;
            box-shadow: 0 4px 10px rgba(3, 146, 248, 0.2);
            transform: scale(1.01);
        }


        .inputGroup label {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #888;
            font-size: 14px;
            pointer-events: none;
            transition: 0.2s all ease-in-out;

        }

        .inputGroup input:focus~label,
        .inputGroup input:valid~label {
            top: 0;
            font-size: 12px;
            color: #0048ff;
            background-color: white;
            padding: 0 5px;
            left: 5px;
            box-shadow: 0 2px 4px rgba(104, 152, 236, 0.385);
            background-color: white;
        }

        .inputGroup input:hover {
            border-color: #00a2ff;
            box-shadow: 0 4px 10px rgba(3, 146, 248, 0.2);
            transform: scale(1.01);
        }

        .tf-button {
            --Main: #2275fc;
            width: max-content;
            height: 50px;
            padding: 15px 22px;
            color: #2255c5;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-family: "Inter", sans-serif;
            font-size: 14px;
            font-weight: 700;
            line-height: 20px;
            border: 1px solid var(--Main);
            border-radius: 12px;
            background-color: var(--Main);
            background-size: 100%;
            overflow: hidden;
            -webkit-transition: all 0.3s ease;
            -moz-transition: all 0.3s ease;
            -ms-transition: all 0.3s ease;
            -o-transition: all 0.3s ease;
            transition: all 0.3s ease;
        }

        .tf-button:hover {
            --Main: #2275fc;
            color: var(--Main);
            background-color: #fff;
        }

        .tf-button:hover span {
            color: #fff !important;
        }

        .tf-button i {
            font-size: 20px;
        }

        .tf-button.style-1 {
            --Main: #2275fc;
            --White: #fff;
            color: var(--Main);
            background-color: var(--White);
        }

        .tf-button.style-1:hover {
            --Main: #2275fc;
            color: #fff;
            background-color: var(--Main);
        }

        .tf-button.style-2 {
            --Input: #ecf0f4;
            color: #575864;
            background-color: #fff;
            border-color: var(--Input);
        }

        .tf-button.style-2:hover {
            --Main: #2275fc;
            color: #fff;
            background-color: var(--Main);
        }

        .tf-button.w208 {
            width: 208px;
        }

        .tf-button.w230 {
            width: 230px;
        }

        .tf-button.w180 {
            width: 180px;
        }

        .tf-button.w128 {
            width: 128px;
        }

        .tf-button-funtion {
            --Input: #ecf0f4;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1px solid var(--Input);
            border-radius: 12px;
            padding: 14px 21px;
            cursor: pointer;
        }

        .tf-button-funtion i {
            --Body-Text: #575864;
            color: var(--Body-Text);
            font-size: 20px;
        }

        .tf-button-funtion div {
            --Body-Text: #575864;
            color: var(--Body-Text);
        }

        .tf-button-download {
            --Input: #ecf0f4;
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border: 1px solid var(--Input);
            border-radius: 12px;
            cursor: pointer;
        }

        .tf-button-download i {
            color: #000000;
            font-size: 20px;
        }
    </style>

    <section class="my-account container">
        <div class="section-title text-center" style="margin-left: 28%">
            <h2>Thông tin cá nhân</h2>
        </div>
        <div class="row">
            <div class="col-lg-2">
                @include('customer.account.account-nav')
            </div>
            <div class="col-lg-9 ">
                <div class="page-content my-account__edit">
                    <div class="my-account__edit-form">
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
                        <form name="account_edit_form" action="{{ route('Customer.user.update') }}" method="POST"
                            enctype="multipart/form-data" class="needs-validation" novalidate="">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-2 mb-4 text-center">
                                    <div class="profile-image">
                                        <div class="upload-image">
                                            <div class="item profile-img-preview-container" id="imgpreview"
                                                style="border: 2px dashed #1865e1; padding: 10px; display: inline-block;width: 150px;height: 200px;">
                                                <img id="previewImage"
                                                    src="{{ $user->profile_image ? Storage::url($user->profile_image) : 'default-image.jpg' }}"
                                                    class="effect8 full-image" alt="Preview Image"
                                                    style="width: 100%; height: 100%; object-fit: cover;" />

                                            </div>
                                        </div>
                                        <div class="download-photos  style-1 mt-3">
                                            <label for="myFile" class="select-file-btn">Chọn File</label>
                                            <input type="file" id="myFile" name="image" accept="image/*"
                                                onchange="previewFile()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="inputGroup my-0">
                                        <input class="mb-10" type="text" name="name"
                                            value="{{ auth()->user()->name }}" required>
                                        <label for="name">Họ tên </label>
                                    </div>
                                    <div class="inputGroup my-3">
                                        <input class="mb-10" type="text" name="phone_number"
                                            value="{{ auth()->user()->phone_number }}">
                                        <label for="mobile">Số điện thoại</label>
                                    </div>
                                    <div class="inputGroup my-3">
                                        <select name="gender" class="mb-10">
                                            <option value="male" {{ auth()->user()->gender == 'male' ? 'selected' : '' }}>
                                                Nam
                                            </option>
                                            <option value="female"
                                                {{ auth()->user()->gender == 'female' ? 'selected' : '' }}>Nữ
                                            </option>
                                            <option value="other"
                                                {{ auth()->user()->gender == 'other' ? 'selected' : '' }}>Khác
                                            </option>
                                        </select>
                                    </div>
                                    <div class="inputGroup my-3">
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                            required="">
                                        <label for="account_email">Địa chỉ email</label>
                                    </div>
                                </div>

                                <div class="form-group mt-5 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary tf-button style-1 w208">Lưu thay
                                        đổi</button>
                                </div>
                            </div>


                        </form>
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
                        <form action="{{ route('Customer.user.change_password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="password-change-section mt-5">
                                <div class="section-title text-center" style="margin-top: -5%">
                                    <h2>Đổi mật khẩu</h2>
                                </div>
                                <div class="inputGroup my-3">
                                    <input type="password" id="old_password" name="old_password" required="">
                                    <label for="old_password">Mật khẩu cũ</label>
                                </div>
                                <div class="inputGroup my-3">
                                    <input type="password" id="new_password" name="new_password" required="">
                                    <label for="new_password">Mật khẩu mới</label>
                                </div>
                                <div class="inputGroup my-3">
                                    <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                        required="">
                                    <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                                    <div class="invalid-feedback">Mật khẩu không khớp!</div>
                                </div>
                            </div>

                            <div class="form-group mt-5 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary tf-button style-1 w208">Lưu thay đổi</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        function previewFile() {
            const file = document.getElementById('myFile').files[0];
            if (file) {
                console.log('File đã chọn:', file.name);
            }
        }
    </script>
@endsection
