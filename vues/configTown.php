<?php ob_start(); ?>

		<div class="row clearfix">
			<div class="column full">
				<form method="POST" action="index.php?page=configSaveTown" id="triForm" name="triForm">
					Code de la Ville: <input type="text" name="Town" value="<?php echo $parsedJSON['Town']; ?>"><br>
					<input class="sendbutton" type="submit" value="Enregistrer">
				</form>
			</div>
		</div>


<?php $contenu = ob_get_clean() ?>

<?php require 'vues/gabarit.php' ?>