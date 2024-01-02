<?php
    class Contact {
        private $id;
        private $nom;
        private $prenom;
        private $email;
        private $numero_tel;

        public function __construct($id, $nom, $prenom, $email, $numero_tel) {
            $this->id = $id;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->email = $email;
            $this->numero_tel = $numero_tel;
        }

        // Getters
        public function getIdContact() { return $this->id; }
        public function getNom() { return $this->nom; }
        public function getPrenom() { return $this->prenom; }
        public function getEmail() { return $this->email; }
        public function getNumeroTel() { return $this->numero_tel; }

        // Setters
        public function setId($id) { $this->id = $id; }
        public function setNom($nom) { $this->nom = $nom; }
        public function setPrenom($prenom) { $this->prenom = $prenom; }
        public function setEmail($email) { $this->email = $email; }
        public function setNumeroTel($numero_tel) { $this->numero_tel = $numero_tel; }
    }

