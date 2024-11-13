@extends('admin.layouts.layout')
@section('admin_page_title')
    Edit Category
@endsection
@section('admin_layout')
    <!-- new-category -->
    <div class="wg-box">
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
            <div class="alert alert-update">
                {{ session('message') }}
            </div>
        @endif

        <form class="form-new-product form-style-1" action="{{ route('update.attribute', $attri_info->id ?? '') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <fieldset class="name">
                <div class="body-title">Default Attributes <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="text" placeholder="Attributes" name="attribute_value" tabindex="0"
                    value="{{ $attri_info->attribute_value }}" aria-required="true" required="">
            </fieldset>

            {{-- <fieldset>
                <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                <div class="upload-image flex-grow">
                    <div class="item" id="imgpreview" style="display:none">
                        <img id="previewImage" src="#" class="effect8 full-image" alt="">
                    </div>

                    <div id="upload-file" class="item up-load">
                        <label class="uploadfile" for="myFile">
                            <span class="icon">
                                <i class="icon-upload-cloud"></i>
                            </span>
                            <span class="body-text">Drop your images here or select <span class="tf-color">click to
                                    browse</span></span>
                            <input type="file" id="myFile" name="image" accept="image/*" onchange="previewFile()">

                        </label>
                    </div>
                </div>
            </fieldset> --}}
            <div class="bot">
                <div></div>
                <button class="tf-button w208" type="submit">Update</button>
            </div>
        </form>

    </div>
@endsection
