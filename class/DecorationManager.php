<?php

class DecorationManager {
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
    
    
    public function get_all_medaille($limit = null){
        $query="SELECT id, nom, description, img, remplace, creato
                FROM ".MyPDO::DB_FLAG."medaille
                "; 
        if(is_int($limit)){
            $query.=" LIMIT 0, $limit";
        }
        return $this->bdd->query($query);
    }
	
	public function get_all_ruban($limit = null){
        $query="SELECT id, nom, description, img, remplace, creato
                FROM ".MyPDO::DB_FLAG."ruban
                "; 
        if(is_int($limit)){
            $query.=" LIMIT 0, $limit";
        }
        return $this->bdd->query($query);
    }
	
	public function get_all_insigne($limit = null){
        $query="SELECT id, nom, description, img, remplace, creato
                FROM ".MyPDO::DB_FLAG."insigne
                "; 
        if(is_int($limit)){
            $query.=" LIMIT 0, $limit";
        }
        return $this->bdd->query($query);
    }
    
    public function get_medaille($id){
        $query="SELECT id, nom, description, img, remplace, creato
                FROM ".MyPDO::DB_FLAG."medaille
                WHERE id=? "; 
        $ret =  $this->bdd->query($query,$id);
        return $ret[0];
    }
	
	public function get_ruban($id){
        $query="SELECT id, nom, description, img, remplace, creato
                FROM ".MyPDO::DB_FLAG."ruban
                WHERE id=? "; 
        $ret =  $this->bdd->query($query,$id);
        return $ret[0];
    }
	
	public function get_insigne($id){
        $query="SELECT id, nom, description, img, remplace, creato
                FROM ".MyPDO::DB_FLAG."insigne
                WHERE id=? "; 
        $ret =  $this->bdd->query($query,$id);
        return $ret[0];
    }
	
	public function give_ruban($id_joueurs,$id_rubans, $id_groupes){
				global $USER;
                foreach($id_joueurs as $id_joueur){
                    foreach($id_rubans as $id_ruban){
                        foreach($id_groupes as $id_groupe){
        $query="INSERT INTO
                ".MyPDO::DB_FLAG."joueur_ruban (id_joueur,id_ruban,affiche,id_attributeur, groupe, creato)
                VALUES(?,?,1,".$USER->get_id().",?,NOW()) "; 
        $ret =  $this->bdd->query($query,$id_joueur,$id_ruban, $id_groupe);
                        }
                    }
                }
        return $ret[0];
    }
	
	public function give_medaille($id_joueurs,$id_medailles, $id_groupes){
				global $USER;
                foreach($id_joueurs as $id_joueur){
                    foreach($id_medailles as $id_medaille){
                        foreach($id_groupes as $id_groupe){
        $query="INSERT INTO
                ".MyPDO::DB_FLAG."joueur_medaille (id_joueur,id_medaille,affiche,id_attributeur, groupe, creato)
                VALUES(?,?,1,".$USER->get_id().",?,NOW()) "; 
        $ret =  $this->bdd->query($query,$id_joueur,$id_medaille, $id_groupe);
                        }
                    }
                }
        return $ret[0];
    }

	public function give_insigne($id_joueurs,$id_insignes, $id_groupes){
				global $USER;
                
                foreach($id_joueurs as $id_joueur){
                    foreach($id_insignes as $id_insigne){
                        foreach($id_groupes as $id_groupe){
                       $query="INSERT INTO
                        ".MyPDO::DB_FLAG."joueur_insigne (id_joueur,id_insigne,affiche,id_attributeur, groupe, creato)
                        VALUES(?,?,1,".$USER->get_id().",?,NOW()) "; 
                $ret =  $this->bdd->query($query,$id_joueur,$id_insigne, $id_groupe); 
                        }
                    }
                }
        
        return $ret[0];
    }    
    
    public function remove_insigne($id_joueur,$id_insigne, $id_groupe){
        $query="DELETE FROM
                        ".MyPDO::DB_FLAG."joueur_insigne WHERE id_joueur=? AND id_insigne=? AND groupe=?
                        "; 
                $this->bdd->query($query,$id_joueur,$id_insigne, $id_groupe); 
    }  
    
