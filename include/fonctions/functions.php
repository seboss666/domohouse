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
  switch ($device['Type']) {
    case 'Lighting 1':
    case 'Lighting 2':
    case 'Lighting 6':
      switch ($device['SwitchType']) {
        case 'On/Off':
          $bloc = '<div onclick="switchAction(\'Toggle\', \'' . $device['Status'] . '\', \'' . $device['idx'] . '\')" class="column half"><span class="switch ' . switchStatus($device) . '"></span>' . $device['Name'] . '</div>
          ';
          break;
        case 'Dimmer':
          if($device['Status'] == 'Off') {
            $bloc = '<div onclick="switchAction(\'Toggle\', \'' . $device['Status'] . '\', \'' . $device['idx'] . '\')" class="column half"><span class="switch ' . switchStatus($device) . '"></span>' . $device['Name'] . '</div>
            ';
          }
          else {
            $bloc = '<div onclick="switchAction(\'Toggle\', \'On\', \'' . $device['idx'] . '\')" class="column half"><span class="switch ' . switchStatus($device) . '"></span>' . $device['Name'] . '</div>
            ';
          }
        break;
      }
      break;
    case 'temperature':
    case 'Temp':
        $bloc = '<div class="column half"><div class="switch temp ' . tempStatus($device['Temp']) . '">' . number_format(floatval($device['Temp']), $decimals = 1, $dec_point = '.', $thousands_sep = '') . '°' .'</div>' . $device['Name'] . '</div>
        ';
      break;
    case 'Temp + Humidity':
        $bloc = '<div class="column half"><div class="switch2 temp ' . tempStatus($device['Temp']) . '">' . number_format(floatval($device['Temp']), $decimals = 1, $dec_point = '.', $thousands_sep = '')  . '°' .'</div><div class="switch2">' . $device['Humidity'] . '%</div>' . $device['Name'] . '</div>
        ';
      break;
    default:
        $bloc = '<div class="column half"><div class="switch notrecognized"></div>' . $device['Name'] . '</div>
        ';
  }
  return $bloc;
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

?>