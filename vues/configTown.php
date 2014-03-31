<?php ob_start(); ?>

		<div class="row clearfix">
			<div class="column full">
				<br><form method="POST" action="index.php?page=configSaveTown" id="triForm" name="triForm">
					Code de la Ville: <input type="text" name="Town" <?php if ($parsedJSON['Town'] !== '') { echo 'value="'. $parsedJSON['Town'];} ?>"><br>
					<input class="sendbutton" type="submit" value="Enregistrer">
				</form>
			</div>
		</div>


<?php $contenu = ob_get_clean() ?>

<?php require 'vues/gabarit.php' ?>