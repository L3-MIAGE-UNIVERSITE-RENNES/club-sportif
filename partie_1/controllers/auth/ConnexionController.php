<?php
    class ConnexionController
    {
        private $educateurDAO;

        public function __construct(EducateurDAO $educateurDAO) {
            $this->educateurDAO = $educateurDAO;
        }

        public function index(){
            header("Location:views/auth/connexion.php");
        }

        public function connect(){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $email = $_POST['email'];
                $mot_de_passe = $_POST['mot_de_passe'];
                echo $email;
                // Validation du formulaire
                if (isset($email) &&  isset($mot_de_passe)) {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        echo 'Il faut un email valide pour soumettre le formulaire.';
                        return;
                    }

                    $educateur = $this->educateurDAO->getByEmail($email);

                    if (!$educateur) {
                        echo "L'educateur n'a pas été trouvé.";
                        return;
                    }

                    if ($educateur->getEstAdministrateur() != 1 || password_verify($mot_de_passe, $educateur->getMotDePasse()) != 1 ){
                        echo "Les informations envoyées ne permettent pas de vous identifier !";
                        return;
                    }

                    // Creer une session et redireger l'utilisateur vers la page d'acceuil
                    session_start();
                    $_SESSION['loggedin'] = true;
                    header("Location:../../views/home.php");
                }

            }
        }
    }

require_once("../../configs/config.php");
require_once("../../classes/dao/Connexion.php");
require_once("../../classes/models/educateurModel.php");
require_once("../../classes/dao/educateurDAO.php");

$educateurDAO = new EducateurDAO(new Connexion());
$controller = new ConnexionController($educateurDAO);

if(!isset($_POST['action'])){
    $controller->index();
} else{
    $controller->connect();
}
