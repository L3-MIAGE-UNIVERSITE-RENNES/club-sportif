<?php
    class ViewLicencieController
    {
        private $licencieDAO;
        private $categorieDAO;
        private $contactDAO;

        public function __construct(LicencieDAO $licencieDAO,
                                    CategorieDAO $categorieDAO,
                                    ContactDAO $contactDAO) {
            $this->licencieDAO = $licencieDAO;
            $this->categorieDAO = $categorieDAO;
            $this->contactDAO = $contactDAO;
        }

        public function viewCategorie($id) {
            $licencie = $this->licencieDAO->getById($id);

            $contacts = $this->contactDAO->getAll();
            $arrayContacts = array();
            foreach ($contacts as $contact) {
                $arrayContacts[$contact->getIdContact()] = $contact->getNom()." ".$contact->getPrenom();
            }

            $categories = $this->categorieDAO->getAll();
            foreach ($categories as $category) {
                $arrayCategories[$category->getId()] = $category->getCodeRaccourci();
            }
            // Inclure la vue pour afficher les détails
            include('../../views/licencie/view_licencie.php');
        }
    }

    require_once("../../configs/config.php");
    require_once("../../classes/dao/Connexion.php");
    require_once("../../classes/models/licencieModel.php");
    require_once("../../classes/dao/licencieDAO.php");
    require_once("../../classes/models/categorieModel.php");
    require_once("../../classes/dao/categorieDAO.php");
    require_once("../../classes/models/contactModel.php");
    require_once("../../classes/dao/ContactDAO.php");

    $licencieDAO = new LicencieDAO(new Connexion());
    $contactDAO = new ContactDAO(new Connexion());
    $categorieDAO  = new CategorieDAO(new Connexion());
    $controller = new ViewLicencieController($licencieDAO, $categorieDAO, $contactDAO);
    $controller->viewCategorie($_GET['id']);