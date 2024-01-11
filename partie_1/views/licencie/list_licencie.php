<?php require('../../controllers/auth/guard.php'); ?>

<?php ob_start(); ?>
<div class="container mt-auto">
    <h1>Liste des Catégories</h1>
    <a class="btn btn-primary mb-2" href="AddCategorieController.php">Ajouter</a>

    <?php if (count($categories) > 0): ?>
        <table class="table table-bordered table-striped mx-auto">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Code raccourci</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($categories as $category): ?>
                <tr>
                    <td><?php echo $category->getNom(); ?></td>
                    <td><?php echo $category->getCodeRaccourci(); ?></td>
                    <td>
                        <a class="btn btn-secondary" href="ViewCategorieController.php?id=<?php echo $category->getId(); ?>">Voir</a>
                        <a class="btn btn-primary" href="EditCategorieController.php?id=<?php echo $category->getId(); ?>">Modifier</a>
                        <a class="btn btn-danger" href="DeleteCategorieController.php?id=<?php echo $category->getId(); ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucune catégorie trouvée.</p>
    <?php endif; ?>

</div>
<?php $content = ob_get_clean(); ?>

<?php require('../../views/layout.php') ?>
