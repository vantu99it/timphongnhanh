<?php

  function check_broken_link($url){
      $handle   = curl_init($url);
      if (false === $handle)
      {
          return false;
      }
      curl_setopt($handle, CURLOPT_HEADER, false);
      curl_setopt($handle, CURLOPT_FAILONERROR, true);  // this works
      curl_setopt($handle, CURLOPT_NOBODY, true);
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, false);
      $connectable = curl_exec($handle);
      curl_close($handle);    
      return $connectable;
  }
  $url = "http://qcvn109.gov.vn/dvhc/XSLT_Tree/dvhc_data.xml";
  $thoi_gian_cap_nhat = "";
  if(check_broken_link($url) === TRUE){
      $xml = file_get_contents($url);
      $data = simplexml_load_string($xml);
      // var_dump($data); die();
  }
  else{
      echo '<tr class="danger"><th colspan="5" style="text-align:center"><h5>KHÔNG THỂ KẾT NỐI ĐẾN MÁY CHỦ VIETCOMBANK</h5></th></tr>';
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- link-css -->
    <?php include('./include/link-css.php');?>
    <!-- /link-css -->
    
  </head>
  <body>
      <select name="" id="">
        
     <?php if ($data === false) {
          echo '<tr class="danger"><th colspan="5" style="text-align:center"><h5>DỮ LIỆU BỊ LỖI</h5></th></tr>';
      }
      else {                                      
          foreach ($data as $key => $value) {
            if($value->Cap == "TINH"){?>
              <option value="<?php echo $value->MaDVHC ?>"><?php echo $value->Ten ?></option>
            <?php } } } ?>
      </select>
  </body>
</html>