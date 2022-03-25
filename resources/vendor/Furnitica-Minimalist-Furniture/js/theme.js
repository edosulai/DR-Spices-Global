(function () {
  ("use strict")
  function donnel() {
    $(".back-to-top").hide()
    $(window).on("scroll", function () {
      if ($(this).scrollTop() > 400) {
        $(".back-to-top").fadeIn()
      } else {
        $(".back-to-top").fadeOut()
      }
      ;
      return false
    })
    $(".back-to-top a").on("click", function (jenniah) {
      jenniah.preventDefault()
      $("html, body").animate({ scrollTop: 0 }, 600)
      return false
    })
  }
  function neorah() {
    var harleequinn = new Date("31 April 2018 9:56:00 GMT+01:00")
    harleequinn = Date.parse(harleequinn) / 1e3
    var lizzy = new Date
    lizzy = Date.parse(lizzy) / 1e3
    var argelia = harleequinn - lizzy
    var hesper = Math.floor(argelia / 86400)
    var britnay = Math.floor((argelia - hesper * 86400) / 3600)
    var ashaun = Math.floor((argelia - hesper * 86400 - britnay * 3600) / 60)
    var gradie = Math.floor(argelia - hesper * 86400 - britnay * 3600 - ashaun * 60)
    if (britnay < "10") {
      britnay = "0" + britnay
    }
    ;
    if (ashaun < "10") {
      ashaun = "0" + ashaun
    }
    ;
    if (gradie < "10") {
      gradie = "0" + gradie
    }
    ;
    $(".days").html(hesper + "<span>D</span>")
    $(".hours").html(britnay + "<span>H</span>")
    $(".minutes").html(ashaun + "<span>M</span>")
    $(".seconds").html(gradie + "<span>S</span>")
  }
  $(document).ready(function () {
    donnel()
    setTimeout(function () {
      $("#page-preloader").fadeOut()
    }, 2e3)
    setInterval(function () {
      neorah()
    }, 1e3)
    $("#tiva-slideshow").nivoSlider({ effect: "random", animSpeed: 1e3, pauseTime: 5e3, directionNav: true, controlNav: true, pauseOnHover: true })
    $("ul.menu").on("click", ".more", function () {
      if ($(this).hasClass("hide")) {
        $(this).text("show more").removeClass(".hide")
      } else {
        $(this).text("hide").addClass("hide")
      }
      ;
      $(this).siblings("li.toggleable").slideToggle()
    })
    $(".category-product").owlCarousel({ loop: true, autoplaytimeout: 6e3, margin: 30, autoplay: true, dots: false, autoplayHoverPause: true, responsiveClass: true, nav: true, responsive: { 0: { items: 1, navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"] }, 600: { items: 3, navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"] }, 1e3: { items: 3, navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"] } } })
    $(".category-product-index").owlCarousel({ loop: true, autoplaytimeout: 6e3, margin: 30, autoplay: true, dots: false, autoplayHoverPause: true, responsiveClass: true, nav: true, responsive: { 0: { items: 1, navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"] }, 600: { items: 3, navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"] }, 1e3: { items: 3, navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"] } } })
    $(".testimonial-type-one").owlCarousel({ loop: true, autoplaytimeout: 6e3, margin: 30, autoplay: true, dots: true, autoplayHoverPause: true, responsiveClass: true, nav: false, responsive: { 0: { items: 1 }, 600: { items: 1 }, 1e3: { items: 1 } } })
    $(".testimonial-type-home3").owlCarousel({ loop: true, autoplaytimeout: 6e3, margin: 30, autoplay: true, dots: true, autoplayHoverPause: true, responsiveClass: true, nav: false, responsive: { 0: { items: 1 }, 600: { items: 3 }, 1e3: { items: 3 } } })
    $("#manufacture").owlCarousel({ loop: true, autoplaytimeout: 6e3, margin: 30, autoplay: true, dots: false, autoplayHoverPause: true, responsiveClass: true, nav: true, responsive: { 0: { items: 3 }, 600: { items: 3 }, 1e3: { items: 6 } } })
    $(".category-product-item").owlCarousel({ loop: true, autoplaytimeout: 6e3, margin: 15, autoplay: false, dots: true, autoplayHoverPause: true, responsiveClass: true, nav: false, responsive: { 0: { items: 1 }, 600: { items: 3 }, 1e3: { items: 3 } } })
    $(".featured").owlCarousel({ loop: true, autoplaytimeout: 6e3, margin: 30, autoplay: false, dots: false, autoplayHoverPause: true, responsiveClass: true, nav: true, responsive: { 0: { items: 1, navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"] }, 600: { items: 3, navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"] }, 1e3: { items: 5, navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"] } } })
    $(".testimonials").owlCarousel({ loop: true, margin: 10, responsiveClass: true, autoplaytimeout: 6e3, autoplay: true, dots: true, autoplayHoverPause: true, nav: false, responsive: { 0: { items: 1 }, 600: { items: 1 }, 1e3: { items: 1 } } })
    $(".lookbook").owlCarousel({ loop: true, margin: 0, responsiveClass: true, autoplaytimeout: 6e3, autoplay: true, dots: true, autoplayHoverPause: true, nav: false, responsive: { 0: { items: 1, navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"] }, 600: { items: 1, navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"] }, 1e3: { items: 2, navText: ["<i class='fa fa-angle-left' aria-hidden='true'></i>", "<i class='fa fa-angle-right' aria-hidden='true'></i>"] } } })
    $("#mobile_mainmenu").on("click", function () {
      $(".mobile-top-menu").addClass("active-show")
    })
    $(".close").on("click", function () {
      $(".mobile-top-menu").removeClass("active-show")
    })
    $(".mobile-menutop").on("click", function () {
      $("#mobile-pagemenu").addClass("active-pagemenu")
    })
    $(".close-box").on("click", function () {
      $("#mobile-pagemenu").removeClass("active-pagemenu")
    })
    $("#icon-menu").on("click", function () {
      $(".menu-banner").addClass("category-show")
    })
    $(".btnov-lines-large").on("click", function () {
      $(".menu-banner").removeClass("category-show")
    })
    $("#dropdownMenuButton").on("click", function () {
      $(".vertical-dropdown").addClass("open")
    })
    $("#nav_icon3").on("click", function () {
      $(this).toggleClass("open")
    })
    $("#click-map").on("click", function () {
      $(".block-map").toggleClass("closed")
    })
    $(".toggle-category").on("click", function () {
      $("ul").toggleClass("category-tab")
    })
    $(".ml-3").on("click", function () {
      $(".flex-9").addClass("filter")
    })
    $(".hide-filter").on("click", function () {
      $(".flex-9").removeClass("filter")
    })
    $(".search").on("click", function () {
      $("#tiva-searchBox ").css({ opacity: 1, visibility: "visible", right: 0 })
    })
    $(".tiva-seachBoxClose").on("click", function () {
      $("#tiva-searchBox ").css({ opacity: 0, visibility: "hidden" })
    })
    if ($("#price-filter").length) {
      $("#price-filter").slider({ from: 0, to: 100, step: 1, smooth: true, round: 0, dimension: "&nbsp;$", skin: "plastic" })
    }
    ;
    if ($("#deal_of_day").length) {
      $("#deal_of_day").slick({ autoplay: true, centerMode: true, centerPadding: "40px", slidesToShow: 3, autoplaySpeed: 1500, arrows: true, nextArrow: '<span class="left"><i class="fa fa-angle-left" aria-hidden="true"></i></span>', prevArrow: '<span class="right"><i class="fa fa-angle-right" aria-hidden="true"></i></span>', datanav: true, responsive: [{ breakpoint: 767, settings: { arrows: false, centerMode: true, slidesToShow: 1 } }, { breakpoint: 480, settings: { arrows: false, centerMode: true, centerPadding: "40px", slidesToShow: 1 } }] })
    }
  })
}())
