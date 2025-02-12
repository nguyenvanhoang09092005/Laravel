document.addEventListener("DOMContentLoaded", function () {
    const adminCount = parseInt(
        document.getElementById("adminCount").textContent,
        10
    );
    const customerCount = parseInt(
        document.getElementById("customerCount").textContent,
        10
    );
    const personnelCount = parseInt(
        document.getElementById("personnelCount").textContent,
        10
    );

    var ctx = document.getElementById("userChart").getContext("2d");
    var userChart = new Chart(ctx, {
        type: "pie", // Loại biểu đồ là 'pie'
        data: {
            labels: ["Admin", "Customer", "Personnel"],
            datasets: [
                {
                    label: "User Distribution",
                    data: [adminCount, customerCount, personnelCount],
                    backgroundColor: ["#FF6384", "#36A2EB", "#FFCE56"],
                    hoverOffset: 4,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "top",
                },
                tooltip: {
                    callbacks: {
                        label: function (tooltipItem) {
                            return tooltipItem.label + ": " + tooltipItem.raw;
                        },
                    },
                },
            },
            aspectRatio: 1,
            cutout: "70%",
            maintainAspectRatio: false,
        },
    });
});

// biểu đồ trafficChart
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById("trafficChart").getContext("2d");
    const trafficChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: JSON.parse(
                document.getElementById("chart-dates").textContent
            ),
            datasets: [
                {
                    label: "Traffic",
                    data: JSON.parse(
                        document.getElementById("chart-traffic").textContent
                    ),
                    backgroundColor: "rgba(54, 162, 235, 0.2)",
                    borderColor: "rgba(54, 162, 235, 1)",
                    borderWidth: 1,
                    fill: true,
                    tension: 0.4,
                },
                {
                    label: "Users",
                    data: JSON.parse(
                        document.getElementById("chart-users").textContent
                    ),
                    backgroundColor: "rgba(255, 99, 132, 0.2)",
                    borderColor: "rgba(255, 99, 132, 1)",
                    borderWidth: 1,
                    fill: true,
                    tension: 0.4,
                },
                {
                    label: "Revenue",
                    data: JSON.parse(
                        document.getElementById("chart-revenue").textContent
                    ),
                    backgroundColor: "rgba(75, 192, 192, 0.2)",
                    borderColor: "rgba(75, 192, 192, 1)",
                    borderWidth: 1,
                    fill: true,
                    tension: 0.4,
                },
                {
                    label: "Orders",
                    data: JSON.parse(
                        document.getElementById("chart-orders").textContent
                    ),
                    backgroundColor: "rgba(153, 102, 255, 0.2)",
                    borderColor: "rgba(153, 102, 255, 1)",
                    borderWidth: 1,
                    fill: true,
                    tension: 0.4,
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: "nearest",
                axis: "x",
                intersect: false,
            },
            scales: {
                x: { beginAtZero: true },
                y: { beginAtZero: true },
            },
            plugins: {
                legend: { position: "top" },
                tooltip: {
                    enabled: true,
                    animation: {
                        duration: 0, // Tắt hoạt ảnh
                    },
                    callbacks: {
                        label: function (tooltipItem) {
                            return (
                                tooltipItem.dataset.label +
                                ": " +
                                tooltipItem.raw
                            );
                        },
                    },
                },
            },
        },
    });

    // Tự động cập nhật lại kích thước biểu đồ khi cửa sổ thay đổi
    window.addEventListener("resize", function () {
        trafficChart.update();
    });
});

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
//////////////////////////////////////////////
/**
 * Template Name: BizLand
 * Template URL: https://bootstrapmade.com/bizland-bootstrap-business-template/
 * Updated: Mar 17 2024 with Bootstrap v5.3.3
 * Author: BootstrapMade.com
 * License: https://bootstrapmade.com/license/
 */

