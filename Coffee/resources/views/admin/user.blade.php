@extends('admin.layouts.layout')

@section('admin_page_title')
    User-Admin
@endsection

@section('admin_layout')
    <div class="wg-box">
        <h3 class="text-center">Account Information</h3>

        <!-- Radio Buttons Centered -->
        <div class="d-flex justify-content-center mt-3">
            <div class="form-check form-check-inline mx-4">
                <input class="form-check-input" type="radio" name="accountOption" id="infoOption" value="info" checked>
                <label class="form-check-label" for="infoOption">Personal Information</label>
            </div>
            <div class="form-check form-check-inline mx-4">
                <input class="form-check-input" type="radio" name="accountOption" id="passwordOption" value="password">
                <label class="form-check-label" for="passwordOption">Change Password</label>
            </div>
        </div>


        <!-- Personal Information Form -->
        <div id="personalInfoForm" class="mt-4">
            <div class="row">
                <div class="col-md-4 text-center">
                    <!-- Image Preview Container -->
                    <div class="image-container">
                        <img id="previewImage"
                            src="{{ asset('storage/' . ($user->profile_image ?? 'path_to_default_image.jpg')) }}"
                            alt="Profile Image">

                    </div>

                    <!-- Image Upload Button (Initially hidden) -->
                    <input type="file" id="imageUpload" accept="image/*" style="display: none;"
                        onchange="previewImage(event)">
                    <button class="btn btn-secondary btn-sm mt-2 d-none" id="chooseImageButton"
                        onclick="document.getElementById('imageUpload').click();">Choose Image</button>
                </div>
                <div class="col-md-8">
                    <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $user->name }}" placeholder="Full Name" disabled>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user->email }}" placeholder="Email" disabled>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone_number"
                                value="{{ $user->phone_number }}" placeholder="Phone Number" disabled>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $user->address }}" placeholder="Address" disabled>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="Male"
                                    {{ $user->gender == 'Male' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="male">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="Female"
                                    {{ $user->gender == 'Female' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="female">Female</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="other" value="Other"
                                    {{ $user->gender == 'Other' ? 'checked' : '' }} disabled>
                                <label class="form-check-label" for="other">Other</label>
                            </div>
                        </div>

                        <!-- Edit and Save buttons -->
                        <button type="button" class="btn btn-primary mt-2" id="editButton"
                            onclick="enableEditMode()">Edit</button>
                        <button type="submit" class="btn btn-success mt-2 d-none" id="saveButton">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function enableEditMode() {
            // Enable all input fields
            document.getElementById('name').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('phone').disabled = false;
            document.getElementById('address').disabled = false;

            // Enable gender radio buttons
            document.getElementById('male').disabled = false;
            document.getElementById('female').disabled = false;
            document.getElementById('other').disabled = false;

            // Show the image upload button
            document.getElementById('chooseImageButton').classList.remove('d-none');

            // Hide edit button and show save button
            document.getElementById('editButton').classList.add('d-none');
            document.getElementById('saveButton').classList.remove('d-none');
        }

        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                document.getElementById('previewImage').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
