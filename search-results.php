<?php
  include './include/connect.php';
  include './include/data.php';
  date_default_timezone_set("Asia/Ho_Chi_Minh");

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $categories = $_POST["categories"];
    $city = $_POST["city"];
    $district = $_POST["district"];
    $ward = isset($_POST["ward"])?$_POST["ward"]:"";
    $price = $_POST["price-range"];

    // var_dump($categories);
    // var_dump($city);
    // var_dump($district);
    // var_dump($ward);
    // var_dump($price);
    //  die();
     if (empty($ward)) {
      $ward_condition = "0";
    } else {
      $ward_condition = "";
      foreach ($ward as $value) {
        $ward_condition .=  $value . ", ";
      }
      $ward_condition = rtrim($ward_condition, ', ');

      $queryWard = $conn->prepare("SELECT fullname FROM tbl_ward WHERE id IN ($ward_condition)");
      $queryWard->execute();
      $resultsWard = $queryWard->fetchAll(PDO::FETCH_OBJ);

      $ward_name = "";
      foreach ($resultsWard as $key => $value) {
        $ward_name .=  $value->fullname . ", "; 
      }
      $ward_name = rtrim($ward_name, ', ');
    }
    //kết quả khi tìm kiếm theo danh mục + tỉnh + huyện + (không chọn xã=> tất cả các xã)
    if($categories >= 1 && $city != 1 && $district != 0 && $ward_condition == 0 && $price == 0){
      $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
      FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
      JOIN tbl_city ci ON ci.id = r.city_id
      JOIN tbl_district dis ON dis.id = r.district_id
      JOIN tbl_ward wa ON wa.id = r.ward_id
      JOIN tbl_new_type typ ON typ.id = r.news_type_id
      JOIN tbl_categories ca ON ca.id = r.category_id
      WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.news_type_id = 1
      ORDER BY r.id DESC LIMIT 10)
      UNION ALL
      (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
      FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
      JOIN tbl_city ci ON ci.id = r.city_id
      JOIN tbl_district dis ON dis.id = r.district_id
      JOIN tbl_ward wa ON wa.id = r.ward_id
      JOIN tbl_new_type typ ON typ.id = r.news_type_id
      JOIN tbl_categories ca ON ca.id = r.category_id
      WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.news_type_id != 1) ");
      $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
      $queryRoom->bindParam(':city',$city,PDO::PARAM_STR);
      $queryRoom->bindParam(':district',$district,PDO::PARAM_STR);
      $queryRoom->execute();
      $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);

      // Gọi ra tên danh mục, tỉnh, huyện
      $queryInfo = $conn->prepare("SELECT DISTINCT ca.classify AS category, city.fullname AS city, dis.fullname AS district FROM tbl_rooms r 
      JOIN tbl_categories ca  ON ca.id = r.category_id
      JOIN tbl_city city ON city.id = r.city_id
      JOIN tbl_district dis ON dis.id = r.district_id
      WHERE r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.status = 2");
      $queryInfo->bindParam(':category',$categories,PDO::PARAM_STR);
      $queryInfo->bindParam(':city',$city,PDO::PARAM_STR);
      $queryInfo->bindParam(':district',$district,PDO::PARAM_STR);
      $queryInfo->execute();
      $resultsInfo = $queryInfo->fetch(PDO::FETCH_OBJ);
      if($queryInfo -> rowCount()>0){
        $nameCategory = $resultsInfo -> category;
        $nameCity = $resultsInfo -> city;
        $nameDistrict = $resultsInfo -> district;
      }

    }
    //kết quả khi tìm kiếm theo danh mục + tỉnh + huyện + xã (chỉ các xã được chọn)
    elseif($categories >= 1 && $city != 1 && $district != 0 && $ward_condition != 0 && $price == 0){
      $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
      FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
      JOIN tbl_city ci ON ci.id = r.city_id
      JOIN tbl_district dis ON dis.id = r.district_id
      JOIN tbl_ward wa ON wa.id = r.ward_id
      JOIN tbl_new_type typ ON typ.id = r.news_type_id
      JOIN tbl_categories ca ON ca.id = r.category_id
      WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.news_type_id = 1 AND r.ward_id IN ($ward_condition)
      ORDER BY r.id DESC LIMIT 10)
      UNION ALL
      (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
      FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
      JOIN tbl_city ci ON ci.id = r.city_id
      JOIN tbl_district dis ON dis.id = r.district_id
      JOIN tbl_ward wa ON wa.id = r.ward_id
      JOIN tbl_new_type typ ON typ.id = r.news_type_id
      JOIN tbl_categories ca ON ca.id = r.category_id
      WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.news_type_id != 1 AND r.ward_id IN ($ward_condition)) ");
      $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
      $queryRoom->bindParam(':city',$city,PDO::PARAM_STR);
      $queryRoom->bindParam(':district',$district,PDO::PARAM_STR);
      $queryRoom->execute();
      $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);

      // Gọi ra tên danh mục, tỉnh, huyện, xã
      $queryInfo = $conn->prepare("SELECT DISTINCT ca.classify AS category, city.fullname AS city, dis.fullname AS district FROM tbl_rooms r 
      JOIN tbl_categories ca  ON ca.id = r.category_id
      JOIN tbl_city city ON city.id = r.city_id
      JOIN tbl_district dis ON dis.id = r.district_id
      WHERE r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.status = 2");
      $queryInfo->bindParam(':category',$categories,PDO::PARAM_STR);
      $queryInfo->bindParam(':city',$city,PDO::PARAM_STR);
      $queryInfo->bindParam(':district',$district,PDO::PARAM_STR);
      $queryInfo->execute();
      $resultsInfo = $queryInfo->fetch(PDO::FETCH_OBJ);
      if($queryInfo -> rowCount()>0){
        $nameCategory = $resultsInfo -> category;
        $nameCity = $resultsInfo -> city;
        $nameDistrict = $resultsInfo -> district;
      }

    }
    //kết quả khi tìm kiếm theo danh mục + tỉnh + huyện + khoảng giá + (không chọn xã=> tất cả các xã)
    elseif($categories >= 1 && $city != 1 && $district != 0 && $ward_condition == 0 && $price != 0){
      if($price == 1){
        $price_range = " giá dưới 1 triệu đồng ";

        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price < 1000000 AND r.news_type_id = 1
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price < 1000000 AND r.news_type_id != 1) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->bindParam(':city',$city,PDO::PARAM_STR);
        $queryRoom->bindParam(':district',$district,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      elseif($price == 2){
        $price_range = " giá từ 1 triệu - 1.5 triệu đồng ";

        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price <= 1500000 AND r.price >= 1000000 AND r.news_type_id = 1
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price <= 1500000 AND r.price >= 1000000 AND r.news_type_id != 1) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->bindParam(':city',$city,PDO::PARAM_STR);
        $queryRoom->bindParam(':district',$district,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      elseif($price == 3){
        $price_range = " giá từ 1.5 triệu - 2 triệu đồng ";
        
        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price <= 2000000 AND r.price >= 1500000 AND r.news_type_id = 1
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price <= 2000000 AND r.price >= 1500000 AND r.news_type_id != 1) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->bindParam(':city',$city,PDO::PARAM_STR);
        $queryRoom->bindParam(':district',$district,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      elseif($price == 4){
        $price_range = " giá từ 2 triệu - 3 triệu đồng ";

        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price <= 3000000 AND r.price >= 2000000 AND r.news_type_id = 1
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price < 3000000 AND r.price >= 2000000 AND r.news_type_id != 1) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->bindParam(':city',$city,PDO::PARAM_STR);
        $queryRoom->bindParam(':district',$district,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      else{
        $price_range = " giá trên 3 triệu đồng ";

        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price > 3000000 AND r.news_type_id = 1
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price > 3000000 AND r.news_type_id != 1) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->bindParam(':city',$city,PDO::PARAM_STR);
        $queryRoom->bindParam(':district',$district,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      // Gọi ra tên danh mục, tỉnh, huyện
      $queryInfo = $conn->prepare("SELECT DISTINCT ca.classify AS category, city.fullname AS city, dis.fullname AS district FROM tbl_rooms r 
      JOIN tbl_categories ca  ON ca.id = r.category_id
      JOIN tbl_city city ON city.id = r.city_id
      JOIN tbl_district dis ON dis.id = r.district_id
      WHERE r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.status = 2");
      $queryInfo->bindParam(':category',$categories,PDO::PARAM_STR);
      $queryInfo->bindParam(':city',$city,PDO::PARAM_STR);
      $queryInfo->bindParam(':district',$district,PDO::PARAM_STR);
      $queryInfo->execute();
      $resultsInfo = $queryInfo->fetch(PDO::FETCH_OBJ);
      if($queryInfo -> rowCount()>0){
        $nameCategory = $resultsInfo -> category;
        $nameCity = $resultsInfo -> city;
        $nameDistrict = $resultsInfo -> district;
      }
    }
    //kết quả khi tìm kiếm theo danh mục + tỉnh + huyện + xã (chỉ các xã được chọn) + khoảng giá
    elseif($categories >= 1 && $city != 1 && $district != 0 && $ward_condition != 0 && $price != 0){
      if($price == 1){
        $price_range = " giá dưới 1 triệu đồng ";

        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price < 1000000 AND r.news_type_id = 1 AND r.ward_id IN ($ward_condition)
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price < 1000000 AND r.news_type_id != 1 AND r.ward_id IN ($ward_condition)) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->bindParam(':city',$city,PDO::PARAM_STR);
        $queryRoom->bindParam(':district',$district,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      elseif($price == 2){
        $price_range = " giá từ 1 triệu - 1.5 triệu đồng ";

        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price <= 1500000 AND r.price >= 1000000 AND r.news_type_id = 1 AND r.ward_id IN ($ward_condition)
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price <= 1500000 AND r.price >= 1000000 AND r.news_type_id != 1 AND r.ward_id IN ($ward_condition)) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->bindParam(':city',$city,PDO::PARAM_STR);
        $queryRoom->bindParam(':district',$district,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      elseif($price == 3){
        $price_range = " giá từ 1.5 triệu - 2 triệu đồng ";
        
        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price <= 2000000 AND r.price >= 1500000 AND r.news_type_id = 1 AND r.ward_id IN ($ward_condition)
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price <= 2000000 AND r.price >= 1500000 AND r.news_type_id != 1 AND r.ward_id IN ($ward_condition)) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->bindParam(':city',$city,PDO::PARAM_STR);
        $queryRoom->bindParam(':district',$district,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      elseif($price == 4){
        $price_range = " giá từ 2 triệu - 3 triệu đồng ";

        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price <= 3000000 AND r.price >= 2000000 AND r.news_type_id = 1 AND r.ward_id IN ($ward_condition)
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price < 3000000 AND r.price >= 2000000 AND r.news_type_id != 1 AND r.ward_id IN ($ward_condition)) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->bindParam(':city',$city,PDO::PARAM_STR);
        $queryRoom->bindParam(':district',$district,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      else{
        $price_range = " giá trên 3 triệu đồng ";

        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price > 3000000 AND r.news_type_id = 1 AND r.ward_id IN ($ward_condition)
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.price > 3000000 AND r.news_type_id != 1 AND r.ward_id IN ($ward_condition)) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->bindParam(':city',$city,PDO::PARAM_STR);
        $queryRoom->bindParam(':district',$district,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      // Gọi ra tên danh mục, tỉnh, huyện
      $queryInfo = $conn->prepare("SELECT DISTINCT ca.classify AS category, city.fullname AS city, dis.fullname AS district FROM tbl_rooms r 
      JOIN tbl_categories ca  ON ca.id = r.category_id
      JOIN tbl_city city ON city.id = r.city_id
      JOIN tbl_district dis ON dis.id = r.district_id
      WHERE r.category_id = :category AND r.city_id = :city AND r.district_id = :district AND r.status = 2");
      $queryInfo->bindParam(':category',$categories,PDO::PARAM_STR);
      $queryInfo->bindParam(':city',$city,PDO::PARAM_STR);
      $queryInfo->bindParam(':district',$district,PDO::PARAM_STR);
      $queryInfo->execute();
      $resultsInfo = $queryInfo->fetch(PDO::FETCH_OBJ);
      if($queryInfo -> rowCount()>0){
        $nameCategory = $resultsInfo -> category;
        $nameCity = $resultsInfo -> city;
        $nameDistrict = $resultsInfo -> district;
      }
    }
    //kết quả khi tìm kiếm theo danh mục + khoảng giá
     elseif($categories >= 1 && $city == 1 && $district == 0 && $price != 0){
      if($price == 1){
        $price_range = " giá dưới 1 triệu đồng ";

        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.price < 1000000 AND r.news_type_id = 1
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.price < 1000000 AND r.news_type_id != 1) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      elseif($price == 2){
        $price_range = " giá từ 1 triệu - 1.5 triệu đồng ";

        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.price <= 1500000 AND r.price >= 1000000 AND r.news_type_id = 1
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.price <= 1500000 AND r.price >= 1000000 AND r.news_type_id != 1) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      elseif($price == 3){
        $price_range = " giá từ 1.5 triệu - 2 triệu đồng ";

        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.price <= 2000000 AND r.price >= 1500000 AND r.news_type_id = 1
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.price <= 2000000 AND r.price >= 1500000 AND r.news_type_id != 1) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      elseif($price == 4){
        $price_range = " giá từ 2 triệu - 3 triệu đồng ";

        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.price <= 3000000 AND r.price >= 2000000 AND r.news_type_id = 1
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.price < 3000000 AND r.price >= 2000000 AND r.news_type_id != 1) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }
      else{
        $price_range = " giá trên 3 triệu đồng ";

        $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.price > 3000000 AND r.news_type_id = 1
        ORDER BY r.id DESC LIMIT 10)
        UNION ALL
        (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
        FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
        JOIN tbl_city ci ON ci.id = r.city_id
        JOIN tbl_district dis ON dis.id = r.district_id
        JOIN tbl_ward wa ON wa.id = r.ward_id
        JOIN tbl_new_type typ ON typ.id = r.news_type_id
        JOIN tbl_categories ca ON ca.id = r.category_id
        WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.price > 3000000 AND r.news_type_id != 1) ");
        $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
        $queryRoom->execute();
        $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);
      }

      // Gọi ra tên danh mục
      $queryInfo = $conn->prepare("SELECT DISTINCT ca.classify AS category FROM tbl_rooms r 
      JOIN tbl_categories ca  ON ca.id = r.category_id
      JOIN tbl_city city ON city.id = r.city_id
      JOIN tbl_district dis ON dis.id = r.district_id
      WHERE r.category_id = :category AND r.status = 2 ");
      $queryInfo->bindParam(':category',$categories,PDO::PARAM_STR);
      $queryInfo->execute();
      $resultsInfo = $queryInfo->fetch(PDO::FETCH_OBJ);
      if($queryInfo -> rowCount()>0){
        $nameCategory = $resultsInfo -> category;
      }
    }
    //kết quả khi tìm kiếm theo danh mục 
    else{
      $queryRoom = $conn->prepare("(SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
      FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
      JOIN tbl_city ci ON ci.id = r.city_id
      JOIN tbl_district dis ON dis.id = r.district_id
      JOIN tbl_ward wa ON wa.id = r.ward_id
      JOIN tbl_new_type typ ON typ.id = r.news_type_id
      JOIN tbl_categories ca ON ca.id = r.category_id
      WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.news_type_id = 1
      ORDER BY r.id DESC LIMIT 10)
      UNION ALL
      (SELECT r.*, ci.name AS city, dis.fullname AS district, wa.fullname AS ward, us.fullname AS name_user, us.phone AS phone_user,us.avatar,ca.slug AS category_slug, NOW() AS today
      FROM tbl_rooms r JOIN tbl_user us on us.id = r.user_id
      JOIN tbl_city ci ON ci.id = r.city_id
      JOIN tbl_district dis ON dis.id = r.district_id
      JOIN tbl_ward wa ON wa.id = r.ward_id
      JOIN tbl_new_type typ ON typ.id = r.news_type_id
      JOIN tbl_categories ca ON ca.id = r.category_id
      WHERE r.status = 2 AND r.time_start <= NOW() AND r.time_stop >= NOW() AND r.category_id = :category AND r.news_type_id != 1) ");
      $queryRoom->bindParam(':category',$categories,PDO::PARAM_STR);
      $queryRoom->execute();
      $resultsRoom = $queryRoom->fetchAll(PDO::FETCH_OBJ);

      // Gọi ra tên danh mục
      $queryInfo = $conn->prepare("SELECT DISTINCT ca.classify AS category FROM tbl_rooms r 
      JOIN tbl_categories ca  ON ca.id = r.category_id
      JOIN tbl_city city ON city.id = r.city_id
      JOIN tbl_district dis ON dis.id = r.district_id
      WHERE r.category_id = :category AND r.status = 2 ");
      $queryInfo->bindParam(':category',$categories,PDO::PARAM_STR);
      $queryInfo->execute();
      $resultsInfo = $queryInfo->fetch(PDO::FETCH_OBJ);
      if($queryInfo -> rowCount()>0){
        $nameCategory = $resultsInfo -> category;
      }
    }
    // Tính phân trang
      $totalPages = $queryRoom ->rowCount();
      $item_per_page = 12;
      $current_page = !empty($_GET['page'])?$_GET['page']:1 ;
      $totalPages = ceil($totalPages/$item_per_page);

  }
  // Gọi ra số lượng bài viết trong chuyên mục
  $queryCate = $conn->prepare("SELECT ca.name, ca.slug, COUNT(r.category_id) as number FROM tbl_categories ca JOIN tbl_rooms r on r.category_id = ca.id where ca.status = 1 GROUP BY ca.name;");
  $queryCate->execute();
  $resultsCates  = $queryCate->fetchAll(PDO::FETCH_OBJ);


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kết quả tìm kiếm</title>
    <!-- link-css -->
    <?php include('./include/link-css.php');?>
    <!-- /link-css -->
    
  </head>
  <body>
    <!-- header -->
    <?php include('./include/header.php');?>
    <!-- /header -->

    <div id="main" style = "margin-top: 86px">
      <div class="container">
        <!--main-content -->
        <div id="post">
          <div class="post-header">
              <h1 class="page-title"><?php echo isset($nameCategory)? "Kết quả tìm kiếm cho ".$nameCategory : "Không có kết quả tìm kiếm hoặc các bài viết đã hết hạn!" ?> <?php echo (isset($ward_name) && isset($nameCategory))? " - ".$ward_name :""  ?> <?php echo (isset($nameCity) && isset($nameDistrict))? " - ".$nameDistrict." - ".$nameCity:""?><?php echo (isset($price_range) && isset($nameCategory))? " - ".$price_range:""?></h1>
              <p class="page-description">Kênh thông tin Phòng số 1 Việt Nam - Website đăng tin cho thuê phòng trọ, nhà nguyên căn, căn hộ, ở ghép nhanh, hiệu quả với 100.000+ tin đăng và 2.500.000 lượt xem mỗi tháng.</p>
          </div>
         
          <div class="row">
            <div class="col-8">
              <!-- Bài đăng hiển thị chính -->
              <section class="section">
                <div class="section-header">
                  <h2 class="post_title"><?php echo ($totalPages > 0) ? " Danh sách tin đăng" : "Không có kết quả" ?></h2>
                </div>
                <ul class="post-listing">
                  <?php if($totalPages > 0){
                   foreach ($resultsRoom as $key => $value) { 
                    if($key >= ($item_per_page*($current_page-1)) && $key <= ($item_per_page*$current_page-1)){?>
                    <li 
                      <?php if($value->news_type_id == 1){?>
                        class = "post-item post-vip vip-hot"
                      <?php } if($value->news_type_id == 2){?>
                        class = "post-item post-vip vip-1"
                      <?php } if($value->news_type_id == 3){?>
                        class = "post-item post-vip vip-2"
                      <?php } if($value->news_type_id == 4){?>
                        class = "post-item post-vip vip-3"
                      <?php } if($value->news_type_id == 5){?>
                        class = "post-item post-normal"
                      <?php } ?>
                    >
                      <figure class="post-thumb">
                        <a href="./article-details.php?id=<?php echo $value -> id ?>" class="clearfix">
                          <img src="<?php echo $value -> image_logo ?>" alt="">
                          <?php if($value->news_type_id == 1){?>
                            <span class="bookmark"></span>
                          <?php }?>
                        </a>
                      </figure>
                      <div class="post-meta">
                        <h3 class="title">
                          <a href="./article-details.php?id=<?php echo $value -> id ?>">
                          <span 
                            <?php if($value->news_type_id == 1){?>
                              class="star star-5"
                            <?php } if($value->news_type_id == 2){?>
                              class="star star-4"
                            <?php } if($value->news_type_id == 3){?>
                              class="star star-3"
                            <?php } if($value->news_type_id == 4){?>
                              class="star star-2"
                            <?php } ?>>
                          </span>
                          <?php echo $value -> name ?></a>
                        </h3>
                        <div class="detail">
                          <span class="price"><i class="fa-solid fa-circle-dollar-to-slot"></i>
                            <?php
                              $tien = (int) $value->price;
                              $bien =0;
                              if(strlen($tien)>=7){
                                $bien =  $tien/1000000;
                                echo $bien.(($value -> category_slug == "Cho-thue-Homestay")?" triệu/ngày":" triệu/tháng");
                              }else {
                                $bien = number_format($tien,0,",",".");
                                echo $bien.(($value -> category_slug == "Cho-thue-Homestay")?" đ/ngày":" đ/tháng");
                              }
                            ?>
                          </span>
                          <span class="area"><i class="fa-solid fa-expand"></i><?php echo $value -> area ?>m&#178;</span>
                          <span class="post-time">
                            <?php 
                              $time = time() - strtotime($value->created_ad);
                              if(floor($time/60/60/24)==0){
                                if(floor($time/60/60)==0){
                                  echo(ceil($time/60)." phút trước");
                                }else{
                                  echo(floor($time/60/60)." tiếng trước");
                                }
                              }else{
                                echo(floor($time/60/60/24)." ngày trước");
                              }
                            ?>
                          </span>
                        </div>
                        <div class="detail">
                          <span class="post-location">
                            <p><i class="fa-solid fa-location-dot"></i><?php echo $value -> ward.', '.$value -> district.', '.$value -> city ?></p>
                          </span>
                          
                        </div>
                        <div class="content"> 
                          <p class="post-summary">
                            <?php echo strip_tags($value -> contents) ?>
                          </p>
                          </div>
                        <div class="contact">
                          <div class="avatar">
                            <div class="avata-img">
                              <?php if(strlen($value -> avatar) != 0){ ?>
                                <img src="<?php echo $value -> avatar ?>" alt="">
                              <?php }else{ ?>
                                <img src="./image/default-user.png" alt="">
                              <?php }?>
                              <!-- <i class="fa-solid fa-user"></i> -->
                            </div>
                            <span class="author-name"><?php echo $value -> name_user ?></span>
                            <?php if($value->news_type_id == 1 || $value->news_type_id == 2){?>
                              <i class="fa-regular fa-circle-check check"></i>
                            <?php }?>
                          </div>
                          <?php if($value->news_type_id == 1 || $value->news_type_id == 2 ){?>
                          <a href="tel:<?php echo $value -> phone_user ?>" class="btn-quick-call" target="_blank" ><i class="fa-solid fa-phone"></i><?php echo $value -> phone_user ?></a>
                          <?php }?>
                          <?php if($value->news_type_id == 1 ){?>
                          <a href="http://zalo.me/<?php echo $value -> phone_user ?>" class="btn-quick-zalo"  target="_blank">Nhắn zalo</a>
                          <?php }?>
                        </div>
                      </div>
                    </li>
                    <?php } } }?>
                </ul>
              </section> 
              <!-- phân trang -->
              <?php include './include/page-division.php'; ?>
              <!-- /Phân trang -->
            </div>
            <div class="col-4">
               <!-- Các danh mục cho thuê -->
                <?php include('./include/list-of-lease.php');?>
              
              <!-- Các bài viết mới nhất -->
                <?php include('./include/list-news.php');?>  
              
            </div>
          </div>
        </div>
        <!-- main-content -->
        <!-- why-support -->
        <?php include('./include/why-support.php');?>
        <!-- /why-support -->
      </div>
    </div>

    <!-- footer + js-->
    <?php include('./include/footer.php');?>
    <!-- /footer + js -->
    
  </body>
</html>