(function () {
    "use strict";

    /**
     * Easy selector helper function
     */
    const select = (el, all = false) => {
        el = el.trim();
        if (all) {
            return [...document.querySelectorAll(el)];
        } else {
            return document.querySelector(el);
        }
    };

    /**
     * Easy event listener function
     */
    const on = (type, el, listener, all = false) => {
        let selectEl = select(el, all);
        if (selectEl) {
            if (all) {
                selectEl.forEach((e) => e.addEventListener(type, listener));
            } else {
                selectEl.addEventListener(type, listener);
            }
        }
    };

    /**
     * Easy on scroll event listener
     */
    const onscroll = (el, listener) => {
        el.addEventListener("scroll", listener);
    };

    /**
     * Navbar links active state on scroll
     */
    let navbarlinks = select("#navbar .scrollto", true);
    const navbarlinksActive = () => {
        let position = window.scrollY + 200;
        navbarlinks.forEach((navbarlink) => {
            if (!navbarlink.hash) return;
            let section = select(navbarlink.hash);
            if (!section) return;
            if (
                position >= section.offsetTop &&
                position <= section.offsetTop + section.offsetHeight
            ) {
                navbarlink.classList.add("active");
            } else {
                navbarlink.classList.remove("active");
            }
        });
    };
    window.addEventListener("load", navbarlinksActive);
    onscroll(document, navbarlinksActive);

    /**
     * Scrolls to an element with header offset
     */
    const scrollto = (el) => {
        let header = select("#header");
        let offset = header.offsetHeight;

        if (!header.classList.contains("header-scrolled")) {
            offset -= 16;
        }

        let elementPos = select(el).offsetTop;
        window.scrollTo({
            top: elementPos - offset,
            behavior: "smooth",
        });
    };

    /**
     * Header fixed top on scroll
     */
    let selectHeader = select("#header");
    if (selectHeader) {
        let headerOffset = selectHeader.offsetTop;
        let nextElement = selectHeader.nextElementSibling;
        const headerFixed = () => {
            if (headerOffset - window.scrollY <= 0) {
                selectHeader.classList.add("fixed-top");
                nextElement.classList.add("scrolled-offset");
            } else {
                selectHeader.classList.remove("fixed-top");
                nextElement.classList.remove("scrolled-offset");
            }
        };
        window.addEventListener("load", headerFixed);
        onscroll(document, headerFixed);
    }

    /**
     * Back to top button
     */
    let backtotop = select(".back-to-top");
    if (backtotop) {
        const toggleBacktotop = () => {
            if (window.scrollY > 100) {
                backtotop.classList.add("active");
            } else {
                backtotop.classList.remove("active");
            }
        };
        window.addEventListener("load", toggleBacktotop);
        onscroll(document, toggleBacktotop);
    }

    /**
     * Mobile nav toggle
     */
    on("click", ".mobile-nav-toggle", function (e) {
        select("#navbar").classList.toggle("navbar-mobile");
        this.classList.toggle("bi-list");
        this.classList.toggle("bi-x");
    });

    /**
     * Mobile nav dropdowns activate
     */
    on(
        "click",
        ".navbar .dropdown > a",
        function (e) {
            if (select("#navbar").classList.contains("navbar-mobile")) {
                e.preventDefault();
                this.nextElementSibling.classList.toggle("dropdown-active");
            }
        },
        true
    );

    /**
     * Scrool with ofset on links with a class name .scrollto
     */
    on(
        "click",
        ".scrollto",
        function (e) {
            if (select(this.hash)) {
                e.preventDefault();

                let navbar = select("#navbar");
                if (navbar.classList.contains("navbar-mobile")) {
                    navbar.classList.remove("navbar-mobile");
                    let navbarToggle = select(".mobile-nav-toggle");
                    navbarToggle.classList.toggle("bi-list");
                    navbarToggle.classList.toggle("bi-x");
                }
                scrollto(this.hash);
            }
        },
        true
    );

    /**
     * Scroll with ofset on page load with hash links in the url
     */
    window.addEventListener("load", () => {
        if (window.location.hash) {
            if (select(window.location.hash)) {
                scrollto(window.location.hash);
            }
        }
    });

    /**
     * Preloader
     */
    let preloader = select("#preloader");
    if (preloader) {
        window.addEventListener("load", () => {
            preloader.remove();
        });
    }

    /**
     * Initiate glightbox
     */
    const glightbox = GLightbox({
        selector: ".glightbox",
    });

    /**
     * Skills animation
     */
    let skilsContent = select(".skills-content");
    if (skilsContent) {
        new Waypoint({
            element: skilsContent,
            offset: "80%",
            handler: function (direction) {
                let progress = select(".progress .progress-bar", true);
                progress.forEach((el) => {
                    el.style.width = el.getAttribute("aria-valuenow") + "%";
                });
            },
        });
    }

    /**
     * Testimonials slider
     */
    new Swiper(".testimonials-slider", {
        speed: 600,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        slidesPerView: "auto",
        pagination: {
            el: ".swiper-pagination",
            type: "bullets",
            clickable: true,
        },
    });

    /**
     * Porfolio isotope and filter
     */
    // window.addEventListener("load", () => {
    //   let portfolioContainer = select(".portfolio-container");
    //   if (portfolioContainer) {
    //     let portfolioIsotope = new Isotope(portfolioContainer, {
    //       itemSelector: ".portfolio-item",
    //     });

    //     let portfolioFilters = select("#portfolio-flters li", true);

    //     on(
    //       "click",
    //       "#portfolio-flters li",
    //       function (e) {
    //         e.preventDefault();
    //         portfolioFilters.forEach(function (el) {
    //           el.classList.remove("filter-active");
    //         });
    //         this.classList.add("filter-active");

    //         portfolioIsotope.arrange({
    //           filter: this.getAttribute("data-filter"),
    //         });
    //         portfolioIsotope.on("arrangeComplete", function () {
    //           AOS.refresh();
    //         });
    //       },
    //       true
    //     );
    //   }
    // });

    /**
     * Initiate portfolio lightbox
     */
    const portfolioLightbox = GLightbox({
        selector: ".portfolio-lightbox",
    });

    /**
     * Portfolio details slider
     */
    new Swiper(".portfolio-details-slider", {
        speed: 400,
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".swiper-pagination",
            type: "bullets",
            clickable: true,
        },
    });

    /**
     * Animation on scroll
     */
    window.addEventListener("load", () => {
        AOS.init({
            duration: 1000,
            easing: "ease-in-out",
            once: true,
            mirror: false,
        });
    });

    /**
     * Initiate Pure Counter
     */
    new PureCounter();
})();

