<?php require('../../controllers/auth/guard.php'); ?>
<?php ob_start(); ?>
    <div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card mx-auto w-50">
        <div class="card-body">
            <h1>Modifier un Contact</h1>
            <form action="EditContactController.php" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $_GET["id"]?>" />
                <label for="nom" class="form-label">Nom :</label>
                <input class="form-control" type="nom" id="nom" name="nom" value="<?php echo htmlspecialchars($contact->getNom()); ?>"><br>

                <label for="prenom" class="form-label">Prénom :</label>
                <input class="form-control" type="prenom" id="prenom" name="prenom" value="<?php echo htmlspecialchars($contact->getPrenom()); ?>"><br>

                <label for="email" class="form-label">Email :</label>
                <input class="form-control" type="email" id="email" name="email" value="<?php echo htmlspecialchars($contact->getEmail()); ?>"><br>

                <label for="numero_tel" class="form-label">Numéro de téléphone :</label>
                <input class="form-control" type="numero_tel" id="numero_tel" name="numero_tel" value="<?php echo htmlspecialchars($contact->getNumeroTel()); ?>"><br>

                <div class="d-flex justify-content-between mt-3">
                    <input type="submit" name="action" value="Modifer" class="btn btn-primary">
                    <a href="ListContactController.php" class="btn btn-secondary mt-3">Retour</a>
                </div>
            </form>
        </div>
    </div>
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('../../views/layout.php') ?>