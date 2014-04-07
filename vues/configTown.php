<?php ob_start(); ?>

		<div class="row clearfix">
			<div class="column full">
				<form method="POST" action="index.php?page=configSaveTown" id="townForm" name="townForm">
					<p class="configForm">
						<label for="Town">Code ville: </label><input type="text" id="Town" name="Town" value="<?php  echo $parsedJSON['Town']; ?>" /><br>
					</p>
					<input class="sendbutton" type="submit" value="Enregistrer">
				</form>
			</div>
		</div>


<?php $contenu = ob_get_clean() ?>

<?php require 'vues/gabarit.php' ?>