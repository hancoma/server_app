<?php
include "db_config_s.php";
$msg=$_POST["uuid"];
$link=$_POST["link"];
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["profile_image"]["name"]);
$extension = end($temp);
$linkall=explode("&",$link);
$countall=count($linkall);
$cnt1=$countall-1;
$cnt2=$countall-2;
$cnt3=$countall-3;
$cnt4=$countall-4;
$memberuid=$linkall[$cnt1];
$mode=$linkall[$cnt2];
$category=$linkall[$cnt3];
$code=$linkall[$cnt4];
  $today=time();

if ($mode=="simple2") {
  $upload_path="_var/photo/";
} else if ($mode=="talent") {
  $upload_path="talent_img/";
} else  if ($mode=="loveletter") {
  $upload_path="upfile/";

} else if ($mode=="letdrive") {
  $upload_path="upfile/";
}

  if ($_FILES["profile_image"]["error"] > 0) {
    echo "Error Upload Photo";
  } else {
    echo "Upload Photo end";

    if (file_exists($upload_path . $_FILES["profile_image"]["name"])) {
      echo $_FILES["profile_image"]["name"] . " already exists. ";
    } else {
      move_uploaded_file($_FILES["profile_image"]["tmp_name"],
      $upload_path .$memberuid."_".$today.".jpg");
    }
    $file_name=$memberuid."_".$today.".jpg";

  }
   $today=time();
// 사진 방형잡기 
 $saveFile1=$upload_path . $memberuid."_".$today.".jpg";
 img_rot_box($saveFile1);
 if ($mode=="simple2") {
       // 본인 사진 저장
// $thumbnail_path2="./s_images/200_200_".$file_name;
 $thumbnail_path="./profile_img/s_".$file_name;
$thumbnail_path2="./profile_icon/icon_".$file_name;

conv_img( $saveFile1, $thumbnail_path,  "20", 'N') ;
 creimg($thumbnail_path, $thumbnail_path2,"100", "100", "70", 'Y') ;
 }
 if ($mode=="talent") {
  $thumbnail_path="./talent/s_".$file_name;
  conv_img($saveFile1, $thumbnail_path,  "40", 'N') ;
 }
$today=time();
  $_QKEY = "file,uuid,link,reg_date,memberuid,mode,code";
    $_QVAL = "'$file_name','$uuid','$link','$today','$memberuid','$mode','$code'";
    $query = "INSERT INTO upload ($_QKEY) values ($_QVAL)"; 
    $result = mysql_query($query);





if ($mode=="simple2") {

 
// 썸내일 저장 
$_QKEY = "memberuid,photo,save_date";
$_QVAL = "'$memberuid','$file_name','$today'";
$query = "INSERT INTO rb_s_photo ($_QKEY) values ($_QVAL)"; 
    $result = mysql_query($query);



} else if ($mode=="talent") {


$_QKEY = "memberuid,photo,category,save_date";
$_QVAL = "'$memberuid','$file_name','$category','$today'";


   $query = "INSERT INTO talent ($_QKEY) values ($_QVAL)"; 
   $result = mysql_query($query);

} else  if ($mode=="loveletter") {
  
  $today=time();
$_QKEY = "memberuid,upfile,reg_date,sub_code,code";
$_QVAL = "'$memberuid','$file_name','$today','$sub_code','$code'";
   $query = "INSERT INTO loveletter ($_QKEY) values ($_QVAL)"; 
$result = mysql_query($query);

} else if ($mode=="letdrive") {
  $today=time();
$_QKEY = "memberuid,upfile,reg_date,sub_code,code";
$_QVAL = "'$memberuid','$file_name','$today','$sub_code','$code'";
   $query = "INSERT INTO letdrive ($_QKEY) values ($_QVAL)"; 
$result = mysql_query($query);
}



 
        
        

