<?php

require 'require/header.php';
require 'require/commun.php';

list($uploadErr,$img) = upload_img("logo", "team");


$team = new Team((object) array(
            "id_team" => null,
            "nom" => $_POST["nom"],
            "tag" => $_POST["tag"],
            "url" => $_POST["url"],
            "nbJoueur" => $_POST["nbJoueur"],
            "mdp" =>null,
            "logo" => $img
        ));

if (!$uploadErr) {
    $teamM = new TeamManager();
    $id_team = $teamM->set_team($team);
    $teamM->set_orientation($id_team, $_POST["select_orientation_team"]);
    header("Location: index.php?action=ajout_team");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>