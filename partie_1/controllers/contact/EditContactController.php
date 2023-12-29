<?php
class EditContactController {
    private $contactDAO;

    public function __construct(ContactDAO $contactDAO) {
        $this->contactDAO = $contactDAO;
    }

    public function index($id){
        $contact = $this->contactDAO->getById($id);
        include('../../views/contact/edit_contact.php');
    }

    public function editContact($id) {
        try {
            // Retrieve the contact to modify using its ID
            $contact = $this->contactDAO->getById($id);

            if (!$contact) {
                echo "The contact was not found.";
                return;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Retrieve form data
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $numero_tel = $_POST['numero_tel'];

                // Update contact details
                $contact->setNom($nom);
                $contact->setPrenom($prenom);
                $contact->setEmail($email);
                $contact->setNumeroTel($numero_tel);

                if ($this->contactDAO->update($contact)) {
                    // Redirect to the detail page after modification
                    header('Location:ListContactController.php');
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
require_once("../../classes/models/contactModel.php");
require_once("../../classes/dao/contactDAO.php");

$contactDAO = new ContactDAO(new Connexion());
$controller = new EditContactController($contactDAO);
if(!isset($_POST['action'])){
    $controller->index($_GET["id"]);
} else{
    $id = $_POST['id'];
    $controller->editContact($id);
}
