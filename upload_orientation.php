<?php
require 'require/header.php';
require 'require/commun.php';

list($uploadErr,$img) = upload_img("logo", "orientation");

$orientation = new Orientation( (object) array(
"nom"=>$_POST["nom"],
"logo"=>$img
));

if (!$uploadErr) {
    $orientationM = new OrientationManager();
    $orientationM->set_orientation($orientation);
    header("Location: index.php?action=ajout_orientation");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>

