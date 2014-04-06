<?php ob_start(); ?>

<div id="jour_txt"><?php echo $jours[$jour];?></div>
<div id="jour_num"><?php echo $j;?></div>
<div id="mois_txt"><?php echo $mois[$moi];?></div>
<div id="semaine">Semaine <?php echo $week;?></div>
<div id="sunriseset">Soleil de <?php echo str_replace(":","h",substr($SunRiseSet['Sunrise'], 0, -3));?> à <?php echo str_replace(":","h",substr($SunRiseSet['Sunset'], 0, -3));?>


<?php $contenu = ob_get_clean() ?>

<?php require 'vues/gabarit.php' ?>