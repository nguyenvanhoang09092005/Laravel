@extends('admin.layouts.layout')
@section('admin_page_title')
    Create User - Admin
@endsection
@section('admin_layout')
    <div class="wg-box">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Add User</h3>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
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

            <form class="form-new-product form-style-1" action="{{ route('admin.manage') }}" method="POST"
                enctype="multipart/form-data">
                @csrf

                <fieldset class="name">
                    <div class="body-title mb-10">User Name <span class="tf-color-1">*</span></div>
                    <input type="text" placeholder="Enter user name" name="name" required>
                </fieldset>

                <fieldset class="name">
                    <div class="body-title mb-10">Email <span class="tf-color-1">*</span></div>
                    <input type="email" placeholder="Enter email" name="email" required>
                </fieldset>

                <fieldset class="name">
                    <div class="body-title mb-10">Address <span class="tf-color-1">*</span></div>
                    <input type="text" placeholder="Enter address" name="address" required>
                </fieldset>

                <!-- Flex container to align user-info-section elements in a row -->
                <div class="flex-container" style="display: flex; gap: 20px;">

                    <div class="user-info-section" style="flex: 1;">
                        <fieldset>
                            <div class="body-title ">Upload images <span class="tf-color-1">*</span></div>
                            <div class="upload-image flex-grow">
                                <div class="item" id="imgpreview" style="display: none;">
                                    <img id="previewImage" src="#" class="effect8 full-image" alt="">
                                </div>

                                <div id="upload-file" class="item up-load "
                                    style="height: 50px; border: 1px dashed #ddd; padding: 10px; text-align: center;">
                                    <label class="uploadfile" for="myFile"
                                        style="display: flex; flex-direction: column; align-items: center;">
                                        <span class="icon" style="font-size: 24px;">
                                            <i class="icon-upload-cloud"></i>
                                        </span>
                                        <span class="body-text">Drop your images here or select <span class="tf-color">click
                                                to browse</span></span>
                                        <input type="file" id="myFile" name="image" accept="image/*"
                                            onchange="previewFile()" style="display: none;">
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>

                    <div class="user-info-section" style="flex: 1;">
                        <fieldset class="name">
                            <div class="body-title mb-10">Phone Number <span class="tf-color-1">*</span></div>
                            <input type="text" placeholder="Enter phone number" name="phone_number" required>
                        </fieldset>

                        <fieldset class="name">
                            <div class="body-title mb-10">Gender <span class="tf-color-1">*</span></div>
                            <select name="gender" required>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </fieldset>
                    </div>

                </div>


                <div class="bot">
                    <button class="tf-button w208" type="submit">Save</button>
                    <a href="{{ route('admin.manage.user') }}" class="tf-button w208">Back</a>
                </div>

            </form>

        </div>
    </div>
@endsection
