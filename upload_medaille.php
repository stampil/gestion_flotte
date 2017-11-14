<?php
require 'require/header.php';
require 'require/commun.php';

list($uploadErr,$img) = upload_img("img", "medaille");


$deco = new Decoration( (object) array(
"nom"=>$_POST["nom"],
"description"=>$_POST["description"],
"img"=>$img,
"remplace" =>$_POST["remplace"]
));

if (!$uploadErr) {
    $decoM = new DecorationManager();
    $decoM->set_medaille($deco);
    header("Location: index.php?action=ajout_medaille");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}


?>