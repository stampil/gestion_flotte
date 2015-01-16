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
                foreach ($sorties as $value) {
                    if(preg_match("/$date/", $value->debut)){
                        echo '<a href="?action=voir_sortie&sortie='.$value->id_sortie.'"><img src="upload/team/'.$value->logoTeam.'" class="logoMini" title="Debut:'.usdatetotime($value->debut).' fin: '.usdatetotime($value->fin).' cliquer pour les details"></a><br />'.$value->titre.'<hr />';
                    }
                }
                echo '</td>';
            }
            ?>
        </tr>
    </table>