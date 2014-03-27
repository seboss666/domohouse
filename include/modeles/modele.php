<?php 

$config = file_get_contents("include/configData.json");
$parsedJSON = json_decode($config, true);
$IP = $parsedJSON['IP'];
$Port = $parsedJSON['Port'];

function getAllDevices() {
  global $IP, $Port;

  $rawInfo = @file_get_contents("http://" . $IP .":" . $Port . "/json.htm?type=devices&filter=all&used=true&order=Name");
  if ($rawInfo === false) {
    die('Impossible de joindre Domoticz');
  }
  else {
    $resultat = json_decode($rawInfo, true);
    return $resultat['result'];
  }
}

?>