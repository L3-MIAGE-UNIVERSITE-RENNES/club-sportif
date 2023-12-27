<?php
    class Contact {
        private $id_contact;
        private $nom;
        private $prenom;
        private $email;
        private $numero_tel;

        public function __construct($id_contact, $nom, $prenom, $email, $numero_tel) {
            $this->id_contact = $id_contact;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->email = $email;
            $this->numero_tel = $numero_tel;
        }

        // Getters
        public function getIdContact() { return $this->id_contact; }
        public function getNom() { return $this->nom; }
        public function getPrenom() { return $this->prenom; }
        public function getEmail() { return $this->email; }
        public function getNumeroTel() { return $this->numero_tel; }

        // Setters
        public function setIdContact($id_contact) { $this->id_contact = $id_contact; }
        public function setNom($nom) { $this->nom = $nom; }
        public function setPrenom($prenom) { $this->prenom = $prenom; }
        public function setEmail($email) { $this->email = $email; }
        public function setNumeroTel($numero_tel) { $this->numero_tel = $numero_tel; }
    }

