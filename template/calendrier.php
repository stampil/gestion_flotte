<?php
$date_deb = date("Y-m-d");
$date_fin = date("Y-m-d",  strtotime(" +14 day"));
$sortieM = new SortieManager($bdd);
$sorties  = $sortieM->get_range_sortie($date_deb, $date_fin);

?>
<table class="calendrier" align="center">
        <tr>
            <?php
            for ($i=0;$i<15;$i++){
                echo '<th class="jour_'.$i.'" title="Cliquer sur la date pour ajouter une sortie"><a href="?action=ajout_sortie&date='.$i.'">'.$jours[date("w",  strtotime(" +$i day"))].' '.date("d/m",  strtotime(" +$i day")).'</a></th>';
            }
            ?>
        </tr>
        <tr>
            <?php
            for ($i=0;$i<15;$i++){
                echo '<td class="jour_'.$i.'">';
                $date =date("Y-m-d",  strtotime(" +$i day"));
                $html="";
                foreach ($sorties as $value) {
                    $sortie = new Sortie($sortieM->get_sortie($value->id_sortie));
                    
                    //TEST VISIB TEAM
                    if($sortie->get_visibilite() == SORTIE_VISIBILITE_TEAM ){  
                        $teams = $USER->get_all_team();
                        $ok = false;
                        foreach ($teams as $team) {
                            if($team->id_team == $sortie->get_organisateur()->get_team()->get_id()){
                                $ok =true;
                            }
                        }
                        if(!$ok){
                            continue;
                        }
                    }
                    
                    //TEST VISIB TEAM + ALLI
                    if($sortie->get_visibilite() == SORTIE_VISIBILITE_TEAM_ALLIE){
                        $teams = $USER->get_all_team();
                        $ok = false;
                        foreach ($teams as $team) {
                            if($team->id_team == $sortie->get_organisateur()->get_team()->get_id()){
                                $ok =true;
                                break;
                            }
                        }
                        if(!$ok){
                            $groupes_alliance_orga = $sortie->get_organisateur()->get_groupe_alliance();
                            $groupes_alliance_user = $USER->get_groupe_alliance();
                            foreach ($groupes_alliance_orga as $groupe_alliance_orga) {
                                foreach($groupes_alliance_user as $groupe_alliance_user){
                                    if($groupe_alliance_orga->id_alliance == $groupe_alliance_user->id_alliance){
                                        $ok = true;
                                        break;
                                    }
                                }
                            }
                            
                        }
                        if(!$ok){
                            continue;
                        }
                        
                    }
                    //ALL TEST PASSED : DISPLAY
                    if(preg_match("/$date/", $value->debut)){
                        $html.= '<a href="?action=voir_sortie&sortie='.$sortie->get_id().'">'.usdatetotime($sortie->get_debut()).'&nbsp;:<br /><img src="upload/team/'.$sortie->get_organisateur()->get_team()->get_logo().'" class="logoMini" title="De '.usdatetotime($sortie->get_debut()).' à '.usdatetotime($sortie->get_fin()).' cliquer pour les details"></a><br />'.ucfirst($sortie->get_fin()).'<br /><a href="'.$sortie->get_teamspeak()->get_url().'">TS</a><hr />';
                    }
                }
                $html = substr($html, 0,-6);
                echo $html.'</td>';
            }
            ?>
        </tr>
    </table>