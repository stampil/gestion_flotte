<?php

class SortieManager {
    private $bdd;
    
    public function __construct(MyPDO $bdd = null) {
        if($bdd){
            $this->bdd = $bdd;
        }
        else{
            $this->bdd = new MyPDO();
        }
    }
    
    public function get_range_sortie($date_deb,$date_fin){
        $query="SELECT s.id_sortie, s.titre, s.detail, s.debut, s.fin, s.id_teamspeak, s.max_joueur, s.visibilite, ts.url as url_ts
                FROM ".MyPDO::DB_FLAG."sortie s
                JOIN ".MyPDO::DB_FLAG."teamspeak ts ON ts.id_teamspeak=s.id_teamspeak
                WHERE debut between ? and ? order by debut"; 
        return $this->bdd->query($query,$date_deb,$date_fin);
    }
    
    public function get_sortie($id_sortie){
        $query="SELECT s.id_sortie, s.titre, s.detail, s.debut, s.fin, s.id_teamspeak, s.max_joueur, s.visibilite, s.creato, s.modifo, j.id_joueur, j.handle, t.nom, t.logo as logoTeam
                FROM ".MyPDO::DB_FLAG."sortie s
                JOIN ".MyPDO::DB_FLAG."joueur j ON s.id_organisateur=j.id_joueur
                LEFT JOIN ".MyPDO::DB_FLAG."joueur_dans_team jdt ON jdt.id_joueur=j.id_joueur and principal=1
                LEFT JOIN ".MyPDO::DB_FLAG."team t ON jdt.id_team=t.id_team
                WHERE id_sortie= ? "; 
        $ret =  $this->bdd->query($query,$id_sortie);
        return $ret[0];
    }
    
    public function set_sortie( Sortie $s){
        $query ="INSERT INTO ".MyPDO::DB_FLAG."sortie (id_organisateur,id_teamspeak, titre, detail, debut, fin, max_joueur, visibilite, creato) VALUE(?,?,?,?,?,?,?,?,now())";
        $this->bdd->query($query,$s->get_id_organisateur(), $s->get_id_teamspeak(), $s->get_titre(), $s->get_detail(), $s->get_debut(), $s->get_fin(),$s->get_max_joueur(), $s->get_visibilite());
    
        return $this->bdd->lastInsertId();
    }
    
    public function update_sortie( Sortie $s){
        $query ="UPDATE ".MyPDO::DB_FLAG."sortie set id_teamspeak=?, titre=?, detail=?, debut=?, fin=?,max_joueur=?, visibilite=?, modifo=now() WHERE id_sortie=?";
        $this->bdd->query($query,$s->get_id_teamspeak(), $s->get_titre(), $s->get_detail(), $s->get_debut(), $s->get_fin(), $s->get_max_joueur(), $s->get_visibilite(), $s->get_id());
    }
    
    public function delete_sortie( $id_sortie){
        $query ="DELETE FROM ".MyPDO::DB_FLAG."sortie  WHERE id_sortie=?";
        $this->bdd->query($query,  $id_sortie);
    }
    
    public function get_participant($id_sortie){
        $query="SELECT js.id_joueur, js.id_jv, js.role, jpv.nom, v.categorie, js.commentaire, jpv.id_vaisseau  FROM `".MyPDO::DB_FLAG."joueur_sortie` js
        LEFT JOIN ".MyPDO::DB_FLAG."joueur_possede_vaisseau jpv ON jpv.id_jv = js.id_jv
        LEFT JOIN ".MyPDO::DB_FLAG."vaisseau v ON jpv.id_vaisseau = v.id_vaisseau
        WHERE id_sortie=? order by v.categorie"; 
        return $this->bdd->query($query,$id_sortie);
    }
    
    public function get_organisateur($id_sortie){
               $query="SELECT id_organisateur
                FROM `".MyPDO::DB_FLAG."sortie` 
                WHERE id_sortie=?"; 
        $ret = $this->bdd->query($query,$id_sortie);
        return @$ret[0]->id_organisateur;
    }
    
    public function set_formation($id_joueur,$id_sortie,$x, $y,$num,$couleur,$is_vip){
        $query ="INSERT INTO ".MyPDO::DB_FLAG."joueur_formation (id_joueur,id_sortie, x, y, num, couleur, is_vip) VALUE(?,?,?,?,?,?,?) ON DUPLICATE KEY UPDATE x=?, y=?, num=?, couleur=?, is_vip=?";
        $this->bdd->query($query,$id_joueur,$id_sortie,$x,$y,$num,$couleur,$is_vip, $x,$y,$num,$couleur,$is_vip);
        return $this->bdd->lastInsertId();
    }
    
    public function get_formation($id_joueur,$id_sortie){
        $query ="SELECT x,y,num,couleur,is_vip FROM ".MyPDO::DB_FLAG."joueur_formation
                 WHERE  id_joueur=? AND id_sortie=?";
        $ret = $this->bdd->query($query,$id_joueur,$id_sortie);
        return @$ret[0];
    }
    
}
