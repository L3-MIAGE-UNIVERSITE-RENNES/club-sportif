<?php require('../../controllers/auth/guard.php'); ?><!DOCTYPE html>

<?php ob_start(); ?>
<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card mx-auto w-50">
        <div class="card-body">
            <h1>Ajouter un Licencié</h1>
            <form action="AddLicencieController.php" method="post">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" id="nom" name="nom" class="form-control" required><br>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prenom :</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" required><br>
                </div>
                <div class="mb-3">
                    <label for="id_contact" class="form-label">Contact :</label>
                    <select name="id_contact" id="id_contact" class="form-select">
                        <?php
                        foreach ($contacts as $number) {
                            echo "<option value='{$number->getIdContact()}'>{$number->getNom()} {$number->getPrenom()}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_categorie" class="form-label">Categorie :</label>
                    <select name="id_categorie" id="id_categorie" class="form-select">
                        <?php
                        foreach ($categories as $number) {
                            echo "<option value='{$number->getId()}'>{$number->getCodeRaccourci()}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <input type="submit" name="action" value="Ajouter" class="btn btn-primary">
                    <a href="ListLicencieController.php" class="btn btn-sm btn-secondary">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../../views/layout.php') ?>
