<?php ob_start(); ?>

		<div class="row clearfix">
		
<?php
	$i = 0;
	foreach ($devicesFinal as $device) {
?>

			<div class="column half">
			
<?php
		$deviceInfo = deviceType($device);
		if ($deviceInfo[$liste[$i]['type']]['format'] == 'img') {
?>

				<img class="icone" onclick="document.location.href = 'index.php?page=switch&action=<?php echo $deviceInfo[$liste[$i]['type']]['action'] . "&data=" . $device['Status'] . "&idx=" . $device['idx']; ?>'" src="img/<?php echo $deviceInfo[$liste[$i]['type']]['etat']; ?>.png"></img>

<?php
		}
		elseif ($deviceInfo[$liste[$i]['type']]['format'] == 'text') {
?>

				<div class="icone <?php echo $deviceInfo[$liste[$i]['type']]['format'] . " " . $deviceInfo[$liste[$i]['type']]['etat']; ?>">
					<?php echo $deviceInfo[$liste[$i]['type']]['value']; ?>
				</div>
				
<?php
		}
		$i++;
?>

				<div class="nom"><p><?php echo $device['Name']; ?></p></div>
			</div>
			
<?php
	}
?>

		</div>

<?php $contenu = ob_get_clean() ?>

<?php require 'vues/gabarit.php' ?>