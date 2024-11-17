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
