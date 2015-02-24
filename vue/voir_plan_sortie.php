<?php
if (!is_connected()){
    header("Location: ?action=connexion");
    exit("veuillez vous (re)connectez");
}

$id_sortie = $_GET['sortie'];

$sortieM = new SortieManager();
$sortie = new Sortie($sortieM->get_sortie($id_sortie));

if ($sortie->get_id_organisateur() == $USER->get_id()) {
    $organisateur = true;
} else {
    $organisateur = false;
}


$teamspeakM = new TeamspeakManager($bdd);
$teamspeak = $teamspeakM->get_all_teamspeak();

$vaisseau = $USER->get_vaisseau();

$joueurM = new JoueurManager($bdd);
$vaisseauM = new VaisseauManager($bdd);

$participants = $sortieM->get_participant($id_sortie);
$present = array();
$symboles = "";
$x = 100;
$y = 90;
$x2=900;
$num = 1;
$couleur = 0;

$nb_present = 0;
foreach ($participants as $participant) {
    if (!$participant->id_jv) {
        continue;
    }
    $nb_present++;
}

for ($i=0; $i<count($participants);$i++) {
    if($participants[$i]->id_jv && $participants[$i]->id_joueur==1 ){ //gourmand first lead TODO : lead first
            $interm = $participants[0];
            $participants[0] =  $participants[$i];
            $participants[$i] = $interm;
    }
    if($nb_present>4 && $participants[$i]->id_jv && $participants[$i]->id_joueur==9){ //9hawk second lead
        $interm = $participants[4];
        $participants[4] =  $participants[$i];
        $participants[$i] = $interm;
    }

}


foreach ($participants as $participant) {
    if (!$participant->id_jv) {
        continue;
    }
    $joueur = new Joueur($joueurM->get_joueur($participant->id_joueur));
    $vaisseau = new Vaisseau($vaisseauM->get_vaisseau($participant->id_vaisseau));

    if((int) $vaisseau->get_categorie()==0){
        switch ($num) {
            case 2:
                $x -= 80;
                $y += 80;
                break;
            case 3:
                $x += 160;
                break;
            case 4:
                $x+=80;
                $y+=80;
                if($nb_present==5 || $nb_present==6 || $nb_present==9){
                  $y = 90;
                  $x = 600;;  
                }
                break;
            case 5:
                
                $y = 90;
                $x = 600;
                break;
        }
    }
    else{
        
        switch ($num) {
            case 1:
                $y =120;
                break;
            case 5:
                $y=120;
                $x2+=180;
                break;
            default:
                $y+=120;
                break;
        }
        
        $x = $x2;
    }

    if($num==5 || ($num==4 && ($nb_present==5 || $nb_present==6 || $nb_present==9)) ){
        $couleur++;
        $num = 1;
    }
    $symboles .= 'new Symbole({x: ' . $x . ', y: ' . $y . '}, ' . (int) $vaisseau->get_categorie() . ', ' . $couleur . ', ' . $participant->role . ', ' . $num++ . ', "' . $vaisseau->get_nom() . '", "' . $joueur->get_handle() . '"),' . "\n";
}
$symboles = substr($symboles, 0, -2);
$nb_present = count($present);
// echo ($joueur->get_team() ? '[' . $joueur->get_team()->get_tag() . ']' : '') . ' ' . $joueur->get_handle() . " avec " . $vaisseau->get_nom() . ' ' . (!preg_match('/ship_.+/', $participant->nom) ? '(' . $participant->nom . ')' : '') . ' ' . ($participant->commentaire ? ':' : '') . '<br />Role : ' . $roles[$participant->role] . ' <br />' . $participant->commentaire . '<hr />';
?>
<p> <u>Mode edition :Selectionner un vaisseau puis cliquer sur</u> :
<p>c : couleur
<p>m : mouvement ( m ensuite fixe le mouvement )
<p>v : VIP ( v ensuite enleve le VIP )
<p>1-4 : attribution des numéros ( 1 : Leader )
</div>
<div class="content big">
    <center>
        <canvas id="canvas"></canvas>

        <script src="js/canvas_function.js"></script>
        <script>
            /*new Symbole({x: 200, y: 90}, type_symbole.leger, 1, type_vaisseau.combat, 'L', 'super hornet', 'gourmand')*/
            var couleur = {"rouge": "#ED1313", "bleu": "#139EED", "vert": "#13ED1A", "jaune": "yellow"};
            var couleurs = [couleur.rouge, couleur.bleu, couleur.vert, couleur.jaune];
            var type_vaisseau = {"neutre": 0, "medical": 1, "VIP": 2, "combat": 3, "marchand": 4};
            var type_symbole = {"leger": 0, "moyen": 1, "lourd": 2};
            var symboles = [
<?php echo $symboles; ?>
            ];
        </script>
        <script src="js/canvas.js"></script>
    </center>