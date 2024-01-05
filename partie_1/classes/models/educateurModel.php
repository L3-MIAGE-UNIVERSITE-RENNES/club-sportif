<?php
    class Educateur {
        private $id;
        private $numero_licence;
        private $email;
        private $mot_de_passe;
        private $est_administrateur;

        public function __construct($id, $numero_licence, $email, $mot_de_passe, $est_administrateur) {
            if(is_int($id))
            {
                $this->id = $id;
            }
            $this->numero_licence = $numero_licence;
            $this->email = $email;
            $this->mot_de_passe = $mot_de_passe;
            $this->est_administrateur = $est_administrateur;
        }

        // Getters
        public function getIdEducateur() { return $this->id; }
        public function getNumeroLicence() { return $this->numero_licence; }
        public function getEmail() { return $this->email; }
        public function getMotDePasse() { return $this->mot_de_passe; }
        public function getEstAdministrateur() { return $this->est_administrateur; }

        // Setters
        public function addEducateur($numero_licence, $email, $mot_de_passe, $est_administrateur){
            $this->numero_licence = $numero_licence;
            $this->email = $email;
            $this->mot_de_passe = $mot_de_passe;
            $this->est_administrateur = $est_administrateur;
        }
        public function setIdEducateur($id) { $this->id = $id; }
        public function setNumeroLicence($numero_licence) { $this->numero_licence = $numero_licence; }
        public function setEmail($email) { $this->email = $email; }
        public function setMotDePasse($mot_de_passe) { $this->mot_de_passe = $mot_de_passe; }
        public function setEstAdministrateur($est_administrateur) { $this->est_administrateur = $est_administrateur; }
    }


