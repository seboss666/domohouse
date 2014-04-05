<?php 

$config = file_get_contents("include/configData.json");
$parsedJSON = json_decode($config, true);
$Town = $parsedJSON['Town'];
$IP = $parsedJSON['IP'];
$Port = $parsedJSON['Port'];

function getJson($request) {
	global $IP, $Port;
	$rawInfo = @file_get_contents("http://" . $IP .":" . $Port . "/json.htm?" . $request);
	if ($rawInfo === false) {
		throw new Exception('Impossible de joindre Domoticz');
	}
	  else {
		$resultat = json_decode($rawInfo, true);
		return $resultat;
	}
}

function getAllDevices() {
	$devices = getJson('type=devices&filter=all&used=true&order=Name');
	if (isset($devices['result'])) {
		return $devices['result'];
	}
	else {
		throw new Exception('Aucun appareil renvoyé');
	}
}

function getPlan($id) {
	$plan = getJson('type=devices&plan=' . $id);
	if (isset($plan['result'])) {
		return $plan['result'];
	}
	else {
		throw new Exception('Plan inexistant ou vide');
		
	}
}

function getWeather($townid) {

	$result = file_get_contents('http://weather.yahooapis.com/forecastrss?w=' . $townid . '&u=c');
	$xml = simplexml_load_string($result);
	 
	$xml->registerXPathNamespace('yweather', 'http://xml.weather.yahoo.com/ns/rss/1.0');
	
	$location = $xml->channel->xpath('yweather:location');
	 
	if(!empty($location)) {
		foreach($xml->channel->item as $item){
			$current = $item->xpath('yweather:condition');
			$forecast = $item->xpath('yweather:forecast');
			$current = $current[0];
		}
		$weatherDetail = array('Location' => $location, 'Current' => $current, 'Forecast' => $forecast);
	}
	else {
		$weatherDetail = array('Erreur' => 'Aucun résultat');
	}
	return $weatherDetail;


}

?>