<?php

class JoueurManager {
    private $bdd;
    private $crypt;
    
    public function __construct(MyPDO $bdd = null) {
        if($bdd){
            $this->bdd = $bdd;
        }
        else{
            $this->bdd = new MyPDO();
        }
        $this->crypt= new Crypt();
    }
    
    public function get_all_joueur($limit = null){
        $query="SELECT j.id_joueur, j.handle, j.img , t.tag
                FROM ".MyPDO::DB_FLAG."joueur j
                LEFT JOIN ".MyPDO::DB_FLAG."joueur_dans_team jdt    
                ON j.id_joueur= jdt.id_joueur AND jdt.principal=1
                LEFT JOIN ".MyPDO::DB_FLAG."team t  
                ON jdt.id_team = t.id_team    
                order by id_joueur desc "; 
        if(is_int($limit)){
            $query.=" LIMIT 0, $limit";
        }
        return $this->bdd->query($query);
    }
    
    public function get_joueur($id){
        $query="SELECT id_joueur, handle, img, mdp, email, admin, creato, lastco 
                FROM ".MyPDO::DB_FLAG."joueur
                WHERE id_joueur=? "; 
        return $this->bdd->query($query,$id);
    }
    
    public function delete_joueur($id){
        $info_joueur = $this->get_joueur($id);
        
        $query="DELETE FROM ".MyPDO::DB_FLAG."joueur_dans_team
                WHERE id_joueur=?";
        $this->bdd->query($query,$id);
        
        $query="DELETE FROM ".MyPDO::DB_FLAG."orientation_joueur
                WHERE id_joueur=?";
        $this->bdd->query($query,$id);
        
        $query="DELETE FROM ".MyPDO::DB_FLAG."joueur_possede_vaiss
                WHERE id_joueur=?";
        $this->bdd->query($query,$id);
    
        $query="DELETE FROM ".MyPDO::DB_FLAG."joueur
                WHERE id_joueur=?";
        $this->bdd->query($query,$id);
        
        unlink("upload/joueur/".$info_joueur[0]->img); 
    }
    
    public function set_joueur( Joueur $j){
        $query="INSERT INTO ".MyPDO::DB_FLAG."joueur (handle, img, email, admin, mdp, creato, lastco)
                VALUES(?,?,?,?,?,NOW(),NOW())";
        $this->bdd->query($query,$j->get_handle(), $j->get_img(), $j->get_email(), $j->get_admin(), $j->get_mdp());
        return  $this->bdd->lastInsertId();
    }
    
    public function update_joueur( Joueur $j){
        $query="UPDATE ".MyPDO::DB_FLAG."joueur SET  img=?, email=?, mdp=? WHERE id_joueur=?";
        $this->bdd->query($query,$j->get_img(), $j->get_email(),$j->get_mdp(), $j->get_id());
    }
    
    public function identifie_joueur($email, $mdp){
        $query = "SELECT id_joueur
            FROM ".MyPDO::DB_FLAG."joueur
            WHERE email=? and mdp=?";
        $joueur = $this->bdd->query($query,$email,$mdp);
        if(count($joueur)){
            return $this->get_joueur($joueur[0]->id_joueur);
        }
        else{
            return null;
        }
        
    }
    
    public function set_orientation($id_joueur,$orientation){
        
        $query = "DELETE FROM ".MyPDO::DB_FLAG."orientation_joueur
            WHERE id_joueur=?";
        $this->bdd->query($query,$id_joueur);
        
        if (!is_array($orientation)) return false;
        
        $query = "INSERT INTO ".MyPDO::DB_FLAG."orientation_joueur (id_orientation, id_joueur)
                 VALUES(?,?)";
        foreach ($orientation as $id_orientation) {
            $this->bdd->query($query,$id_orientation,$id_joueur);
        }
    }
    
    public function get_orientation($id_joueur){
        $query = "SELECT o.id_orientation, nom, logo 
            FROM ".MyPDO::DB_FLAG."orientation o
            JOIN ".MyPDO::DB_FLAG."orientation_joueur oj
            ON o.id_orientation = oj.id_orientation
            WHERE id_joueur=?";
        return $this->bdd->query($query,$id_joueur);
    }
    
    public function set_team($id_joueur,$team, $teamS){
        $query = "DELETE FROM ".MyPDO::DB_FLAG."joueur_dans_team
            WHERE id_joueur=?";
        $this->bdd->query($query,$id_joueur);

        $query = "INSERT INTO ".MyPDO::DB_FLAG."joueur_dans_team (id_team, id_joueur,principal)
                 VALUES(?,?,?)";
        foreach ((array)$team as $id_team) {
            if($id_team) $this->bdd->query($query,$id_team,$id_joueur,1);
        }
        foreach ((array)$teamS as $id_team) {
            if($id_team) $this->bdd->query($query,$id_team,$id_joueur,0);
        }
    }
    
    public function get_team($id_joueur){
        $query = "SELECT t.id_team, t.nom, t.tag, t.logo, t.url, jdt.principal, jdt.locker 
            FROM ".MyPDO::DB_FLAG."team t
            JOIN ".MyPDO::DB_FLAG."joueur_dans_team jdt
            ON t.id_team = jdt.id_team
            WHERE id_joueur=? order by principal desc";
        return $this->bdd->query($query,$id_joueur);
    }
    
    
    public function set_vaisseau($id_joueur,$nb_vaisseau){
        
        $query = "DELETE FROM ".MyPDO::DB_FLAG."joueur_possede_vaiss
            WHERE id_joueur=?";
        $this->bdd->query($query,$id_joueur);
        
        if (!is_array($nb_vaisseau)) return false;
        $query="INSERT INTO ".MyPDO::DB_FLAG."joueur_possede_vaiss (id_vaisseau, id_joueur, nb)
                 VALUES(?,?,?)";
        foreach($nb_vaisseau as $id_vaisseau => $nb){
            if($nb>0){
                $this->bdd->query($query,$id_vaisseau,$id_joueur,$nb);
            }
        }
    }
    
    public function get_vaisseau($id_joueur){
        $query = "SELECT v.id_vaisseau, v.nom, v.img, v.focus, v.cargo, v.autonomie, v.coutReparation, v.nbEquipage, v.id_constructeur, jpv.nb, jpv.date_dispo, c.nom as constructeur, c.logo as constructeurLogo 
            FROM ".MyPDO::DB_FLAG."vaisseau v
            JOIN ".MyPDO::DB_FLAG."joueur_possede_vaiss jpv
            ON v.id_vaisseau = jpv.id_vaisseau
            JOIN ".MyPDO::DB_FLAG."constructeur c
            ON v.id_constructeur= c.id_constructeur
            WHERE id_joueur=?";
        return $this->bdd->query($query,$id_joueur);
    }
    
    public function get_groupe_alliance($id_joueur){
        $query = "SELECT DISTINCT ag.id_alliance, ag.nom, ag.logo, ag.url, ag.description 
            FROM ".MyPDO::DB_FLAG."alliance_groupe ag
            JOIN ".MyPDO::DB_FLAG."groupe_alliance ga
            ON ga.id_alliance = ag.id_alliance
            WHERE id_team IN
            (
                SELECT id_team FROM ".MyPDO::DB_FLAG."joueur_dans_team WHERE id_joueur=?
                )";
        return $this->bdd->query($query,$id_joueur);
    }
}
?>