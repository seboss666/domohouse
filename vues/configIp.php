<?php ob_start(); ?>

		<div class="row clearfix">
			<div class="column full">
				<form method="POST" action="index.php?page=configSaveIp" id="netForm" name="netForm" onSubmit="return check();">
					<p class="configForm">
						<label for="IP">Adresse IP : </label><input type="text" size="10" id="IP" name="IP" value="<?php echo $parsedJSON['IP']; ?>" /><br />
						<label for="Port">Port : </label><input type="text" size="10" id="Port" name="Port" value="<?php echo $parsedJSON['Port']; ?>" /><br />
					</p>
					<input class="sendbutton" type="submit" value="Enregistrer" />
				</form>
			</div>
		</div>


<?php $contenu = ob_get_clean() ?>

<?php require 'vues/gabarit.php' ?>