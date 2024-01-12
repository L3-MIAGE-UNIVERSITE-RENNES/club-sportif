<?php require('../../controllers/auth/guard.php'); ?>

<?php ob_start(); ?>
<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="card mx-auto w-50">
        <div class="card-body">
            <h1>Modifier un Licencie</h1>
            <form action="EditLicencieController.php" method="post">
                <input type="hidden" id="id" name="id" value="<?php echo $_GET["id"]?>" />
                <div class="mb-1">
                    <label for="nom" class="form-label">Nom :</label>
                    <input type="text" id="nom" name="nom" class="form-control" value="<?php echo htmlspecialchars($licencie->getNom()); ?>" required><br>
                </div>
                <div class="mb-1">
                    <label for="prenom" class="form-label">Prenom :</label>
                    <input type="text" id="prenom" name="prenom" class="form-control" value="<?php echo htmlspecialchars($licencie->getPrenom()); ?>" required><br>
                </div>
                <div class="mb-1">
                    <label for="id_contact" class="form-label">Contact :</label>
                    <select name="id_contact" id="id_contact" class="form-select">
                        <?php
                        foreach ($contacts as $contact) {
                            $selected = ($licencie->getIdContact() == $contact->getIdContact()) ? 'selected' : '';
                            echo "<option value='{$contact->getIdContact()}' $selected>{$contact->getNom()} {$contact->getPrenom()}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-1">
                    <label for="id_categorie" class="form-label">Categorie :</label>
                    <select name="id_categorie" id="id_categorie" class="form-select">
                        <?php
                        foreach ($categories as $categorie) {
                            $selected = ($licencie->getIdCategorie() == $categorie->getId()) ? 'selected' : '';
                            echo "<option value='{$categorie->getId()}' $selected>{$categorie->getCodeRaccourci()}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="d-flex justify-content-between mt-3">
                    <input type="submit" name="action" value="Modifier" class="btn btn-primary">
                    <a href="ListLicencieController.php" class="btn btn-sm btn-secondary">Retour</a>
                </div>
            </form>
        </div>
    </div>
</div
<?php $content = ob_get_clean(); ?>

<?php require('../../views/layout.php') ?>

