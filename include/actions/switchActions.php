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

function sceneOn($idx) {
	global $IP, $Port;
    $rawInfo = file_get_contents("http://" . $IP .":" . $Port . "/json.htm?type=command&param=switchscene&idx=" . $idx . "&switchcmd=On");
    return $rawInfo;
}

function groupOn($idx) {
	global $IP, $Port;
    $rawInfo = file_get_contents("http://" . $IP .":" . $Port . "/json.htm?type=command&param=switchscene&idx=" . $idx . "&switchcmd=On");
    return $rawInfo;
}

function groupOff($idx) {
	global $IP, $Port;
    $rawInfo = file_get_contents("http://" . $IP .":" . $Port . "/json.htm?type=command&param=switchscene&idx=" . $idx . "&switchcmd=Off");
    return $rawInfo;
}

function groupToggle($data,$idx) {
    if ($data == "On") {
		$rawInfo = groupOff($idx);
    }
    elseif ($data == "Off") {
		$rawInfo = groupOn($idx);
    }
	elseif ($data == "Mixed") {
		$rawInfo = groupOff($idx);
	}
    return $rawInfo;
}

?>
