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
            box-shadow: 0 8px 15px rgba(0, 119, 255, 0.8), 0 4px 10px rgba(255, 255, 255, 0.6), inset 0 0 10px rgba(255, 255, 255, 0.5);

            transition: all 0.3s ease;
            padding: 10px 20px;
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

        /* Định dạng cho các input */
        .form-control {
            background: #f8f9fa;
            /* Màu nền nhẹ nhàng */
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 16px;
            color: #333;
            box-shadow: 0 6px 20px rgba(1, 107, 255, 0.1), 0 3px 10px rgba(3, 61, 235, 0.03);
            transition: all 0.3s ease-in-out;
        }

        /* Khi input focus (được chọn) */
        .form-control:focus {
            background: #fff;
            border-color: #5b9bd5;
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.5), 0 5px 15px rgba(255, 255, 255, 0.3);
            outline: none;
        }

        /* Thêm hiệu ứng cho các input khi hover */
        .form-control:hover {
            box-shadow: 0 8px 25px rgba(0, 123, 255, 0.3), 0 5px 15px rgba(255, 255, 255, 0.2);
            border-color: #007bff;
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
                        <form name="account_edit_form" action="#" method="POST" class="needs-validation" novalidate="">
                            <div class="row">
                                <div class="col-md-2 mb-4 text-center">
                                    <div class="profile-image">
                                        <div class="upload-image">
                                            <div class="item profile-img-preview-container" id="imgpreview"
                                                style="border: 2px dashed #1865e1; padding: 10px; display: inline-block; width: 100%; height: 200px;">
                                                <img id="previewImage" src="" class="effect8 full-image"
                                                    alt="Preview Image"
                                                    style="width: 100%; height: 100%; object-fit: cover;" />
                                            </div>
                                        </div>

                                        <div class="download-photos tf-button style-1 mt-3">
                                            <label for="myFile" class="select-file-btn">Chọn File</label>
                                            <input type="file" id="myFile" name="image" accept="image/*"
                                                onchange="previewFile()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="form-floating my-0">
                                        <input type="text" class="form-control" placeholder="Họ và tên" name="name"
                                            value="" required="">
                                        <label for="name">Họ và tên</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="text" class="form-control" placeholder="Số điện thoại"
                                            name="mobile" value="" required="">
                                        <label for="mobile">Số điện thoại</label>
                                    </div>
                                    <div class="form-floating my-3">
                                        <input type="email" class="form-control" placeholder="Địa chỉ email"
                                            name="email" value="" required="">
                                        <label for="account_email">Địa chỉ email</label>
                                    </div>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary custom-btn">Lưu thay đổi</button>
                                </div>
                            </div>

                            <div class="password-change-section mt-5">
                                <div class="section-title text-center" style="margin-top: -5%">
                                    <h2>Đổi mật khẩu</h2>
                                </div>
                                <div class="form-floating my-3">
                                    <input type="password" class="form-control" id="old_password" name="old_password"
                                        placeholder="Mật khẩu cũ" required="">
                                    <label for="old_password">Mật khẩu cũ</label>
                                </div>
                                <div class="form-floating my-3">
                                    <input type="password" class="form-control" id="new_password" name="new_password"
                                        placeholder="Mật khẩu mới" required="">
                                    <label for="new_password">Mật khẩu mới</label>
                                </div>
                                <div class="form-floating my-3">
                                    <input type="password" class="form-control" id="new_password_confirmation"
                                        name="new_password_confirmation" placeholder="Xác nhận mật khẩu mới" required="">
                                    <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                                    <div class="invalid-feedback">Mật khẩu không khớp!</div>
                                </div>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-3">Lưu thay đổi</button>
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