    public function remove_medaille($id_joueur,$id_medaille, $id_groupe){
        $query="DELETE FROM
                        ".MyPDO::DB_FLAG."joueur_medaille WHERE id_joueur=? AND id_medaille=? AND groupe=?
                        "; 
                $this->bdd->query($query,$id_joueur,$id_medaille, $id_groupe);  
    } 
    public function remove_ruban($id_joueur,$id_ruban, $id_groupe){

                       $query="DELETE FROM
                        ".MyPDO::DB_FLAG."joueur_ruban WHERE id_joueur=? AND id_ruban=? AND groupe=?
                        "; 
                $this->bdd->query($query,$id_joueur,$id_ruban, $id_groupe); 

    }    
    
    
    public function delete_medaille($id){
        $info_medaille = $this->get_medaille($id);
        
        $query="DELETE FROM ".MyPDO::DB_FLAG."joueur_medaille
                WHERE id_medaille=?";
        $this->bdd->query($query,$id);
   
        unlink("upload/medaille/".$info_medaille->img); 
    }
	
	public function delete_ruban($id){
        $info_ruban = $this->get_ruban($id);
        
        $query="DELETE FROM ".MyPDO::DB_FLAG."joueur_ruban
                WHERE id_ruban=?";
        $this->bdd->query($query,$id);
   
        unlink("upload/ruban/".$info_ruban->img); 
    }
	
	public function delete_insigne($id){
        $info_insigne = $this->get_insigne($id);
        
        $query="DELETE FROM ".MyPDO::DB_FLAG."joueur_insigne
                WHERE id_insigne=?";
        $this->bdd->query($query,$id);
   
        unlink("upload/insigne/".$info_ruban->img); 
    }	
    
    public function set_medaille( Decoration $d){
        $query="INSERT INTO ".MyPDO::DB_FLAG."medaille (nom, description, img, remplace, creato)
                VALUES(?,?,?,?,NOW())";
        $this->bdd->query($query,$d->get_nom(), $d->get_description(), $d->get_img(), $d->get_remplace());
        return  $this->bdd->lastInsertId();
    }

    public function set_ruban( Decoration $d){
        $query="INSERT INTO ".MyPDO::DB_FLAG."ruban (nom, description,img, remplace, creato)
                VALUES(?,?,?,?,NOW())";
        $this->bdd->query($query,$d->get_nom(), $d->get_description(), $d->get_img(), $d->get_remplace());
        return  $this->bdd->lastInsertId();
    }

    public function set_insigne( Decoration $d){
        $query="INSERT INTO ".MyPDO::DB_FLAG."insigne (nom, description,img, remplace, creato)
                VALUES(?,?,?,?,NOW())";
        $this->bdd->query($query,$d->get_nom(), $d->get_description(), $d->get_img(), $d->get_remplace());
        return  $this->bdd->lastInsertId();
    }	
    
    public function update_medaille( Decoration $d){
        $query="UPDATE ".MyPDO::DB_FLAG."medaille SET  nom=?, description=?, img=?, remplace=? WHERE id=?";
        $this->bdd->query($query,$d->get_nom(), $d->get_description(),$d->get_img(), $d->get_remplace(), $d->get_id());
    }
	
    public function update_ruban( Decoration $d){
        $query="UPDATE ".MyPDO::DB_FLAG."ruban SET  nom=?, description=?, img=?, remplace=? WHERE id=?";
        $this->bdd->query($query,$d->get_nom(), $d->get_description(),$d->get_img(), $d->get_remplace(), $d->get_id());
    }	
	
    public function update_insigne( Decoration $d){
        $query="UPDATE ".MyPDO::DB_FLAG."insigne SET  nom=?, description=?, img=?, remplace=? WHERE id=?";
        $this->bdd->query($query,$d->get_nom(), $d->get_description(),$d->get_img(), $d->get_remplace(), $d->get_id());
    }	
    
    
}
?>