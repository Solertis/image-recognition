<?php
date_default_timezone_set('America/Los_Angeles');

$Image = $_GET['URL'];
$Image_Unique = date("mdYhisA");

// DEMO API KEYS
// CAN BE CHANGED FOR CUSTOM APPLICATION

$post = [
    'secret_key' => 'sk_DEMODEMODEMODEMODEMODEMO',
    'tasks' => 'plate',
    'image_url'   => $Image,
    'country'   => 'us'
];

include "help/processor.php";
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

$response = curl_exec($ch);
curl_close($ch);

$json = json_decode($response, true);

// ADDITIONAL REQUEST VARIABLES
//$json['color'][0]['confidence']
//$json['color'][0]['value']
//$json['makemodel'][0]['confidence']
//$json['makemodel'][0]['value']
//$json['make'][0]['confidence']
//$json['make'][0]['value']

$PLATE_NUMBER   = $json['plate']['results'][0]['plate'];
$PLATE_NUMBER_C = $json['plate']['results'][0]['confidence'];

$PLATE_REGION_C = $json['plate']['results'][0]['region_confidence'];
$PLATE_REGION   = $json['plate']['results'][0]['region'];

$PLATE_0_x = $json['plate']['results'][0]['coordinates'][0][x];
$PLATE_0_y = $json['plate']['results'][0]['coordinates'][0][y];
$PLATE_1_x = $json['plate']['results'][0]['coordinates'][1][x];
$PLATE_1_y = $json['plate']['results'][0]['coordinates'][1][y];
$PLATE_2_x = $json['plate']['results'][0]['coordinates'][2][x];
$PLATE_2_y = $json['plate']['results'][0]['coordinates'][2][y];
$PLATE_3_x = $json['plate']['results'][0]['coordinates'][3][x];
$PLATE_3_y = $json['plate']['results'][0]['coordinates'][3][y];

//CURL POST
//POST FIELDS, COORDINATE RESULTS, PLATE, PLATE NUMBER, IMAGE URL
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_URL,"http://www.snowflakeco.com/live/software/recognition/api/GENERATE_IMAGE.php");
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, "URL=$Image&ID=$Image_Unique&INITIAL_X=$PLATE_0_x&INITIAL_Y=$PLATE_0_y&FINAL_X=$PLATE_2_x&FINAL_Y=$PLATE_2_y&PLATE=$PLATE_NUMBER");
  curl_exec ($curl);
  curl_close ($curl);
?>
<!-- Display Image -->
<img src="http://www.snowflakeco.com/live/software/recognition/api/capture_car/<?php echo $Image_Unique; ?>.jpg" height="400">
<BR>
RUNNING

