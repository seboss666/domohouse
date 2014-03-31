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
L'application dispose d'un menu pour configurer les différentes informations : IP/Port, Code de ville pour météo, liste des appareils. Le fichier 'include/configData.json' doit pouvoir être modifiable par le serveur (sous linux, un chmod a+w suffit). S'il n'existe pas à l'installation, le serveur web doit pouvoir écrire dans le dossier 'include' (auquel cas il vous envoie sur la configuration IP).

Les informations météo sont fournies par Yahoo. Pour déterminer le code de ville, il faut se rendre sur http://fr.meteo.yahoo.com, et rechercher sa ville. Une fois la page de détail activée, le code se trouve à la fin de l'URL (qui est de la forme https://fr.meteo.yahoo.com/pays/region/ville-code/)


3. Limitations (qu'on pourrait appeler TODO LIST)
================================================================
-Les emplacements (plan dans le jargon du Json de Domoticz), qui permet un affichage par pièce, ne sont pas encore pris en charge. L'écriture est en cours.
-Les dimmer ne sont pris en charge que comme des switches standards.
-Les groupes/scènes ne sont pas encore implémentés.
-Dans un esprit "responsive", les écrans "larges" (pc classiques, tablettes en mode paysage) disposeront de plus de prise en charge (plus d'appareils sur une même ligne).



4. Interface
============
L'interface utilise quelques éléments qui ne sont pas développés "maison" :
-La police Open Sans Regular est incluse (http://www.fontsquirrel.com/fonts/open-sans);
-Normalize.css (http://necolas.github.io/normalize.css/);
-jQuery (https://jquery.com/), jQuery-UI (https://jqueryui.com/), un plugin (http://touchpunch.furf.com/) pour la gestion du tactile sur la page de configuration;, Slidebars (http://plugins.adchsm.me/slidebars/) pour le panel (dont le CSS est modifié pour ne pas interférer avec le reste de la configuration, media queries et réglages par défaut)