<?php require('../../controllers/auth/guard.php'); ?><!DOCTYPE html>
<?php ob_start(); ?>
<?php if ($educateur): ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title"><strong>Numéro de licence :</strong></h5>
                    <p class="card-text"><?php echo $licencie->getNom(); ?></p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title"><strong>Email :</strong></h5>
                    <p class="card-text"><?php echo $educateur->getEmail(); ?></p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title"><strong>Administrateur :</strong></h5>
                    <p class="card-text"><?php echo $educateur->getEstAdministrateur() == 1 ? "Oui" : "Non"; ?></p>
                </div>
            </div>
            <a href="ListEducateurController.php" class="btn btn-primary mt-3">Retour à la liste des educateurs</a>
        </div>
    </div>
</div>
<?php else: ?>
    <p class="mt-3">L'éducateur n'a pas été trouvé.</p>
<?php endif; ?>
<?php $content = ob_get_clean(); ?>

<?php require('../../views/layout.php') ?>
