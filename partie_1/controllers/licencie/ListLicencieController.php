<?php
class ListLicencieController
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

        public function index() {
            $licencies = $this->licencieDAO->getAll();

            $contacts = $this->contactDAO->getAll();
            $arrayContacts = array();
            foreach ($contacts as $contact) {
                $arrayContacts[$contact->getIdContact()] = $contact->getNom()." ".$contact->getPrenom();
            }

            $categories = $this->categorieDAO->getAll();
            foreach ($categories as $category) {
                $arrayCategories[$category->getId()] = $category->getCodeRaccourci();
            }
            include('../../views/licencie/list_licencie.php');
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
$controller = new ListLicencieController($licencieDAO, $categorieDAO, $contactDAO);
$controller->index();