?>
<?
  function img_rot_box ( $up_saveFile ) {

  $exifData = exif_read_data($up_saveFile); 
        if($exifData['Orientation'] == 6) { 
            // 시계방향으로 90도 돌려줘야 정상인데 270도 돌려야 정상적으로 출력됨 
            $degree = 270; 
        } 
        else if($exifData['Orientation'] == 8) { 
            // 반시계방향으로 90도 돌려줘야 정상 
            $degree = 90; 
        } 
        else if($exifData['Orientation'] == 3) { 
            $degree = 180; 
        } 
        if($degree) { 
            if($exifData[FileType] == 1) { 
                $source = imagecreatefromgif($up_saveFile); 
                $source = imagerotate ($source , $degree, 0); 
                imagegif($source, $up_saveFile); 
            } 
            else if($exifData[FileType] == 2) { 
                $source = imagecreatefromjpeg($up_saveFile); 
                $source = imagerotate ($source , $degree, 0); 
                imagejpeg($source, $up_saveFile); 
            } 
            else if($exifData[FileType] == 3) { 
                $source = imagecreatefrompng($up_saveFile); 
                $source = imagerotate ($source , $degree, 0); 
                imagepng($source, $up_saveFile); 
            } 

            
        } 
        }

 function creimg($src, $dest, $maxWidth, $maxHeight, $quality, $imgcut) { 
  
  if (file_exists($src)  && isset($dest)) {      
  // path info 
      $destInfo  = pathInfo($dest); 
      
      // image src size 
      $srcSize  = getImageSize($src); 
  
      // image dest size $destSize[0] = width, $destSize[1] = height 
  $srcRatio= $srcSize[0]/$srcSize[1]; 
  //$destRatio = $maxWidth/$maxHeight; 
      
  $RatioX = $maxWidth/$srcSize[0];    // 최대 이미지 너비 / 원본 이미지 너비  
      $RatioY = $maxHeight/$srcSize[1];    // 최대 이미지 높이 / 원본 이미지 높이 
  
  if ($imgcut == N){ //원본 이미지를 자르지 않고 비율대로 축소 할 경우 
  //if ($destRatio > $srcRatio){ 
  if ($RatioX <= $RatioY) { 
  $destSize[0] = $maxWidth; 
  $destSize[1] = $maxWidth/$srcRatio; 
  } else { 
     $destSize[1] = $maxHeight; 
  $destSize[0] = $maxHeight*$srcRatio; 
  } 
  } else { //원본이미지를 비율대로 축소하고 사이즈에 맞게 자를 경우 
  //if ($destRatio < $srcRatio){ 
  if ($RatioX <= $RatioY) { 
  $destSize[0] = round(($srcSize[0]*$maxHeight)/$srcSize[1]); //$maxHeight*$srcRatio; 
  $destSize[1] = $maxHeight; 
  $offsetX = round(($destSize[0] - $maxWidth) / 2); // 각각 좌우로 잘라낼 길이 
  $offsetY = 0; 
  } else { 
  $destSize[0] = $maxWidth; 
  $destSize[1] = round(($srcSize[1]*$maxWidth)/$srcSize[0]); //$maxWidth/$srcRatio; 
  $offsetX = 0;    
  $offsetY = round(($destSize[1] - $maxHeight ) / 2);    // 각각 상하로 잘라낼 길이 

  } 
  } 
      
      // path rectification 

      if ($destInfo['extension'] == "gif"){ 
          $dest = substr_replace($dest, 'jpg', -3); 
      } 
      
  // src image 
      switch ($srcSize[2]) { 
          case 1: //GIF 
          $srcImage = imageCreateFromGif($src); 
          break; 
          
          case 2: //JPEG 
          $srcImage = imageCreateFromJpeg($src); 
          break; 
          
          case 3: //PNG 
          $srcImage = imageCreateFromPng($src); 
          break; 
          
          default: 
          return false; 
          break; 
      } 

      // true color image, with anti-aliasing 
  if ($imgcut == N){  
  $destImage = imageCreateTrueColor($destSize[0], $destSize[1]);    
  } else {    
      $destImage = imageCreateTrueColor($maxWidth, $maxHeight);      
  } 
  
      imageAntiAlias($destImage,true);      

  
  // resampling 
  if ($imgcut == N){ 
  imageCopyResampled($destImage, $srcImage,0,0,0,0,$destSize[0],$destSize[1],$srcSize[0],$srcSize[1]); 
  }else{ 
  imageCopyResampled($destImage, $srcImage, 0, 0, $offsetX, $offsetY, $destSize[0], $destSize[1], ImagesX($srcImage)-$offsetX, ImagesY($srcImage)-$offsetY); 
  } 

          
      // generating image 
      switch ($srcSize[2]){ 
          case 1: 
  imageGif($destImage,$dest); 
  break; 

          case 2: 
          imageJpeg($destImage,$dest,$quality); 
          break; 
          
          case 3: 
          imagePng($destImage,$dest); 
          break; 
      } 
      return true; 
  } else { 
      return false; 
  } 

}

