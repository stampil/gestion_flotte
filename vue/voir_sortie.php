<?php
if(!is_connected()) exit("veuillez vous (re)connectez");

$id_sortie = $_GET['sortie'];

$sortieM = new SortieManager();
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

?>
<p>Info participation :</p>
<form action="inscrire_sortie.php" method="GET">
    <input type="hidden" name="id_sortie" value="<?php echo $id_sortie; ?>" />
    <table>
        <tr>
            <td><input type="radio" name="presence" value="1" checked="checked"/> Je viendrai avec mon </td>
        <td><select name="id_jv">
                <?php
                foreach ($vaisseau as $o) {
                    
                    echo '<option value="'.$o->id_jv.'">'.$o->type.' ('.$o->nom.')</option>';
                }
                ?>
                </select></td>
        </tr>
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
        <td><input type="text"  disabled="disabled"  value="[<?php

		echo $sortie->get_organisateur()->get_team()->get_tag().'] '.$sortie->get_organisateur()->get_handle();
					?>" /></td>
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
        <td><input  type="text" disabled="disabled"  <?php echo ($organisateur?'':'readonly="readonly"') ?> value="<?php echo $jours[date("w",  strtotime($sortie->get_debut()))]." ".date("d/m",  strtotime($sortie->get_debut())); ?>" />
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
            <td colspan="2"> <?php if ($organisateur){
                echo '<input type="submit" value="modifier" /> <input type="button" value="annuler la sortie" onclick="annule_sortie('.$id_sortie.')" />';
            }?> </td>
    </tr>
</table>
    
  
</form>
</div>
<div class="content">
<p>Participant :</p><hr />
<?php
$participants = $sortieM->get_participant($id_sortie);
foreach ($participants as $participant) {
    if(!$participant->id_jv){
        continue;
    }
    $joueur = new Joueur($joueurM->get_joueur($participant->id_joueur));
    $vaisseau = new Vaisseau($vaisseauM->get_vaisseau($participant->id_vaisseau));

    echo '['.$joueur->get_team()->get_tag().'] '.$joueur->get_handle()." avec ".$vaisseau->get_nom(). ' ('.$participant->nom.')'.($participant->commentaire?':':'').'<br />'.$participant->commentaire.'<hr />';
    
}

?>
</div>
<div class="content">
<p>Absent :</p><hr />
<?php

foreach ($participants as $participant) {

    if($participant->id_jv){
        continue;
    }
    $joueur = new Joueur($joueurM->get_joueur($participant->id_joueur));
   

    echo '['.$joueur->get_team()->get_tag().'] '.$joueur->get_handle()." ".($participant->commentaire?':':'').'<br />'.$participant->commentaire.'<hr />';
    
}
?>

