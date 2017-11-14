<?php

$decoM = new DecorationManager($bdd);
$joueurM = new JoueurManager($bdd);
$info_joueur = $joueurM->get_all_joueur();
if(!empty($_GET['msg'])) echo $_GET['msg'];
?>

    <form method="POST" action="desattribue_insigne.php" enctype="multipart/form-data">
      
                    <?php
                    foreach($info_joueur as $c){
                        ?>
                        <div id="joueur_<?php echo $c->id_joueur?>">
                            <fieldset >
                                <legend><?php echo ''.$c->handle.($c->tag?' ('.$c->tag.')':'').''; ?></legend>
                            </fieldset>
                        </div>
                        <?php
                    }
                    ?>
                    </select></td>      
            

    </form>

