<?php
class ListCategorieController
{
        private $categorieDAO;

        public function __construct(CategorieDAO $categorieDAO) {
            $this->categorieDAO = $categorieDAO;
        }

        public function index() {
            $categories = $this->categorieDAO->getAll();
            include('../../views/categorie/list_categorie.php');
        }
    }

require_once("../../configs/config.php");
require_once("../../classes/dao/Connexion.php");
require_once("../../classes/models/categorieModel.php");
require_once("../../classes/dao/categorieDAO.php");
$categorieDAO = new CategorieDAO(new Connexion());
$controller = new ListCategorieController($categorieDAO);
$controller->index();