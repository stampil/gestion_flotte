<?php

class AllianceManager {
    private $bdd;
    
    public function __construct(MyPDO $bdd = null) {
        if($bdd){
            $this->bdd = $bdd;
        }
        else{
            $this->bdd = new MyPDO();
        }
    }
    
    public function get_alliance($id){
        $query="SELECT id_alliance, nom, charte 
                FROM ".MyPDO::DB_FLAG."alliance
                WHERE id_alliance=? "; 
        return $this->bdd->query($query,$id);
    }
    
    public function set_alliance(Alliance $o){
        
        $query="INSERT INTO ".MyPDO::DB_FLAG."alliance (nom, charte) 
                VALUES(?,?) "; 
        $this->bdd->query($query,$o->get_nom(), $o->get_charte());
        return $this->bdd->lastInsertId();
    }
    
    public function get_all_alliance($limit = null){
        $query="SELECT id_alliance, nom, charte
                FROM ".MyPDO::DB_FLAG."alliance
                order by id_alliance desc "; 
        if(is_int($limit)){
            $query.=" LIMIT 0, $limit";
        }
        return $this->bdd->query($query);
    } 
    
    public function set_alliance_team($id_teamA, $id_teamB, $id_alliance){
        $query="INSERT INTO ".MyPDO::DB_FLAG."alliance_team (id_team, id_team_".MyPDO::DB_FLAG."team, id_alliance) 
                VALUES(?,?,?) "; 
        $this->bdd->query($query,$id_teamA, $id_teamB, $id_alliance);
    }
    
    public function get_all_alliance_team($filtre =null, $limit = null){
        $query="SELECT a_t.id_team, a_t.id_team_".MyPDO::DB_FLAG."team, a_t.id_alliance,
            tA.nom as nomA, tA.logo as logoA, tA.url as urlA, tA.tag as tagA, tA.nbJoueur as nbJoueurA,
            tB.nom as nomB, tB.logo as logoB, tB.url as urlB, tB.tag as tagB, tB.nbJoueur as nbJoueurB,
            a.nom as alliance, a.charte
               FROM ".MyPDO::DB_FLAG."alliance_team a_t
               JOIN ".MyPDO::DB_FLAG."team tA ON a_t.id_team = tA.id_team
               JOIN ".MyPDO::DB_FLAG."team tB ON a_t.id_team_".MyPDO::DB_FLAG."team = tB.id_team
               JOIN ".MyPDO::DB_FLAG."alliance a ON a_t.id_alliance = a.id_alliance
               "; 
        if($filtre){
            $query.=" WHERE a_t.id_team=".((int) $filtre)." OR  a_t.id_team_".MyPDO::DB_FLAG."team=".((int) $filtre);
        }
        if(is_int($limit)){
            $query.=" LIMIT 0, $limit";
        }
        return $this->bdd->query($query);
    }
    
}
?>