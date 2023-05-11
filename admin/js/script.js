$(document).ready(function () {
  showMenu();
});
function showMenu() {
  $(".sidebar-menu>li").click(function () {
    // alert("ok");
    if ($(this).hasClass("active")) {
      $(this).children(".sidebar-menu-mini").slideUp();
      $(this).removeClass("active");
    } else {
      $(".sidebar-menu-mini").slideUp();
      $(this).children(".sidebar-menu-mini").slideDown();
      $(".sidebar-menu>li").removeClass("active");
      $(this).addClass("active");
    }
  });
}
// index
const acc = document.querySelector(".account");
const acc_menu = document.querySelector(".account-menu");

acc.onclick = function () {
  acc_menu.classList.toggle("hide");
};

// form-act
$(document).ready(function () {
  // Nhấn nút thêm mới
  $(".btn-add").click(function () {
    $(".form-act").fadeIn(500);
  });
  // Nhấn nút sửa
  $(".btn-edit").click(function () {
    $(".form-act").fadeIn(500);
  });
  // Nhấn dấu x tắt form
  $(".form-close").click(function () {
    $(".form-act").fadeOut(500);
  });
});
// phân trang danh sách
$(document).ready(function () {
  $("#table-manage").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
    },
    pageLength: 10,
    lengthMenu: [1, 2, 3, 4, 5, 10, 15, 20, 30, 50, 100],
    // order: [[0, "desc"]],
  });
});
// Hiện ảnh
function ImageFileAsUrl() {
  var fileSelected = document.getElementById("upload-img").files;
  // console.log(fileSelected.length);
  if (fileSelected.length > 0) {
    for (var i = 0; i < fileSelected.length; i++) {
      var fileToLoad = fileSelected[i];
      var fileReader = new FileReader();
      fileReader.onload = function (fileLoaderEvent) {
        var srcData = fileLoaderEvent.target.result;
        var newImage = document.createElement("img");
        newImage.src = srcData;
        document.getElementById("display-img").innerHTML += newImage.outerHTML;
      };
      fileReader.readAsDataURL(fileToLoad);
    }
  }
}
function ImageFileAsUrlUpdate() {
  var fileSelected = document.getElementById("upload-img-Update").files;
  // console.log(fileSelected.length);
  if (fileSelected.length > 0) {
    for (var i = 0; i < fileSelected.length; i++) {
      var fileToLoad = fileSelected[i];
      var fileReader = new FileReader();
      fileReader.onload = function (fileLoaderEvent) {
        var srcData = fileLoaderEvent.target.result;
        var newImage = document.createElement("img");
        newImage.src = srcData;
        document.getElementById("display-img-Update").innerHTML +=
          newImage.outerHTML;
      };
      fileReader.readAsDataURL(fileToLoad);
    }
  }
}

// Hiện ảnh
function ImageFileAsUrlNews() {
  var fileSelected = document.getElementById("upload-img-news").files;
  // console.log(fileSelected.length);
  if (fileSelected.length > 0) {
    for (var i = 0; i < fileSelected.length; i++) {
      var fileToLoad = fileSelected[i];
      var fileReader = new FileReader();
      fileReader.onload = function (fileLoaderEvent) {
        var srcData = fileLoaderEvent.target.result;
        var newImage = document.createElement("img");
        newImage.src = srcData;
        newImage.id = "js-remove-img";
        document.getElementById("display-img-news").appendChild(newImage);
        document.getElementById(
          "remove"
        ).innerHTML = `<a onclick="removeImg()" class="btn" id ="delete-btn">Xóa ảnh</a>`;
      };
      fileReader.readAsDataURL(fileToLoad);
    }
  }
}
function removeImg() {
  const element = document.getElementById("js-remove-img");
  const delete_btn = document.getElementById("delete-btn");
  element.remove();
  delete_btn.remove();
}
