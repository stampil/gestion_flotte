<?php
include_once 'template/menu.php';

if(!is_connected()) exit("veuillez vous (re)connectez");

$joueurM = new JoueurManager($bdd);
$alliance_groupe = $joueurM->get_groupe_alliance($USER->get_id());

$allianceM = new AllianceGroupeManager();

?>
<center>
 
<table class="table">
    <tr>
        <th>Nom</th>
        <th>Logo</th>
        <th>Charte</th>
        <th>Membres</th>
        <th>Flotte</th>
        <th>Capacité soute<br /><span title="Si chacun prend son vaisseau ayant sa meilleur capacité de soute" class="help">Min</span>/<span title="si ceux qui ont plusieurs gros vaisseau les pretes a ceux qui ont des vaisseaux de petites soute" class="help">Max</span>/<span title="somme de toutes les soutes" class="help">Total</span></th>

    </tr>
    <?php
    
    for($i=0; $i<count($alliance_groupe);$i++){
        $cargo=0;
        $get_allied = $allianceM->get_allied($alliance_groupe[$i]->id_alliance);
        $flotte = $allianceM->get_flotte($alliance_groupe[$i]->id_alliance);
        echo '<tr>'
        . '<td valign="middle"><a href="'.($alliance_groupe[$i]->url?$alliance_groupe[$i]->url:'#').'" target="_blank">'.$alliance_groupe[$i]->nom.'</a></td>';
            if($alliance_groupe[$i]->logo)   echo '<td><img class="logoMedium" src="upload/groupeAlliance/'.$alliance_groupe[$i]->logo.'"></td>';
            else echo '<td></td>';
            echo     '<td><div class="displayLimited">'.$alliance_groupe[$i]->description.'</div></td>';
            echo '<td>';
            foreach($get_allied as $o){
                echo '<img src="upload/team/'.$o->logo.'" class="logoMini" title="'.$o->nom.'" />';
            }
            echo '</td>';
            
            echo '<td class="alignLeft">';
            foreach($flotte as $o){

                $cargo+=$o->cargo*$o->nb;
                            echo '<div class="container_vaisseauMedium reduce">'
            . '<img src="upload/vaisseau/'.$o->img.'" class="vaisseauMedium help"  />'
            . '<div class="in_container_vaisseauMedium visible">'
            . '<div title="'.$o->nb.'x '.$o->vaisseau.' ('.($o->sum_cargo).' FU)">'.$o->nb.'</div>'
            . '</div>'
            . '</div>';                
            }
            echo'</td>';
            echo '<td>x / x / '.number_format($cargo, 0, ",", " ").' Freight&nbsp;Units</td>';
             echo '</tr>';
    }
    ?>
</table>
</center> 