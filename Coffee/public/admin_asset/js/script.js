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

//dashboard
document.addEventListener("DOMContentLoaded", function () {
    // Lấy thời gian hiện tại
    const now = new Date();

    // Khởi tạo Flatpickr
    const flatpickrInstance = flatpickr("#datetimepicker-dashboard", {
        inline: true,
        enableTime: true,
        noCalendar: false,
        dateFormat: "Y-m-d H:i:S",
        defaultDate: now,
        time_24hr: true,
    });

    // Cập nhật thời gian liên tục mỗi giây
    setInterval(function () {
        flatpickrInstance.setDate(new Date(), true);
    }, 1000); // Cập nhật mỗi giây

    document
        .getElementById("calendar-title")
        .addEventListener("click", function () {
            flatpickrInstance.setDate(new Date(), true);
        });
});
//map
document.addEventListener("DOMContentLoaded", function () {
    var map = L.map("world_map", {
        center: [16.0953254, 108.2468343],
        zoom: 15,
    });

    //  OpenStreetMap
    var osm = L.tileLayer(
        "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        {
            maxZoom: 19,
            attribution: "© OpenStreetMap contributors",
        }
    );

    //  vệ tinh từ ESRI
    var esriSatellite = L.tileLayer(
        "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
        {
            maxZoom: 19,
            attribution:
                "© Esri, Maxar, Earthstar Geographics, and the GIS User Community",
        }
    );

    // p OpenStreetMap
    osm.addTo(map);

    // marker tại vị trí cụ thể
    var marker = L.marker([16.0953254, 108.2468343])
        .addTo(map)
        .bindPopup("144 Lê Tấn Trung, Thọ Quang, Sơn Trà, Đà Nẵng")
        .openPopup();

    // Điều khiển chọn loại bản đồ
    var baseMaps = {
        "Bản đồ thực tế": osm,
        "Bản đồ vệ tinh": esriSatellite,
    };
    L.control.layers(baseMaps).addTo(map);

    // quay lại vị trí
    var homeButton = L.control({ position: "topright" });
    homeButton.onAdd = function () {
        var div = L.DomUtil.create("button", "home-button");
        div.innerHTML = "Quay lại vị trí";
        div.style.backgroundColor = "white";
        div.style.border = "2px solid #ccc";
        div.style.padding = "5px";
        div.style.cursor = "pointer";
        div.onclick = function () {
            map.setView([16.0953254, 108.2468343], 18);
        };
        return div;
    };
    homeButton.addTo(map);
});
