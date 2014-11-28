<?php

class ConstructeurManager {
    private $bdd;
    
    public function __construct(MyPDO $bdd = null) {
        if($bdd){
            $this->bdd = $bdd;
        }
        else{
            $this->bdd = new MyPDO();
        }
    }
    
    public function get_constructeur($id){
        $query="SELECT id_constructeur, nom, logo 
                FROM ".MyPDO::DB_FLAG."constructeur
                WHERE id_constructeur=? "; 
        return $this->bdd->query($query,$id);
    }
    
    public function get_all_constructeur($limit = null){
        $query="SELECT id_constructeur, nom, logo 
                FROM ".MyPDO::DB_FLAG."constructeur
                order by id_constructeur desc "; 
        if(is_int($limit)){
            $query.=" LIMIT 0, $limit";
        }
        return $this->bdd->query($query);
    }
    
    public function set_constructeur( Constructeur $c){
        $query="INSERT INTO ".MyPDO::DB_FLAG."constructeur (nom, logo)
                VALUES(?,?)";
        $this->bdd->query($query,$c->get_nom(), $c->get_logo());
    }
}
?>