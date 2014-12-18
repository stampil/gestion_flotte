<?php
include_once 'template/menu.php';
if(!is_connected()) exit("veuillez vous (re)connectez");

$joueurM = new JoueurManager($bdd);
$teamM = new TeamManager($bdd);

$teams =$joueurM->get_team($USER->get_id());

$joueur= $teamM->get_membre($teams[0]->id_team);
?>
<center>
<table class="table">
    <tr>
        <th>Nom</th>
        <th>Logo</th>
        <th>Orientation</th>
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
               echo '<img src="upload/orientation/'.$o->logo.'" class="logoMini help" title="'.$o->nom.'" /> ';
            }
            
            echo '</td>';
            
       
        
         echo '<td>x / x / '.number_format($cargo, 0, ",", " ").' Freight&nbsp;Units</td>';
        echo '</tr>';
         echo '<tr><td class="alignLeft" colspan="4">';
            foreach($flotte as $o){
            $cargo+=$o->cargo*$o->nb;
            echo '<div class="container_vaisseauMedium reduce">'
            . '<img src="upload/vaisseau/'.$o->img.'" class="vaisseauMedium help"  />'
            . '<div class="in_container_vaisseauMedium visible">'
            . '<div title="'.$o->nb.'x '.$o->vaisseau.' ('.($o->cargo*$o->nb).' FU)">'.$o->nb.'</div>'
            . '</div>'
            . '</div>';

            }
        echo '</td></tr>';
    }
    ?>
</table>
    
    
    <table class="table">
        <tr>
            <th>Handle</th>
            <th>Team</th>
            <th>Avatar</th>
            <th>Orientation</th>
            
        </tr>
        <?php
        $tr ="";

        for ($i = 0; $i < count($joueur); $i++) {
            
            $orientation_joueur = $joueurM->get_orientation($joueur[$i]->id_joueur);
            $vaisseau_joueur = $joueurM->get_vaisseau($joueur[$i]->id_joueur);
            $team_joueur = $joueurM->get_team($joueur[$i]->id_joueur);
            $tr.= '<tr>'
            . '<td valign="middle">' . $joueur[$i]->handle . '</td>'
                    . '<td>';
            
            foreach($team_joueur as $o){
                $tr.= '<img src="upload/team/'.$o->logo.'" class="logoMini help teamPrincipale'.$o->principal.'" title="'.$o->nom.' '.($o->principal?'(principal)':'').'" />';
            }   
            $tr.= '</td>'
            . '<td><img class="logoMedium" src="upload/joueur/' . $joueur[$i]->img . '"></td>'
            . '<td valign="middle" class="alignLeft">';
            foreach($orientation_joueur as $o){
                $tr.= '<img src="upload/orientation/'.$o->logo.'" class="logoMini help" title="'.$o->nom.'" /> ';
            }
            $tr.= '</td>'
            . '</tr>';
            $tr.= '<tr><td valign="middle" class="alignLeft" colspan="4">';
            
            foreach($vaisseau_joueur as $o){

                    $tr.= '<div class="container_vaisseauMedium reduce">';
                    $tr.= '<img src="upload/vaisseau/'.$o->img.'" class="vaisseauMedium" title=\''.$o->type.' "'.$o->nom.'"\' />';
                    $tr.= '</div>';

            }
            $tr.= '</td></tr>';
            }
        echo $tr;
        ?>
    </table>
</center> 