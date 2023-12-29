<?php
    class ListEducateurController
    {
        private $educateurDAO;

        public function __construct(EducateurDAO $educateurDAO) {
            $this->educateurDAO = $educateurDAO;
        }

        public function index() {
            $educateurs = $this->educateurDAO->getAll();
            include('../../views/educateur/list_educateur.php');
        }
    }

require_once("../../configs/config.php");
require_once("../../classes/dao/Connexion.php");
require_once("../../classes/models/educateurModel.php");
require_once("../../classes/dao/educateurDAO.php");
$educateurDAO = new EducateurDAO(new Connexion());
$controller = new ListEducateurController($educateurDAO);
$controller->index();