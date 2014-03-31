<?php ob_start(); ?>


<div class="column full">
<?php
	if (!isset($weather['Erreur'])) { 
		include('include/modeles/weathercodes.php');
?>
	<h1 style="margin-bottom: 0">Ville : <?php echo $weather['Location'][0]['city'] . ',' . $weather['Location'][0]['region']; ?></h1>
	<small><?php echo $weather['Current']['date']; ?></small>
	<h2>Current Conditions</h2>
	<p>
		<span style="font-size:56px; font-weight:bold;"><?php echo $weather['Current']['temp']; ?>&deg;C</span>
		<br/>
		<img src="http://l.yimg.com/a/i/us/we/52/<?php echo $weather['Current']['code']; ?>.gif" style="width: 52px; height: 52px; vertical-align: middle;"/>&nbsp;<?php echo $weathercodes[(string)$weather['Current']['code']]; ?>
	</p>
	<h2>Forecast</h2>

<?php 
		foreach($weather['Forecast'] as $futur) {
			echo $futur['day'] . ' - ' . $weathercodes[(string)$futur['code']] . '. Code: ' . $futur['code'] . ' High: ' . $futur['high'] . ' Low: ' . $futur['low'] . '<br>';
		}
	}
	else {
		echo $weather['Erreur'];
	}
?>
</div>

<?php $contenu = ob_get_clean(); ?>

<?php require('vues/gabarit.php'); ?>