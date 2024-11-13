@extends('admin.layouts.layout')
@section('admin_page_title')
    Edit Brand
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

        <form class="form-new-product form-style-1" action="{{ route('update.brand', $brand_info->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <fieldset class="name">
                <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                <input class="flex-grow" type="text" placeholder="Brand name" name="brand_name" tabindex="0"
                    value="{{ $brand_info->brand_name }}" aria-required="true" required="">
            </fieldset>

            <fieldset class="shortdescription">
                <div class="body-title mb-10">Description <span class="tf-color-1">*</span></div>
                <textarea class="mb-10 ht-150" name="describe" placeholder="Description" tabindex="0" aria-required="true"
                    required="">{{ $brand_info->describe }}</textarea>


            </fieldset>

            <fieldset>
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
            </fieldset>
            <div class="bot">
                <div></div>
                <button class="tf-button w208" type="submit">Update</button>
            </div>
        </form>

    </div>
@endsection
