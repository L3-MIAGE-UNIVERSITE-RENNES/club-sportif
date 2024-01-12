<?php
class DeleteLicencieController
{
    private $licencieDAO;
    public function __construct(LicencieDAO $licenciesDAO) {
        $this->licencieDAO = $licenciesDAO;
    }

    public function deleteLicencie($licenciesId) {
        // Retrieve the licencies to delete using its ID
        $licencies = $this->licencieDAO->getById($licenciesId);

        if (!$licencies) {
            // The licencies was not found!
            echo "The licencie was not found.";
            return;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if ($this->licencieDAO->deleteById($licenciesId)) {
                header('Location:ListLicencieController.php');
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
require_once("../../classes/models/licencieModel.php");
require_once("../../classes/dao/licencieDAO.php");
$licencieDAO = new LicencieDAO(new Connexion());
$controller = new DeleteLicencieController($licencieDAO);
$controller->deleteLicencie($_GET['id']);
