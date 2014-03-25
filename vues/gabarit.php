<!doctype html>
<html lang="fr">
<head>

<?php if ($refresh) { echo '	<meta http-equiv="refresh" content="30">
' ; } ?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="Viewport" content="width=device-width, initial-scale=1">

	<title>DomoHouse - <?php echo $titre; ?></title>

	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/grid.css">
	<link rel="stylesheet" type="text/css" href="css/police.css">
	<link rel="stylesheet" type="text/css" href="css/domohouse.css">

	<script type="text/javascript" src="js/domohouse.js"></script> 
	<script type="text/javascript" src="js/jquery-1.10.2.js"></script>
	<script type="text/javascript" src="js/jquery-ui-1.10.4.custom.js"></script>
	<script type="text/javascript" src="js/jquery.ui.touch-punch.min.js"></script>
	<script>
		$(document).ready(function(){
			$('#SortedList').sortable( {
				connectWith: "#UnusedList",
				forcePlaceholderSize: true,
				cursor: "move",
				scroll: false,
				items: "tr:not(.sort-disabled)",
				placeholder: "listePlaceholder",
				update: function () {
					var data = $('#SortedList').sortable('toArray');
					document.testForm.ListeId.value = data;
				}
			});
			$('#UnusedList').sortable( {
				connectWith: "#SortedList",
				forcePlaceholderSize: true,
				items: "tr:not(.sort-disabled)",
				placeholder: "listePlaceholder",
				cursor: "move",
				scroll: false
			});	
		});

	</script>

</head>

<body>
	<header>
		<div class="container">
			<div onclick="document.location.href='index.php'" class="column third headtxt"><img class="headimg" src="img/home-small.png"></div>
			<div class="column third headtxt"><?php echo $titre; ?></div>
			<div onclick="document.location.href='index.php?page=configMenu'" class="column third headtxt"><img class="headimg" src="img/cog-small.png"></div>
		</div>
	</header>	
	<section>
		<div class="container">
<?php
	echo $contenu;

?>
		</div>
	</section>
</body>
</html>