<?php

class AddContactController
{
    private $contactDAO;

    public function __construct(ContactDAO $contactDAO) {
        $this->contactDAO = $contactDAO;
    }

    public function index(){
        include('../../views/contact/add_contact.php');
    }

    public function add_contact(){
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Retrieve form data
                $nom = $_POST['nom'];
                $prenom = $_POST['prenom'];
                $email = $_POST['email'];
                $numero_tel = $_POST['numero_tel'];

                // Validate form data
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo 'Email invalid';
                    return;
                }

                if($this->contactDAO->getByEmail($email)){
                    echo 'Cet contact existe déjà !';
                    return;
                }

                // Create new Contact object
                $contact = new Contact("", $nom, $prenom, $email, $numero_tel);
                if ($this->contactDAO->create($contact)) {
                    // Redirect to homepage after adding
                    header('Location:ListContactController.php');
                    exit();
                } else {
                    // Handle errors when adding contact
                    echo "Erreur lors de l'ajout de l'contact.";
                }
            }
        } catch (Exception $e){
            die("Erreur : " . $e->getMessage());
        }
    }
}

require_once("../../configs/config.php");
require_once("../../classes/dao/Connexion.php");
require_once("../../classes/models/contactModel.php");
require_once("../../classes/models/licencieModel.php");
require_once("../../classes/dao/contactDAO.php");
require_once("../../classes/dao/licencieDAO.php");

$contactDAO = new ContactDAO(new Connexion());
$licencieDAO = new LicencieDAO(new Connexion());
$controller = new AddContactController($contactDAO, $licencieDAO);

if(!isset($_POST['action'])){
    $controller->index();
} else{
    $controller->add_contact();
}
