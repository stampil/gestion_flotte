<?php
if (!is_connected()){     header("Location: ?action=connexion&origine=".  urlencode($_SERVER["QUERY_STRING"]));     exit("veuillez vous (re)connectez"); }
$decoM = new DecorationManager($bdd);
$joueurM = new JoueurManager($bdd);
$info_joueur = $joueurM->get_all_joueur();
if(!empty($_GET['msg'])) echo $_GET['msg'];
?>

    <form method="POST" action="desattribue_deco.php" enctype="multipart/form-data">
      
                    <?php
                    foreach($info_joueur as $c){
                        ?>
                        <div id="joueur_<?php echo $c->id_joueur?>">
                            <fieldset>
                                <legend><?php echo ''.$c->handle.($c->tag?' ('.$c->tag.')':'').''; ?></legend>
                                <hr />Insignes<br />
                                <?php
                                $decos = $joueurM->get_insigne($c->id_joueur);
                                foreach($decos as $deco){
                                    ?>
                                <div>
                                    <?php echo $deco->nom ?> <img src="upload/insigne/<?php echo $deco->img ?>" style="max-width: 60px;max-height:60px" />
                                    (<?php
                                    if($deco->groupe==0){
                                        echo 'alpha';
                                    }
                                    elseif($deco->groupe==1){
                                        echo 'beta';
                                    }
                                    else{
                                        echo 'release';
                                    }
                                    ?>)
                                    <input type="checkbox" name="remove_insigne[]" value="<?php echo $deco->id.','.$deco->groupe.','.$c->id_joueur ?>" />
                                </div>
                                <?php
                                }
                                ?>
                                
                                <hr />
                                Medailles<br />
                                <?php
                                $decos = $joueurM->get_medaille($c->id_joueur);
                                foreach($decos as $deco){
                                    ?>
                                <div>
                                    <?php echo $deco->nom ?> <img src="upload/medaille/<?php echo $deco->img ?>" style="max-width: 60px;max-height:60px" />
                                    (<?php
                                    if($deco->groupe==0){
                                        echo 'alpha';
                                    }
                                    elseif($deco->groupe==1){
                                        echo 'beta';
                                    }
                                    else{
                                        echo 'release';
                                    }
                                    ?>)
                                    <input type="checkbox" name="remove_medaille[]" value="<?php echo $deco->id.','.$deco->groupe.','.$c->id_joueur ?>" />
                                </div>
                                <?php
                                }
                                ?>
                                
                                <hr />
                                Ruban<br />
                                <?php
                                $decos = $joueurM->get_ruban($c->id_joueur);
                                foreach($decos as $deco){
                                    ?>
                                <div>
                                    <?php echo $deco->nom ?> <img src="upload/ruban/<?php echo $deco->img ?>" style="max-width: 60px;max-height:60px" />
                                    (<?php
                                    if($deco->groupe==0){
                                        echo 'alpha';
                                    }
                                    elseif($deco->groupe==1){
                                        echo 'beta';
                                    }
                                    else{
                                        echo 'release';
                                    }
                                    ?>)
                                    <input type="checkbox" name="remove_ruban[]" value="<?php echo $deco->id.','.$deco->groupe.','.$c->id_joueur ?>" />
                                </div>
                                <?php
                                }
                                ?>
                                
                                <hr />
                            </fieldset>
                        </div>
                        <?php
                    }
                    ?>
                    </select></td>      
            
    <input type="submit" value="enlever les decos selectionnées" style="position:fixed;top:90px;right: 180px" />
    </form>

