<?php require('../../controllers/auth/guard.php'); ?>
<?php ob_start(); ?>
    <div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card mx-auto w-50">
        <div class="card-body">
            <h1>Modifier un Categorie</h1>
            <form action="EditCategorieController.php" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $_GET["id"]?>" />
                <label for="nom" >Nom :</label>
                <input type="text" id="nom" name="nom" class="form-control" value="<?php echo $categorie->getNom() ?>"><br>

                <label for="code_raccourci" class="form-label">Prénom :</label>
                <input class="form-control" type="code_raccourci" id="code_raccourci" name="code_raccourci" value="<?php echo htmlspecialchars($categorie->getCodeRaccourci()); ?>"><br>

                <div class="d-flex justify-content-between mt-3">
                    <input type="submit" name="action" value="Modifer" class="btn btn-primary">
                    <a href="ListCategorieController.php" class="btn btn-secondary mt-3">Retour</a>
                </div>
            </form>
        </div>
    </div>
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('../../views/layout.php') ?>