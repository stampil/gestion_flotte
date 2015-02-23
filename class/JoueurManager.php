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
        $ret =  $this->bdd->query($query,$id);
        return $ret[0];
    }
    
    public function delete_joueur($id){
        $info_joueur = $this->get_joueur($id);
        
        $query="DELETE FROM ".MyPDO::DB_FLAG."joueur_dans_team
                WHERE id_joueur=?";
        $this->bdd->query($query,$id);
        
        $query="DELETE FROM ".MyPDO::DB_FLAG."orientation_joueur
                WHERE id_joueur=?";
        $this->bdd->query($query,$id);
        
        $query="DELETE FROM ".MyPDO::DB_FLAG."joueur_possede_vaisseau
                WHERE id_joueur=?";
        $this->bdd->query($query,$id);
    
        $query="DELETE FROM ".MyPDO::DB_FLAG."joueur
                WHERE id_joueur=?";
        $this->bdd->query($query,$id);
        
        unlink("upload/joueur/".$info_joueur->img); 
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
        $query = "SELECT t.id_team, t.nom, t.tag, t.logo, t.url, t.nbJoueur, t.mdp, jdt.principal, jdt.locker 
            FROM ".MyPDO::DB_FLAG."team t
            JOIN ".MyPDO::DB_FLAG."joueur_dans_team jdt
            ON t.id_team = jdt.id_team
            WHERE id_joueur=? AND principal=1";
        $ret = $this->bdd->query($query,$id_joueur);
        return $ret;
    }
    
        public function get_all_team($id_joueur){
        $query = "SELECT t.id_team, t.nom, t.tag, t.logo, t.url, t.nbJoueur, t.mdp, jdt.principal, jdt.locker 
            FROM ".MyPDO::DB_FLAG."team t
            JOIN ".MyPDO::DB_FLAG."joueur_dans_team jdt
            ON t.id_team = jdt.id_team
            WHERE id_joueur=? order by principal desc";
        return $this->bdd->query($query,$id_joueur);
    }
       
    
    public function set_vaisseau_global($id_joueur, $nb_vaisseau){
        
        $query = "DELETE FROM ".MyPDO::DB_FLAG."joueur_possede_vaisseau
            WHERE id_joueur=?";
        $this->bdd->query($query,$id_joueur);
        
        if (!is_array($nb_vaisseau)) return false;
        $query="INSERT INTO ".MyPDO::DB_FLAG."joueur_possede_vaisseau (id_vaisseau, id_joueur, nom)
                 VALUES(?,?,?)";
        foreach($nb_vaisseau as $id_vaisseau => $nb){
            for ($i=0; $i<$nb; $i++){
                $this->bdd->query($query,$id_vaisseau,$id_joueur,uniqid("ship_"));
            }
        }
    }
    
    public function set_vaisseau($id_joueur, $vaisseau){
        $query = "INSERT INTO ".MyPDO::DB_FLAG."joueur_possede_vaisseau (nom, LTI, id_joueur, id_vaisseau) VALUES(?,?,?,?)";
        $this->bdd->query($query,$vaisseau->nom,$vaisseau->LTI, $id_joueur,$vaisseau->id_vaisseau);    
    }
    
    public function set_sortie($id_sortie, $id_joueur, $id_jv, $role,  $comment){
        $query = "INSERT INTO ".MyPDO::DB_FLAG."joueur_sortie (id_sortie, id_joueur,  id_jv, role, commentaire) VALUES(?,?,?,?,?)"
                . "ON DUPLICATE KEY UPDATE id_jv=?, role=?, commentaire=?";
        $this->bdd->query($query, $id_sortie, $id_joueur, $id_jv, $role,  $comment, $id_jv, $role,  $comment);
    }
    
    public function update_vaisseau($id_joueur, $vaisseau){
        $query = "UPDATE ".MyPDO::DB_FLAG."joueur_possede_vaisseau "
                . "SET nom=?, LTI=?, cargo=?, autonomie=?, coutReparation=?, date_dispo=? WHERE id_joueur=? AND id_jv=?";

        $this->bdd->query($query,$vaisseau->nom,$vaisseau->LTI, $vaisseau->cargo, $vaisseau->autonomie,
                $vaisseau->coutReparation, ($vaisseau->date_dispo?$vaisseau->date_dispo:null), $id_joueur, $vaisseau->id_vaisseau);    
    }
    

    
    public function get_vaisseau($id_joueur){
        $query = "SELECT v.id_vaisseau, v.nom as type, v.img, v.focus, v.cargo, v.autonomie,
            v.coutReparation, v.nbEquipage, v.id_constructeur,
            jpv.id_jv, jpv.nom, jpv.LTI, jpv.date_dispo, jpv.cargo as modifCargo,
            jpv.autonomie as modifAutonomie, jpv.coutReparation as modifCoutReparation,
            c.nom as constructeur, c.logo as constructeurLogo 
            FROM ".MyPDO::DB_FLAG."vaisseau v
            JOIN ".MyPDO::DB_FLAG."joueur_possede_vaisseau jpv
            ON v.id_vaisseau = jpv.id_vaisseau
            JOIN ".MyPDO::DB_FLAG."constructeur c
            ON v.id_constructeur= c.id_constructeur
            WHERE id_joueur=?";
        return $this->bdd->query($query,$id_joueur);
    }
    
    public function delete_vaisseau($id_joueur,$id_jv){
        
        $query = "DELETE FROM ".MyPDO::DB_FLAG."joueur_possede_vaisseau WHERE id_joueur=? AND id_jv=?";
        $this->bdd->query($query,$id_joueur,$id_jv);
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
    
    public function is_email_in_bdd($email){
        $query = "SELECT id_joueur
            FROM ".MyPDO::DB_FLAG."joueur
            WHERE email=?    ";
        $ret = $this->bdd->query($query,$email);
        return ( isset($ret[0]->id_joueur) && $ret[0]->id_joueur>0 );
    }
    
    public function change_mdp($mdp,$email){
        $query = "UPDATE ".MyPDO::DB_FLAG."joueur
            SET mdp=?
            WHERE email=?    ";
        $this->bdd->query($query,$mdp,$email);
    }
}
?>