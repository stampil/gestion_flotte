<?php
include_once 'template/menu.php';
if (!is_connected()){     header("Location: ?action=connexion&origine=".  urlencode($_SERVER["QUERY_STRING"]));     exit("veuillez vous (re)connectez"); }


$joueurM = new JoueurManager($bdd);
$orientationM = new OrientationManager($bdd);
$vaisseauM = new VaisseauManager($bdd);
$teamM = new TeamManager($bdd);

if(@$_GET["supp_ship"]){
    $joueurM->delete_vaisseau($USER->get_id(), $_GET["supp_ship"]);
}



$last_joueur = $joueurM->get_all_joueur(50);
$orientation = $orientationM->get_all_orientation();
$orientationU = $joueurM->get_orientation($USER->get_id()); //TODO passer par la classe joueur comme $USER->get_vaisseau();

$vaisseau = $vaisseauM->get_all_vaisseau();
$vaisseauU = $USER->get_vaisseau();

$team = $teamM->get_all_team();
$teamU = $joueurM->get_all_team($USER->get_id());//TODO passer par la classe joueur comme $USER->get_vaisseau();

?>
<center>
    <form method="POST" action="upload_modif_joueur.php" enctype="multipart/form-data">
        <table class="tableform">
            <tr>
                <td>Handle :</td>
                <td><input type="text" name="handle" disabled value="<?php echo $USER->get_handle() ?>"></td>      
            </tr>
            <tr>
                <td>Email :</td>
                <td><input type="email" name="email" required value="<?php echo $USER->get_email() ?>"></td>      
            </tr>
            <tr>
                <td><span title="reecrire mdp  actuel pour valider les modifs :">Mot&nbsp;de&nbsp;passe</span></td>
                <td><input type="password" name="mdp" required></td>      
            </tr>
            <tr>
                <td>Nouveau mot de passe? :</td>
                <td><input type="password" name="mdp2" placeholder="laisser vide pour garder l'ancien"></td>      
            </tr>
            <tr>
                <td>Avatar :</td>
                <td><img src="upload/joueur/<?php echo $USER->get_img() ?>"  class="logoMedium"/></td>      
            </tr>
            <tr>
                <td>Nouvel avatar? :</td>
                <td><input type="file"  name="img"></td>      
            </tr>
            <tr>
                <td>Orientation:</td>
                <td>
                   <select id="select_orientation_joueur" name="select_orientation_joueur[]" multiple="multiple" class="multiselect">
                        <?php
                        for ($i = 0; $i < count($orientation); $i++) {
                            
                            $selected="";
                            foreach($orientationU as $o){
                                if($o->id_orientation == $orientation[$i]->id_orientation){
                                    $selected="selected";
                                    break;
                                }
                            }
                            echo '<option value="'.$orientation[$i]->id_orientation.'" '.$selected.'>' . $orientation[$i]->nom . '</option>';
                        }
                        ?>
                   </select>
                    <div>    
                </td>
            </tr>
            <tr>
                
                <td colspan="2">
                    <p>Vaisseaux : </p>
                       
                        <table class="table">
                            <tr>
                                <th>Nom</th><th>Const.</th><th>Type</th><th>LTI</th><th><span class="help" title="Mettre la date réel si en réparation">Date dispo</span></th><th>Cargo</th><th><a title="Autonomie">Aut.</a></th><th>Cout rép.</th><th></th>
                            </tr>
                            <tr>
                            <td><input type="text" value="<?php echo uniqid("ship_") ?>" name="nom[0]" class="textMedium" /></td>
                            <td colspan="2"><select name="ajout_vaisseau" class="select"><option value="0">Ajouter un vaisseau</option>
                                <?php
                                foreach($vaisseau as $o){
                                    echo '<option value="'.$o->id_vaisseau.'">'.$o->nom.'</option>';
                                }
                                ?>
                                
                                </select></td>
                            <td><input type="checkbox" title="cochez si LTI"  name="LTI[0]" /></td>
                            <td colspan="5" class="alignRight"> <input type="submit" value="Ajouter un nouveau vaisseau" /></td>
                            </tr>
                            <?php

                            foreach($vaisseauU as $o){
                               echo '<tr><td>';
                               echo '<input type="text" class="textMedium" value="'.$o->nom.'" name="nom['.$o->id_jv.']" />';
                               echo'</td><td>';
                               echo '<img src="upload/constructeur/'.$o->constructeurLogo.'" title="'.$o->constructeur.'"/>';
                               echo'</td><td>';
                               echo '<img src="upload/vaisseau/'.$o->img.'" title="'.$o->type.'" class="vaisseauMedium"/>';
                               echo '</td><td>';
                               echo '<input type="checkbox" title="cochez si LTI" name="LTI['.$o->id_jv.']" '.($o->LTI?'checked="checked"':'').' />';
                               echo '</td><td>';
                               echo '<input type="date" name="date_dispo['.$o->id_jv.']" class="textMedium" value="'.$o->date_dispo.'" />';
                               echo '</td><td>';
                               echo '<input type="number" name="cargo['.$o->id_jv.']" class="numberTiny" value="'.($o->modifCargo===null?$o->cargo:$o->modifCargo).'" />';
                               echo '</td><td>';
                               echo '<input type="number" name="autonomie['.$o->id_jv.']" class="numberTiny" value="'.($o->modifAutonomie===null?$o->autonomie:$o->modifAutonomie).'" />';
                               echo '</td><td>';
                               echo '<input type="number" name="coutReparation['.$o->id_jv.']" class="numberTiny" value="'.($o->modifCoutReparation===null?$o->coutReparation:$o->modifCoutReparation).'" />';
                               echo '</td><td>';
                               echo '<a name="supprimer" href="?action=modif_joueur&supp_ship='.$o->id_jv.'" title="Supprimer"><img src="images/trash.png" alt="Supprimer" /></a>';
                               echo '</td></tr>';
                            }
                            
                        ?>
                        </table>
                        
  
                </td>
            </tr>
            <tr>
                <td>Team principale:</td>
                <td>
                   <select id="select_teamP_joueur" name="select_teamP_joueur[]" class="select">
                       <option value="0">Aucune</option>
                        <?php
                        for ($i = 0; $i < count($team); $i++) {
                            $selected="";
                            foreach($teamU as $o){
                                if($o->id_team == $team[$i]->id_team && $o->principal){
                                    $selected="selected";
                                    break;
                                }
                            }
                            echo '<option value="'.$team[$i]->id_team.'" '.$selected.'>' . $team[$i]->nom . '</option>';
                        }
                        ?>
                   </select>
                    <div>    
                </td>
            </tr>
            <tr>
                <td>Teams secondaires:</td>
                <td>
                   <select id="select_teamS_joueur" name="select_teamS_joueur[]" multiple="multiple" class="multiselect">
                        <?php
                        for ($i = 0; $i < count($team); $i++) {
                            $selected="";
                            foreach($teamU as $o){
                                if($o->id_team == $team[$i]->id_team && !$o->principal){
                                    $selected="selected";
                                    break;
                                }
                            }
                            echo '<option value="'.$team[$i]->id_team.'" '.$selected.'>' . $team[$i]->nom . '</option>';
                        }
                        ?>
                   </select>
                    <div>    
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="modifier"></td>      
            </tr>
        </table>

    </form>

   
</center> 