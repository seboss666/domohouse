<?php 

include('include/fonctions/functions.php');

function accueil() {
  $titre = "Accueil";
  $refresh = true;
  $config = file_get_contents("include/configData.json");
  $parsedJSON = json_decode($config, true);

  $liste = $parsedJSON['ListeAppareils'];
  $device_count = count($liste);
  
  $liste_idx = array();
  for($i=0;$i<$device_count;$i++) {
    $liste_idx[$i] = $liste[$i]['idx'];
  }
  
  
  $devicesFinal = filterDevices($liste_idx);
  require('vues/accueil.php');

}

function plan($id) {
  $refresh = true;
  $titre = "Plans";
  $devicesFinal = planDevices($id);
  require('vues/accueil.php');
}

function configurationMenu() {
  $titre = "Menu de configuration";
  $refresh = false;
  require('vues/configMenu.php');
}

function configurationIp() {
  $titre = "Configuration du serveur Domoticz";
  $refresh = false;
  $config = file_get_contents("include/configData.json");
  $parsedJSON = json_decode($config, true);
  }
  $IP = $parsedJSON['IP'];
  $Port = $parsedJSON['Port'];
  require('vues/configIp.php');
}

function configurationTown() {
  $titre = "Configuration de la ville";
  $refresh = false;
  $config = file_get_contents("include/configData.json");
  $parsedJSON = json_decode($config, true);
  $Town = $parsedJSON['Town'];
  require('vues/configTown.php');
}

function configurationListe() {

  $titre = "Configuration des appareils";
  $refresh = false;
  $config = file_get_contents("include/configData.json");
  $parsedJSON = json_decode($config, true);
  $devicesFinal = getAllDevices();

  $liste = $parsedJSON['ListeAppareils'];
  $device_count = count($liste);
  $liste_idx = array();
  $listeInputDefaut = "";
  
  for($i = 0; $i < $device_count; $i++) {
    $liste_idx[$i] = $liste[$i]['idx'];
    $listeInputDefaut .= "," . implode(":", $liste[$i]);
  }
  
  $listeInputDefaut = substr($listeInputDefaut, 1);
  require('vues/configListe.php');

}

function configurationSave($listeAppareils) {
    $config = file_get_contents("include/configData.json");
    $parsedJSON = json_decode($config, true);
    $ListeId = explode(",", htmlentities($listeAppareils));

    $i = 0;
    $parsedJSON['ListeAppareils'] = array();
    
    foreach($ListeId as $idx_type) {
      $device = explode(":", htmlentities($idx_type));
      $parsedJSON['ListeAppareils'][$i]['idx'] =  $device[0];
      $parsedJSON['ListeAppareils'][$i]['type'] = $device[1];
      $i++;
    }

    file_put_contents("include/configData.json", json_encode($parsedJSON));
    header('Location: index.php');

}

function configurationSaveIp($IP,$Port) {
    $config = file_get_contents("include/configData.json");
    $parsedJSON = json_decode($config, true);
    
    $parsedJSON['IP'] = $IP;
    $parsedJSON['Port'] = $Port;

    file_put_contents("include/configData.json", json_encode($parsedJSON));
    header('Location: index.php');
}

function configurationSaveTown($Town) {
    $config = file_get_contents("include/configData.json");
    $parsedJSON = json_decode($config, true);
    
    $parsedJSON['Town'] = $Town;
    
    file_put_contents("include/configData.json", json_encode($parsedJSON));
    header('Location: index.php');

}

function weatherDetail($townid) {
  $titre = "Détails météo";
  $refresh = false;
  $weather = getWeather($townid);
  require('vues/weatherDetail.php');
}

function about() {
  $titre = "A propos";
  $refresh = false;
  require('vues/about.php');
}

//Affichage des erreurs
function afficherErreur($msgErreur)
{
  $titre = "Erreur";
  $refresh = false;
  $contenu = '<p>Une erreur est survenue : ' . $msgErreur . '</p>';
  require('vues/gabarit.php');
}
