// menu active
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
        newImage.id = "js-remove-img";
        document.getElementById("display-img").appendChild(newImage);
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
//hiện nhiều ảnh
function ImageFileAsUrls() {
  var fileSelected = document.getElementById("upload-imgs").files;
  // console.log(fileSelected.length);
  if (fileSelected.length > 0) {
    for (var i = 0; i < fileSelected.length; i++) {
      var fileToLoad = fileSelected[i];
      var fileReader = new FileReader();
      fileReader.onload = function (fileLoaderEvent) {
        var srcData = fileLoaderEvent.target.result;
        var newImage = document.createElement("img");
        newImage.src = srcData;
        newImage.id = "js-remove-imgs";
        document.getElementById("display-imgs").appendChild(newImage);
      };
      fileReader.readAsDataURL(fileToLoad);
    }
    document.getElementById(
      "removes"
    ).innerHTML = `<a onclick="removeImgs()" class="btn" id ="delete-btns">Xóa tất cả</a>`;
  }
}
function removeImgs() {
  const element = document.getElementsByClassName("js-remove-imgs");
  const delete_btn = document.getElementById("delete-btns");
  element.remove();
  delete_btn.remove();
}
// phân trang
$(document).ready(function () {
  $("#table-manage").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
    },
    pageLength: 10,
    lengthMenu: [1, 2, 3, 4, 5, 10, 15, 20, 30, 50, 100],
    // ordering: false,
    // order: [[0, "desc"]],
  });
});

// coppy code
function copyCode() {
  var copyText = document.getElementById("code-pay");
  copyText.select();
  copyText.setSelectionRange(0, 99999); //Thiết bị di động
  navigator.clipboard.writeText(copyText.value);
  alert("Đã sao chép: " + copyText.value);
}
function copyCodeVCB() {
  var copyText = document.getElementById("code-payVCB");
  copyText.select();
  copyText.setSelectionRange(0, 99999); //Thiết bị di động
  navigator.clipboard.writeText(copyText.value);
  alert("Đã sao chép: " + copyText.value);
}
function copyCodeMB() {
  var copyText = document.getElementById("code-payMB");
  copyText.select();
  copyText.setSelectionRange(0, 99999); //Thiết bị di động
  navigator.clipboard.writeText(copyText.value);
  alert("Đã sao chép: " + copyText.value);
}
function copyCodeVTin() {
  var copyText = document.getElementById("code-payVTin");
  copyText.select();
  copyText.setSelectionRange(0, 99999); //Thiết bị di động
  navigator.clipboard.writeText(copyText.value);
  alert("Đã sao chép: " + copyText.value);
}
function copyCodeND() {
  var copyText = document.getElementById("code-payND");
  copyText.select();
  copyText.setSelectionRange(0, 99999); //Thiết bị di động
  navigator.clipboard.writeText(copyText.value);
  alert("Đã sao chép: " + copyText.value);
}

// // dấu phẩy số
// $("input.mask").each((i, ele) => {
//   let clone = $(ele).clone(false);
//   clone.attr("type", "text");
//   let ele1 = $(ele);
//   clone.val(Number(ele1.val()).toLocaleString("en"));
//   $(ele).after(clone);
//   $(ele).hide();
//   clone.mouseenter(() => {
//     ele1.show();
//     clone.hide();
//   });
//   setInterval(() => {
//     let newv = Number(ele1.val()).toLocaleString("en");
//     if (clone.val() != newv) {
//       clone.val(newv);
//     }
//   }, 10);

//   $(ele).mouseleave(() => {
//     $(clone).show();
//     $(ele1).hide();
//   });
// });
