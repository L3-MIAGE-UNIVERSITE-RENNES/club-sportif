<?php
class DeleteCategorieController
{
    private $categorieDAO;
    public function __construct(CategorieDAO $categorieDAO) {
        $this->categorieDAO = $categorieDAO;
    }

    public function deleteCategorie($categorieId) {
        // Retrieve the categorie to delete using its ID
        $categorie = $this->categorieDAO->getById($categorieId);

        if (!$categorie) {
            // The categorie was not found!
            echo "The categorie was not found.";
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if ($this->categorieDAO->deleteById($categorieId)) {
                header('Location:ListCategorieController.php');
                exit();
            } else {
                // Handle deletion errors
                echo "Error lors de la suppresion";
            }
        }
    }
}
require_once("../../configs/config.php");
require_once("../../classes/dao/Connexion.php");
require_once("../../classes/models/categorieModel.php");
require_once("../../classes/dao/categorieDAO.php");
$categorieDAO = new CategorieDAO(new Connexion());
$controller = new DeleteCategorieController($categorieDAO);
$controller->deleteCategorie($_GET['id']);
