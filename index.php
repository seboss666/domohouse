<?php
session_start();

if (!file_exists('include/configData.json')) {
    file_put_contents('include/configData.json', '{"Town":"","IP":"","Port":"","ListeAppareils":[{"idx":"","type":""}]}');
    header('Location: index.php?page=configIp');
}


require('include/fonctions/controles.php');
require('include/actions/switchActions.php');

 
try {
    
    if (isset($_GET['page'])) {
        $page = htmlentities($_GET['page']);
        switch ($page) {
            case 'about':
                about();
                break;
            case 'accueil':
                accueil();
                break;
            case 'plan':
                if (isset($_GET['id'])) {
                    $idplan = htmlentities($_GET['id']);
                    if (preg_match('/\d{1,}/', $idplan)) {
                        plan($idplan);
                    }
                    else {
                        throw new Exception('id au mauvais format');
                    }
                }
                else {
                    throw new Exception('id du plan manquant');
                }
                break;
            case 'meteo':
                if (isset($_GET['id'])) {
                    $townid = htmlentities($_GET['id']);
                    if (preg_match('/\d{1,}/', $townid)) {
                        weatherDetail($townid);
                    }
                    else {
                        throw new Exception('id au mauvait format');
                    }
                }
                else {
                    throw new Exception('id de la ville manquant');
                }
                break;

            case 'configMenu':
        	    configurationMenu();
        	    break;
        	case 'configIp':
        	    configurationIp();
        	    break;
            case 'configTown':
                configurationTown();
                break;
            case 'configListe':
                configurationListe();
                break;
            case 'configSave':
                if (isset($_POST['id'])) {
                    $listeID = htmlentities($_POST['id']);
                    configurationSave($listeID);
                }
                else {
                    throw new Exception("Action non permise !");
                }
                break;
            case 'configSaveIp':
                if (isset($_POST['IP']) && isset($_POST['Port'])) {
                    $IP = htmlentities($_POST['IP']);
                    $Port = htmlentities($_POST['Port']);
                    configurationSaveIp($IP,$Port);
                }
                else {
                    throw new Exception("Action non permise !");
                }
                break;
            case 'configSaveTown':
                if (isset($_POST['Town'])) {
                    $Town = htmlentities($_POST['Town']);
                    configurationSaveTown($Town);
                }
                else {
                    throw new Exception("Action non permise !");
                }
                break;
            case 'switch':
                    if (isset($_GET['action'])) {
                        $action = htmlentities($_GET["action"]);
                        $data = htmlentities($_GET["data"]);
                        $idx = htmlentities($_GET["idx"]);
                        if ( $data != "" && $idx !="" ) {
                           switch ($action) {
                            case 'On':
                                $switched = switchOn($idx); 
                                break;
                            case 'Off':
                                $switched = switchOff($idx);
                                break;
                            case 'Toggle':
                                $switched = switchToggle($data,$idx);
                                break;
                            default:
                                throw new Exception("Action non définie");
                                break;
                            }
                            $parsedJSON = json_decode($switched, true);
                            if ($parsedJSON['status'] == "OK") {
                                header('Location: index.php');
                            }
                        }
                        else {
                            throw new Exception("Data ou Idx manquant");
                        }
                    }
                    else {
                        throw new Exception("Action manquante");
                    }
                    break;

    //Si inconnue, on affiche une erreur      
            default:
                throw new Exception("Page inconnue");
                break;
        }
    }
    else {
        accueil();  // page par défaut
    }
}

catch (Exception $e) {
    afficherErreur($e->getMessage());
}