<?php

class AllianceGroupe {

    private $id;
    private $nom;
    private $logo;
    private $url;
    private $description;

    public function __construct($o = null) {
        if ($o) {
            $this->set_nom($o->nom);
            $this->set_logo($o->logo);
            $this->set_id($o->id_alliance);
            $this->set_description($o->description);
            $this->set_url($o->url);
        }
    }
    

    public function get_url() {
        return $this->url;
    }

    public function set_url($url) {
        $this->url = $url;
    }

    public function get_description() {
        return $this->description;
    }

    public function set_description($description) {
        $this->description = $description;
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

    public function get_logo() {
        return $this->logo;
    }

    public function set_logo($logo) {
        $this->logo = $logo;
    }
}

?>