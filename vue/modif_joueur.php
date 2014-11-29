<?php
include_once 'template/menu.php';
if(!is_connected()) exit("veuillez vous (re)connectez");
$joueurM = new JoueurManager($bdd);
$last_joueur = $joueurM->get_all_joueur(50);
$orientationM = new OrientationManager($bdd);
$orientation = $orientationM->get_all_orientation();
$orientationU = $joueurM->get_orientation($USER->get_id());
$vaisseauM = new VaisseauManager($bdd);
$vaisseau = $vaisseauM->get_all_vaisseau();
$vaisseauU = $joueurM->get_vaisseau($USER->get_id());
$teamM = new TeamManager($bdd);
$team = $teamM->get_all_team();
$teamU = $joueurM->get_team($USER->get_id());

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
                <td>reecrire mot&nbsp;de&nbsp;passe actuel pour valider les modifs :</td>
                <td><input type="password" name="mdp" required></td>      
            </tr>
            <tr>
                <td>Nouveau mot de passe? :</td>
                <td><input type="password" name="mdp2" placeholder="laisser vide pour garder l'ancien"></td>      
            </tr>
            <tr>
                <td>Avatar :</td>
                <td><img src="upload/joueur/<?php echo $USER->get_img() ?>" /></td>      
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
                <td>Vaisseaux:</td>
                <td>

                       
                        <table class="table">
                        <?php
                        for ($i = 0; $i < count($vaisseau); $i++) {
                            $nb_vaiss=0;
                            foreach($vaisseauU as $o){
                               if($o->id_vaisseau == $vaisseau[$i]->id_vaisseau) {
                                   $nb_vaiss = $o->nb;
                               }
                            }
                            echo '<div class="container_vaisseauMedium">'
                               . '<img src="upload/vaisseau/'.$vaisseau[$i]->img.'" class="vaisseauMedium" />'
                               . '<div class="in_container_vaisseauMedium '.(!$nb_vaiss?'disabled':'').'" id_vaisseau="'.$vaisseau[$i]->id_vaisseau.'" title="'.$vaisseau[$i]->nom.'">'.$vaisseau[$i]->nom.'</div>'
                               . '<div class="out_container_vaisseauMedium">Nb : <input type="number" min="0" value="'.$nb_vaiss.'" class="numberTiny numberVaisseau" id_vaisseau="'.$vaisseau[$i]->id_vaisseau.'" name="nb_vaiss['.$vaisseau[$i]->id_vaisseau.']"/></div>'
                               . '<!-- a voir si LTI influe cout transport, si ajout enlever padding-top:9px a out_container_v <div class="out_container_vaisseauMedium"><span class="help" title="Cochez si au moins 1 vaisseau de ce type en assurance à vie.">LTI</span> : <input type="checkbox" name="LTI['.$vaisseau[$i]->id_vaisseau.']" /></div> -->'
                            . '</div>';
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