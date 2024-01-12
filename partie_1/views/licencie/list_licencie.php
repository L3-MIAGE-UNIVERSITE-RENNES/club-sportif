<?php require('../../controllers/auth/guard.php'); ?>

<?php ob_start(); ?>
<div class="container mt-auto">
    <h1>Liste des Licenciés</h1>
    <a class="btn btn-primary mb-2" href="AddLicencieController.php">Ajouter</a>

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
