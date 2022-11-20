// active menu
const currentLocation = location.href;
const menuItem = document.querySelectorAll(".navlist");
const menuLength = menuItem.length;
for (let i = 0; i < menuLength; i++) {
  if (menuItem[i].href === currentLocation) {
    menuItem[i].className = "active";
  } else {
    menuItem[i].className = "";
  }
}

// sick slider
$(document).ready(function () {
  $(".image-slider").slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    Infinity: true,
    autoplay: true,
    autoplaySpeed: 2000,
    dots: true,
    prevArrow: `<button type='button' class='slick-prev pull-left slick-arrow' ><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-next pull-right slick-arrow'><i class="fa-solid fa-chevron-right"></i></button>`,
  });
});

// Thanh scroll
// kéo xuống khoảng cách 500px thì xuất hiện nút Top-up
var offset = 500;
// thời gian di trượt 0.75s ( 1000 = 1s )
var duration = 750;
$(function () {
  $(window).scroll(function () {
    if ($(this).scrollTop() > offset) {
      $("#top-up").fadeIn(duration);
    } else {
      $("#top-up").fadeOut(duration);
    }
  });
  $("#top-up").click(function () {
    $("body,html").animate({ scrollTop: 0 }, duration);
  });
});
// menu logged
const manage = document.querySelector(".manage");
const manage_menu = document.querySelector(".manage-menu");

manage.onclick = function () {
  manage_menu.classList.toggle("up");
};
