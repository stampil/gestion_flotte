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
        $query="SELECT s.id_sortie, s.titre, s.detail, s.debut, s.fin, j.id_joueur, j.handle, t.nom, t.logo as logoTeam
                FROM ".MyPDO::DB_FLAG."sortie s
                JOIN ".MyPDO::DB_FLAG."joueur j ON s.id_organisateur=j.id_joueur
                JOIN ".MyPDO::DB_FLAG."joueur_dans_team jdt ON jdt.id_joueur=j.id_joueur and principal=1
                JOIN ".MyPDO::DB_FLAG."team t ON jdt.id_team=t.id_team
                WHERE debut between ? and ? order by debut"; 
        return $this->bdd->query($query,$date_deb,$date_fin);
    }
    
    public function get_sortie($id_sortie){
        $query="SELECT s.id_sortie, s.titre, s.detail, s.debut, s.fin, j.id_joueur, j.handle, t.nom, t.logo as logoTeam
                FROM ".MyPDO::DB_FLAG."sortie s
                JOIN ".MyPDO::DB_FLAG."joueur j ON s.id_organisateur=j.id_joueur
                JOIN ".MyPDO::DB_FLAG."joueur_dans_team jdt ON jdt.id_joueur=j.id_joueur and principal=1
                JOIN ".MyPDO::DB_FLAG."team t ON jdt.id_team=t.id_team
                WHERE id_sortie= ? "; 
        return $this->bdd->query($query,$id_sortie);
    }
    
}
