<?php
    class ViewContactController
    {
        private $contactDAO;
        public function __construct(ContactDAO $contactDAO) {
            $this->contactDAO = $contactDAO;
        }

        public function viewContact($contactId) {
            $contact = $this->contactDAO->getById($contactId);

            // Inclure la vue pour afficher les détails
            include('../../views/contact/view_contact.php');
        }
    }

    require_once("../../configs/config.php");
    require_once("../../classes/dao/Connexion.php");
    require_once("../../classes/models/contactModel.php");
    require_once("../../classes/dao/contactDAO.php");

    $contactDAO = new ContactDAO(new Connexion());
    $controller = new ViewContactController($contactDAO);
    $controller->viewContact($_GET['id']);