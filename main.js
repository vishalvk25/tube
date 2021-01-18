var main_slider = new Swiper('.swiper-container.main-slider', {
  effect: "fade",
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  autoplay: {
    delay: 5000,
  },
});
var testimonial = new Swiper('.swiper-container.testimonial', {
  effect: "flip",
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev"
  },
  autoplay: {
    delay: 5000,
  },
});
$(".swiper-container.opswiper-container").each(function (index, element) {
  var $this = $(this);
  var z = $this.addClass("instance-" + index);
  $this.find(".swiper-button-prev").addClass("btn-prev-" + index);
  $this.find(".swiper-button-next").addClass("btn-next-" + index);
  var pswiper = new Swiper(".instance-" + index, {
    effect: "flip",
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".btn-next-" + index,
      prevEl: ".btn-prev-" + index
    },
  });
});


//Srcroll to top
$(document).ready(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('#scroll').fadeIn();
    } else {
      $('#scroll').fadeOut();
    }
  });
  $('#scroll').click(function () {
    $("html, body").animate({
      scrollTop: 0
    }, 600);
    return false;
  });

  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();

      document.querySelector(this.getAttribute('href')).scrollIntoView({
        behavior: 'smooth'
      });
    });
  });
  //Popover
  $(function () {
    $('.paypal-popover').popover({
      container: 'body'
    });
  });
  //Change pos/background/padding/add shadow on nav when scroll event happens 
  $(function () {
    var navbar = $('.navbar');

    $(window).scroll(function () {
      if ($(window).scrollTop() <= 40) {
        navbar.removeClass('navbar-scroll');
      } else {
        navbar.addClass('navbar-scroll');
        navbar.css("z-index", "99999999");
      }
    });
  });
});