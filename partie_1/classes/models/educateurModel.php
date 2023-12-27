<?php

class Educateur {

    private $email;
    private $motDePasse;

    public function __construct($email, $motDePasse) {
        $this->email = $email;
        $this->motDePasse = $motDePasse;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
    }
}
