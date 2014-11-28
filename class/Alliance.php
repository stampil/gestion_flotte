<?php

class Alliance {

    private $id_alliance;
    private $nom;
    private $charte;


    public function __construct($o = null) {
        if ($o) {
            $this->set_id($o->id_alliance);
            $this->set_nom($o->nom);
            $this->set_charte($o->charte);
        }
    }
    

    public function get_id() {
        return $this->id;
    }

    public function set_id($id) {
        $this->id = $id;
    }
    
    public function get_nom() {
        return $this->nom;
    }

    public function set_nom($nom) {
        $this->nom = $nom;
    }

    public function get_charte() {
        return $this->charte;
    }

    public function set_charte($charte) {
        $this->charte = $charte;
    }
}

?>