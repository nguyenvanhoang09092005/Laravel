@extends('admin.layouts.layout')
@section('admin_page_title')
    Edit User - {{ $user_info->name }}
@endsection
@section('admin_layout')
    <div class="wg-box">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit User</h3>
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
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif


            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <form class="form-new-product form-style-1" action="{{ route('update.manage', $user_info->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <fieldset class="name">
                    <div class="body-title mb-10">User Name <span class="tf-color-1">*</span></div>
                    <input type="text" placeholder="Enter user name" name="name" value="{{ $user_info->name }}"
                        required>
                </fieldset>

                <fieldset class="name">
                    <div class="body-title mb-10">Email <span class="tf-color-1">*</span></div>
                    <input type="email" placeholder="Enter email" name="email" value="{{ $user_info->email }}" required>
                </fieldset>

                <fieldset class="name">
                    <div class="body-title mb-10">Address <span class="tf-color-1">*</span></div>
                    <input type="text" placeholder="Enter address" name="address" value="{{ $user_info->address }}"
                        required>
                </fieldset>

                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <div class="body-title">Upload Image</div>
                            <div class="upload-image flex-grow">
                                <div class="item" id="imgpreview"
                                    style="{{ $user_info->profile_image ? '' : 'display: none;' }}">
                                    <img id="previewImage"
                                        src="{{ $user_info->profile_image ? asset('storage/' . $user_info->profile_image) : '#' }}"
                                        class="effect8 full-image" alt="">
                                </div>

                                <div id="upload-file" class="item up-load"
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

                    <div class="col-6">
                        <fieldset class="name">
                            <div class="body-title mb-10">Phone Number <span class="tf-color-1">*</span></div>
                            <input type="text" placeholder="Enter phone number" name="phone_number"
                                value="{{ $user_info->phone_number }}" required>
                        </fieldset>

                        <fieldset class="name">
                            <div class="body-title mb-10">Gender <span class="tf-color-1">*</span></div>
                            <select name="gender" required>
                                <option value="male" {{ $user_info->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user_info->gender == 'female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="other" {{ $user_info->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </fieldset>
                    </div>
                </div>

                <div class="bot">
                    <button class="tf-button w208" type="submit">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
@endsection
