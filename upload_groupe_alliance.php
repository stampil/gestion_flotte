<?php

require 'require/header.php';
require 'require/commun.php';

$logo = $uploadErr = null;

if(isset($_FILES["logo"]["name"]) && $_FILES["logo"]["name"] ){
   $logo =  basename($_FILES["logo"]["name"]);
   list($uploadErr,$logo) = upload_img("logo", "groupeAlliance");
}


$alliance = new AllianceGroupe((object) array(
            "id_alliance" => null,
            "nom" => $_POST["nom"],
            "description" => $_POST["description"],
            "url" => $_POST["url"],
            "logo" => $logo
        ));

if (!$uploadErr) {
    $allianceM = new AllianceGroupeManager();
    $id_alliance = $allianceM->set_allianceGroupe($alliance);
    $allianceM->set_groupeAlliance($_POST["select_teamS_joueur"], $id_alliance);
    
    header("Location: index.php?action=ajout_groupe_alliance");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>