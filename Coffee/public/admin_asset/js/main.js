/**
 * selectImages
 * menuleft
 * tabs
 * progresslevel
 * collapse_menu
 * fullcheckbox
 * showpass
 * gallery
 * coppy
 * select_colors_theme
 * icon_function
 * box_search
 * preloader
 */

(function ($) {
    "use strict";

    var selectImages = function () {
        if ($(".image-select").length > 0) {
            const selectIMG = $(".image-select");
            selectIMG.find("option").each((idx, elem) => {
                const selectOption = $(elem);
                const imgURL = selectOption.attr("data-thumbnail");
                if (imgURL) {
                    selectOption.attr(
                        "data-content",
                        "<img src='%i'/> %s"
                            .replace(/%i/, imgURL)
                            .replace(/%s/, selectOption.text())
                    );
                }
            });
            selectIMG.selectpicker();
        }
    };

    var menuleft = function () {
        if ($("div").hasClass("section-menu-left")) {
            var bt = $(".section-menu-left").find(".has-children");
            bt.on("click", function () {
                var args = { duration: 200 };
                if ($(this).hasClass("active")) {
                    $(this).children(".sub-menu").slideUp(args);
                    $(this).removeClass("active");
                } else {
                    $(".sub-menu").slideUp(args);
                    $(this).children(".sub-menu").slideDown(args);
                    $(".menu-item.has-children").removeClass("active");
                    $(this).addClass("active");
                }
            });
            $(".sub-menu-item").on("click", function (event) {
                event.stopPropagation();
            });
        }
    };

    var tabs = function () {
        $(".widget-tabs").each(function () {
            $(this).find(".widget-content-tab").children().hide();
            $(this).find(".widget-content-tab").children(".active").show();
            $(this)
                .find(".widget-menu-tab")
                .find("li")
                .on("click", function () {
                    var liActive = $(this).index();
                    var contentActive = $(this)
                        .siblings()
                        .removeClass("active")
                        .parents(".widget-tabs")
                        .find(".widget-content-tab")
                        .children()
                        .eq(liActive);
                    contentActive.addClass("active").fadeIn("slow");
                    contentActive.siblings().removeClass("active");
                    $(this)
                        .addClass("active")
                        .parents(".widget-tabs")
                        .find(".widget-content-tab")
                        .children()
                        .eq(liActive)
                        .siblings()
                        .hide();
                });
        });
    };

    $("ul.dropdown-menu.has-content").on("click", function (event) {
        event.stopPropagation();
    });
    $(".button-close-dropdown").on("click", function () {
        $(this)
            .closest(".dropdown")
            .find(".dropdown-toggle")
            .removeClass("show");
        $(this).closest(".dropdown").find(".dropdown-menu").removeClass("show");
    });

    var progresslevel = function () {
        if ($("div").hasClass("progress-level-bar")) {
            var bars = document.querySelectorAll(".progress-level-bar > span");
            setInterval(function () {
                bars.forEach(function (bar) {
                    var t1 = parseFloat(bar.dataset.progress);
                    var t2 = parseFloat(bar.dataset.max);
                    var getWidth = (t1 / t2) * 100;
                    bar.style.width = getWidth + "%";
                });
            }, 500);
        }
    };

    var collapse_menu = function () {
        $(".button-show-hide").on("click", function () {
            $(".layout-wrap").toggleClass("full-width");
        });
    };

    var fullcheckbox = function () {
        $(".total-checkbox").on("click", function () {
            if ($(this).is(":checked")) {
                $(this)
                    .closest(".wrap-checkbox")
                    .find(".checkbox-item")
                    .prop("checked", true);
            } else {
                $(this)
                    .closest(".wrap-checkbox")
                    .find(".checkbox-item")
                    .prop("checked", false);
            }
        });
    };

    var showpass = function () {
        $(".show-pass").on("click", function () {
            $(this).toggleClass("active");
            var input = $(this).parents(".password").find(".password-input");

            if (input.attr("type") === "password") {
                input.attr("type", "text");
            } else if (input.attr("type") === "text") {
                input.attr("type", "password");
            }
        });
    };

    var gallery = function () {
        $(".button-list-style").on("click", function () {
            $(".wrap-gallery-item").addClass("list");
        });
        $(".button-grid-style").on("click", function () {
            $(".wrap-gallery-item").removeClass("list");
        });
    };

    var coppy = function () {
        $(".button-coppy").on("click", function () {
            myFunction();
        });
        function myFunction() {
            var copyText = document.getElementsByClassName("coppy-content");
            navigator.clipboard.writeText(copyText.text);
        }
    };

    var select_colors_theme = function () {
        if ($("div").hasClass("select-colors-theme")) {
            $(".select-colors-theme .item").on("click", function (e) {
                $(this)
                    .parents(".select-colors-theme")
                    .find(".active")
                    .removeClass("active");
                $(this).toggleClass("active");
            });
        }
    };

    var icon_function = function () {
        if ($("div").hasClass("list-icon-function")) {
            $(".list-icon-function .trash").on("click", function (e) {
                $(this).parents(".product-item").remove();
                $(this).parents(".attribute-item").remove();
                $(this).parents(".countries-item").remove();
                $(this).parents(".user-item").remove();
                $(this).parents(".roles-item").remove();
            });
        }
    };

    var box_search = function () {
        $(document).on("click", function (e) {
            var clickID = e.target.id;
            if (clickID !== "s") {
                $(".box-content-search").removeClass("active");
            }
        });
        $(document).on("click", function (e) {
            var clickID = e.target.class;
            if (clickID !== "a111") {
                $(".show-search").removeClass("active");
            }
        });

        $(".show-search").on("click", function (event) {
            event.stopPropagation();
        });
        $(".search-form").on("click", function (event) {
            event.stopPropagation();
        });
        var input = $(".header-dashboard").find(".form-search").find("input");
        input.on("input", function () {
            if ($(this).val().trim() !== "") {
                $(".box-content-search").addClass("active");
            } else {
                $(".box-content-search").removeClass("active");
            }
        });
    };

    var retinaLogos = function () {
        var retina = window.devicePixelRatio > 1 ? true : false;
        if (retina) {
            if ($(".dark-theme").length > 0) {
                $("#logo_header").attr({
                    src: "images/logo/logo.png",
                    width: "154px",
                    height: "52px",
                });
            } else {
                $("#logo_header").attr({
                    src: "images/logo/logo.png",
                    width: "154px",
                    height: "52px",
                });
            }
        }
    };

    var preloader = function () {
        setTimeout(function () {
            $("#preload").fadeOut("slow", function () {
                $(this).remove();
            });
        }, 1000);
    };

    // Dom Ready
    $(function () {
        selectImages();
        menuleft();
        tabs();
        progresslevel();
        collapse_menu();
        fullcheckbox();
        showpass();
        gallery();
        coppy();
        select_colors_theme();
        icon_function();
        box_search();
        retinaLogos();
        preloader();
    });
})(jQuery);
//////////////////////////////////////////////////////////////
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

