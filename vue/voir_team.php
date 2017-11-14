<?php
include_once 'template/menu.php';
if (!is_connected()){     header("Location: ?action=connexion&origine=".  urlencode($_SERVER["QUERY_STRING"]));     exit("veuillez vous (re)connectez"); }

$joueurM = new JoueurManager($bdd);
$teamM = new TeamManager($bdd);

$teams =$joueurM->get_all_team($USER->get_id());

$joueur= $teamM->get_membre($teams[0]->id_team);
$phase = 0; // 0: alpha 1: beta 2: release
$phases = array('alpha','beta','release');
?>
<center>
<table class="table">
    <tr>
        <th>Nom</th>
        <th>Logo</th>

        <th>Orientation</th>
        <th>Gestionnaire IHM flottes</th>
        <th>Capacité soute<br /><span title="Si chacun prend son vaisseau ayant sa meilleur capacité de soute" class="help">Min</span>/<span title="si ceux qui ont plusieurs gros vaisseau les pretes a ceux qui ont des vaisseaux de petites soute" class="help">Max</span>/<span title="somme de toutes les soutes" class="help">Total</span></th>

    </tr>
    <?php
    for($i=0; $i<count($teams);$i++){
		$teamTag = $teams[$i]->tag;
        $cargo=0;
        $orientation_team = $teamM->get_orientation($teams[$i]->id_team);
        $flotte = $teamM->get_flotte($teams[$i]->id_team);
        $flotte_html ='';
        foreach($flotte as $o){
            $cargo+=$o->cargo*$o->nb;
            $flotte_html.= '<div class="container_vaisseauMedium reduce">'
            . '<img src="upload/vaisseau/'.$o->img.'" class="vaisseauMedium help"  />'
            . '<div class="in_container_vaisseauMedium visible">'
            . '<div title="'.$o->nb.'x '.$o->vaisseau.' ('.($o->cargo*$o->nb).' FU)">'.$o->nb.'</div>'
            . '</div>'
            . '</div>';

            }
            
            
        echo '<tr>'
        . '<td valign="middle"><a href="'.$teams[$i]->url.'" target="_blank">'.$teams[$i]->nom.'</a><br />'.count($joueur).' membre'.(count($joueur)>1?'s':'').' inscrit'.(count($joueur)>1?'s':'').'</td>'
        . '<td><img class="logoBig" src="upload/team/'.$teams[$i]->logo.'"></td>';
        echo '<td valign="middle" class="alignLeft">';
            
            foreach($orientation_team as $o){
               echo '<img src="upload/orientation/'.$o->logo.'" class="logoMini help" title="'.$o->nom.'" /> ';
            }
            
            echo '</td>';
            
        echo '<td class="alignLeft">';
            echo 'bientot';
        echo '</td>';
        
         echo '<td>x / x / '.number_format($cargo, 0, ",", " ").' Freight&nbsp;Units</td>';
        echo '</tr>';
         echo '<tr><td class="alignLeft" colspan="5">';
            echo $flotte_html;
        echo '</td></tr>';
    }
    ?>
