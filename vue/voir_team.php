<?php
include_once 'template/menu.php';
if(!is_connected()) exit("veuillez vous (re)connectez");

$joueurM = new JoueurManager($bdd);
$teamM = new TeamManager($bdd);

$teams =$joueurM->get_team($USER->get_id());
?>
<center>
<table class="table">
    <tr>
        <th>Nom</th>
        <th>Logo</th>
        <th>Orientation</th>
        <th>Flotte</th>
        <th>Capacité soute<br /><span title="Si chacun prend son vaisseau ayant sa meilleur capacité de soute" class="help">Min</span>/<span title="si ceux qui ont plusieurs gros vaisseau les pretes a ceux qui ont des vaisseaux de petites soute" class="help">Max</span>/<span title="somme de toutes les soutes" class="help">Total</span></th>

    </tr>
    <?php
    for($i=0; $i<count($teams);$i++){
        $cargo=0;
        $orientation_team = $teamM->get_orientation($teams[$i]->id_team);
        $flotte = $teamM->get_flotte($teams[$i]->id_team);
        echo '<tr>'
        . '<td valign="middle"><a href="'.$teams[$i]->url.'" target="_blank">'.$teams[$i]->nom.'</a></td>'
        . '<td><img class="logoBig" src="upload/team/'.$teams[$i]->logo.'"></td>';
        echo '<td valign="middle" class="alignLeft">';
            
            foreach($orientation_team as $o){
               echo '<img src="upload/orientation/'.$o->logo.'" class="logoMini help" title="'.$o->nom.'" />';
            }
            
            echo '</td>';
            
        echo '<td class="alignLeft">';
            foreach($flotte as $o){

                for($j=0; $j< $o->nb; $j++){
                    $cargo+=$o->cargo;
                    echo '<img src="upload/vaisseau/'.$o->img.'" class="vaisseauMedium help" title="'.$o->vaisseau.' (proprietaire :'.$o->joueur.')" />';
                }
            }
        echo '</td>';
        
         echo '<td>x / x / '.number_format($cargo, 0, ",", " ").' freight&nbsp;units</td>';
        echo '</tr>';
    }
    ?>
</table>
</center> 