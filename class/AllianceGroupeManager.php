<?php

class AllianceGroupeManager {
    private $bdd;
    
    public function __construct(MyPDO $bdd = null) {
        if($bdd){
            $this->bdd = $bdd;
        }
        else{
            $this->bdd = new MyPDO();
        }
    }
    
    public function get_allianceGroupe($id){
        $query="SELECT id_alliance, nom, logo, url, description 
                FROM ".MyPDO::DB_FLAG."alliance_groupe
                WHERE id_alliance=? "; 
        return $this->bdd->query($query,$id);
    }
    
    public function set_allianceGroupe(AllianceGroupe $o){
        
        $query="INSERT INTO ".MyPDO::DB_FLAG."alliance_groupe (nom, logo, url, description) 
                VALUES(?,?,?,?) "; 
        $this->bdd->query($query,$o->get_nom(), $o->get_logo(), $o->get_url(), $o->get_description());
        return $this->bdd->lastInsertId();
    }
    
    public function get_allied($id_alliance){
        $query="SELECT ga.id_team, t.nom, t.logo
            FROM ".MyPDO::DB_FLAG."groupe_alliance ga
            JOIN ".MyPDO::DB_FLAG."team t ON ga.id_team = t.id_team
            WHERE id_alliance =?";
        
        return $this->bdd->query($query,$id_alliance);
    }
    
    public function get_all_allianceGroupe($limit = null){
        $query="SELECT id_alliance, nom, logo, url, description
                FROM ".MyPDO::DB_FLAG."alliance_groupe
                order by id_alliance desc "; 
        if(is_int($limit)){
            $query.=" LIMIT 0, $limit";
        }
        return $this->bdd->query($query);
    } 
    
    public function set_groupeAlliance($ids_team, $id_alliance){
        if(!is_array($ids_team)) return false;
        
        $query="INSERT INTO ".MyPDO::DB_FLAG."groupe_alliance (id_team, id_alliance) 
                VALUES(?,?) "; 
        foreach ($ids_team as $id_team) {
             $this->bdd->query($query,$id_team, $id_alliance);
        }
       
    }
    
    public function get_flotte($id_alliance){
        $query="SELECT  jpv.id_vaisseau, COUNT(jpv.id_vaisseau) as nb, v.nom as vaisseau, SUM(v.cargo) as cargo, v.img, count(jpv.id_vaisseau)*SUM(v.cargo) as sum_cargo
            FROM ".MyPDO::DB_FLAG."joueur_possede_vaisseau jpv
            JOIN ".MyPDO::DB_FLAG."vaisseau v ON jpv.id_vaisseau = v.id_vaisseau     
            WHERE jpv.id_joueur IN (
                SELECT DISTINCT id_joueur FROM `".MyPDO::DB_FLAG."joueur_dans_team` jdt 
                WHERE jdt.id_team IN (
                    SELECT DISTINCT id_team FROM ".MyPDO::DB_FLAG."groupe_alliance WHERE id_alliance=?
                )
             )
             GROUP BY id_vaisseau
            ORDER BY 6 desc, v.nom asc
        ";
        return $this->bdd->query($query, $id_alliance);
    }
    
    public function get_flotte_detailled($id_alliance){
        $query="SELECT  jpv.id_vaisseau, jpv.id_joueur, jpv.nb, v.nom as vaisseau,v.cargo, v.img, j.handle
            FROM ".MyPDO::DB_FLAG."joueur_possede_vaiss jpv
            JOIN ".MyPDO::DB_FLAG."vaisseau v ON jpv.id_vaisseau = v.id_vaisseau
            JOIN ".MyPDO::DB_FLAG."joueur j ON jpv.id_joueur=j.id_joueur
            
            WHERE jpv.id_joueur IN (
                SELECT DISTINCT id_joueur FROM `".MyPDO::DB_FLAG."joueur_dans_team` jdt 
                WHERE jdt.id_team IN (
                    SELECT DISTINCT id_team FROM ".MyPDO::DB_FLAG."groupe_alliance WHERE id_alliance=?
                )
             )
            ORDER BY v.cargo desc, v.id_constructeur, v.nom asc
        ";
        return $this->bdd->query($query, $id_alliance);
    }
    
}
?>