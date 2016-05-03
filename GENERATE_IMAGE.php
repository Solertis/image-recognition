<?php
header("Content-type: image/jpeg");

$ID = $_POST['ID'];
$URL = $_POST['URL'];

$INITIAL_X = $_POST['INITIAL_X'];
$INITIAL_Y = $_POST['INITIAL_Y'];
$FINAL_X = $_POST['FINAL_X'];
$FINAL_Y = $_POST['FINAL_Y'];

$PLATE = $_POST['PLATE'];
if($PLATE=="") { $PLATE="Unkown"; }
$DATE = date("m/d/Y");

$image = imagecreatefromjpeg($URL);

$red = imagecolorallocatealpha($image, 255, 5, 5, 60); // 0 0
imagefilledrectangle($image, $INITIAL_X, $INITIAL_Y, $FINAL_X, $FINAL_Y, $red);

   $blue = imagecolorallocatealpha($image, 8, 75, 138, 90); 
   $marge_right = 0;
   $marge_bottom = 0;
   imagefilledrectangle($image, 0, imagesy($image)-90, imagesx($image) - $marge_right, imagesy($image) - $marge_bottom, $black);

$stamp = imagecreatefrompng('https://www.snowflake.net/wp-content/themes/snowflake/assets/img/logo.png');
$marge_right = 20;
$marge_bottom = 20;
$sx = imagesx($stamp);
$sy = imagesy($stamp);

imagecopy($image, $stamp, imagesx($image) - $sx - $marge_right, imagesy($image) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));

  $text = "www.snowflakeco.com/AI";
  $font_path = 'OpenSans-Semibold.ttf';
  $white = imagecolorallocate($image, 255, 255, 255);
  $marge_right = 180;
  $marge_bottom = 22;
  imagettftext($image, 9, 0, imagesx($image) - $marge_right, imagesy($image) - $marge_bottom, $white, $font_path, $text);


  $text = "Plate: " . $PLATE;
  $font_path = 'OpenSans-Regular.ttf';
  $white = imagecolorallocate($image, 255, 255, 255);
  $marge_right = 180;
  $marge_bottom = 9;
  imagettftext($image, 8, 0, imagesx($image) - $marge_right, imagesy($image) - $marge_bottom, $white, $font_path, $text);

  $text = $DATE;
  $font_path = 'OpenSans-Regular.ttf';
  $white = imagecolorallocate($image, 255, 255, 255);
  $marge_right = 85;
  $marge_bottom = 9;
  imagettftext($image, 8, 0, imagesx($image) - $marge_right, imagesy($image) - $marge_bottom, $white, $font_path, $text);

  $text = $ID;
  $font_path = 'OpenSans-Regular.ttf';
  $white = imagecolorallocate($image, 255, 255, 255);
  $marge_bottom = 9;
  imagettftext($image, 8, 0, 17, imagesy($image) - $marge_bottom, $white, $font_path, $text);

   imagesetthickness($image,2);
   $black = imagecolorallocatealpha($image, 0, 0, 0, 25); 
   imagerectangle($image, $INITIAL_X, $INITIAL_Y, $FINAL_X, $FINAL_Y, $black);


  imagejpeg($image, './capture_car/'.$ID.'.jpg');
?>