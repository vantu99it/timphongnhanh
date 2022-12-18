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
        document.getElementById("display-img").innerHTML += newImage.outerHTML;
      };
      fileReader.readAsDataURL(fileToLoad);
    }
  }
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
        document.getElementById("display-imgs").innerHTML += newImage.outerHTML;
      };
      fileReader.readAsDataURL(fileToLoad);
    }
  }
}
// phân trang
$(document).ready(function () {
  $("#table-manage").DataTable({
    language: {
      url: "https://cdn.datatables.net/plug-ins/1.12.1/i18n/vi.json",
    },
    pageLength: 5,
    lengthMenu: [1, 2, 3, 4, 5, 10, 15, 20, 30, 50, 100],
    // ordering: false,
    order: [[0, "desc"]],
  });
});

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
