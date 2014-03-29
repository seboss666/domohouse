<?php ob_start(); ?>

<h1>Domohouse</h1>

<p style="text-align: left;">
	A simplified user interface for Domoticz<br>
	Bought to you by Tom23, Seikwa and Seboss666<br>
	Project page on Github : https://github.com/seboss666/domohouse
</p>

<?php $contenu = ob_get_clean() ?>

<?php require 'vues/gabarit.php' ?>