<?php ob_start(); ?>

<?php
	foreach ($devicesFinal as $device) {
		echo deviceType($device);
	}

?>


<?php $contenu = ob_get_clean() ?>

<?php require 'vues/gabarit.php' ?>