<?php ob_start(); ?>

		<div class="row clearfix">
			<div class="column full">
				<a href="index.php?page=configIp">Configurer l'adresse IP du serveur Domoticz</a></br>
				<a href="index.php?page=configListe">Organiser l'affichage des appareils</a></br>
			</div>
		</div>


<?php $contenu = ob_get_clean() ?>

<?php require 'vues/gabarit.php' ?>