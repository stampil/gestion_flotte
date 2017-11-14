<?php
if (!is_connected()){     header("Location: ?action=connexion&origine=".  urlencode($_SERVER["QUERY_STRING"]));     exit("veuillez vous (re)connectez"); }

$id_sortie = $_GET['sortie'];
$sortieM = new SortieManager();
$contraintes = $sortieM->get_contrainte($id_sortie);
$sortie = new Sortie($sortieM->get_sortie($id_sortie));

if($sortie->get_id_organisateur() == $USER->get_id()){
    $organisateur = true;
}
else{
    $organisateur = false;
}
    
$teamspeakM = new TeamspeakManager($bdd);
$teamspeak = $teamspeakM->get_all_teamspeak();
$vaisseau = $USER->get_vaisseau();
$joueurM = new JoueurManager($bdd);
$vaisseauM = new VaisseauManager($bdd);
$participants = $sortieM->get_participant($id_sortie);
$present = array();
$flotte = array();
foreach ($participants as $participant) {
    if($participant->id_jv){
        array_push($present, $participant->id_joueur);
		if($participant->id_jv==-1){
			continue;
		}
		$vaiss = $vaisseauM->get_vaisseau($participant->id_vaisseau);
		$info_jv = $joueurM->get_vaisseau_joueur($participant->id_jv);
		$j = $joueurM->get_joueur($info_jv->id_joueur); 
		$flotte[$participant->id_jv] =$vaiss->nom.' '.(!preg_match('/^ship/',$participant->nom)?'('.$participant->nom.')':'').' de '.$j->handle;
    }


}

$nb_present = count($present);
?>
<style>
.orga{
	color:red;
}
</style>
<p>Info participation : <?php echo $nb_present.($sortie->get_max_joueur()?'/'.$sortie->get_max_joueur():'').' participant'.($nb_present>1?'s':''); ?></p>
<form action="inscrire_sortie.php" method="GET">
    <input type="hidden" name="id_sortie" value="<?php echo $id_sortie; ?>" />
    <table>
        <?php 
        if(!$sortie->get_max_joueur() || $nb_present<$sortie->get_max_joueur() ||  in_array($USER->get_id(), $present)  ){?>
		<tr>
            <td>Role</td>
                    <td>
               <select name="role">
                   <?php
                   for ($i=0; $i<count($roles); $i++){
                       echo '<option value="'.$i.'">'.$roles[$i].'</option>';
                   }
                   ?>
                  
                </select></td>
        </tr>
        <tr>
            <td><input type="radio" name="presence" value="1" checked="checked" id="presence1" /> Je viendrai avec mon </td>
        <td><select name="id_jv" onclick="$('#presence1').prop('checked',true);">
                <?php
                foreach ($vaisseau as $o) {
                    
                    echo '<option value="'.$o->id_jv.'">'.$o->type.' ('.$o->nom.')</option>';
                }
                ?>
                </select></td>
        </tr>
        <tr>
            <td><input type="radio" name="presence" value="2" id="presence2"/> Je serais sur le</td>
        <td><select name="id_jv2" onclick="$('#presence2').prop('checked',true);">
                <?php
                foreach ($flotte as $id_jv => $nom) {
                    
                    echo '<option value="'.$id_jv.'">'.$nom.'</option>';
                }
                ?>
                </select></td>
        </tr>		
        
        <?php } ?>
        <tr>
            <td colspan="2"><input type="radio" name="presence" value="0" /> Je ne pourrais pas participer.</td>
        </tr>
        <tr>
            <td colspan="2"><textarea rows="5" cols="50" name="commentaire" placeholder="commentaire a propos de votre présence/absence ou de la sortie"></textarea></td>
        </tr>
        <td colspan="2"><input type="submit"  /></td>
        </tr>
    </table>
</form>
</div>
<div class="content">
    <p>Info sortie :</p>
<form action="upload_sortie.php" method="get">
     <input type="hidden" name="id_sortie" value="<?php echo $id_sortie; ?>" />
