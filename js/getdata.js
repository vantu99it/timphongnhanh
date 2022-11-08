// Chuyên mục
$(document).ready(function () {
  $.ajax({
    url: "http://localhost:8081/phongtro/include/get_categories_data.php",
    dataType: "json",
    success: function (data) {
      $("#categories").html("");
      for (i = 0; i < data.length; i++) {
        var categories = data[i];
        var str = `<option value="${categories["id"]}">
        ${categories["classify"]}</option>`;
        $("#categories").append(str);
      }
    },
  });
});

// Lấy tỉnh
$(document).ready(function () {
  $.ajax({
    url: "http://localhost:8081/phongtro/include/get_city_data.php",
    dataType: "json",
    success: function (data) {
      $("#city").html("");
      for (i = 0; i < data.length; i++) {
        var city = data[i];
        var str = `<option value="${city["id"]}">
        ${city["name"]}</option>`;
        $("#city").append(str);
      }

      $("#city").on("change", function (e) {
        getDistrict();
      });
    },
  });
});

// Lấy huyện

function getDistrict() {
  var idCity = $("#city").val();
  $.ajax({
    url:
      "http://localhost:8081/phongtro/include/get_district_data.php?city_id=" +
      idCity,
    dataType: "json",
    success: function (data) {
      $("#district").html("");
      for (i = 0; i < data.length; i++) {
        var district = data[i];
        var str = ` 
          <option value="${district["id"]}">
              ${district["name"]} 
          </option>`;
        $("#district").append(str);
      }
      $("#district").on("change", function (e) {
        getWard();
      });
    },
  });
}

// Lấy xã
function getWard() {
  var idDistrict = $("#district").val();
  $.ajax({
    url:
      "http://localhost:8081/phongtro/include/get_ward_data.php?district_id=" +
      idDistrict,
    dataType: "json",
    success: function (data) {
      $("#ward").html("");
      for (i = 0; i < data.length; i++) {
        var ward = data[i];
        var str = ` 
          <option value="${ward["id"]}">
              ${ward["name"]} 
          </option>`;
        $("#ward").append(str);
      }
    },
  });
}

// category
// $(document).ready(function () {
//   $.ajax({
//     url: "http://localhost:8081/phongtro/include/get_categories_data.php",
//     dataType: "json",
//     success: function (data) {
//       $("#category").html("");
//       for (i = 0; i < data.length; i++) {
//         var category = data[i];
//         var str = `
//           <li>
//             <h2>
//             <i class="fa-solid fa-check"></i>
//               <a href="#" >${category["name"]}</a>
//             </h2>
//             <span class="count">(1200)</span>
//           </li>`;
//         $("#category").append(str);
//       }
//     },
//   });
// });
