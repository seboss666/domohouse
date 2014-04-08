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

/* 
 *	Renvoit un tableau contenant les informations nécéssaires à l'affichage & la mise en forme des icônes 
 * 			$deviceInfo['format']			- Type d'affichage de l'appareil : unknown/scene/group/switches/sensors (chaque type a une classe css dans domohouse.css)
 *			$deviceInfo['type1']['type']	- Type de donnée n°1 : doit être identique au libellé du tableau contenant les informations de l'appareil concerné
 *			$deviceInfo['type1']['value']	- Valeur n°1, y compris l'unité. Pour un variateur, renvoie la valeur d'éclairage
 *			$deviceInfo['type1']['etat']	- Etat du capteur ou de l'actionneur : définit le style du texte pour les sondes, et l'état de l'image pour les switches/groupes/scenes
 *												> voir domohouse.css
 *			$deviceInfo['type1']['action']	- Switches/Groupes/Scenes uniquement : Action à effectuer lors du clic sur l'image : On/Off/Toggle
 *			
 *	Dans le cas de sondes avec plusieurs capteurs, il faut renseigner les informations suivantes :
 *			$deviceInfo['type2']['type']	- Type de donnée n°2
 *			$deviceInfo['type2']['value']	- Valeur n°2, y compris l'unité
 */
function deviceType($device) {
	$deviceInfo = array();
	switch ($device['Type']) {
		case 'Lighting 1':
		case 'Lighting 2':
		case 'Lighting 6':
			$deviceInfo['format'] = 'switches';
			$deviceInfo['data']['switch']['type'] = 'switch';
			$deviceInfo['data']['switch']['etat'] = switchStatus($device);
			$deviceInfo['data']['switch']['action'] = 'Toggle';
			break;
		case 'temperature':
		case 'Temp':
			$deviceInfo['format'] = 'sensors';
			$deviceInfo['data']['temp']['type'] = 'temp';
			$deviceInfo['data']['temp']['value'] = number_format(floatval($device['Temp']), $decimals = 1, $dec_point = '.', $thousands_sep = '') . "°";
			$deviceInfo['data']['temp']['etat'] = tempStatus($device['Temp']);
			break;
		case 'Temp + Humidity':
			$deviceInfo['format'] = 'sensors';
			$deviceInfo['data']['temp']['type'] = 'temp';
			$deviceInfo['data']['temp']['value'] = number_format(floatval($device['Temp']), $decimals = 1, $dec_point = '.', $thousands_sep = '') . "°";
			$deviceInfo['data']['temp']['etat'] = tempStatus($device['Temp']);
			$deviceInfo['data']['humidity']['type'] = 'humidity';
			$deviceInfo['data']['humidity']['value'] = $device['Humidity'] . "%";
			break;
		case 'Scene':
			$deviceInfo['format'] = 'scene';
			$deviceInfo['data']['scene']['type'] = 'scene';
			$deviceInfo['data']['scene']['etat'] = 'switchon';
			$deviceInfo['data']['scene']['action'] = 'On';
			break;
		case 'Group':
			$deviceInfo['format'] = 'group';
			$deviceInfo['data']['group']['type'] = 'group';
			$deviceInfo['data']['group']['etat'] = groupStatus($device);
			$deviceInfo['data']['group']['action'] = 'Toggle';
			break;
		default:
			$deviceInfo['format'] = 'unknown';
			$deviceInfo['data']['unknown']['type'] = 'unknown';
	}
	return $deviceInfo;
}

/* Détection du type de switch en fonction de l'image */
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

/* Lecture de l'état du switch */
function switchStatus($device) {
	if ($device['Status'] == "On") {
		$status = switchImg($device['Image']) . "on";
	}
	else {
		$status = switchImg($device['Image']) . "off";
	}

	return $status;
}

/* Lecture de l'état du groupe */
function groupStatus($device) {
	if ($device['Status'] == "On") {
		$status = "switchon";
	}
	else {
		$status = "switchoff";
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
  $currentWeather = array();
  $weather = getWeather($townid);
  if (!isset($weather['Erreur'])) {
    $currentWeather['img'] = "img/weather/" . $weather['Current']['code'] . ".png";
    $currentWeather['temp'] = $weather['Current']['temp'];
  }
  else {
    $currentWeather ['Erreur'] = $weather['Erreur'];
  }
  return $currentWeather;
}


?>