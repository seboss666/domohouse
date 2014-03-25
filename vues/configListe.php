<?php ob_start(); ?>

		<div class="row clearfix">

		    <div class="column full">
			<table>
				<tbody id="SortedList">
					<tr class="sort-disabled"><th colspan="2">Appareils à afficher</th></tr>
<?php

	foreach($liste as $idx) {
		foreach ($devicesFinal as $device) {
			if($device['Type'] != 'Scene') {
				if ($idx == $device['idx']) {
?>

					<tr id="<?php echo $device['idx']; ?>">
						<td><?php echo $device['Name']; ?></td>
						<td><?php echo $device['Type']; ?></td>
					</tr>

<?php
				}
			}	
		}
	}

?>
				</tbody>
			</table>
			<br />
			<table>
				<tbody id="UnusedList">
					<tr class="sort-disabled"><th colspan="2">Appareils inutilisés</th></tr>
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

					<tr id="<?php echo $device['idx']; ?>">
						<td><?php echo $device['Name']; ?></td>
						<td><?php echo $device['Type']; ?></td>
					</tr>

<?php
			}
		}
	}
?>
				</tbody>
			</table>
			<br>
			<form method="POST" action="index.php?page=configSave" id="testForm" name="testForm">
				<input type="hidden" id="ListeId" name="id" value="<?php echo implode(",", $liste); ?>">
				<input class="sendbutton" type="submit" value="Enregistrer">
			</form>
		    </div>
		</div>

<?php $contenu = ob_get_clean() ?>

<?php require 'vues/gabarit.php' ?>