<?php require('../../controllers/auth/guard.php'); ?>



<?php ob_start(); ?>
<div class="container mt-auto">
    <h1>Liste des Contacts</h1>
    <a class="btn btn-primary mb-2" href="AddContactController.php">Ajouter</a>

    <?php if (count($contacts) > 0): ?>
        <table class="table table-bordered table-striped mx-auto">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Numéro de téléphone</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?php echo $contact->getIdContact(); ?></td>
                    <td><?php echo $contact->getNom(); ?></td>
                    <td><?php echo $contact->getPrenom(); ?></td>
                    <td><?php echo $contact->getEmail(); ?></td>
                    <td><?php echo $contact->getNumeroTel(); ?></td>
                    <td>
                        <a class="btn btn-secondary" href="ViewContactController.php?id=<?php echo $contact->getIdContact(); ?>">Voir</a>
                        <a class="btn btn-primary" href="EditContactController.php?id=<?php echo $contact->getIdContact(); ?>">Modifier</a>
                        <a class="btn btn-danger" href="DeleteContactController.php?id=<?php echo $contact->getIdContact(); ?>">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Aucun contacts trouvé.</p>
    <?php endif; ?>

</div>
<?php $content = ob_get_clean(); ?>

<?php require('../../views/layout.php') ?>
