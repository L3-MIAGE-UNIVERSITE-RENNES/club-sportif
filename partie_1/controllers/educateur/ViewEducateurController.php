<?php
    class ViewEducateurController
    {
        private $educateurDAO;
        private $licencieDAO;
        public function __construct(EducateurDAO $educateurDAO, LicencieDAO $licencieDAO) {
            $this->educateurDAO = $educateurDAO;
            $this->licencieDAO = $licencieDAO;
        }

        public function viewEducateur($educateurId) {
            // Récupérer le educateur à afficher en utilisant son ID
            $educateur = $this->educateurDAO->getById($educateurId);
            $licencie = $this->licencieDAO->getById($educateur->getNumeroLicence());

            // Inclure la vue pour afficher les détails du educateur
            include('../../views/educateur/view_educateur.php');
        }
    }

    require_once("../../configs/config.php");
    require_once("../../classes/dao/Connexion.php");
    require_once("../../classes/models/educateurModel.php");
    require_once("../../classes/models/licencieModel.php");
    require_once("../../classes/dao/educateurDAO.php");
    require_once("../../classes/dao/licencieDAO.php");

    $educateurDAO = new EducateurDAO(new Connexion());
    $licencieDAO = new LicencieDAO(new Connexion());
    $controller = new ViewEducateurController($educateurDAO, $licencieDAO);
    $controller->viewEducateur($_GET['id']);