<?php
class ImportLicencieController
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
        if (isset($_FILES['file'])) {
            $file = $_FILES['file']['name'];
            $fileType = pathinfo($file, PATHINFO_EXTENSION);
            $allowedTypes = ['csv', 'dat', 'tsv', 'xls', 'ods'];
            if (!in_array($fileType, $allowedTypes)) {
                echo "Error: Only CSV files are allowed.";
                exit;
            }

            // Define upload directory
            $uploadDir = __DIR__ . '/uploads/';

            // Create upload directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Get the current date and time
            $dateTime = date('YmdHis');

            // Generate a unique name for the uploaded file
            $fileName = $file . '_' . $dateTime . '.' . $fileType;
            $uploadFilePath = $uploadDir . $fileName;

            // Move the uploaded file to the upload directory
            move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);

            $handle = fopen($uploadFilePath, "r");
            $headers = fgetcsv($handle, 0, ";");
            $expectedHeaders = ['nom', 'prenom', 'id_contact', 'id_categorie'];

            if ($headers !== $expectedHeaders) {
                echo "Error: Column names do not match the expected column names.";
                exit;
            }

            while (($data = fgetcsv($handle, 0, ";")) !== FALSE) {
                $nom = $data[0];
                $prenom = $data[1];
                $id_contact = $data[2];
                $id_categorie = $data[3];

                $licencie = new Licencie("", $nom, $prenom, $id_contact, $id_categorie);
                $this->licencieDAO->create($licencie);
            }
            fclose($handle);
        } else {
            echo "Error: No file was uploaded.";
        }



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
$controller = new ImportLicencieController($licencieDAO, $categorieDAO, $contactDAO);
$controller->index();