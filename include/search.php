<div id="search">
          <div class="search">
            <form action="./search-results.php" method="post">
              <div class="search-item">
                <i class="fa-solid fa-house"></i>
                <select class="autobox" id="categories" name = "categories">
                  <option value="0">Chọn loại phòng</option>
                </select>
              </div>
              <div class="search-item">
                <i class="fa-solid fa-location-dot"></i>
                <select  class="autobox autobox-city " id="city" name = "city">
                  <option value="-1">Chọn tỉnh</option>
                </select>
              </div>
              <div class="search-item">
                <i class="fa-solid fa-thumbtack"></i>
                <select  class="autobox autobox-district" id="district" name = "district">
                  <option value="0">Chọn quận/huyện</option>
                </select>
              </div>
              <div class="search-item checkbox" id = "checkbox-ward">
                <i class="fa-solid fa-thumbtack"></i>
                <span style = "margin-left: 8px">Chọn phường/xã</span>
                <div  class="autobox autobox-ward" id="ward" name = "ward">
                </div>
              </div>
              <div class="search-item">
                <i class="fa-solid fa-circle-dollar-to-slot"></i>
                <select  class="autobox" id="price-range" name = "price-range">
                  <option value="0">Chọn khoảng giá</option>
                  <option value="1">Dưới 1 triệu</option>
                  <option value="2">Từ 1 triệu - 1.5 triệu</option>
                  <option value="3">Từ 1.5 triệu - 2 triệu</option>
                  <option value="4">Từ 2 triệu - 3 triệu</option>
                  <option value="5">Trên 3 triệu</option>
                </select>
              </div>
              <div class="search-item " style = "width:60%">
                <input type="submit" value="Tìm kiếm">
              </div>
            </form>
          </div>
        </div>

        