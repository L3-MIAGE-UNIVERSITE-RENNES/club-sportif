<?php require('../../controllers/auth/guard.php'); ?><!DOCTYPE html>
<?php ob_start(); ?>
<?php if (isset($licencie)): ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title"><strong>Nom :</strong></h5>
                    <p class="card-text"><?php echo $licencie->getNom(); ?></p>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title"><strong>Prenom :</strong></h5>
                    <p class="card-text"><?php echo $licencie->getPrenom(); ?></p>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title"><strong>Categorie:</strong></h5>
                    <p class="card-text"><?php echo $arrayCategories[$licencie->getIdCategorie()] ?></p>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title"><strong>Contact :</strong></h5>
                    <p class="card-text"><?php echo $arrayContacts[$licencie->getIdContact()]; ?></p>
                </div>
            </div>
            <a href="ListLicencieController.php" class="btn btn-primary mt-3">Retour à la liste des licencies</a>
        </div>
    </div>
</div>
<?php else: ?>
    <p class="mt-3">Le licencie n'a pas été trouvé.</p>
<?php endif; ?>
<?php $content = ob_get_clean(); ?>

<?php require('../../views/layout.php') ?>
