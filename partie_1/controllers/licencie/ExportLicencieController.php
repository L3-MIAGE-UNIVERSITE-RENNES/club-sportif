<?php
class ExportLicencieController
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

            // Génerer un fichier excel
            $filename = 'exported_licencies_' . date('Ymd_His') . '.csv';

            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '"');

            $output = fopen('php://output', 'w');

            fputcsv($output, ['Nom', 'Prenom', 'Contact', 'Categorie']);


            foreach ($licencies as $row) {
                $contactName = isset($arrayContacts[$row->getIdContact()]) ? $arrayContacts[$row->getIdContact()] : '';
                $categoryCode = isset($arrayCategories[$row->getIdCategorie()]) ? $arrayCategories[$row->getIdCategorie()] : '';

                fputcsv($output, [$row->getNom(), $row->getPrenom(), $contactName, $categoryCode]);
            }

            fclose($output);
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
$controller = new ExportLicencieController($licencieDAO, $categorieDAO, $contactDAO);
$controller->index();