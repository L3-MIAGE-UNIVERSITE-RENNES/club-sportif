<?php
    class Categorie {
        private $id;
        private $nom;
        private $code_raccourci;

        public function __construct($id, $nom, $code_raccourci) {
            if(is_int($id))
            {
                $this->id = $id;
            }
            $this->nom = $nom;
            $this->code_raccourci = $code_raccourci;
        }

        // Getters
        public function getId() { return $this->id; }
        public function getNom() { return $this->nom; }
        public function getCodeRaccourci() { return $this->code_raccourci; }

        // Setters
        public function setId($id) { $this->id = $id; }
        public function setNom($nom) { $this->nom = $nom; }
        public function setCodeRaccourci($code_raccourci) { $this->code_raccourci = $code_raccourci; }
    }

