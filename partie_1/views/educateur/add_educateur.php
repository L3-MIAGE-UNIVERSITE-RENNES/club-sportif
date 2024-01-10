<?php require('../../controllers/auth/guard.php'); ?><!DOCTYPE html>

<?php ob_start(); ?>
<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card mx-auto w-50">
        <div class="card-body">
            <h1>Ajouter un Educateur</h1>

            <form action="AddEducateurController.php" method="post">
                <div class="mb-3">
                    <label for="mot_de_passe" class="form-label">Mot de passe :</label>
                    <input type="password" id="mot_de_passe" name="mot_de_passe" class="form-control" required><br>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input type="email" id="email" name="email" class="form-control"><br>
                </div>
                <div class="mb-3">
                    <label for="est_administrateur" class="form-label">Administrateur</label>
                    <select name="est_administrateur" id="est_administrateur" class="form-select">
                        <option value="non">Non</option>
                        <option value="oui">Oui</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="numero_licence" class="form-label">Licencié :</label>
                    <select name="numero_licence" id="numero_licence" class="form-select">
                        <?php
                        foreach ($licence as $number) {
                            echo "<option value='{$number->getNumeroLicence()}'>{$number->getNom()}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <input type="submit" name="action" value="Ajouter" class="btn btn-primary">
                    <a href="ListEducateurController.php" class="btn btn-sm btn-secondary">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div
<?php $content = ob_get_clean(); ?>

<?php require('../../views/layout.php') ?>