function conv_img($src, $dest, $quality, $imgcut) { 
  
  if (file_exists($src)  && isset($dest)) {      
  // path info 
      $destInfo  = pathInfo($dest); 
      
      // image src size 
      $srcSize  = getImageSize($src); 
    $maxWidth=$srcSize[0];
    $maxHeight=$srcSize[1];
      // image dest size $destSize[0] = width, $destSize[1] = height 
  $srcRatio= $srcSize[0]/$srcSize[1]; 
  //$destRatio = $maxWidth/$maxHeight; 
      
  $RatioX = $maxWidth/$srcSize[0];    // 최대 이미지 너비 / 원본 이미지 너비  
      $RatioY = $maxHeight/$srcSize[1];    // 최대 이미지 높이 / 원본 이미지 높이 
  
  if ($imgcut == N){ //원본 이미지를 자르지 않고 비율대로 축소 할 경우 
  //if ($destRatio > $srcRatio){ 
  if ($RatioX <= $RatioY) { 
  $destSize[0] = $maxWidth; 
  $destSize[1] = $maxWidth/$srcRatio; 
  } else { 
     $destSize[1] = $maxHeight; 
  $destSize[0] = $maxHeight*$srcRatio; 
  } 
  } else { //원본이미지를 비율대로 축소하고 사이즈에 맞게 자를 경우 
  //if ($destRatio < $srcRatio){ 
  if ($RatioX <= $RatioY) { 
  $destSize[0] = round(($srcSize[0]*$maxHeight)/$srcSize[1]); //$maxHeight*$srcRatio; 
  $destSize[1] = $maxHeight; 
  $offsetX = round(($destSize[0] - $maxWidth) / 2); // 각각 좌우로 잘라낼 길이 
  $offsetY = 0; 
  } else { 
  $destSize[0] = $maxWidth; 
  $destSize[1] = round(($srcSize[1]*$maxWidth)/$srcSize[0]); //$maxWidth/$srcRatio; 
  $offsetX = 0;    
  $offsetY = round(($destSize[1] - $maxHeight ) / 2);    // 각각 상하로 잘라낼 길이 

  } 
  } 
      
      // path rectification 

      if ($destInfo['extension'] == "gif"){ 
          $dest = substr_replace($dest, 'jpg', -3); 
      } 
      
  // src image 
      switch ($srcSize[2]) { 
          case 1: //GIF 
          $srcImage = imageCreateFromGif($src); 
          break; 
          
          case 2: //JPEG 
          $srcImage = imageCreateFromJpeg($src); 
          break; 
          
          case 3: //PNG 
          $srcImage = imageCreateFromPng($src); 
          break; 
          
          default: 
          return false; 
          break; 
      } 

      // true color image, with anti-aliasing 
  if ($imgcut == N){  
  $destImage = imageCreateTrueColor($destSize[0], $destSize[1]);    
  } else {    
      $destImage = imageCreateTrueColor($maxWidth, $maxHeight);      
  } 
  
      imageAntiAlias($destImage,true);      

  
  // resampling 
  if ($imgcut == N){ 
  imageCopyResampled($destImage, $srcImage,0,0,0,0,$destSize[0],$destSize[1],$srcSize[0],$srcSize[1]); 
  }else{ 
  imageCopyResampled($destImage, $srcImage, 0, 0, $offsetX, $offsetY, $destSize[0], $destSize[1], ImagesX($srcImage)-$offsetX, ImagesY($srcImage)-$offsetY); 
  } 

          
      // generating image 
      switch ($srcSize[2]){ 
          case 1: 
  imageGif($destImage,$dest); 
  break; 

          case 2: 
          imageJpeg($destImage,$dest,$quality); 
          break; 
          
          case 3: 
          imagePng($destImage,$dest); 
          break; 
      } 
      return true; 
  } else { 
      return false; 
  } 

}

?>

