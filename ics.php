<?php

session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
if (isset($_GET["download"])) {
    header('Content-type: text/calendar; charset=UTF-8');
    header("Content-Disposition: attachment; filename=sortie_starcitizen.ics");
}

require 'require/commun.php';
$date_deb = date("Y-m-d");
$date_fin = date("Y-m-d", strtotime(" +14 day"));
$sortieM = new SortieManager($bdd);
$sorties = $sortieM->get_range_sortie($date_deb . " :00:00:00", $date_fin . " :23:59:59");
?>
<?php

$ics = "BEGIN:VCALENDAR\r\nMETHOD:PUBLISH\r\nVERSION:2.0\r\nX-WR-CALNAME;VALUE=TEXT:Sortie starcitizen\r\nPRODID:-//starcitizen/fan//NONSGML v1.0//EN\r\n";
foreach ($sorties as $value) {
    $sortie = new Sortie($sortieM->get_sortie($value->id_sortie));
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

    if ($ok) {
        $ics.= "BEGIN:VEVENT\r\nUID:sortie_" . $sortie->get_id() . "@robertsspaceindustries.fr\r\nDTSTART:" . gmdate("Ymd\THis\Z", strtotime($sortie->get_debut())) . "\r\nDTEND:" . gmdate("Ymd\THis\Z", strtotime($sortie->get_fin())) . "\r\nCREATED:" . gmdate("Ymd\THis\Z", strtotime($sortie->get_creato())) . ($sortie->get_modifo() ? "\r\nLAST-MODIFIED:" . gmdate("Ymd\THis\Z", strtotime($sortie->get_modifo())) : '') . "\r\nDTSTAMP:" . gmdate("Ymd\THis\Z") . "\r\nORGANIZER;CN=" . $sortie->get_organisateur()->get_handle() . ":mailto:no-reply@gmail.com\r\nSTATUS:CONFIRMED\r\nSUMMARY:" . $sortie->get_titre() . " par [" . $sortie->get_organisateur()->get_team()->get_tag() . "] " . $sortie->get_organisateur()->get_handle() . "\r\nURL;VALUE=URI:" . str_replace(" ", "%20", $sortie->get_teamspeak()->get_url()) . "\r\nDESCRIPTION:" . ($sortie->get_detail() ? str_replace(array("\r\n", "\n"), '\n', $sortie->get_detail()) : 'pas de description') . "\r\nEND:VEVENT\r\n";
    } else {
        $ics.= "BEGIN:VEVENT\r\nUID:sortie_" . $sortie->get_id() . "@robertsspaceindustries.fr\r\nDTSTART:" . gmdate("Ymd\THis\Z", strtotime($sortie->get_debut())) . "\r\nDTEND:" . gmdate("Ymd\THis\Z", strtotime($sortie->get_fin())) . "\r\nCREATED:" . gmdate("Ymd\THis\Z", strtotime($sortie->get_creato())) . ($sortie->get_modifo() ? "\r\nLAST-MODIFIED:" . gmdate("Ymd\THis\Z", strtotime($sortie->get_modifo())) : '') . "\r\nDTSTAMP:" . gmdate("Ymd\THis\Z") . "\r\nORGANIZER;CN=" . $sortie->get_organisateur()->get_handle() . ":mailto:no-reply@gmail.com\r\nSTATUS:CONFIRMED\r\nSUMMARY:Sortie privee ".$sortie->get_organisateur()->get_team()->get_tag()."\r\nURL;VALUE=URI:http://www.robertsspaceindustries.fr\r\nDESCRIPTION:Veuillez vous connecter sur le site pour voir si vous pouvez afficher les details\r\nEND:VEVENT\r\n";
    }
}
$ics .= "END:VCALENDAR";
echo $ics;
?>