<?php

class TeamManager {
    private $bdd;
    
    public function __construct(MyPDO $bdd = null) {
        if($bdd){
            $this->bdd = $bdd;
        }
        else{
            $this->bdd = new MyPDO();
        }
    }
    
    public function get_membre($id_team){
        $query="SELECT j.id_joueur, j.handle, j.img
                FROM ".MyPDO::DB_FLAG."joueur_dans_team jdt
                    JOIN ".MyPDO::DB_FLAG."joueur j ON jdt.id_joueur=j.id_joueur
                WHERE jdt.id_team=? "; 
        return $this->bdd->query($query,$id_team);
    }
    
    public function get_team($id_team){
        $query="SELECT id_team, nom, tag, url, nbJoueur, logo 
                FROM ".MyPDO::DB_FLAG."team
                WHERE id_team=? "; 
        return $this->bdd->query($query,$id_team);
    }
    
    public function get_all_team($limit = null){
        $query="SELECT id_team, nom, tag, url, nbJoueur, logo 
                FROM ".MyPDO::DB_FLAG."team
                order by nom "; 
        if(is_int($limit)){
            $query.=" LIMIT 0, $limit";
        }
        return $this->bdd->query($query);
    }
    
    public function set_team( Team $c){
        $query="INSERT INTO ".MyPDO::DB_FLAG."team (nom, logo, tag, url, nbJoueur)
                VALUES(?,?,?,?,?)";
        $this->bdd->query($query,$c->get_nom(), $c->get_logo(), $c->get_tag(), $c->get_url(), $c->get_nbJoueur());
        return $this->bdd->lastInsertId();
    }
    
    public function set_orientation($id_team,$orientation){
        if (!is_array($orientation)) return false;
        $query = "INSERT INTO ".MyPDO::DB_FLAG."orientation_team (id_orientation, id_team)
                 VALUES(?,?)";
        foreach ($orientation as $id_orientation) {
            $this->bdd->query($query,$id_orientation,$id_team);
        }
    }
    
    public function get_orientation($id_team){
        $query = "SELECT nom, logo 
            FROM ".MyPDO::DB_FLAG."orientation o
            JOIN ".MyPDO::DB_FLAG."orientation_team ot
            ON o.id_orientation = ot.id_orientation
            WHERE id_team=?";
        return $this->bdd->query($query,$id_team);
    }
    
    public function get_flotte_detailled($id_team){
        
            $query="SELECT j.handle, v.nom as vaisseau, v.img, v.cargo, jpv.nb, j.handle as joueur
            FROM ".MyPDO::DB_FLAG."joueur_dans_team jdt 
            JOIN ".MyPDO::DB_FLAG."joueur_possede_vaiss jpv ON jdt.id_joueur= jpv.id_joueur
            JOIN ".MyPDO::DB_FLAG."vaisseau v ON jpv.id_vaisseau = v.id_vaisseau
            JOIN ".MyPDO::DB_FLAG."joueur j on jdt.id_joueur = j.id_joueur
            WHERE jdt.id_team = ? 
            ORDER BY v.cargo desc, v.id_constructeur, v.nom asc
            ";
        
        return $this->bdd->query($query,$id_team);
    }
    
    public function get_flotte($id_team){
        $query="SELECT v.nom as vaisseau, v.img, SUM(v.cargo) as cargo, count(v.nom)*SUM(v.cargo) as sum_cargo, count(v.nom) as nb
            FROM ".MyPDO::DB_FLAG."joueur_dans_team jdt 
            JOIN ".MyPDO::DB_FLAG."joueur_possede_vaisseau jpv ON jdt.id_joueur= jpv.id_joueur
            JOIN ".MyPDO::DB_FLAG."vaisseau v ON jpv.id_vaisseau = v.id_vaisseau
            WHERE jdt.id_team = ? 
            GROUP BY 1
            ORDER BY 4 desc, v.nom asc";
        
        return $this->bdd->query($query,$id_team);
    }
    
    public function get_locker($id_team){
        $query = "SELECT j.id_joueur, j.handle 
            FROM ".MyPDO::DB_FLAG."joueur j
            JOIN ".MyPDO::DB_FLAG."joueur_dans_team jdt
            ON j.id_joueur = jdt.id_joueur AND locker !=''
            WHERE id_team=?";
        return $this->bdd->query($query,$id_team);
    }
}
?>