<?php 

require('include/modeles/modele.php');

function filterDevices($idxList) {
  $devlist = getAllDevices();
  $finalDev = array();
  foreach ($idxList as $idx) {
    foreach ($devlist as $device) {
      if ($device['idx'] == $idx) {
        $finalDev[] = $device;
      }
    }
  }
  
return $finalDev;
}

function planDevices($idplan) {
  $devlist = getPlan($idplan);
  return $devlist;
}

function deviceType($device) {
  $deviceInfo = array();
  switch ($device['Type']) {
    case 'Lighting 1':
    case 'Lighting 2':
    case 'Lighting 6':
	$deviceInfo['switch']['format'] = 'img';
	$deviceInfo['switch']['type'] = 'switch';
	$deviceInfo['switch']['etat'] = switchStatus($device);
	$deviceInfo['switch']['action'] = 'Toggle';
	break;
    case 'temperature':
    case 'Temp':
	$deviceInfo['temp']['format'] = 'text';
	$deviceInfo['temp']['type'] = 'temp';
	$deviceInfo['temp']['value'] = number_format(floatval($device['Temp']), $decimals = 1, $dec_point = '.', $thousands_sep = '') . "°";
	$deviceInfo['temp']['etat'] = tempStatus($device['Temp']);
	break;
    case 'Temp + Humidity':
	$deviceInfo['temp']['format'] = 'text';
	$deviceInfo['temp']['type'] = 'temp';
	$deviceInfo['temp']['value'] = number_format(floatval($device['Temp']), $decimals = 1, $dec_point = '.', $thousands_sep = '') . "°";
	$deviceInfo['temp']['etat'] = tempStatus($device['Temp']);
	$deviceInfo['humidity']['format'] = 'text';
	$deviceInfo['humidity']['type'] = 'humidity';
	$deviceInfo['humidity']['value'] = $device['Humidity'] . "%";
	break;
    default:
	$deviceInfo['unknown']['format'] = 'img';
	$deviceInfo['unknown']['type'] = 'unknown';
	$deviceInfo['unknown']['etat'] = 'notrecognized';
  }
  return $deviceInfo;
}

//Fonctions pour les switches

function switchImg($image) {
  switch ($image) {
    case 'Light':
      $status = "light";
      break;
    case 'Generic':
      $status = "switch";
      break;
    case 'Fan':
      $status = "fan";
      break;
    case 'TV':
      $status = "tv";
      break;
    case 'WallSocket':
      $status = "wall";
      break;
    case 'Harddisk':
      $status = "hdd";
      break;
    case 'Printer':
      $status = "printer";
      break;
    case 'Amplifier':
      $status = "ampli";
      break;
    case 'Computer':
      $status = "comput";
      break;
    case 'Speaker':
      $status = "speak";
      break;
    case 'Fireplace':
      $status = "fire";
      break;
  }

  return $status;
}

function switchStatus($device) {
  if ($device['Status'] == "On") {
    $status = switchImg($device['Image']) . "on";
  }
  else {
    $status = switchImg($device['Image']) . "off";
  }

  return $status;
}

//Fonctions pour les sondes de température

function tempStatus($temperature) {
  $data = floatval($temperature);
  if ($data>=0 && $data<10) {
    $status = "r0010";
  }
  elseif ($data>=10 && $data<20) {
    $status = "r1020";
  }
  elseif ($data>=20 && $data<30) {
    $status = "r2030";
  }
  elseif ($data>=30 && $data<40) {
    $status = "r3040";
  }
  elseif ($data>=40 && $data<50){
    $status = "r4050";
  }
  else {
    $status = "r50plus";
  }

  return $status;
}

function weatherHeader($townid) {
  $weather = getWeather($townid);
  $currentWeather['img'] = "http://l.yimg.com/a/i/us/we/52/" . $weather['Current']['code'] . ".gif";
  $currentWeather['temp'] = $weather['Current']['temp'];

  return $currentWeather;
}


?>