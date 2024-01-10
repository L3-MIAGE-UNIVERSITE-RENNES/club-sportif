<?php require('../../controllers/auth/guard.php'); ?>
<?php ob_start(); ?>
<div class="container mt-2">
    <h1>Liste des Educateurs</h1>
    <a class="btn btn-primary mb-2" href="AddEducateurController.php">Ajouter</a>

    <?php if (count($educateurs) > 0): ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Numero de licence</th>
                <th>Email</th>
                <th>Administrateur</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($educateurs as $educateur): ?>
                <tr>
                    <td><?php echo $educateur->getNumeroLicence(); ?></td>
                    <td><?php echo $educateur->getEmail(); ?></td>
                    <td><?php echo $educateur->getEstAdministrateur() == 1 ? 'oui' : 'non'; ?></td>
                    <td>
                        <a class="btn btn-secondary" href="ViewEducateurController.php?id=<?php echo $educateur->getIdEducateur(); ?>">Voir</a>
                        <a class="btn btn-primary" href="EditEducateurController.php?id=<?php echo $educateur->getIdEducateur(); ?>">Modifier</a>
                        <a class="btn btn-danger" href="DeleteEducateurController.php?id=<?php echo $educateur->getIdEducateur(); ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun educateurs trouvé.</p>
    <?php endif; ?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('../../views/layout.php') ?>
