<?php

class Category {

    private $nom;
    private $codeCategory;

    public function __construct($nom, $codeCategory) {
        $this->nom = $nom;
        $this->codeCategory = $codeCategory;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getCodeCategory() {
        return $this->codeCategory;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setCodeCategory($codeCategory) {
        $this->codeCategory = $codeCategory;
    }
}
