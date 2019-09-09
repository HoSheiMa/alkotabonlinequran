var swiper = new Swiper(".swiper-container", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  slidesPerView: "auto",
  coverflowEffect: {
    rotate: 50,
    stretch: 0,
    depth: 100,
    modifier: 1,
    slideShadows: true
  },
  pagination: {
    el: ".swiper-pagination"
  }
});

particlesJS.load("page-1", "lib/particles.json", function() {
  console.log("callback - particles.js config loaded");
});

function fadeBody() {
  $("body").transition("fade down");
}

$(document).ready(() => {
  $('a[href!="#"]').each(e => {
    $($('a[href!="#"]')[e]).on("click", ev => {
      fadeBody();

      setTimeout(() => {
        window.location.assign($($('a[href!="#"]')[e]).attr("href"));
      }, 200);
      return false;
    });
  });
});

if ($(window).width() < 576) {
  $(".label.ui.ribbon").each((e, el) => {
    console.log(e, el);
    $(el).removeClass("right");
  });
}

$(".ui.dropdown").dropdown({
  clearable: true
});
