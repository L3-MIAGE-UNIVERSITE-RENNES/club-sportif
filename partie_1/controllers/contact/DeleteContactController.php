<?php
class DeleteContactController
{
    private $contactDAO;
    public function __construct(ContactDAO $contactDAO) {
        $this->contactDAO = $contactDAO;
    }
    public function deleteContact($contactId) {
        // Retrieve the contact to delete using its ID
        $contact = $this->contactDAO->getById($contactId);

        if (!$contact) {
            // The contact was not found!
            echo "The contact was not found.";
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if ($this->contactDAO->deleteById($contactId)) {
                header('Location:ListContactController.php');
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
require_once("../../classes/models/contactModel.php");
require_once("../../classes/dao/contactDAO.php");
$contactDAO = new ContactDAO(new Connexion());
$controller = new DeleteContactController($contactDAO);
$controller->deleteContact($_GET['id']);
