// hiện thị ảnh

function previewFile() {
    const preview = document.getElementById("previewImage");
    const file = document.getElementById("myFile").files[0];
    const reader = new FileReader();

    reader.addEventListener(
        "load",
        function () {
            // Hiển thị ảnh khi đã tải xong
            preview.src = reader.result;
            document.getElementById("imgpreview").style.display = "block";
        },
        false
    );

    if (file) {
        reader.readAsDataURL(file);
    }
}

function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        document.getElementById("previewImage").src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

//user
document.addEventListener("DOMContentLoaded", function () {
    const infoOption = document.getElementById("infoOption");
    const passwordOption = document.getElementById("passwordOption");
    const personalInfoForm = document.getElementById("personalInfoForm");
    const passwordChangeForm = document.getElementById("passwordChangeForm");

    infoOption.addEventListener("change", function () {
        if (infoOption.checked) {
            personalInfoForm.classList.remove("d-none");
            passwordChangeForm.classList.add("d-none");
        }
    });

    passwordOption.addEventListener("change", function () {
        if (passwordOption.checked) {
            passwordChangeForm.classList.remove("d-none");
            personalInfoForm.classList.add("d-none");
        }
    });
});

function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const output = document.getElementById("previewImage");
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

function enableEditMode() {
    // Enable all input fields
    document.getElementById("name").disabled = false;
    document.getElementById("email").disabled = false;
    document.getElementById("phone").disabled = false;
    document.getElementById("address").disabled = false;
    document.getElementById("imageUpload").disabled = false;
    document.getElementById("chooseImageButton").disabled = false;

    // Enable gender radio buttons
    document.getElementById("male").disabled = false;
    document.getElementById("female").disabled = false;
    document.getElementById("other").disabled = false;

    // Hide edit button and show save button
    document.getElementById("editButton").classList.add("d-none");
    document.getElementById("saveButton").classList.remove("d-none");
}

function enableEditMode() {
    // Enable all input fields
    document.getElementById("name").disabled = false;
    document.getElementById("email").disabled = false;
    document.getElementById("phone").disabled = false;
    document.getElementById("address").disabled = false;

    // Enable gender radio buttons
    document.getElementById("male").disabled = false;
    document.getElementById("female").disabled = false;
    document.getElementById("other").disabled = false;

    // Show the image upload button
    document.getElementById("imageUpload").disabled = false;
    document.getElementById("chooseImageButton").classList.remove("d-none");

    // Hide edit button and show save button
    document.getElementById("editButton").classList.add("d-none");
    document.getElementById("saveButton").classList.remove("d-none");
}

// Preview uploaded image
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById("previewImage");
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}
