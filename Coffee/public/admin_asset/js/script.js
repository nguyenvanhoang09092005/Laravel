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

//tìm kiếm
