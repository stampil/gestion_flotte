<?php
include_once 'template/menu.php';
$joueurM = new JoueurManager($bdd);
$handle = @$_GET["handle"];

$jours = array('dimanche','lundi','mardi','mercredi','jeudi','vendredi','samedi');



if($handle){

$nb_sortie = $joueurM->get_nb_sortie_joueur($handle);

?>
Le joueur <a href="https://robertsspaceindustries.com/citizens/<?php echo $handle ?>" target="_blank"><?php echo $handle ?></a> à fait <?php echo $nb_sortie; ?> sortie<?php if($nb_sortie>1) echo "s" ?>.

<?php $sorties = $joueurM->get_all_sortie_joueur($handle);
        ?>
<div >
<?php
if(is_array($sorties) && count($sorties)>0){
	$inc_sortie = count($sorties);
	$sorties_jour = array();
	foreach($sorties as $sortie){
		$t = strtotime($sortie->debut);
		$jour = $jours[date('w',$t)];
		@$sorties_jour[$jour]++;
?>
    <?php echo $inc_sortie-- ?>) <?php echo $jour ?>: <a href="?action=voir_sortie&sortie=<?php echo $sortie->id; ?>" target="_blank"><?php echo $sortie->titre ?></a> du <?php echo usdatetodate($sortie->debut) ?> <br />
    <?php
}
	?>
	dont : <br>
	<?php
	foreach ($sorties_jour as $sortie_jour =>$nb){
		echo $nb.'x le '.$sortie_jour.'<br>';
	}
}
    ?>
    <hr />
</div>



<?php }
else{
    $info_joueur = $joueurM->get_all_joueur();
	$tabInfoJoueur = array();
	
	foreach($info_joueur as $j){
		$nb_sortie = $joueurM->get_nb_sortie_joueur($j->handle);

		

		$handle = $j->handle;
		if(!$nb_sortie) continue;
        $sorties = $joueurM->get_all_sortie_joueur($handle);	
        ?>
<div>Le joueur <a href="https://robertsspaceindustries.com/citizens/<?php echo $handle ?>" target="_blank"><?php echo $handle ?></a> à fait <?php echo $nb_sortie; ?> sortie<?php if($nb_sortie>1) echo "s" ?>.<br />
<?php
if(is_array($sorties) && count($sorties)>0){
	$inc_sortie = count($sorties);
	$sorties_jour = array();
	foreach($sorties as $sortie){
		$t = strtotime($sortie->debut);
		$jour = $jours[date('w',$t)];
		@$sorties_jour[$jour]++;
?>
    <?php echo $inc_sortie-- ?>) <?php echo $jour ?> : <a href="?action=voir_sortie&sortie=<?php echo $sortie->id; ?>" target="_blank"><?php echo $sortie->titre ?></a> du <?php echo usdatetodate($sortie->debut) ?> <br />
    <?php
	}
	?>
	dont : <br>
	<?php
	foreach ($sorties_jour as $sortie_jour =>$nb){
		echo $nb.'x le '.$sortie_jour.'<br>';
	}

}
    ?>
	<br />
    <hr />
</div>
    <?php
    }
    ?>

	
	<hr />
	Joueurs n'ayant fait aucune sortie : 
	<?php
	
	foreach($info_joueur as $j){
        $nb_sortie = $joueurM->get_nb_sortie_joueur($j->handle);
		if($nb_sortie) continue;
		?>
		<a href="https://robertsspaceindustries.com/citizens/<?php echo $j->handle ?>" target="_blank"><?php echo $j->handle.($j->tag?' ('.$j->tag.')':'') ?></a> - 
		<?php
		
	}
	

	?>
	
	
	
<?php
}
?>
