<?php require('../../controllers/auth/guard.php'); ?><!DOCTYPE html>

<?php ob_start(); ?>
<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card mx-auto w-50">
        <div class="card-body">
            <h1>Ajouter un Contact</h1>
            <form action="AddCategorieController.php" method="post">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" id="nom" name="nom" class="form-control" required><br>
                </div>
                <div class="mb-3">
                    <label for="code_raccourci" class="form-label">Code Raccourci :</label>
                    <input type="text" id="code_raccourci" name="code_raccourci" class="form-control" required><br>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <input type="submit" name="action" value="Ajouter" class="btn btn-primary">
                    <a href="ListCategorieController.php" class="btn btn-sm btn-secondary">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('../../views/layout.php') ?>
