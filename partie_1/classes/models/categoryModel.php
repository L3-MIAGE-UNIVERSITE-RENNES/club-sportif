<?php
    class Category {
        private $id_categorie;
        private $nom;
        private $code_raccourci;

        public function __construct($id_categorie, $nom, $code_raccourci) {
            $this->id_categorie = $id_categorie;
            $this->nom = $nom;
            $this->code_raccourci = $code_raccourci;
        }

        // Getters
        public function getIdCategorie() { return $this->id_categorie; }
        public function getNom() { return $this->nom; }
        public function getCodeRaccourci() { return $this->code_raccourci; }

        // Setters
        public function setIdCategorie($id_categorie) { $this->id_categorie = $id_categorie; }
        public function setNom($nom) { $this->nom = $nom; }
        public function setCodeRaccourci($code_raccourci) { $this->code_raccourci = $code_raccourci; }
    }