<table>
    <tr>
        <td>Titre</td>
        <td><input type="text" <?php echo ($organisateur?'':'readonly="readonly"') ?> name="titre" value="<?php echo $sortie->get_titre() ?>"/></td>
    </tr>
    <tr>
        <td>Detail</td>
        <td><textarea rows="5" cols="50" name="detail"  <?php echo ($organisateur?'':'readonly="readonly"') ?>><?php echo $sortie->get_detail() ?></textarea></td>
    </tr>
    <tr>
        <td>Organisateur</td>
        <td><input type="text"  disabled="disabled" value="<?php echo ($sortie->get_organisateur()->get_team()? '['.$sortie->get_organisateur()->get_team()->get_tag().']':'').' '.$sortie->get_organisateur()->get_handle(); ?>" /></td>
    </tr>
    <tr>
        <td>Teamspeak</td>
        <td><select name="id_teamspeak"  <?php echo ($organisateur?'':'disabled="disabled"') ?>>
            <?php
            
             foreach ($teamspeak as $o) {

                 echo '<option value="'.$o->id_teamspeak.'" '.($o->id_teamspeak==$sortie->get_id_teamspeak()?'selected="selected"':'').'>'.$o->label.'</option>';
             }
            ?>
            </select></td>
    </tr>
    <tr>
        <td>Date</td>
        <td><input  type="text" disabled="disabled"  value="<?php echo $jours[date("w",  strtotime($sortie->get_debut()))]." ".date("d/m",  strtotime($sortie->get_debut())); ?>" />
        <input type="hidden" name="date"  value="<?php echo date("Y-m-d",  strtotime($sortie->get_debut())); ?>" /></td>
    </tr>
    <tr>
        <td>Début</td>
        <td><input name="debut" type="time"  value="<?php echo usdatetotimeus($sortie->get_debut()); ?>"  <?php echo ($organisateur?'':'readonly="readonly"') ?>/></td>
    </tr>
    <tr>
        <td>Fin</td>
        <td><input name="fin" type="time"  value="<?php echo usdatetotimeus($sortie->get_fin()); ?>"  <?php echo ($organisateur?'':'readonly="readonly"') ?> /></td>
    </tr>
    <tr>
        <td>Inscription possible par</td>
        <td><select name="visibilite"  <?php echo ($organisateur?'':'disabled="disabled"') ?>>
                <option value="<?php echo SORTIE_VISIBILITE_TEAM; ?>" <?php if($sortie->get_visibilite()==SORTIE_VISIBILITE_TEAM) echo 'selected="selected"' ?>>Team seulement</option>
                <option value="<?php echo SORTIE_VISIBILITE_TEAM_ALLIE; ?>" <?php if($sortie->get_visibilite()==SORTIE_VISIBILITE_TEAM_ALLIE) echo 'selected="selected"' ?>>Team + Alliés</option>
                <option value="<?php echo SORTIE_VISIBILITE_TOUS; ?>" <?php if($sortie->get_visibilite()==SORTIE_VISIBILITE_TOUS) echo 'selected="selected"' ?>>N'importe qui</option>
            </select></td>
    </tr>
    <tr>
        <td title="(0: aucune limite)">Max joueur</td>
        <td title="(0: aucune limite)"><input name="max_joueur" <?php echo ($organisateur?'':'disabled="disabled"') ?> type="number" min="0" max="100" class="numberTiny" value="<?php echo $sortie->get_max_joueur(); ?>" /></td>
    </tr>
    <tr>
        <td valign="top">Contraintes</td>
        <td><?php
	
		foreach($contraintes as $c){
			$avec ='';
			$nb_eq = $c->nb_equipage;
			if($nb_eq==1){
				$avec =' avec 1 pilote seulement';
			}
			else{
				$avec ='avec '.$c->nb_equipage.' equipages (pilote compris)';
			}
			echo $c->nb_vaisseau.' '.$c->nom.' '.$avec.' <br />';
		}
		?></td>
    </tr>	
    <tr>
            <td colspan="2"> <?php if ($organisateur){
                echo '<input type="submit" value="modifier" /> <input type="button" value="annuler la sortie" onclick="annule_sortie('.$id_sortie.')" />';
            }?> </td>
    </tr>
