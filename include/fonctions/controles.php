<?php 

include('include/fonctions/functions.php');

function accueil() {
  $titre = "Accueil";
  $refresh = true;
  $configFile = file_get_contents("include/configData.json");
  $config = json_decode($configFile, true);

  if (!$config['IP'] OR !$config['Port']) {
    header('Location: index.php?page=configIp');
  }
  elseif (!$config['ListeAppareils']) {
      header('Location: index.php?page=configliste');
  }
  $devicesFinal = filterDevices($config['ListeAppareils']);
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
  if ($config === false) {
    file_put_contents("include/configData.json", '{"IP":"127.0.0.1","Port":"8080"}');
  }
  else {
      $parsedJSON = json_decode($config, true);
  }
  $IP = $parsedJSON['IP'];
  $Port = $parsedJSON['Port'];
  require('vues/configIp.php');
}

function configurationListe() {

  $titre = "Configuration des appareils";
  $refresh = false;
  $config = file_get_contents("include/configData.json");
  if ($config === false) {
    file_put_contents("include/configData.json", '{"ListeAppareils":[""]}');
  }
  else {
      $parsedJSON = json_decode($config, true);
  }
  $devicesFinal = getAllDevices();
  $liste = $parsedJSON['ListeAppareils'];
  require('vues/configListe.php');

}

function configurationSave($listeAppareils) {
    $config = file_get_contents("include/configData.json");
    $parsedJSON = json_decode($config, true);
    $ListeId = explode(",", htmlentities($listeAppareils));

    $parsedJSON['ListeAppareils'] = array();
    foreach($ListeId as $idx) {
      $parsedJSON['ListeAppareils'][] =  $idx;
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

//Affichage des erreurs
function afficherErreur($msgErreur)
{
  $titre = "Erreur";
  $refresh = false;
  $contenu = '<p>Une erreur est survenue : ' . $msgErreur . '</p>';
  require('vues/gabarit.php');
}