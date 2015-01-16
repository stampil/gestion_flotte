<?php
if(!is_connected()) exit("veuillez vous (re)connectez");

$d = $_GET['date'];

$date = $jours[date("w",  strtotime(" +$d day"))].' '.date("d/m",  strtotime(" +$d day"));
?>
Ajouter une sortie pour le <?php
echo $date; ?><br />
(en construction)

