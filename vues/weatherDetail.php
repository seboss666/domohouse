<?php ob_start(); ?>


<div class="column full">

<?php
	if (!isset($weather['Erreur'])) { 
		include('include/modeles/weathercodes.php');
?>

	<small>Dernière mise à jour : <?php echo $weather['Current']['date']; ?></small>
	<p>
		<span style="font-size:56px; font-weight:bold;"><?php echo $weather['Current']['temp']; ?>&deg;C</span>
		<br/>
		<img src="img/weather/<?php echo $weather['Current']['code']; ?>.png" style="width: 128px; height: 128px; vertical-align: middle;"/>&nbsp;<?php echo $weathercodes[(string)$weather['Current']['code']]; ?>
	</p>
	<h2>Prévisions</h2>

<?php 
		foreach($weather['Forecast'] as $futur) {
?>

	<div class="forecast" style="width: 50px";>
		<span><?php echo $futur['day']; // . ' High: ' . $futur['high'] . ' Low: ' . $futur['low'] . '<br>';?></span>
		<img src="img/weather/<?php echo $futur['code']; ?>.png" style="width: 48px; height: 48px; vertical-align: middle;"/>
	</div>		
	
<?php
		}
	}
	else {
		echo $weather['Erreur'];
	}
?>

</div>

<?php $contenu = ob_get_clean(); ?>

<?php require('vues/gabarit.php'); ?>