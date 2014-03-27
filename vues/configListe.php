<?php ob_start(); ?>

		<div class="row clearfix">
			<div class="column half">
		    		<ul id="SortedList">

<?php
	$devicesFinal = getAllDevices();
	foreach($liste as $idx) {
		foreach ($devicesFinal as $device) {
			if($device['Type'] != 'Scene') {
				if ($idx == $device['idx']) {
?>

					<li id="<?php echo $device['idx']; ?>">
					
<?php
					$deviceInfo = deviceTypeWithoutAction($device);
					if ($deviceInfo['type'] == 'img') {
?>
						<div class="icone"><img src="img/<?php echo $deviceInfo['status']; ?>"></img></div>

<?php
					}
					elseif ($deviceInfo['type'] == 'text') {
?>

						<div class="icone <?php echo $deviceInfo['subtype'] . " " . $deviceInfo['status']; ?>"><?php echo $deviceInfo['value']; ?>°</div>

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
			<div class="column half">
				<ul id="UnusedList">
<?php
	foreach ($devicesFinal as $device) {
		if($device['Type'] != 'Scene') {
			$IsUsed = 0;
			foreach($liste as $idx) {
				if ($idx == $device['idx']) {
					$IsUsed = 1;
				}
			}
			
			if($IsUsed != 1) {
?>
					<li id="<?php echo $device['idx']; ?>">
					
<?php
				$deviceInfo = deviceTypeWithoutAction($device);
				if ($deviceInfo['type'] == 'img') {
?>
						<div class="icone"><img src="img/<?php echo $deviceInfo['status']; ?>"></img></div>

<?php
				}
				elseif ($deviceInfo['type'] == 'text') {
?>

						<div class="icone <?php echo $deviceInfo['subtype'] . " " . $deviceInfo['status']; ?>"><?php echo $deviceInfo['value']; ?>°</div>

<?php
				}	
?>

						<div class="nom"><p><?php echo $device['Name']; ?></p></div>
					</li>
<?php
			}
		}
	}	
?>
				</ul>
			</div>
			<div class="column full">
				<form method="POST" action="index.php?page=configSave" id="triForm" name="triForm">
					<input type="hidden" id="ListeId" name="id" value="<?php echo implode(",", $liste); ?>">
					<input class="sendbutton" type="submit" value="Enregistrer">
				</form>
			</div>
		    </div>
		</div>

<?php $contenu = ob_get_clean() ?>

<?php require 'vues/gabarit.php' ?>