<?php

function switchOn($idx) {
    global $IP, $Port;
    $rawInfo = file_get_contents("http://" . $IP .":" . $Port . "/json.htm?type=command&param=switchlight&idx=" . $idx . "&switchcmd=On&level=0");
    return $rawInfo;
}

function switchOff($idx) {
    global $IP, $Port;
    $rawInfo = file_get_contents("http://" . $IP .":" . $Port . "/json.htm?type=command&param=switchlight&idx=" . $idx . "&switchcmd=Off&level=0");
    return $rawInfo;
}

function switchToggle($data,$idx) {
    if ($data == "On") {
		$rawInfo = switchOff($idx);
    }
    elseif ($data == "Off") {
		$rawInfo = switchOn($idx);
    }
    return $rawInfo;
}

?>