window.addEventListener("load", () => {
    let promotionsContainer = document.querySelector(".promotions-container");

    if (promotionsContainer) {
        let promotionsIsotope = new Isotope(promotionsContainer, {
            itemSelector: ".promotions-item",
            layoutMode: "fitRows", // Hoặc "masonry" nếu muốn bố trí kiểu gạch
        });

        let promotionsFilters = document.querySelectorAll(
            "#promotions-flters li"
        );

        promotionsFilters.forEach(function (filter) {
            filter.addEventListener("click", function (e) {
                e.preventDefault();

                // Gỡ bỏ lớp 'filter-active' khỏi tất cả các li
                promotionsFilters.forEach(function (el) {
                    el.classList.remove("filter-active");
                });

                // Thêm lớp 'filter-active' vào li đang được nhấn
                this.classList.add("filter-active");

                // Lọc các mục Isotope dựa trên filter được chọn
                promotionsIsotope.arrange({
                    filter: this.getAttribute("data-filter"),
                });

                // Cập nhật lại AOS (Animation on Scroll)
                promotionsIsotope.on("arrangeComplete", function () {
                    AOS.refresh();
                });
            });
        });
    }

    // Khởi tạo Lightbox cho hình ảnh trong promotions
    const promotionsLightbox = GLightbox({
        selector: ".promotions-lightbox",
    });

    new PureCounter();

    AOS.init({
        duration: 1000,
        easing: "ease-in-out",
        once: true,
        mirror: false,
    });
});