</table>
</div>
<div class="content">
    
    <table class="table" cellpadding="0" cellspacing="0">
        <tr>
            <th>Info membre</th>
            <th>Decoration (<?=$phases[$phase];?>)</th>

            
        </tr>
        <?php
        $tr ="";
		
        for ($i = 0; $i < count($joueur); $i++) {
            
            $orientation_joueur = $joueurM->get_orientation($joueur[$i]->id_joueur);
            $vaisseau_joueur = $joueurM->get_vaisseau($joueur[$i]->id_joueur);
            $team_joueur = $joueurM->get_all_team($joueur[$i]->id_joueur);
			
			$medailles = $joueurM->get_medaille($joueur[$i]->id_joueur);
			$rubans = $joueurM->get_ruban($joueur[$i]->id_joueur);
			$insignes = $joueurM->get_insigne($joueur[$i]->id_joueur);
			?>
			
			
            <tr id="<?=$joueur[$i]->handle?>" style="height:446px" height=446>
			<td valign="middle">
			<div style="height:440px;overflow:auto;">
			
			<br />
			<?=$joueur[$i]->handle?>
			<br />
			<?php
            foreach($orientation_joueur as $o){
				?>
				
                <img src="upload/orientation/<?=$o->logo?>" class="logoMini help" title="<?=$o->nom?>" />
            <?php } ?>
			
			<br />
			
			<div class="all_deco" id="all_deco_alpha">
			<div id="alpha_<?=$joueur[$i]->id_joueur?>" class="title_deco">décoration acquise en alpha</div>
			<div class="content_deco" id="content_alpha_<?=$joueur[$i]->id_joueur?>">
			<?php
			foreach($medailles as $o){
								if($o->groupe!=0) continue;
                                ?>
			<img src="upload/medaille/<?= $o->img; ?>" title="<?= $o->nom.' '.str_replace('"','',$o->description); ?>" width="35" id="medaille_<?= $o->groupe ?>_<?=$joueur[$i]->id_joueur ?>_<?= $o->id; ?>" />
			<?php
                } 
			?>
				<br />
<?php
			foreach($rubans as $o){
								if( $o->groupe!=0) continue;
                                ?>
			<img src="upload/ruban/<?= $o->img; ?>" title="<?= $o->nom.' '.str_replace('"','',$o->description); ?>" width="50" id="ruban_<?= $o->groupe ?>_<?=$joueur[$i]->id_joueur ?>_<?= $o->id; ?>"  />
			<?php
                } 
			?>
				<br />
<?php
			foreach($insignes as $o){
								if($o->groupe!=0) continue;
                                ?>
			<img src="upload/insigne/<?= $o->img; ?>" title="<?= $o->nom.' '.str_replace('"','',$o->description); ?>" width="50" id="insigne_<?= $o->groupe ?>_<?=$joueur[$i]->id_joueur ?>_<?= $o->id; ?>"  />
			<?php
                } 
			?>
				</a>
			</div>
			<div class="all_deco" id="all_deco_beta">
			<div id="beta_<?=$joueur[$i]->id_joueur?>" class="title_deco">décoration acquise en beta</div>
			<div class="content_deco" id="content_beta_<?=$joueur[$i]->id_joueur?>">
			<?php
			foreach($medailles as $o){
								if($o->groupe!=1) continue;
                                ?>
			<img src="upload/medaille/<?= $o->img; ?>" title="<?= $o->nom.' '.str_replace('"','',$o->description); ?>" width="35"  />
			<?php
                } 
			?>
				<br />
<?php
			foreach($rubans as $o){
								if( $o->groupe!=1) continue;
                                ?>
			<img src="upload/ruban/<?= $o->img; ?>" title="<?= $o->nom.' '.str_replace('"','',$o->description); ?>" width="50"  />
			<?php
                } 
			?>
							<br />
<?php
			foreach($insignes as $o){
								if( $o->groupe!=1) continue;
                                ?>
			<img src="upload/insigne/<?= $o->img; ?>" title="<?= $o->nom.' '.str_replace('"','',$o->description); ?>" width="50"  />
			<?php
                } 
			?>
			
			</div>
			
			</div>
			<div class="all_deco" id="all_deco_release">
			<div id="release_<?=$joueur[$i]->id_joueur?>" class="title_deco">décoration acquise à la release</div>
			<div class="content_deco" id="content_release_<?=$joueur[$i]->id_joueur?>">
			<?php
			foreach($medailles as $o){
								if( $o->groupe!=2) continue;
                                ?>
			<img src="upload/medaille/<?= $o->img; ?>" title="<?= $o->nom.' '.str_replace('"','',$o->description); ?>" width="35"  />
			<?php
                } 
			?>
				<br />
<?php
			foreach($rubans as $o){
								if( $o->groupe!=2) continue;
                                ?>
			<img src="upload/ruban/<?= $o->img; ?>" title="<?= $o->nom.' '.str_replace('"','',$o->description); ?>" width="50"  />
			<?php
                } 
			?>
			
							<br />
<?php
			foreach($insignes as $o){
								if( $o->groupe!=2) continue;
                                ?>
			<img src="upload/insigne/<?= $o->img; ?>" title="<?= $o->nom.' '.str_replace('"','',$o->description); ?>" width="50"  />
			<?php
                } 
			?>
			
			</div>
			
			<br />
			<img src="http://vps36292.ovh.net/mordu/t/<?=$team_joueur[0]->tag ?>/<?=$joueur[$i]->handle?>.png" /><br />
			
			</div>
			</div>
			</td><td style="background:rgba(0, 0, 0, 0.9) url(https://robertsspaceindustries.com//rsi/static/images/header/rsi_menu_glow_noise.png) repeat 0px -14px" width="630"><div style="position:relative;width:630px">
<div style="position:absolute;top: 296px;left: 376px;width:130px;text-align:center">
<?php
							$max_medaille=18; //6*3
                            $inc_medaille=0;
                            foreach($medailles as $o){
								if(!$o->affiche || $o->groupe!=$phase) continue;
                                foreach($medailles as $o2){
                                    if($o2->remplace == $o->id) continue 2;
                                }
								$inc_medaille++;
								if($inc_medaille>$max_medaille) break;
                                ?><img src="upload/medaille/<?php echo $o->img; ?>" title="<?= $o->nom.' '.str_replace('"','',$o->description); ?>" width="35" class="medaille" style="position:relative;z-index:<?= (500-$inc_medaille)?>" />
								<?php
                            } ?>
</div>

<div style="position:absolute;top: 207px;left: 353px;width:175px;text-align:left" >
<?php
                       
                            $max_ruban=30; //5*6
							$inc_ruban=0;
                            foreach($rubans as $o){
								if(!$o->affiche || $o->groupe!=$phase) continue;
                                foreach($rubans as $o2){
                                    if($o2->remplace == $o->id) continue 2;
                                }
                                
								$inc_ruban++;
								if($inc_ruban>$max_ruban) break;
                                ?><img src="upload/ruban/<?php echo $o->img; ?>" title="<?= $o->nom.' '.str_replace('"','',$o->description); ?>" width="35" height="7" class="ruban"  /><?php
                            } ?>
</div>
<?php

                       
                            $max_insigne=1;
							$inc_insigne=0;
                            foreach($insignes as $o){
								if(!$o->affiche || $o->groupe!=$phase) continue;
                                foreach($insignes as $o2){
                                    if($o2->remplace == $o->id) continue 2;
                                }
								$inc_insigne++;
								if($inc_insigne>$max_insigne) break;
                                ?><img src="upload/insigne/<?php echo $o->img; ?>" title="<?= $o->nom.' '.str_replace('"','',$o->description); ?>"  class="badge306"  /><?php
                            } 
?>
<img src="images/veste_officer.png" />
</div></td>
			</tr>
			<tr><td valign="middle" class="alignLeft" colspan="2">
			
            <?php
            foreach($vaisseau_joueur as $o){ ?>

                    <div class="container_vaisseauMedium reduce">
					<img src="upload/vaisseau/<?=$o->img?>" class="vaisseauMedium" title='<?=$o->type?> <?=$o->nom?>' />
					</div>

            <?php } ?>
            </td></tr>
			<tr><td valign="middle" class="alignLeft" colspan="2" style="background:url(https://robertsspaceindustries.com/rsi/static/images/home/flipboard/event-noise.png)">
			
            <br>
            </td></tr>
			
        <?php } ?>

    </table>
</center> 