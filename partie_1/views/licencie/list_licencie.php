<?php require('../../controllers/auth/guard.php'); ?>

<?php ob_start(); ?>
<div class="container mt-auto">
    <h1>Liste des Licenciés</h1>
    <div class="row">
        <div class="col-2 d-grid gap-2 d-md-block">
            <a class="btn btn-primary mb-2" href="AddLicencieController.php">Ajouter</a>
        </div>
        <div class="col-10 d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-primary btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Import</button>
            <a class="btn btn-primary mb-2 btn-success" href="ExportLicencieController.php">Export</a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter votre fichier</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="ImportLicencieController.php" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                     <input type="file" name="file" id="fileToUpload">
                </div>
                <div class="modal-footer">
                    <input  class="btn btn-primary" type="submit" value="Importer" name="submit">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php if (count($licencies) > 0): ?>
        <table class="table table-bordered table-striped mx-auto">
            <thead>
            <tr>
                <th>Numero de licence</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Categorie</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($licencies as $licencie): ?>
                <tr>
                    <td><?php echo $licencie->getNumeroLicence(); ?></td>
                    <td><?php echo $licencie->getNom(); ?></td>
                    <td><?php echo $licencie->getPrenom(); ?></td>
                    <td><?php echo $arrayCategories[$licencie->getIdCategorie()]; ?></td>
                    <td><?php echo $arrayContacts[$licencie->getIdContact()];?></td>
                    <td>
                        <a class="btn btn-secondary" href="ViewLicencieController.php?id=<?php echo $licencie->getNumeroLicence(); ?>">Voir</a>
                        <a class="btn btn-primary" href="EditLicencieController.php?id=<?php echo $licencie->getNumeroLicence(); ?>">Modifier</a>
                        <a class="btn btn-danger" href="DeleteLicencieController.php?id=<?php echo $licencie->getNumeroLicence(); ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune licencié trouvée.</p>
    <?php endif; ?>

</div>
<?php $content = ob_get_clean(); ?>

<?php require('../../views/layout.php') ?>
