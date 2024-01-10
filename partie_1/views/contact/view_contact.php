<?php require('../../controllers/auth/guard.php'); ?><!DOCTYPE html>
<?php ob_start(); ?>
<?php if (isset($contact)): ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title"><strong>Nom :</strong></h5>
                    <p class="card-text"><?php echo $contact->getNom(); ?></p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title"><strong>Prenom :</strong></h5>
                    <p class="card-text"><?php echo $contact->getPrenom(); ?></p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title"><strong>Email :</strong></h5>
                    <p class="card-text"><?php echo $contact->getEmail(); ?></p>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title"><strong>Numero telephone :</strong></h5>
                    <p class="card-text"><?php echo $contact->getNumeroTel(); ?></p>
                </div>
            </div>
            <a href="ListContactController.php" class="btn btn-primary mt-3">Retour à la liste des contacts</a>
        </div>
    </div>
</div>
<?php else: ?>
    <p class="mt-3">Le contact n'a pas été trouvé.</p>
<?php endif; ?>
<?php $content = ob_get_clean(); ?>

<?php require('../../views/layout.php') ?>
