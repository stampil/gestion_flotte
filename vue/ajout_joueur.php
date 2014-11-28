<?php
include_once 'template/menu.php';
$joueurM = new JoueurManager($bdd);
$last_joueur = $joueurM->get_all_joueur(50);
$orientationM = new OrientationManager($bdd);
$orientation = $orientationM->get_all_orientation();
$vaisseauM = new VaisseauManager($bdd);
$vaisseau = $vaisseauM->get_all_vaisseau();
$teamM = new TeamManager($bdd);
$team = $teamM->get_all_team();
?>
<center>
    <form method="POST" action="upload_joueur.php" enctype="multipart/form-data">
        <table class="tableform">
             <tr>
                <td>Team principale:</td>
                <td>
                   <select id="select_teamP_joueur" name="select_teamP_joueur[]" class="select">
                       <option value="0">Aucune</option>
                        <?php
                        for ($i = 0; $i < count($team); $i++) {
                            echo '<option value="'.$team[$i]->id_team.'">' . $team[$i]->tag . '</option>';
                        }
                        ?>
                       <option value="-1">Autre...</option>
                   </select>
                    <div>    
                </td>
            </tr>
            <tr>
                <td>Handle :</td>
                <td><input type="text" name="handle" id="handle" required> </td>      
            </tr>
             <tr>
                <td>Teams secondaires:</td>
                <td>
                   <select id="select_teamS_joueur" name="select_teamS_joueur[]" multiple="multiple" class="multiselect">
                        <?php
                        for ($i = 0; $i < count($team); $i++) {
                            echo '<option value="'.$team[$i]->id_team.'">' . $team[$i]->nom . '</option>';
                        }
                        ?>
                   </select>
                    <div>    
                </td>
            </tr>
            <tr>
                <td>Email :</td>
                <td><input type="email" name="email" required></td>      
            </tr>
            <tr>
                <td>Mot de passe :</td>
                <td><input type="password" name="mdp" required></td>      
            </tr>
            <tr>
                <td>Avatar :</td>
                <td><input type="file"  name="img" required></td>      
            </tr>
            <tr>
                <td>Orientation:</td>
                <td>
                   <select id="select_orientation_joueur" name="select_orientation_joueur[]" multiple="multiple" class="multiselect">
                        <?php
                        for ($i = 0; $i < count($orientation); $i++) {
                            echo '<option value="'.$orientation[$i]->id_orientation.'">' . $orientation[$i]->nom . '</option>';
                        }
                        ?>
                   </select>
                    <div>    
                </td>
            </tr>
            <tr>
                <td>Vaisseaux:</td>
                <td>

                       
                        <table class="table">
                        <?php
                        for ($i = 0; $i < count($vaisseau); $i++) {
                            echo '<div class="container_vaisseauMedium">'
                               . '<img src="upload/vaisseau/'.$vaisseau[$i]->img.'" class="vaisseauMedium" />'
                               . '<div class="in_container_vaisseauMedium disabled" id_vaisseau="'.$vaisseau[$i]->id_vaisseau.'">'.$vaisseau[$i]->nom.'</div>'
                               . '<div class="out_container_vaisseauMedium">Nb : <input type="number" min="0" value="0" class="numberTiny numberVaisseau" id_vaisseau="'.$vaisseau[$i]->id_vaisseau.'" name="nb_vaiss['.$vaisseau[$i]->id_vaisseau.']"/></div>'
                               . '<!-- a voir si LTI influe cout transport, si ajout enlever padding-top:9px a out_container_v <div class="out_container_vaisseauMedium"><span class="help" title="Cochez si au moins 1 vaisseau de ce type en assurance à vie.">LTI</span> : <input type="checkbox" name="LTI['.$vaisseau[$i]->id_vaisseau.']" /></div> -->'
                            . '</div>';
                        }
                        ?>
                        </table>
                        
  
                </td>
            </tr>
           
           
            <tr>
                <td>Est-ce bien vous ?</td>
                <td> <img src="https://robertsspaceindustries.com/citizens/" id="signature" /> <input type="submit" value="ok"></td>      
            </tr>
        </table>

    </form>

    <div> <?php echo min(count($last_joueur),50); ?> Derniers joueurs ajoutés :</div>
    
    <?php
    
    /*
    <table class="table">
        <tr>
            <th>Handle</th>
            <th>Team</th>
            <th>Avatar</th>
            <th>Orientation</th>
            <th>Vaisseau</th>
        </tr>
        <?php
        $tr ="";

        for ($i = 0; $i < count($last_joueur); $i++) {
            
            $orientation_joueur = $joueurM->get_orientation($last_joueur[$i]->id_joueur);
            $vaisseau_joueur = $joueurM->get_vaisseau($last_joueur[$i]->id_joueur);
            $team_joueur = $joueurM->get_team($last_joueur[$i]->id_joueur);
            $tr.= '<tr>'
            . '<td valign="middle">' . $last_joueur[$i]->handle . '</td>'
                    . '<td>';
            
            foreach($team_joueur as $o){
                $tr.= '<img src="upload/team/'.$o->logo.'" class="logoMini help teamPrincipale'.$o->principal.'" title="'.$o->nom.' '.($o->principal?'(principal)':'').'" />';
            }   
            $tr.= '</td>'
            . '<td><img class="logoMedium" src="upload/joueur/' . $last_joueur[$i]->img . '"></td>'
            . '<td valign="middle" class="alignLeft">';
            foreach($orientation_joueur as $o){
                $tr.= '<img src="upload/orientation/'.$o->logo.'" class="logoMini help" title="'.$o->nom.'" />';
            }
            $tr.= '</td>'
            . '<td valign="middle" class="alignLeft">';
            
            foreach($vaisseau_joueur as $o){
                for($j=0; $j <$o->nb; $j++){
                    $tr.= '<div class="container_vaisseauMedium reduce">';
                    $tr.= '<img src="upload/vaisseau/'.$o->img.'" class="vaisseauMedium" title="'.$o->nb.'x ('.$o->constructeur.') '.$o->nom.'" />';
                    $tr.= '</div>';
                }
            }
            $tr.= '</td></tr>';
            }
        echo $tr;
        ?>
    </table>
     * 
     */
    for($i=0; $i<count($last_joueur);$i++){
        echo '<a href="https://robertsspaceindustries.com/citizens/'.$last_joueur[$i]->handle.'" target="_blank"><img src="http://vps36292.ovh.net/mordu/t/'.$last_joueur[$i]->tag.'/'.$last_joueur[$i]->handle.'.png" /></a>';
    }
    ?>
</center> 