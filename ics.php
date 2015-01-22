<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
header('Content-type: application/calendar; charset=UTF-8');
header("Content-Disposition: attachment; filename=sortie_starcitizen.ics");   
require 'require/commun.php';
$date_deb = date("Y-m-d");
$date_fin = date("Y-m-d",  strtotime(" +14 day"));
$sortieM = new SortieManager($bdd);
$sorties = $sortieM->get_range_sortie($date_deb . " :00:00:00", $date_fin . " :23:59:59");

//echo gmdate ("Ymd\THis\Z" , strtotime("2015-01-23 21:00:00") );
/*
  BEGIN:VCALENDAR
  VERSION:2.0
  PRODID:-//hacksw/handcal//NONSGML v1.0//EN
  BEGIN:VEVENT
  DTSTART:20080123
  DTEND:20080123
  SUMMARY:Anniversaire de Pierre Lajoie
  LOCATION:TS-FEU
  DESCRIPTION:pierre.lajoie@masociete.com
  END:VEVENT
  BEGIN:VEVENT
  ORGANIZER:toto
  DTSTART:20150123T210000
  DTEND:20150123T235959
  SUMMARY:entrainement vol
  LOCATION:TS-Starpirates
  DESCRIPTION:commentaires\nqui tue
  SEQUENCE:1
  END:VEVENT
  END:VCALENDAR */
?>
BEGIN:VCALENDAR
VERSION:2.0
PRODID:-//hacksw/handcal//NONSGML v1.0//EN
<?php
foreach ($sorties as $value) {
    $sortie = new Sortie($sortieM->get_sortie($value->id_sortie));
    $ok = false;
    //TEST VISIB TEAM
    if ($sortie->get_visibilite() == SORTIE_VISIBILITE_TEAM) {
        if (!$USER) {//pas connecté, on ne traite pas cette sortie
            continue;
        }

        $teams = $USER->get_all_team();

        foreach ($teams as $team) {
            if ($team->id_team == $sortie->get_organisateur()->get_team()->get_id()) {
                $ok = true;
            }
        }
        if (!$ok) {
            continue;
        }
    }

    //TEST VISIB TEAM + ALLI
    if ($sortie->get_visibilite() == SORTIE_VISIBILITE_TEAM_ALLIE) {
        if (!$USER) {//pas connecté, on ne traite pas cette sortie
            continue;
        }
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
                        break;
                    }
                }
            }
        }
        if (!$ok) {
            continue;
        }
    }
    //ALL TEST PASSED : DISPLAY
    
        echo 'BEGIN:VEVENT
ORGANIZER:' . $sortie->get_organisateur()->get_handle() . '
DTSTART:' . gmdate("Ymd\THis\Z", strtotime($sortie->get_debut())) . '
DTEND:' . gmdate("Ymd\THis\Z", strtotime($sortie->get_fin())) . '
SUMMARY:' . $sortie->get_titre() . '
LOCATION:' . $sortie->get_teamspeak()->get_url() . '
DESCRIPTION:' . $sortie->get_detail() . '
END:VEVENT';
    
}
?>