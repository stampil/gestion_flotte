<?php

require 'require/header.php';
require 'require/commun.php';

$logo = $uploadErr = null;

if(isset($_FILES["logo"]["name"]) && $_FILES["logo"]["name"] ){
   $logo =  basename($_FILES["logo"]["name"]);
   $uploadErr = upload_img("logo", "alliance");
}




$alliance = new Alliance((object) array(
            "id_alliance" => null,
            "nom" => $_POST["nom"],
            "description" => $_POST["description"],
            "url" => $_POST["url"],
            "prive" => $_POST["prive"],
            "logo" => $logo
        ));

if (!$uploadErr) {
    $allianceM = new AllianceManager();
    $allianceM->set_alliance($alliance);
    header("Location: index.php?action=ajout_alliance");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>