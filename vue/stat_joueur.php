<?php
include_once 'template/menu.php';

$handle = @$_GET["handle"];
if(!$handle) exit("&handle= manquant...");
$joueurM = new JoueurManager($bdd);
$nb_sortie = $joueurM->get_nb_sortie_joueur($handle);

?>
Le joueur <a href="https://robertsspaceindustries.com/citizens/<?php echo $handle ?>" target="_blank"><?php echo $handle ?></a> à fait <?php echo $nb_sortie; ?> sortie<?php if($nb_sortie>1) echo "s" ?>.
