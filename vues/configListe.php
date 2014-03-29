<?php ob_start(); ?>

		<div class="row clearfix">
			<div class="column half">
		    		<ul id="SortedList">

<?php
	$devicesFinal = getAllDevices();
	$i = 0;
	foreach($liste_idx as $idx) {
		foreach ($devicesFinal as $device) {
			if($device['Type'] != 'Scene') {
				if ($idx == $device['idx']) {
					$deviceInfo = deviceType($device);
?>

					<li id="<?php echo $device['idx'] . ":" . $liste[$i]['type']; ?>">
					
<?php
					if ($deviceInfo[$liste[$i]['type']]['format'] == 'img') {
?>

						<div><img src="img/<?php echo $deviceInfo[$liste[$i]['type']]['etat']; ?>"></img></div>

<?php
					}
					elseif ($deviceInfo[$liste[$i]['type']]['format'] == 'text') {
?>

						<div class="<?php echo $deviceInfo[$liste[$i]['type']]['format'] . " " . $deviceInfo[$liste[$i]['type']]['etat']; ?>">
							<?php echo $deviceInfo[$liste[$i]['type']]['value']; ?>
						</div>

<?php
					}
?>

					<div class="nom"><p><?php echo $device['Name']; ?></p></div>
					</li>
					
<?php
				}
			}	
		}
		$i++;
	}
?>

				</ul>
			</div>
			<div class="column half">
				<ul id="UnusedList">
				
<?php
	foreach ($devicesFinal as $device) {
		if($device['Type'] != 'Scene') {
			$deviceInfo = deviceType($device);
			foreach($deviceInfo as $deviceData) {
				$IsUsed = 0;
				foreach($liste as $idx_type) {
					if (($idx_type['idx'] == $device['idx']) and ($idx_type['type'] == $deviceData['type'])) {
						$IsUsed = 1;
					}
				}
			
				if($IsUsed != 1) {
?>

					<li id="<?php echo $device['idx'] . ":" . $deviceData['type']; ?>">
					
<?php
					if ($deviceData['format'] == 'img') {
?>
						
						<div><img src="img/<?php echo $deviceData['etat']; ?>"></img></div>

<?php
					}
					elseif ($deviceData['format'] == 'text') {
?>

						<div class="<?php echo $deviceData['format'] . " " . $deviceData['etat']; ?>"><?php echo $deviceData['value']; ?></div>

<?php
					}
?>

						<div class="nom"><p><?php echo $device['Name']; ?></p></div>
					</li>
<?php
				}
			}
		}
	}	
?>
				</ul>
			</div>
			<div class="column full">
				<form method="POST" action="index.php?page=configSave" id="triForm" name="triForm">
					<input type="hidden" id="ListeId" name="id" value="<?php echo $listeInputDefaut; ?>">
					<input class="sendbutton" type="submit" value="Enregistrer">
				</form>
			</div>
		    </div>
		</div>

<?php $contenu = ob_get_clean() ?>

<?php require 'vues/gabarit.php' ?>