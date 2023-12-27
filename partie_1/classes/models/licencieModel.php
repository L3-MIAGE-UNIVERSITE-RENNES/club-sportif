<?php

class Licencie {

    public $numLicence;
    public $nom;
    public $prenom;
    public $contact;

    public function __construct($numLicence, $nom, $prenom, $contact) {
        $this->numLicence = $numLicence;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->contact = $contact;
    }

    public function getNumLicence() {
        return $this->numLicence;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getContact() {
        return $this->contact;
    }

    public function setNumLicence($numLicence) {
        $this->numLicence = $numLicence;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setContact($contact) {
        $this->contact = $contact;
    }
}
