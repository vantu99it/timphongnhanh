// Chuyên mục
$(document).ready(function () {
  $.ajax({
    url: "http://localhost:8081/timphongnhanh/include/get_categories_data.php",
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
    url: "http://localhost:8081/timphongnhanh/include/get_city_data.php",
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
      "http://localhost:8081/timphongnhanh/include/get_district_data.php?city_id=" +
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
      "http://localhost:8081/timphongnhanh/include/get_ward_data.php?district_id=" +
      idDistrict,
    dataType: "json",
    success: function (data) {
      $("#ward").html("");
      for (i = 0; i < data.length; i++) {
        var ward = data[i];
        // var str = `
        //   <option value="${ward["id"]}">
        //       ${ward["name"]}
        //   </option>`;
        var str = ` 
          <label><input type='checkbox' name='ward[]' value="${ward["id"]}"> ${ward["name"]}</label>
          `;
        $("#ward").append(str);
      }
    },
  });
}
