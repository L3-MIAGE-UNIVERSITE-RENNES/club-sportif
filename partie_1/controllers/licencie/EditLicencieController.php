<?php
class EditLicencieController {
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

    public function index($id){
        $licencie = $this->licencieDAO->getById($id);
        $contacts = $this->contactDAO->getAll();
        $categories = $this->categorieDAO->getAll();
        include('../../views/licencie/edit_licencie.php');
    }

    public function editLicencie($id) {
        try {
            $licencie = $this->licencieDAO->getById($id);
            if (!$licencie) {
                echo "licencie introuvables";
                return;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $id_contact = $_POST['id_contact'];
                $id_categorie = $_POST['id_categorie'];

                // Update details
                $licencie->setNom($nom);
                $licencie->setPrenom($prenom);
                $licencie->setIdContact($id_contact);
                $licencie->setIdCategorie($id_categorie);

                if ($this->licencieDAO->update($licencie)) {
                    header('Location:ListLicencieController.php');
                    exit();
                } else {
                    echo "Erreur de mise a jour";
                }
            }
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
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

$controller = new EditLicencieController($licencieDAO, $categorieDAO, $contactDAO);
if(!isset($_POST['action'])){
    $controller->index($_GET["id"]);
} else{
    $id = $_POST['id'];
    $controller->editLicencie($id);
}
