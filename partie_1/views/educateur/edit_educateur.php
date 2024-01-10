<?php require('../../controllers/auth/guard.php'); ?><!DOCTYPE html>

<?php ob_start(); ?>
<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card mx-auto w-50">
        <div class="card-body">
            <h1>Modifier un Educateur</h1>
            <a href="ListEducateurController.php">Retour à la liste des educateurs</a>

            <form action="EditEducateurController.php" method="post">
                <input type="hidden" id="id" name="id" value="{{ edu_id }}">
                <div class="mb-3">
                    <label for="email" class="form-label">Email :</label>
                    <input class="form-control" type="email" id="email" name="email" value="<?php echo htmlspecialchars($educateur->getEmail()); ?>"><br>
                </div>
                <div class="mb-3">
                    <label for="est_administrateur" class="form-label">Administrateur</label>
                    <select name="est_administrateur" id="est_administrateur" class="form-select">
                        <option value="non" <?php if($educateur->getEstAdministrateur() == 0) echo 'selected'; ?>>Non</option>
                        <option value="oui" <?php if($educateur->getEstAdministrateur() == 1) echo 'selected'; ?>>Oui</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="numero_licence" class="form-label">Licencié :</label>
                    <select class="form-select" name="numero_licence" id="numero_licence">
                        <?php
                        // A ameliorer; la selecct doit etre de base sur le numero de licence venant de la base;
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
