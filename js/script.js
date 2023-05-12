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

  $(".section-slick").slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    Infinity: true,
    autoplay: true,
    autoplaySpeed: 2000,
    prevArrow: `<button type='button' class='slick-prev slick-left slick-arrow' ><i class="fa-solid fa-chevron-left"></i></button>`,
    nextArrow: `<button type='button' class='slick-next slick-right slick-arrow'><i class="fa-solid fa-chevron-right"></i></button>`,
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

// noti (thông báos)
const btn_noti = document.querySelector(".btn-noti");
const noti_menu = document.querySelector(".noti-menu");

if (btn_noti && noti_menu) {
  btn_noti.onclick = function () {
    noti_menu.classList.toggle("up");
  };
}

// menu logged
const manage = document.querySelector(".manage");
const manage_menu = document.querySelector(".manage-menu");

if (manage && manage_menu) {
  manage.onclick = function () {
    manage_menu.classList.toggle("up");
  };
}

// Kiểm tra mật khẩu
function checkInput() {
  var inputElm = document.getElementById("password-new").value;
  var regexLetter = /[a-z]/;
  var regexDigit = /\d/;
  var regexSpace = /\s/g;
  var regexSpecialChar = /\W/;
  var regexCapital = /[A-Z]/;

  var error1 = document.getElementById("error1");
  var error2 = document.getElementById("error2");
  var error3 = document.getElementById("error3");
  var error4 = document.getElementById("error4");
  var error5 = document.getElementById("error5");

  // var submitBtn = document.getElementById("submit-button");
  var submitBtn = document.querySelector(".submit-button");

  if (inputElm === "") {
    error1.style.display = "none";
    error2.style.display = "none";
    error3.style.display = "none";
    error4.style.display = "none";
    error5.style.display = "none";
    // inputElm.style.border = "";
    error1.innerHTML = "Vui lòng nhập trường này";
    submitBtn.disabled = true;
  } else {
    if (regexLetter.test(inputElm)) {
      error1.innerHTML = "✓ Có chứa ít nhất 1 chữ cái thường";
      error1.style.color = "green";
      error1.style.display = "block";
      submitBtn.disabled = false;
    } else {
      error1.innerHTML = "✕ Phải chứa ít nhất 1 chữ cái thường";
      error1.style.color = "red";
      error1.style.display = "block";
      submitBtn.disabled = true;
    }

    if (regexDigit.test(inputElm)) {
      error2.innerHTML = "✓ Có chứa ít nhất 1 chữ số";
      error2.style.color = "green";
      error2.style.display = "block";
      submitBtn.disabled = false;
    } else {
      error2.innerHTML = "✕ Phải chứa ít nhất 1 chữ số";
      error2.style.color = "red";
      error2.style.display = "block";
      submitBtn.disabled = true;
    }

    if (!regexSpace.test(inputElm)) {
      error3.innerHTML = "✓ Không chứa khoảng trắng";
      error3.style.color = "green";
      error3.style.display = "block";
      submitBtn.disabled = false;
    } else {
      error3.innerHTML = "✕ Đang chứa 1 khoảng trắng";
      error3.style.color = "red";
      error3.style.display = "block";
      submitBtn.disabled = true;
    }

    if (regexSpecialChar.test(inputElm)) {
      error4.innerHTML = "✓ Có chứa ít nhất 1 ký tự đặc biệt";
      error4.style.color = "green";
      error4.style.display = "block";
      submitBtn.disabled = false;
    } else {
      error4.innerHTML = "✕ Phải chứa ít nhất 1 ký tự đặc biệt";
      error4.style.color = "red";
      error4.style.display = "block";
      submitBtn.disabled = true;
    }

    if (regexCapital.test(inputElm)) {
      error5.innerHTML = "✓ Có chứa ít nhất 1 chữ in hoa";
      error5.style.color = "green";
      error5.style.display = "block";
      submitBtn.disabled = false;
    } else {
      error5.innerHTML = "✕ Phải chứa ít nhất 1 ký tụ in hoa";
      error5.style.color = "red";
      error5.style.display = "block";
      submitBtn.disabled = true;
    }
  }
}

// tabs
function openTab(evt, tabName) {
  var i, tabcontent, tablinks;
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " active";
}
// Mặc định hiển thị nội dung của Tab 1
// document.getElementById("tab-comment").style.display = "block";
var tabComment = document.getElementById("tab-comment");
if (tabComment) {
  tabComment.style.display = "block";
}

//checkbox ward
const checkboxWard = document.getElementById("checkbox-ward");
const wardDiv = document.getElementById("ward");

checkboxWard.addEventListener("click", function () {
  if (wardDiv.classList.contains("active")) {
    wardDiv.classList.remove("active");
  } else {
    wardDiv.classList.add("active");
  }
});

$(document).ready(function () {
  $("#categories").select2({
    placeholder: "Danh mục",
    allowClear: true,
  });
  $("#city").select2({
    placeholder: "Chọn tỉnh/thành phố",
    allowClear: true,
  });
  $("#district").select2({
    placeholder: "Chọn quận/huyện",
    allowClear: true,
  });
  $("#price-range").select2({
    placeholder: "Chọn khoảng giá",
    allowClear: true,
  });
});
