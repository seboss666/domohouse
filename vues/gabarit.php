<!doctype html>
<html lang="fr">
<head>

<?php /*if ($refresh) { echo '	<meta http-equiv="refresh" content="30">
' ; }*/ ?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="Viewport" content="width=device-width, initial-scale=1">

	<title>DomoHouse - <?php echo $titre; ?></title>

	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/police.css">
	<link rel="stylesheet" type="text/css" href="css/slidebars.css">
	<link rel="stylesheet" type="text/css" href="css/domohouse.css">

	<script type="text/javascript" src="js/domohouse.js"></script> 
	<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.js"></script>
	<script type="text/javascript" src="js/jquery.ui.touch-punch.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#SortedList').sortable( {
				connectWith: "#UnusedList",
				scroll: false,
				revert: true,
				items: "li:not(li:first-of-type)",
				forcePlaceholderSize: true,
				placeholder: "listePlaceholder",
				update: function () {
					var data = $('#SortedList').sortable('toArray');
					document.triForm.ListeId.value = data;
				},
				receive: function(event, ui) {
					if ($('#SortedList').children('li').length > 9 ) {
						$('#UnusedList').sortable('cancel');
					}
				}
			});
			$('#SortedList').disableSelection();
			$('#UnusedList').sortable( {
				connectWith: "#SortedList",
				scroll: false,
				revert: true,
				items: "li:not(li:first-of-type)",
				forcePlaceholderSize: true,
				placeholder: "listePlaceholder",
			});	
			$('#UnusedList').disableSelection();
		})
	</script>

</head>

<body>
	<header>
		<div id="home" class="sb-toggle-left"><img src="img/menu2.png"></div>
		<div id="date_heure" onclick="location.href='index.php?page=ephemeride'">
			<div id="heure">Heure</div>
			<div id="date">Date</div>
		</div>
<?php
	global $Town;

	if ($Town !== "" ) {
		$currentWeather = weatherHeader($Town);
		if (!isset($currentWeather['Erreur'])) {
?>

		<div id="weather" onclick="location.href='index.php?page=meteo&id=<?php echo $Town; ?>'">
			<img src="<?php echo $currentWeather['img']; ?>">
			<span><?php echo $currentWeather['temp']; ?>&deg;C</span>
		</div>

<?php 
		}
	}
?>
	</header>
	<div id="sb-site">
	<section>
		<div class="container">


<?php
	echo $contenu;

?>
		</div>
	</section>
	</div>
	<div class="sb-slidebar sb-left sb-style-overlay">
		<ul class="menulist">
			<li>
				<a href="index.php?page=accueil">
					<img class="panelhome" src="img/pixel.gif" alt="Accueil">
					<span>Accueil</span>
				</a>
			</li>
			<li>
				<a href="#" class="toggle-submenu">
					<img class="panelconf" src="img/pixel.gif" alt="Configuration">
					<span>Configuration</span>
				</a>
				<ul class="submenu">
					<li>
						<a href="index.php?page=configIp">
							<img class="panelconfip" src="img/pixel.gif" alt="Configuration IP Domoticz">
							<span>Domoticz</span>
						</a>
					</li>
					<li>
						<a href="index.php?page=configListe">
							<img class="panelconflist" src="img/pixel.gif" alt="Configuration liste appareils">
							<span>Affichage</span>
						</a>
					</li>
					<li>
						<a href="index.php?page=configTown">
							<img class="panelmeteo" src="img/pixel.gif" alt="Configuration meteo">
							<span>M&eacute;t&eacute;o</span>
						</a>
					</li>
				</ul>
			</li>
			<li>
				<a href="#" class ="toggle-submenu">
					<img class="panelconflist" src="img/pixel.gif" alt="Emplacements">
					<span>Emplacements</span>
				</a>
				<ul class="submenu">

<?php
	$listePlans = getAllPlans();
	foreach( $listePlans as $plan) {
?>

					<li>
						<a href="index.php?page=plan&id=<?php echo $plan['idx'];?>">
							<img class="panelconflist" src="img/pixel.gif" alt="<?php echo $plan['Name'];?>">
							<span><?php echo $plan['Name'];?></span>
						</a>
					</li>
					
<?php
	}
?>
				</ul>
			</li>
			<li>
				<a href="index.php?page=meteo&id=<?php echo $Town; ?>">
					<img class="panelmeteo" src="img/pixel.gif" alt="Météo locale">
					<span>M&eacute;t&eacute;o</span>
				</a>
			</li>
			<li>
				<a href="index.php?page=about">
					<img class="panelabout" src="img/pixel.gif" alt="À propos">
					<span>A propos</span>
				</a>
			</li>
		</ul>
	</div>
	<!-- Slidebars -->
	<script src="js/slidebars.js"></script>
	<script>
		(function($) {
			$(document).ready(function() {
				$.slidebars();
				
				$('.toggle-submenu').off('click').on('click', function() {
					$submenu = $(this).parent().children('.submenu');
					$(this).add($submenu).toggleClass('sb-submenu-active'); // Toggle active class.
					
					if ($submenu.hasClass('sb-submenu-active')) {
						$submenu.slideDown(200);
					} else {
						$submenu.slideUp(200);
					}
				});
			});
		}) (jQuery);
	</script>

	<script type="text/javascript">
		window.onload = function() { heure('heure'); date('date'); };
	</script>
</body>
</html>