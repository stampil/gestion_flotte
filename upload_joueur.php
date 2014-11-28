<?php
require 'require/header.php';
require 'require/commun.php';

list($uploadErr,$img) = upload_img("img", "joueur");

if(!Joueur::check_handle($_POST["handle"])){
    $uploadErr.= "<p>Handle non reconnu </p>";
}

$joueur = new Joueur((object) array(
            "id_joueur" => null,
            "handle" => $_POST["handle"],
            "email" => $_POST["email"],
            "admin" => 0,
            "mdp" => $crypt->encode($_POST["mdp"]),
            "creato" => null,
            "lastco" => null,
            "img" => $img
        ));

if (!$uploadErr) {
    $joueurM = new JoueurManager();
    $id_joueur = $joueurM->set_joueur($joueur);

    if(!$id_joueur){
        header("Location: index.php?action=accueil&mess=Joueur non enregistre, surement car existe deja");
        exit();
    }
    $joueur->set_id($id_joueur);
    $joueurM->set_orientation($id_joueur, $_POST["select_orientation_joueur"]);
    $joueurM->set_vaisseau($id_joueur, $_POST["nb_vaiss"]);
    $joueurM->set_team($id_joueur, $_POST["select_teamP_joueur"], $_POST["select_teamS_joueur"]);

    $_SESSION["sjoueur"]=  serialize($joueur);
    header("Location: index.php?action=modif_joueur");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>