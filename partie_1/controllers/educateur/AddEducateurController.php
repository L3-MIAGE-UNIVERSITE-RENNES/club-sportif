<?php

class AddEducateurController
{
    public function add_educator(){
        try {
            $educateur = new Educateur("", 1, 'test@example.com', '123456', true);
            $educateurDAO = new EducateurDAO(new Connexion());
            $educateurDAO->create($educateur);
        } catch (Exception $e){
            die("Erreur  : " . $e->getMessage());
        }


    }
}

require_once("../../configs/config.php");
require_once("../../classes/dao/Connexion.php");
require_once("../../classes/models/educateurModel.php");
require_once("../../classes/dao/educateurDAO.php");

$controller=new AddEducateurController();
$controller->add_educator();