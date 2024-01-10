<?php

class AddCategorieController
{
    private $categorieDAO;

    public function __construct(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
    }

    public function index(){
        include('../../views/categorie/add_categorie.php');
    }

    public function add_categorie(){
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Retrieve form data
                $nom = $_POST['nom'];
                $code_raccourci = $_POST['code_raccourci'];

                if($this->categorieDAO->getByCode($code_raccourci)){
                    echo 'Cette categorie existe déjà !';
                    return;
                }

                // Create new Categorie object
                $categorie = new Categorie("", $nom, $code_raccourci);
                if ($this->categorieDAO->create($categorie)) {
                    // Redirect to homepage after adding
                    header('Location:ListCategorieController.php');
                    exit();
                } else {
                    // Handle errors when adding categorie
                    echo "Erreur lors de l'ajout de la catégorie.";
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

$categorieDAO = new CategorieDAO(new Connexion());
$licencieDAO = new LicencieDAO(new Connexion());
$controller = new AddCategorieController($categorieDAO, $licencieDAO);

if(!isset($_POST['action'])){
    $controller->index();
} else{
    $controller->add_categorie();
}
