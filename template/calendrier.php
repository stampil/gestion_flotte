<?php
$date_deb = date("Y-m-d");
$date_fin = date("Y-m-d", strtotime(" +14 day"));
$sortieM = new SortieManager($bdd);
$sorties = $sortieM->get_range_sortie($date_deb . " :00:00:00", $date_fin . " :23:59:59");
?>
<table class="calendrier" align="center">
    <tr>
        <?php
        for ($i = 0; $i < 15; $i++) {
            echo '<th class="jour_calendrier jour_' . $i . '" title="Cliquer sur la date pour ajouter une sortie"><a href="?action=ajout_sortie&date=' . $i . '">' . $jours[date("w", strtotime(" +$i day"))] . ' ' . date("d/m", strtotime(" +$i day")) . '</a></th>';
        }
        ?>
    </tr>
    <tr>
        <?php
        for ($i = 0; $i < 15; $i++) {
            echo '<td class="jour_' . $i . '">';
            $date = date("Y-m-d", strtotime(" +$i day"));
            $html = "";

            foreach ($sorties as $value) {
                $sortie = new Sortie($sortieM->get_sortie($value->id_sortie));
                $participants = $sortieM->get_participant($value->id_sortie);
                $nb_present = 0;
                foreach ($participants as $participant) {
                    if($participant->id_jv){
                        $nb_present++;
                    }
                }

                
                $ok = false;
                //TEST VISIB TEAM

                if ($sortie->get_visibilite() == SORTIE_VISIBILITE_TOUS) {
                    $ok = true;
                } elseif ($sortie->get_visibilite() == SORTIE_VISIBILITE_TEAM) {
                    $ok = false;
                    if ($USER) {
                        $teams = $USER->get_all_team();
                        foreach ($teams as $team) {
                            if ($team->id_team == $sortie->get_organisateur()->get_team()->get_id()) {
                                $ok = true;
                            }
                        }
                    }
                } elseif ($sortie->get_visibilite() == SORTIE_VISIBILITE_TEAM_ALLIE) {
                    $ok = false;
                    if ($USER) {//pas connecté, on ne traite pas cette sortie
                        $teams = $USER->get_all_team();

                        foreach ($teams as $team) {
                            if ($team->id_team == $sortie->get_organisateur()->get_team()->get_id()) {
                                $ok = true;
                                break;
                            }
                        }
                        if (!$ok) {
                            $groupes_alliance_orga = $sortie->get_organisateur()->get_groupe_alliance();
                            $groupes_alliance_user = $USER->get_groupe_alliance();
                            foreach ($groupes_alliance_orga as $groupe_alliance_orga) {
                                foreach ($groupes_alliance_user as $groupe_alliance_user) {
                                    if ($groupe_alliance_orga->id_alliance == $groupe_alliance_user->id_alliance) {
                                        $ok = true;
                                        break 2;
                                    }
                                }
                            }
                        }
                    }
                }
                if (preg_match("/$date/", $value->debut) && $ok) {
                    $html.= '<a href="?action=voir_sortie&sortie=' . $sortie->get_id() . '">' . usdatetotime($sortie->get_debut()) . '&nbsp;:<br /><img src="upload/' . ($sortie->get_organisateur()->get_team()? 'team/'.$sortie->get_organisateur()->get_team()->get_logo():'joueur/'.$sortie->get_organisateur()->get_img()) . '" class="logoMini" title="De ' . usdatetotime($sortie->get_debut()) . ' à ' . usdatetotime($sortie->get_fin()) . ', '.$nb_present.' participant'.($nb_present>1?'s':'').' '.($sortie->get_max_joueur()?' sur '.$sortie->get_max_joueur():'').' cliquer pour les details"></a><span class="info_present">'.$nb_present.($sortie->get_max_joueur()?'/'.$sortie->get_max_joueur():'').'</span><div class="calendar_title">' . ucfirst($sortie->get_titre()) . '</div><a href="' . $sortie->get_teamspeak()->get_url() . '">TS</a> <a href="?action=voir_sortie&sortie=' . $sortie->get_id() . '">S\'inscrire</a><hr />';
                } elseif (preg_match("/$date/", $value->debut) && !$ok) {
                    $html.= '<a href="?action=connexion&origine='.urlencode('action=voir_sortie&sortie=' . $sortie->get_id()).'">' . usdatetotime($sortie->get_debut()) . '&nbsp;:<br /><img src="upload/team/' . $sortie->get_organisateur()->get_team()->get_logo() . '" class="logoMini" title="De ' . usdatetotime($sortie->get_debut()) . ' à ' . usdatetotime($sortie->get_fin()) . ', '.$nb_present.' participant'.($nb_present>1?'s':'').' '.($sortie->get_max_joueur()?' sur '.$sortie->get_max_joueur():'').' cliquer pour vous connecter"></a><span class="info_present">'.$nb_present.($sortie->get_max_joueur()?'/'.$sortie->get_max_joueur():'').'</span><div class="calendar_title">Sortie privée</div>'.($USER?'':'<a href="?action=connexion">Se connecter</a>').'<hr />';
                }
            }
            $html = substr($html, 0, -6);
            echo $html . '</td>';
        }
        ?>
    </tr>
</table>