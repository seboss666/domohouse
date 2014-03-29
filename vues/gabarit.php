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
<!--	<link rel="stylesheet" type="text/css" href="css/grid.css">-->
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
				update: function () {
					var data = $('#SortedList').sortable('toArray');
					document.triForm.ListeId.value = data;
				},
				receive: function(event, ui) {
					if ($('#SortedList').children('li').length > 6 ) {
						$('#UnusedList').sortable('cancel');
					}
				}
			});
			$('#SortedList').disableSelection();
			$('#UnusedList').sortable( {
				connectWith: "#SortedList",
				scroll: false,
				revert: true
			});	
			$('#UnusedList').disableSelection();
		})
	</script>

</head>

<body>
	<header>
		<div id="home"><img onclick="document.location.href='index.php'" src="img/home-small.png"></div>
		<div id="date_heure">
			<div id="heure">Heure</div>
			<div id="date">Date</div>
		</div>
		<div id="config"><img onclick="document.location.href='index.php?page=configMenu'" src="img/cog-small.png"></div>
	</header>
	<section>
		<div class="container">
<?php
	echo $contenu;

?>
		</div>
	</section>
	<script type="text/javascript">
		window.onload = function() { heure('heure'); date('date'); };
	</script>
</body>
</html>