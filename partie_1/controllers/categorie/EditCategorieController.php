<?php
class EditCategorieController {
    private $categorieDAO;

    public function __construct(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
    }

    public function index($id){
        $categorie = $this->categorieDAO->getById($id);
        include('../../views/categorie/edit_categorie.php');
    }

    public function editCategorie($id) {
        try {
            // Retrieve the categorie to modify using its ID
            $categorie = $this->categorieDAO->getById($id);

            if (!$categorie) {
                echo "The categorie was not found.";
                return;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Retrieve form data
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $numero_tel = $_POST['numero_tel'];

                // Update categorie details
                $categorie->setNom($nom);
                $categorie->setPrenom($prenom);
                $categorie->setEmail($email);
                $categorie->setNumeroTel($numero_tel);

                if ($this->categorieDAO->update($categorie)) {
                    // Redirect to the detail page after modification
                    header('Location:ListCategorieController.php');
                    exit();
                } else {
                    // Handle update errors
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
require_once("../../classes/models/categorieModel.php");
require_once("../../classes/dao/categorieDAO.php");

$categorieDAO = new CategorieDAO(new Connexion());
$controller = new EditCategorieController($categorieDAO);
if(!isset($_POST['action'])){
    $controller->index($_GET["id"]);
} else{
    $id = $_POST['id'];
    $controller->editCategorie($id);
}
