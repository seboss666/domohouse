##############################################################
DomoHouse
Affichage simplifié des switches et températures dans Domoticz
Par Seboss666 (avec participation de seikwa), idée de Tom23
##############################################################

1. Prérequis
============
Cette application est développée en PHP, donc il faut un serveur Web avec PHP d'activé (les deux configurations Apache/PHP et Nginx/PHP-FPM ont été testées avec succès). Le serveur Web doit pouvoir communiquer avec le serveur Domoticz (car il s'appuie notamment sur les données renvoyées par son API). Il peut d'ailleurs être installé sur la même machine, s'il n'écoute pas sur le même port.


2. Utilisation
==============
Pour l'instant une seule page est utilisée pour afficher une liste personnalisée de switches et capteurs (les autres appareils apparaissent, mais comme non supportés). Un menu permettant de configurer les paramètres de connexion ainsi que l'organisation des appareils est disponible. Le fichier 'include/configData.json' doit pouvoir être modifiable par le serveur (sous linux, un chmod a+w suffit).


3. Limitations (qu'on pourrait appeler TODO LIST)
================================================================
-Les emplacements (plan dans le jargon du Json de Domoticz), qui permet un affichage par pièce, ne sont pas encore pris en charge. L'écriture est en cours.
-Le style avance, mais tous les types d'images sur les switches ne sont pas pris en charge, et ne le seront peut-être jamais. Malgré tout une image générique s'affiche dans ce cas, et donc le switch est manipulable.
-Les dimmer ne sont pris en charge que comme des switches standards.


4. Interface
============
L'interface utilise quelques éléments qui ne sont pas développés "maison" :
-La police Open Sans Regular est incluse (http://www.fontsquirrel.com/fonts/open-sans);
-Normalize.css (http://necolas.github.io/normalize.css/);
-Grid.css (http://www.adamkaplan.me/grid/), qui sera probablement supprimé au profit d'un sous-ensemble "utile".
-jQuery (https://jquery.com/), jQuery-UI (https://jqueryui.com/) et un plugin (http://touchpunch.furf.com/) pour la gestion du tactile sur la page de configuration. Probablement remis à contributions pour des développements futurs.