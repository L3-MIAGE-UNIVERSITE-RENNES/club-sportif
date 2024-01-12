<?php
    class Licencie
    {
        private $numero_licence;
        private $nom;
        private $prenom;
        private $id_contact;
        private $id_categorie;

        public function __construct($numero_licence, $nom, $prenom, $id_contact, $id_categorie) {
            if(is_int($numero_licence))
            {
                $this->numero_licence = $numero_licence;
            }
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->id_contact = $id_contact;
            $this->id_categorie = $id_categorie;
        }

        // Getters
        public function getNumeroLicence() { return $this->numero_licence; }
        public function getNom() { return $this->nom; }
        public function getPrenom() { return $this->prenom; }
        public function getIdContact() { return $this->id_contact; }
        public function getIdCategorie() { return $this->id_categorie; }

        // Setters
        public function setNumeroLicence($numero_licence) { $this->numero_licence = $numero_licence; }
        public function setNom($nom) { $this->nom = $nom; }
        public function setPrenom($prenom) { $this->prenom = $prenom; }
        public function setIdContact($id_contact) { $this->id_contact = $id_contact; }
        public function setIdCategorie($id_categorie) { $this->id_categorie = $id_categorie; }
    }

