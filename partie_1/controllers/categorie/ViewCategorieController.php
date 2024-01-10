<?php
    class ViewCategorieController
    {
        private $categorieDAO;
        public function __construct(CategorieDAO $categorieDAO) {
            $this->categorieDAO = $categorieDAO;
        }

        public function viewCategorie($categorieId) {
            $categorie = $this->categorieDAO->getById($categorieId);

            // Inclure la vue pour afficher les détails
            include('../../views/categorie/view_categorie.php');
        }
    }

    require_once("../../configs/config.php");
    require_once("../../classes/dao/Connexion.php");
    require_once("../../classes/models/categorieModel.php");
    require_once("../../classes/dao/categorieDAO.php");

    $categorieDAO = new CategorieDAO(new Connexion());
    $controller = new ViewCategorieController($categorieDAO);
    $controller->viewCategorie($_GET['id']);