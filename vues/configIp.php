<?php ob_start(); ?>

		<div class="row clearfix">
			<div class="column full">
				<form method="POST" action="index.php?page=configSaveIp" id="triForm" name="triForm" onSubmit="return check();">
					Adresse IP: <input type="text" name="IP" id="IP" value="<?php echo $parsedJSON['IP']; ?>"><br>
					Port : <input type="text" name="Port" id="Port" value="<?php echo $parsedJSON['Port']; ?>"><br>
					<input class="sendbutton" type="submit" value="Enregistrer">
				</form>
			</div>
		</div>


<?php $contenu = ob_get_clean() ?>

<?php require 'vues/gabarit.php' ?>