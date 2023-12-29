<?php
class EditEducateurController {
    private $educateurDAO;
    private $licencieDAO;

    public function __construct(EducateurDAO $educateurDAO, LicencieDAO $licencieDAO) {
        $this->educateurDAO = $educateurDAO;
        $this->licencieDAO = $licencieDAO;
    }

    public function index($id){
        $licence = $this->licencieDAO->getAll();
        $educateur = $this->educateurDAO->getById($id);
        include('../../views/educateur/edit_educateur.php');
    }

    public function editEducateur($id) {
        try {
            // Récupérer le contact à modifier en utilisant son ID
            print_r($id);
            $educateur = $this->educateurDAO->getById($id);

            if (!$educateur) {
                echo "L'educateur n'a pas été trouvé.";
                return;
            }

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Récupérer les données du formulaire
                $numero_licence = $_POST['numero_licence'];
                $email = $_POST['email'];
                // $mot_de_passe = $_POST['mot_de_passe'];
                // $hmot_de_passe = password_hash($mot_de_passe, PASSWORD_DEFAULT);
                $est_administrateur = $_POST['est_administrateur'];

                // Valider les données du formulaire (ajoutez des validations si nécessaire)

                // Mettre à jour les détails du contact
                $educateur->setNumeroLicence($numero_licence);
                $educateur->setEmail($email);
                // $educateur->setMotDePasse($hmot_de_passe);
                $educateur->setEstAdministrateur($est_administrateur  == 'oui' ? 1 : 0);

                if ($this->educateurDAO->update($educateur)) {
                    // Rediriger vers la page de détails après la modification
                    // header('Location:EditEducateurController.php?id=' . $id);
                    header('Location:ListEducateurController.php');
                    exit();
                } else {
                    // Gérer les erreurs de mise à jour
                    echo "Erreur lors de la modification";
                }
            }
        } catch (Exception $e) {
            echo "Une erreur est survenue: " . $e->getMessage();
        }
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
$controller = new EditEducateurController($educateurDAO, $licencieDAO);
if(!isset($_POST['action'])){
    $controller->index($_GET["id"]);
} else{
    $id = $_POST['id'];
    $controller->editEducateur($id);
}

