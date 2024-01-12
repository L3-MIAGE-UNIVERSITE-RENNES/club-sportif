<?php

class AddLicencieController
{
    private $categorieDAO;
    private $contactDAO;
    private $licencieDAO;

    public function __construct(CategorieDAO $categorieDAO, LicencieDAO $licencieDAO, ContactDAO $contactDAO) {
        $this->categorieDAO = $categorieDAO;
        $this->contactDAO = $contactDAO;
        $this->licencieDAO = $licencieDAO;
    }

    public function index(){
        $licencies = $this->licencieDAO->getAll();
        $contacts = $this->contactDAO->getAll();
        $categories = $this->categorieDAO->getAll();
        include('../../views/licencie/add_licencie.php');
    }

    public function add_licencie(){
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Retrieve form data
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $id_contact = $_POST['id_contact'];
                $id_categorie = $_POST['id_categorie'];

                $licencie = new Licencie("", $nom, $prenom, $id_contact, $id_categorie);
                if ($this->licencieDAO->create($licencie)) {
                    // Redirect to homepage after adding
                    header('Location:ListLicencieController.php');
                    exit();
                } else {
                    // Handle errors when adding categorie
                    echo "Erreur lors de l'ajout du licencié.";
                }
            }
        } catch (Exception $e){
            die("Erreur : " . $e->getMessage());
        }
    }

}

require_once("../../configs/config.php");
require_once("../../classes/dao/Connexion.php");
require_once("../../classes/models/categorieModel.php");
require_once("../../classes/models/licencieModel.php");
require_once("../../classes/dao/categorieDAO.php");
require_once("../../classes/dao/licencieDAO.php");
require_once("../../classes/models/contactModel.php");
require_once("../../classes/dao/ContactDAO.php");

$categorieDAO = new CategorieDAO(new Connexion());
$licencieDAO = new LicencieDAO(new Connexion());
$contactDAO = new ContactDAO(new Connexion());
$controller = new AddLicencieController($categorieDAO, $licencieDAO, $contactDAO);

if(!isset($_POST['action'])){
    $controller->index();
} else{
    $controller->add_licencie();
}
