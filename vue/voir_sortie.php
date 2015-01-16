<pre><?php
if(!is_connected()) exit("veuillez vous (re)connectez");

$id_sortie = $_GET['sortie'];

$sortieM = new SortieManager();
$sortie = $sortieM->get_sortie($id_sortie);


print_r($sortie);