</table>
    
  
</form>
</div>
<div class="content">
    <p> <a href="?action=voir_plan_sortie&sortie=<?php echo $id_sortie; ?>">Plan de formation:</a>
<p>Participant :</p><hr />
<form action="force_absent.php" method="POST">
<input type="hidden" name="id_sortie" value="<?php echo $id_sortie; ?>" />
<?php

foreach ($participants as $participant) {
    if(!$participant->id_jv){
        continue;
    }
    $joueur = new Joueur($joueurM->get_joueur($participant->id_joueur));
    $vaisseau = new Vaisseau($vaisseauM->get_vaisseau($participant->id_vaisseau));
	$form_orga = '';
	$is_orga = $sortie->get_id_organisateur()==$participant->id_joueur;
	if($organisateur ||$USER->get_admin()){
		$form_orga = '<input type="checkbox" name="forceAbsent['.$joueur->get_id().']" /> ';
	}
	$info_jv = $joueurM->get_vaisseau_joueur($participant->id_jv);
	
	$dans_vaisseau =" Sans vaisseau";
	if($info_jv){
		$sNom = $vaisseau->get_nom();
		$le='le ';
		if( preg_match('/^[aeiouÀÁÂÃÄÅÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåèéêëìíîïðòóôõöùúûüýÿ]/i',$sNom)){
			$le="l'";
		}
		$sNom = $info_jv->handle;
		$de='de ';
		if( preg_match('/^[aeiouÀÁÂÃÄÅÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåèéêëìíîïðòóôõöùúûüýÿ]/i',$sNom)){
			$de="d'";
		}
		$dans_vaisseau = "dans ".($joueur->get_id()==$info_jv->id_joueur?'son ':$le).$vaisseau->get_nom().(!preg_match('/ship_.+/', $participant->nom)?' "'.$participant->nom.'"':''). ($joueur->get_id()==$info_jv->id_joueur?'':' '.$de.$info_jv->handle);
	}
	
	
    echo $form_orga.($joueur->get_team()?'['.$joueur->get_team()->get_tag().']':'').' <span class="'.($is_orga?'orga':'').'">'.$joueur->get_handle()." ".($is_orga?'(Organisateur)':'')."</span> $dans_vaisseau  <br />Inscrit le : ".usdatetodate($participant->creato).'<br>Role : '.$roles[$participant->role].' <br /><div class="'.($is_orga?'orga':'').'">'.$participant->commentaire.'</div><hr />';
    
}
?>
<input type="submit" value="Forcer en absent les participants cochés" />
</form>
</div>

<?php
if(count($contraintes)>1){ ?>
<div class="content">
<p>Etat</p>
<?php
foreach($contraintes as $c){
        //check for ship c
		$nb_vaisseau = $c->nb_vaisseau;
		$nb_eq = $c->nb_equipage;
	    $avec='';
		$nb_place = $nb_vaisseau *$nb_eq; 
		
		foreach ($participants as $participant) {
			if(!$participant->id_jv){
				continue;
			}

			$vaisseau = new Vaisseau($vaisseauM->get_vaisseau($participant->id_vaisseau));
			$id_vaisseau = $vaisseau->get_id();
			if($id_vaisseau == $c->id_vaisseau && $nb_place>0){
				$nb_place--;
				//todo retirer l'id_user pour ne plus compter dans une autre contrainte de meme type de vaiss
			
			}
		
		}
		echo 'reste '. $nb_place.' place'. ($nb_place>1?'s':'').' pour : '.$c->nom.' '.$nb_eq.' place'.($nb_eq>1?'s':'').' <br />';
}
?>

</div>
<?php } ?>

<div class="content">
<p>Absent :</p><hr />
<?php

foreach ($participants as $participant) {

    if($participant->id_jv){
        continue;
    }
    $joueur = new Joueur($joueurM->get_joueur($participant->id_joueur));
   

    echo ($joueur->get_team()?'['.$joueur->get_team()->get_tag().']':'').' '.$joueur->get_handle()." ".($participant->commentaire?':':'').'<br />Inscrit le : '.usdatetodate($participant->creato).'<br />'.$participant->commentaire.'<hr />';
    
}
?>