// header
document.addEventListener("scroll", function () {
    const header = document.querySelector("header");
    if (window.scrollY > 50) {
        header.classList.add("sticky");
    } else {
        header.classList.remove("sticky");
    }
});

//promotions_admin
$(document).ready(function () {
    $(document).ready(function () {
        $("#product_sku").on("input", function () {
            const query = $(this).val();
            if (query.length > 2) {
                $.ajax({
                    url: "{{ route('promotions.skuList') }}",
                    type: "GET",
                    data: { q: query },
                    success: function (response) {
                        let suggestions = response.map(
                            (item) =>
                                `<option value="${item.sku}">${item.sku} - ${item.name}</option>`
                        );
                        $("#sku-suggestions").html(suggestions.join(""));
                    },
                    error: function () {
                        console.error("Error fetching SKU suggestions.");
                    },
                });
            }
        });
    });
});

//promotions
/**
 * Portfolio isotope and filter for Promotions
 */
window.addEventListener("load", () => {
    let promotionsContainer = document.querySelector(".promotions-container");
    if (promotionsContainer) {
        let promotionsIsotope = new Isotope(promotionsContainer, {
            itemSelector: ".promotions-item",
        });

        let promotionsFilters = document.querySelectorAll(
            "#promotions-flters li"
        );

        promotionsFilters.forEach(function (filterItem) {
            filterItem.addEventListener("click", function (e) {
                e.preventDefault();
                promotionsFilters.forEach(function (el) {
                    el.classList.remove("filter-active");
                });
                this.classList.add("filter-active");

                // Sử dụng data-filter để áp dụng bộ lọc
                promotionsIsotope.arrange({
                    filter: this.getAttribute("data-filter"),
                });
                promotionsIsotope.on("arrangeComplete", function () {
                    AOS.refresh();
                });
            });
        });
    }
});

/**
 * Initiate portfolio lightbox for Promotions
 */
const promotionsLightbox = GLightbox({
    selector: ".promotions-lightbox",
});

/**
 * Portfolio details slider for Promotions
 */
new Swiper(".promotions-details-slider", {
    speed: 400,
    loop: true,
    autoplay: {
        delay: 5000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        type: "bullets",
        clickable: true,
    },
});

document.addEventListener("DOMContentLoaded", () => {
    document
        .querySelectorAll(".increment-qty, .decrement-qty")
        .forEach((button) => {
            button.addEventListener("click", (e) => {
                const input = e.target
                    .closest("tr")
                    .querySelector(".qty-input");
                const currentValue = parseInt(input.value, 10) || 1;
                if (e.target.classList.contains("increment-qty"))
                    input.value = currentValue + 1;
                else if (currentValue > 1) input.value = currentValue - 1;

                // Update subtotal (mock example)
                const price = parseFloat(
                    e.target
                        .closest("tr")
                        .querySelector("td:nth-child(3)")
                        .innerText.slice(1)
                );
                e.target
                    .closest("tr")
                    .querySelector("td:nth-child(5)").innerText = `$${(
                    price * input.value
                ).toFixed(2)}`;
            });
        });

    document.querySelectorAll(".remove-item").forEach((button) => {
        button.addEventListener("click", (e) => {
            e.target.closest("tr").remove();
            // Update totals (mock example)
        });
    });
});

//promotions admin
function confirmDeletePromotions() {
    return confirm(
        "Are you sure you want to delete this Promotions? This action cannot be undone."
    );
}
