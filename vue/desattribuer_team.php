<?php
if (!is_connected()){     header("Location: ?action=connexion&origine=".  urlencode($_SERVER["QUERY_STRING"]));     exit("veuillez vous (re)connectez"); }
$decoM = new DecorationManager($bdd);
$joueurM = new JoueurManager($bdd);
$info_joueur = $joueurM->get_all_joueur();

if(!empty($_GET['msg'])) echo $_GET['msg'];
?>

    <form method="POST" action="desattribue_team.php" enctype="multipart/form-data">
      
                    <?php
                    foreach($info_joueur as $c){
                        if(!$c->tag || $c->tag != $USER->get_team()->get_tag()) continue;
                        
                        ?>
                        <div id="joueur_<?php echo $c->id_joueur?>">
                            <fieldset>
                                <legend><?php echo ''.$c->handle.($c->tag?' ('.$c->tag.')':'').''; ?></legend>
                                <img src="http://vps36292.ovh.net/mordu/t/<?=$c->tag ?>/<?=$c->handle?>.png" /><br />
                                <input type="checkbox" name="remove_team[]" value="<?php echo $c->id_joueur ?>,<?php echo $c->id_team ?>" />
                            </fieldset>
                        </div>
                        <?php
                    }
                    ?>
                    </select></td>      
            
    <input type="submit" value="deguilder les joueurs selectionnés" style="position:fixed;top:90px;right: 180px" />
    </form>

