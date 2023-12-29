<?php
class ListContactController
{
        private $contactDAO;

        public function __construct(ContactDAO $contactDAO) {
            $this->contactDAO = $contactDAO;
        }

        public function index() {
            $contacts = $this->contactDAO->getAll();
            include('../../views/contact/list_contact.php');
        }
    }

require_once("../../configs/config.php");
require_once("../../classes/dao/Connexion.php");
require_once("../../classes/models/contactModel.php");
require_once("../../classes/dao/ContactDAO.php");
$contactDAO = new ContactDAO(new Connexion());
$controller = new ListContactController($contactDAO);
$controller->index();