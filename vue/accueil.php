
<?php
if(isset($_GET["mess"])){
    echo '<div class="warning">'.$_GET["mess"].'</div>';
}

include_once 'template/calendrier.php';

$teamM = new TeamManager($bdd);
$team = $teamM->get_all_team();
?>
</div>

<div class="content">
<?php
$html="<br />";
foreach ($team as $o) {
    $html.= '<a href="'.$o->url.'">'.$o->nom.'<a><hr />';
    
}
$html = substr($html, 0,-6)."<br /><br />";

echo $html;
?>
