<?php

class OrientationManager {
    private $bdd;
    
    public function __construct(MyPDO $bdd = null) {
        if($bdd){
            $this->bdd = $bdd;
        }
        else{
            $this->bdd = new MyPDO();
        }
    }
    
    public function get_orientation($id){
        $query="SELECT id_orientation, nom, logo 
                FROM ".MyPDO::DB_FLAG."orientation
                WHERE id_orientation=? "; 
        return $this->bdd->query($query,$id);
    }
    
    public function get_all_orientation($limit = null){
        $query="SELECT id_orientation, nom, logo 
                FROM ".MyPDO::DB_FLAG."orientation
                order by id_orientation desc "; 
        if(is_int($limit)){
            $query.=" LIMIT 0, $limit";
        }
        return $this->bdd->query($query);
    }
    
    public function set_orientation( Orientation $c){
        $query="INSERT INTO ".MyPDO::DB_FLAG."orientation (nom, logo)
                VALUES(?,?)";
        $this->bdd->query($query,$c->get_nom(), $c->get_logo());
    }
}
?>