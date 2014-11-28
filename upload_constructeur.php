<?php
require 'require/header.php';
require 'require/commun.php';

list($uploadErr,$img) = upload_img("logo", "constructeur");


$constructeur = new Constructeur( (object) array(
"nom"=>$_POST["nom"],
"logo"=>$img
));

if (!$uploadErr) {
    $constructeurM = new ConstructeurManager();
    $constructeurM->set_constructeur($constructeur);
    header("Location: index.php?action=ajout_constructeur");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}


?>