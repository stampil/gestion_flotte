<?php
require 'require/header.php';
require 'require/commun.php';

list($uploadErr,$img) = upload_img("img", "insigne");


$deco = new Decoration( (object) array(
"nom"=>$_POST["nom"],
"description"=>$_POST["description"],
"img"=>$img,
"remplace" =>$_POST["remplace"]
));

if (!$uploadErr) {
    $decoM = new DecorationManager();
    $decoM->set_insigne($deco);
    header("Location: index.php?action=ajout_insigne");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}


?>