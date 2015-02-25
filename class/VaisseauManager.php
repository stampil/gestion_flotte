<?php
class VaisseauManager {
    private $bdd;
    
    public function __construct(MyPDO $bdd = null) {
        if($bdd){
            $this->bdd = $bdd;
        }
        else{
            $this->bdd = new MyPDO();
        }
    }
    
    public function get_vaisseau($id){
        $query="SELECT id_vaisseau, nom, img, categorie, focus, cargo, autonomie, coutReparation, nbEquipage, id_constructeur 
                FROM ".MyPDO::DB_FLAG."vaisseau
                WHERE id_vaisseau=? "; 
        $ret = $this->bdd->query($query,$id);
        return @$ret[0];
    }
    
    public function get_all_vaisseau($limit = null){
        $query="SELECT id_vaisseau, nom, img, categorie, focus, cargo, autonomie, coutReparation, nbEquipage, id_constructeur  
                FROM ".MyPDO::DB_FLAG."vaisseau
                order by nom "; 
        if(is_int($limit)){
            $query.=" LIMIT 0, $limit";
        }
        return $this->bdd->query($query);
    }
    
    public function set_vaisseau( Vaisseau $o){
        $query="INSERT INTO ".MyPDO::DB_FLAG."vaisseau (nom, img, categorie, focus, cargo, autonomie, coutReparation, nbEquipage, id_constructeur)
                VALUES(?,?,?,?,?,?,?,?,?)";
        $this->bdd->query($query,$o->get_nom(), $o->get_img(), $o->get_categorie(), $o->get_focus(), $o->get_cargo(), $o->get_autonomie(), $o->get_coutReparation(), $o->get_nbEquipage(), $o->get_constructeur()->get_id());
    }
}
?>